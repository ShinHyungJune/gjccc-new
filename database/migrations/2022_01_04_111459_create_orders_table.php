<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string("imp_uid")->unique()->nullable(); // 주문 번호(아임포트측에서 넘겨주는 id)
            $table->string("merchant_uid")->unique()->index(); // 주문 번호(우리 서비스에서 만드는 id)

            // 주문자
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->on("users")->references("id");
            $table->string("user_name")->nullable(); // 주문자명

            $table->string("product_title")->nullable(); // 상품명

            // 결제수단
            $table->unsignedBigInteger("pay_method_id");
            $table->foreign("pay_method_id")->on("pay_methods")->references("id");
            $table->string("pay_method_name");
            $table->string("pay_method_pg");
            $table->string("pay_method_method");
            $table->string("pay_method_commission");

            // 금액
            $table->double("price"); // 총 금액

            // 환불계좌
            $table->string("refund_owner")->nullable(); // 환불계좌 예금주
            $table->string("refund_bank")->nullable(); // 환불계좌 은행명
            $table->string("refund_account")->nullable(); // 환불계좌 계좌번호

            $table->string("state")->default(\App\Enums\OrderState::FAIL);
            $table->text("reason")->nullable(); // 결제실패사유

            $table->string("service_time")->nullable(); // #복붙주의 - 서비스가능시간

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
        Schema::dropIfExists('orders');
    }
}
