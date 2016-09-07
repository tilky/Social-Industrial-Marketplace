<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccountSettings extends Model
{
    protected $table = 'user_account_settings';
    
    protected $fillable = ['user_id', 'import_message', 'new_message','new_job','new_market','default_account_mode','time_zone','profile_in_ij','profile_in_others','new_quote_lead_syatem'];

}
