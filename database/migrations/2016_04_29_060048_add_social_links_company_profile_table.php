<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialLinksCompanyProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_profile', function (Blueprint $table) {
            $table->string('facebook_url', 100)->nullable();
            $table->string('google_plus', 100)->nullable();
            $table->string('linkedin', 100)->nullable();
            $table->string('insta_url', 100)->nullable();
            $table->string('pintress_url', 100)->nullable();
            $table->string('youtube_url', 100)->nullable();
        });
        
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('google_plus', 100)->nullable();
            $table->string('linkedin', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_profile', function (Blueprint $table) {
            //
        });
    }
}
