<?php

namespace App\Http\Controllers;

use App\Enums\NoticeType;
use App\Http\Resources\CommentNoticeResource;
use App\Models\Notice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentNoticeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "word" => "nullable|string|max:500"
        ]);

        $notices = Notice::where("type", NoticeType::COMMENT);

        if($request->word)
            $notices = $notices->where("title", "LIKE", "%".$request->word."%");

        $notices = $notices->orderBy("important", "desc")->paginate(10);

        return Inertia::render("CommentNotices/Index", [
            "items" => CommentNoticeResource::collection($notices),
            "word" => $request->word
        ]);
    }

    public function show(Notice $notice)
    {
        return Inertia::render("CommentNotices/Show", [
            "item" => CommentNoticeResource::make($notice)
        ]);
    }
}
