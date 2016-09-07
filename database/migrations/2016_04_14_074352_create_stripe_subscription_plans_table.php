<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('amount');
            $table->string('plan_type');
            $table->string('plan_key')->nullable();
            $table->timestamps();
        });
        
        //Inserting default data in access levels table.
        DB::table('subscription_plans')->insert(
            array(
                'name' => 'Buyer Plus Package',
                'amount' => '199',
                'plan_type' => 'buyer',
                'plan_key' => 'buyerplus',
            )
        );

        DB::table('subscription_plans')->insert(
            array(
                'name' => 'Buyer Standard Package',
                'amount' => '0',
                'plan_type' => 'buyer',
                'plan_key' => 'buyerstandard',
            )
        );

        DB::table('subscription_plans')->insert(
            array(
                'name' => 'Supplier Gold Package',
                'amount' => '199',
                'plan_type' => 'supplier',
                'plan_key' => 'suppliergold',
            )
        );
        DB::table('subscription_plans')->insert(
            array(
                'name' => 'Supplier Silver Package',
                'amount' => '149',
                'plan_type' => 'supplier',
                'plan_key' => 'suppliersilver',
            )
        );
        DB::table('subscription_plans')->insert(
            array(
                'name' => 'Supplier Free Package',
                'amount' => '0',
                'plan_type' => 'supplier',
                'plan_key' => 'supplierfree',
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
        Schema::drop('subscription_plans');
    }
}
