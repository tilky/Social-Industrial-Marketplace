<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTypesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Quote equipment order table
        Schema::create('quote_type_equipment', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->timestamps();
        });

        //Quote materials_tooling order table
        Schema::create('quote_type_materials_tooling', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->timestamps();
        });
        
        //Quote Services Order table
        Schema::create('quote_type_services', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->timestamps();
        });
        
        //Quote software Order table
        Schema::create('quote_type_software', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->timestamps();
        });
        
        //Quote Consumable Suppliers Order table
        Schema::create('quote_type_consumable_suppliers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->timestamps();
        });
        
        //Inserting default data in access levels table.
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Equipment',
                'name' => 'New'
            )
        );

        DB::table('order_types')->insert(
            array(
                'order_type' => 'Equipment',
                'name' => 'Used'
            )
        );

        DB::table('order_types')->insert(
            array(
                'order_type' => 'Equipment',
                'name' => 'Refurbished'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Equipment',
                'name' => 'Rent/Lease'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Equipment',
                'name' => 'Custom/Other'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'MaterialsTooling',
                'name' => 'New'
            )
        );

        DB::table('order_types')->insert(
            array(
                'order_type' => 'MaterialsTooling',
                'name' => 'Used'
            )
        );

        DB::table('order_types')->insert(
            array(
                'order_type' => 'MaterialsTooling',
                'name' => 'Refurbished'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'MaterialsTooling',
                'name' => 'Rent/Lease'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'MaterialsTooling',
                'name' => 'Custom/Other'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Services',
                'name' => 'Calibration'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Services',
                'name' => 'Certification'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Services',
                'name' => 'Repairs'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Services',
                'name' => 'Other'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Software',
                'name' => 'OEM'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Software',
                'name' => 'Custom'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'ConsumableSuppliers',
                'name' => 'Suppliers'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'ConsumableSuppliers',
                'name' => 'Stationary'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'ConsumableSuppliers',
                'name' => 'Other'
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
        Schema::drop('quote_type_tables');
    }
}
