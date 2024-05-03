<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('name'); // Tên file
            $table->bigInteger('size')->nullable(); // Kích cỡ
            $table->string('type')->nullable(); // Phân Loại file: image | file
            $table->string('title')->nullable(); // Tiêu đề
            $table->string('caption')->nullable(); // Mô tả
            $table->string('extention')->nullable(); // Đuôi file
            $table->tinyInteger('status')->default(1); // Trạng thái
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
        Schema::dropIfExists('medias');
    }
}
