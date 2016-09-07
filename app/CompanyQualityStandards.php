<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyQualityStandards extends Model
{
    protected $table = 'company_quality_standards';

    /**
     * Get the accreditation record associated.
     */
    public function qualityStandard()
    {
        return $this->belongsTo('App\QualityStandards',"quality_standards_id");
    }
}
