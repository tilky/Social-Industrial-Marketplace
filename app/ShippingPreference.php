<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingPreference extends Model
{
    protected $table = 'shipping_preference';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','is_active'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
