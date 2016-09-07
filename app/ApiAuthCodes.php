<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiAuthCodes extends Model
{
    protected $table = 'api_auth_codes';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
