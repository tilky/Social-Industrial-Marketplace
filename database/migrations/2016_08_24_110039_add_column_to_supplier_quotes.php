<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToSupplierQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_quotes', function (Blueprint $table) {
            $table->string('shipping_charge')->nullable();
            $table->string('shipping_charge_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_quotes', function (Blueprint $table) {
            //
        });
    }
}
