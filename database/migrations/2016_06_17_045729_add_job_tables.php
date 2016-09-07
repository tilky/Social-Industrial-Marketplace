<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('like_to_post_as')->nullable();
            $table->string('job_type_function')->nullable();
            $table->string('job_position_title')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->tinyInteger('does_not_apply')->nullable();
            $table->string('job_type')->nullable();
            $table->tinyInteger('travel_required');
            $table->Text('how_often')->nullable();
            $table->longText('summary')->nullable();
            $table->string('experience_required')->nullable();
            $table->string('education_level')->nullable();
            $table->string('addition_qualification_requirement')->nullable();
            $table->Text('skills_expertise')->nullable();
            $table->string('compensation_type')->nullable();
            $table->string('compensation_range')->nullable();
            $table->string('additional_compensation')->nullable();
            $table->date('expiry_date');
            $table->tinyInteger('status');
            $table->date('payment_date');
            $table->tinyInteger('payment_status');
            $table->timestamps();
        });
        
        Schema::create('jobs_save', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('jobs_apply', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('jobs_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        
        DB::table('jobs_type')->insert(
            array(
                'name' => 'Production manager'
            )
        );
        
        DB::table('jobs_type')->insert(
            array(
                'name' => 'Factory Worker'
            )
        );
        
        DB::table('jobs_type')->insert(
            array(
                'name' => 'Technician'
            )
        );
        
        DB::table('jobs_type')->insert(
            array(
                'name' => 'Plumber'
            )
        );
        
        Schema::create('skills_expertise', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
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
        Schema::drop('jobs');
    }
}
