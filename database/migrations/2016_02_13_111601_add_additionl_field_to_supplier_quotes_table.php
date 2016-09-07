<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionlFieldToSupplierQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_quotes', function (Blueprint $table) {
            $table->integer('estimated_time');
            $table->date('estimated_delivery');
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
            $table->dropColumn('estimated_time');
            $table->dropColumn('estimated_delivery');
        });
    }
}
