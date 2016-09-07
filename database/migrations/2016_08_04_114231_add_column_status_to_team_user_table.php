<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusToTeamUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_team_user', function (Blueprint $table) {
            $table->dropColumn('label');
            $table->tinyInteger('status')->default(0)->after('user_id');
        });

        Schema::table('buyer_team_user', function (Blueprint $table) {
            $table->dropColumn('label');
            $table->tinyInteger('status')->default(0)->after('user_id');
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
