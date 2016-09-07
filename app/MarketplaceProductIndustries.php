<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketplaceProductIndustries extends Model
{
    protected $table = 'marketplace_product_industries';

    /**
     * Get the accreditation record associated.
     */
    public function industry()
    {
        return $this->belongsTo('App\Industry',"industry_id");
    }
}
