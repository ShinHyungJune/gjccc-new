<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlarmContactOpenColumnToDatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datings', function (Blueprint $table) {
            $table->boolean("alarm_contact_open")->default(false);
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
            $table->dropColumn("alarm_contact_open");
        });
    }
}
