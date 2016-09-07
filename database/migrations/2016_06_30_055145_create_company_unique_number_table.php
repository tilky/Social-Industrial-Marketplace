<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyUniqueNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_unique', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->timestamps();
        });
        
        //Inserting default data in quote unique table.
        DB::table('company_unique')->insert(
            array(
                'number' => '120000'
            )
        );
        
        Schema::table('company_profile', function (Blueprint $table) {
            $table->string('unique_number')->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('company_unique');
    }
}
