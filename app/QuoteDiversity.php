<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteDiversity extends Model
{
    protected $table = 'quote_diversity_options';

    /**
     * Get the accreditation record associated.
     */
    public function diversity()
    {
        return $this->belongsTo('App\Diversity',"diversity_option_id");
    }
}
