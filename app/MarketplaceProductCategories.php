<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketplaceProductCategories extends Model
{
    protected $table = 'marketplace_product_categories';

    /**
     * Get the accreditation record associated.
     */
    public function category()
    {
        return $this->belongsTo('App\Category',"category_id");
    }
}
