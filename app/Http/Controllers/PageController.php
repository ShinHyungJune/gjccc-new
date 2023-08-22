<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PopResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Models\Pop;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pops = Pop::latest()->paginate(30);

        return Inertia::render("Index", [
            "pops" => PopResource::collection($pops),
        ]);
    }

    public function story(Request $request)
    {
        return Inertia::render("Contents/Story", [

        ]);
    }

    public function privacy01(Request $request)
    {
        return Inertia::render("Contents/Privacy01", [

        ]);
    }

    public function privacy02(Request $request)
    {
        return Inertia::render("Contents/Privacy02", [

        ]);
    }

    public function privacy03(Request $request)
    {
        return Inertia::render("Contents/Privacy03", [

        ]);
    }

    public function privacy04(Request $request)
    {
        return Inertia::render("Contents/Privacy04", [

        ]);
    }


}
