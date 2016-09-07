<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressColumnsToQuoteDefaultSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_default_settings', function (Blueprint $table) {
            $table->string('address',255);
            $table->string('address2',255);
            $table->string('city',100);
            $table->string('state',100);
            $table->string('zip',100);
            $table->string('country',100);
        });

        Schema::table('quotes', function (Blueprint $table) {
            $table->string('address',255);
            $table->string('address2',255);
            $table->string('city',100);
            $table->string('state',100);
            $table->string('zip',100);
            $table->string('country',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_default_settings', function (Blueprint $table) {
            //
        });
    }
}
