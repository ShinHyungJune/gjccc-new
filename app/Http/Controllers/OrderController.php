<?php

namespace App\Http\Controllers;

use App\Enums\KakaoTemplate;
use App\Enums\OrderProductState;
use App\Enums\OrderState;
use App\Enums\OutgoingState;
use App\Enums\ProductType;
use App\Enums\SmsTemplate;
use App\Http\Resources\BannerResource;
use App\Http\Resources\DeliveryResource;
use App\Http\Resources\OrderProductResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PayMethodResource;
use App\Http\Resources\ProductResource;
use App\Models\Iamport;
use App\Models\Kakao;
use App\Models\Order;
use App\Models\PayMethod;
use App\Models\Product;
use App\Models\SMS;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(Request  $request)
    {
        $request["started_at"] = $request->started_at ?? "";
        $request["finished_at"] = $request->finished_at ?? "";
        $request["type"] = $request->type ?? "";

        $orders = auth()->user()->orders()->where("state", "!=", OrderState::FAIL)->where("state", "!=", OrderState::WAIT);

        if($request->started_at)
            $orders = $orders->where("created_at", ">=", Carbon::make($request->started_at)->startOfDay());

        if($request->finished_at)
            $orders = $orders->where("created_at", "<=", Carbon::make($request->finished_at)->endOfDay());

        if($request->type)
            $orders = $orders->whereHas("products", function($query) use($request){
                return $query->where("type", $request->type);
            });

        $orders = $orders->paginate(12);

        return Inertia::render("Orders/Index", [
            "orders" => OrderResource::collection($orders),
            "started_at" => $request->started_at,
            "finished_at" => $request->finished_at,
            "type" => $request->type,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            "direct" => "required|boolean",
        ]);

        // 장바구니에 담지 않고 바로 주문
        $products = $request->direct ? $this->getDirectProducts($request) : $this->getCartProducts($request);

        $payMethods = PayMethod::paginate(30);

        // $delivery = auth()->user()->deliveries()->latest()->where("default", true)->first();


        return Inertia::render("Shopping/Orders/Create", [
            "direct" => $request->direct,
            "products" => ProductResource::collection($products),
            "payMethods" => PayMethodResource::collection($payMethods),

            // "delivery" => $delivery ? DeliveryResource::make($delivery) : "",
            "deliveryPrice" => $deliveryPrice,
            "delivery_min_discount_price" => $deliveryMinDiscountPrice,
        ]);
    }

    public function show(Order $order)
    {
        if($order->user_id != auth()->id())
            return redirect()->back()->with("error", "자신의 주문건만 조회할 수 있습니다.");

        return Inertia::render("Orders/Show", [
            "order" => OrderResource::make($order)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "product_id" => "required|integer",
            "option_id" => "required|integer",
            "pay_method_id" => "required|integer",
        ]);

        $result = DB::transaction(function () use ($request) {
            $order = new Order();

            return $order->attempt($request);
        });

        return $result["state"] == "error"
            ? redirect()->back()->with($result["state"], $result["message"])
            : Inertia::render("Orders/Pay", [
                "m_redirect_url" => config("app.url")."/orders/complete/mobile",
                "order" => OrderResource::make($result["data"]),
                "imp_code" => config("iamport.imp_code") // 가맹점 식별코드
            ]);
    }

    // 결제검증(OrderObserver 사용)
    public function complete(Request $request)
    {
        $request->validate([
            "imp_uid" => "required|string|max:50000",
            "merchant_uid" => "required|string|max:50000",
        ]);

        $result = ["state" => "success", "message"=>"성공적으로 처리되었습니다"];

        // 권한 얻기
        $accessToken = Iamport::getAccessToken();

        $sms = new SMS();

        DB::beginTransaction();

        try {
            // 주문조회
            $impOrder = Iamport::getOrder($accessToken, $request->imp_uid);

            $order = Order::where(function($query){
                $query->where("state", OrderState::WAIT)
                    ->orWhere("state", OrderState::FAIL);
            })->where("merchant_uid", $impOrder["merchant_uid"])->first();

            if(!$order)
                return abort(404);

            if($order->price != $impOrder["amount"])
                return abort(403);

            switch ($impOrder["status"]){
                case "ready": // 가상계좌 발급
                    $vbankNum = $impOrder["vbank_num"];
                    $vbankDate = Carbon::parse($impOrder["vbank_date"])->format("Y-m-d H:i");
                    $vbankName = $impOrder["vbank_name"];

                    // OrderObserver 사용
                    $order->update([
                        "imp_uid" => $request->imp_uid,
                        "state" => OrderState::WAIT,
                        "vbank_num" => $vbankNum,
                        "vbank_date" => $vbankDate,
                        "vbank_name" => $vbankName
                    ]);

                    $result = ["state" => "success", "message"=>"가상계좌 발급이 완료되었습니다. ${vbankName}/ ${vbankNum} / ${vbankDate}"];

                    break;
                case "paid": // 결제완료
                    // 결제상품 주문성공처리
                    $prevState = $order->state;

                    $user = $order->user;

                    if ($prevState == OrderState::FAIL || $prevState == OrderState::WAIT) {
                        $order->update(["state" => OrderState::SUCCESS]);

                        $order->orderProducts()->update([
                            "state" => OrderProductState::SUCCESS
                        ]);

                        if ($order->state == OrderState::SUCCESS) {

                            // 결제상품 주문성공처리
                            $order->orderProducts()->update([
                                "state" => OrderProductState::SUCCESS
                            ]);

                            $products = $order->products()->where("products.product_id", null)->cursor();

                            foreach($products as $product){
                                if($product->type == ProductType::DATING)
                                    $user->update([
                                        "count_dating" => $user->count_dating + $product->count_dating
                                    ]);

                                if($product->type == ProductType::PARTY) {
                                    $sms->send($order->user->contact, [
                                        "title" => $product->title,
                                        "opened_at" => Carbon::make($product->opened_at)->format("m월 d일 H:i"),
                                        "place_name" => $product->place_name,
                                        "address" => $product->address
                                    ], SmsTemplate::ORDER_PARTY);
                                }
                            }
                        }
                    }

                    break;
            }

            DB::commit();
        }catch(\Exception $e) {
            // Iamport::cancel($accessToken, $request->imp_uid);

            // $order->update(["state" => OrderState::FAIL]);
            $result = ["state" => "error", "message"=> "결제를 실패하였습니다."];

            DB::rollBack();
        }

        $order = Order::where("merchant_uid", $request->merchant_uid)->first();

        return redirect("/orders/result?order_id=".$order->id);
    }

    public function fail(Request $request)
    {
        $request->validate([
            "message" => "required|string|max:500",
            "order_id" => "required|integer"
        ]);

        $order = Order::find($request->order_id);

        if(!$order)
            return redirect()->back()->with("error", "존재하지 않는 주문건입니다.");

        if($order->user_id != auth()->id())
            return redirect()->back()->with("error", "자신의 주문건만 조회할 수 있습니다.");

        $order->update(["reason" => $request->message]);

        return redirect("/orders/result?order_id=".$order->id);
    }

    public function result(Request $request)
    {
        $request->validate([
            "order_id" => "required|integer"
        ]);

        $order = Order::find($request->order_id);

        if(!$order)
            return redirect()->back()->with("error", "존재하지 않는 주문입니다.");

        if($order->user_id != auth()->id())
            return redirect()->back()->with("error", "자신의 주문결과만 조회할 수 있습니다.");

        return Inertia::render("Orders/Result", [
            "order" => OrderResource::make($order),
            "message" => $order->reason,
        ]);
    }

    public function cancel(Request $request)
    {
        $request->validate([
            "order_id" => "required|integer"
        ]);

        try {
            $order = Order::find($request->order_id);

            if($order->user_id != auth()->id())
                return redirect()->back()->with("error", "자신의 주문건만 취소할 수 있습니다.");

            if(!$order->can_cancel)
                return redirect()->back()->with("error", "주문취소 불가능한 주문내역입니다.");

            $accessToken = Iamport::getAccessToken();

            $result = ["state" => "success", "message" => "주문취소가 완료되었습니다."];

            DB::beginTransaction();

            $order->update(["state" => OrderState::CANCEL]);

            $order->outgoings()->update([
                "state" => OutgoingState::FAIL
            ]);

            Iamport::cancel($accessToken, $order->imp_uid);

            $order->refunds()->create([
                "user_id" => $order->user_id,
                "reason_request" => "주문취소",
                "refunded" => 1,
                "price" => $order->price_real,
                "type" => "주문취소"
            ]);

            DB::commit();
        }catch(\Exception $e) {
            // $order->update(["state" => OrderState::FAIL]);
            $result = ["state" => "error", "message"=> "주문취소에 실패하였습니다. 고객센터에 문의 부탁드립니다."];

            DB::rollBack();
        }

        return redirect()->back()->with($result["state"], $result["message"]);
    }

    // 상품상세페이지에서 장바구니에 담지 않고 바로 구매할 때
    public function getDirectProducts(Request $request)
    {
        $request["options"] = json_decode($request->options, true);

        $request->validate([
            "product_id" => "required|integer",
            "count" => "required|integer|min:1|max:99",
            "options" => "nullable|array",
            "color" => "required|string|max:500" // #복붙주의 - 일반적인 쇼핑몰에선 컬러 안쓰겠지
        ]);

        $product = Product::find($request->product_id);

        if(!$product)
            return redirect()->back()->with("error", "존재하지 않는 상품입니다.");

        $createdProduct = Product::createForOrderProduct($product, $request->count, $request->options, $request->color);

        if(!$createdProduct)
            return redirect()->back()->with("error", "주문에 문제가 발생하였습니다. 새로고침 후 다시 시도해주세요.");

        // 상품 1개지만, 통일 형식을 위해 collection으로 처리
        return Product::where("id", $createdProduct->id)->paginate(30);
    }

    // 장바구니에 담긴 상품들을 구매할 때
    public function getCartProducts(Request $request)
    {
        $max = 300;

        $request->validate([
            "product_ids" => "required|array|min:1|max:".$max
        ]);

        return Product::where("for_order", true)->whereIn("products.id", $request->product_ids)->paginate($max);
    }
}
