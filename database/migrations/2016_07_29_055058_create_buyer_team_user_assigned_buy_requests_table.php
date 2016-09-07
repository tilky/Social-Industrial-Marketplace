<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerTeamUserAssignedBuyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_team_user_assigned_buy_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_team_user_id')->unsigned();
            $table->foreign('buyer_team_user_id')->references('id')->on('buyer_team_user')->onDelete('cascade');
            $table->integer('buy_request_id')->unsigned();
            $table->foreign('buy_request_id')->references('id')->on('quotes')->onDelete('cascade');
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
        Schema::drop('buyer_team_user_assigned_buy_requests');
    }
}
