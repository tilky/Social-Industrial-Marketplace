<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('website_url', 100)->nullable();
            $table->longText('about')->nullable();
            $table->string('facebook_url', 100)->nullable();
            $table->string('insta_url', 100)->nullable();
            $table->string('pintress_url', 100)->nullable();
            $table->string('youtube_url', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn('website_url');
            $table->dropColumn('about');
            $table->dropColumn('facebook_url');
            $table->dropColumn('insta_url');
            $table->dropColumn('pintress_url');
            $table->dropColumn('youtube_url');
        });
    }
}
