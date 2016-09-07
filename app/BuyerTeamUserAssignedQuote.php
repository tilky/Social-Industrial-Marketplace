<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerTeamUserAssignedQuote extends Model
{
    protected $table = 'buyer_team_user_assigned_quote';

    protected $fillable = ['buyer_team_id','buyer_team_user_id','buyer_quote_id','user_id'];
}
