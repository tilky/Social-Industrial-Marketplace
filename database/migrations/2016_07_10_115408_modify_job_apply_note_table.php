<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyJobApplyNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_apply_note', function (Blueprint $table) {
            $table->integer('job_apply_id')->unsigned()->after('id');
            $table->foreign('job_apply_id')->references('id')->on('jobs_apply')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_apply_note', function (Blueprint $table) {
            //
        });
    }
}
