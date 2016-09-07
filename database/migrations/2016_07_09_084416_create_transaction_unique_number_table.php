<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionUniqueNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_unique', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->timestamps();
        });
        
        //Inserting default data in quote unique table.
        DB::table('transaction_unique')->insert(
            array(
                'number' => '120000'
            )
        );
        
        Schema::table('payment_details', function (Blueprint $table) {
            $table->string('unique_number')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction_unique');
    }
}
