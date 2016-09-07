<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsSupplierQuoteItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_quote_items', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable()->after('supplier_quote_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('condition')->nullable();
            $table->longText('categories')->nullable();
            $table->longText('specification')->nullable();
        });
        
        Schema::table('supplier_dump_items', function (Blueprint $table) {
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('condition')->nullable();
            $table->longText('categories')->nullable();
            $table->longText('specification')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_quote_items', function (Blueprint $table) {
            //
        });
    }
}
