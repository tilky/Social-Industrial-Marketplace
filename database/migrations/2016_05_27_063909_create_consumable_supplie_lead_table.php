<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumableSupplieLeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_lead_consumable_suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_lead_id')->unsigned();
            $table->foreign('supplier_lead_id')->references('id')->on('supplier_leads')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
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
        Schema::drop('supplier_lead_consumable_suppliers');
    }
}
