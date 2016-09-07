<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportTickets extends Model
{
    protected $table = 'support_tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','title','description','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the ticket comments
     */
    public function comments()
    {
        return $this->hasMany('App\SupportTicketComments','ticket_id');
    }
    
}
