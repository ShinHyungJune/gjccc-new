<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string("email")->unique()->nullable(); // 이름
            $table->string("contact")->nullable(); // 연락처
            $table->string("name")->nullable(); // 이름

            $table->string("sex")->nullable(); // 성별
            $table->string("birth")->nullable(); // 생년월일
            $table->string("job")->nullable(); // 직업
            $table->string("school")->nullable(); // 최종학력
            $table->string("city")->nullable(); // 거주지 시/도
            $table->string("area")->nullable(); // 거주지 구/군
            $table->string("need_service")->nullable(); // 이용예정서비스
            $table->string("registration_way")->nullable(); // 가입경로
            $table->string("city_company")->nullable(); // 근무지 시/도
            $table->string("area_company")->nullable(); // 근무지 구/군

            $table->string("tall")->nullable(); // 키
            $table->string("weight")->nullable(); // 몸무게
            $table->string("instagram")->nullable(); // 인스타그램

            $table->text("ideal")->nullable(); // 이상형
            $table->text("introduce")->nullable(); // 자기소개글
            $table->text("to_manager")->nullable(); //  매니저에게 한마디
            $table->string("marriage")->nullable(); //  결혼여부
            $table->text("comment_manager")->nullable(); // 관리자에서 매니저가 입력한 코멘트
            $table->integer("count_dating")->default(0); // 잔여데이팅 가능횟수

            $table->timestamp('verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string("social_id")->nullable();
            $table->string("social_platform")->nullable();
            $table->unique(["social_id", "social_platform"]);

            $table->text("reason_leave_out")->nullable(); // 탈퇴사유

            $table->string("account")->nullable(); // 환불계좌 계좌번호
            $table->string("bank")->nullable(); // 환불계좌 은행명
            $table->string("owner")->nullable(); // 환불계좌 예금주

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
