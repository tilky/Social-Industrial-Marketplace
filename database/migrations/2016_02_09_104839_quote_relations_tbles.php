<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuoteRelationsTbles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Quote diversity options table
        Schema::create('quote_diversity_options', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('diversity_option_id')->unsigned();
            $table->foreign('diversity_option_id')->references('id')->on('diversity_options')->onDelete('cascade');
            $table->timestamps();
        });

        //Quote diversity options table
        Schema::create('quote_accreditations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('accreditations_id')->unsigned();
            $table->foreign('accreditations_id')->references('id')->on('accreditations')->onDelete('cascade');
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
        //
    }
}
