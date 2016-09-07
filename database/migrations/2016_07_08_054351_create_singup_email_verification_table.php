<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSingupEmailVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('singup_email_verification', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('verification_code')->nullable();
            $table->date('expiry_date');
            $table->tinyInteger('status')->nullable();
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
        Schema::drop('singup_email_verification');
    }
}
