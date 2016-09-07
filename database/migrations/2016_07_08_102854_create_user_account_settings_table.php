<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_account_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('import_message');
            $table->tinyInteger('new_message');
            $table->tinyInteger('new_job');
            $table->tinyInteger('new_market');
            $table->tinyInteger('default_account_mode');
            $table->string('time_zone')->nullable();
            $table->tinyInteger('profile_in_ij');
            $table->tinyInteger('profile_in_others');
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
        Schema::drop('user_account_settings');
    }
}
