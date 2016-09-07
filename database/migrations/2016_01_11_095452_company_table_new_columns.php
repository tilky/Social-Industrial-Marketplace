<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyTableNewColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //adding other columns to company profile table
        Schema::table('company_profile', function ($table) {
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('country');
            $table->longText('logo');
            $table->string('description', 1000)->nullable();
            $table->string('establishment_year', 5)->nullable();
            $table->string('export_start_year', 5)->nullable();
            $table->string('employees_count', 50)->nullable();
            $table->string('total_sales', 50)->nullable();
            $table->string('trade_capacity', 50)->nullable();
            $table->string('production_capacity', 50)->nullable();
            $table->string('r&d_capacity', 50)->nullable();
            $table->string('production_line_count', 50)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('customer_care_contact_name', 100)->nullable();
            $table->string('customer_care_email', 100)->nullable();
            $table->string('customer_care_phone', 100)->nullable();
            $table->string('accepted_delivery_terms', 1000)->nullable();
            $table->string('accepted_payment_currency', 1000)->nullable();
            $table->string('accepted_payment_type', 1000)->nullable();
            $table->string('languages', 200)->nullable();
            $table->string('average_lead_time', 50)->nullable();
            $table->string('unique_company_url', 200);
            $table->tinyInteger('varification_status');
            $table->unique('email');
            $table->unique('unique_company_url');
            $table->unique('customer_care_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
