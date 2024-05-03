<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoldenTimeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('golden_time_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('golden_time_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('quantity_used')->default(0);
            $table->unique(['golden_time_id', 'product_id']);
            $table->index(['golden_time_id', 'product_id']);
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
        Schema::dropIfExists('golden_time_products');
    }
}
