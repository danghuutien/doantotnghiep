<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoldenTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('golden_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->longText('gift_other')->nullable();
            $table->longText('gift_products')->nullable();
            $table->integer('used')->default(0);
            $table->datetime('start_time')->nullable();
            $table->datetime('end_time')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('golden_times');
    }
}
