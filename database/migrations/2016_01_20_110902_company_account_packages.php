<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyAccountPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create company account type package table.
        Schema::create('company_account_types', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->integer('number_of_licenses_allowed')->unsigned()->nullable();
            $table->timestamps();
        });

        //Adding company package columns and other necessary columns
        Schema::table('company_profile', function ($table) {
            $table->integer('account_id')->unsigned()->nullable();
            $table->foreign('account_id')->references('id')->on('company_account_types');
            $table->integer('license_used')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop company account typ package table.
        Schema::drop('products');
    }
}
