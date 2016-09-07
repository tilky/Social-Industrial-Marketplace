<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activity_name')->nullable();
            $table->string('activity_id',50)->nullable();
            $table->string('activity_type')->nullable();
            $table->integer('creater_id')->unsigned()->nullable();
            $table->foreign('creater_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('receiver_id')->unsigned()->nullable();
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('url')->nullable();
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
        Schema::drop('users_activity');
    }
}
