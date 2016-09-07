<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Http\Traits\Messagable;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use Messagable;
    //use Billable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','access_level','email_verify','unique_number','external_url','login_count','temporary_password','is_using_temporary_password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
     protected $dates = ['trial_ends_at', 'subscription_ends_at'];
    
    /**
     * Get the user messages
     */
    public function messages()
    {
        return $this->hasMany('App\Message','user_id')->orderBy('id','desc');
    }
    
    public function messagesThred()
    {
        return $this->hasMany('App\Thread','user_id')->orderBy('id','desc');
    }
    
    /**
     * Get the user technical services
     */
    public function techServices()
    {
        return $this->hasMany('App\UserTechServices','user_id');
    }
    
    /**
     * Get the user marketplace products
     */
    public function marketplaceProducts()
    {
        return $this->hasMany('App\MarketplaceProducts','user_id')->orderBy('id','desc');
    }
    
    /**
     * Get the user review
     */
    public function reviews()
    {
        return $this->hasMany('App\Reviews','receiver_id')->orderBy('id','desc');
    }
    
    /**
     * Get the user endorsement
     */
    public function endorsements()
    {
        return $this->hasMany('App\Endorsements','receiver_id')->orderBy('id','desc');
    }
    
    /**
     * Get the user feedbacks
     */
    public function feedbacks()
    {
        return $this->hasMany('App\Feedbacks','receiver_id')->orderBy('id','desc');
    }
    
    /**
     * Get the user data
     */
    public function userdetail()
    {
        return $this->hasOne('App\UserDetails',"user_id");
    }
    
    /**
     * Get the user data
     */
    public function userCompanyOwner()
    {
        return $this->hasMany('App\Company',"owner_id");
    }
    
    /**
     * Get the user data
     */
    public function companydetail()
    {
        return $this->hasOne('App\Company',"user_id");
    }
    
    /**
     * Get Industries
     */
    public function userIndustries()
    {
        return $this->hasMany('App\UserAdditionalIndustries','user_id');
    }
    
    /**
     * Get Categories
     */
    public function userCategories()
    {
        return $this->hasMany('App\UserCategories','user_id');
    }
    
    /**
     * Get jobs
     */
    public function userJobs()
    {
        return $this->hasMany('App\UserJobs','user_id');
    }
    
    /**
     * Get educationa details
     */
    public function userEducationDetails()
    {
        return $this->hasMany('App\UserEducationDetails','user_id');
    }
    
    /**
     * Get certification details
     */
    public function userCertifications()
    {
        return $this->hasMany('App\UserCertifications','user_id');
    }
    
    /**
     * Get awards details
     */
    public function userAwards()
    {
        return $this->hasMany('App\UserAwards','user_id');
    }
    
    /**
     * Get member organization details
     */
    public function userMemberOrganizations()
    {
        return $this->hasMany('App\UserMemberOrganizations','user_id');
    }
    
    /** wizard track
     */
    public function getWizardTrack()
    {
        
        return $this->hasOne('App\UserWizardTrack','user_id');    
    }

    public function getSupplierTeam()
    {
        return $this->hasOne('App\SupplierTeam','user_id');
    }

    public function getBuyerTeam()
    {
        return $this->hasOne('App\BuyerTeam','user_id');
    }

}
