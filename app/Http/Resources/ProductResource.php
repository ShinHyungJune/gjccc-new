<?php

namespace App\Http\Resources;

use App\Models\Allergy;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dayOfWeeks = [
            "일","월","화","수","목","금","토","일"
        ];

        $openedAt = $this->opened_at ? Carbon::make($this->opened_at)->format("m.d (").$dayOfWeeks[Carbon::make($this->opened_at)->dayOfWeek].")"." ".Carbon::make($this->opened_at)->format("H:i") : "";

        $img = $this->img ? $this->img : "";
        $imgShow = $this->img_show ? $this->img_show : $this->img;
        $imgsParty = $this->imgs_party ? $this->imgs_party : "";
        $imgsFood = $this->imgs_food ? $this->imgs_food : "";

        if($this->originProduct) {
            $img = $this->originProduct->img ? $this->originProduct->img : "";
            $imgShow = $this->originProduct->img_show ?$this->originProduct->img_show  : $this->originProduct->img;
            $imgsParty = $this->originProduct->imgs_party ? $this->originProduct->imgs_party : "";
            $imgsFood = $this->originProduct->imgs_food ? $this->originProduct->imgs_food : "";
        }

        $tags = [];

        if($this->tags) {
            $items = explode("#",$this->tags);

            foreach($items as $item){
                if($item != "")
                    $tags[] = str_replace(" ", "", $item);
            }
        }

        return [
            "id" => $this->id,
            "type" => $this->type,
            "title" => $this->title,
            "price" => $this->price,
            "options" => OptionResource::collection($this->options), // 옵션상품
            "count" => $this->count, // 구매용 상품으로 만들면서 세팅된 개수
            "created_at" => Carbon::make($this->created_at)->format("Y-m-d H:i"),
            "origin_product_id" => $this->origin_product_id, // 구매용 상품으로 만들어진 경우 본래 상품 id

            "img" => $img,
            "img_show" => $imgShow,
            "imgs_party" => $imgsParty,
            "imgs_food" => $imgsFood,

            "count_dating" => $this->count_dating,
            "opened_at" => $openedAt,
            "place" => $this->place,
            "address" => $this->address,
            "age" => $this->age,
            "max_women" => $this->max_women,
            "max_men" => $this->max_men,
            "accept_women" => $this->accept_women,
            "accept_men" => $this->accept_men,
            "must_do" => $this->must_do,
            "tags" => $tags,
            "ongoing" => $this->ongoing ? 1 : 0,


            // 파티용
            "manner_time_title" => $this->manner_time_title,
            "manner_time_comment1" => $this->manner_time_comment1,
            "manner_time_comment2" => $this->manner_time_comment2,
            "manner_time_comment3" => $this->manner_time_comment3,
            "manner_time_comment4" => $this->manner_time_comment4,
            "manner_time_comment5" => $this->manner_time_comment5,

            "manner_cloth_title" => $this->manner_cloth_title,
            "manner_cloth_comment1" => $this->manner_cloth_comment1,
            "manner_cloth_comment2" => $this->manner_cloth_comment2,
            "manner_cloth_comment3" => $this->manner_cloth_comment3,
            "manner_cloth_comment4" => $this->manner_cloth_comment4,
            "manner_cloth_comment5" => $this->manner_cloth_comment5,

            "manner_attitude_title" => $this->manner_attitude_title,
            "manner_attitude_comment1" => $this->manner_attitude_comment1,
            "manner_attitude_comment2" => $this->manner_attitude_comment2,
            "manner_attitude_comment3" => $this->manner_attitude_comment3,
            "manner_attitude_comment4" => $this->manner_attitude_comment4,
            "manner_attitude_comment5" => $this->manner_attitude_comment5,
        ];
    }
}
