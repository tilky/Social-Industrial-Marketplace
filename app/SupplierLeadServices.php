<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierLeadServices extends Model
{
    protected $table = 'supplier_lead_services';

    /**
     * Get the Order type record associated.
     */
    public function service()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
