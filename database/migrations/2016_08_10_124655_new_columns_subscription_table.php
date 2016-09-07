<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewColumnsSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('ALTER TABLE `subscriptions` MODIFY COLUMN `stripe_id` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `subscriptions` MODIFY COLUMN `stripe_plan` VARCHAR(255) NULL');

        Schema::table('subscriptions', function ($table) {
            $table->string('paypal_payer_id');
            $table->string('paypal_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
