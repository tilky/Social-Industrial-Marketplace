<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierQuotes extends Model
{
    protected $table = 'supplier_quotes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['supplier_id','buyer_id','shipping_fee','shipped_via','payment_terms','payment_via','status','estimated_time','estimated_delivery','buyer_quote_id',
                            'company_quote_number','company_tax_number','expiry_date','salestax','salestax_amount','custom_note','quote_unique','preview','shipping_charge','shipping_charge_amount'
                            ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    /**
     * Get the company package
     */
    public function buyerData()
    {
        return $this->belongsTo('App\User',"buyer_id");
    }
    
    /**
     * get buyer quote data
     */
    public function buyerQuote()
    {
        return $this->belongsTo('App\Quotes',"buyer_quote_id");
    }
    
    public function supplierData()
    {
        return $this->belongsTo('App\User',"supplier_id");
    }
    
    public function SupplierQuoteItems()
    {
        return $this->hasMany('App\SupplierQuoteItems','supplier_quote_id');
    }
}
