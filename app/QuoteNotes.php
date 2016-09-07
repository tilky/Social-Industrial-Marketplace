<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteNotes extends Model
{
    protected $table = 'quote_notes';

    /**
     * Get the note user 
     */
    public function noteUser()
    {
        return $this->belongsTo('App\User',"user_id");
    }
}
