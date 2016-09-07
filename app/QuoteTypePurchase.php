<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteTypePurchase extends Model
{
    protected $table = 'quote_type_purchase';

    /**
     * Get the Order type record associated.
     */
    public function purchase()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
