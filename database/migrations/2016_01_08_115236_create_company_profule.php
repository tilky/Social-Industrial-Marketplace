<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProfule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create Company Profile Table.
        Schema::create('company_profile', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->tinyInteger('is_active');
            $table->integer('industry_id')->unsigned();
            $table->foreign('industry_id')->references('id')->on('industry')->onDelete('cascade');
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
        //Drop table company profile
        Schema::drop('company_profile');
    }
}
