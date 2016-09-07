<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuoteRelationSupplierQuote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_quotes', function (Blueprint $table) {
            $table->integer('buyer_quote_id')->unsigned()->nullable();
            $table->foreign('buyer_quote_id')->references('id')->on('quotes')->onDelete('cascade');
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
            $table->dropColumn('buyer_quote_id');
        });
    }
}
