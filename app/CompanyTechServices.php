<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyTechServices extends Model
{
    protected $table = 'company_technical_services';

    /**
     * Get the accreditation record associated.
     */
    public function techService()
    {
        return $this->belongsTo('App\TechService',"technical_service_id");
    }
}
