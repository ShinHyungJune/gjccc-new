<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMannerCommentColumnToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string("manner_time_title")->nullable()->default("기본적으로 파티 시작 10분전에는
입장해주시는 것을 추천드립니다.");
            $table->string("manner_time_comment1")->nullable()->default("남녀 파티의 컨셉으로 성비 조율로 진행되어
지각하거나 불참하는 경우는 없도록 부탁드리며,
혹시나 부득이한 경우 하루 전에 알려주세요!");
            $table->string("manner_time_comment2")->nullable();
            $table->string("manner_time_comment3")->nullable();
            $table->string("manner_time_comment4")->nullable();
            $table->string("manner_time_comment5")->nullable();

            $table->string("manner_cloth_title")->nullable()->default("남녀 모두 소개팅 복장에 맞춰
깔끔하고 예의 있는 의상을 갖춰주세요.");
            $table->string("manner_cloth_comment1")->nullable()->default("여성분의 경우, 원피스나 투피스를 추천드립니다.");
            $table->string("manner_cloth_comment2")->nullable()->default("남성분의 경우, 수트나 셔츠류를 추천드립니다.");
            $table->string("manner_cloth_comment3")->nullable();
            $table->string("manner_cloth_comment4")->nullable();
            $table->string("manner_cloth_comment5")->nullable();

            $table->string("manner_attitude_title")->nullable()->default("와인파티가 진행되는 동안
기본적인 매너는 지켜주세요.");
            $table->string("manner_attitude_comment1")->nullable()->default("과한 주류섭취, 무례한 대화 등");
            $table->string("manner_attitude_comment2")->nullable();
            $table->string("manner_attitude_comment3")->nullable();
            $table->string("manner_attitude_comment4")->nullable();
            $table->string("manner_attitude_comment5")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
