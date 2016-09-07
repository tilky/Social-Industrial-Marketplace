<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupplierQuotesFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_quotes', function (Blueprint $table) {
            $table->string('company_quote_number')->nullable();
            $table->string('company_tax_number')->nullable();
            $table->date('expiry_date');
            $table->string('salestax')->nullable();
            $table->string('salestax_amount')->nullable();
            $table->longText('custom_note')->nullable();
            $table->string('quote_unique')->nullable();
        });
        
        Schema::create('supplier_quote_unique', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->timestamps();
        });
        
        //Inserting default data in quote unique table.
        DB::table('supplier_quote_unique')->insert(
            array(
                'number' => '120000'
            )
        );
        
        Schema::table('supplier_quote_items', function (Blueprint $table) {
            $table->string('item_number')->nullable();
            $table->tinyInteger('taxable');
        });
        
        Schema::create('supplier_dump_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('random_number')->nullable();
            $table->string('item_number')->nullable();
            $table->string('name')->nullable();
            $table->longText('description');
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->tinyInteger('taxable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_quotes', function (Blueprint $table) {
            //
        });
    }
}
