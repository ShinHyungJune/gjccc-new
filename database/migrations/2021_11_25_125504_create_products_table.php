<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("origin_product_id")->nullable();
            $table->foreign("origin_product_id")->references("id")->on("products")->onDelete("cascade");
            $table->unsignedBigInteger("product_id")->nullable();
            $table->foreign("product_id")->references("id")->on("products")->onDelete("cascade");
            $table->string("title")->nullable(); // 제품명
            $table->double("price")->nullable(); // 가격
            $table->integer("count")->nullable(); // 장바구니 | 구매할 때 설정한 개수

            $table->string("type")->default(\App\Enums\ProductType::DATING); // 상품유형

            // 소개팅용
            $table->integer("count_dating")->nullable(); // 구매 시 줄 소개팅 횟수

            // 파티용
            $table->dateTime("opened_at")->nullable(); // 파티 오픈일자
            $table->string("place")->nullable(); // 표시용 주소
            // $table->string("address")->nullable(); // 진짜 주소
            $table->string("age")->nullable(); // 표시용 장소
            $table->string("max_women")->nullable(); // 여자 최대참여수
            $table->string("max_men")->nullable(); // 남자 최대참여수
            $table->string("must_do")->nullable(); // 필수사항

            $table->text("tags")->nullable(); // 해시태그

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
