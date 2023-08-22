<?php

namespace App\Http\Controllers;

use App\Enums\OrderState;
use App\Enums\RefundState;
use App\Enums\RefundType;
use App\Http\Resources\BannerResource;
use App\Http\Resources\EventBannerResource;
use App\Http\Resources\OrderProductResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\RefundResource;
use App\Models\EventBanner;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Refund;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RefundController extends Controller
{
    public function index(Request $request)
    {
        $refunds = auth()->user()->refunds()->latest()->paginate(10);

        return Inertia::render("Refunds/Index", [
            "refunds" => RefundResource::collection($refunds),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "order_id" => "required|integer",
            "reason_request" => "required|string|max:50000",
            "bank" => "nullable|string|max:50000",
            "account" => "nullable|string|max:50000",
            "owner" => "nullable|string|max:50000",
        ]);

        $order = Order::find($request->order_id);

        if(!$order)
            return redirect()->back()->with("error", "존재하지 않는 주문상품입니다.");

        if($order->user_id != auth()->id())
            return redirect()->back()->with("error", "자신의 주문건만 반품요청할 수 있습니다.");

        if(!$order->can_refund)
            return redirect()->back()->with("error", "반품요청 할 수 없는 주문입니다.");

        $refund = auth()->user()->refunds()->create(array_merge($request->all()));

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }

    public function check(Refund $refund)
    {
        if($refund->user_id != auth()->id())
            return redirect()->back()->with("error", "자신의 환불건만 확인할 수 있습니다.");

        $refund->update(["state"=> RefundState::SUCCESS]);

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }
}
