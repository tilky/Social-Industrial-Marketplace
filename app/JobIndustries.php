<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobIndustries extends Model
{
    protected $table = 'job_industries';

    
    /**
     * Get the user record.
     */
    public function jobdetail()
    {
        return $this->belongsTo('App\Jobs',"job_id");
    }
}
