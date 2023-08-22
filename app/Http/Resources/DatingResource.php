<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $has_new_message = 0;
        $alreadyFeedback = 0;


        if(auth()->user() && auth()->user()->feedbacks()->where("dating_id", $this->id)->first())
            $alreadyFeedback = 1;

        if($this->chat && auth()->user())
            $has_new_message = $this->chat->users()->where("user_id", auth()->id())->first()->pivot->has_new_message;

        return [
            "id" => $this->id,
            "women" => UserResource::make($this->women),
            "men" => UserResource::make($this->men),
            "read_men" => $this->read_men,
            "read_women" => $this->read_women,
            "check_address" => $this->check_address,
            "address_name" => $this->address_name,
            "place_name" => $this->place_name,
            "place_url" => $this->place_url,
            "city1" => $this->city1,
            "area1" => $this->area1,
            "city2" => $this->city2,
            "area2" => $this->area2,
            "schedule1" => $this->schedule1 ? Carbon::make($this->schedule1)->format("Y-m-d H:i") : "",
            "schedule2" => $this->schedule2 ? Carbon::make($this->schedule2)->format("Y-m-d H:i") : "",
            "schedule3" => $this->schedule3 ? Carbon::make($this->schedule3)->format("Y-m-d H:i") : "",
            "schedule4" => $this->schedule4 ? Carbon::make($this->schedule4)->format("Y-m-d H:i") : "",
            "schedule5" => $this->schedule5 ? Carbon::make($this->schedule5)->format("Y-m-d H:i") : "",
            "schedule6" => $this->schedule6 ? Carbon::make($this->schedule6)->format("Y-m-d H:i") : "",
            "schedule7" => $this->schedule7 ? Carbon::make($this->schedule7)->format("Y-m-d H:i") : "",
            "schedule8" => $this->schedule8 ? Carbon::make($this->schedule8)->format("Y-m-d H:i") : "",
            "schedule9" => $this->schedule9 ? Carbon::make($this->schedule9)->format("Y-m-d H:i") : "",
            "schedule10" => $this->schedule10 ? Carbon::make($this->schedule10)->format("Y-m-d H:i") : "",
            "scheduled_at" => $this->scheduled_at ? Carbon::make($this->scheduled_at)->format("Y-m-d H:i") : "",
            "ongoing" => $this->ongoing,
            "can_chat" => $this->can_chat,
            "has_new_message" => $has_new_message,
            "already_feedback" => $alreadyFeedback


        ];
    }
}
