<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            // ID
            $table->bigIncrements('id');
            // Tiêu đề
            $table->string('title', 191)->nullable();
            // link
            $table->string('link', 191)->nullable();
            // image
            $table->string('image', 191)->nullable();
            // Nội dung
            $table->text('description')->nullable();
            // Sắp xếp
            $table->integer('orders')->default(0);
            // Trạng thái
            $table->tinyInteger('status')->default(1);
            // Thời gian
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
        Schema::dropIfExists('slides');
    }
}
