<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsApply extends Model
{
    protected $table = 'jobs_apply';

    /**
     * Get the user record.
     */
    public function jobApplyUser()
    {
        return $this->belongsTo('App\User',"user_id");
    }
    
    /**
     * Get quote notes
     */
    public function notes()
    {
        return $this->hasMany('App\JobApplyNote','job_apply_id')->orderBy('id','desc');
    }
}
