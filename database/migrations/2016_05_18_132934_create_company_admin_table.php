<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('unique_code')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });
        
        Schema::table('company_profile', function (Blueprint $table) {
            $table->string('fax')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('company_admin');
    }
}
