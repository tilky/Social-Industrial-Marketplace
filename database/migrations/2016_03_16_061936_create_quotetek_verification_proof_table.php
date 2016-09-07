<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotetekVerificationProofTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotetek_verification_proof', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotetek_verification_id')->unsigned();
            $table->string('path');
            $table->foreign('quotetek_verification_id')->references('id')->on('quotetek_verification')->onDelete('cascade');
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
        Schema::drop('quotetek_verification_proof');
    }
}
