<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessLevelTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Creating access level table
        Schema::create('access_levels', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        //Inserting default data in access levels table.
        DB::table('access_levels')->insert(
            array(
                'name' => 'Super Admin'
            )
        );

        DB::table('access_levels')->insert(
            array(
                'name' => 'Buyer'
            )
        );

        DB::table('access_levels')->insert(
            array(
                'name' => 'Seller'
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
        //Dropping access level table
        Schema::drop('access_levels');
    }
}
