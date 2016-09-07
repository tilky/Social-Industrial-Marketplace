<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierLeadConsumableSuppliers extends Model
{
    protected $table = 'supplier_lead_consumable_suppliers';

    /**
     * Get the Order type record associated.
     */
    public function consumable()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
