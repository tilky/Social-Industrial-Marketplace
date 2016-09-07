<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotetekVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotetek_verification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('apply')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('driving_license')->nullable();
            $table->string('state_id_card')->nullable();
            $table->string('ref_1_name')->nullable();
            $table->string('ref_1_phone')->nullable();
            $table->string('ref_1_email')->nullable();
            $table->string('ref_1_relation')->nullable();
            $table->string('ref_1_description')->nullable();
            $table->string('ref_2_name')->nullable();
            $table->string('ref_2_phone')->nullable();
            $table->string('ref_2_email')->nullable();
            $table->string('ref_2_relation')->nullable();
            $table->string('ref_2_description')->nullable();
            $table->tinyInteger('is_active')->nullable();
            $table->timestamps();
        });
        
        Schema::table('users', function ($table) {
            $table->tinyInteger('quotetek_verify')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quotetek_verification');
    }
}
