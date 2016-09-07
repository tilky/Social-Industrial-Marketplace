<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamToBuyerTeamUserAssignedBuyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_team_user_assigned_buy_request', function (Blueprint $table) {
            $table->integer('buyer_team_id')->unsigned()->after('id');
            $table->foreign('buyer_team_id')->references('id')->on('buyer_team')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyer_team_user_assigned_buy_requests', function (Blueprint $table) {
            //
        });
    }
}
