<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create quote table.
        Schema::create('quotes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->longText('specifications');
            $table->tinyInteger('verified_only');
            $table->integer('privacy');
            $table->date('expiry_date');
            $table->integer('request_area');
            $table->string('additional_file');
            $table->tinyInteger('status');
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
