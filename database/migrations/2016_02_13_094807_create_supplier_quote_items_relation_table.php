<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierQuoteItemsRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_quote_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_quote_id')->unsigned();
            $table->foreign('supplier_quote_id')->references('id')->on('supplier_quotes')->onDelete('cascade');
            $table->string('title');
            $table->longText('description');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('max_qty');
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
        Schema::drop('supplier_quote_items');
    }
}
