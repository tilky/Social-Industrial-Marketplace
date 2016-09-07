<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    protected $table = 'quotes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','specifications','verified_only','privacy','expiry_date','request_area','additional_file','status','created_by','unique_number','qty_request',
                            'manufacturer','model_number','specifics_value','address','address2','city','state','zip','country'
                            ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    /**
     * get Buyer Data
     */
    public function buyerData()
    {
        return $this->belongsTo('App\User',"created_by");
    }
    
    /**
     * Get the quote accreditations
     */
    public function accreditations()
    {
        return $this->hasMany('App\QuoteAccreditation','quote_id');
    }
    
    /**
     * Get the quote devirsities
     */
    public function devirsities()
    {
        return $this->hasMany('App\QuoteDiversity','quote_id');
    }

    /**
     * Get the quote categories
     */
    public function categories()
    {
        return $this->hasMany('App\QuoteCategories','quote_id');
    }
    
    /**
     * Get the quote industries
     */
    public function industries()
    {
        return $this->hasMany('App\QuoteIndustries','quote_id');
    }
    
    /**
     * Get the quote products
     */
    public function products()
    {
        return $this->hasMany('App\QuoteProducts','quote_id');
    }
    
    /**
     * Get the quote purchases
     */
    public function purchases()
    {
        return $this->hasMany('App\QuoteTypePurchase','quote_id');
    }
    
    /**
     * Get the quote equipment
     */
    public function Equipments()
    {
        return $this->hasMany('App\QuoteTypeEquipment','quote_id');
    }
    
    /**
     * Get the quote materials Tooling
     */
    public function materialsToolings()
    {
        return $this->hasMany('App\QuoteTypeMaterialsTooling','quote_id');
    }
    
    /**
     * Get the quote services
     */
    public function services()
    {
        return $this->hasMany('App\QuoteTypeServices','quote_id');
    }
    
    /**
     * Get the quote softwares
     */
    public function softwares()
    {
        return $this->hasMany('App\QuoteTypeSoftware','quote_id');
    }
    
    /**
     * Get the quote onsumables suppliers
     */
    public function consumables()
    {
        return $this->hasMany('App\QuoteTypeConsumableSuppliers','quote_id');
    }
    
    /**
     * Get the quote rentleases
     */
    public function rentleases()
    {
        return $this->hasMany('App\QuoteTypeRentlease','quote_id');
    }
    
    /**
     * Get Received quotes
     */
    public function receivedQuotes()
    {
        return $this->hasMany('App\SupplierQuotes','buyer_quote_id');
    }
    
    /**
     * Get quote notes
     */
    public function notes()
    {
        return $this->hasMany('App\QuoteNotes','quote_id')->orderBy('id','desc');
    }
}
