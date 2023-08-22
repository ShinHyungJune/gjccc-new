<?php

namespace App\Http\Controllers\Shopping;

use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use App\Http\Resources\OrderProductResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = auth()->user()->reviews()->whereNotNull("order_product_id")->latest()->paginate(8);

        return Inertia::render("Shopping/Reviews/Index", [
            "reviews" => ReviewResource::collection($reviews)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "order_product_id" => "required|integer",
            "title" => "required|string|max:5000",
            "description" => "required|string|max:50000",
            "point" => "required|integer|min:1|max:5",
            "photo" => "required|boolean",
            "imgs" => "nullable|array|max:5"
        ]);

        $orderProduct = OrderProduct::find($request->order_product_id);

        if(!$orderProduct)
            return redirect()->back()->with("error", "존재하지 않는 주문상품입니다.");

        if(!$orderProduct->can_review)
            return redirect()->back()->with("error", "해당 주문상품에 대해 리뷰를 작성할 수 없습니다.");

        $review = auth()->user()->reviews()->create(array_merge($request->all(),[
            "product_id" => $orderProduct->product->id,
        ]));

        if($request->imgs){
            foreach($request->file("imgs") as $img){
                $review->addMedia($img)->toMediaCollection("imgs", "s3");
            }
        }

        return redirect("/shopping/reviews")->with("success", "성공적으로 처리되었습니다.");
    }

    public function create(Request $request)
    {
        $request->validate([
            "order_product_id" => "required|integer"
        ]);

        $orderProduct = OrderProduct::find($request->order_product_id);
;
        if(!$orderProduct)
            return redirect()->back()->with("error", "존재하지 않는 주문상품입니다.");

        return Inertia::render("Shopping/Reviews/Create", [
            "orderProduct" => OrderProductResource::make($orderProduct)
        ]);
    }
}
