<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string("type")->default(\App\Enums\NoticeType::COMMENT);
            $table->string("title"); // 제목
            $table->text("description")->nullable(); // 내용
            $table->integer("count_view")->default(0); // 조회수
            $table->boolean("important")->default(false); // 공지여부
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
        Schema::dropIfExists('notices');
    }
}
