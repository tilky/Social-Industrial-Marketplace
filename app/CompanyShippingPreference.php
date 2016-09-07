<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyShippingPreference extends Model
{
    protected $table = 'company_shipping_preference';

    /**
     * Get the accreditation record associated.
     */
    public function shippingPreference()
    {
        return $this->belongsTo('App\ShippingPreference',"shipping_preference_id");
    }
}
