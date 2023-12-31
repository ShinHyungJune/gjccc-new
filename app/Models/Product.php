<?php

namespace App\Models;

use App\Enums\DiscountType;
use App\Enums\OrderState;
use App\Enums\Sex;
use Carbon\Carbon;
use Carbon\Traits\Date;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\ModelTrait;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    use ModelTrait, SoftDeletes;

    protected $fillable = [
        "product_id",
        "origin_product_id",
        "title",
        "price",

        // 이 사이트 종속 특수속성
        "count_dating",
        "opened_at",
        "place",
        "address",
        "place_name",
        "age",
        "max_women",
        "max_men",
        "must_do",

        // 주문용
        /*"for_order",
        "count",
        "hide"*/
    ];

    protected $casts = [
        "opened_at" => "datetime"
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        // softDeleted
        /* self::deleted(function($model){
            $model->forOrderProducts()->delete();
        }); */
    }

    protected $appends = [
        "img",
        "imgs_party",
        "imgs_food",
        "accept_women",
        "accept_men",
        "ongoing"
    ];



    public function registerMediaCollections():void
    {
        $this->addMediaCollection('img')->singleFile();
        $this->addMediaCollection('img_show')->singleFile();
        $this->addMediaCollection('imgs_party');
        $this->addMediaCollection('imgs_food');
    }

    public function getOngoingAttribute()
    {
        return $this->opened_at > Carbon::now();
    }

    public function getAcceptWomenAttribute()
    {
        return $this->orders()->where("orders.state", OrderState::SUCCESS)->whereHas("user", function($query){
            return $query->where("sex", Sex::WOMEN);
        })->wherePivot("accept", true)->count();
    }

    public function getAcceptMenAttribute()
    {
        return $this->orders()->where("orders.state", OrderState::SUCCESS)->whereHas("user", function($query){
            return $query->where("sex", Sex::MEN);
        })->wherePivot("accept", true)->count();
    }

    public function getImgShowAttribute()
    {
        if($this->hasMedia("img_show"))
            return [
                "url" => $this->getMedia("img_show")[0]->getFullUrl(),
                "name" => $this->getMedia("img_show")[0]->file_name
            ];

        return null;
    }

    public function getImgAttribute()
    {
        if($this->hasMedia("img"))
            return [
                "url" => $this->getMedia("img")[0]->getFullUrl(),
                "name" => $this->getMedia("img")[0]->file_name
            ];

        return null;
    }

    public function getImgsPartyAttribute()
    {
        $items = [];

        if($this->hasMedia('imgs_party')) {
            $medias = $this->getMedia('imgs_party');

            foreach($medias as $media){
                $items[] = [
                    "name" => $media->file_name,
                    "url" => $media->getFullUrl()
                ];
            }
        }

        return $items;
    }

    public function getImgsFoodAttribute()
    {
        $items = [];

        if($this->hasMedia('imgs_food')) {
            $medias = $this->getMedia('imgs_food');

            foreach($medias as $media){
                $items[] = [
                    "name" => $media->file_name,
                    "url" => $media->getFullUrl()
                ];
            }
        }

        return $items;
    }

    public static function getFiltered($data)
    {
        $products = new Product();

        $products = $products->where("hide", false)
            ->where("for_order", false)
            ->where("product_id", null);

        if(isset($data["word"]))
            $products = $products->where("title", "LIKE", "%".$data["word"]."%");

        if(isset($data["category_id"]))
            $products = $products->where("category_id", $data["category_id"]);

        if(isset($data["sub_category_id"]))
            $products = $products->where("sub_category_id", $data["sub_category_id"]);

        if(isset($data["mood_id"]))
            $products = $products->where("mood_id", $data["mood_id"]);

        if(isset($data["usage_id"]))
            $products = $products->where("usage_id", $data["usage_id"]);

        return $products;
    }

    public static function createForOrderProduct($product, $count, $options = [], $color = null)
    {
        $createdProduct = Product::create(array_merge($product->toArray(), [
            "origin_product_id" => $product->id,
            "for_order" => true,
            "count" => $count,
            "color" => $color // #복붙주의 - 일반적인 쇼핑몰에선 컬러 안쓰겠지
        ]));

        /*if($product->hasMedia("img")) {
            $media = $product->getMedia('img')[0];

            $createdProduct->addMediaFromUrl($media->getFullUrl())->toMediaCollection("img", "s3");
        }*/

        if(is_array($options)){
            foreach($options as $option){
                $foundOptionProduct = $product->options()->find($option["id"]);

                if($foundOptionProduct) {
                    if(isset($option["id"]) && isset($option["count"]) && $option["count"] > 0)
                        $createdProduct->options()->create(array_merge($foundOptionProduct->toArray(), [
                            "origin_product_id" => $foundOptionProduct->id,
                            "count" => $option["count"],
                            "for_order" => true
                        ]));
                }
            }
        }

        return $createdProduct;
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot([
            "user_id",
            "state",
            "accept",
            "partner"
        ]);
    }

    public function originProduct()
    {
        return $this->belongsTo(Product::class, "origin_product_id");
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function options()
    {
        return $this->hasMany(Product::class, "product_id");
    }

    public function forOrderProducts()
    {
        return $this->hasMany(Product::class, "origin_product_id");
    }
}
