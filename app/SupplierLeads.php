<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierLeads extends Model
{
    protected $table = 'supplier_leads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['created_by','expiry_date','status','file_path'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    /**
     * Get the lead categories
     */
    public function categories()
    {
        return $this->hasMany('App\SupplierLeadCategories','supplier_lead_id');
    }
    
    /**
     * Get the lead industries
     */
    public function industries()
    {
        return $this->hasMany('App\SupplierLeadIndustries','supplier_lead_id');
    }
    
    /**
     * Get the lead equipment
     */
    public function Equipments()
    {
        return $this->hasMany('App\SupplierLeadEquipment','supplier_lead_id');
    }
    
    /**
     * Get the lead materials Tooling
     */
    public function materialsToolings()
    {
        return $this->hasMany('App\SupplierLeadMaterialsTooling','supplier_lead_id');
    }
    
    /**
     * Get the lead services
     */
    public function services()
    {
        return $this->hasMany('App\SupplierLeadServices','supplier_lead_id');
    }
    
    /**
     * Get the lead softwares
     */
    public function softwares()
    {
        return $this->hasMany('App\SupplierLeadSoftware','supplier_lead_id');
    }
    
    /**
     * Get the quote onsumables suppliers
     */
    public function consumables()
    {
        return $this->hasMany('App\SupplierLeadConsumableSuppliers','supplier_lead_id');
    }
}
