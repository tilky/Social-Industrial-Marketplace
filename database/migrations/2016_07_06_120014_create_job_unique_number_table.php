<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobUniqueNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_unique', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->timestamps();
        });
        
        //Inserting default data in quote unique table.
        DB::table('job_unique')->insert(
            array(
                'number' => '120000'
            )
        );
        
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('unique_number')->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_unique');
    }
}
