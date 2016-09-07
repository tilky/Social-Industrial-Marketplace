<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteTypeConsumableSuppliers extends Model
{
    protected $table = 'quote_type_consumable_suppliers';

    /**
     * Get the Order type record associated.
     */
    public function consumable()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
