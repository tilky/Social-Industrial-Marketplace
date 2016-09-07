<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpecificationFileSupplierQuoteItemsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_quote_items', function (Blueprint $table) {
            $table->string('specification_file')->nullable();
        });
        
        Schema::table('supplier_dump_items', function (Blueprint $table) {
            $table->string('specification_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_quote_items', function (Blueprint $table) {
            //
        });
    }
}
