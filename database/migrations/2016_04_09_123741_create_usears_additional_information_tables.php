<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsearsAdditionalInformationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('language_spoken')->nullable();
            $table->string('profile_slogan')->nullable();
        });
        
        //Create user additional Industriers table.
        Schema::create('user_additional_industries', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('industry_id')->unsigned()->nullable();
            $table->foreign('industry_id')->references('id')->on('industry')->onDelete('cascade');
            $table->timestamps();
        });
        
        //Create user categories table.
        Schema::create('user_categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
        
        //Create user jobs table.
        Schema::create('user_jobs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('job_title');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name');
            $table->string('location');
            $table->date('date_from');
            $table->date('date_to');
            $table->timestamps();
        });
        
        //Create user Education Details table.
        Schema::create('user_education_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('degree');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('institute_name');
            $table->string('location');
            $table->date('date_received');
            $table->timestamps();
        });
        
        //Create user Certifications table.
        Schema::create('user_certifications', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('certification_name');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('certifying_authority');
            $table->date('date_received');
            $table->date('valid_till');
            $table->timestamps();
        });
        
        //Create user awards table.
        Schema::create('user_awards', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('awards_name');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('awarding_authority');
            $table->date('date_received');
            $table->string('location');
            $table->timestamps();
        });
        
        //Create member organizations table.
        Schema::create('user_member_organizations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('postion');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('membership_organization');
            $table->date('member_since');
            $table->date('valid_till');
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
        //Schema::drop('users_additional_informations');
    }
}
