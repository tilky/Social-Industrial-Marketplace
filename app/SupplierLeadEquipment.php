<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierLeadEquipment extends Model
{
    protected $table = 'supplier_lead_equipment';

    /**
     * Get the Order type record associated.
     */
    public function equipment()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
