<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLevels extends Model
{
    protected $table = 'access_levels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
