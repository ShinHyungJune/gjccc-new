<?php

namespace App\Http\Controllers;

use App\Enums\AlarmType;
use App\Enums\MessageType;
use App\Enums\OrderState;
use App\Events\MessageCleared;
use App\Events\MessageCreated;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\ChatCollection;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Models\Alarm;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\RequestEdit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends ApiController
{
    public function store(Request $request)
    {
        $request->validate([
            "chat_id" => "required|integer",
            "body" => "nullable|string|max:500",
        ]);

        $message = null;

        $chat = Chat::find($request->chat_id);

        if(!$chat)
            return redirect()->back()->with("error", "존재하지 않는 폭탄방입니다");

        if(!$chat->users->contains(auth()->id()))
            return redirect()->back()->with("error", "멤버만 폭탄방을 이용할 수 있습니다");

        $message = $chat->messages()->create([
            "user_id" => auth()->id(),
            "body" => $request->body,
        ]);

        $members = $chat->users()->where("user_id", "!=", auth()->id())->cursor();

        foreach($members as $member){
            $member->chats()->updateExistingPivot($chat->id, [
                "has_new_message" => true
            ]);
        }

        /*foreach($members as $member){
            Alarm::create([
                "user_id" => $member->id,
                "type" => AlarmType::MESSAGE_CREATE,
                "message_id" => $message->id,
                "only_push"=> true
            ]);
        }*/

        event(new MessageCreated($message));

        return redirect()->back();
    }
}
