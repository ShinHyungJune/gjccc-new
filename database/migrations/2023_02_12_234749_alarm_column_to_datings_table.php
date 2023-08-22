<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlarmColumnToDatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datings', function (Blueprint $table) {
            $table->boolean("alarm_chat_open")->default(false);
            $table->boolean("alarm_date_open")->default(false);
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
            $table->dropColumn("alarm_chat_open");
            $table->dropColumn("alarm_date_open");
        });
    }
}
