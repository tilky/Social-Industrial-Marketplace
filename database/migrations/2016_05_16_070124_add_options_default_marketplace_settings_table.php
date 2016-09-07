<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOptionsDefaultMarketplaceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marketplace_default_settings', function (Blueprint $table) {
           $table->string('return_policy')->nullable();
           $table->string('payment_terms')->nullable();
           $table->string('payment_accepted')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marketplace_default_settings', function (Blueprint $table) {
            //
        });
    }
}
