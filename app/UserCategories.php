<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCategories extends Model
{
    protected $table = 'user_categories';
    
    /**
     * get category Data
     */
    public function CategoryData()
    {
        return $this->belongsTo('App\Category',"category_id");
    }
}
