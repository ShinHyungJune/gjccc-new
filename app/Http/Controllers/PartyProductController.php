<?php

namespace App\Http\Controllers;

use App\Enums\ProductType;
use App\Http\Resources\PayMethodResource;
use App\Http\Resources\ProductResource;
use App\Models\PayMethod;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PartyProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "state" => "nullable"
        ]);

        $request["state"] = $request->state ?? "예약중";

        $products = Product::where("origin_product_id", null)
            ->where("product_id", null)
            ->where("type", ProductType::PARTY);

        if($request->state == "마감")
            $products = $products->where("opened_at", "<=", Carbon::now());

        if($request->state == "예약중")
            $products = $products->where("opened_at", ">", Carbon::now());

        $products = $products->latest()->paginate(12);

        return Inertia::render("PartyProducts/Index", [
            "state" => $request->state,
            "products" => ProductResource::collection($products),
        ]);
    }

    public function show(Product $product)
    {
        $payMethods = PayMethod::paginate(30);

        return Inertia::render("PartyProducts/Show", [
            "product" => ProductResource::make($product),
            "payMethods" => PayMethodResource::collection($payMethods)
        ]);
    }
}
