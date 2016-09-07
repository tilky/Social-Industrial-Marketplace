<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionsKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_specification_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keyword');
            $table->timestamps();
        });
        
        DB::table('technical_specification_options')->insert(
            array(
                'keyword' => 'Black Color'
            )
        );
        
        DB::table('technical_specification_options')->insert(
            array(
                'keyword' => 'Color White'
            )
        );
        
        Schema::create('product_unique', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->timestamps();
        });
        
        //Inserting default data in quote unique table.
        DB::table('product_unique')->insert(
            array(
                'number' => '120000'
            )
        );
        
        Schema::table('marketplace_products', function (Blueprint $table) {
            $table->string('unique_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('technical_specification_options');
    }
}
