<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyIndustries extends Model
{
    protected $table = 'company_industries';

    /**
     * Get the accreditation record associated.
     */
    public function industry()
    {
        return $this->belongsTo('App\Industry',"industry_id");
    }
}
