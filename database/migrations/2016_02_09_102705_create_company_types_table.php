<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        
        //Inserting default data in access levels table.
        DB::table('company_types')->insert(
            array(
                'name' => 'Exporter'
            )
        );

        DB::table('company_types')->insert(
            array(
                'name' => 'Manufacturer'
            )
        );

        DB::table('company_types')->insert(
            array(
                'name' => 'Service Provider'
            )
        );
        
        DB::table('company_types')->insert(
            array(
                'name' => 'Supplier'
            )
        );
        
        DB::table('company_types')->insert(
            array(
                'name' => 'Trader'
            )
        );
        
        DB::table('company_types')->insert(
            array(
                'name' => 'Wholesaler/Distributor'
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
        Schema::drop('company_types');
    }
}
