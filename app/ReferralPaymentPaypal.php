<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralPaymentPaypal extends Model
{
    protected $table = 'referral_payment_paypal';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'payment_via', 'paypal_email','payee_name', 'company_name', 'address1', 'address2', 'city', 'state', 'zip', 'country', 'phone', 'legal_name', 'account_type','social_security_number','federal_employer_identification_number'];

}
