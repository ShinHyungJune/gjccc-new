<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user->id,
            "user" => [
                "id" => $this->user->id
            ],
            "chat_id" => $this->chat->id,
            "body" => $this->body,
            "created_at" => Carbon::make($this->created_at)->format("H:i")
        ];
    }
}
