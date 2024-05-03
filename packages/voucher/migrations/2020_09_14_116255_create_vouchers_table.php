<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('code')->unique();
            $table->tinyInteger('type')->default(0);
            $table->integer('max_value')->default(0);
            $table->integer('value')->default(0);
            $table->integer("min_order")->default(0);
            $table->integer('limit')->default(1);
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
        Schema::dropIfExists('vouchers');
    }
}
