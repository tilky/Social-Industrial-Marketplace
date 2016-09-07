<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteCategories extends Model
{
    protected $table = 'quote_categories';

    /**
     * Get the category record associated.
     */
    public function category()
    {
        return $this->belongsTo('App\Category',"category_id");
    }
}
