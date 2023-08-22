<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Http\Resources\ChatResource;
use App\Http\Resources\MessageResource;
use App\Http\Resources\UserResource;
use App\Models\Chat;
use App\Models\Dating;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function show(Dating $dating)
    {
        $chat = Chat::where("dating_id", $dating->id)->first();

        if(!$chat){
            $chat = Chat::create([
                "dating_id" => $dating->id
            ]);

            $chat->users()->attach($dating->women->id);
            $chat->users()->attach($dating->men->id);
        }

        $chat->users()->updateExistingPivot(auth()->id(), [
            "has_new_message" => 0
        ]);

        $messages = $chat->messages()->orderBy("created_at", "asc")->paginate(300);

        return Inertia::render("Chats/Show", [
            "chat" => ChatResource::make($chat),
            "messages" => MessageResource::collection($messages),
        ]);
    }
}
