<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerTeamTransfer extends Model
{
    protected $table = 'buyer_team_transfer';

    protected $fillable = ['buyer_team_id','old_manager_id','new_manager_id','initiated_date','status'];
}
