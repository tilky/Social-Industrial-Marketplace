<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierLeadIndustries extends Model
{
    protected $table = 'supplier_lead_industries';

    /**
     * Get the accreditation record associated.
     */
    public function industry()
    {
        return $this->belongsTo('App\Industry',"industry_id");
    }
}
