<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchedulesColumnToDatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datings', function (Blueprint $table) {
            $table->string("schedule6")->nullable(); // 선호일정
            $table->string("schedule7")->nullable(); // 선호일정
            $table->string("schedule8")->nullable(); // 선호일정
            $table->string("schedule9")->nullable(); // 선호일정
            $table->string("schedule10")->nullable(); // 선호일정
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datings', function (Blueprint $table) {
            $table->dropColumn("schedule6");
            $table->dropColumn("schedule7");
            $table->dropColumn("schedule8");
            $table->dropColumn("schedule9");
            $table->dropColumn("schedule10");
        });
    }
}
