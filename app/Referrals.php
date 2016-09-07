<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referrals extends Model
{
    protected $table = 'referrals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['referral_by','referral_to','referral_link_id','is_active'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
