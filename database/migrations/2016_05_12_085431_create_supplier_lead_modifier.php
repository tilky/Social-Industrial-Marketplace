<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierLeadModifier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Supplier Lead equipment order table
        Schema::create('supplier_lead_equipment', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('supplier_lead_id')->unsigned();
            $table->foreign('supplier_lead_id')->references('id')->on('supplier_leads')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->timestamps();
        });

        //Supplier Lead materials_tooling order table
        Schema::create('supplier_lead_materials_tooling', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('supplier_lead_id')->unsigned();
            $table->foreign('supplier_lead_id')->references('id')->on('supplier_leads')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->timestamps();
        });
        
        //Supplier Lead Services Order table
        Schema::create('supplier_lead_services', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('supplier_lead_id')->unsigned();
            $table->foreign('supplier_lead_id')->references('id')->on('supplier_leads')->onDelete('cascade');
            $table->integer('order_type_id')->unsigned();
            $table->foreign('order_type_id')->references('id')->on('order_types')->onDelete('cascade');
            $table->timestamps();
        });
        
        //Supplier Lead software Order table
        Schema::create('supplier_lead_software', function(Blueprint $table)
        {
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
        Schema::drop('supplier_lead_modifier');
    }
}
