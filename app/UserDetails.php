<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table = 'user_details';
    
    protected function getUsersBySearch($search,$user_id)
    {
        $searchArray = explode(' ',$search);
        $searchFinalArray = array();
        foreach($searchArray as $search)
        {
            $users = UserDetails::whereRaw("(first_name LIKE '%$search%' OR last_name LIKE '%$search%') AND user_id != '$user_id' AND is_active = 1 ")->get()->toArray();
            foreach($users as $user)
            {
                $searchFinalArray[] = $user;
            }
        }
        $searchResult =  $this->unique_multidim_array($searchFinalArray,'id');
        return $searchResult;
    }
    
    public function unique_multidim_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    }
    
        
        
    protected function getUsersByCompany($company_id,$user_id)
    {
        return UserDetails::whereRaw('company_id = ? AND user_id != ? AND is_active = ?',array($company_id ,$user_id, 1))->get();
    }
    
    
    public function getUserIndustry()
    {
        return $this->belongsTo('App\Industry', 'industry_id');    
    }
    
    public function UserCompany()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
