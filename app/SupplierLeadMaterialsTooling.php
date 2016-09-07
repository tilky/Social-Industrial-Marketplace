<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierLeadMaterialsTooling extends Model
{
    protected $table = 'supplier_lead_materials_tooling';

    /**
     * Get the Order type record associated.
     */
    public function materialsTooling()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
