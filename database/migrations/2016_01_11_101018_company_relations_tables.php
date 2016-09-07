<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyRelationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create technical services table.
        Schema::create('technical_service', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('is_active');
            $table->timestamps();
        });

        //Create accreditations table.
        Schema::create('accreditations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('is_active');
            $table->timestamps();
        });

        //Create quality standards table.
        Schema::create('quality_standards', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('is_active');
            $table->timestamps();
        });

        //Create shipping preference table.
        Schema::create('shipping_preference', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('is_active');
            $table->timestamps();
        });

        //Create shipping preference table.
        Schema::create('main_markets', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('is_active');
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
        //drop technical service table.
        Schema::drop('technical_service');
        Schema::drop('accreditations');
        Schema::drop('quality_standards');
        Schema::drop('shipping_preference');
        Schema::drop('main_markets');
    }
}
