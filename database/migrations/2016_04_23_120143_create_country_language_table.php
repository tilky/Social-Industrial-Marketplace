<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country_code');
            $table->string('country_name');
            $table->timestamps();
        });
        
        DB::table('apps_countries')->insert(
            array(
                'country_code' => 'AF',
                'country_name' => 'Afghanistan'
            )
        );
        
        DB::table('apps_countries')->insert(
            array(
                'country_code' => 'AL',
                'country_name' => 'Albania'
            )
        );
        
        DB::table('apps_countries')->insert(
            array(
                'country_code' => 'DZ',
                'country_name' => 'Algeria'
            )
        );
        
        DB::table('apps_countries')->insert(
            array(
                'country_code' => 'US',
                'country_name' => 'United States'
            )
        );
        
        DB::table('apps_countries')->insert(
            array(
                'country_code' => 'GB',
                'country_name' => 'United Kingdom'
            )
        );
        
        // create lamhuahe table
        Schema::create('apps_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        
        DB::table('apps_languages')->insert(
            array(
                'name' => 'Mandarin'
            )
        );
        
        DB::table('apps_languages')->insert(
            array(
                'name' => 'Spanish'
            )
        );
        
        DB::table('apps_languages')->insert(
            array(
                'name' => 'English'
            )
        );
        
        DB::table('apps_languages')->insert(
            array(
                'name' => 'Hindi'
            )
        );
        
        DB::table('apps_languages')->insert(
            array(
                'name' => 'Arabic'
            )
        );
        
        DB::table('apps_languages')->insert(
            array(
                'name' => 'Portuguese'
            )
        );
        
        // add address 2 in compnay table
        Schema::table('company_profile', function ($table) {
            $table->string('address2');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('apps_countries');
    }
}
