<?php

namespace App\Http\Resources;

use App\Enums\NoticeType;
use App\Models\Notice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DatingNoticeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $next = Notice::find(Notice::where("type", NoticeType::DATING)->where('id', '<', $this->id)->max('id'));

        $prev = Notice::find(Notice::where("type", NoticeType::DATING)->where('id', '>', $this->id)->min('id'));

        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "important" => $this->important,
            "year" => Carbon::make($this->created_at)->format("y"),
            "month" => Carbon::make($this->created_at)->format("m"),
            "date" => Carbon::make($this->created_at)->format("d"),
            "prev" => $prev ?? "",
            "next" => $next ?? "",
            "created_at" => Carbon::make($this->created_at)->format("Y.m.d")
        ];
    }
}
