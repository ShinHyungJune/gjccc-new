<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->string("state")->default(\App\Enums\RefundState::WAIT);
            $table->unsignedBigInteger("order_id")->nullable();
            $table->foreign("order_id")->references("id")->on("orders")->onDelete("cascade");
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");

            $table->text("reason_request"); // 환불사유

            $table->string("bank")->nullable(); // 환불계좌 은행
            $table->string("account")->nullable(); // 환불계좌 번호
            $table->string("owner")->nullable(); // 환불계좌 예금주

            $table->text("reason_deny")->nullable(); // 반려사유

            $table->double("price")->nullable(); // 환불가격

            $table->index(["order_id", "user_id"]);

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
        Schema::dropIfExists('refunds');
    }
}
