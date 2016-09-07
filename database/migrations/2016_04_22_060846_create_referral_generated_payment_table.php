<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferralGeneratedPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('referral_user_id')->unsigned();
            $table->foreign('referral_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('referral_id')->unsigned();
            $table->foreign('referral_id')->references('id')->on('referrals')->onDelete('cascade');
            $table->integer('subscription_id')->unsigned();
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->string('amount');
            $table->timestamps();
        });
        Schema::table('referrals', function ($table) {
    		$table->tinyInteger('paid_referral_by')->nullable();
		}); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('referral_payment');
    }
}
