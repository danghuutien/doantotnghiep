<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->tinyInteger('gender')->after('phone')->default(1);
            $table->integer('province_id')->after('gender')->default(0);
            $table->integer('district_id')->after('province_id')->default(0);
            $table->integer('ward_id')->after('district_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('email')->after('phone');
            $table->dropColumn('gender');
            $table->dropColumn('province_id');
            $table->dropColumn('district_id');
            $table->dropColumn('ward_id');
        });
    }
}
