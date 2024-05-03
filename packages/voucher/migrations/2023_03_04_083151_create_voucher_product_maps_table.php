<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherProductMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_product_maps', function (Blueprint $table) {
            $table->id();
            $table->integer('voucher_id');
            $table->integer('product_id');
            $table->unique(['voucher_id', 'product_id']);
            $table->index(['voucher_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher_product_maps');
    }
}
