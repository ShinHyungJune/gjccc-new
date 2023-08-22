<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Review extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "type",
        "title",
        "description",

        // 소개팅에만 쓰임
        "sex",
        "age",
        "job",
        "url",
        "platform"
    ];

    protected $appends = ["img"];

    public function registerMediaCollections():void
    {
        $this->addMediaCollection('img')->singleFile();
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

}
