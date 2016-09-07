<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTypes extends Model
{
    protected $table = 'order_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','order_type'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
