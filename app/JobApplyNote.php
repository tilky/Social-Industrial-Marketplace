<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplyNote extends Model
{
    protected $table = 'job_apply_note';
    
    /**
     * Get the note user 
     */
    public function noteUser()
    {
        return $this->belongsTo('App\User',"user_id");
    }

}
