<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerTeamTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_team_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_team_id')->unsigned();
            $table->foreign('buyer_team_id')->references('id')->on('buyer_team')->onDelete('cascade');
            $table->string('tag');
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
        Schema::drop('buyer_team_tags');
    }
}
