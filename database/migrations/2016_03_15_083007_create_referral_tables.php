<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('referral_code')->nullable();
            $table->timestamps();
        });
        
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referral_by')->unsigned();
            $table->foreign('referral_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('referral_to')->unsigned();
            $table->foreign('referral_to')->references('id')->on('users')->onDelete('cascade');
            $table->integer('referral_link_id')->unsigned();
            $table->foreign('referral_link_id')->references('id')->on('referrals_links')->onDelete('cascade');
            $table->tinyInteger('is_active')->nullable();
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
        Schema::drop('referrals_links');
        Schema::drop('referrals');
    }
}
