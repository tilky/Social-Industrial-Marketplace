<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentDetailsAdditionalColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('ALTER TABLE `payment_details` MODIFY COLUMN `card_number` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `payment_details` MODIFY COLUMN `card_last_4` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `payment_details` MODIFY COLUMN `expiry` VARCHAR(255) NULL');
        DB::statement('ALTER TABLE `payment_details` MODIFY COLUMN `cvv` VARCHAR(255) NULL');
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
