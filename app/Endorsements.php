<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endorsements extends Model
{
    protected $table = 'endorsements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sender_id','receiver_id','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
