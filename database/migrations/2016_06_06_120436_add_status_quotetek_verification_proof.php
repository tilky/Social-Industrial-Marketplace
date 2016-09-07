<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusQuotetekVerificationProof extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotetek_user_verification', function (Blueprint $table) {
            $table->tinyInteger('status')->after('payment');
        });
        Schema::table('quotetek_company_verification', function (Blueprint $table) {
            $table->tinyInteger('status')->after('payment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotetek_user_verification', function (Blueprint $table) {
            //
        });
    }
}
