<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUsers extends Model
{
    protected $table = 'contact_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sender_user_id','sender_user_company_id','request_user_id','request_user_company_id','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the ticket comments
     */
    
    
}
