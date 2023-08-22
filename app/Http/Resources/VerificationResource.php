<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VerificationResource extends JsonResource
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
            "imp_uid" => $this->imp_uid,
            "phone" => $this->phone ?? "",
            "name" => $this->name ?? "",
            "birth" => Carbon::make($this->birth)->format("Y-m-d") ?? "",
            "sex" => $this->sex ?? "",
        ];
    }
}
