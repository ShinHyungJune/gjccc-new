<?php

namespace App\Http\Resources;

use App\Enums\OrderProductState;
use App\Enums\ProductType;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "img" => count($this->imgs) > 0 ? $this->imgs[0] : "",
            "imgs" => $this->imgs,

            "email" => $this->email,
            "contact" => $this->contact,
            "name" => $this->name,

            "displayName" => $this->nickname ?? $this->name,

            "sex" => $this->sex,
            "formatBirth" => $this->birth ? Carbon::make($this->birth)->format("Y") : "",
            "birth" => $this->birth ?? "",
            "job" => $this->job,
            "school" => $this->school,
            "city" => $this->city ?? "",
            "area" => $this->area ?? "",
            "need_service" => $this->need_service ?? "",
            "registration_way" => $this->registration_way ?? "",
            "nickname" => $this->nickname ?? "",
            "city_company" => $this->city_company ?? "",
            "area_company" => $this->area_company ?? "",
            "tall" => $this->tall,
            "weight" => $this->weight,
            "instagram" => $this->instagram,
            "ideal" => $this->ideal,
            "introduce" => $this->introduce,
            "to_manager" => $this->to_manager,
            "marriage" => $this->marriage,
            "comment_manager" => $this->comment_manager,
            "count_dating" => $this->count_dating,
            "count_matching_dating" => $this->datings()->count(),
            "count_party" => $this->orderProducts()->where("state", OrderProductState::SUCCESS)->whereHas("product", function($query){
                return $query->where("type", ProductType::PARTY)->where("opened_at", ">", Carbon::now());
            })->count(),
            "count_close_party" => $this->orderProducts()->where("state", OrderProductState::SUCCESS)->whereHas("product", function($query){
                return $query->where("type", ProductType::PARTY)->where("opened_at", "<=", Carbon::now());
            })->count(),

            "social_platform" => $this->social_platform,
            "agree_ad" => $this->agree_ad,
            "point" => $this->point,

            "owner" => $this->owner,
            "bank" => $this->bank,
            "account" => $this->account,
            "alarm" => $this->alarm,
            "agree_marketing" => $this->agree_marketing,

            "comment1" => $this->comment1,
            "comment2" => $this->comment2,
            "comment3" => $this->comment3,
            "comment4" => $this->comment4,
            "comment5" => $this->comment5,
            "comment6" => $this->comment6,
            "comment7" => $this->comment7,
            "comment8" => $this->comment8,
            "comment9" => $this->comment9,
            "comment10" => $this->comment10,

            "created_at" => $this->created_at ? Carbon::make($this->created_at)->format("Y-m-d H:i") : "",
            "updated_at" => Carbon::make($this->updated_at)->format("Y-m-d H:i")
        ];
    }
}
