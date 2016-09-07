<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_code');
            $table->timestamps();
        });
        
        //Inserting default data in currencies table.
        DB::table('currencies')->insert(
            array(
                'name_code' => 'USD - United States dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'CAD - Canadian dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'GBP - British pound'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'EUR - Euro'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'CHF - Swiss franc'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'NZD - New Zealand dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'AUD - Australian dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'JPY - Japanese yen'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'CNY - Chinese yuan'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'INR - Indian rupee'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'AED - United Arab Emirates dirham'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'AFN - Afghan afghani'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'ALL - Albanian lek'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'AMD - Armenian dram'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'ANG - Netherlands Antillean guilder'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'AOA - Angolan kwanza'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'ARS - Argentine peso'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'AWG - Aruban florin'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'AZN - Azerbaijani manat'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BAM - B and H convertible mark'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BBD - Barbadian dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BDT - Bangladeshi taka'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BGN - Bulgarian lev'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BHD - Bahraini dinar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BIF - Burundian franc'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BMD - Bermudian dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BND - Brunei dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BOB - Bolivian boliviano'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BRL - Brazilian real'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BSD - Bahamian dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BTN - Bhutanese ngultrum'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BWP - Botswana pula'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BYR - Belarusian ruble'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'BZD - Belize dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'CDF - Congolese franc'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'CLP - Chilean peso'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'COP - Colombian peso'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'CRC - Costa Rican colón'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'CUC - Cuban convertible peso'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'CUP - Cuban peso'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'CVE - Cape Verdean escudo'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'CZK - Czech koruna'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'DJF - Djiboutian franc'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'DKK - Danish krone'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'DOP - Dominican peso'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'DZD - Algerian dinar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'EGP - Egyptian pound'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'ERN - Eritrean nakfa'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'ETB - Ethiopian birr'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'FJD - Fijian dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'FKP - Falkland Islands pound'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'GEL - Georgian lari'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'GHS - Ghana cedi'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'GIP - Gibraltar pound'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'GMD - Gambian dalasi'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'GNF - Guinean franc'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'GTQ - Guatemalan quetzal'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'GYD - Guyanese dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'HKD - Hong Kong dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'HNL - Honduran lempira'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'HRK - Croatian kuna'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'HTG - Haitian gourde'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'HUF - Hungarian forint'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'IDR - Indonesian rupiah'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'ILS - Israeli new shekel'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'IQD - Iraqi dinar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'IRR - Iranian rial'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'ISK - Icelandic króna'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'JMD - Jamaican dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'JOD - Jordanian dinar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'KES - Kenyan shilling'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'KGS - Kyrgyzstani som'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'KHR - Cambodian riel'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'KMF - Comorian franc'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'KPW - North Korean won'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'KRW - South Korean won'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'KWD - Kuwaiti dinar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'KYD - Cayman Islands dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'KZT - Kazakhstani tenge'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'LAK - Lao kip'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'LBP - Lebanese pound'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'LKR - Sri Lankan rupee'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'LRD - Liberian dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'LSL - Lesotho loti'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'LYD - Libyan dinar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MAD - Moroccan dirham'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MDL - Moldovan leu'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MGA - Malagasy ariary'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MKD - Macedonian denar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MMK - Burmese kyat'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MNT - Mongolian tögrög'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MOP - Macanese pataca'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MRO - Mauritanian ouguiya'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MUR - Mauritian rupee'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MVR - Maldivian rufiyaa'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MWK - Malawian kwacha'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MXN - Mexican peso'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MYR - Malaysian ringgit'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'MZN - Mozambican metical'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'NAD - Namibian dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'NGN - Nigerian naira'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'NIO - Nicaraguan córdoba'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'NOK - Norwegian krone'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'NPR - Nepalese rupee'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'OMR - Omani rial'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'PAB - Panamanian balboa'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'PEN - Peruvian nuevo sol'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'PGK - Papua New Guinean kina'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'PHP - Philippine peso'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'PKR - Pakistani rupee'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'PLN - Polish z?oty'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'PYG - Paraguayan guaraní'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'QAR - Qatari riyal'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'RON - Romanian leu'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'RSD - Serbian dinar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'RUB - Russian ruble'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'RWF - Rwandan franc'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SAR - Saudi riyal'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SBD - Solomon Islands dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SCR - Seychellois rupee'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SDG - Sudanese pound'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SEK - Swedish krona'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SGD - Singapore dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SHP - Saint Helena pound'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SLL - Sierra Leonean leone'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SOS - Somali shilling'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SRD - Surinamese dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SSP - South Sudanese pound'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'STD - São Tomé and Príncipe dobra'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SYP - Syrian pound'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'SZL - Swazi lilangeni'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'THB - Thai baht'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'TJS - Tajikistani somoni'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'TMT - Turkmenistan manat'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'TND - Tunisian dinar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'TOP - Tongan paanga'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'TRY - Turkish lira'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'TTD - Trinidad and Tobago dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'TWD - New Taiwan dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'TZS - Tanzanian shilling'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'UAH - Ukrainian hryvnia'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'UGX - Ugandan shilling'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'UYU - Uruguayan peso'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'UZS - Uzbekistani som'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'VEF - Venezuelan bolívar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'VND - Vietnamese ??ng'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'VUV - Vanuatu vatu'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'WST - Samoan t?l?'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'XAF - Central African CFA franc'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'XCD - East Caribbean dollar'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'XOF - West African CFA franc'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'XPF - CFP franc'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'YER - Yemeni rial'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'ZAR - South African rand'
            )
        );
        
        DB::table('currencies')->insert(
            array(
                'name_code' => 'ZMW - Zambian kwacha'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('currencies');
    }
}
