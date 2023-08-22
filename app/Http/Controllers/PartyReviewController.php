<?php

namespace App\Http\Controllers;

use App\Enums\ProductType;
use App\Http\Resources\PartyReviewResource;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PartyReviewController extends Controller
{
    public function index(Request $request)
    {
        $items = Review::where("type", ProductType::PARTY)->latest()->paginate(12);

        return Inertia::render("PartyReviews/Index", [
            "items" => PartyReviewResource::collection($items)
        ]);
    }

    public function show(Review $review)
    {
        return Inertia::render("PartyReviews/Show", [
            "item" => PartyReviewResource::make($review)
        ]);
    }
}
