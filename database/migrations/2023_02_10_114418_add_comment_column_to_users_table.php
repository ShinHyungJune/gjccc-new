<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text("comment1")->nullable();
            $table->text("comment2")->nullable();
            $table->text("comment3")->nullable();
            $table->text("comment4")->nullable();
            $table->text("comment5")->nullable();
            $table->text("comment6")->nullable();
            $table->text("comment7")->nullable();
            $table->text("comment8")->nullable();
            $table->text("comment9")->nullable();
            $table->text("comment10")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("comment1");
            $table->dropColumn("comment2");
            $table->dropColumn("comment3");
            $table->dropColumn("comment4");
            $table->dropColumn("comment5");
            $table->dropColumn("comment6");
            $table->dropColumn("comment7");
            $table->dropColumn("comment8");
            $table->dropColumn("comment9");
            $table->dropColumn("comment10");
        });
    }
}
