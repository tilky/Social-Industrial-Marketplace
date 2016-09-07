<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAccreditation extends Model
{
    protected $table = 'company_accreditations';

    /**
     * Get the accreditation record associated.
     */
    public function accreditation()
    {
        return $this->belongsTo('App\Accreditation',"accreditations_id");
    }
}
