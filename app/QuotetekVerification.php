<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotetekVerification extends Model
{
    protected $table = 'quotetek_verification';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','apply','linkedin_link','facebook_link','driving_license','state_id_card','ref_1_name','ref_1_phone','ref_1_email','ref_1_relation','ref_1_description',
                            'ref_2_name','ref_2_phone','ref_2_email','ref_2_relation','ref_2_description','is_active'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

   
    public function proofs()
    {
        return $this->hasMany('App\QuotetekVerificationProof','quotetek_verification_id');
    }
}
