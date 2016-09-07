<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierTeamUserLeadRequest extends Model
{
    protected $table = 'supplier_team_user_lead_request';

    protected $fillable = ['user_id','supplier_team_id','supplier_team_user_id','lead_request_id'];
}
