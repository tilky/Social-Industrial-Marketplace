<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketplaceDefaultSettings extends Model
{
    protected $table = 'marketplace_default_settings';
    
    protected $fillable = ['user_id','shipping_terms','return_policy','payment_terms','payment_accepted'];
}
