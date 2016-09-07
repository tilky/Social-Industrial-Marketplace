<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdInAssignedTeamTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyer_team_user_assigned_buy_request', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->after('buy_request_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('buyer_team_user_assigned_quote', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->after('buyer_quote_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('supplier_team_user_lead_request', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->after('lead_request_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
