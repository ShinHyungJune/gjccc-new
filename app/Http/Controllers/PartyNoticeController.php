<?php

namespace App\Http\Controllers;

use App\Enums\NoticeType;
use App\Http\Resources\DatingNoticeResource;
use App\Http\Resources\PartyNoticeResource;
use App\Models\Notice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PartyNoticeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "word" => "nullable|string|max:500"
        ]);

        $notices = Notice::where("type", NoticeType::PARTY);

        if($request->word)
            $notices = $notices->where("title", "LIKE", "%".$request->word."%");

        $notices = $notices->orderBy("important", "desc")->paginate(10);

        return Inertia::render("PartyNotices/Index", [
            "items" => PartyNoticeResource::collection($notices),
            "word" => $request->word
        ]);
    }

    public function show(Notice $notice)
    {
        return Inertia::render("PartyNotices/Show", [
            "item" => PartyNoticeResource::make($notice)
        ]);
    }
}
