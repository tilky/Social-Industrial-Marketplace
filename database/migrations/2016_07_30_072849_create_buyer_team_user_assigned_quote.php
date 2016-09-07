<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerTeamUserAssignedQuote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_team_user_assigned_quote', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_team_id')->unsigned();
            $table->foreign('buyer_team_id')->references('id')->on('buyer_team')->onDelete('cascade');
            $table->integer('buyer_team_user_id')->unsigned();
            $table->foreign('buyer_team_user_id')->references('id')->on('buyer_team_user')->onDelete('cascade');
            $table->integer('buyer_quote_id')->unsigned();
            $table->foreign('buyer_quote_id')->references('id')->on('quotes')->onDelete('cascade');
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
        Schema::drop('buyer_team_user_assigned_quote');
    }
}
