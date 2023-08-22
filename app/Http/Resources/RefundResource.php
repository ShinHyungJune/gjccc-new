<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RefundResource extends JsonResource
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
            "state" => $this->state,

            "reason_request" => $this->reason_request,
            "reason_deny" => $this->reason_deny,
            "order" => OrderResource::make($this->order),

            "bank" => $this->bank,
            "account" => $this->account,
            "owner" => $this->owner,

            "price" => $this->price,

            "created_at" => Carbon::make($this->created_at)->format("Y.m.d"),
        ];
    }
}
