<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerTeamTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_team_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_team_id')->unsigned();
            $table->foreign('buyer_team_id')->references('id')->on('buyer_team')->onDelete('cascade');
            $table->integer('old_manager_id')->unsigned();
            $table->foreign('old_manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('new_manager_id')->unsigned();
            $table->foreign('new_manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('initiated_date');
            $table->tinyInteger('status');
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
        Schema::drop('buyer_team_transfers');
    }
}
