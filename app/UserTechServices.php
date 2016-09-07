<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTechServices extends Model
{
    protected $table = 'user_technical_services';

    /**
     * Get the accreditation record associated.
     */
    public function techService()
    {
        return $this->belongsTo('App\TechService',"technical_service_id");
    }
}
