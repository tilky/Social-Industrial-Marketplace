<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AnnualSubscriptionsPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('subscription_plans')->insert(
            array(
                'name' => 'Buyer Plus Annual',
                'amount' => '2160',
                'plan_type' => 'buyer',
                'plan_key' => 'buyerplus_annual',
            )
        );

        DB::table('subscription_plans')->insert(
            array(
                'name' => 'Supplier Gold Annual',
                'amount' => '2160',
                'plan_type' => 'supplier',
                'plan_key' => 'suppliergold_annual',
            )
        );

        DB::table('subscription_plans')->insert(
            array(
                'name' => 'Supplier Silver Annual',
                'amount' => '1560',
                'plan_type' => 'supplier',
                'plan_key' => 'suppliersilver_annual',
            )
        );
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
