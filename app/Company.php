<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','phone','email','address','city','state','zip','country','logo','description','establishment_year','export_start_year',
    'employees_count','total_sales','trade_capacity','production_capacity','r&d_capacity','production_line_count','website','customer_care_contact_name',
    'customer_care_email','customer_care_phone','accepted_delivery_terms','accepted_payment_currency','accepted_payment_type','languages','average_lead_time',
    'unique_company_url','varification_status','is_Active','account_id','license_used','subscription_type','subscription_start_date','subscription_end_date','owner_id','user_id',
    'address2','facebook_url','google_plus','linkedin','insta_url','pintress_url','youtube_url','fax','twitter_url','background_image','skype_id','unique_number','external_url'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the company package
     */
    public function package()
    {
        return $this->belongsTo('App\CompanyAccount',"account_id");
    }

    
    /**
     * Get the company details
     */
    public function companyData()
    {
        return $this->belongsTo('App\UserDetails',"company_id");
    }
    
    /**
     * Get certification details
     */
    public function companyCertifications()
    {
        return $this->hasMany('App\CompanyCertifications','company_id');
    }
    
    /**
     * Get the company accreditations
     */
    public function accreditations()
    {
        return $this->hasMany('App\CompanyAccreditation','company_id');
    }

    /**
     * Get the company categories
     */
    public function categories()
    {
        return $this->hasMany('App\CompanyCategories','company_id');
    }

    /**
     * Get the company technical services
     */
    public function techServices()
    {
        return $this->hasMany('App\CompanyTechServices','company_id');
    }

    /**
     * Get the company quality standards
     */
    public function qualityStandards()
    {
        return $this->hasMany('App\CompanyQualityStandards','company_id');
    }

    /**
     * Get the company industries
     */
    public function industries()
    {
        return $this->hasMany('App\CompanyIndustries','company_id');
    }

    /**
     * Get the company markets
     */
    public function markets()
    {
        return $this->hasMany('App\CompanyMarkets','company_id');
    }

    /**
     * Get the company shipping preferences
     */
    public function shippingPreferences()
    {
        return $this->hasMany('App\CompanyShippingPreference','company_id');
    }

    /**
     * Get the company gallery
     */
    public function gallery()
    {
        return $this->hasMany('App\CompanyGallery','company_id');
    }
    
    /**
     * Get the company types
     */
    public function types()
    {
        return $this->hasMany('App\CompanyTypeMapping','company_id');
    }
    
    /**
     * Get the company users
     */
    public function users()
    {
        return $this->hasMany('App\UserDetails','company_id');
    }
    
    /**
     * Get Companies By search
     */
     protected function getCompaniesByserach($search)
     {
        $searchArray = explode(' ',$search);
        $searchFinalArray = array();
        foreach($searchArray as $search)
        {
            $companies = Company::whereRaw("(name LIKE '%$search%') AND is_active=1 ")->get()->toArray();
            foreach($companies as $company)
            {
                $searchFinalArray[] = $company;
            }
        }
        $searchResult =  $this->unique_multidim_array($searchFinalArray,'id');
        return $searchResult;
     }
     
     /**
      * Remove dupliacet entry from search result company
      */
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
}
