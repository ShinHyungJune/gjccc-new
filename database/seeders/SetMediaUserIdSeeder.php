<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class SetMediaUserIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medias = Media::cursor();

        foreach($medias as $media){
            if($media->model_type === User::class)
                $media->update(["user_id" => $media->model_id]);
        }
    }
}
