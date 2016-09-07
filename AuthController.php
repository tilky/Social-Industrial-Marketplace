<?php



namespace App\Http\Controllers\Auth;



use Validator;

use App\UserDetails;

use App\UsersActivity;

use App\UserUnique;

use App\Company;

use App\CompanyUsers;

use App\CompanyIndustries;

use App\Referrals;

use App\ReferralsLinks;

use App\InviteUsersDetail;

use App\SingupEmailVerification;

use App\EmailVerification;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\ThrottlesLogins;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Session;

use App\User;

use Input;

use Mail;

use Google_Client;



class AuthController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Registration & Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles the registration of new users, as well as the

    | authentication of existing users. By default, this controller uses

    | a simple trait to add these behaviors. Why don't you explore it?

    |

    */



    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/user-dashboard'; //or whatever route you want

    /**

     * Create a new authentication controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('guest', ['except' => 'getLogout']);

    }



    /**

     * Get a validator for an incoming registration request.

     *

     * @param  array  $data

     * @return \Illuminate\Contracts\Validation\Validator

     */

    protected function validator(array $data)

    {

        return Validator::make($data, [

            'firstname' => 'required|max:255',

            'lastname' => 'required|max:255',

            'email' => 'required|email|max:255|unique:users',

            'password' => 'required|confirmed|min:6',

            //'main_industry' => 'required'

        ]);

    }

    

    /**

     * generate random code

     */

    public function randomCode() {

        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";

        $code = array(); //remember to declare code as an array

        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

        for ($i = 0; $i < 25; $i++) {

            $n = rand(0, $alphaLength);

            $code[] = $alphabet[$n];

        }

        return implode($code); //turn the array into a string

    }

    public function CheckReferralLink($user_id,$usernamecheck,$cnt)

    {

        $userData = UserDetails::where('user_id',$user_id)->first();

        $username = $userData->first_name;

        

        $checkLink = ReferralsLinks::where('referral_code',$usernamecheck)->first();

        if($checkLink)

        {

            $cnt++;

            $usernamecheck = $username.$cnt;

            $linkcode = $this->CheckReferralLink($userData->user_id,$usernamecheck,$cnt);

            

        }

        else

        {

            $linkcode = $usernamecheck;

        }

        return $linkcode;

    }

    

    /**

     * for set seo friendly url

     */

    public function seo_friendly_url($string){

        $string = str_replace(array('[\', \']'), '', $string);

        $string = preg_replace('/\[.*\]/U', '', $string);

        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);

        $string = htmlentities($string, ENT_COMPAT, 'utf-8');

        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );

        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);

        return strtolower(trim($string, '-'));

    }

    

    /**

     * Create a new user instance after a valid registration.

     *

     * @param  array  $data

     * @return User

     */

    protected function create(array $data)

    {
        echo $_REQUEST['teamId']; exit(0);

        $userType = $data['user_type'];

        

        if($userType == 4)

        {

            $data['account_type'] = 4;    

        }

        elseif($userType == 3)

        {

            $data['account_type'] = 3;

            Session::put('dasboard_type',1);

        }

        else

        {

            $data['account_type'] = 2;

            Session::put('dasboard_type',1);

        }

        

        $unique = UserUnique::first();

        $next = $unique->number+1;

        $unique->number = $next;

        $unique->save();

        

        $unique_number = 'IJU-'.$next;

        

        $external_url = $this->seo_friendly_url($data['firstname'].'-'.$data['lastname']).'-'.$unique_number;

        

        $user = User::create([

            'name' => $data['firstname'],

            'email' => $data['email'],

            'password' => bcrypt($data['password']),

            'access_level' => $data['account_type'],

            'unique_number' => $unique_number,

            'external_url' => $external_url,

            'login_count'=>1

        ]);

        

        //remove verification data

        $singupemail = SingupEmailVerification::where('email',$data['email'])->first();

        if($singupemail)

        {

            $singupemail->delete();

        }

        

        if($userType != 4)

        {

            

            if($data['account_type'] == 1)

            {

                $account_type = 'Super Admin';

            }

            elseif($data['account_type'] == 2)

            {

                $account_type = 'buyer';

            }

            elseif($data['account_type'] == 3)

            {

                $account_type = 'Seller';

            }

            

            

            $userData = New UserDetails;

            $userData->first_name = $data['firstname'];

            $userData->last_name = $data['lastname'];

            $userData->user_id = $user->id;

            //$userData->industry_id = $data['main_industry'];
            $userData->industry_id = $data['industry'];

            //$userData->profile_picture = $profile_picture;

            $userData->account_type = $account_type;

            $userData->is_active = 1;

            $userData->save();

            

            /// user referral link generate

            $username = $userData->first_name;

            $cnt = 0;

            $checkLink = $this->CheckReferralLink($userData->user_id,$username,$cnt);

            $referralLinkCheck = 

            $referralLink = new ReferralsLinks;

            $referralLink->user_id = $userData->user_id;

            $referralLink->referral_code = $checkLink;

            $referralLink->save();

            

        }

        else

        {

            $company_owner = NULL;

            $companyData['name'] = $data['firstname'];

            $companyData['email'] = $data['email'];

            $companyData['is_active'] = 1;

            $companyData['user_id'] = $user->id;

            $companyData['owner_id'] = NULL;

            $companyData['company_industry'] = $data['reg_industry'];

            

            

            $company = Company::create($companyData);

            if(array_key_exists('company_industry',$companyData))

            {

                $industry = new CompanyIndustries();

                $industry->company_id = $company->id;

                $industry->industry_id = $companyData['company_industry'];

                $industry->save();

            }

        }

        

        $inviteUsers = InviteUsersDetail::whereRaw('email = ? AND invite_status =? ',array($data['email'],2))->get();

        foreach($inviteUsers as $inviteUser)

        {

            $inviteUser->invite_status = 3;

            $inviteUser->save();

        }

        

        

        /// for referral data save

        if($data['referral_code'] != '')

        {

            $referral_to = $user->id;

            $referral_code = $data['referral_code'];

            if($referral_code != '')

            {

                $referralLink = ReferralsLinks::where('referral_code',$referral_code)->first();

                if($referralLink)

                {

                    $referral_by = $referralLink->user_id;

                    $referral_link_id = $referralLink->id;

                    

                    $referral = new Referrals;

                    $referral->referral_by = $referral_by;

                    $referral->referral_to = $referral_to;

                    $referral->referral_link_id = $referral_link_id;

                    $referral->paid_referral_by = 0;

                    $referral->is_active = 1;

                    $referral->save();

                    

                     /// User Activity for message

                    $usersActivity = new UsersActivity;

                    $usersActivity->activity_name = 'You invited associates to Indy John on '.date('M d, Y').'.';

                    $usersActivity->activity_id = $referral_to;

                    $usersActivity->activity_type = 'invite_associates';

                    $usersActivity->creater_id = $referral_by;

                    $usersActivity->receiver_id = $referral_to;

                    $usersActivity->save();

                }

                

            }

        }

        

        // for first time pop for welcome message

        Session::put('new_user_first',1);

        Session::put('new_user_singup',1);
        
        Session::put('login_fifth',1);
        
        Session::put('login_first_popup',1);

        $filePath = base_path();

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

        

        $googleImportUrl = $client -> createAuthUrl();

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

        

        if($userType == 2)

        {

            $learn_more = url('');

            $quotetek_programe = url('');

            Input::replace(array('email' => $user->email,'name'=>$user->name));

            $data = array('name'=>Input::get('name'),'learn_more'=>$learn_more,'quotetek_programe'=>$quotetek_programe);

            Mail::send('admin.Emailtemplates.buyerSingup', $data, function($message){

                $message->from(env('MAIL_USERNAME'), 'Indy John Team');

                $message->to(Input::get('email'), Input::get('name'))->subject('Welcome to Indy John. A Social Industrial Marketplace.');

            });

        }

        else

        {

            Input::replace(array('email' => $user->email,'name'=>$user->name));

            $data = array('name'=>Input::get('name'));

            Mail::send('admin.Emailtemplates.sellerSingup', $data, function($message){

                $message->from(env('MAIL_USERNAME'), 'Indy John Team');

                $message->to(Input::get('email'), Input::get('name'))->subject('Welcome to Indy John: A Social Industrial Marketplace.');

            });

        }

        

        return $user;

    }



    public function getLogout() {

        Session::forget('restaurantId');

        Session::forget('user_type');

        Session::forget('user_default_dashboard');

        Session::forget('login_first_popup');

        Session::forget('login_fifth');

        Auth::logout();

        return redirect('/');

    }

}

