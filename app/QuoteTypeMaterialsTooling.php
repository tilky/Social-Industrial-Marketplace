<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteTypeMaterialsTooling extends Model
{
    protected $table = 'quote_type_materials_tooling';

    /**
     * Get the Order type record associated.
     */
    public function materialsTooling()
    {
        return $this->belongsTo('App\OrderTypes',"order_type_id");
    }
}
