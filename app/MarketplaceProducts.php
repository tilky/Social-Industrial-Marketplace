<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketplaceProducts extends Model
{
    protected $table = 'marketplace_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','brand_name','model_number','size','place_of_origin','condition','condition_quality','certification','feedback_score','number_of_sales','total_views',
                            'account_type','user_id','company_id','price','unit_type','discount_percent','minimum_quantity','quantity_available','description','supply_ability',
                            'shipping_terms','package_size','free_shipping','free_shipping_continents','shipping_fee','payment_terms','return_policy','item_specifics_value','attachment_path',
                            'is_active','payment_accepted','location_city','location_state','location_country','multi_select','unique_number','external_url'
                            ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the company categories
     */
    public function categories()
    {
        return $this->hasMany('App\MarketplaceProductCategories','product_id');
    }
    
    /**
     * Get the company industries
     */
    public function industries()
    {
        return $this->hasMany('App\MarketplaceProductIndustries','product_id');
    }
    
    /**
     * Get the company gallery
     */
    public function gallery()
    {
        return $this->hasMany('App\MarketplaceProductGallery','product_id');
    }
    
    /**
     * Get Companies By search
     */
     protected function getProductsByserach($search)
     {
        $searchArray = explode(' ',$search);
        $searchFinalArray = array();
        foreach($searchArray as $search)
        {
            $products = MarketplaceProducts::whereRaw("(name LIKE '%$search%') AND is_active=1 ")->get()->toArray();
            foreach($products as $$product)
            {
                $searchFinalArray[] = $user;
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
