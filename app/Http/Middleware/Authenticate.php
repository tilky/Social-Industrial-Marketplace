<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\Quotes;
use App\UserDetails;
use App\User;
use App\OrderTypes;
use App\Company;
use App\CompanyAdmin;
use App\Product;
use App\Industry;
use App\Category;
use App\Accreditation;
use App\Diversity;
use App\QuoteAccreditation;
use App\QuoteCategories;
use App\QuoteProducts;
use App\Message;
use App\Participant;
use App\Thread;
use App\QuoteIndustries;
use App\QuoteTypePurchase;
use App\QuoteTypeRentlease;
use App\QuoteTypeService;
use App\QuoteDiversity;
use App\SupplierIgnoreQuotes;
use App\MarketplaceProducts;
use App\MarketplaceProductCategories;
use App\MarketplaceProductIndustries;
use App\MarketplaceProductGallery;
use App\UserAccountSettings;

use Input;
use Auth;
use Response;
use Google_Client;
use Redirect;
use Route;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }
        if($request->user()->access_level == 1)
        {
            Session::put('user_type','admin');
        }
        elseif($request->user()->access_level == 2)
        {
            
            if(Session::has('user_type'))
            {
                if(Session::get('user_type') == 'supplier')
                {
                    Session::put('user_type','supplier');
                }
                else
                {
                    Session::put('user_type','buyer');
                }
                
            }
            else
            {
                Session::put('user_type','buyer');
            }
            
            $thread_user = Thread::forUserWithNewMessages($request->user()->id)->latest('updated_at')->get();
            foreach($thread_user as $thread)
            {
                $creator_id = $thread->creator()->id;
                $thread->user = User::find($creator_id);
            }
            
            Session::put('new_messages',$thread_user);
        }
        elseif($request->user()->access_level == 3)
        {
            if(Session::has('user_type'))
            {
                if(Session::get('user_type') == 'supplier')
                {
                    Session::put('user_type','supplier');
                }
                else
                {
                    Session::put('user_type','buyer');
                }
                
            }
            else
            {
                Session::put('user_type','buyer');
            }
            $thread_user = Thread::forUserWithNewMessages($request->user()->id)->latest('updated_at')->get();
            foreach($thread_user as $thread)
            {
                $creator_id = $thread->creator()->id;
                $thread->user = User::find($creator_id);
            }
            
            Session::put('new_messages',$thread_user);
        }
        elseif($request->user()->access_level == 4)
        {
            Session::put('user_type','company');
        }
        $input = array();
        
        
        /*$filePath = base_path();
        include( $filePath.'/google-api-php-client/vendor/autoload.php' );
        
        $google_redirect_uri = env('GOOGLE_INVITE_REDIRECT_URL', '');
        $google_client_id = env('GOOGLE_CLIENT_ID', '');
        $google_client_secret = env('GOOGLE_CLIENT_SECRETE', '');
        
        //setup new google client
        $client = new Google_Client();
        $client -> setApplicationName('Quotetek Contact');
        $client -> setClientid($google_client_id);
        $client -> setClientSecret($google_client_secret);
        $client -> setRedirectUri($google_redirect_uri);
        $client -> setAccessType('online');
        
        $client -> setScopes('https://www.google.com/m8/feeds');
        
        $googleImportUrl = $client -> createAuthUrl();*/
        $google_redirect_uri = env('GOOGLE_INVITE_REDIRECT_URL', '');
        $google_client_id = env('GOOGLE_CLIENT_ID', '');
        $google_client_secret = env('GOOGLE_CLIENT_SECRETE', '');
        $googleImportUrl = 'https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=online&client_id='.$google_client_id.'&redirect_uri='.$google_redirect_uri.'&state&scope=https%3A%2F%2Fwww.google.com%2Fm8%2Ffeeds&approval_prompt=auto';
        Session::put('google_invite_url',$googleImportUrl);
        
        /// MSN Contact
        $msn_redirect_uri = env('MSN_INVITE_REDIRECT_URL', '');
        $msn_client_id = env('MSN_CLIENT_ID', '');
        $msn_client_secret = env('MSN_CLIENT_SECRETE', '');
        $msnImportUrl = 'https://login.live.com/oauth20_authorize.srf?client_id='.$msn_client_id.'&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri='.$msn_redirect_uri;
        Session::put('msn_invite_url',$msnImportUrl);
        
        $overview_flg = 0;
        if(!Session::has('login_first_popup'))
        {
            $overview_flg = 1;
            Session::put('login_first_popup',1);    
        }
        
        // check user login count for upgrade modal
        $user = User::find($request->user()->id);
        $login_count = $user->login_count;
        
        $upgrade_flg = 0;
        if(!Session::has('login_fifth'))
        {
            if($login_count == '' || $login_count == 0 || $login_count == 5)
            {
                $user->login_count = 1;
                $user->save();
            }
            else
            {
                $user->login_count = $login_count + 1;
                $user->save();
            }    
            
            if($user->login_count == 5)
            {
                $upgrade_flg = 1;
                $overview_flg = 0;
                Session::put('login_fifth',1);
                Session::put('login_first_popup',1);
            }
            else
            {
                Session::put('login_fifth',1);
            }
        }
        
        
        
        // check for company owner
        if(Session::has('company_code'))
        {
            $code = Session::get('company_code');
            $user = Auth::user();
            $companyAdmin = CompanyAdmin::whereRaw('unique_code = ? AND email = ?',array($code,$user->email))->first();
            if($companyAdmin)
            {
                $user_id = Auth::user()->id;
                $company_id = $companyAdmin->company_id;
                $company = Company::find($company_id);
                $company->owner_id = $user_id;
                $company->save();
                
                $companyAdmin->delete();
            }
        }
        
        if(Session::has('dasboard_type'))
        {
            $dasboard_type = Session::get('dasboard_type');
            
            Session::forget('dasboard_type');
            
            if($dasboard_type == 1)
            {
                return Redirect::to('user-details');    
            }
            else
            {
                if($upgrade_flg == 1)
                {
                    return Redirect::to('user-dashboard?popup=upgrade');    
                }
                elseif($overview_flg == 1)
                {
                    return Redirect::to('user-dashboard?popup=overview');
                }
                else
                {
                    return $next($request);
                }
                 
            }
            //return redirect('contactusers/create');
        }
        else
        {
            // for check user default dashboard set
            if(Session::has('user_default_dashboard'))
            {
                return $next($request);    
            }
            else
            {
                $user_id = Auth::user()->id;
                $account_settings = UserAccountSettings::where('user_id',$user_id)->first();
                if($account_settings)
                {
                    Session::put('user_default_dashboard',1);
                    
                    $mode = $account_settings->default_account_mode;
                    if($mode == 1)
                    {
                        if($upgrade_flg == 1)
                        {
                            return Redirect::to('dashboard/supplier?popup=upgrade');
                        }
                        elseif($overview_flg == 1)
                        {
                            return Redirect::to('dashboard/supplier?popup=overview');
                        }
                        else
                        {
                            return Redirect::to('dashboard/supplier');
                        }
                        
                    }    
                }
                else
                {
                    if($upgrade_flg == 1)
                    {
                        return Redirect::to('user-dashboard?popup=upgrade');    
                    }
                    elseif($overview_flg == 1)
                    {
                        return Redirect::to('user-dashboard?popup=overview');
                    }
                    else
                    {
                        return $next($request);
                    }
                    //return $next($request);
                }
                //return $next($request);
            }
        }
        
    }
}
