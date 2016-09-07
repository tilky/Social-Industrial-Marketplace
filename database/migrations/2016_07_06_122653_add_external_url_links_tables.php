<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExternalUrlLinksTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('external_url')->nullable();
        });
        
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('external_url')->nullable();
        });
        
        Schema::table('marketplace_products', function (Blueprint $table) {
            $table->string('external_url')->nullable();
        });
        
        Schema::table('company_profile', function (Blueprint $table) {
            $table->string('external_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
