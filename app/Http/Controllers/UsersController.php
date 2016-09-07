<?php

namespace App\Http\Controllers;



use App\User;

use App\UserDetails;

use App\UserUnique;

use App\UserAccountSettings;

use App\AppsCountries;

use App\UserWizardTrack;

use App\UsersActivity;

use App\ContactUsers;

use App\Company;

use App\CompanyUsers;

use App\CompanyAccount;

use App\CompanySave;

use App\AppsLanguages;

use App\AccessLevels;

use App\MarketplaceProducts;

use App\MarketplaceProductGallery;

use App\Industry;

use App\Category;

use App\TechService;

use App\UserTechServices;

use App\UserAdditionalIndustries;

use App\UserAwards;

use App\UserCategories;

use App\UserCertifications;

use App\UserEducationDetails;

use App\UserJobs;

use App\UserMemberOrganizations;

use App\Referrals;

use App\ReferralPayment;

use App\SubscriptionPlans;

use App\Subscriptions;

use App\PaymentDetails;

use App\Jobs;

use App\SkillsExpertise;

use App\ContactSave;

use Illuminate\Http\Request;



use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Route;

use Input;

use Auth;

use Response;

use Session;

use Mail;

use File;



use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Stripe\Product;


class UsersController extends Controller

{

    public function index()

    {

        //Paginating products

        $user_id = Auth::user()->id;

        $users = User::whereNotIn('id',array($user_id))->whereRaw('access_level != ? ',array('4'))->orderBy('id','desc')->paginate(15);

        foreach($users as $user)

        {

            /// Company detail

            $company_id = $user->userdetail->company_id;

            if($company_id != '')

            {

                $company = Company::find($company_id);

                $user->compnayname = $company->name;    

            }

            else

            {

                $user->compnayname = 'Request Padding By Company';

            }

        }

        $previousPageUrl = $users->previousPageUrl();//previous page url

        $nextPageUrl = $users->nextPageUrl();//next page url

        $lastPage = $users->lastPage(); //Gives last page number

        $total = $users->total();

        

        return view('admin.users.index')->with(['users'=>$users,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);

    }

    

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

     * buyers data

     */

    public function BuyerUsers()

    {

        //Paginating products

        $user_id = Auth::user()->id;

        $users = User::whereNotIn('id',array($user_id))->where('access_level','2')->orderBy('id','desc')->paginate(15);

        foreach($users as $user)

        {

            /// Compnay detail

            $company_id = $user->userdetail->company_id;

            if($company_id != '')

            {

                $company = Company::find($company_id);

                $user->compnayname = $company->name;    

            }

            else

            {

                $user->compnayname = 'Request Padding By Company';

            }

        }

        $previousPageUrl = $users->previousPageUrl();//previous page url

        $nextPageUrl = $users->nextPageUrl();//next page url

        $lastPage = $users->lastPage(); //Gives last page number

        $total = $users->total();

        

        return view('admin.users.buyers')->with(['users'=>$users,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);

    }

    

    /**

     * sellers data

     */

    public function SellersUsers()

    {

        //Paginating products

        $user_id = Auth::user()->id;

        $users = User::whereNotIn('id',array($user_id))->where('access_level','3')->orderBy('id','desc')->paginate(15);

        foreach($users as $user)

        {

            /// Compnay detail

            $company_id = $user->userdetail->company_id;

            if($company_id != '')

            {

                $company = Company::find($company_id);

                $user->compnayname = $company->name;    

            }

            else

            {

                $user->compnayname = 'Request Padding By Company';

            }

        }

        $previousPageUrl = $users->previousPageUrl();//previous page url

        $nextPageUrl = $users->nextPageUrl();//next page url

        $lastPage = $users->lastPage(); //Gives last page number

        $total = $users->total();

        

        return view('admin.users.sellers')->with(['users'=>$users,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);

    }

    

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $access_levels = AccessLevels::all();

        $countries = AppsCountries::all();

        return view('admin.users.create')->with(['access_levels'=>$access_levels,'countries'=>$countries]);

    }

    

    /**

     * Passowrd generate

     */

    public function randomPassword() {

        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";

        $pass = array(); //remember to declare $pass as an array

        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

        for ($i = 0; $i < 8; $i++) {

            $n = rand(0, $alphaLength);

            $pass[] = $alphabet[$n];

        }

        return implode($pass); //turn the array into a string

    }

    

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

       $this->validate($request, [

            'firstname' => 'required|max:255',

            'lastname' => 'required|max:255',

            'email' => 'required|email|max:255|unique:users',

            'company' => 'required',

            'address1' => 'required',

            'city' => 'required',

            'zip' => 'required',

            'phone' => 'required'

        ]);

        

        $input = $request->all();

        

        $password = $this->randomPassword();

        

        $user = User::create([

            'name' => $input['firstname'],

            'email' => $input['email'],

            'password' => bcrypt($password),

            'access_level' => $input['account_type'],

            'email_verify' => 1,

        ]);

        

        if($input['account_type'] == 1)

        {

            $account_type = 'Super Admin';

        }

        elseif($input['account_type'] == 2)

        {

            $account_type = 'buyer';

        }

        elseif($input['account_type'] == 3)

        {

            $account_type = 'Seller';

        }

        $userData = New UserDetails;

        $userData->first_name = $input['firstname'];

        $userData->last_name = $input['lastname'];

        $userData->user_id = $user->id;

        $userData->address1 = $input['address1'];

        $userData->address2 = $input['address2'];

        $userData->city = $input['city'];

        $userData->state = $input['state'];

        $userData->zip = $input['zip'];

        $userData->country = $input['country'];

        $userData->phone = $input['phone'];

        $userData->account_type = $account_type;

        $userData->is_active = 1;

        $userData->save();

        

        /// Compnay request send

        $CompanyUsers = new CompanyUsers;

        $CompanyUsers->company_id = $input['company'];

        $CompanyUsers->user_id = $user->id;

        $CompanyUsers->status = 0;

        $CompanyUsers->save();

        

        $data = array('name'=>$input['firstname'].' '.$input['lastname'],'email'=>$input['email'],'password'=>$password);

            Mail::send('admin.Emailtemplates.emailTemplate', $data, function($message){

                $message->from(env('MAIL_USERNAME'), 'Indy John Team');

                $message->to(Input::get('email'), Input::get('firstname').' '.Input::get('lastname'))->subject('Indy John account update');

            });

        

        // redirect to index page

        return Redirect::to('users')->with('message', 'Your account details have been updated.');

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //Edit marketplace product information.

        $user = User::find($id);

        $userData = UserDetails::where('user_id',$user->id)->first();

        $company = Company::find($userData->company_id);

        if($company)

        {

            $userData->companyname = $company->name;

        }

        else

        {

            $userData->companyname = '';

        }

        $access_levels = AccessLevels::all();

        return view('admin.users.edit')->with(['user'=>$user,'userData'=>$userData,'access_levels'=>$access_levels]);

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

        // update user

        $user = User::find($id);

        $input = $request->all();

        //Validations

        $this->validate($request, [

            'firstname' => 'required|max:255',

            'lastname' => 'required|max:255',

            'company' => 'required',

            'address1' => 'required',

            'city' => 'required',

            'zip' => 'required',

            'phone' => 'required'

        ]);

        

        

        if($input['account_type'] == 1)

        {

            $account_type = 'Super Admin';

        }

        elseif($input['account_type'] == 2)

        {

            $account_type = 'buyer';

        }

        elseif($input['account_type'] == 3)

        {

            $account_type = 'Seller';

        }

        

        $user->name = $input['firstname'];

        $user->access_level = $input['account_type'];

        $user->email_verify = $input['email_verify'];

        $user->save();

        

        /// User details update

        $userData = UserDetails::where('user_id',$id)->first();

        $userData->first_name = $input['firstname'];

        $userData->last_name = $input['lastname'];

        $userData->address1 = $input['address1'];

        $userData->address2 = $input['address2'];

        $userData->city = $input['city'];

        $userData->state = $input['state'];

        $userData->zip = $input['zip'];

        $userData->country = $input['country'];

        $userData->phone = $input['phone'];

        $userData->account_type = $account_type;

        $userData->is_active = 1;

        $userData->about = $input['about'];

        $userData->website_url = $input['website_url'];

        $userData->facebook_url = $input['facebook_url'];

        $userData->insta_url = $input['insta_url'];

        $userData->pintress_url = $input['pintress_url'];

        $userData->youtube_url = $input['youtube_url'];

        $userData->linkedin = $input['linkedin'];

        $userData->google_plus = $input['google_plus'];

        $userData->save();

        

        /// If compnay changed than request send to compnay for accept

        $old_company_id = $userData->company_id;

        if($old_company_id != $input['company'])

        {

            $userCompnayObj = CompanyUsers::where('user_id',$id)->first();

            if($userCompnayObj)

            {

                $userCompnayObj->delete();

            }

            $CompanyUsers = new CompanyUsers;

            $CompanyUsers->company_id = $input['company'];

            $CompanyUsers->user_id = $id;

            $CompanyUsers->status = 0;

            $CompanyUsers->save();

        }

        

        // redirect to index page

        if(Input::get('account') == 1)

        {

            return Redirect::to('user/account')->with('message', 'Your account details have been updated.');

        }

        else

        {

            return Redirect::to('users')->with('message', 'Your account details have been updated.');    

        }

        

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $user = User::find($id);

        $user->delete();

        return Redirect::to('users')->with('message', 'Your selected action has been completed.');

    }

    

    /**

     * Compnies search

     */

    public function searchCompanies()

    {

        if(isset($_GET['q']))

        {

            $search = $_GET['q'];

            $companies = Company::whereRaw("(name LIKE '%$search%') AND is_active = 1 ")->get();

            $companyArray = array();

            foreach($companies as $company)

            {

                $dataArray = array();

                $dataArray['id'] = $company->id;

                $dataArray['full_name'] = $company->name;

                $companyArray[] = $dataArray;

            }

        }

        else

        {

            $companyArray = array();

        }

        

        $ajaxArray = array();

        $ajaxArray['incomplete_results'] = false;

        $ajaxArray['items'] = $companyArray;

        return Response::json($ajaxArray);

    }

    

    /**

     * industries search

     */

    public function searchIndustries()

    {

        if(isset($_GET['q']))

        {

            $search = $_GET['q'];

            $industries = Industry::whereRaw("(name LIKE '%$search%') AND is_active = 1 ")->get();

            $industryArray = array();

            foreach($industries as $industry)

            {

                $dataArray = array();

                $dataArray['id'] = $industry->id;

                $dataArray['full_name'] = $industry->name;

                $industryArray[] = $dataArray;

            }

        }

        else

        {

            $industryArray = array();

        }

        

        $ajaxArray = array();

        $ajaxArray['incomplete_results'] = false;

        $ajaxArray['items'] = $industryArray;

        return Response::json($ajaxArray);

    }

    

    /**

     * categories search

     */

    public function searchCategories()

    {

        if(isset($_GET['q']))

        {

            $search = $_GET['q'];

            $categories = Category::whereRaw("(name LIKE '%$search%') AND is_active = 1 ")->get();

            $categoryArray = array();

            foreach($categories as $category)

            {

                $dataArray = array();

                $dataArray['id'] = $category->id;

                $dataArray['full_name'] = $category->name;

                $categoryArray[] = $dataArray;

            }

        }

        else

        {

            $categoryArray = array();

        }

        

        $ajaxArray = array();

        $ajaxArray['incomplete_results'] = false;

        $ajaxArray['items'] = $categoryArray;

        return Response::json($ajaxArray);

    }

    

    /**

     * user View

     */

    public function userView()

    {

        $user_id = Auth::user()->id;

        

        $user = User::find($user_id);

        // reviews

        $reviews = $user->reviews;

        foreach($reviews as $review)

        {

            $sender_id = $review->sender_id;

            

            /// for sender detail

            $senderData = UserDetails::where('user_id',$sender_id)->first();

            $review->sender_id = $sender_id;

            $review->sendername = $senderData->first_name.' '.$senderData->last_name;

            $review->sender_avatar = $senderData->profile_picture;

            /// for get sender company

            if($senderData->company_id != '')

            {

                $company = Company::find($senderData->company_id);

                $review->companyname = $company->name;    

            }

            else{

                $review->companyname = '';

            }

            

        }

        // endorsments

        $endorsements = $user->endorsements;

        

        foreach($endorsements as $endorse)

        {

            $sender_id = $endorse->sender_id;

            

            /// find detail of review receiver

            $senderData = UserDetails::where('user_id',$sender_id)->first();

            $endorse->sender_id = $sender_id;

            $endorse->sendername = $senderData->first_name.' '.$senderData->last_name;

            $endorse->sender_avatar = $senderData->profile_picture;

            /// find compnay detail of review receiver

            if($senderData->company_id != '')

            {

                $company = Company::find($senderData->company_id);

                $endorse->companyname = $company->name;    

            }

            else

            {

                $endorse->companyname = '';

            }

            

        }

        // feedbacks

        $feedbacks = $user->feedbacks;

        foreach($feedbacks as $feedback)

        {

            $sender_id = $feedback->sender_id;

            

            /// for sender detail

            $senderData = UserDetails::where('user_id',$sender_id)->first();

            $feedback->sender_id = $sender_id;

            $feedback->sendername = $senderData->first_name.' '.$senderData->last_name;

            $feedback->sender_avatar = $senderData->profile_picture;

            /// for get sender company

            if($senderData->company_id != '')

            {

                $company = Company::find($senderData->company_id);

                $feedback->companyname = $company->name;    

            }

            else

            {

                $feedback->companyname = '';

            }

            

        }

        return view('user.dataView')->with(['user'=>$user,'reviews'=>$reviews,'endorsements'=>$endorsements,'feedbacks'=>$feedbacks]);

    }

    

    /**

     * User Profile

     */

    public function profileView()

    {

        $user_id = Auth::user()->id;

        $id = $user_id;

        $current_user_id = Auth::user()->id;

        $user = User::find($user_id);

        $user->review_count = count($user->reviews);

        $user->endorse_count = count($user->endorsements);

        $user->message_count = count($user->messages);

        $userData = UserDetails::where('user_id',$id)->first();

        if($user->account_member == 'gold')

        {

            $user->star = 'gold';

        }

        elseif($user->account_member == 'silver')

        {

            $user->star = 'silver';

        }

        else

        {

            $user->star = 'none';

        }

        $company_id = $userData->company_id;

        

        if(count($user->userEducationDetails) > 0)

        {

            $education = UserEducationDetails::where('user_id',$user_id)->orderBy('date_received','desc')->first();

            $user->education = $education;

        }

        else

        {

            $user->education = '';

        }

        

        if($company_id != '')

        {

            $UserCompany = Company::find($company_id);

            $UserCompany->user = User::find($UserCompany->user_id);

            $user->company = $UserCompany;

            $coworkers = UserDetails::whereRaw('company_id = ? AND user_id != ?',array($UserCompany,$id))->get()->toArray();

            

            if($UserCompany->user->account_member == 'gold')

            {

                $UserCompany->star = 'gold';

            }

            elseif($UserCompany->user->account_member == 'silver')

            {

                $UserCompany->star = 'silver';

            }

            else

            {

                $UserCompany->star = 'none';

            }

            

        }

        else

        {

            $UserCompany = new Company;

            $user->company = $UserCompany;

            $coworkers = array();

        }

        

        /// marketplace products

        $products = MarketplaceProducts::where('user_id',$user_id)->paginate(10);

        foreach($products as $product)

        {

            $imageObj = MarketplaceProductGallery::where('product_id',$product->id)->first();

            if($imageObj)

            {

                $product->image = $imageObj->path;    

            }

            else

            {

                $product->image = 'placeholder_png.jpg';

            }

            

            $product->user = User::find($product->user_id);

            if($product->user->account_member == 'gold')

            {

                $product->star = 'gold';

            }

            elseif($product->user->account_member == 'silver')

            {

                $product->star = 'silver';

            }

            else

            {

                $product->star = 'none';

            }

        }

        

        // endorsments

        $endorsements = $user->endorsements;

        

        foreach($endorsements as $endorse)

        {

            $sender_id = $endorse->sender_id;

            

            /// find detail of review receiver

            $endorse->user = User::find($sender_id);

            $senderData = UserDetails::where('user_id',$sender_id)->first();

            $endorse->sender_id = $sender_id;

            $endorse->sendername = $senderData->first_name.' '.$senderData->last_name;

            $endorse->sender_avatar = $senderData->profile_picture;

            /// find compnay detail of review receiver

            if($senderData->company_id != '')

            {

                $company = Company::find($senderData->company_id);

                $endorse->companyname = $company->name;    

            }

            else

            {

                $endorse->companyname = '';

            }

            

        }

        

        // reviews

        $reviews = $user->reviews;

        

        foreach($reviews as $review)

        {

            $sender_id = $review->sender_id;

            

            /// find detail of review receiver

            $senderUser = User::find($sender_id);

            $review->user = $senderUser;

            $senderData = UserDetails::where('user_id',$sender_id)->first();

            $review->sender_id = $sender_id;

            $review->sendername = $senderData->first_name.' '.$senderData->last_name;

            $review->sender_avatar = $senderData->profile_picture;

            $review->review = count($senderUser->reviews);

            $review->senderfrom = $senderData->city.','.$senderData->state.','.$senderData->country;

            /// find compnay detail of review receiver

            if($senderData->company_id != '')

            {

                $company = Company::find($senderData->company_id);

                $review->companyname = $company->name;    

            }

            else

            {

                $review->companyname = '';

            }

            

        }

        

        // contacts

        $contacts = ContactUsers::whereRaw('sender_user_id = ? AND status = ?',array($id,1))->get();

        foreach($contacts as $contact)

        {

            $request_user_id = $contact->request_user_id;

            /// find detail of review receiver

            $receiverData = UserDetails::where('user_id',$request_user_id)->first();

            $contact->receiver = $receiverData;

            $contact->user = User::find($request_user_id);

        }

        

        // feedbacks

        $feedbacks = $user->feedbacks;

        foreach($feedbacks as $feedback)

        {

            $sender_id = $feedback->sender_id;

            

            /// for sender detail

            $senderUser = User::find($sender_id);

            $feedback->user = $senderUser;

            $senderData = UserDetails::where('user_id',$sender_id)->first();

            $feedback->sender_id = $sender_id;

            $feedback->endorsements = count($senderUser->endorsements);

            $feedback->sendername = $senderData->first_name.' '.$senderData->last_name;

            $feedback->senderfrom = $senderData->city.','.$senderData->state.','.$senderData->country;

            $feedback->sender_avatar = $senderData->profile_picture;

            /// for get sender company

            if($senderData->company_id != '')

            {

                $company = Company::find($senderData->company_id);

                $feedback->companyname = $company->name;    

            }

            else

            {

                $feedback->companyname = '';

            }

            

        }

        

        return view('user.profile')->with([

                                            'user'=>$user,

                                            'userData'=>$userData,

                                            'current_user_id'=>$current_user_id,

                                            'endorsements'=>$endorsements,

                                            'contacts'=>$contacts,

                                            'feedbacks'=>$feedbacks,

                                            'coworkers'=>$coworkers,

                                            'reviews' => $reviews,

                                            'products'=>$products,

                                            'company'=>$UserCompany

                                            ]);

        //return view('user.profile')->with(['user'=>$user,'reviews'=>$reviews,'endorsements'=>$endorsements,'feedbacks'=>$feedbacks]);

    }

    /**

     * User Account

     */

    public function accountView()

    {

        $user_id = Auth::user()->id;

        

        $user = User::find($user_id);

        

        $userData = UserDetails::where('user_id',$user->id)->first();

        $company = Company::find($userData->company_id);

        if($company)

        {

            $userData->companyname = $company->name;

        }

        else

        {

            $userData->companyname = '';

        }

        $access_levels = AccessLevels::all();

        $countries = AppsCountries::all();

        

        return view('user.account')->with(['user'=>$user,'userData'=>$userData,'access_levels'=>$access_levels,'countries'=>$countries]);

    }

    

    /**

     * save profile picture

     */

    public function saveProfilePicture()

    {
        $showCustomCongrates = Session::get('showCustomCongrates');
        $user_id = Auth::user()->id;

        $userData = UserDetails::where('user_id',$user_id)->first();

        if(Input::file('profile_picture'))

        {

            $old_file = $userData->profile_picture;

            if($old_file != '')

            {

                unlink('public/'.$old_file);

            }

            $profile_picture = '';

            /// picture file upload to public folder ///

            $destinationPath = 'public/profile/picture'; // upload path

            $pdfName = str_replace(' ','_',$userData['first_name']).'_'.rand(11111,99999). '.' .Input::file('profile_picture')->getClientOriginalExtension();

            Input::file('profile_picture')->move(

                base_path() . '/'.$destinationPath, $pdfName

            );

            $profile_picture = 'profile/picture/'.$pdfName;

            

            $userData->profile_picture = $profile_picture;

            $userData->save();

        }

        if(Input::has('first_time'))
        {
            $userData->profile_complete = 1;

            $userData->save();

            if($showCustomCongrates == 'yes')
            {
                if($userData->company_id != null)
                {
                    $companyId = $userData->company_id;
                    $companyProfile = Company::find($companyId);
                    if($companyProfile)
                    {
                        $companyProfile->owner_id = $user_id;
                        $companyProfile->save();

                        //Session::forget('showCustomCongrates');
                        return Redirect::to('user-dashboard?popup=showCustomCongrates');
                    }
                    else
                    {
                        Session::forget('showCustomCongrates');
                        return Redirect::to('user-dashboard?profile=completed');
                    }
                }
                else
                {
                    Session::forget('showCustomCongrates');
                    return Redirect::to('user-dashboard?profile=completed');
                }
            }
            else
            {
                Session::forget('showCustomCongrates');
                return Redirect::to('user-dashboard?profile=completed');
            }
        }
        else
        {
            return Redirect::to('user/profile')->with('message', 'Your account details have been updated.');
        }

    }

    

    /**

     * User Profile sow frontend

     */

    public function userProfileShow($id)

    {

        $current_user_id = Auth::user()->id;

        $user = User::find($id);

        

        // for set unique number

        if($user->unique_number == '')

        {

            // for user unique number

            $unique = UserUnique::first();

            $next = $unique->number+1;

            $unique->number = $next;

            $unique->save();

            

            $unique_number = 'IJU-'.$next;

            

            $user->unique_number = $unique_number;

            $user->save();

        }

        

        // for set external url if blank

        if($user->external_link == '')

        {

            $user->external_url = $this->seo_friendly_url($user->userdetail->first_name.'-'.$user->userdetail->last_name).'-'.$user->unique_number;    

            $user->save();

        }

        

        $userData = UserDetails::where('user_id',$id)->first();

        if($user->account_member == 'gold')

        {

            $user->star = 'gold';

        }

        elseif($user->account_member == 'silver')

        {

            $user->star = 'silver';

        }

        else

        {

            $user->star = 'none';

        }

        $company_id = $userData->company_id;

        if($company_id != '')

        {

            $UserCompany = Company::find($company_id);

            $UserCompany->user = User::find($UserCompany->user_id);

            $user->company = $UserCompany;

            $coworkers = UserDetails::whereRaw('company_id = ? AND user_id != ?',array($UserCompany,$id))->get()->toArray();

            

            if($UserCompany->user->account_member == 'gold')

            {

                $UserCompany->star = 'gold';

            }

            elseif($UserCompany->user->account_member == 'silver')

            {

                $UserCompany->star = 'silver';

            }

            else

            {

                $UserCompany->star = 'none';

            }

            

        }

        else

        {

            $UserCompany = new Company;

            $user->company = $UserCompany;

            $coworkers = array();

        }

        /// marketplace products

        $products = MarketplaceProducts::where('user_id',$id)->paginate(10);

        foreach($products as $product)

        {

            $imageObj = MarketplaceProductGallery::where('product_id',$product->id)->first();

            if($imageObj)

            {

                $product->image = $imageObj->path;    

            }

            else

            {

                $product->image = 'placeholder_png.jpg';

            }

            

            $product->user = User::find($product->user_id);

            if($product->user->account_member == 'gold')

            {

                $product->star = 'gold';

            }

            elseif($product->user->account_member == 'silver')

            {

                $product->star = 'silver';

            }

            else

            {

                $product->star = 'none';

            }

        }

        if(count($user->userEducationDetails) > 0)

        {

            $education = UserEducationDetails::where('user_id',$user->id)->orderBy('date_received','desc')->first();

            $user->education = $education;

        }

        else

        {

            $user->education = '';

        }

        // endorsments

        $endorsements = $user->endorsements;

        

        foreach($endorsements as $endorse)

        {

            $sender_id = $endorse->sender_id;

            

            /// find detail of review receiver

            $endorse->user = User::find($sender_id);            

            $senderData = UserDetails::where('user_id',$sender_id)->first();

            $endorse->sender_id = $sender_id;

            $endorse->sendername = $senderData->first_name.' '.$senderData->last_name;

            $endorse->sender_avatar = $senderData->profile_picture;

            /// find compnay detail of review receiver

            if($senderData->company_id != '')

            {

                $company = Company::find($senderData->company_id);

                $endorse->companyname = $company->name;

            }

            else

            {

                $endorse->companyname = '';

            }

            

        }

        

        // reviews

        $reviews = $user->reviews;

        $companyUser = '';

        foreach($reviews as $review)

        {

            $sender_id = $review->sender_id;

            

            /// find detail of review receiver

            $senderUser = User::find($sender_id);

            $review->user = $senderUser;

            $senderData = UserDetails::where('user_id',$sender_id)->first();

            $review->sender_id = $sender_id;

            $review->sendername = $senderData->first_name.' '.$senderData->last_name;

            $review->sender_avatar = $senderData->profile_picture;

            $review->review = count($senderUser->reviews);

            $review->senderfrom = $senderData->city.','.$senderData->state.','.$senderData->country;

            /// find compnay detail of review receiver

            if($senderData->company_id != '')

            {

                $company = Company::find($senderData->company_id);

                $companyUser = User::find($company->user_id);

                $review->companyname = $company->name;    

            }

            else

            {

                $companyUser = '';

                $review->companyname = '';

            }

        }

        

        // contacts

        $contacts = ContactUsers::whereRaw('sender_user_id = ? AND status = ?',array($id,1))->get();

        foreach($contacts as $contact)

        {

            $request_user_id = $contact->request_user_id;

            /// find detail of review receiver

            $receiverData = UserDetails::where('user_id',$request_user_id)->first();

            $contact->receiver = $receiverData;

            $contact->user = User::find($request_user_id);

            /// find detail of review company

            if($contact->request_user_company_id != '')

            {

                $company = Company::find($contact->request_user_company_id);

                $contact->companyname = $company->name;

            }

            else

            {

                $contact->companyname = '';

            }

        }

        

        // feedbacks

        $feedbacks = $user->feedbacks;

        foreach($feedbacks as $feedback)

        {

            $sender_id = $feedback->sender_id;

            

            /// for sender detail

            $senderUser = User::find($sender_id);

            $feedback->user = $senderUser;

            $senderData = UserDetails::where('user_id',$sender_id)->first();

            $feedback->sender_id = $sender_id;

            $feedback->endorsements = count($senderUser->endorsements);

            $feedback->sendername = $senderData->first_name.' '.$senderData->last_name;

            $feedback->senderfrom = $senderData->city.','.$senderData->state.','.$senderData->country;

            $feedback->sender_avatar = $senderData->profile_picture;

            /// for get sender company

            if($senderData->company_id != '')

            {

                $company = Company::find($senderData->company_id);

                $feedback->companyname = $company->name;    

            }

            else

            {

                $feedback->companyname = '';

            }

            

        }



        // skills and expertise

        $item_specifics_value = array();

        if($userData->skills_expertise != ''){



            if(@unserialize($userData->skills_expertise))

            {

                $item_specifics_value = unserialize($userData->skills_expertise);

                if(!empty($item_specifics_value))

                {

                    $specification_string = '';

                    foreach($item_specifics_value as $index=>$item_specific)

                    {

                        if($index == 0)

                        {

                            $specification_string = $item_specific['name'];

                        }

                        else

                        {

                            $specification_string .= ','.$item_specific['name'];

                        }

                    }

                }

            }

            else

            {

                $item_specifics_value = array();

            }



        }else{

            $item_specifics_value = array();

        }

        $user->review_count = count($reviews);

        $user->endorse_count = count($endorsements);

        $user->message_count = count($contacts);

        if($user->userdetail->facebook_url != '' || $user->userdetail->facebook_url != NULL){
            $url = $user->userdetail->facebook_url;
            $host = explode(':',$url);

            if($host[0] == 'http'){
                $facebookUrl = $url;
            }else{
                $facebookUrl = 'http://'.$url;
            }
        }else{
            $facebookUrl = '';
        }

        if($user->userdetail->twitter_url != '' || $user->userdetail->twitter_url != NULL){
            $url = $user->userdetail->twitter_url;
            $host = explode(':',$url);

            if($host[0] == 'http'){
                $twitterUrl = $url;
            }else{
                $twitterUrl = 'http://'.$url;
            }
        }else{
            $twitterUrl = '';
        }

        if($user->userdetail->insta_url != '' || $user->userdetail->insta_url != NULL){
            $url = $user->userdetail->insta_url;
            $host = explode(':',$url);

            if($host[0] == 'http'){
                $instaUrl = $url;
            }else{
                $instaUrl = 'http://'.$url;
            }
        }else{
            $instaUrl = '';
        }

        if($user->userdetail->youtube_url != '' || $user->userdetail->youtube_url != NULL){
            $url = $user->userdetail->youtube_url;
            $host = explode(':',$url);

            if($host[0] == 'http'){
                $youtubeUrl = $url;
            }else{
                $youtubeUrl = 'http://'.$url;
            }
        }else{
            $youtubeUrl = '';
        }

        return view('frontview.profile')->with([

                                                'user'=>$user,

                                                'userData'=>$userData,

                                                'current_user_id'=>$current_user_id,

                                                'endorsements'=>$endorsements,

                                                'contacts'=>$contacts,

                                                'feedbacks'=>$feedbacks,

                                                'coworkers'=>$coworkers,

                                                'reviews' => $reviews,

                                                'products'=>$products,

                                                'company'=>$UserCompany,

                                                'item_specifics_value'=>$item_specifics_value,

                                                'facebookUrl'=>$facebookUrl,

                                                'twitterUrl'=>$twitterUrl,

                                                'instaUrl'=>$instaUrl,

                                                'youtubeUrl'=>$youtubeUrl

                                                ]);

    }



    /**

     *  User Contact Save

     */

    public function userContactSave($id)

    {

        $user_id = Auth::user()->id;

        $checkSavedUser = ContactSave::whereRaw('sender_id = ? AND receiver_id = ?',array($user_id,$id))->first();

        if($checkSavedUser)

        {

            return Redirect::back()->with('message', 'You have already saved this profile.');

        }

        else{

            $contactSave = new ContactSave;

            $contactSave->sender_id = $user_id;

            $contactSave->receiver_id = $id;

            $contactSave->save();

    

            return Redirect::back()->with('message', 'This profile has been saved.');    

        }

        

    }


    /**
     * save company
     */
    public function userCompanySave($id)
    {
        $user_id = Auth::user()->id;
        
        $checkSavedCompany = CompanySave::whereRaw('user_id = ? AND company_id = ?',array($user_id,$id))->first();

        if($checkSavedCompany)

        {

            return Redirect::back()->with('message', 'You have already saved this company.');

        }

        else{

            $companySave = new CompanySave;

            $companySave->user_id = $user_id;

            $companySave->company_id = $id;

            $companySave->save();

    

            return Redirect::back()->with('message', 'This company has been saved.');    

        }
    }


    /**

     * Check current wizard

     */

    public function checkWizard()

    {

        if(!Auth::user()->getWizardTrack)

        {

            $wizardObj = new UserWizardTrack;

            $wizardObj->user_id = Auth::user()->id;

            $wizardObj->wizard_step = 1;

            $wizardObj->save();

            $wizard = $wizardObj->wizard_step;

        }

        else

        {

            $wizard = Auth::user()->getWizardTrack->wizard_step;    

        }

        

        

        if($wizard == 2)

        {

            return Redirect::to('user-additional-details');   

        }

        elseif($wizard == 3)

        {

            return Redirect::to('user/upload/photo');

        }

        elseif($wizard == 4)

        {

            return Redirect::to('user/company/select');

        }

        elseif($wizard == 5)

        {

            return Redirect::to('user/billing/plans');

        }

        else

        {

            return Redirect::to('user/company/select');    

        }

    } 

    

    /**

     * show basic info view

     */

    public function showDetails()

    {

        if(isset($_REQUEST['customCongrates']))
        {
            $showCustomCongrates = $_REQUEST['customCongrates'];
        }
        else
        {
            $showCustomCongrates = 'no';
        }
        Session::forget('showCustomCongrates');
        Session::put('showCustomCongrates',$showCustomCongrates);

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $userData = UserDetails::where('user_id',$user_id)->first();

        if($userData->city != '')

        {

            $userAddress = $userData->city.','.$userData->state.','.$userData->country;

        }

        else

        {

            $userAddress = '';

        }

        if($userData->industry_id != '')

        {

            $userIndustry = Industry::find($userData->industry_id);

            $userData->UserIndustryName = $userIndustry->name;

        }

        else

        {

            $userData->UserIndustryName = '';

        }



        $indutries = Industry::all();

        $countries = AppsCountries::all();

        $languages = AppsLanguages::all();

        // Additional Industries Data

        $additionlIndustries = UserAdditionalIndustries::where('user_id',$user_id)->get();

        $selectedAdditionlIndustries = array();

        foreach($additionlIndustries as $additionalIndusrty)

        {

            $selectedAdditionlIndustries[] = $additionalIndusrty->industry_id;

        }

        /// langauges selected

        $selecteLanguageArray = array();

        $allselected = explode(',',$userData->language_spoken);

        foreach($allselected as $selected)

        {

            $selecteLanguageArray[] = $selected;

        }

        

        $techServices = TechService::all();

        $selectedUserTech = array();

        foreach($user->techServices as $techService)

        {

            $selectedUserTech[] = $techService->techService->id;    

        }

        

        // skills and expertise

        if($userData->skills_expertise != ''){

            if(@unserialize($userData->skills_expertise))

            {

                $item_specifics_value = unserialize($userData->skills_expertise);

                if(!empty($item_specifics_value))

                {

                    $specification_string = '';

                    foreach($item_specifics_value as $index=>$item_specific)

                    {

                        if($index == 0)

                        {

                            $specification_string = $item_specific['name'];

                        }

                        else

                        {

                            $specification_string .= ','.$item_specific['name'];

                        }

                    }

                    $userData->specification = $specification_string;

                    

                }

                else

                {

                    $userData->specification = '';

                }

            }

            else

            {

                $userData->specification = '';

            }



        }else{

            $userData->specification = '';

        }



        return view('user.details')->with([

                                            'user' => $user,

                                            'user_id' => $user_id,

                                            'userData' => $userData,

                                            'selectedAdditionlIndustries' => $selectedAdditionlIndustries,

                                            'countries' => $countries,

                                            'indutries' => $indutries,

                                            'languages' => $languages,

                                            'selecteLanguageArray' => $selecteLanguageArray,

                                            'techServices'=>$techServices,

                                            'selectedUserTech'=>$selectedUserTech,

                                            'userAddress' =>$userAddress,

                                        ]);

    }

    

    /**

     * save user basic info

     */

    public function saveUserBasicInfo(Request $request)

    {

        

        $user_id = Auth::user()->id;

        // user detail save

        $input = $request->all();

        $this->validate($request, [

                'firstname' => 'required',

                'user_industry' => 'required',

                'lastname' => 'required',

                'city' => 'required',

                'state' => 'required',

                'zip' => 'required',

                'country' => 'required'

            ]);

        

        $next_step = $input['next_step'];

        // Skills and expertise

        $SpecificationArray = array();

        if(Input::has('specification'))

        {

            $allSpecifications = explode(',',$input['specification']);

            

            foreach($allSpecifications as $specification)

            {

                if($specification != '')

                {

                    $dataArray = array();

                    $opt = SkillsExpertise::where('name',$specification)->first();

                    if($opt)

                    {

                        $dataArray['id'] = $opt->id;

                        $dataArray['name'] = $opt->name;

                    }

                    else

                    {

                        $newOpt = new SkillsExpertise;

                        $newOpt->name = $specification;

                        $newOpt->user_id = $user_id;

                        $newOpt->save();

                        $dataArray['id'] = $newOpt->id;

                        $dataArray['name'] = $newOpt->name;   

                    }

                }

                

                $SpecificationArray[] = $dataArray;

            }

        }

        if(!empty($SpecificationArray))

        {

            $serialized_array=serialize($SpecificationArray);    

        }

        else

        {

            $serialized_array = null;

        }

        

        $userData = UserDetails::where('user_id',$user_id)->first();

        $userData->first_name = $input['firstname'];

        $userData->last_name = $input['lastname'];

        //$userData->address1 = $input['address1'];

        //$userData->address2 = $input['address2'];

        $userData->city = $input['city'];

        $userData->state = $input['state'];

        $userData->zip = $input['zip'];

        $userData->country = $input['country'];

        $userData->profile_slogan = $input['slogan'];

        $userData->about = $input['about'];

        $userData->industry_id = $input['user_industry'];

        $userData->current_position = $input['current_position'];

        $userData->alias_name = $input['alias_name'];

        $userData->skills_expertise = $serialized_array;

        $userData->skype_id = $input['skype_id'];

        $userData->fax = $input['fax'];

        $userData->save();

        

        /// user additional Industries

        if(Input::has('user_additional_industries'))

        {

            $oldIndustries = UserAdditionalIndustries::where('user_id',$user_id)->get();

            if($oldIndustries)

            {

                foreach($oldIndustries as $indst)

                {

                    $indst->delete();

                }

            }

            foreach(Input::get('user_additional_industries') as $industry)

            {

                $userIndustries = new UserAdditionalIndustries;

                $userIndustries->user_id = $user_id;

                $userIndustries->industry_id = $industry;

                $userIndustries->save();

            }

        }

        

        /// user categories

        if(Input::has('user_categories'))

        {

            $oldCategories = UserCategories::where('user_id',$user_id)->get();

            if($oldCategories)

            {

                foreach($oldCategories as $cat)

                {

                    $cat->delete();

                }

            }

            foreach(Input::get('user_categories') as $category)

            {

                $userCategories = new UserCategories;

                $userCategories->user_id = $user_id;

                $userCategories->category_id = $category;

                $userCategories->save();

            }

        }

        

        // company Technical Services

        if(Input::has('user_techservice'))

        {

            //first of all delete existing rows and create new one.

            UserTechServices::whereRaw("user_id = ? ",array($user_id))->delete();

    

            foreach(Input::get('user_techservice') as $acc){

                $companyService = new UserTechServices();

                $companyService->user_id = $user_id;

                $companyService->technical_service_id = $acc;

                $companyService->save();

            }

        }

        

        /// User Activity for message

        $usersActivity = new UsersActivity;

        $usersActivity->activity_name = 'You updated your Personal Profile on '.date('M d, Y').'.';

        $usersActivity->activity_id = $user_id;

        $usersActivity->activity_type = 'user_profile';

        $usersActivity->creater_id = $user_id;

        $usersActivity->receiver_id = null;

        $usersActivity->save();

        

        return Redirect::to('user-additional-details');

    }

    

    /**

     * save additional Info

     */

    public function saveUserAdditionalInfo(Request $request)

    {
        $user_id = Auth::user()->id;

        // user detail save

        $input = $request->all();

        $userData = UserDetails::where('user_id',$user_id)->first();

        $userData->facebook_url = $input['facebook_url'];

        $userData->linkedin = $input['linkedin'];

        $userData->youtube_url = $input['youtube_url'];

        $userData->google_plus = $input['google_plus'];

        $userData->twitter_url = $input['twitter_url'];

        $userData->save();

        

        return Redirect::to('user/upload/photo');

    }

    

    /**

     * User Addtional Detail View

     */

    public function showAdditionalDetails()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $userData = UserDetails::where('user_id',$user_id)->first();

        return view('user.additionalDetails')->with(['user'=>$user,'user_id'=>$user_id,'userData'=>$userData]);

    }

    

    /**

     * show additional detail add modal

     */

    public function addAdditionalDetail($lable)

    {

        if($lable == 'job')

        {

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                                <h4 class="modal-title">Add your Employment Details</h4>

                            </div>

                            <form action="'.url("user/job/save").'" method="post" id="form-addition-job" class="horizontal-form form-horizontal">

                            <input type="hidden" name="_token" value="'.csrf_token().'" />

                            <input type="hidden" name="id" value="" />

                            <div class="modal-body">

                                <div class="form-body">

                                    <div class="form-group">

                                        <div class="col-md-6">

                                            <label class="control-label">Company Name:</label>

                            				<input type="text" class="form-control" name="company_name" placeholder="Enter your Company Name">

                                        </div>

                                        <div class="col-md-6">

                                            <label class="control-label">Position Held:</label>

                            				<input type="text" class="form-control" name="job_title" placeholder="Enter your Position">

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-md-6">

                                            <label class="control-label">Start Date:</label>

                                            <div class="">

                                                <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                                    <input type="text" class="form-control" name="date_from" placeholder="Enter the Start Date">

                                                    <span class="input-group-btn">

                                                        <button class="btn default" type="button">

                                                            <i class="fa fa-calendar"></i>  

                                                        </button>

                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <label class="control-label">End Date:</label>

                                            <div class="">

                                                <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                                    <input type="text" class="form-control" name="date_to" placeholder="Enter End Date or select Current">

                                                    <span class="input-group-btn">

                                                        <button class="btn default" type="button">

                                                            <i class="fa fa-calendar"></i>  

                                                        </button>

                                                    </span>

                                                </div>

                                                <div class="">

                                                    <input type="checkbox" name="current" value="Current" /> Current

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="col-md-6">

                                            <label class="control-label">Company Location:</label>

                            				<input type="text" id="autocomplete" name="location" onFocus="geolocate()" value=""  placeholder="Enter the City, State, Country" class="form-control" />

                                        </div>

                                    </div>

                                </div>

                                

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn red" data-dismiss="modal">Close</button>

                                <button type="button" id="job_btn" onclick="saveAdditionals(id)" class="btn yellow-crusta color-black">Save</button>

                            </div>

                            </form>

                            </div>

                        </div>';

        }

        elseif($lable == 'education')

        {

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        <h4 class="modal-title">Add your Education Details</h4>

                    </div>

                    <form action="'.url("user/education/save").'" method="post" id="form-addition-education" class="horizontal-form">

                        <input type="hidden" name="_token" value="'.csrf_token().'" />

                        <input type="hidden" name="id" value="" />

                    <div class="modal-body">

                        

                        <div class="row">

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Degree Received:</label>

                    				<input type="text" class="form-control" name="degree" placeholder="Enter the Degree Received">

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Institution Name:</label>

                    				<input type="text" class="form-control" name="institute_name" placeholder="Enter the Institution Name">

                                </div>

                            </div>

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Date Received:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" name="date_received" placeholder="Enter the Date Received or select Current">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                        <div class="">

                                            <input type="checkbox" name="current" value="Current" /> Current

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Institution Location:</label>

                                    <input type="text" id="autocomplete" name="location" onFocus="geolocate()" value=""  placeholder="Enter the City, State, Country" class="form-control" />

                                </div>

                            </div>

                        </div>

                        

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">Close</button>

                        <button type="button" id="education_btn" onclick="saveAdditionals(id)" class="btn yellow-crusta color-black">Save</button>

                    </div>

                </form></div></div>';

        }

        elseif($lable == 'certification')

        {

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        <h4 class="modal-title">Add New Details</h4>

                    </div>

                    <form action="'.url("user/certification/save").'" method="post" id="form-addition-certification" class="horizontal-form">

                    <input type="hidden" name="_token" value="'.csrf_token().'" />

                    <input type="hidden" name="id" value="" />

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Certification Name:</label>

                    				<input type="text" class="form-control" name="certification_name" placeholder="Enter Certification Name">

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Certifying Authority:</label>

                    				<input type="text" class="form-control" name="certifying_authority" placeholder="Enter the Certifying Authority">

                                </div>

                            </div>

                            <div class="col-md-12 form-group">

                                <!--<div class="col-md-6">

                                    <label class="control-label">Date Received:</label>

                                    <div class="">

                                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" name="date_received">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                    </div>

                                </div>-->

                                <div class="col-md-6">

                                    <label class="control-label">Expiration Date:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" name="valid_till" placeholder="Enter a date or skip">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                        <div class="">

                                            <input type="checkbox" name="valid_till" value="Does Not Apply" /> Does Not Apply

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">Close</button>

                        <button type="button" id="certification_btn" onclick="saveAdditionals(id)" class="btn yellow-crusta color-black">Save</button>

                    </div>

                </form></div></di>';

        }

        elseif($lable == 'award')

        {

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        <h4 class="modal-title">Add New Details</h4>

                    </div>

                    <form action="'.url("user/award/save").'" method="post" id="form-addition-award" class="horizontal-form">

                    <input type="hidden" name="_token" value="'.csrf_token().'" />

                    <input type="hidden" name="id" value="" />

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Award Name:</label>

                    				<input type="text" class="form-control" name="awards_name" placeholder="Enter Award Name">

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Awarding Authority:</label>

                    				<input type="text" class="form-control" name="awarding_authority" placeholder="Enter Awarding Authority">

                                </div>

                            </div>

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Date Received:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" name="date_received" placeholder="Enter Date Received">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Location:</label>

                                    <input type="text" id="autocomplete" name="location" onFocus="geolocate()" value=""  placeholder="Enter the City, State, Country" class="form-control" />

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">Close</button>

                        <button type="button" id="award_btn" onclick="saveAdditionals(id)" class="btn yellow-crusta color-black">Save</button>

                    </div>

                </form></div></div>';

        }

        elseif($lable == 'member')

        {

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        <h4 class="modal-title">Add Membership Details</h4>

                    </div>

                    <form action="'.url("user/memberorganization/save").'" method="post" id="form-addition-memberorganization" class="horizontal-form">

                    <input type="hidden" name="_token" value="'.csrf_token().'" />

                    <input type="hidden" name="id" value="" />

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Position:</label>

                    				<input type="text" class="form-control" name="postion" placeholder="Enter Position">

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Organization Name:</label>

                    				<input type="text" class="form-control" name="membership_organization" placeholder="Enter Organization Name">

                                </div>

                            </div>

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Member Since:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" name="member_since" placeholder="Enter Join Date">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Expiration Date:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" name="valid_till" placeholder="Enter Expiration Date or Skip">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>
                                        <div class="">

                                            <input type="checkbox" name="valid_till" value="Does Not Apply" /> Does Not Apply

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">Close</button>

                        <button type="button" id="memberorganization_btn" onclick="saveAdditionals(id)" class="btn yellow-crusta color-black">Save</button>

                    </div>

                </form></div></div>';

        }

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        return Response::json($ajaxDataArray);

    }

    

    /**

     * show additional detail edit modal

     */

    public function editAdditionalDetail($lable,$id)

    {

        if($lable == 'job')

        {

            $job = UserJobs::find($id);

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        <h4 class="modal-title">Edit Details</h4>

                    </div>

                    <form action="'.url("user/job/save").'" method="post" id="form-addition-job" class="horizontal-form">

                    <input type="hidden" name="_token" value="'.csrf_token().'" />

                    <input type="hidden" name="id" value="'.$id.'" />

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Company Name:</label>

                    				<input type="text" class="form-control" name="company_name" value="'.$job->company_name.'" placeholder="Enter your Company Name">

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Position Held:</label>

                    				<input type="text" class="form-control" name="job_title" value="'.$job->job_title.'" placeholder="Enter your Position">

                                </div>

                            </div>

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Start Date:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">';
                                            if(strtotime($job->date_from) > 0):
                                            $html .= '<input type="text" class="form-control" value="'.$job->date_from.'" name="date_from">';
                                            else:
                                            $html .= '<input type="text" class="form-control" value="" name="date_from">';
                                            endif;
                                            $html .= '<span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                    </div>

                                </div>';

                                if($job->current != ''):

                                $html .= '<div class="col-md-6">

                                    <label class="control-label">End Date:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" name="date_to" placeholder="Enter End Date or select Current">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                        <div class="">

                                            <input type="checkbox" name="current" checked value="Current" /> Current

                                        </div>

                                    </div>

                                </div>';

                                else:

                                $html .= '<div class="col-md-6">

                                    <label class="control-label">End Date:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" value="'.$job->date_to.'" name="date_to">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                        <div class="">

                                            <input type="checkbox" name="current" value="Current" /> Current

                                        </div>

                                    </div>

                                </div>';

                                endif;

                            $html .= '</div>

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Location:</label>

                                    <input type="text" id="autocomplete" name="location" onFocus="geolocate()" value="'.$job->location.'"  placeholder="Enter the City, State, Country" class="form-control" />

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">Close</button>

                        <button type="button" id="job_btn" onclick="saveAdditionals(id)" class="btn yellow-crusta color-black">Save</button>

                    </div>

                </form></div></div>';

        }

        elseif($lable == 'education')

        {

            $education = UserEducationDetails::find($id);

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        <h4 class="modal-title">Edit Details</h4>

                    </div>

                    <form action="'.url("user/education/save").'" method="post" id="form-addition-education" class="horizontal-form">

                    <input type="hidden" name="_token" value="'.csrf_token().'" />

                    <input type="hidden" name="id" value="'.$id.'" />

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Degree:</label>

                    				<input type="text" class="form-control" name="degree" value="'.$education->degree.'" placeholder="Degree">

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Institute Name:</label>

                    				<input type="text" class="form-control" name="institute_name" value="'.$education->institute_name.'" placeholder="Institute Name">

                                </div>

                            </div>

                            <div class="col-md-12 form-group">';

                                if($education->current != ''):

                                $html .= '<div class="col-md-6">

                                    <label class="control-label">Date Received:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" name="date_received" placeholder="Enter the Date Received or select Current">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                        <div class="">

                                            <input type="checkbox" name="current" checked value="Current" /> Current

                                        </div>

                                    </div>

                                </div>';

                                else:

                                $html .= '<div class="col-md-6">

                                    <label class="control-label">Date Received:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" value="'.$education->date_received.'" name="date_received">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                        <div class="">

                                            <input type="checkbox" name="current" value="Current" /> Current

                                        </div>

                                    </div>

                                </div>';

                                endif;

                                $html .= '<div class="col-md-6">

                                    <label class="control-label">Location:</label>

                                    <input type="text" id="autocomplete" name="location" onFocus="geolocate()" value="'.$education->location.'"  placeholder="Enter the City, State, Country" class="form-control" />

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">Close</button>

                        <button type="button" id="education_btn" onclick="saveAdditionals(id)" class="btn yellow-crusta color-black">Save</button>

                    </div>

                </form></div></div>';

        }

        elseif($lable == 'certification')

        {

            $certification = UserCertifications::find($id);

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        <h4 class="modal-title">Edit Details</h4>

                    </div>

                    <form action="'.url("user/certification/save").'" method="post" id="form-addition-certification" class="horizontal-form">

                    <input type="hidden" name="_token" value="'.csrf_token().'" />

                    <input type="hidden" name="id" value="'.$id.'" />

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Certification Name:</label>

                    				<input type="text" class="form-control" name="certification_name" value="'.$certification->certification_name.'" placeholder="Certification Name">

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Certifying Authority:</label>

                    				<input type="text" class="form-control" name="certifying_authority" value="'.$certification->certifying_authority.'" placeholder="Certifying Authority">

                                </div>

                            </div>

                            <div class="col-md-12 form-group">

                                <!--<div class="col-md-6">

                                    <label class="control-label">Date Received:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">

                                            <input type="text" class="form-control" value="'.$certification->date_received.'" name="date_received">

                                            <span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                    </div>

                                </div>-->

                                <div class="col-md-6">

                                    <label class="control-label">Expiration Date:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">';

                                            if(strtotime($certification->valid_till) > 0):

                                                $html .= '<input type="text" class="form-control" value="'.$certification->valid_till.'" name="valid_till">';
                                                
                                            else:

                                                $html .= '<input type="text" class="form-control" name="valid_till" placeholder="Enter a date or skip">';

                                            endif;

                                            $html .= '<span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>';
                                        if(strtotime($certification->valid_till) > 0):

                                            $html .= '<div class="">

                                                        <input type="checkbox" name="valid_till" value="Does Not Apply" /> Does Not Apply
            
                                                    </div>';
                                            
                                        else:

                                            $html .= '<div class="">

                                                        <input type="checkbox" name="valid_till" checked="checked" value="Does Not Apply" /> Does Not Apply
            
                                                    </div>';

                                        endif;
                                        
                                    $html .= '</div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">Close</button>

                        <button type="button" id="certification_btn" onclick="saveAdditionals(id)" class="btn yellow-crusta color-black">Save</button>

                    </div>

                </form></div></div>';

        }

        elseif($lable == 'award')

        {

            $award = UserAwards::find($id);

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        <h4 class="modal-title">Edit Details</h4>

                    </div>

                    <form action="'.url("user/award/save").'" method="post" id="form-addition-award" class="horizontal-form">

                    <input type="hidden" name="_token" value="'.csrf_token().'" />

                    <input type="hidden" name="id" value="'.$id.'" />

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Award Name:</label>

                    				<input type="text" class="form-control" name="awards_name" value="'.$award->awards_name.'" placeholder="Enter Award Name">

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Awarding Authority:</label>

                    				<input type="text" class="form-control" name="awarding_authority" value="'.$award->awarding_authority.'" placeholder="Enter Awarding Authority">

                                </div>

                            </div>

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Date Received:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">';
                                            
                                            if(strtotime($award->date_received) > 0):

                                                $html .= '<input type="text" class="form-control" value="'.$award->date_received.'" name="date_received" placeholder="Enter Date Received">';
                                                
                                            else:

                                                $html .= '<input type="text" class="form-control" value="" name="date_received" placeholder="Enter Date Received">';

                                            endif;                                            

                                            $html .= '<span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Location:</label>

                                    <input type="text" id="autocomplete" name="location" onFocus="geolocate()" value="'.$award->location.'"  placeholder="Enter the City, State, Country" class="form-control" />

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">Close</button>

                        <button type="button" id="award_btn" onclick="saveAdditionals(id)" class="btn yellow-crusta color-black">Save</button>

                    </div>

                </form></div></div>';

        }

        elseif($lable == 'member')

        {

            $member = UserMemberOrganizations::find($id);

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                        <h4 class="modal-title">Edit Details</h4>

                    </div>

                    <form action="'.url("user/memberorganization/save").'" method="post" id="form-addition-memberorganization" class="horizontal-form">

                    <input type="hidden" name="_token" value="'.csrf_token().'" />

                    <input type="hidden" name="id" value="'.$id.'" />

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Postion:</label>

                    				<input type="text" class="form-control" name="postion" value="'.$member->postion.'" placeholder="Enter Position">

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Organization Name:</label>

                    				<input type="text" class="form-control" name="membership_organization" value="'.$member->membership_organization.'" placeholder="Enter Organization Name">

                                </div>

                            </div>

                            <div class="col-md-12 form-group">

                                <div class="col-md-6">

                                    <label class="control-label">Member Since:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">';
                                            
                                            if(strtotime($member->member_since) > 0):

                                                $html .= '<input type="text" class="form-control" value="'.$member->member_since.'" name="member_since" placeholder="Enter Join Date">';
                                                
                                            else:

                                                $html .= '<input type="text" class="form-control" value="" name="member_since" placeholder="Enter Join Date">';

                                            endif;
                                            
                                            

                                            $html .= '<span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label class="control-label">Valid Till:</label>

                                    <div class="">

                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd">';

                                            if(strtotime($member->valid_till) > 0):

                                                $html .= '<input type="text" class="form-control" value="'.$member->valid_till.'" name="valid_till" placeholder="Enter Expiration Date or Skip">';

                                            else:

                                                $html .= '<input type="text" class="form-control" name="valid_till" placeholder="Enter Expiration Date or Skip">';

                                            endif;

                                            $html .= '<span class="input-group-btn">

                                                <button class="btn default" type="button">

                                                    <i class="fa fa-calendar"></i>  

                                                </button>

                                            </span>

                                        </div>';
                                        if(strtotime($member->valid_till) > 0):

                                            $html .= '<div class="">

                                                        <input type="checkbox" name="valid_till" value="Does Not Apply" /> Does Not Apply
            
                                                    </div>';
                                            
                                        else:

                                            $html .= '<div class="">

                                                        <input type="checkbox" name="valid_till" checked="checked" value="Does Not Apply" /> Does Not Apply
            
                                                    </div>';

                                        endif;
                                    $html .= '</div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">Close</button>

                        <button type="button" id="memberorganization_btn" onclick="saveAdditionals(id)" class="btn yellow-crusta color-black">Save</button>

                    </div>

                </form></div></div>';

        }

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        return Response::json($ajaxDataArray);

    }

    

    /**

     * show additional detail delete modal

     */

    public function deteleAdditionalDetail($lable,$id)

    {

        if($lable == 'job')

        {

            $job = UserJobs::find($id);

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                Are you sure that you want to delete this?

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">No</button>

                        <button type="button" id="'.url('user/job/delete').'/'.$id.'" onclick="deleteAdditionals(id)" class="btn yellow-crusta color-black">Yes</button>

                    </div></div></div>';

        }

        elseif($lable == 'education')

        {

            $education = UserEducationDetails::find($id);

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                Are you sure that you want to delete this?

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">No</button>

                        <button type="button" id="'.url('user/education/delete').'/'.$id.'" onclick="deleteAdditionals(id)" class="btn yellow-crusta color-black">Yes</button>

                    </div></div></div>';

        }

        elseif($lable == 'certification')

        {

            $certification = UserCertifications::find($id);

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                Are you sure that you want to delete this?

                            </div>

                            

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">No</button>

                        <button type="button" id="'.url('user/certification/delete').'/'.$id.'" onclick="deleteAdditionals(id)" class="btn yellow-crusta color-black">Yes</button>

                    </div></div></div>';

        }

        elseif($lable == 'award')

        {

            $award = UserAwards::find($id);

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                Are you sure that you want to delete this?

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">No</button>

                        <button type="button" id="'.url('user/award/delete').'/'.$id.'" onclick="deleteAdditionals(id)" class="btn yellow-crusta color-black">Yes</button>

                    </div></div></div>';

        }

        elseif($lable == 'member')

        {

            $member = UserMemberOrganizations::find($id);

            $html = '';

            $html .= '<div class="modal-dialog">

                        <div class="modal-content">

                        <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12 form-group">

                                Are you sure that you want to delete this?

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn red" data-dismiss="modal">No</button>

                        <button type="button" id="'.url('user/member/delete').'/'.$id.'" onclick="deleteAdditionals(id)" class="btn yellow-crusta color-black">Yes</button>

                    </div></div></div>';

        }

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        return Response::json($ajaxDataArray);

    }

    

    /**

     * Save user job details

     */

    public function saveUserJob()

    {

        $user_id = Auth::user()->id;

        

        if(Input::get('id') != '')

        {

            $job = UserJobs::find(Input::get('id'));

            $job->job_title = Input::get('job_title');

            $job->user_id = $user_id;

            $job->company_name = Input::get('company_name');

            $job->location = Input::get('location');

            $job->date_from = Input::get('date_from');

            if(Input::has('current'))

            {

                $job->current = Input::get('current');

            }

            else

            {

                $job->date_to = Input::get('date_to');

                $job->current = NULL;

            }

            $job->save();

        }

        else

        {

            $job = new UserJobs;

            $job->job_title = Input::get('job_title');

            $job->user_id = $user_id;

            $job->company_name = Input::get('company_name');

            $job->location = Input::get('location');

            $job->date_from = Input::get('date_from');

            if(Input::has('current'))

            {

                $job->current = Input::get('current');

            }

            else

            {

                $job->date_to = Input::get('date_to');

                $job->current = NULL;    

            }

            $job->save();

        }

        

        $jobs = UserJobs::where('user_id',$user_id)->get();

        $html = '';

        $html .= '<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>

                    <tr>

                        <th>Company Name</th>

                        <th> Position Held </th>

                        <th>Start Date</th>

                        <th>End Date</th>

                        <th>Company Location</th>

                        <th> Action </th>

                    </tr>

                    </thead>

                    <tbody>';

                        foreach($jobs as $job):

                        $html .= '<tr>

                            <td>'.$job->company_name.'</td>

                            <td>'.$job->job_title.'</td>

                            <td>';

                                if(strtotime($job->date_from) > 0):

                                   $html .= date('m-d-Y',strtotime($job->date_from)); 

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>';

                            if($job->current != ''):

                            $html .= '<td>'.$job->current.'</td>';

                            else:

                            $html .= '<td>';

                                if(strtotime($job->date_to) > 0):

                                    $html .= date('m-d-Y',strtotime($job->date_to));

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>';

                            endif;

                            $html .= '<td>'.$job->location.'</td>';

                            $html .= '<td>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/edit').'/job/'.$job->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                    <i class="fa fa-edit"></i>  Edit </a>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/delete').'/job/'.$job->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                    <i class="fa fa-remove"></i>  Delete </a>

                            </td>

                        </tr>';

                        endforeach;

                    $html .= '</tbody>

                    </table>';

        

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        return Response::json($ajaxDataArray);

        //return Redirect::to('user-additional-details')->with('message', 'Your account details have been updated.');

    }

    

    /**

     * delete user job

     */

    public function deleteUserJob($id)

    {

        $job = UserJobs::find($id);

        $job->delete();

        

        $jobs = UserJobs::where('user_id',Auth::user()->id)->get();

        $html = '';

        $html .= '<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>

                    <tr>

                        <th>Company Name</th>

                        <th> Position Held </th>

                        <th>Start Date</th>

                        <th>End Date</th>

                        <th>Company Location</th>

                        <th> Action </th>

                    </tr>

                    </thead>

                    <tbody>';

                        foreach($jobs as $job):

                        $html .= '<tr>

                            <td>'.$job->company_name.'</td>

                            <td>'.$job->job_title.'</td>

                            <td>';

                                if(strtotime($job->date_from) > 0):

                                   $html .= date('m-d-Y',strtotime($job->date_from)); 

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>';

                            if($job->current != ''):

                            $html .= '<td>'.$job->current.'</td>';

                            else:

                            $html .= '<td>';

                                if(strtotime($job->date_to) > 0):

                                    $html .= date('m-d-Y',strtotime($job->date_to));

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>';

                            endif;

                            $html .= '<td>'.$job->location.'</td>';

                            $html .= '<td>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/edit').'/job/'.$job->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                    <i class="fa fa-edit"></i>  Edit </a>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/delete').'/job/'.$job->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                    <i class="fa fa-remove"></i>  Delete </a>

                            </td>

                        </tr>';

                        endforeach;

                    $html .= '</tbody>

                    </table>';

        

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        $ajaxDataArray['type'] = 'job';

        return Response::json($ajaxDataArray);

        //return Redirect::to('user-additional-details')->with('message', 'Job successfully deleted!!!!');

    }

    

    /**

     * Save user educationa details

     */

    public function saveUserEducation()

    {

        $user_id = Auth::user()->id;

        if(Input::get('id') != '')

        {

            $education = UserEducationDetails::find(Input::get('id'));

            $education->degree = Input::get('degree');

            $education->user_id = $user_id;

            $education->institute_name = Input::get('institute_name');

            $education->location = Input::get('location');

            if(Input::has('current'))

            {

                $education->current = Input::get('current');

            }

            else

            {

                $education->date_received = Input::get('date_received');

                $education->current = NULL;

            }

            $education->save();

        }

        else

        {

            $education = new UserEducationDetails;

            $education->degree = Input::get('degree');

            $education->user_id = $user_id;

            $education->institute_name = Input::get('institute_name');

            $education->location = Input::get('location');

            if(Input::has('current'))

            {

                $education->current = Input::get('current');

            }

            else

            {

                $education->date_received = Input::get('date_received');

                $education->current = NULL;

            }

            $education->save();

        }

        

        $html = '';

        $educations = UserEducationDetails::where('user_id',$user_id)->get();

        $html .= '<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>

                    <tr>

                        <th> Degree Received </th>

                        <th>Institution Name</th>

                        <th>Institution Location</th>

                        <th>Date Received</th>

                        <th> Action </th>

                    </tr>

                    </thead>

                    <tbody>';

                        foreach($educations as $education):

                        $html .= '<tr>

                            <td>'.$education->degree.'</td>

                            <td>'.$education->institute_name.'</td>

                            <td>'.$education->location.'</td>';

                            if($education->current != ''):

                            $html .= '<td>'.$education->current.'</td>';

                            else:

                            $html .= '<td>';

                                if(strtotime($education->date_received) > 0):

                                    $html .= date('m-d-Y',strtotime($education->date_received));

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>';

                            endif;

                            $html .= '<td>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/edit').'/education/'.$education->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                    <i class="fa fa-edit"></i>  Edit </a>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/delete').'/education/'.$education->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                    <i class="fa fa-remove"></i>  Delete </a>

                            </td>

                        </tr>';

                        endforeach;

                    $html .= '</tbody>

                    </table>';

        

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        return Response::json($ajaxDataArray);

        //return Redirect::to('user-additional-details')->with('message', 'Your account details have been updated.');

    }

    

    

    /**

     * delete user job

     */

    public function deleteUserEducation($id)

    {

        $education = UserEducationDetails::find($id);

        $education->delete();

        

        $html = '';

        $educations = UserEducationDetails::where('user_id',Auth::user()->id)->get();

        $html .= '<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>

                    <tr>

                        <th> Degree Received </th>

                        <th>Institution Name</th>

                        <th>Institution Location</th>

                        <th>Date Received</th>

                        <th> Action </th>

                    </tr>

                    </thead>

                    <tbody>';

                        foreach($educations as $education):

                        $html .= '<tr>

                            <td>'.$education->degree.'</td>

                            <td>'.$education->institute_name.'</td>

                            <td>'.$education->location.'</td>';

                            if($education->current != ''):

                            $html .= '<td>'.$education->current.'</td>';

                            else:

                            $html .= '<td>';

                                if(strtotime($education->date_received) > 0):

                                    $html .= date('m-d-Y',strtotime($education->date_received));

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>';

                            endif;

                            $html .= '<td>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/edit').'/education/'.$education->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                    <i class="fa fa-edit"></i>  Edit </a>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/delete').'/education/'.$education->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                    <i class="fa fa-remove"></i>  Delete </a>

                            </td>

                        </tr>';

                        endforeach;

                    $html .= '</tbody>

                    </table>';

        

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        $ajaxDataArray['type'] = 'education';

        return Response::json($ajaxDataArray);

        

        //return Redirect::to('user-additional-details')->with('message', 'Your account details have been updated.');

    }

    

    

    /**

     * Save user certification details

     */

    public function saveUserCertification()

    {

        $user_id = Auth::user()->id;

        if(Input::get('id') != '')

        {

            $certification = UserCertifications::find(Input::get('id'));

            $certification->certification_name = Input::get('certification_name');

            $certification->user_id = $user_id;

            $certification->certifying_authority = Input::get('certifying_authority');

            //$certification->date_received = Input::get('date_received');

            $certification->valid_till = Input::get('valid_till');

            $certification->save();

        }

        else

        {

            $certification = new UserCertifications;

            $certification->certification_name = Input::get('certification_name');

            $certification->user_id = $user_id;

            $certification->certifying_authority = Input::get('certifying_authority');

            //$certification->date_received = Input::get('date_received');

            $certification->valid_till = Input::get('valid_till');

            $certification->save();

        }

        $certifications = UserCertifications::where('user_id',$user_id)->get();

        $html = '';

        $html .= '<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>

                    <tr>

                        <th> Certification Name </th>

                        <th>Certifying authority</th>

                        <th>Valid Till</th>

                        <th> Action </th>

                    </tr>

                    </thead>

                    <tbody>';

                        foreach($certifications as $certification):

                        $html .= '<tr>

                            <td>'.$certification->certification_name.'</td>

                            <td>'.$certification->certifying_authority.'</td>

                            <td>';

                                if(strtotime($certification->valid_till) > 0):

                                   $html .= date('m-d-Y',strtotime($certification->valid_till));

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>

                            <td>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/edit').'/certification/'.$certification->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                    <i class="fa fa-edit"></i>  Edit </a>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/delete').'/certification/'.$certification->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                    <i class="fa fa-remove"></i>  Delete </a>

                            </td>

                        </tr>';

                        endforeach;

                    $html .= '</tbody>

                </table>';

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        return Response::json($ajaxDataArray);

        //return Redirect::to('user-additional-details')->with('message', 'Your account details have been updated.');

    }

    

    /**

     * delete user job

     */

    public function deleteUserCertification($id)

    {

        $certification = UserCertifications::find($id);

        $certification->delete();

        

        $certifications = UserCertifications::where('user_id',Auth::user()->id)->get();

        $html = '';

        $html .= '<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>

                    <tr>

                        <th> Certification Name </th>

                        <th>Certifying authority</th>

                        <th>Valid Till</th>

                        <th> Action </th>

                    </tr>

                    </thead>

                    <tbody>';

                        foreach($certifications as $certification):

                        $html .= '<tr>

                            <td>'.$certification->certification_name.'</td>

                            <td>'.$certification->certifying_authority.'</td>

                            <td>';

                                if(strtotime($certification->valid_till) > 0):

                                   $html .= date('m-d-Y',strtotime($certification->valid_till));

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>

                            <td>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/edit').'/certification/'.$certification->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                    <i class="fa fa-edit"></i>  Edit </a>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/delete').'/certification/'.$certification->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                    <i class="fa fa-remove"></i>  Delete </a>

                            </td>

                        </tr>';

                        endforeach;

                    $html .= '</tbody>

                </table>';

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        $ajaxDataArray['type'] = 'certification';

        return Response::json($ajaxDataArray);

        //return Redirect::to('user-additional-details')->with('message', 'Your account details have been updated.');

    }

    

    

    /**

     * Save user awards details

     */

    public function saveUserAward()

    {

        $user_id = Auth::user()->id;

        if(Input::get('id') != '')

        {

            $award = UserAwards::find(Input::get('id'));

            $award->awards_name = Input::get('awards_name');

            $award->user_id = $user_id;

            $award->awarding_authority = Input::get('awarding_authority');

            $award->date_received = Input::get('date_received');

            $award->location = Input::get('location');

            $award->save();

        }

        else

        {

            $award = new UserAwards;

            $award->awards_name = Input::get('awards_name');

            $award->user_id = $user_id;

            $award->awarding_authority = Input::get('awarding_authority');

            $award->date_received = Input::get('date_received');

            $award->location = Input::get('location');

            $award->save();

        }

        $awards = UserAwards::where('user_id',$user_id)->get();

        $html = '';

        $html .= '<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>

                    <tr>

                        <th> Award/ Honor Name</th>

                        <th>Awarding Authority</th>

                        <th>Date Received</th>

                        <th>Location</th>

                        <th> Action </th>

                    </tr>

                    </thead>

                    <tbody>';

                        foreach($awards as $award):

                        $html .= '<tr>

                            <td>'.$award->awards_name.'</td>

                            <td>'.$award->awarding_authority.'</td>

                            <td>';

                                if(strtotime($award->date_received) > 0):

                                    $html .= date('m-d-Y',strtotime($award->date_received));

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>

                            <td>'.$award->location.'</td>

                            <td>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/edit').'/award/'.$award->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                    <i class="fa fa-edit"></i>  Edit </a>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/delete').'/award/'.$award->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                    <i class="fa fa-remove"></i>  Delete </a>

                            </td>

                        </tr>';

                        endforeach;

                    $html .= '</tbody>

                </table>';

        

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        return Response::json($ajaxDataArray);

        //return Redirect::to('user-additional-details')->with('message', 'Your account details have been updated.');

    }

    

    /**

     * delete user job

     */

    public function deleteUserAward($id)

    {

        $award = UserAwards::find($id);

        $award->delete();

        

        $awards = UserAwards::where('user_id',Auth::user()->id)->get();

        $html = '';

        $html .= '<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>

                    <tr>

                        <th> Award/ Honor Name</th>

                        <th>Awarding Authority</th>

                        <th>Date Received</th>

                        <th>Location</th>

                        <th> Action </th>

                    </tr>

                    </thead>

                    <tbody>';

                        foreach($awards as $award):

                        $html .= '<tr>

                            <td>'.$award->awards_name.'</td>

                            <td>'.$award->awarding_authority.'</td>

                            <td>';

                                if(strtotime($award->date_received) > 0):

                                    $html .= date('m-d-Y',strtotime($award->date_received));

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>

                            <td>'.$award->location.'</td>

                            <td>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/edit').'/award/'.$award->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                    <i class="fa fa-edit"></i>  Edit </a>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/delete').'/award/'.$award->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                    <i class="fa fa-remove"></i>  Delete </a>

                            </td>

                        </tr>';

                        endforeach;

                    $html .= '</tbody>

                </table>';

        

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        $ajaxDataArray['type'] = 'award';

        return Response::json($ajaxDataArray);

        //return Redirect::to('user-additional-details')->with('message', 'Your account details have been updated.');

    }

    

    /**

     * Save user member organization details

     */

    public function saveUserMemberorganization()

    {

        $user_id = Auth::user()->id;

        if(Input::get('id') != '')

        {

            $member = UserMemberOrganizations::find(Input::get('id'));

            $member->postion = Input::get('postion');

            $member->user_id = $user_id;

            $member->membership_organization = Input::get('membership_organization');

            $member->member_since = Input::get('member_since');

            $member->valid_till = Input::get('valid_till');

            $member->save();

        }

        else

        {

            $member = new UserMemberOrganizations;

            $member->postion = Input::get('postion');

            $member->user_id = $user_id;

            $member->membership_organization = Input::get('membership_organization');

            $member->member_since = Input::get('member_since');

            $member->valid_till = Input::get('valid_till');

            $member->save();

        }

        $members = UserMemberOrganizations::where('user_id',$user_id)->get();

        $html = '';

        $html .= '<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>

                    <tr>

                        <th> Position </th>

                        <th>Membership Organization</th>

                        <th>Member Since</th>

                        <th>Expiration Date</th>

                        <th> Action </th>

                    </tr>

                    </thead>

                    <tbody>';

                        foreach($members as $member):

                        $html .= '<tr>

                            <td>'.$member->postion.'</td>

                            <td>'.$member->membership_organization.'</td>

                            <td>';

                                if(strtotime($member->member_since) > 0):

                                    $html .= date('m-d-Y',strtotime($member->member_since));

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>

                            <td>';

                                if(strtotime($member->valid_till) > 0):

                                    $html .= date('m-d-Y',strtotime($member->valid_till));

                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>

                            <td>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/edit').'/member/'.$member->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                    <i class="fa fa-edit"></i>  Edit </a>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/delete').'/member/'.$member->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                    <i class="fa fa-remove"></i>  Delete </a>

                            </td>

                        </tr>';

                        endforeach;

                    $html .= '</tbody>

                    </table>';

        

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        return Response::json($ajaxDataArray);

        //return Redirect::to('user-additional-details')->with('message', 'Your account details have been updated.');

    }

    

    /**

     * delete user job

     */

    public function deleteUserMemberOrganization($id)

    {

        $member = UserMemberOrganizations::find($id);

        $member->delete();

        

        $members = UserMemberOrganizations::where('user_id',Auth::user()->id)->get();

        $html = '';

        $html .= '<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                    <thead>

                    <tr>

                        <th> Position </th>

                        <th>Membership Organization</th>

                        <th>Member Since</th>

                        <th>Expiration Date</th>

                        <th> Action </th>

                    </tr>

                    </thead>

                    <tbody>';

                        foreach($members as $member):

                        $html .= '<tr>

                            <td>'.$member->postion.'</td>

                            <td>'.$member->membership_organization.'</td>

                            <td>';

                                if(strtotime($member->member_since) > 0):

                                    $html .= date('m-d-Y',strtotime($member->member_since));

                                else:
                                    
                                    $html .= 'N/A';
                                

                                endif;

                            $html .= '</td>

                            <td>';

                                if(strtotime($member->valid_till) > 0):

                                    $html .= date('m-d-Y',strtotime($member->valid_till));
                                else:

                                    $html .= 'N/A';

                                endif;

                            $html .= '</td>

                            <td>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/edit').'/member/'.$member->id.'" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                    <i class="fa fa-edit"></i>  Edit </a>

                                <a href="javascript:void(0)" id="'.url('user/additionaldetails/delete').'/member/'.$member->id.'" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                    <i class="fa fa-remove"></i>  Delete </a>

                            </td>

                        </tr>';

                        endforeach;

                    $html .= '</tbody>

                    </table>';

        

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        $ajaxDataArray['type'] = 'memberorganization';

        return Response::json($ajaxDataArray);

        //return Redirect::to('user-additional-details')->with('message', 'Your account details have been updated.');

    }

    

    /**

     * user picture upload view

     */

    public function addUserPicture()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $userData = UserDetails::where('user_id',$user_id)->first();



        return view('user.pictureUpload')->with(['user'=>$user,'userData'=>$userData]);

    }

    

    /**

     * user company select view

     */

    public function addUserCompany()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $userData = UserDetails::where('user_id',$user_id)->first();

        if($userData->company_id != '')

        {

            $company = Company::find($userData->company_id);

            $userData->company_name = $company->name;

        }

        else

        {

            $userData->company_name = '';

        }

        

        // set wizard track

        $wizardObj = UserWizardTrack::where('user_id',$user_id)->first();

        $wizardObj->wizard_step = 4;

        $wizardObj->save();

        return view('user.companySelect')->with(['user'=>$user,'userData'=>$userData]);

    }

    

    public function ajaxCompanyData($id)

    {
        $claimCompany = 0;
        if($id != 0)

        {

            $company = Company::find($id);

            //explode to split th emaill, as we need to replace lettters from begin to @

            $mail_segments = explode("@", $company->email);

            

            //Then $mail_segments[0] would be 'abcdefg'

            //substr($mail_segments[0],0, 2) - display first 2 letters

            //substr($mail_segments[0],-1 - display last 2 letters

            //str_repeat("*", strlen($mail_segments[0])-3) - rest of letters to *

            $mail_segments[0] = substr($mail_segments[0],0, 1) . str_repeat("*", strlen($mail_segments[0])-1);

            $final_email = implode("@", $mail_segments);


            $user = UserDetails::where('company_id',$id)->first();
            if($user){
                $checkUser = User::find($user->user_id);
                if($checkUser->is_using_temporary_password == 1){
                    $claimCompany = 1;
                }
            }

            $html = '';

            if($claimCompany == 0){
                $html .= '<div class="col-md-12">

                        <h4>Please Verify Company details. Your company selection will require company administrator approval.</h4>

                        <table class="table table-striped table-bordered table-hover table-checkable order-column">

                            <thead>

                                <tr>

                                    <th>Admin Email</th>

                                    <th>Phone</th>

                                    <th>Address</th>

                                    <th>Country</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>'.$final_email.'</td>

                                    <td>'.$company->phone.'</td>

                                    <td style="max-width:300px!important">'.$company->address.' , '.$company->city.', '.$company->state.'-'.$company->zip.'</td>

                                    <td>'.$company->country.'</td>

                                </tr>

                            </tbody>

                        </table>

                    </div>';
            }else{

                if($company->address != '' || $company->city != '' || $company->state != '' || $company->zip != ''){
                    $address = $company->address.' , '.$company->city.', '.$company->state.'-'.$company->zip;
                }else{
                    $address = '-';
                }

                if($company->country != ''){
                    $country = $company->country;
                }else{
                    $country = '-';
                }


                $html .= '<div class="col-md-12">

                        <h4>Please Verify Company details. Your company selection will require company administrator approval.</h4>

                        <table class="table table-striped table-bordered table-hover table-checkable order-column">

                            <thead>

                                <tr>

                                    <th>Company Full Name</th>

                                    <th>Company Domain</th>

                                    <th>Address</th>

                                    <th>Country</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>'.$company->name.'</td>

                                    <td>'.$company->unique_number.'</td>

                                    <td style="max-width:300px!important">'.$address.'</td>

                                    <td>'.$country.'</td>

                                </tr>

                            </tbody>

                        </table>

                    </div>';


            }
        }

        else

        {

            $html = '';

        }

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;
        $ajaxDataArray['claimCompany'] = $claimCompany;
        $ajaxDataArray['companyId'] = $id;
        return Response::json($ajaxDataArray);

    }

    

    /**

     * create new user company

     */

    public function createUserCompany()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $userData = UserDetails::where('user_id',$user_id)->first();

        if($userData->company_id != '')

        {

            $company = Company::find($userData->company_id);

            $userData->company_name = $company->name;

        }

        else

        {

            $userData->company_name = '';

        }

        $countries = AppsCountries::all();

        $languages = AppsLanguages::all();

        $packages = CompanyAccount::all();

        return view('user.companyCreate')->with(['user'=>$user,'userData'=>$userData,'packages'=>$packages,'languages'=>$languages,'countries'=>$countries]);

    }

    

    /**

     * user billing plans view

     */

    public function addUserBillingPlan()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        

        $strip_public_key = env('STRIPE_PUBLIC_KEY', '');

        $userData = UserDetails::where('user_id',$user_id)->first();

        if($userData->company_id != '')

        {

            $company = Company::find($userData->company_id);

            $userData->company_name = $company->name;

        }

        else

        {

            $userData->company_name = '';

        }

        $billingPlans = array();

        if($userData->account_type == 'buyer')

        {

            $billingPlans = SubscriptionPlans::where('plan_type','buyer')->get();    

        }

        elseif($userData->account_type == 'Seller')

        {

            $billingPlans = SubscriptionPlans::where('plan_type','supplier')->get();

        }

        

        // set wizard track

        $wizardObj = UserWizardTrack::where('user_id',$user_id)->first();

        $wizardObj->wizard_step = 5;

        $wizardObj->save();

        

        return view('user.billingPlans')->with(['user'=>$user,'userData'=>$userData,'billingPlans'=>$billingPlans,'strip_public_key'=>$strip_public_key]);

    }

    

    /**

     * Save user Billing Plan

     */

    public function saveUserBillingPlan(Request $request)

    {

        $input = $request->all();

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        

        $card_token = $input['card_token'];

        $strip_key = env('STRIPE_SECRET', '');

        \Stripe\Stripe::setApiKey($strip_key);

        $this->validate($request, [

                'billing_plan' => 'required',

            ]);

        

        

        if($user->stripe_id == '')

        {

            $result = \Stripe\Customer::create(array(

                      "description" => "Customer for ".$user->email,

                      "email"=>$user->email,

                      "source" => $card_token // obtained with Stripe.js

                    ));

            if($result)

            {

                $response =  $result->__toArray(true);

                $user->stripe_id = $response['id'];

                $user->save();

            }

            else

            {

                return Redirect::to('user/billing/plans')->with('message', 'There was a problem with your payment details. Please check and resubmit.');

            }

        }  

        

        $billingPlan = SubscriptionPlans::find($input['billing_plan']);

        

        if($billingPlan->amount > 0)

        {

            $charge = \Stripe\Charge::create(array(

                      "amount" => $billingPlan->amount,

                      "currency" => "usd",

                      "customer" => $user->stripe_id, // obtained with Stripe.js

                      "description" => "Charge for ".$user->email

                    ));    

        }

        else

        {

            $charge = true;

        }

        if($charge)

        {

            if($billingPlan->amount > 0)

            {

                $charges = $charge->__toArray(true);

                $amount_chanrge = $charges['amount'];

                $invoice_id = $charges['invoice'];

                $charge_id = $charges['id'];

                $balance_transaction = $charges['balance_transaction'];

            }

            else

            {

                $amount_chanrge = 0;

                $invoice_id = '';

                $charge_id = '';

                $balance_transaction = '';

            }

            

            $cu = \Stripe\Customer::retrieve($user->stripe_id);

            $subscriptionResult = $cu->subscriptions->create(array("plan" => $billingPlan->plan_key));

            if($subscriptionResult)

            {

                $SubScriptionResponse =  $subscriptionResult->__toArray(true);

            

                $subscription = new Subscriptions;

                $subscription->user_id = $user_id;

                $subscription->name = $SubScriptionResponse['plan']['name'];

                $subscription->amount = $amount_chanrge;

                $subscription->invoice_id = $invoice_id;

                $subscription->charge_id = $charge_id;

                $subscription->balance_transaction = $balance_transaction;

                $subscription->stripe_id = $user->stripe_id;

                $subscription->stripe_plan = $SubScriptionResponse['id'];

                $subscription->quantity = $SubScriptionResponse['quantity'];

                $subscription->trial_ends_at = $SubScriptionResponse['trial_end'];

                $subscription->ends_at = $SubScriptionResponse['ended_at'];

                $subscription->save();

                

                // payment details store

                $paymentDetails = new PaymentDetails;

                $paymentDetails->user_id = $user_id;

                $paymentDetails->payment_type = $input['card_type'];

                $paymentDetails->detail = 'Payment for '.$SubScriptionResponse['plan']['name'];

                $paymentDetails->amount = $amount_chanrge;

                $paymentDetails->card_number = $input['cardNumber'];

                $paymentDetails->card_last_4 = $input['card_last_4'];

                $paymentDetails->expiry = $input['cardExpiry'];

                $paymentDetails->cvv = $input['cardCVC'];

                $paymentDetails->save();

                

                if($billingPlan->amount > 0)

                {

                    $referral = Referrals::whereRaw('referral_to = '.$user_id.' AND paid_referral_by != 1 ')->first();

                    if($referral)

                    {

                        // add amount to referral by user

                        $paind_amount = round($amount_chanrge/2);

                        

                        $referralPayment = new ReferralPayment;

                        $referralPayment->user_id = $referral->referral_by;

                        $referralPayment->referral_user_id = $user_id;

                        $referralPayment->referral_id = $referral->id;

                        $referralPayment->subscription_id = $subscription->id;

                        $referralPayment->amount = $paind_amount;

                        $referralPayment->save();

                        

                        /// set first time amount added;

                        $referral->paid_referral_by = 1;

                        $referral->save();   

                    }

                }

                

                /* payment mail to receiver */

                $receiverData = UserDetails::where('user_id',$user_id)->first();

                $receiver = User::find($user_id);

                

                

                Input::replace(array('email' => $receiver->email,'name'=>$receiverData->first_name.' '.$receiverData->last_name));

                $data = array(

                                'name'=>Input::get('name'),

                                'plan'=>$SubScriptionResponse['plan']['name'],

                                'fees'=>$amount_chanrge,

                                'transaction_id'=>$charge_id,

                                'invoice_id'=>$invoice_id,

                                'invoicr_url'=>url('/user/payment-invoice/').$paymentDetails->id

                                );

                Mail::send('admin.Emailtemplates.sellerPaymentPosted', $data, function($message){

                    $message->from(env('MAIL_USERNAME'), 'Indy John Team');

                    $message->to(Input::get('email'), Input::get('name'))->subject('Your Indy John account payment');

                });

                

                return Redirect::to('user/billing/plans')->with('message', 'Your account status has been changed.');

            }

            

        }

        else

        {

            /* payment mail to receiver */

            $receiverData = UserDetails::where('user_id',$user_id)->first();

            $receiver = User::find($user_id);

            

            

            Input::replace(array('email' => $receiver->email,'name'=>$receiverData->first_name.' '.$receiverData->last_name));

            $data = array(

                            'name'=>Input::get('name'),

                            'plan'=>$billingPlan->name,

                            'fees'=>$billingPlan->amount,

                            'transaction_id'=>'',

                            'invoice_id'=>'',

                            'invoicr_url'=>url('')

                            );

            Mail::send('admin.Emailtemplates.sellerPaymentDeclined', $data, function($message){

                $message->from(env('MAIL_USERNAME'), 'Indy John Team');

                $message->to(Input::get('email'), Input::get('name'))->subject('Your Indy John account payment');

            });

        }

        

        // set wizard track

        $wizardObj = UserWizardTrack::where('user_id',$user_id)->first();

        $wizardObj->wizard_step = 6;

        $wizardObj->save();

        

        return Redirect::to('user/billing/plans')->with('message', 'There was a problem with your credit card details. Please check and resubmit.');

    }

    

    /**

     * user invite view

     */

    public function showUserInvitation()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $userData = UserDetails::where('user_id',$user_id)->first();

        if($userData->company_id != '')

        {

            $company = Company::find($userData->company_id);

            $userData->company_name = $company->name;

        }

        else

        {

            $userData->company_name = '';

        }

        

        // set wizard track

        $wizardObj = UserWizardTrack::where('user_id',$user_id)->first();

        $wizardObj->wizard_step = 6;

        $wizardObj->save();

        

        return view('user.inviteUsers')->with(['user'=>$user,'userData'=>$userData]);

    }

    

    /**

     * General Search View

     */

    public function searchResult()

    {

        $user_id = Auth::user()->id;

        $search = '';

        $searchUserArray = array();

        $searchCompanyArray = array();

        $searchProductArray = array();

        $paginatedSearchResults = '';

        $total = 0;                

        if(isset($_REQUEST['query']))

        {

            if($_REQUEST['query'] != '')

            {

                $search = str_replace('+',' ',$_REQUEST['query']);

                if($search != '')

                {

                    $searchResults = array();

                    // search from User Details

                    $users = UserDetails::whereRaw("(first_name LIKE '%$search%' OR last_name LIKE '%$search%') AND user_id != '$user_id' AND is_active = 1 ")->get();

                    foreach($users as $user)

                    {

                        $userData = User::find($user->user_id);

                        if($user->company_id != '')

                        {

                            $company = Company::find($user->company_id);

                            $userData->company_name = $company->name;

                        }

                        else

                        {

                            $userData->company_name = '';

                        }

                        

                        if($user->account_member == 'gold')

                        {

                            $userData->star = 'gold';

                        }

                        elseif($user->account_member == 'silver')

                        {

                            $userData->star = 'silver';

                        }

                        else

                        {

                            $userData->star = 'none';

                        }

                        

                        $userData->search_type = 'user';

                        $searchResults[] = $userData;

                    }

                    

                    

                    // company search

                    $companies = Company::whereRaw("(name LIKE '%$search%') AND is_active=1 ")->get();

                    foreach($companies as $company)

                    {

                        $company->search_type = 'company';

                        $searchResults[] = $company;

                    }

                    

                    // Product Search

                    

                    $products = MarketplaceProducts::whereRaw("(name LIKE '%$search%') AND is_active=1 ")->get();

                    foreach($products as $product)

                    {

                        $seller_user_id = $product->user_id;

                        $sellerUser = User::find($seller_user_id);

                        if($sellerUser->account_member == 'gold')

                        {

                            $product->star = 'gold';

                        }

                        elseif($sellerUser->account_member == 'silver')

                        {

                            $product->star = 'silver';

                        }

                        else

                        {

                            $product->star = 'none';

                        }

                        $product->seller = $sellerUser;

                        $product->search_type = 'product';

                        $searchResults[] = $product;

                    }

                    

                    // job search

                    

                    $jobs = Jobs::whereRaw("(title LIKE '%$search%' OR job_position_title LIKE '%$search%') AND status = 1 ")->get();

                    foreach($jobs as $job)

                    {

                        $job_user_id = $job->user_id;

                        $jobUser = User::find($job_user_id);

                        if($jobUser->account_member == 'gold')

                        {

                            $job->star = 'gold';

                        }

                        elseif($jobUser->account_member == 'silver')

                        {

                            $job->star = 'silver';

                        }

                        else

                        {

                            $job->star = 'none';

                        }

                        $job->user = $jobUser;

                        $job->search_type = 'job';

                        $searchResults[] = $job;

                    }

                    // Product Search With User


                    $userProducts = MarketplaceProducts::whereRaw("(user_id LIKE '%$search%') AND is_active=1 ")->get();

                    foreach($userProducts as $userProduct)

                    {

                        $seller_user_id = $userProduct->user_id;

                        $sellerUser = User::find($seller_user_id);

                        if($sellerUser->account_member == 'gold')

                        {

                            $userProduct->star = 'gold';

                        }

                        elseif($sellerUser->account_member == 'silver')

                        {

                            $userProduct->star = 'silver';

                        }

                        else

                        {

                            $userProduct->star = 'none';

                        }

                        $userProduct->seller = $sellerUser;

                        $userProduct->search_type = 'product';

                        $searchResults[] = $userProduct;

                    }

                    

                    $page = Input::get('page', 1);

                    $perPage = 15;

                    //Get current page form url e.g. &page=6

                    $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;

            

                    //Create a new Laravel collection from the array data

                    $collection = new Collection($searchResults);

            

                    //Define how many items we want to be visible in each page

                    $perPage = 15;

            

                    //Slice the collection to get the items to display in current page

                    $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();

            

                    //Create our paginator and pass it to the view

                    $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage,$page,['path' => request()->url(), 'query' => request()->query()]);

                    //$paginatedSearchResults->setPath(url().request()->getPathInfo(),'?search=a');

                    $total = count($collection);

                }

            }

            

        }

        

        return view('search.view')->with(['results' => $paginatedSearchResults,'search' => $search,'total'=>$total]);        

    }

    

    /**

     * Companies Search View

     */

    public function searchCompanyResult()

    {

        $user_id = Auth::user()->id;

        $search = '';

        $searchUserArray = array();

        $searchCompanyArray = array();

        $searchProductArray = array();

        $paginatedSearchResults = '';

        $total = 0;

        if(isset($_REQUEST['query']))

        {

            if($_REQUEST['query'] != '')

            {

                $search = str_replace('+',' ',$_REQUEST['query']);

                if($search != '')

                {

                    $searchResults = array();

                    

                    // company search

                    $companies = Company::whereRaw("(name LIKE '%$search%') AND is_active=1 ")->get();

                    foreach($companies as $company)

                    {

                        $company->search_type = 'company';

                        $searchResults[] = $company;

                    }

                    

                    

                    

                    $page = Input::get('page', 1);

                    $perPage = 15;

                    //Get current page form url e.g. &page=6

                    $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;

            

                    //Create a new Laravel collection from the array data

                    $collection = new Collection($searchResults);

            

                    //Define how many items we want to be visible in each page

                    $perPage = 15;

            

                    //Slice the collection to get the items to display in current page

                    $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();

            

                    //Create our paginator and pass it to the view

                    $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage,$page,['path' => request()->url(), 'query' => request()->query()]);

                    //$paginatedSearchResults->setPath(url().request()->getPathInfo(),'?search=a');

                    $total = count($collection);

                }

                            

               //$paginatedSearchResults->setPath(url().request()->getPathInfo(),'?search=a');

                $total = count($collection);

            }

        }

        

        return view('search.companies')->with(['results' => $paginatedSearchResults,'search' => $search,'total'=>$total]);        

    }

    

    /**

     * Peoples Search View

     */

    public function searchPeopleResult()

    {

        $user_id = Auth::user()->id;

        $search = '';

        $searchUserArray = array();

        

        if(isset($_REQUEST['query']))

        {

            $search = str_replace('+',' ',$_REQUEST['query']);

            if($search != '')

            {

                $searchResults = array();

                // search from User Details

                $users = UserDetails::whereRaw("(first_name LIKE '%$search%' OR last_name LIKE '%$search%') AND user_id != '$user_id' AND is_active = 1 ")->get();

                foreach($users as $user)

                {

                    $userData = User::find($user->user_id);

                    if($user->company_id != '')

                    {

                        $company = Company::find($user->company_id);

                        $userData->company_name = $company->name;

                    }

                    else

                    {

                        $userData->company_name = '';

                    }

                    if($user->account_member == 'gold')

                    {

                        $userData->star = 'gold';

                    }

                    elseif($user->account_member == 'silver')

                    {

                        $userData->star = 'silver';

                    }

                    else

                    {

                        $userData->star = 'none';

                    }

                    $userData->search_type = 'user';

                    $searchResults[] = $userData;

                }

                

                

                $page = Input::get('page', 1);

                $perPage = 15;

                //Get current page form url e.g. &page=6

                $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;

        

                //Create a new Laravel collection from the array data

                $collection = new Collection($searchResults);

        

                //Define how many items we want to be visible in each page

                $perPage = 15;

        

                //Slice the collection to get the items to display in current page

                $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();

        

                //Create our paginator and pass it to the view

                $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage,$page,['path' => request()->url(), 'query' => request()->query()]);

                //$paginatedSearchResults->setPath(url().request()->getPathInfo(),'?search=a');

                $total = count($collection);

            }

        }

        

        return view('search.people')->with(['results' => $paginatedSearchResults,'search' => $search,'total'=>$total]);        

    }

    

    /**

     * product Search View

     */

    public function searchProductResult()

    {

        $user_id = Auth::user()->id;

        $search = '';

        $searchProductArray = array();

        if(isset($_REQUEST['query']))

        {

            $search = str_replace('+',' ',$_REQUEST['query']);

            if($search != '')

            {

                $searchResults = array();

                

                // Product Search

                

                $products = MarketplaceProducts::whereRaw("(name LIKE '%$search%') AND is_active=1 ")->get();

                foreach($products as $product)

                {

                    $seller_user_id = $product->user_id;

                    $sellerUser = User::find($seller_user_id);

                    if($sellerUser->account_member == 'gold')

                    {

                        $product->star = 'gold';

                    }

                    elseif($sellerUser->account_member == 'silver')

                    {

                        $product->star = 'silver';

                    }

                    else

                    {

                        $product->star = 'none';

                    }

                    $product->seller = $sellerUser;

                    $product->search_type = 'product';

                    $searchResults[] = $product;

                }

                

                

                $page = Input::get('page', 1);

                $perPage = 15;

                //Get current page form url e.g. &page=6

                $currentPage = LengthAwarePaginator::resolveCurrentPage()-1;

        

                //Create a new Laravel collection from the array data

                $collection = new Collection($searchResults);

        

                //Define how many items we want to be visible in each page

                $perPage = 15;

        

                //Slice the collection to get the items to display in current page

                $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();

        

                //Create our paginator and pass it to the view

                $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage,$page,['path' => request()->url(), 'query' => request()->query()]);

                //$paginatedSearchResults->setPath(url().request()->getPathInfo(),'?search=a');

                $total = count($collection);

            }

        }

        

        return view('search.products')->with(['results' => $paginatedSearchResults,'search' => $search,'total'=>$total]);        

    }

    

    /**

     * user profile complete success page

     */

    public function completeProfile()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        return view('user.complete')->with(['user' => $user]);

    }

    

    /**

     * remove profile picture

     */

    public function removeProfilePicture($id)

    {

        $userDetail = UserDetails::where('user_id',$id)->first();

        $profile_picture = $userDetail->profile_picture;

        if($profile_picture != '')

        {

            File::delete('public/'.$profile_picture);

        }

        

        $userDetail->profile_picture = null;

        $userDetail->save();

        return array("success" => true);

    }

    

    /**

     * select dashboard type

     */

    public function singupDasphboardSelect()

    {

        return view('user.select-dashboard');

    }

    

    public function saveSingupDasphboardSelect()
    {

        $input = Input::all();

        if($input['user_type'] == 3)
        {
            return Redirect::to('dashboard/supplier');
        }
        else
        {
            return Redirect::to('dashboard/buyer');
        }
    }

    

    /**

     * user Account Settings

     */

    public function userAccountSettings()

    {

        $user_id = Auth::user()->id;

        $accountSettings = UserAccountSettings::where('user_id',$user_id)->first();

        if(!$accountSettings)

        {

            $accountSettings = new UserAccountSettings;

            $accountSettings->import_message = 1;

            $accountSettings->new_message = 1;

            $accountSettings->new_quote_lead_syatem = 1;

            $accountSettings->new_job = 1;

            $accountSettings->new_market = 1;

            $accountSettings->profile_in_ij = 1;

            $accountSettings->profile_in_others = 1;

        }

        $user = User::find($user_id);

        $timezonelist = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);

        

        return view('account.settings')->with(['accountsettings' => $accountSettings,'user' => $user,'timezonelist'=>$timezonelist]);

    }

    

    /**

     * save user default account settings

     */

    public function saveAccountDefaultSettings(Request $request)

    {

        $input = $request->all();

        $user_id = Auth::user()->id;

        $input['user_id'] = $user_id;

        

        if(Input::has('import_message')){ $input['import_message'] = 1; } else{ $input['import_message'] = 0; }        

        if(Input::has('new_message')){ $input['new_message'] = 1; } else{ $input['new_message'] = 0; }

        if(Input::has('new_quote_lead_syatem')){ $input['new_quote_lead_syatem'] = 1; } else{ $input['new_quote_lead_syatem'] = 0; }        

        if(Input::has('new_job')){ $input['new_job'] = 1; } else{ $input['new_job'] = 0; }

        if(Input::has('new_market')){ $input['new_market'] = 1; } else{ $input['new_market'] = 0; }        

        if(Input::has('profile_in_ij')){ $input['profile_in_ij'] = 1; } else{ $input['profile_in_ij'] = 0; }

        if(Input::has('profile_in_others')){ $input['profile_in_others'] = 1; } else{ $input['profile_in_others'] = 0; }        

        

        $accountSettings = UserAccountSettings::where('user_id',$user_id)->first();

        if($accountSettings)

        {

            $accountSettings->fill($input)->save();

            return Redirect::back()->with('message', 'Your account settings have been updated.');

        }

        else

        {

            $addAccountSettings = UserAccountSettings::create($input);    

            return Redirect::back()->with('message', 'Your account settings have been updated.');

        }

    }

    

    /**

     * reset urser password

     */

    public function resetUserPassword(Request $request)

    {

        $user_id = Auth::user()->id;

        

        $this->validate($request, [

            'password' => 'required|confirmed|min:6'

        ]);

        $input = $request->all();

        $user = User::find($user_id);

        $user->password = bcrypt($input['password']);

        $user->save();

        

        $data = array('password'=>$input['password'],'name'=>$user->name);

        Input::replace(array('email' => $user->email,'name'=>$user->name));

        Mail::send('admin.Emailtemplates.resetPassword', $data, function($message){

            $message->from(env('MAIL_USERNAME'), 'Indy John Team');

            $message->to(Input::get('email'), Input::get('name'))->subject('Change your Indy John account password.');

        });

        

        return Redirect::back()->with('message', 'You have successfully changed your password.');

    }

    

    public function clearSessionKey($key)
    {

        Session::forget('new_user_first');

    }

    public function clearSessionPulsate()
    {

        $session = Session::get('pulsate');

        Session::forget('pulsate');

        return Response::json($session);

    }

    /**
     * saved contacts
     */
    public function viewContactUser()
    {
        $savedContacts = ContactSave::paginate(15);
        foreach($savedContacts as $savedContact)
        {
            $sender_id = $savedContact->sender_user_id;
            $senderData = User::find($sender_id);
            $savedContact->senderName = $senderData->name;
            if($senderData->userdetail->company_id != '')
            {
                $company = Company::find($senderData->userdetail->company_id);
                $savedContact->sender_company_name = $company->name;
            }
            else
            {
                $savedContact->sender_company_name = '';
            }
            $receiver_id = $savedContact->request_user_id;
            $receiverData = User::find($receiver_id);
            $savedContact->receiverName = $receiverData->name;

            if($receiverData->userdetail->company_id != '')
            {
                $company = Company::find($receiverData->userdetail->company_id);
                $savedContact->receiver_company_name = $company->name;
            }
            else
            {
                $savedContact->receiver_company_name = '';
            }
        }
        return view('users.savedContacts')->with([
            'savedContacts'=>$savedContacts,
        ]);
    }

    /**
     * user products
     */
    public function viewUserProducts()
    {
        $users = User::paginate(15);
        $userProductsArray = array();
        foreach($users as $user){
            $userArray = array();
            $userArray['user_name'] = $user->name;
            $userProducts = MarketplaceProducts::where('user_id',$user->id)->get()->toArray();
            if(!empty($userProducts)){
                foreach($userProducts as $product){
                    $dataArray = array();
                    $dataArray['product_name'] = $product['name'];

                    $userArray['userProducts'][] = $dataArray;
                }
            }else{

                $userArray['userProducts'] = array();
            }

            $userProductsArray[] = $userArray;
        }
        //echo"<pre>"; print_r($userProductsArray); exit(0);
        $previousPageUrl = $users->previousPageUrl();//previous page url

        $nextPageUrl = $users->nextPageUrl();//next page url

        $lastPage = $users->lastPage(); //Gives last page number

        $total = $users->total();

        return view('admin.users.viewProducts')->with(['users'=>$users,'userProductsArray'=>$userProductsArray,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);

    }
}

?>
