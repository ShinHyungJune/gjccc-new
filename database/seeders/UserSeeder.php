<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Mood;
use App\Models\PrevMember;
use App\Models\Product;
use App\Models\RecommendProduct;
use App\Models\SubCategory;
use App\Models\Usage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::statement("SET foreign_key_checks=0");
        User::truncate();
        DB::statement("SET foreign_key_checks=1");
*/

        User::find(1)->delete();
        User::find(2)->delete();
        User::find(3)->delete();
        User::find(4)->delete();
        /*$prevMembers = PrevMember::cursor();

        foreach($prevMembers as $prevMember){
            User::create([
                "ids" => $prevMember["mb_id"],
                "name" => $prevMember["mb_name"],
                "contact" => $prevMember["mb_tel"],
                "point" => $prevMember["mb_point"],
                "email" => $prevMember["mb_email"],
            ]);
        }*/
    }
}
