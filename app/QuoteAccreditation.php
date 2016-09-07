<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteAccreditation extends Model
{
    protected $table = 'quote_accreditations';

    /**
     * Get the accreditation record associated.
     */
    public function accreditation()
    {
        return $this->belongsTo('App\Accreditation',"accreditations_id");
    }
}
