<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsSave extends Model
{
    protected $table = 'jobs_save';

    
    /**
     * Get the user record.
     */
    public function jobdetail()
    {
        return $this->belongsTo('App\Jobs',"job_id");
    }
}
