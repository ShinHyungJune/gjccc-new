<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PayMethod extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ["pg", "method", "name", "commission"];

    protected $appends = ["img"];

    public function registerMediaCollections(): void
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
