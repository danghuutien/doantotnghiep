<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('phone')->nullable();
            $table->string('p_driver')->default(1); // cos choo dau xe hay k
            $table->string('image')->nullable();
            $table->text('slides')->nullable();
            $table->tinyInteger('area')->default(0); // Khu vuc
            $table->integer('province_id')->default(0);
            $table->integer('district_id')->default(0);
            $table->integer('ward_id')->default(0);
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->longText('detail')->nullable();
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
        Schema::dropIfExists('stores');
    }
}
