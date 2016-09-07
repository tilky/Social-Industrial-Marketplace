<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherDetailsReferralPaymentPaypalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referral_payment_paypal', function (Blueprint $table) {
            $table->string('payee_name');
            $table->string('company_name');
            $table->string('address1',255);
            $table->string('address2',255);
            $table->string('city',100);
            $table->string('state',100);
            $table->string('zip',100);
            $table->string('country',100);
            $table->string('phone',100);
            $table->string('legal_name',100);
            $table->integer('account_type');
            $table->string('social_security_number',100);
            $table->string('federal_employer_identification_number',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referral_payment_paypal', function (Blueprint $table) {
            //
        });
    }
}