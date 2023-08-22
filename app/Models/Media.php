<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Media extends BaseMedia
{
    public static function getSingleMedia($model, $collection)
    {
        if($model->hasMedia($collection)) {
            $media = $model->getMedia($collection)[0];

            return [
                "name" => $media->file_name,
                "type" => $media->mime_type,
                "url" => $media->getFullUrl(),
            ];
        }

        return null;
    }

    public static function getMultipleMedia($model, $collection)
    {
        $items = [];

        if($model->hasMedia($collection)) {
            $medias = $model->getMedia('imgs');

            foreach($medias as $media){
                $items[] =  [
                    "name" => $media->file_name,
                    "type" => $media->mime_type,
                    "url" => $media->getFullUrl(),
                ];
            }
        }

        return $items;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
