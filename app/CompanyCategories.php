<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyCategories extends Model
{
    protected $table = 'company_categories';

    /**
     * Get the accreditation record associated.
     */
    public function category()
    {
        return $this->belongsTo('App\Category',"category_id");
    }
}
