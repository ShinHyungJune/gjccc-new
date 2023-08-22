<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends ApiController
{
    public function search(Request $request)
    {
        $request->validate([
            "word" => "required|string|max:5000"
        ]);

        $url = "https://dapi.kakao.com/v2/local/search/keyword.json?query={{$request->word}}";

        $response = Http::withHeaders([
            "Authorization" => "KakaoAK c586e8748f85b41f7f33f6ebe9ea2891"
        ])->get($url);

        return $this->respond($response->body());

        /* let targetPlace = response.data.documents[0];

             if(targetPlace){
                 this.form.address_name = targetPlace.address_name;
                 this.form.place_name = targetPlace.place_name;
                 this.form.place_url = targetPlace.place_url;
             }

         })
     */
    }
}
