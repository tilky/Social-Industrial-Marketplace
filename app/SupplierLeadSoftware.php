<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierLeadSoftware extends Model
{
    protected $table = 'supplier_lead_software';

    /**
     * Get the Order type record associated.
     */
    public function software()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
