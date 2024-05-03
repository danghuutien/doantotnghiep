<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('shipping_method')->after('note')->default(1);
            $table->string('voucher_code')->after('total_price')->nullable();
            $table->integer('voucher_value')->after('voucher_code')->default(0);
            $table->string('onepay_code')->after('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('shipping_method');
            $table->dropColumn('voucher_code');
            $table->dropColumn('voucher_value');
            $table->dropColumn('onepay_code');
            $table->integer('voucher_value');
        });
    }
}
