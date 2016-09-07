<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyTypes extends Model
{
    protected $table = 'company_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
