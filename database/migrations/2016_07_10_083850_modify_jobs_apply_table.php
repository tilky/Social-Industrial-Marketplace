<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyJobsApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs_apply', function (Blueprint $table) {
            $table->string('resume')->nullable();
            $table->string('cover_latter')->nullable();
            $table->text('summary')->nullable();
            $table->string('certify_information')->nullable();
            $table->string('authorized_work')->nullable();
        });
        
        Schema::create('job_apply_note', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('job_id')->unsigned()->nullable();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('note')->nullable();
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
        Schema::table('jobs_apply', function (Blueprint $table) {
            //
        });
    }
}
