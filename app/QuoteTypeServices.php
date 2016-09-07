<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteTypeServices extends Model
{
    protected $table = 'quote_type_services';

    /**
     * Get the Order type record associated.
     */
    public function service()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
