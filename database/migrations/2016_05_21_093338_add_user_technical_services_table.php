<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTechnicalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_technical_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('technical_service_id')->unsigned();
            $table->foreign('technical_service_id')->references('id')->on('technical_service')->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('current_position')->after('account_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_technical_services');
    }
}
