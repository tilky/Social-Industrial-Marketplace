<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTeamTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_team_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_team_id')->unsigned();
            $table->foreign('supplier_team_id')->references('id')->on('supplier_team')->onDelete('cascade');
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
        Schema::drop('supplier_team_tags');
    }
}
