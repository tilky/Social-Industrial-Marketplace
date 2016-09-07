<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierLeadCategories extends Model
{
    protected $table = 'supplier_lead_categories';

    /**
     * Get the category record associated.
     */
    public function category()
    {
        return $this->belongsTo('App\Category',"category_id");
    }
}
