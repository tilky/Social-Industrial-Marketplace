<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralsLinks extends Model
{
    protected $table = 'referrals_links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','referral_code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
