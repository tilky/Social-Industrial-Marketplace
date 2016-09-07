<?php

namespace App\Http\Controllers;

use App\ContactUsers;
use App\UserDetails;
use App\User;
use App\Company;
use App\CompanyUnique;
use App\CompanySave;
use App\ReferralsLinks;
use App\InviteUsersDetail;
use App\ApiAuthCodes;
use App\ContactSave;
use App\UsersActivity;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Input;
use Auth;
use Google_Client;
use Session;
use Response;
use Mail;

class ContactUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $contactsObj = ContactUsers::whereRaw('(sender_user_id = ? OR request_user_id = ?)  AND status = ?',array($user_id,$user_id,1))->orderBy('id', 'desc')->paginate(15);
        $contacts = array();
        foreach($contactsObj as $contact)
        {
            if($user_id == $contact->request_user_id)
            {
                $contactUserId = $contact->sender_user_id;
                $contactCompanyId = $contact->sender_user_company_id;
            }
            else
            {
                $contactUserId = $contact->request_user_id;
                $contactCompanyId = $contact->request_user_company_id;
            }
            
            $userData = User::find($contactUserId);
            if($userData->userdetail->company_id != '')
            {
                $company = Company::find($userData->userdetail->company_id);
                $userData->company_name = $company->name;
            }
            else
            {
                $userData->company_name = '';
            }
            if($userData->account_member == 'gold')
            {
                $userData->star = 'gold';
            }
            elseif($userData->account_member == 'silver')
            {
                $userData->star = 'silver';
            }
            else
            {
                $userData->star = 'none';
            }
            $contact->user = $userData;
        }
        
        return view('contactusers.index')->with([
                                                'contacts'=>$contactsObj,
                                                ]);
    }
    
    /**
     * saved contacts
     */
    public function viewContactUserSaved()
    {
        $user_id = Auth::user()->id;
        
        $savedContacts = ContactSave::where('sender_id',$user_id)->orderBy('id', 'desc')->paginate(15);
        foreach($savedContacts as $savedContact)
        {
            $receiver_id = $savedContact->receiver_id;
            $userData = User::find($receiver_id);
            if($userData->userdetail->company_id != '')
            {
                $company = Company::find($userData->userdetail->company_id);
                $userData->company_name = $company->name;
            }
            else
            {
                $userData->company_name = '';
            }
            if($userData->account_member == 'gold')
            {
                $userData->star = 'gold';
            }
            elseif($userData->account_member == 'silver')
            {
                $userData->star = 'silver';
            }
            else
            {
                $userData->star = 'none';
            }
            $savedContact->user = $userData;
        }
        return view('contactusers.savedContact')->with([
                                                'contacts'=>$savedContacts,
                                                ]);
    }
    
    /**
     * saved companies
     */
    public function viewCompanySaved()
    {
        $user_id = Auth::user()->id;
        
        $savedCompanies = CompanySave::where('user_id',$user_id)->orderBy('id', 'desc')->paginate(15);
        foreach($savedCompanies as $company)
        {
            $company->companyData = Company::find($company->company_id);
            $company->user = User::find($company->companyData->user_id);
        }
        return view('contactusers.savedCompanies')->with([
                                                'companies'=>$savedCompanies,
                                                ]);
    }
    
    /**
     * remove saved company
     */
    public function removeCompanySaved($user_id,$company_id)
    {
        $savedCompany = CompanySave::whereRaw('user_id = ? AND company_id = ?',array($user_id,$company_id))->first();
        if($savedCompany)
        {
            $savedCompany->delete();
            return Redirect::back()->with('message', 'Successfully company removed.');
        }
        else
        {
            return Redirect::back()->with('message', 'Error in revoew company.');
        }
    }
    
    /**
     * Pending Connections
     */
    public function viewContactUserPending()
    {
        $user_id = Auth::user()->id;
        
        $contactsObj = ContactUsers::whereRaw('request_user_id = ? AND status = ?',array($user_id , 0))->orderBy('id', 'desc')->paginate(15);
        $contacts = array();
        foreach($contactsObj as $contact)
        {
            if($user_id == $contact->request_user_id)
            {
                $contactUserId = $contact->sender_user_id;
                $contactCompanyId = $contact->sender_user_company_id;
            }
            else
            {
                $contactUserId = $contact->request_user_id;
                $contactCompanyId = $contact->request_user_company_id;
            }
            
            $userData = User::find($contactUserId);
            if($userData->userdetail->company_id != '')
            {
                $company = Company::find($userData->userdetail->company_id);
                $userData->company_name = $company->name;
            }
            else
            {
                $userData->company_name = '';
            }
            if($userData->account_member == 'gold')
            {
                $userData->star = 'gold';
            }
            elseif($userData->account_member == 'silver')
            {
                $userData->star = 'silver';
            }
            else
            {
                $userData->star = 'none';
            }
            $contact->user = $userData;
        }
        
        return view('contactusers.pendingContact')->with([
                                                'contacts'=>$contactsObj,
                                                ]);
    }
    
    /**
     * Awaiting Contacts
     */
    public function viewContactUserAwaiting()
    {
        $user_id = Auth::user()->id;
        $invitedContacts = ContactUsers::whereRaw('sender_user_id = ? AND status = ?',array($user_id,0))->orderBy('id', 'desc')->paginate(15);
        
        foreach($invitedContacts as $invitedContact)
        {
            $invitedContact->user = User::find($invitedContact->request_user_id);
        }
        
        return view('contactusers.awaitingContact')->with([
                                                'contacts'=>$invitedContacts,
                                                ]);
    }
    
    /**
     * Invited Contacts
     */
    public function viewContactUserInvited()
    {
        $user_id = Auth::user()->id;
        $invitedAcceptedConatcs = InviteUsersDetail::whereRaw('user_id = ? AND (invite_status = ? OR invite_status = ?)',array($user_id,3,2))->orderBy('id', 'desc')->paginate(15);
        foreach($invitedAcceptedConatcs as $invitedAcceptedConatc)
        {
            $invitedContact = User::where('email',$invitedAcceptedConatc->email)->first();
            if($invitedContact)
            {
                $invitedAcceptedConatc->accept = 1;
                $invitedAcceptedConatc->user = User::find($invitedContact->id);
                $inviteUserId = $invitedAcceptedConatc->user->id;
                $conactReq = ContactUsers::whereRaw('(sender_user_id = ? OR request_user_id = ?) AND (sender_user_id = ? OR request_user_id = ?) AND status = ?',array($user_id,$user_id,$inviteUserId,$inviteUserId,1))->orderBy('id', 'desc')->first();
                if($conactReq)
                {
                    $invitedAcceptedConatc->linked = 1;
                }
                else
                {
                    $invitedAcceptedConatc->linked = 0;
                }
                
                
                if($invitedAcceptedConatc->user->account_member == 'gold')
                {
                    $invitedAcceptedConatc->user->star = 'gold';
                }
                elseif($invitedAcceptedConatc->user->account_member == 'silver')
                {
                    $invitedAcceptedConatc->user->star = 'silver';
                }
                else
                {
                    $invitedAcceptedConatc->user->star = 'none';
                }
            }
            else
            {
                $invitedAcceptedConatc->accept = 0;
            }
            
        }
        
        return view('contactusers.invitedContact')->with([
                                                'contacts'=>$invitedAcceptedConatcs,
                                                ]);
    }
    
    
    /**
      * Remove dupliacet entry from search result company
      */
     public function unique_multidim_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view.
        $user_id = Auth::user()->id;
        
        // logged in user detail 
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        
        // get alread requested users for filter 
        $userConatcs = ContactUsers::where('sender_user_id',$user_id)->get();
        $userConatctListArray = array();
        foreach($userConatcs as $conatclist)
        {
            $userConatctListArray[] = $conatclist['request_user_id'];
        }
        
        $userAddedConatcs = ContactUsers::whereRaw('request_user_id = ? AND status = ?',array($user_id,1))->get();
        foreach($userAddedConatcs as $conatclist)
        {
            $userConatctListArray[] = $conatclist['sender_user_id'];
        }
        
        // for super admin filter
        $superAdmins = User::where('access_level',1)->get();
        foreach($superAdmins as $superAdmin)
        {
            $userConatctListArray[] = $superAdmin->id;
        }
        
        // search users
        if(isset($_REQUEST['search']))
        {
            $search = str_replace('+',' ',$_REQUEST['search']);
            $searchContacArray = array();
            
            // search from User Details
            $usersDetail = UserDetails::getUsersBySearch($search,$user_id);
            if(!empty($usersDetail))
            {
                foreach($usersDetail as $user)
                {
                    if(!in_array($user['user_id'],$userConatctListArray)):
                        $dataArray['req_user_id'] = $user['user_id'];
                        $company_id = $user['company_id'];
                        if($company_id != '')
                        {
                            $companyUser = Company::find($company_id);    
                            $dataArray['req_user_company_name'] = $companyUser->name;
                            $dataArray['req_user_city'] = $companyUser->city;
                            $dataArray['req_user_country'] = $companyUser->country;
                        }
                        else
                        {
                            $dataArray['req_user_company_name'] = '';
                            $dataArray['req_user_city'] = '';
                        $dataArray['req_user_country'] = '';
                        }
                        $dataArray['req_user_name'] = $user['first_name'].' '.$user['last_name'];
                        
                        $checkForcommonReq = ContactUsers::whereRaw('sender_user_id = ? AND request_user_id = ? AND status = ?',array($user['user_id'],$user_id,0))->first();
                        if($checkForcommonReq)
                        {
                            $dataArray['id'] = $checkForcommonReq->id;
                            $dataArray['common_req'] = 1;
                        }
                        else
                        {
                            $dataArray['id'] = '';
                            $dataArray['common_req'] = 0;
                        }
                        $searchContacArray[] = $dataArray;
                    endif;
                }
            }
            
            // Search for company
            $compnayDetail = Company::getCompaniesByserach($search);
            if(!empty($compnayDetail))
            {
                foreach($compnayDetail as $company)
                {
                    $company_id = $company['id'];
                    $company_name = $company['name'];
                    $companyUsersDetail = UserDetails::getUsersByCompany($company_id,$user_id);
                    foreach($companyUsersDetail as $companyUser)
                    {
                        $dataArray = array();
                        if(!in_array($companyUser->user_id,$userConatctListArray)):
                            $dataArray['req_user_id'] = $companyUser->user_id;
                            $dataArray['req_user_name'] = $companyUser->first_name.' '.$companyUser->last_name;
                            $dataArray['req_user_company_name'] = $company_name;
                            $dataArray['req_user_city'] = $company['city'];
                            $dataArray['req_user_country'] = $company['country'];
                            $checkForcommonReq = ContactUsers::whereRaw('sender_user_id = ? AND request_user_id = ? AND status = ?',array($companyUser->user_id,$user_id,0))->first();
                            if($checkForcommonReq)
                            {
                                $dataArray['id'] = $checkForcommonReq->id;
                                $dataArray['common_req'] = 1;
                            }
                            else
                            {
                                $dataArray['id'] = '';
                                $dataArray['common_req'] = 0;
                            }
                            $searchContacArray[] = $dataArray;
                        endif;
                    }
                }
            }
            
            $searchContacArray = $this->unique_multidim_array($searchContacArray,'req_user_id');
        }
        else
        {
            $search = '';
            $searchContacArray = array();
        }
        
        $filePath = base_path();
        
        /// Yahoo Contact
        include( $filePath.'/yahoo_api/globals.php');
        include( $filePath.'/yahoo_api/oauth_helper.php');
        
        $yahoo_redirect_uri = env('YAHOO_REDIRECT_URL', '');
        $yahoo_client_id = env('YAHOO_CLIENT_ID', '');
        $yahoo_client_secret = env('YAHOO_CLIENT_SECRETE', '');
        $yahooImportUrl = '';
        $callback = $yahoo_redirect_uri; 
        // Get the request token using HTTP GET and HMAC-SHA1 signature 
        $retarr = get_request_token($yahoo_client_id, $yahoo_client_secret, $callback, false, true, true);
        
        if (! empty($retarr)){ 
            list($info, $headers, $body, $body_parsed) = $retarr; 
            if ($info['http_code'] == 200 && !empty($body)) { 
                // print "Have the user go to xoauth_request_auth_url to authorize your app\n" . 
                //  rfc3986_decode($body_parsed['xoauth_request_auth_url']) . "\n"; 
                //echo "<pre/>"; 
                //print_r($retarr); 
                Session::forget('contact_yahoo_request_token');
                Session::forget('contact_yahoo_request_token_secret');
                
                Session::put('contact_yahoo_request_token',$body_parsed['oauth_token']);
                Session::put('contact_yahoo_request_token_secret',$body_parsed['oauth_token_secret']); 
                $yahooImportUrl = urldecode($body_parsed['xoauth_request_auth_url']);
             } 
         }
         
        // Google Contact
        /*include( $filePath.'/google-api-php-client/vendor/autoload.php' );
        
        
        
        //setup new google client
        $client = new Google_Client();
        $client -> setApplicationName('Quotetek Contact');
        $client -> setClientid($google_client_id);
        $client -> setClientSecret($google_client_secret);
        $client -> setRedirectUri($google_redirect_uri);
        $client -> setAccessType('online');
        
        $client -> setScopes('https://www.google.com/m8/feeds');
        
        $googleImportUrl = $client -> createAuthUrl();*/
        $google_redirect_uri = env('GOOGLE_REDIRECT_URL', '');
        $google_client_id = env('GOOGLE_CLIENT_ID', '');
        $google_client_secret = env('GOOGLE_CLIENT_SECRETE', '');
        $googleImportUrl = 'https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=online&client_id='.$google_client_id.'&redirect_uri='.$google_redirect_uri.'&state&scope=https%3A%2F%2Fwww.google.com%2Fm8%2Ffeeds&approval_prompt=auto';
        
        /// MSN Contact
        $msn_redirect_uri = env('MSN_REDIRECT_URL', '');
        $msn_client_id = env('MSN_CLIENT_ID', '');
        $msn_client_secret = env('MSN_CLIENT_SECRETE', '');
        $msnImportUrl = 'https://login.live.com/oauth20_authorize.srf?client_id='.$msn_client_id.'&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri='.$msn_redirect_uri;
        
        return view('contactusers.create')->with([
                                                'userData' => $userData,
                                                'search' => $search,
                                                'searchContac' => $searchContacArray,
                                                'googleImportUrl' => $googleImportUrl,
                                                'msnImportUrl' => $msnImportUrl,
                                                'yahooImportUrl' => $yahooImportUrl
                                                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show Contact User Information
        $contact = ContactUsers::find($id);
        $user_id = Auth::user()->id;
        if($user_id == $contact->request_user_id)
        {
            $contactUserId = $contact->sender_user_id;
            $contactCompanyId = $contact->sender_user_company_id;
        }
        else
        {
            $contactUserId = $contact->request_user_id;
            $contactCompanyId = $contact->request_user_company_id;
        }
        
        $userDetail = UserDetails::where('user_id',$contactUserId)->first();
        $user = User::find($contactUserId);
        if($contactCompanyId != '')
        {
            $userCompany = Company::find($contactCompanyId);    
        }
        else
        {
            $userCompany = new Company;
        }
        
        return view('contactusers.view')->with(['user'=>$user,'userDetail'=>$userDetail,'userCompany'=>$userCompany]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Contact
        $contact = ContactUsers::find($id);
        $contact->delete();
        return Redirect::to('contactusers')->with('message', 'Your contact has been successfully deleted.');
    }
    
    /**
     * search conatc
     * 
     * @return \Illuminate\Http\Response
     */
     public function searchConatcs(Request $request)
     {
        $this->validate($request, [
            'search' => 'required',
        ]);
        
        $search = str_replace(' ',"+",Input::get('search'));
        return Redirect::to('contactusers/create?search='.$search);
     }
     
     /**
      * request send for conact user
      * 
      */
      public function requestConatcUser($sender_id,$request_id)
      {
        $ContactSave = ContactSave::whereRaw('sender_id = ? AND receiver_id = ?',array($sender_id,$request_id))->first();
        if($ContactSave)
        {
            $ContactSave->delete();
        }
        
        $ContactUsersObj = ContactUsers::whereRaw('sender_user_id = ? AND request_user_id = ?',array($sender_id,$request_id))->first();
        if($ContactUsersObj)
        {
            return Redirect::back()->with('message', 'You have already requested a connection to this user.');
        }
        else
        {
            $senderObj = User::find($sender_id);
            if($senderObj->access_level == 4)
            {
                $sendeCompanyId = NULL;
            }
            else
            {
                $sendeCompanyId = $senderObj->company_id;
                if($sendeCompanyId == '')
                {
                    $sendeCompanyId = NULL;
                }
            }
            $requestObj = User::find($request_id);
            if($requestObj->access_level == 4)
            {
                $requestCompanyId = NULL;
            }
            else
            {
                $requestCompanyId = $requestObj->company_id;
                if($requestCompanyId == '')
                {
                    $requestCompanyId = NULL;
                }    
            }
            
            
            $ContactUsersNewObj = new ContactUsers();
            $ContactUsersNewObj->sender_user_id = $sender_id;
            $ContactUsersNewObj->sender_user_company_id = $sendeCompanyId;
            $ContactUsersNewObj->request_user_id = $request_id;
            $ContactUsersNewObj->request_user_company_id = $requestCompanyId;
            $ContactUsersNewObj->status = 0;
            $ContactUsersNewObj->save();

            $usersActivity = new UsersActivity;
            $usersActivity->activity_name = 'New User sent connection Request';
            $usersActivity->activity_id = $ContactUsersNewObj->id;
            $usersActivity->activity_type = 'new user connection';
            $usersActivity->creater_id = $sender_id;
            $usersActivity->receiver_id = $request_id;
            $usersActivity->save();

            $sender = User::find($sender_id);
            if($sender->access_level == 4)
            {
                $sender_name = $sender->name;
            }
            else
            {
                $sender_name = $sender->userdetail->first_name.' '.$sender->userdetail->last_name;
            }
            $receiver = User::find($request_id);
            if($receiver->access_level == 4)
            {
                $receiver_name = $receiver->name;
            }
            else
            {
                $receiver_name = $receiver->userdetail->first_name.' '.$receiver->userdetail->last_name;
            }
            
            
            $data = array('name'=>$receiver_name,'sender_name'=>$sender_name);

            Input::replace(array('email' => $receiver->email,'name'=>$receiver_name));
    
            Mail::send('admin.Emailtemplates.newConnection', $data, function($message){
    
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
    
                $message->to(Input::get('email'), Input::get('name'))->subject('You Received a Connection Request on Indy John.');
    
            });
            
            return Redirect::back()->with('message', 'Your connection request has been successfully sent.');
        }
      }
      
     /**
     * request for padding contact users
     */
    public function panddingConatcUser()
    {
        $user_id = Auth::user()->id;
        $user_id = Auth::user()->id;
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        
        $panddingConatcListArray = array();
        $contacUsersObj = ContactUsers::whereRaw('request_user_id = ? AND status = ?',array($user_id , 0))->get();
        
        foreach($contacUsersObj as $contactuser)
        {
            $dataArray = array();
            $dataArray['id'] = $contactuser->id;
            $dataArray['sender_user_id'] = $contactuser->sender_user_id;
            $company_id = $contactuser->sender_user_company_id;
            if($company_id != '')
            {
                $companyUser = Company::find($company_id);
                $dataArray['sender_user_company_name'] = $companyUser->name;
                $dataArray['sender_user_city'] = $companyUser->city;
                $dataArray['sender_user_country'] = $companyUser->country;    
            }
            else
            {
                $dataArray['sender_user_company_name'] = '';
                $dataArray['sender_user_city'] = '';
                $dataArray['sender_user_country'] = '';
            }
            $senderUserObj = UserDetails::where('user_id',$contactuser->sender_user_id)->first();
            $dataArray['sender_user_name'] = $senderUserObj->first_name.' '.$senderUserObj->last_name;
            
            $panddingConatcListArray[] = $dataArray;
        }
        return view('contactusers.pandding')->with(['userData'=>$userData,'panddingConatcList'=>$panddingConatcListArray]);
    }
       
    /**
    * approve contact request
    * 
    */
    public function approvePanddingConatcUser($id)
    {
        $ContactUsersObj = ContactUsers::find($id);
        $ContactUsersObj->status = 1;
        $ContactUsersObj->save();

        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'Your connection request has been accepted.';
        $usersActivity->activity_id = $id;
        $usersActivity->activity_type = 'Approve Connection Request';
        $usersActivity->creater_id = $ContactUsersObj->request_user_id;
        $usersActivity->receiver_id = $ContactUsersObj->sender_user_id;
        $usersActivity->save();
        
        $findSameInvited = ContactUsers::whereRaw('sender_user_id =? AND request_user_id =?',array($ContactUsersObj->request_user_id,$ContactUsersObj->sender_user_id))->first();
        if($findSameInvited)
        {
            $findSameInvited->status = 1;
            $findSameInvited->save();
        }
        
        return Redirect('/contactusers')->with('message', 'Your connection request has been accepted.');
    }
    
    
    public function curl($url, $post = "") {
    	$curl = curl_init();
    	$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
    	curl_setopt($curl, CURLOPT_URL, $url);
    	//The URL to fetch. This can also be set when initializing a session with curl_init().
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    	//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    	//The number of seconds to wait while trying to connect.
    	if ($post != "") {
    		curl_setopt($curl, CURLOPT_POST, 5);
    		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    	}
    	curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
    	//The contents of the "User-Agent: " header to be used in a HTTP request.
    	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
    	//To follow any "Location: " header that the server sends as part of the HTTP header.
    	curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
    	//To automatically set the Referer: field in requests where it follows a Location: redirect.
    	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    	//The maximum number of seconds to allow cURL functions to execute.
    	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    	//To stop cURL from verifying the peer's certificate.
    	$contents = curl_exec($curl);
    	curl_close($curl);
    	return $contents;
    }

    
    /**
     * Google Verification Response
     */
    public function viewGoogleContact()
    {
        $searchContacArray = array();
        $user_id = Auth::user()->id;
        // logged in user detail 
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        
        if(Input::has('code'))
        {
            
            $code = Input::get('code');
            $google_client_id = env('GOOGLE_CLIENT_ID', '');
            $google_client_secret = env('GOOGLE_CLIENT_SECRETE', '');
            $google_redirect_uri = env('GOOGLE_REDIRECT_URL', '');
            
            $fields=array(
                'code'=>  urlencode($code),
                'client_id'=>  urlencode($google_client_id),
                'client_secret'=>  urlencode($google_client_secret),
                'redirect_uri'=>  urlencode($google_redirect_uri),
                'grant_type'=>  urlencode('authorization_code')
            );
            $post = '';
            foreach($fields as $key=>$value)
            {
                $post .= $key.'='.$value.'&';
            }
            $max_results = 2000;
            /// for get accesstoken
            $result = $this->curl('https://accounts.google.com/o/oauth2/token',$post);
            if($result === false)
            {
                return Redirect::to('contactusers/create')->with('message', 'There was a problem with your Google login. Please retry.');
            }
            else
            {
                $response =  json_decode($result);
                if(isset($response->access_token))
                {
                    $accesstoken = $response->access_token;
                    $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&alt=json&v=3.0&oauth_token='.$accesstoken;
                    $xmlresponse =  $this->curl($url);
                    if($xmlresponse === false)
                    {
                        return Redirect::to('contactusers/create')->with('message', 'There was a problem with your Gmail contact. Please retry.');
                    }
                    else
                    {
                        $contacts = json_decode($xmlresponse,true);
                 
                         $return = array();
                         if (!empty($contacts['feed']['entry'])) {
                             foreach($contacts['feed']['entry'] as $contact) {
                                //retrieve Name and email address 
                                 if(key_exists('gd$email',$contact))
                                 {
                                    $return[] = array (
                                     'name'=> $contact['title']['$t'],
                                     'email' => $contact['gd$email'][0]['address'],
                                     );   
                                 }
                                 
                             } 
                         }
                        
                        foreach($return as $googleuser)
                        {
                            $getuser = User::where('email',$googleuser['email'])->first();
                            if($getuser && $getuser->id != $user_id)
                            {
                                $user = UserDetails::where('user_id',$getuser->id)->first();
                                if($user)
                                {
                                    $dataArray['req_user_id'] = $user['user_id'];
                                    $company_id = $user['company_id'];
                                    if($company_id != '')
                                    {
                                        $companyUser = Company::find($company_id);    
                                        $dataArray['req_user_company_name'] = $companyUser->name;
                                        $dataArray['req_user_city'] = $companyUser->city;
                                        $dataArray['req_user_country'] = $companyUser->country;
                                    }
                                    else
                                    {
                                        $dataArray['req_user_company_name'] = '';
                                        $dataArray['req_user_city'] = '';
                                        $dataArray['req_user_country'] = '';
                                    }
                                    $dataArray['req_user_name'] = $user['first_name'].' '.$user['last_name'];
                                    
                                    $checkForcommonReq = ContactUsers::whereRaw('((sender_user_id = ? AND request_user_id = ?) OR (sender_user_id = ? AND request_user_id = ?)) AND status = ?',array($user['user_id'],$user_id,$user_id,$user['user_id'],0))->first();
                                    if($checkForcommonReq)
                                    {
                                        $dataArray['id'] = $checkForcommonReq->id;
                                        $dataArray['common_req'] = 1;
                                    }
                                    else
                                    {
                                        $dataArray['id'] = '';
                                        $dataArray['common_req'] = 0;
                                    }
                                    $searchContacArray[] = $dataArray;
                                    
                                }
                            }
                        }
                        
                        return view('contactusers.social')->with(['userData'=>$userData,'searchContac'=>$searchContacArray,'type'=>'Google']);
                    }   
                }
                else{
                    return Redirect::to('contactusers/create')->with('message', 'There was a problem with the invite. Please retry.');   
                }
            }
            
        }
        return Redirect::to('contactusers/create')->with('message', 'There was a problem with the invite. Please retry.');
    }
    
    /**
     * Invite Email view
     */
    public function viewInviteEmailContact()
    {
        $user_id = Auth::user()->id;
        // logged in user detail 
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        return view('contactusers.email-invite')->with(['userData'=>$userData]);
    }
    
    /**
     * Send email invitation
     */
    public function sendEmailInvitation()
    {
        $user_id = Auth::user()->id;
        $url = '';
        $referralCode = '';
        $referralLink = ReferralsLinks::where('user_id',$user_id)->first();
        if($referralLink)
        {
            $url = url('').'?referral='.$referralLink->referral_code;
            $referralCode = $referralLink->referral_code;
        }
        else
        {
            $url = url('');
        }
        $sendername = '';
        $userData = UserDetails::where('user_id',$user_id)->first();
        $userPic = '';
        if($userData)
        {
            $sendername = $userData->first_name.' '.$userData->last_name;
            $userPic = url('')."/".$userData->profile_picture;
        }
        else
        {
            $user = User::find($user_id);
            $sendername = $user->name;
        }
        $inviteUsers = explode(",",Input::get('email'));

        foreach($inviteUsers as $index => $invite)
        {
            Input::replace(array('email' => str_replace(' ','',$invite),'name'=>''));
            //Input::replace(array('email' => 'chauhan.gordhan@gmail.com','name'=>$invitename));
            $data = array('name'=>Input::get('name'),'sender_name'=>$sendername,'url'=>$url,'referralCode'=>$referralCode,'userPic'=>$userPic);
            Mail::send('admin.Emailtemplates.newReferrelInvite', $data, function($message) use ($data) {
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), Input::get('name'))->subject($data['sender_name'].' has invited you to join IndyJohn.com.');
            });
        }
        return Redirect::to('user-dashboard')->with('message', 'Your invitations were sent.');
    }
    
    /**
     * Invite Google Contact
     */
    public function viewInviteGoogleContact()
    {
        $user_id = Auth::user()->id;
        // logged in user detail 
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        
        if(Input::has('code'))
        {
            
            $code = Input::get('code');
            $google_client_id = env('GOOGLE_CLIENT_ID', '');
            $google_client_secret = env('GOOGLE_CLIENT_SECRETE', '');
            $google_redirect_uri = env('GOOGLE_INVITE_REDIRECT_URL', '');
            
            $fields=array(
                'code'=>  urlencode($code),
                'client_id'=>  urlencode($google_client_id),
                'client_secret'=>  urlencode($google_client_secret),
                'redirect_uri'=>  urlencode($google_redirect_uri),
                'grant_type'=>  urlencode('authorization_code')
            );
            $post = '';
            foreach($fields as $key=>$value)
            {
                $post .= $key.'='.$value.'&';
            }
            $max_results = 200;
            /// for get accesstoken
            $result = $this->curl('https://accounts.google.com/o/oauth2/token',$post);
            if($result === false)
            {
                return Redirect::to('user-dashboard')->with('message', 'There was a problem with your Google login. Please retry.');
            }
            else
            {
                $response =  json_decode($result);
                if(isset($response->access_token))
                {
                    $accesstoken = $response->access_token;
                    $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&alt=json&v=3.0&oauth_token='.$accesstoken;
                    $xmlresponse =  $this->curl($url);
                    if($xmlresponse === false)
                    {
                        return Redirect::to('user-dashboard')->with('message', 'There was a problem with the invite. Please retry.');
                    }
                    else
                    {
                        $contacts = json_decode($xmlresponse,true);
                 
                         $return = array();
                         if (!empty($contacts['feed']['entry'])) {
                             foreach($contacts['feed']['entry'] as $contact) {
                                //retrieve Name and email address 
                                 if(key_exists('gd$email',$contact))
                                 {
                                    $return[] = array (
                                     'name'=> $contact['title']['$t'],
                                     'email' => $contact['gd$email'][0]['address'],
                                     );   
                                 }
                                 
                             } 
                         }
                        $inviteUser = array();
                        $searchContacArray = array();
                        foreach($return as $googleuser)
                        {
                            $getuser = User::where('email',$googleuser['email'])->first();
                            if($getuser && $getuser->id != $user_id)
                            {
                                $user = UserDetails::where('user_id',$getuser->id)->first();
                                if($user)
                                {
                                    $dataArray['req_user_id'] = $user['user_id'];
                                    $dataArray['req_user_email'] = $googleuser['email'];
                                    $company_id = $user['company_id'];
                                    if($company_id != '')
                                    {
                                        $companyUser = Company::find($company_id);    
                                        $dataArray['req_user_company_name'] = $companyUser->name;
                                        $dataArray['req_user_city'] = $companyUser->city;
                                        $dataArray['req_user_country'] = $companyUser->country;
                                    }
                                    else
                                    {
                                        $dataArray['req_user_company_name'] = '';
                                        $dataArray['req_user_city'] = '';
                                        $dataArray['req_user_country'] = '';
                                    }
                                    $dataArray['req_user_name'] = $user['first_name'].' '.$user['last_name'];
                                    $dataArray['req_user_picture'] = $user['profile_picture'];
                                    $checkForcommonReq = ContactUsers::whereRaw('((sender_user_id = ? AND request_user_id = ?) OR (sender_user_id = ? AND request_user_id = ?)) AND status = ?',array($user['user_id'],$user_id,$user_id,$user['user_id'],0))->first();
                                    if($checkForcommonReq)
                                    {
                                        $dataArray['id'] = $checkForcommonReq->id;
                                        $dataArray['common_req'] = 1;
                                    }
                                    else
                                    {
                                        $dataArray['id'] = '';
                                        $dataArray['common_req'] = 0;
                                    }
                                    $searchContacArray[] = $dataArray;
                                }
                                
                            }
                            else
                            {
                                $userInvite = InviteUsersDetail::whereRaw('user_id = ? AND email = ?',array($user_id,$googleuser['email']))->first();
                                if(!$userInvite)
                                {
                                    $addInviteUser = new InviteUsersDetail;
                                    $addInviteUser->user_id = $user_id;
                                    $addInviteUser->name = $googleuser['name'];
                                    $addInviteUser->email = $googleuser['email'];
                                    $addInviteUser->invite_status = 1;
                                    $addInviteUser->invite_date = date('Y-m-d');
                                    $addInviteUser->save();
                                }
                                $inviteUser[] = $googleuser;
                            }
                        }
                        
                        return view('contactusers.invite')->with(['userData'=>$userData,'invites'=>$inviteUser,'contactusers'=>$searchContacArray,'type'=>'Google']);
                    }   
                }
                else{
                    return Redirect::to('user-dashboard')->with('message', 'There was a problem with the invite. Please retry.');   
                }
            }
            
        }
        return Redirect::to('user-dashboard')->with('message', 'There was a problem with the invite. Please retry.');
    }
    
    public function curl_file_get_contents($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    /**
     * MSN Contacts
     */
    public function viewMSNContact()
    {
        $searchContacArray = array();
        $user_id = Auth::user()->id;
        // logged in user detail 
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        
        if(Input::has('code'))
        {
            $initurl = 'https://account.live.com/consent/Manage?mkt=en-US';
            $initresponse =  $this->curl_file_get_contents($initurl);
            if($initresponse === false)
            {
                return Redirect::to('contactusers/create')->with('message', 'There was a problem with your MSN/Hotmail login. Please retry.');
            }
            else
            {
                $msn_client_id = env('MSN_CLIENT_ID', '');
                $msn_client_secret = env('MSN_CLIENT_SECRETE', '');
                $msn_redirect_uri = env('MSN_REDIRECT_URL', '');
                
                
                $auth_code = Input::get('code');
                
                $fields=array(
                    'code'=>  urlencode($auth_code),
                    'client_id'=>  urlencode($msn_client_id),
                    'client_secret'=>  urlencode($msn_client_secret),
                    'redirect_uri'=>  urlencode($msn_redirect_uri),
                    'grant_type'=>  urlencode('authorization_code')
                );
                $post = '';
                
                foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
                
                $post = rtrim($post,'&');
                $curl = curl_init();
                curl_setopt($curl,CURLOPT_URL,'https://login.live.com/oauth20_token.srf');
                curl_setopt($curl,CURLOPT_POST,5);
                curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
                $result = curl_exec($curl);
                curl_close($curl);
                if($result === false)
                {
                    return Redirect::to('contactusers/create')->with('message', 'There was a problem with your MSN/Hotmail login. Please retry.');
                }
                else
                {
                    $response =  json_decode($result);
                    if(isset($response->access_token))
                    {
                        $accesstoken = $response->access_token;
                        $url = 'https://apis.live.net/v5.0/me/contacts?access_token='.$accesstoken.'&limit=100';
                        $xmlresponse =  $this->curl_file_get_contents($url);
                        if($xmlresponse === false)
                        {
                            return Redirect::to('contactusers/create')->with('message', 'There was a problem with the invite. Please retry.');
                        }
                        else
                        {
                            $xml = json_decode($xmlresponse, true);
                            $msn_email = "";
                            $return = array();
                            if(!empty($xml['data'])){
                                foreach($xml['data'] as $emails)
                                {
                                // echo $emails['name'];
                                $email_ids = implode(",",array_unique($emails['emails'])); //will get more email primary,sec etc with comma separate
                                //$msn_email .= "<div><span>".$emails['name']."</span> &nbsp;&nbsp;&nbsp;<span>". rtrim($email_ids,",")."</span></div>";
                                    $return[] = array (
                                                 'name'=> $emails['name'],
                                                 'email' => rtrim($email_ids,","),
                                                 ); 
                                }
                                foreach($return as $googleuser)
                                {
                                    $getuser = User::where('email',$googleuser['email'])->first();
                                    if($getuser && $getuser->id != $user_id)
                                    {
                                        $user = UserDetails::where('user_id',$getuser->id)->first();
                                        if($user)
                                        {
                                            $dataArray['req_user_id'] = $user['user_id'];
                                            $company_id = $user['company_id'];
                                            if($company_id != '')
                                            {
                                                $companyUser = Company::find($company_id);    
                                                $dataArray['req_user_company_name'] = $companyUser->name;
                                                $dataArray['req_user_city'] = $companyUser->city;
                                                $dataArray['req_user_country'] = $companyUser->country;
                                            }
                                            else
                                            {
                                                $dataArray['req_user_company_name'] = '';
                                                $dataArray['req_user_city'] = '';
                                                $dataArray['req_user_country'] = '';
                                            }
                                            $dataArray['req_user_name'] = $user['first_name'].' '.$user['last_name'];
                                            
                                            $checkForcommonReq = ContactUsers::whereRaw('((sender_user_id = ? AND request_user_id = ?) OR (sender_user_id = ? AND request_user_id = ?)) AND status = ?',array($user['user_id'],$user_id,$user_id,$user['user_id'],0))->first();
                                            if($checkForcommonReq)
                                            {
                                                $dataArray['id'] = $checkForcommonReq->id;
                                                $dataArray['common_req'] = 1;
                                            }
                                            else
                                            {
                                                $dataArray['id'] = '';
                                                $dataArray['common_req'] = 0;
                                            }
                                            $searchContacArray[] = $dataArray;
                                        }
                                    }
                                }
                            }
                            return view('contactusers.social')->with(['userData'=>$userData,'searchContac'=>$searchContacArray,'type'=>'MSN']);
                        }
                    }
                    else{
                        return Redirect::to('contactusers/create')->with('message', 'There was a problem with the invite. Please retry.');
                    }
                }
                
            }
        }
        return Redirect::to('contactusers/create')->with('message', 'There was a problem with the invite. Please retry.');
    }
    
    /**
     * Invite MSN Contact
     */
    public function viewInviteMSNContact()
    {
        $user_id = Auth::user()->id;
        // logged in user detail 
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        
        if(Input::has('code'))
        {
            
            $msn_client_id = env('MSN_CLIENT_ID', '');
            $msn_client_secret = env('MSN_CLIENT_SECRETE', '');
            $msn_redirect_uri = env('MSN_INVITE_REDIRECT_URL', '');
            
            
            $auth_code = Input::get('code');
            
            $fields=array(
                'code'=>  urlencode($auth_code),
                'client_id'=>  urlencode($msn_client_id),
                'client_secret'=>  urlencode($msn_client_secret),
                'redirect_uri'=>  urlencode($msn_redirect_uri),
                'grant_type'=>  urlencode('authorization_code')
            );
            $post = '';
            
            foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
            
            $post = rtrim($post,'&');
            $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL,'https://login.live.com/oauth20_token.srf');
            curl_setopt($curl,CURLOPT_POST,5);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
            $result = curl_exec($curl);
            curl_close($curl);
            if($result === false)
            {
                return Redirect::to('user-dashboard')->with('message', 'There was a problem with the invite. Please retry.');
            }
            else
            {
                $response =  json_decode($result);
                if(isset($response->access_token))
                {
                    $accesstoken = $response->access_token;
                    $url = 'https://apis.live.net/v5.0/me/contacts?access_token='.$accesstoken.'&limit=100';
                    $xmlresponse =  $this->curl_file_get_contents($url);
                    if($xmlresponse === false)
                    {
                        return Redirect::to('user-dashboard')->with('message', 'There was a problem with the invite. Please retry.');
                    }
                    else
                    {
                        $xml = json_decode($xmlresponse, true);
                        $msn_email = "";
                        $return = array();
                        if(!empty($xml['data'])){
                            foreach($xml['data'] as $emails)
                            {
                            // echo $emails['name'];
                            $email_ids = implode(",",array_unique($emails['emails'])); //will get more email primary,sec etc with comma separate
                            //$msn_email .= "<div><span>".$emails['name']."</span> &nbsp;&nbsp;&nbsp;<span>". rtrim($email_ids,",")."</span></div>";
                                $return[] = array (
                                             'name'=> $emails['name'],
                                             'email' => rtrim($email_ids,","),
                                             ); 
                            }
                            
                        }
                        $inviteUser = array();
                        $searchContacArray = array();
                        foreach($return as $msnuser)
                        {
                            $getuser = User::where('email',$msnuser['email'])->first();
                            if($getuser && $getuser->id != $user_id)
                            {
                                $user = UserDetails::where('user_id',$getuser->id)->first();
                                
                                $dataArray['req_user_id'] = $user['user_id'];
                                $dataArray['req_user_email'] = $msnuser['email'];
                                $company_id = $user['company_id'];
                                if($company_id != '')
                                {
                                    $companyUser = Company::find($company_id);    
                                    $dataArray['req_user_company_name'] = $companyUser->name;
                                    $dataArray['req_user_city'] = $companyUser->city;
                                    $dataArray['req_user_country'] = $companyUser->country;
                                }
                                else
                                {
                                    $dataArray['req_user_company_name'] = '';
                                    $dataArray['req_user_city'] = '';
                                    $dataArray['req_user_country'] = '';
                                }
                                $dataArray['req_user_name'] = $user['first_name'].' '.$user['last_name'];
                                $dataArray['req_user_picture'] = $user['profile_picture'];
                                $checkForcommonReq = ContactUsers::whereRaw('((sender_user_id = ? AND request_user_id = ?) OR (sender_user_id = ? AND request_user_id = ?)) AND status = ?',array($user['user_id'],$user_id,$user_id,$user['user_id'],0))->first();
                                if($checkForcommonReq)
                                {
                                    $dataArray['id'] = $checkForcommonReq->id;
                                    $dataArray['common_req'] = 1;
                                }
                                else
                                {
                                    $dataArray['id'] = '';
                                    $dataArray['common_req'] = 0;
                                }
                                $searchContacArray[] = $dataArray;
                            }
                            else
                            {
                                $userInvite = InviteUsersDetail::whereRaw('user_id = ? AND email = ?',array($user_id,$msnuser['email']))->first();
                                if(!$userInvite)
                                {
                                    $addInviteUser = new InviteUsersDetail;
                                    $addInviteUser->user_id = $user_id;
                                    $addInviteUser->name = $msnuser['name'];
                                    $addInviteUser->email = $msnuser['email'];
                                    $addInviteUser->invite_status = 1;
                                    $addInviteUser->invite_date = date('Y-m-d');
                                    $addInviteUser->save();
                                }
                                $inviteUser[] = $msnuser;
                            }
                        }
                        return view('contactusers.invite')->with(['userData'=>$userData,'invites'=>$inviteUser,'contactusers'=>$searchContacArray,'type'=>'MSN']);
                    }
                }
                else
                {
                    return Redirect::to('user-dashboard')->with('message', 'There was a problem with the invite. Please retry.');
                }
            }
            
        }
        return Redirect::to('user-dashboard')->with('message', 'There was a problem with the invite. Please retry.');
    }
    
    /**
     * Yahoo Contacts
     */
    public function viewYahooContact()
    {
        $searchContacArray = array();
        $user_id = Auth::user()->id;
        // logged in user detail 
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        
        $filePath = base_path();
        include( $filePath.'/yahoo_api/globals.php');
        include( $filePath.'/yahoo_api/oauth_helper.php');
        
        $yahoo_redirect_uri = env('YAHOO_REDIRECT_URL', '');
        $yahoo_client_id = env('YAHOO_CLIENT_ID', '');
        $yahoo_client_secret = env('YAHOO_CLIENT_SECRETE', '');
        
        $callback = $yahoo_redirect_uri; 
        
        // Fill in the next 3 variables. 
        $request_token           =   Session::get('contact_yahoo_request_token');
        $request_token_secret   =   Session::get('contact_yahoo_request_token_secret');
        
        Session::forget('contact_yahoo_request_token');
        Session::forget('contact_yahoo_request_token_secret');
        
        $oauth_verifier        =   $_GET['oauth_verifier']; 
        // Get the access token using HTTP GET and HMAC-SHA1 signature 
        $retarr = get_access_token_yahoo($yahoo_client_id, $yahoo_client_secret, $request_token, $request_token_secret, $oauth_verifier, false, true, true); 
        //echo '<pre>';print_r($retarr);
        if (! empty($retarr)) 
        { 
            list($info, $headers, $body, $body_parsed) = $retarr;
            if ($info['http_code'] == 200 && !empty($body)) 
            { 
                // Fill in the next 3 variables. 
                $guid    =  $body_parsed['xoauth_yahoo_guid'];
                $access_token  = rfc3986_decode($body_parsed['oauth_token']) ;
                $access_token_secret  = $body_parsed['oauth_token_secret']; 
                // Call Contact API 
                $retarrs = callcontact_yahoo($yahoo_client_id, $yahoo_client_secret, $guid, $access_token, $access_token_secret, false, true);
                //print_r($retarrs);
                $return = array();
                if(!empty($retarrs))
                {
                    foreach($retarrs as $key=>$values)
                    {
                    	 foreach($values->contact as $values_sub)
                         {
                    		 foreach($values_sub->fields as $key=>$val)
                             {
                                if($val->type == 'name')
                                {
                                    $name = '';
                                    $name = $val->value->givenName.' '.$val->value->familyName;
                                }
                                if($val->type == 'email')
                                {
                                    $email = '';
                                    $email = $val->value;
                                    if($email != '')
                                    {
                                        $return[] = array (
                                                 'name'=> $name,
                                                 'email' => $email,
                                                 ); 
                                    }
                                }
                             }
                    		 
                    	 }
                     }
                    foreach($return as $googleuser)
                    {
                        $getuser = User::where('email',$googleuser['email'])->first();
                        if($getuser && $getuser->id != $user_id)
                        {
                            $user = UserDetails::where('user_id',$getuser->id)->first();
                            if($user)
                            {
                                $dataArray['req_user_id'] = $user['user_id'];
                                $company_id = $user['company_id'];
                                if($company_id != '')
                                {
                                    $companyUser = Company::find($company_id);    
                                    $dataArray['req_user_company_name'] = $companyUser->name;
                                    $dataArray['req_user_city'] = $companyUser->city;
                                    $dataArray['req_user_country'] = $companyUser->country;
                                }
                                else
                                {
                                    $dataArray['req_user_company_name'] = '';
                                    $dataArray['req_user_city'] = '';
                                    $dataArray['req_user_country'] = '';
                                }
                                $dataArray['req_user_name'] = $user['first_name'].' '.$user['last_name'];
                                
                                $checkForcommonReq = ContactUsers::whereRaw('((sender_user_id = ? AND request_user_id = ?) OR (sender_user_id = ? AND request_user_id = ?)) AND status = ?',array($user['user_id'],$user_id,$user_id,$user['user_id'],0))->first();
                                if($checkForcommonReq)
                                {
                                    $dataArray['id'] = $checkForcommonReq->id;
                                    $dataArray['common_req'] = 1;
                                }
                                else
                                {
                                    $dataArray['id'] = '';
                                    $dataArray['common_req'] = 0;
                                }
                                $searchContacArray[] = $dataArray;
                            }
                        }
                    }
                    return view('contactusers.social')->with(['userData'=>$userData,'searchContac'=>$searchContacArray,'type'=>'Yahoo']);
                }
            }
        }
        return Redirect::to('contactusers/create')->with('message', 'There was a problem with the invite. Please retry.');
    }
    
    /**
     * get Yahoo access url
     */
    public function getYahooUrl()
    {
        $filePath = base_path();
        
        /// Yahoo invite
        include( $filePath.'/yahoo_api/globals.php');
        include( $filePath.'/yahoo_api/oauth_helper.php');
        
        $yahoo_redirect_uri = env('YAHOO_INVITE_REDIRECT_URL', '');
        $yahoo_client_id = env('YAHOO_CLIENT_ID', '');
        $yahoo_client_secret = env('YAHOO_CLIENT_SECRETE', '');
        
        $callback = $yahoo_redirect_uri; 
        // Get the request token using HTTP GET and HMAC-SHA1 signature 
        $retarr = get_request_token($yahoo_client_id, $yahoo_client_secret, $callback, false, true, true);
        
        if (! empty($retarr)){ 
            list($info, $headers, $body, $body_parsed) = $retarr; 
            if ($info['http_code'] == 200 && !empty($body)) { 
                // print "Have the user go to xoauth_request_auth_url to authorize your app\n" . 
                //  rfc3986_decode($body_parsed['xoauth_request_auth_url']) . "\n"; 
                //echo "<pre/>"; 
                //print_r($retarr); 
                Session::forget('invite_yahoo_request_token');
                Session::forget('invite_yahoo_request_token_secret');
                
                Session::put('invite_yahoo_request_token',$body_parsed['oauth_token']);
                Session::put('invite_yahoo_request_token_secret',$body_parsed['oauth_token_secret']); 
                $yahooImportUrl = urldecode($body_parsed['xoauth_request_auth_url']);
             } 
        }
        //header("Location:".$yahooImportUrl);
        //die();
        $ajaxArray = array();
        $ajaxArray['url'] = $yahooImportUrl;
        return Response::json($ajaxArray);
    }
    
    /**
     * Invite Yahoo Contact
     */
    public function viewInviteYahooContact()
    {
        $user_id = Auth::user()->id;
        // logged in user detail 
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        
        $filePath = base_path();
        include( $filePath.'/yahoo_api/globals.php');
        include( $filePath.'/yahoo_api/oauth_helper.php');
        
        $yahoo_client_id = env('YAHOO_CLIENT_ID', '');
        $yahoo_client_secret = env('YAHOO_CLIENT_SECRETE', '');
        
        // Fill in the next 3 variables. 
        $request_token           =   Session::get('invite_yahoo_request_token');
        $request_token_secret   =   Session::get('invite_yahoo_request_token_secret');
        
        Session::forget('invite_yahoo_request_token');
        Session::forget('invite_yahoo_request_token_secret');
        
        $oauth_verifier        =   $_GET['oauth_verifier']; 
        // Get the access token using HTTP GET and HMAC-SHA1 signature 
        $retarr = get_access_token_yahoo($yahoo_client_id, $yahoo_client_secret, $request_token, $request_token_secret, $oauth_verifier, false, true, true); 
        if(!empty($retarr)) 
        { 
            list($info, $headers, $body, $body_parsed) = $retarr;
            if ($info['http_code'] == 200 && !empty($body)) 
            { 
                // Fill in the next 3 variables. 
                $guid    =  $body_parsed['xoauth_yahoo_guid'];
                $access_token  = rfc3986_decode($body_parsed['oauth_token']) ;
                $access_token_secret  = $body_parsed['oauth_token_secret']; 
                // Call Contact API 
                $retarrs = callcontact_yahoo($yahoo_client_id, $yahoo_client_secret, $guid, $access_token, $access_token_secret, false, true);
                $return = array();
                $inviteUser = array();
                $searchContacArray = array();
                if(!empty($retarrs))
                {
                    foreach($retarrs as $key=>$values)
                    {
                    	 foreach($values->contact as $values_sub)
                         {
                    		 foreach($values_sub->fields as $key=>$val)
                             {
                                if($val->type == 'name')
                                {
                                    $name = '';
                                    $name = $val->value->givenName.' '.$val->value->familyName;
                                }
                                if($val->type == 'email')
                                {
                                    $email = '';
                                    $email = $val->value;
                                    if($email != '')
                                    {
                                        $return[] = array (
                                                 'name'=> $name,
                                                 'email' => $email,
                                                 ); 
                                    }
                                }
                             }
                    		 
                    	 }
                     }
                    
                    foreach($return as $yahoouser)
                    {
                        $getuser = User::where('email',$yahoouser['email'])->first();
                        if($getuser && $getuser->id != $user_id)
                        {
                            $user = UserDetails::where('user_id',$getuser->id)->first();
                            if($user)
                            {
                                $dataArray['req_user_id'] = $user['user_id'];
                                $dataArray['req_user_email'] = $yahoouser['email'];
                                $company_id = $user['company_id'];
                                if($company_id != '')
                                {
                                    $companyUser = Company::find($company_id);    
                                    $dataArray['req_user_company_name'] = $companyUser->name;
                                    $dataArray['req_user_city'] = $companyUser->city;
                                    $dataArray['req_user_country'] = $companyUser->country;
                                }
                                else
                                {
                                    $dataArray['req_user_company_name'] = '';
                                    $dataArray['req_user_city'] = '';
                                    $dataArray['req_user_country'] = '';
                                }
                                $dataArray['req_user_name'] = $user['first_name'].' '.$user['last_name'];
                                $dataArray['req_user_picture'] = $user['profile_picture'];
                                $checkForcommonReq = ContactUsers::whereRaw('((sender_user_id = ? AND request_user_id = ?) OR (sender_user_id = ? AND request_user_id = ?)) AND status = ?',array($user['user_id'],$user_id,$user_id,$user['user_id'],0))->first();
                                if($checkForcommonReq)
                                {
                                    $dataArray['id'] = $checkForcommonReq->id;
                                    $dataArray['common_req'] = 1;
                                }
                                else
                                {
                                    $dataArray['id'] = '';
                                    $dataArray['common_req'] = 0;
                                }
                                $searchContacArray[] = $dataArray;
                            }
                        }
                        else
                        {
                            $userInvite = InviteUsersDetail::whereRaw('user_id = ? AND email = ?',array($user_id,$yahoouser['email']))->first();
                            if(!$userInvite)
                            {
                                $addInviteUser = new InviteUsersDetail;
                                $addInviteUser->user_id = $user_id;
                                $addInviteUser->name = $yahoouser['name'];
                                $addInviteUser->email = $yahoouser['email'];
                                $addInviteUser->invite_status = 1;
                                $addInviteUser->invite_date = date('Y-m-d');
                                $addInviteUser->save();
                            }
                            $inviteUser[] = $yahoouser;
                        }
                    }
                    
                    return view('contactusers.invite')->with(['userData'=>$userData,'invites'=>$inviteUser,'contactusers'=>$searchContacArray,'type'=>'Yahoo']);
                }
                return view('contactusers.invite')->with(['userData'=>$userData,'invites'=>$inviteUser,'contactusers'=>$searchContacArray,'type'=>'Yahoo']);
            }
        }
        return Redirect::to('user-dashboard')->with('message', 'There was a problem with the invite. Please retry.');
    }
    
    /**
     * Send Invitation mail
     */
    public function sendInvitation()
    {
        $user_id = Auth::user()->id;
        $input = Input::all();
        if(Input::has('contact'))
        {
            $sender_id = $user_id;
            foreach(Input::get('contact') as $request_id)
            {
                $ContactUsersObj = ContactUsers::whereRaw('sender_user_id = ? AND request_user_id = ?',array($sender_id,$request_id))->first();
                if(!$ContactUsersObj)
                {
                    $senderObj = UserDetails::where('user_id',$sender_id)->first();
                    $sendeCompanyId = $senderObj->company_id;
                    if($sendeCompanyId == '')
                    {
                        $sendeCompanyId = NULL;
                    }
                    $requestObj = UserDetails::where('user_id',$request_id)->first();
                    $requestCompanyId = $requestObj->company_id;
                    if($requestCompanyId == '')
                    {
                        $requestCompanyId = NULL;
                    }
                    
                    $ContactUsersNewObj = new ContactUsers();
                    $ContactUsersNewObj->sender_user_id = $sender_id;
                    $ContactUsersNewObj->sender_user_company_id = $sendeCompanyId;
                    $ContactUsersNewObj->request_user_id = $request_id;
                    $ContactUsersNewObj->request_user_company_id = $requestCompanyId;
                    $ContactUsersNewObj->status = 0;
                    $ContactUsersNewObj->save();
                }
            }
            
        }
        if(Input::has('invite'))
        {
            $url = '';
            $referralCode = '';
            $referralLink = ReferralsLinks::where('user_id',$user_id)->first();
            if($referralLink)
            {
                $url = url('').'?referral='.$referralLink->referral_code;
                $referralCode = $referralLink->referral_code;
            }
            else
            {
                $url = url('');
            }
            $sendername = '';
            $userPic = '';
            $userData = UserDetails::where('user_id',$user_id)->first();

            if($userData)
            {
                $sendername = $userData->first_name.' '.$userData->last_name;
                $userPic = url('')."/".$userData->profile_picture;
            }
            else
            {
                $user = User::find($user_id);
                $sendername = $user->name;
            }
            $inviteUsers = Input::get('invitename');
            $already_invite_other = '';
            $already_invite = '';
            foreach(Input::get('invite') as $index => $invite)
            {
                $invitename = $inviteUsers[$index];
                $userInvite = InviteUsersDetail::whereRaw('user_id = ? AND email = ? ',array($user_id,$invite))->first();
                if($userInvite)
                {
                    if($userInvite->invite_status == 1)
                    {
                        $userInviteEmails = InviteUsersDetail::where('email',$invite)->get();
                        $today = date('Y-m-d');
                        $int_flg = 0;
                        foreach($userInviteEmails as $userInviteEmail)
                        {
                            if($userInviteEmail->invite_status == 2)
                            {
                                $invite_date = $userInviteEmail->invite_date;
                                $days_after = date('Y-m-d', strtotime('+14 days', strtotime($invite_date)));
                                if(strtotime($today) < strtotime($days_after))
                                {
                                    $int_flg = 1;
                                }
                            }
                        }
                        if($int_flg == 0)
                        {
                            $userInvite->invite_status = 2;
                            $userInvite->invite_date = date('Y-m-d');
                            $userInvite->save();
                            
                            Input::replace(array('email' => $invite,'name'=>$invitename));
                            //Input::replace(array('email' => 'chauhan.gordhan@gmail.com','name'=>$invitename));
                            $data = array('name'=>Input::get('name'),'sender_name'=>$sendername,'url'=>$url,'referralCode'=>$referralCode,'userPic'=>$userPic);
                            Mail::send('admin.Emailtemplates.newReferrelInvite', $data, function($message){
                                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                                $message->to(Input::get('email'), Input::get('name'))->subject('Invitation for IndyJohn.com, a Social Industrial Marketplace.');
                            });
                        }
                        else
                        {
                            if($already_invite_other == '')
                            {
                                $already_invite_other = $invite;
                            }
                            else
                            {
                                $already_invite_other = ','.$invite;
                            }
                        }
                    }
                    else
                    {
                        if($userInvite->invite_status == 2)
                        {
                            $int_flg = 0;
                            $userInviteEmails = InviteUsersDetail::where('email',$invite)->get();
                            $today = date('Y-m-d');
                            foreach($userInviteEmails as $userInviteEmail)
                            {
                                if($userInviteEmail->invite_status == 2)
                                {
                                    $invite_date = $userInviteEmail->invite_date;
                                    $days_after = date('Y-m-d', strtotime('+14 days', strtotime($invite_date)));
                                    if(strtotime($today) < strtotime($days_after))
                                    {
                                        $int_flg = 1;
                                    }
                                }
                            }
                            if($int_flg == 0)
                            {
                                $userInvite->invite_status = 2;
                                $userInvite->invite_date = date('Y-m-d');
                                $userInvite->save();
                                
                                Input::replace(array('email' => $invite,'name'=>$invitename));
                                //Input::replace(array('email' => 'chauhan.gordhan@gmail.com','name'=>$invitename));
                                $data = array('name'=>Input::get('name'),'sender_name'=>$sendername,'url'=>$url,'referralCode'=>$referralCode,'userPic'=>$userPic);
                                Mail::send('admin.Emailtemplates.newReferrelInvite', $data, function($message){
                                    $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                                    $message->to(Input::get('email'), Input::get('name'))->subject('Invitation for IndyJohn.com, a Social Industrial Marketplace.');
                                });
                            }
                            else
                            {
                                if($already_invite == '')
                                {
                                    $already_invite = $invite;
                                }
                                else
                                {
                                    $already_invite = ','.$invite;
                                }
                            }
                        }
                    }
                }
                
            }
            
        }
        $message_send = 'Your Invites are scheduled to be sent.';
        if($already_invite != '')
        {
            $message_send .= '<br/>'.$already_invite.' already sent by you recently.'; 
        }
        if($already_invite_other != '')
        {
            $message_send .= '<br/>'.$already_invite_other.' already sent by another user recently.';
        }
        return Redirect::to('user-dashboard')->with('message', $message_send);
    }
    
    /**
     * Send Invitation
     */
    public function conactInviteSend($id)
    {
        $user_id = Auth::user()->id;
        $url = '';
        $referralCode = '';
        $referralLink = ReferralsLinks::where('user_id',$user_id)->first();
        if($referralLink)
        {
            $url = url('').'?referral='.$referralLink->referral_code;
            $referralCode = $referralLink->referral_code;
        }
        else
        {
            $url = url('');
        }
        $sendername = '';
        $userPic = '';
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData)
        {
            $sendername = $userData->first_name.' '.$userData->last_name;
            $userPic = url('')."/".$userData->profile_picture;
        }
        else
        {
            $user = User::find($user_id);
            $sendername = $user->name;
        }
        $userInvite = InviteUsersDetail::find($id);
        
        if($userInvite->invite_status == 1)
        {
            $userInviteEmails = InviteUsersDetail::where('email',$userInvite->email)->get();
            $today = date('Y-m-d');
            $int_flg = 0;
            foreach($userInviteEmails as $userInviteEmail)
            {
                if($userInviteEmail->invite_status == 2)
                {
                    $invite_date = $userInviteEmail->invite_date;
                    $days_after = date('Y-m-d', strtotime('+14 days', strtotime($invite_date)));
                    if(strtotime($today) < strtotime($days_after))
                    {
                        $int_flg = 1;
                    }
                }
            }
            if($int_flg == 0)
            {
                $userInvite->invite_status = 2;
                $userInvite->invite_date = date('Y-m-d');
                $userInvite->save();
                
                Input::replace(array('email' => $userInvite->email,'name'=>$userInvite->name));
                $data = array('name'=>Input::get('name'),'sender_name'=>$sendername,'url'=>$url,'referralCode'=>$referralCode,'userPic'=>$userPic);
                Mail::send('admin.Emailtemplates.newReferrelInvite', $data, function($message){
                    $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                    $message->to(Input::get('email'), Input::get('name'))->subject('Invitation for IndyJohn.com, a Social Industrial Marketplace.');
                });
            }
            else
            {
                if(isset($_REQUEST['pedingInvite']))
                {
                    if($_REQUEST['pedingInvite'] == 1)
                    {
                        return Redirect::to('contact/pending/invite')->with('message', 'This person has been recently invited by another user.');    
                    }
                    else
                    {
                        return Redirect::to('contact/invite/join')->with('message', 'This person has been recently invited by another user.');
                    }
                }
                else
                {
                    return Redirect::to('contactusers')->with('message', 'This person has been recently invited by another user.');
                }
            }
        }
        else
        {
            if($userInvite->invite_status == 2)
            {
                $int_flg = 0;
                $userInviteEmails = InviteUsersDetail::where('email',$userInvite->email)->get();
                $today = date('Y-m-d');
                foreach($userInviteEmails as $userInviteEmail)
                {
                    if($userInviteEmail->invite_status == 2)
                    {
                        $invite_date = $userInviteEmail->invite_date;
                        $days_after = date('Y-m-d', strtotime('+14 days', strtotime($invite_date)));
                        if(strtotime($today) < strtotime($days_after))
                        {
                            $int_flg = 1;
                        }
                    }
                }
                if($int_flg == 0)
                {
                    $userInvite->invite_status = 2;
                    $userInvite->invite_date = date('Y-m-d');
                    $userInvite->save();
                    
                    Input::replace(array('email' => $userInvite->email,'name'=>$userInvite->name));
                    $data = array('name'=>Input::get('name'),'sender_name'=>$sendername,'url'=>$url,'referralCode'=>$referralCode,'userPic'=>$userPic);
                    Mail::send('admin.Emailtemplates.newReferrelInvite', $data, function($message){
                        $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                        $message->to(Input::get('email'), Input::get('name'))->subject('Invitation for IndyJohn.com, a Social Industrial Marketplace.');
                    });
                }
                else
                {
                    if(isset($_REQUEST['pedingInvite']))
                    {
                        if($_REQUEST['pedingInvite'] == 1)
                        {
                            return Redirect::to('contact/pending/invite')->with('message', 'You have already invited this contact recently. ');    
                        }
                        else
                        {
                            return Redirect::to('contact/invite/join')->with('message', 'You have already invited this contact recently.');
                        }
                    }
                    else
                    {
                        return Redirect::to('contactusers')->with('message', 'You have already invited this contact recently.');
                    }
                }
            }
        }
        if(isset($_REQUEST['pedingInvite']))
        {
            if($_REQUEST['pedingInvite'] == 1)
            {
                return Redirect::to('contact/pending/invite')->with('message', 'Your Invites are scheduled to be sent.');    
            }
            else
            {
                return Redirect::to('contact/invite/join')->with('message', 'Your Invites are scheduled to be sent.');
            }
        }
        else
        {
            return Redirect::to('contactusers')->with('message', 'Your Invites are scheduled to be sent.');
        }
    }
    
    /**
     * remove user from invite
     */
    public function conactInviteRemove($id)
    {
        $userInvite = InviteUsersDetail::find($id);
        $userInvite->delete();
        if(isset($_REQUEST['pedingInvite']))
        {
            if($_REQUEST['pedingInvite'] == 1)
            {
                return Redirect::to('contact/pending/invite')->with('message', 'Selected connection request has been deleted.');    
            }
            else
            {
                return Redirect::to('contact/invite/join')->with('message', 'Selected connection request has been deleted.');
            }
        }
        else
        {
            return Redirect::to('contactusers')->with('message', 'Selected connection request has been deleted.');
        }
    }
    
    /**
     * Add new contact menually
     */
    public function viewAddContact()
    {
        $user_id = Auth::user()->id;
        $userData = UserDetails::where('user_id',$user_id)->first();
        return view('contactusers.add-contact')->with(['userData'=>$userData]);
    }
    
    /**
     * save new contact invite
     */
    public function saveAddContact(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::user()->id;
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);
        $userInvite = InviteUsersDetail::whereRaw('user_id = ? AND email = ?',array($user_id,$input['email']))->first();
        if(!$userInvite)
        {
            $url = '';
            $referralCode = '';
            $referralLink = ReferralsLinks::where('user_id',$user_id)->first();
            if($referralLink)
            {
                $url = url('').'?referral='.$referralLink->referral_code;
                $referralCode = $referralLink->referral_code;
            }
            else
            {
                $url = url('');
            }
            $sendername = '';
            $userPic = '';
            $userData = UserDetails::where('user_id',$user_id)->first();
            if($userData)
            {
                $sendername = $userData->first_name.' '.$userData->last_name;
                $userPic = url('')."/".$userData->profile_picture;
            }
            else
            {
                $user = User::find($user_id);
                $sendername = $user->name;
            }
            $addInviteUser = new InviteUsersDetail;
            $addInviteUser->user_id = $user_id;
            $addInviteUser->name = $input['name'];
            $addInviteUser->email = $input['email'];
            $addInviteUser->phone = $input['phone'];
            $addInviteUser->company = $input['company'];
            $addInviteUser->invite_status = 1;
            $addInviteUser->invite_date = date('Y-m-d');
            $addInviteUser->save();
            
            Input::replace(array('email' => $input['email'],'name'=>$input['name']));
            $data = array('name'=>Input::get('name'),'sender_name'=>$sendername,'url'=>$url,'referralCode'=>$referralCode,'userPic'=>$userPic);
            Mail::send('admin.Emailtemplates.newReferrelInvite', $data, function($message){
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), Input::get('name'))->subject('Invitation for IndyJohn.com, a Social Industrial Marketplace.');
            });
            
            return Redirect::to('contactusers/create')->with('message', 'Your Invites are scheduled to be sent.');
        }
        else
        {
            return Redirect::to('contactusers/create')->with('message', 'You have already invited this user.');
        }
    }
    
    /**
     * Pandding Invite Contact view
     */
    public function viewContactPendingInvite()
    {
        $user_id = Auth::user()->id;
        /// Invited Contacts
        $invitedContacts = InviteUsersDetail::whereRaw('user_id = ? AND invite_status = ?',array($user_id,2))->orderBy('id','desc')->paginate(15);
        
        $previousPageUrl = $invitedContacts->previousPageUrl();//previous page url
        $nextPageUrl = $invitedContacts->nextPageUrl();//next page url
        $lastPage = $invitedContacts->lastPage(); //Gives last page number
        $total = $invitedContacts->total();
        return view('contactusers.pending-invite')->with([
                                                        'invitedContacts'=>$invitedContacts,
                                                        'previousPageUrl'=>$previousPageUrl,
                                                        'nextPageUrl'=>$nextPageUrl,
                                                        'lastPage'=>$lastPage,
                                                        "total"=>$total,
                                                        ]);
    }
    
    /**
     * Invite Join Contact view
     */
    public function viewContactInviteJoin()
    {
        $user_id = Auth::user()->id;
        /// Invited Contacts
        $savedContacts = InviteUsersDetail::whereRaw('user_id = ? AND invite_status = ?',array($user_id,1))->orderBy('id','desc')->paginate(15);
        
        $previousPageUrl = $savedContacts->previousPageUrl();//previous page url
        $nextPageUrl = $savedContacts->nextPageUrl();//next page url
        $lastPage = $savedContacts->lastPage(); //Gives last page number
        $total = $savedContacts->total();
        return view('contactusers.invite-join')->with([
                                                        'savedContacts'=>$savedContacts,
                                                        'previousPageUrl'=>$previousPageUrl,
                                                        'nextPageUrl'=>$nextPageUrl,
                                                        'lastPage'=>$lastPage,
                                                        "total"=>$total,
                                                        ]);
    }
    
    /**
     * send invite message
     */
    public function sendInviteMessage()
    {
        $input = Input::all();
        
        $user_id = Auth::user()->id;
        $url = '';
        $referralCode = '';
        $referralLink = ReferralsLinks::where('user_id',$user_id)->first();
        if($referralLink)
        {
            $url = url('').'?referral='.$referralLink->referral_code;
            $referralCode = $referralLink->referral_code;
        }
        else
        {
            $url = url('');
        }
        $sendername = '';
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData)
        {
            $sendername = $userData->first_name.' '.$userData->last_name;
        }
        else
        {
            $user = User::find($user_id);
            $sendername = $user->name;
        }
        $userInvite = InviteUsersDetail::find($input['invite_id']);
        
        $userInviteEmails = InviteUsersDetail::where('email',$userInvite->email)->get();
        $today = date('Y-m-d');
        $int_flg = 0;
        foreach($userInviteEmails as $userInviteEmail)
        {
            if($userInviteEmail->invite_status == 2)
            {
                $invite_date = $userInviteEmail->invite_date;
                $days_after = date('Y-m-d', strtotime('+14 days', strtotime($invite_date)));
                if(strtotime($today) < strtotime($days_after))
                {
                    $int_flg = 1;
                }
            }
        }
        if($int_flg == 0)
        {
            $userInvite->invite_status = 2;
            $userInvite->invite_date = date('Y-m-d');
            $userInvite->save();
            
            Input::replace(array('email' => $userInvite->email,'name'=>$userInvite->name));
            //Input::replace(array('email' => 'chauhan.gordhan@gmail.com','name'=>'Gz'));
            $data = array('name'=>Input::get('name'),'sender_name'=>$sendername,'url'=>$url,'custome_message'=>$input['message'],'referralCode'=>$referralCode);
            Mail::send('admin.Emailtemplates.newReferrelInviteMessage', $data, function($message){
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), Input::get('name'))->subject('Invitation for IndyJohn.com, a Social Industrial Marketplace.');
            });
        }
        else
        {
            return Redirect::to('contact/invite/join')->with('message', 'This person has been recently invited by another user. ');
        }
        
        return Redirect::to('contact/invite/join')->with('message', 'Your Invites are scheduled to be sent.');
    }
    
    /**
     * Feedback Message
     */
    public function sendFeedbackMessage()
    {
        $user_id = Auth::user()->id;
        $input = Input::all();
        $sendername = '';
        $user = User::find($user_id);
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData)
        {
            $sendername = $userData->first_name.' '.$userData->last_name;
        }
        else
        {
            $sendername = $user->name;
        }
        
        $feedback_to_email = env('FEEDBACK_TO_EMAIL', '');
        $feedback_to_name = env('FEEDBACK_TO_NAME', '');
        
        Input::replace(array('email' => $feedback_to_email,'name'=>$feedback_to_name,'from'=>$user->email,'user_name'=>$sendername));
        
        $data = array('name'=>Input::get('name'),'sender_name'=>$sendername,'custome_message'=>$input['message'],'subject'=>$input['subject']);
        Mail::send('admin.Emailtemplates.feedBackMessage', $data, function($message){
            $message->from(Input::get('from'), Input::get('user_name'));
            $message->to(Input::get('email'), Input::get('name'))->subject('Indy John web app feedback');
        });
        
        return Redirect::to('user-dashboard')->with('message', 'Your feedback has been sent to Indy John team.');
    }
    
    /**
     * Send Share Link
     */
    public function sendShareLink()
    {
        $input = Input::all();
        $user = User::where('email',$input['user_email'])->first();
        Input::replace(array('email' => $input['recipient_email'],'name'=>'User','from'=>$user->email,'user_name'=>$user->name));
        
        $data = array('share_link'=>$input['share_link'],'custom_message'=>$input['message'],'SenderFirstName'=>$user->userdetail->first_name,'$SenderFirstName'=>$user->userdetail->last_name);
        
        Mail::send('admin.Emailtemplates.shareLink', $data, function($message){
            $message->from(Input::get('from'), Input::get('user_name'));
            $message->to(Input::get('email'), Input::get('name'))->subject('Invitation for IndyJohn.com, a Social Industrial Marketplace.');
        });
        return Redirect::back()->with('message', 'Thank you for sharing. Your share has been sent.');
    }
}
