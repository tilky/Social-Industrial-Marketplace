<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAdditionalIndustries extends Model
{
    protected $table = 'user_additional_industries';
    
    /**
     * get Industry Data
     */
    public function IndustryData()
    {
        return $this->belongsTo('App\Industry',"industry_id");
    }
    
}
