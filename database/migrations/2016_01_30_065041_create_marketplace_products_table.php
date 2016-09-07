<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketplaceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketplace_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('brand_name')->nullable();
            $table->string('model_number',50)->nullable();
            $table->string('size', 50)->nullable();
            $table->string('place_of_origin')->nullable();
            $table->string('condition', 50)->nullable();
            $table->string('condition_quality', 50)->nullable();
            $table->string('certification', 100)->nullable();
            $table->string('feedback_score',50)->nullable();
            $table->string('number_of_sales',50)->nullable();
            $table->string('total_views',50)->nullable();
            $table->string('account_type',100);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('company_profile')->onDelete('cascade');
            $table->string('price',100);
            $table->string('unit_type',50)->nullable();
            $table->string('discount_percent',50)->nullable();
            $table->string('minimum_quantity',50)->nullable();
            $table->string('quantity_available',50)->nullable();
            $table->longText('description')->nullable();
            $table->string('supply_ability')->nullable();
            $table->string('shipping_terms')->nullable();
            $table->string('package_size')->nullable();
            $table->tinyInteger('free_shipping')->nullable();
            $table->string('free_shipping_continents')->nullable();
            $table->string('shipping_fee',50)->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('return_policy')->nullable();
            $table->string('item_specifics_value')->nullable();
            $table->string('attachment_path');
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
        Schema::drop('marketplace_products');
    }
}
