<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallMeBackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_me_backs', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('name');
            $table->string('current_page');
            $table->tinyInteger('active_status')->default(0); //0 : chờ xử lý, 1 : đã gọi khách
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
        Schema::dropIfExists('call_me_backs');
    }
}
