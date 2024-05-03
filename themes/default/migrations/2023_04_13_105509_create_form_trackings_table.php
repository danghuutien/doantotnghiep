<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_trackings', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->string('source')->nullable();
            $table->string('source_link')->nullable();
            $table->string('type')->nullable();
            $table->integer('type_id')->nullable();
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
        Schema::dropIfExists('form_trackings');
    }
}
