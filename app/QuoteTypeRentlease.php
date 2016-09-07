<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteTypeRentlease extends Model
{
    protected $table = 'quote_type_rentlease';

    /**
     * Get the Order type record associated.
     */
    public function rentlease()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
