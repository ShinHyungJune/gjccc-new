<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pop extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ["title", "hide_at", "url"];

    // protected $appends = ["pc", "mobile"];
    protected $appends = ["img", "hide"];

    protected $casts = [
        "hide_at" => "datetime"
    ];

    public function registerMediaCollections():void
    {
        $this->addMediaCollection('img')->singleFile();
        $this->addMediaCollection('pc')->singleFile();
        $this->addMediaCollection('m')->singleFile();
    }

    public function getImgAttribute()
    {
        if($this->hasMedia('img')) {
            $media = $this->getMedia('img')[0];

            return [
                "name" => $media->file_name,
                "url" => $media->getFullUrl()
            ];
        }

        return null;
    }

    public function getHideAttribute()
    {
        return Carbon::now() < Carbon::make($this->hide_at);
    }


    /*
    public function getPcAttribute()
    {
        if($this->hasMedia('pc')) {
            $media = $this->getMedia('pc')[0];

            return [
                "name" => $media->file_name,
                "url" => $media->getFullUrl()
            ];
        }

        return null;
    }

    public function getMobileAttribute()
    {
        if($this->hasMedia('mobile')) {
            $media = $this->getMedia('mobile')[0];

            return [
                "name" => $media->file_name,
                "url" => $media->getFullUrl()
            ];
        }

        return null;
    }*/
}
