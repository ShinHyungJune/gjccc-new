<?php

namespace App\Http\Controllers;

use App\Enums\OrderProductState;
use App\Enums\ProductType;
use App\Http\Resources\OrderProductResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PartyOrderProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "state" => "nullable|string|max:500"
        ]);

        $request["state"] = $request->state ?? "예약중";

        $partyOrderProducts = auth()->user()->orderProducts()->where("state", OrderProductState::SUCCESS)->whereHas("product", function($query){
            return $query->where("type", ProductType::PARTY);
        })->latest();

        if($request->state == "예약중")
            $partyOrderProducts = $partyOrderProducts->whereHas("product", function($query){
                return $query->where("opened_at", ">", Carbon::now());
            });

        if($request->state == "마감")
            $partyOrderProducts = $partyOrderProducts->whereHas("product", function($query){
                return $query->where("opened_at", "<", Carbon::now());
            });

        $partyOrderProducts = $partyOrderProducts->paginate(30);

        return Inertia::render("PartyOrderProducts/Index", [
            "state" => $request->state,
            "items" => OrderProductResource::collection($partyOrderProducts)
        ]);
    }
}
