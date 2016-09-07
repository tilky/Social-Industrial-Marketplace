<?php

namespace App\Http\Controllers;

use Auth;
use App\UserAccountSettings;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    	if(!empty(Auth::user())){
    		$user_id = Auth::user()->id;
			$account_settings = UserAccountSettings::where('user_id',$user_id)->first();
			if($account_settings)
			{
				\Config::set('app.timezone',$account_settings->time_zone);
				date_default_timezone_set($account_settings->time_zone);
			}
    	}        
    }
}
