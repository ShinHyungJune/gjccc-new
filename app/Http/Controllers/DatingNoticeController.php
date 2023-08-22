<?php

namespace App\Http\Controllers;

use App\Enums\NoticeType;
use App\Http\Resources\CommentNoticeResource;
use App\Http\Resources\DatingNoticeResource;
use App\Models\Notice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DatingNoticeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "word" => "nullable|string|max:500"
        ]);

        $notices = Notice::where("type", NoticeType::DATING);

        if($request->word)
            $notices = $notices->where("title", "LIKE", "%".$request->word."%");

        $notices = $notices->orderBy("important", "desc")->paginate(10);

        return Inertia::render("DatingNotices/Index", [
            "items" => DatingNoticeResource::collection($notices),
            "word" => $request->word
        ]);
    }

    public function show(Notice $notice)
    {
        return Inertia::render("DatingNotices/Show", [
            "item" => DatingNoticeResource::make($notice)
        ]);
    }
}
