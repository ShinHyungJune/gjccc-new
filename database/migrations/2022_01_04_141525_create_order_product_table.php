
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->on("users")->references("id");
            $table->unsignedBigInteger("order_id");
            $table->foreign("order_id")->on("orders")->references("id");
            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->on("products")->references("id");
            $table->string("state")->default(\App\Enums\OrderProductState::FAIL);
            $table->boolean("accept")->default(false); // 파티참석권 허용여부
            $table->string("partner")->nullable(); // 파티상품 동행인 메모란
            // $table->string("product_title");
            // $table->double("product_price");
            // $table->integer("count")->default(1);
            $table->index(["order_id", "product_id"]);
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
        Schema::dropIfExists('order_product');
    }
}
