<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Google_Client;
class BuyerSellerMiddleWare extends Authenticate
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
        
        if ($request->user() == null){
            return $next($request);
        }

        if ($request->user()->access_level == 2 || $request->user()->access_level == 3)
        {
            if($request->user()->access_level == 2)
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
                    
            }
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
            
            return $next($request);
        }else{
            return redirect('not-authorized');
        }


    }
}
