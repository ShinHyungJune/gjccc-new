<?php

namespace App\Http\Resources;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            "product" => ProductResource::make($this->product),
            "order" => OrderResource::make($this->order),
            "can_refund" => $this->can_refund,
            "can_review" => $this->can_review,
            "state" => $this->state,
            "accept" => $this->accept,
            "partner" => $this->partner
        ];
    }
}
