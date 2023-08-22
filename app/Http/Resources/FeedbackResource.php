<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
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
            "user" => UserResource::make($this->user),
            "dating" => DatingResource::make($this->dating),
            "how_about_dating" => $this->how_about_dating,
            "want_after" => $this->want_after,
            "likeablility" => $this->likeablility,
            "manner" => $this->manner,
            "how_about_place" => $this->how_about_place,
            "comment" => $this->comment,
        ];
    }
}
