<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTeamUserAssignedLeadRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_team_user_lead_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_team_id')->unsigned();
            $table->foreign('supplier_team_id')->references('id')->on('supplier_team')->onDelete('cascade');
            $table->integer('supplier_team_user_id')->unsigned();
            $table->foreign('supplier_team_user_id')->references('id')->on('supplier_team_user')->onDelete('cascade');
            $table->integer('lead_request_id')->unsigned();
            $table->foreign('lead_request_id')->references('id')->on('quotes')->onDelete('cascade');
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
        Schema::drop('supplier_team_user_assigned_lead_requests');
    }
}
