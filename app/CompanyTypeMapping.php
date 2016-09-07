<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyTypeMapping extends Model
{
    protected $table = 'company_type_mapping';

    /**
     * Get the type record associated.
     */
    public function type()
    {
        return $this->belongsTo('App\CompanyTypes',"company_type_id");
    }

    
}
