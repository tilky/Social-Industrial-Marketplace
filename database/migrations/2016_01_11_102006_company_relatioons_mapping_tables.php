<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyRelatioonsMappingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create company technical services.
        Schema::create('company_technical_services', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_profile')->onDelete('cascade');
            $table->integer('technical_service_id')->unsigned();
            $table->foreign('technical_service_id')->references('id')->on('technical_service')->onDelete('cascade');
            $table->tinyInteger('is_active');
            $table->timestamps();
        });

        //Create company accreditations.
        Schema::create('company_accreditations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_profile')->onDelete('cascade');
            $table->integer('accreditations_id')->unsigned();
            $table->foreign('accreditations_id')->references('id')->on('accreditations')->onDelete('cascade');
            $table->tinyInteger('is_active');
            $table->timestamps();
        });

        //Create company quality standards table.
        Schema::create('company_quality_standards', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_profile')->onDelete('cascade');
            $table->integer('quality_standards_id')->unsigned();
            $table->foreign('quality_standards_id')->references('id')->on('quality_standards')->onDelete('cascade');
            $table->tinyInteger('is_active');
            $table->timestamps();
        });

        //Create company shipping preference table
        Schema::create('company_shipping_preference', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_profile')->onDelete('cascade');
            $table->integer('shipping_preference_id')->unsigned();
            $table->foreign('shipping_preference_id')->references('id')->on('shipping_preference')->onDelete('cascade');
            $table->tinyInteger('is_active');
            $table->timestamps();
        });

        //Create company main markets table
        Schema::create('company_main_markets', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_profile')->onDelete('cascade');
            $table->integer('main_markets_id')->unsigned();
            $table->foreign('main_markets_id')->references('id')->on('main_markets')->onDelete('cascade');
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
        //Dropping all the relations tables.
        Schema::drop('company_technical_services');
        Schema::drop('company_accreditations');
        Schema::drop('company_quality_standards');
        Schema::drop('company_shipping_preference');
        Schema::drop('company_main_markets');
    }
}
