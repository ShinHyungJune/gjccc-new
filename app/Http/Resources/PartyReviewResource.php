<?php

namespace App\Http\Resources;

use App\Enums\ProductType;
use App\Models\Dating;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PartyReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $next = Review::find(Review::where("type", ProductType::PARTY)->where('id', '<', $this->id)->max('id'));

        $prev = Review::find(Review::where("type", ProductType::PARTY)->where('id', '>', $this->id)->min('id'));

        return [
            "id" => $this->id,
            "type" => $this->type,
            "title" => $this->title,
            "description" => $this->description,
            "sex" => $this->sex,
            "age" => $this->age,
            "job" => $this->job,
            "img" => $this->img ?? "",
            "prev" => $prev ?? "",
            "next" => $next ?? "",
            "created_at" => Carbon::make($this->created_at)->format("Y.m.d")
        ];
    }
}
