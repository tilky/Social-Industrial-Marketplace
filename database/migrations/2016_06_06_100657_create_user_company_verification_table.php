<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompanyVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotetek_user_verification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('utility_bill_path')->nullable();
            $table->string('state_id_path')->nullable();
            $table->tinyInteger('linkedin_vification');
            $table->tinyInteger('payment');
            $table->timestamps();
        });
        
        Schema::create('quotetek_company_verification', function (Blueprint $table) {
            $table->increments('id');
            $table->string('utility_bill_path')->nullable();
            $table->string('website_url')->nullable();
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
            $table->tinyInteger('payment');
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
        Schema::drop('quotetek_user_verification');
        Schema::drop('quotetek_company_verification');
    }
}
