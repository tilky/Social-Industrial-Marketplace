<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyMarkets extends Model
{
    protected $table = 'company_main_markets';

    /**
     * Get the accreditation record associated.
     */
    public function market()
    {
        return $this->belongsTo('App\Markets',"main_markets_id");
    }
}
