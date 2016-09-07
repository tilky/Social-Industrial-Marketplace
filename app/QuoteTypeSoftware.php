<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteTypeSoftware extends Model
{
    protected $table = 'quote_type_software';

    /**
     * Get the Order type record associated.
     */
    public function software()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
