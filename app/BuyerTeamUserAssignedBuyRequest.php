<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerTeamUserAssignedBuyRequest extends Model
{
    protected $table = 'buyer_team_user_assigned_buy_request';

    protected $fillable = ['buyer_team_id','buyer_team_user_id','buy_request_id','user_id'];

}
