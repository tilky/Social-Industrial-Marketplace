<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create user details table.
        Schema::create('user_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('address1',255);
            $table->string('address2',255);
            $table->string('city',100);
            $table->string('state',100);
            $table->string('zip',100);
            $table->string('country',100);
            $table->string('phone',100);
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_profile')->onDelete('cascade');
            $table->string('account_type',100);
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
        //Drop table user details
        Schema::drop('user_details');
    }
}
