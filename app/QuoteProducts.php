<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteProducts extends Model
{
    protected $table = 'quote_products';

    /**
     * Get the products record associated.
     */
    public function product()
    {
        return $this->belongsTo('App\Product',"product_id");
    }
}
