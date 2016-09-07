<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceDefaultSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_default_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('shipping_terms')->nullable();
            $table->tinyInteger('free_shipping')->nullable();
            $table->string('free_shipping_continents')->nullable();
            $table->string('shipping_fee',50)->nullable();
            $table->timestamps();
        });
        
        Schema::table('marketplace_products', function (Blueprint $table) {
            $table->string('payment_accepted')->nullable();
            $table->string('location_city')->nullable();
            $table->string('location_state')->nullable();
            $table->string('location_country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('marketplace_default_settings');
    }
}
