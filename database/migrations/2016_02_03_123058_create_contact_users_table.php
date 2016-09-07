<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_user_id')->unsigned();
            $table->foreign('sender_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('sender_user_company_id')->unsigned();
            $table->foreign('sender_user_company_id')->references('id')->on('company_profile')->onDelete('cascade');
            $table->integer('request_user_id')->unsigned();
            $table->foreign('request_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('request_user_company_id')->unsigned();
            $table->foreign('request_user_company_id')->references('id')->on('company_profile')->onDelete('cascade');
            $table->tinyInteger('status')->nullable();
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
        Schema::drop('contact_users');
    }
}
