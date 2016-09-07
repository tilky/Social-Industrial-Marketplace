<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierTeamTransfer extends Model
{
    protected $table = 'supplier_team_transfer';

    protected $fillable = ['supplier_team_id','old_manager_id','new_manager_id','initiated_date','status'];
}
