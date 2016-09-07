<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderTypeValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('order_types')->insert(
            array(
                'order_type' => 'Software',
                'name' => 'Other'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'ConsumableSuppliers',
                'name' => 'New'
            )
        );
        
        DB::table('order_types')->insert(
            array(
                'order_type' => 'ConsumableSuppliers',
                'name' => 'Used'
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
        Schema::table('order_types', function (Blueprint $table) {
            //
        });
    }
}
