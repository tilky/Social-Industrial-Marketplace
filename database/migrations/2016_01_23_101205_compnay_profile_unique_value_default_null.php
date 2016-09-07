<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompnayProfileUniqueValueDefaultNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Setting default null values to unique columns
        DB::statement("ALTER TABLE company_profile CHANGE COLUMN customer_care_email customer_care_email varchar(100) NULL DEFAULT NULL;");
        DB::statement("ALTER TABLE company_profile CHANGE COLUMN unique_company_url unique_company_url varchar(100) NULL DEFAULT NULL;");
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
