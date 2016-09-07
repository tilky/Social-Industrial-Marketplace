<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTypesRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Quote purchase order table
        Schema::create('quote_type_purchase', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->timestamps();
        });

        //Quote Service Order table
        Schema::create('quote_type_service', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->timestamps();
        });
        
        //Quote Rent Lease Order table
        Schema::create('quote_type_rentlease', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
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
        Schema::drop('quote_types_relations');
    }
}
