<?php

namespace App\Http\Controllers;

use App\Models\Dating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "dating_id" => "required|integer",
            "how_about_dating" => "required|string|max:500",
            "want_after" => "required|string|max:500",
            "likeablility" => "required|integer|max:500",
            "manner" => "required|integer|max:500",
            "how_about_place" => "required|string|max:500",
            "comment" => "required|string|max:500",
        ]);

        $dating = Dating::find($request->dating_id);

        if(!$dating)
            return redirect()->back()->with("error", "존재하지 않는 소개팅입니다.");

        if(!$dating->check_address || $dating->scheduled_at > Carbon::now())
            return redirect()->back()->with("error", "마감된 소개팅에만 후기를 작성할 수 있습니다.");

        if(!$dating->where(auth()->user()->getIdColumn(), auth()->id())->first())
            return redirect()->back()->with("error", "자신이 매칭된 소개팅에만 후기를 작성할 수 있습니다.");

        if(auth()->user()->feedbacks()->where("dating_id", $dating->id)->first())
            return redirect()->back()->with("error", "이미 후기를 작성했습니다.");

        auth()->user()->feedbacks()->create($request->all());

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }
}
