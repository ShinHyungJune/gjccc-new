<?php

namespace App\Http\Controllers;

use App\Enums\FaqType;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentNoticeResource;
use App\Http\Resources\ReviewResource;
use App\Models\Faq;
use App\Models\Notice;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "word" => "nullable|string|max:500"
        ]);

        $notices = new Notice();

        if($request->word)
            $notices = $notices->where("title", "LIKE", "%".$request->word."%")
                ->orWhere("description", "LIKE", "%".$request->word."%");

        $notices = $notices->orderBy("important", "desc")->paginate(10);

        return Inertia::render("Notices/Index", [
            "notices" => CommentNoticeResource::collection($notices),
            "word" => $request->word
        ]);
    }

    public function show(Notice $notice)
    {
        return Inertia::render("Notices/Show", [
            "item" => ReviewResource::make($notice)
        ]);
    }
}
