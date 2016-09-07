<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteTypeEquipment extends Model
{
    protected $table = 'quote_type_equipment';

    /**
     * Get the Order type record associated.
     */
    public function equipment()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
