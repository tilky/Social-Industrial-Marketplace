<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierLeadRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //supplier lead categories table
        Schema::create('supplier_lead_categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('supplier_lead_id')->unsigned();
            $table->foreign('supplier_lead_id')->references('id')->on('supplier_leads')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });

        //supplier lead industries table
        Schema::create('supplier_lead_industries', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('supplier_lead_id')->unsigned();
            $table->foreign('supplier_lead_id')->references('id')->on('supplier_leads')->onDelete('cascade');
            $table->integer('industry_id')->unsigned();
            $table->foreign('industry_id')->references('id')->on('industry')->onDelete('cascade');
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
        Schema::drop('supplier_lead_relation');
    }
}
