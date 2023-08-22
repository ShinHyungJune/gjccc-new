<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\VerifyNumber;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FindIdController extends Controller
{
    public function create()
    {
        return Inertia::render("FindIds/Create");
    }

    public function search(Request $request)
    {
        $request->validate([
            "contact" => "required|string|max:500"
        ]);

        $verifyNumber = VerifyNumber::where('contact', $request->contact)
            ->where('verified', true)->first();

        if(!$verifyNumber)
            return redirect()->back()->with("error", "인증된 전화번호로만 조회할 수 있습니다.");

        $ids = User::where("contact", $request->contact)->get()->pluck("email")->toArray();

        $verifyNumber->delete();

        return Inertia::render("FindIds/Search", [
            "ids" => $ids
        ]);
    }
}
