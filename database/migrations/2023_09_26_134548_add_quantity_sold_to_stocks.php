<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddQuantitySoldToStocks extends Migration
{
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->integer('quantity_sold')->default(0);
        });
    }

    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('quantity_sold');
        });
    }
}
