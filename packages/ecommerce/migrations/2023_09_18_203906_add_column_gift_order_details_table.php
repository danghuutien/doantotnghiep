<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnGiftOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->longText('gift_other')->nullable();
            $table->longText('gift_products')->nullable();
            $table->boolean('isgoldentime')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('gift_other')->nullable();
            $table->dropColumn('gift_products')->nullable();
            $table->dropColumn('isgoldentime');
        });
    }
}
