<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyContactUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_users', function (Blueprint $table) {
            DB::statement('ALTER TABLE `contact_users` MODIFY COLUMN `sender_user_company_id` INTEGER UNSIGNED NULL');
            DB::statement('ALTER TABLE `contact_users` MODIFY COLUMN `request_user_company_id` INTEGER UNSIGNED NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_users', function (Blueprint $table) {
            //
        });
    }
}
