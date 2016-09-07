<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // order type table
        Schema::create('order_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_type');
            $table->string('name');
            $table->timestamps();
        });
        
        //Inserting default data in access levels table.
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Purchase order',
                'name' => 'New Product'
            )
        );

        DB::table('order_types')->insert(
            array(
                'order_type' => 'Purchase order',
                'name' => 'Used Product'
            )
        );

        DB::table('order_types')->insert(
            array(
                'order_type' => 'Purchase order',
                'name' => 'Refurbished Product'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Purchase order',
                'name' => 'Parts/Accessories'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Service Order',
                'name' => 'Product Calibration'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Service Order',
                'name' => 'Product Certification'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Service Order',
                'name' => 'Product Repairs'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Service Order',
                'name' => 'Other Service'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Rent/Lease Order',
                'name' => 'Product Rent'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Rent/Lease Order',
                'name' => 'Product Lease'
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
        Schema::drop('order_types');
    }
}
