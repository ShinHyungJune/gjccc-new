<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("women_id")->nullable(); // 여자
            $table->foreign("women_id")->references("id")->on("users")->onDelete("cascade");
            $table->unsignedBigInteger("men_id")->nullable(); // 남자
            $table->foreign("men_id")->references("id")->on("users")->onDelete("cascade");
            $table->boolean("read_men")->default(false); // 남자쪽 데이팅 프로필 확인여부
            $table->boolean("read_women")->default(false); // 여자쪽 데이팅 프로필 확인여부
            $table->boolean("check_address")->default(false); // 장소 확인여부
            $table->string("address_name")->nullable(); // 장소명
            $table->string("place_name")->nullable(); // 주소
            $table->string("place_url")->nullable(); // 주소 url
            $table->string("city1")->nullable(); // 선호지역
            $table->string("area1")->nullable(); // 선호지역 구
            $table->string("city2")->nullable(); // 선호지역
            $table->string("area2")->nullable(); // 선호지역 구
            $table->string("schedule1")->nullable(); // 선호일정
            $table->string("schedule2")->nullable(); // 선호일정
            $table->string("schedule3")->nullable(); // 선호일정
            $table->string("schedule4")->nullable(); // 선호일정
            $table->string("schedule5")->nullable(); // 선호일정
            $table->dateTime("scheduled_at")->nullable(); // 최종일정
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datings');
    }
}
