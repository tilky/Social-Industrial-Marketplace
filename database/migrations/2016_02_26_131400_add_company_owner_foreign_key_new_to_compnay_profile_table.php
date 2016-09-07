<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyOwnerForeignKeyNewToCompnayProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('company_profile', function (Blueprint $table) {
            $table->integer('owner_id')->unsigned()->nullable();
        });
        
        DB::statement('ALTER TABLE `company_profile` ADD FOREIGN KEY (`owner_id`) REFERENCES users(`id`) on delete cascade');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_profile', function (Blueprint $table) {
            //
        });
    }
}
