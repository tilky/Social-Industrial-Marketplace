<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteIndustries extends Model
{
    protected $table = 'quote_industries';

    /**
     * Get the accreditation record associated.
     */
    public function industry()
    {
        return $this->belongsTo('App\Industry',"industry_id");
    }
}
