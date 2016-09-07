<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyUsers;
use App\EmailTemplates;
use App\User;
use App\UserDetails;
use App\UsersActivity;
use App\UserUnique;
use App\AppsLanguages;
use App\AppsCountries;
use App\CompanyAccount;
use App\MarketplaceProducts;
use App\MarketplaceProductGallery;
use App\UserWizardTrack;
use App\Accreditation;
use App\CompanyAccreditation;
use App\Category;
use App\CompanyCategories;
use App\TechService;
use App\CompanyTechServices;
use App\CompanyTypeMapping;
use App\CompanyTypes;
use App\QualityStandards;
use App\CompanyQualityStandards;
use App\Markets;
use App\CompanyMarkets;
use App\CompanyAdmin;
use App\CompanyCertifications;
use App\ShippingPreference;
use App\CompanyShippingPreference;
use App\Industry;
use App\Currencies;
use App\CompanyIndustries;
use App\SubscriptionPlans;
use App\Subscriptions;
use App\PaymentDetails;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Input;
use Response;
use Auth;
use Mail;
use File;
use Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating company

        $companies = Company::orderBy('id','desc')->paginate(15);
        $previousPageUrl = $companies->previousPageUrl();//previous page url
        $nextPageUrl = $companies->nextPageUrl();//next page url
        $lastPage = $companies->lastPage(); //Gives last page number
        $total = $companies->total();
        return view('admin.Company.index')->with(['companies'=>$companies,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Output create view.
        $packages = CompanyAccount::all();
        $languages = AppsLanguages::all();
        $countries = AppsCountries::all();
        
        return view('admin.Company.create')->with([
                                                    'packages'=>$packages,
                                                    'languages'=>$languages,
                                                    'countries'=>$countries
                                                ]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //Validations
        $input = $request->all();
        if(array_key_exists('first_time',$input))
        {
            $this->validate($request, [
                    'name' => 'required',
                    'phone' => 'required',
                    'email' => 'required|email|unique:company_profile|unique:users',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required'
                ]);
        }
        else
        {
            if($input['account_id'] == 1){
                $this->validate($request, [
                    'name' => 'required',
                    'account_id' => 'required',
                    'phone' => 'required',
                    'email' => 'required|email|unique:company_profile|unique:users',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required'
                ]);
            }else{
                $this->validate($request, [
                    'name' => 'required',
                    'account_id' => 'required',
                    'phone' => 'required',
                    'email' => 'required|email|unique:company_profile|unique:users',
                    'address' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'zip' => 'required',
                    'country' => 'required'
                ]);
            }
        }
        
        // for user unique number
        $unique = UserUnique::first();
        $next = $unique->number+1;
        $unique->number = $next;
        $unique->save();
        
        $unique_number = 'IJU-'.$next;
        
        $input['external_url'] = $this->seo_friendly_url($input['name']).'-'.$unique_number;
        
        $password = $this->randomPassword();
        //$password = '123456';
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($password),
            'access_level' => 4,
            'email_verify' => 1,
            'unique_number' => $unique_number
        ]);
        
        $input['user_id'] = $user->id;
        
        if(Input::has('owner_id'))
        {
            $input['owner_id'] = $input['owner_id'];    
        }
        else
        {
            $input['owner_id'] = null;
        }
        
        $input['is_Active'] = 1;
        $input['license_used'] = 0;
        $input["unique_company_url"] = null;
        $input["customer_care_email"] = null;
        
        if($input['account_id'] != 1){
            $input['subscription_start_date'] = date("Y-m-d");
            if($input['subscription_type'] == "monthly"){
                $input['subscription_end_date'] = date('Y-m-d', strtotime("+1 months", strtotime(date("Y-m-d"))));
            }else{
                $input['subscription_end_date'] = date('Y-m-d', strtotime("+12 months", strtotime(date("Y-m-d"))));
            }
        }
        
        $input['unique_number'] = $unique_number;
        
        $company = Company::create($input);
        
        // company industries
        if(Input::has('company_industries')){
            //first of all delete existing rows and create new one.
            CompanyIndustries::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_industries') as $acc){
                $industry = new CompanyIndustries();
                $industry->company_id = $company->id;
                $industry->industry_id = $acc;
                $industry->save();
            }
        }
        
        // company type
        if(Input::has('company_types'))
        {
            //first of all delete existing rows and create new one.
            CompanyTypeMapping::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_types') as $type){
                $preference = new CompanyTypeMapping();
                $preference->company_id = $company->id;
                $preference->company_type_id = $type;
                $preference->save();
            }
        }
        
        // company Category
        if(Input::has('company_categories'))
        {
            //first of all delete existing rows and create new one.
            CompanyCategories::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_categories') as $acc){
                $companyCat = new CompanyCategories();
                $companyCat->company_id = $company->id;
                $companyCat->category_id = $acc;
                $companyCat->save();
            }
        }
        
        // company Technical Services
        if(Input::has('company_techservice'))
        {
            //first of all delete existing rows and create new one.
            CompanyTechServices::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_techservice') as $acc){
                $companyService = new CompanyTechServices();
                $companyService->company_id = $company->id;
                $companyService->technical_service_id = $acc;
                $companyService->save();
            }
        }
        
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $userObj = UserDetails::where('user_id',$user_id)->first();
        
        if($user->access_level == 2 || $user->access_level == 3)
        {
            /// If compnay changed than request send to compnay for accept
            $userCompanyObj = CompanyUsers::where('user_id',$user_id)->first();
            if($userCompanyObj)
            {
                $userCompanyObj->delete();
            }
            $CompanyUsers = new CompanyUsers;
            $CompanyUsers->company_id = $company->id;
            $CompanyUsers->user_id = $user_id;
            $CompanyUsers->status = 0;
            $CompanyUsers->save();    
        }
        
        /// User Activity for message
        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'You updated your company to '.$company->name.'.';
        $usersActivity->activity_id = $company->id;
        $usersActivity->activity_type = 'company';
        $usersActivity->creater_id = $user_id;
        $usersActivity->receiver_id = null;
        $usersActivity->save();
        
        $data = array('name'=>$input['name'],'email'=>$input['email'],'password'=>$password);
        Mail::send('admin.Emailtemplates.emailTemplate', $data, function($message){
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to(Input::get('email'), Input::get('name'))->subject('Account details have been changed');
        });
        
        if(Input::has('first_time'))
        {
            // set wizard track
            $wizardObj = UserWizardTrack::where('user_id',$user_id)->first();
            $wizardObj->wizard_step = 5;
            $wizardObj->save();
            
            return Redirect::to('user/billing/plans');
        }
        else
        {
            if($input['formtype'] == 'additional')
            {
                if(Input::has('profile_first_time'))
                {
                    return Redirect::to('company/admin/'.$company->id.'?setup=profile')->with('message', 'Your company details have been changed.');
                }
                else
                {
                    return Redirect::to('company/admin/'.$company->id)->with('message', 'Your company details have been changed.');   
                }
            }
            else
            {
                return Redirect::to('company/profile/'.$company->id)->with('message', 'Your company details have been changed.'); 
            }
                
        }
        
    }
    
    /**
     * company additional view
     */
    
    public function additionalCompanyView($id)
    {
        $company = Company::find($id);
        $companyArray = $company->toArray();
        $company->rAndD = $companyArray['r&d_capacity'];
        $languages = AppsLanguages::all();
        
        $industries = Industry::all();
        $companyTypes = CompanyTypes::all();
        $techServices = TechService::all();
        
        // selected industry
        $selectedIndustry = array();
        foreach ($company->industries as $industry)
        {
            $selectedIndustry[] = $industry->industry->id;    
        }
        
        // selected company type
        $selectedCompanyType = array();
        foreach($company->types as $type)
        {
            $selectedCompanyType[] = $type->type->id;    
        }
        
        //selected Technical services
        $selectedCompanyTech = array();
        foreach($company->techServices as $techService)
        {
            $selectedCompanyTech[] = $techService->techService->id;    
        }
        
        if($company->accepted_payment_type != '')
        {
            $accepted_payment_types = explode(',',$company->accepted_payment_type);   
        }
        else
        {
            $accepted_payment_types = array();
        }
        
        $payment_acceptes = [
                                array('id'=>1,'name'=>'Credit Cards'),
                                array('id'=>2,'name'=>'Bank Transfer'),
                                array('id'=>3,'name'=>'Online Payments/Paypal'),
                                array('id'=>4,'name'=>'Cheque'),
                                array('id'=>5,'name'=>'COD'),
                                array('id'=>6,'name'=>'Other')
                            ];
        
        $payment_currencies = Currencies::all(); 
        
        if($company->accepted_payment_currency != '')
        {
            $accepted_payment_currency = explode(',',$company->accepted_payment_currency);   
        }
        else
        {
            $accepted_payment_currency = array();
        }
        
        
        return view('admin.Company.additional')->with([
                                                    'company'=>$company,
                                                    'languages'=>$languages,
                                                    'payment_acceptes'=>$payment_acceptes,
                                                    'accepted_payment_types'=>$accepted_payment_types,
                                                    'payment_currencies'=>$payment_currencies,
                                                    'accepted_payment_currency'=>$accepted_payment_currency,
                                                    'industries'=>$industries,
                                                    'selectedIndustry'=>$selectedIndustry,
                                                    'companyTypes'=>$companyTypes,
                                                    'selectedCompanyType'=>$selectedCompanyType,
                                                    'techServices'=>$techServices,
                                                    'selectedCompanyTech'=>$selectedCompanyTech
                                                ]);
    }
    
    /**
     * Save company certification details
     */
    public function saveCompanyCertification()
    {
        if(Input::get('id') != '')
        {
            $certification = CompanyCertifications::find(Input::get('id'));
            $certification->certification_name = Input::get('certification_name');
            $certification->company_id = Input::get('company_id');
            $certification->certifying_authority = Input::get('certifying_authority');
            $certification->date_received = Input::get('date_received');
            $certification->valid_till = Input::get('valid_till');
            $certification->save();
        }
        else
        {
            $certification = new CompanyCertifications;
            $certification->certification_name = Input::get('certification_name');
            $certification->company_id = Input::get('company_id');
            $certification->certifying_authority = Input::get('certifying_authority');
            $certification->date_received = Input::get('date_received');
            $certification->valid_till = Input::get('valid_till');
            $certification->save();
        }
        return Redirect::to('company/additional/'.Input::get('company_id'))->with('message', 'Your details have been changed.');
    }
    
    /**
     * Edit Company Certification view
     */
    public function editCompanyCertification($id)
    {
        $certification = CompanyCertifications::find($id);
        $html = '';
        $html .= '<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Edit '.$certification->certification_name.'</h4>
                </div>
                <form action="'.url("company/certification/save").'" method="post" class="horizontal-form">
                <input type="hidden" name="_token" value="'.csrf_token().'" />
                <input type="hidden" name="id" value="'.$id.'" />
                <input type="hidden" name="company_id" value="'.$certification->company_id.'" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="col-md-6">
                                <label class="control-label">Name Of Accreditation:</label>
                				<input type="text" class="form-control" name="certification_name" value="'.$certification->certification_name.'" placeholder="Name Of Accreditation">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Issuing Authority:</label>
                				<input type="text" class="form-control" name="certifying_authority" value="'.$certification->certifying_authority.'" placeholder="Issuing Authority">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="col-md-6">
                                <label class="control-label">Date Received:</label>
                                <div class="">
                                    <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" value="'.$certification->date_received.'" name="date_received">
                                        <span class="input-group-btn">
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
                                    <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" value="'.$certification->valid_till.'" name="valid_till">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>  
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="submite" class="btn blue">Save</button>
                </div>
            </form>';
        $ajaxDataArray = array();
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }
    
    /**
     * Confirm pop up for delete
     */
    public function confirmDeleteCompanyCertification($id)
    {
        $certification = CompanyCertifications::find($id);
        $html = '';
        $html .= '<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            Are you want to delete '.$certification->certification_name.'?
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <a href="'.url('company/certification/delete').'/'.$id.'" class="btn blue">Confirm</button>
                </div>';
        $ajaxDataArray = array();
        $ajaxDataArray['html'] = $html;
        return Response::json($ajaxDataArray);
    }
    
    /**
     * Delete Company Certification
     */
    public function deleteCompanyCertification($id)
    {
        $certification = CompanyCertifications::find($id);
        $company_id = $certification->company_id;
        $certification->delete();
        return Redirect::to('company/additional/'.$company_id)->with('message', 'Your company details have been changed.');
    }
    
    /**
     * Company Additional Detail save
     */
    public function saveAdditionalCompany()
    {
        $input = Input::all();
        $company = Company::find($input['company_id']);
        /// Payment type
        $payment_type = '';
        if(Input::has('accepted_payment_type'))
        {
            $pay_cnt = 0;
            foreach(input::get('accepted_payment_type') as $pay_type)
            {
                $pay_cnt++;
                if($pay_cnt == 1)
                {
                    $payment_type = $pay_type;
                }
                else
                {
                    $payment_type .= ','.$pay_type;
                }
            }
        }
        $input['accepted_payment_type'] = $payment_type;
        
        /// payment accept currency
        $payment_currency = '';
        if(Input::has('accepted_payment_currency'))
        {
            $cur_cnt = 0;
            foreach(input::get('accepted_payment_currency') as $pay_currency)
            {
                $cur_cnt++;
                if($cur_cnt == 1)
                {
                    $payment_currency = $pay_currency;
                }
                else
                {
                    $payment_currency .= ','.$pay_currency;
                }
            }
        }
        $input['accepted_payment_currency'] = $payment_currency;
        $company->fill($input)->save();
        
        // company industries
        if(Input::has('company_industries')){
            //first of all delete existing rows and create new one.
            CompanyIndustries::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_industries') as $acc){
                $industry = new CompanyIndustries();
                $industry->company_id = $company->id;
                $industry->industry_id = $acc;
                $industry->save();
            }
        }
        
        // company type
        if(Input::has('company_types'))
        {
            //first of all delete existing rows and create new one.
            CompanyTypeMapping::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_types') as $type){
                $preference = new CompanyTypeMapping();
                $preference->company_id = $company->id;
                $preference->company_type_id = $type;
                $preference->save();
            }
        }
        
        // company Category
        if(Input::has('company_categories'))
        {
            //first of all delete existing rows and create new one.
            CompanyCategories::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_categories') as $acc){
                $companyCat = new CompanyCategories();
                $companyCat->company_id = $company->id;
                $companyCat->category_id = $acc;
                $companyCat->save();
            }
        }
        
        // company Technical Services
        if(Input::has('company_techservice'))
        {
            //first of all delete existing rows and create new one.
            CompanyTechServices::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_techservice') as $acc){
                $companyService = new CompanyTechServices();
                $companyService->company_id = $company->id;
                $companyService->technical_service_id = $acc;
                $companyService->save();
            }
        }
        if(Input::has('profile_first_time'))
        {
            return Redirect::to('companies/gallery/add/'.$company->id.'?setup=profile');
        }
        else
        {
            return Redirect::to('companies/gallery/add/'.$company->id);    
        }
    }
    
    /**
     * Company Admin View
     */
    public function companyAdminView($id)
    {
        $company = Company::find($id);
        if($company->owner_id != '')
        {
            $user_id = $company->owner_id;
            $company->user = User::find($user_id);
        }
        else
        {
            $company->user = '';
        }
        return view('admin.Company.administrator')->with(['company'=>$company,]);
    }
    
    /**
     * Passowrd generate
     */
    public function randomCompanyCode() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 10; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
    
    /**
     * Save Company Admin
     */
    public function saveCompanyAdmin(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'company_owner' => 'required',
        ]);
        if($input['company_owner'] == 0)
        {
            $this->validate($request, [
                'admin_email' => 'required|email',
            ]);    
        }
        $company = Company::find($input['company_id']);
        if($input['company_owner'] == 1)
        {
            $user_id = Auth::user()->id;
            $company->owner_id = $user_id;
            $company->save();
            
            $userDetail = UserDetails::where('user_id',$user_id)->first();
            $userDetail->company_id = $company->id;
            $userDetail->save();
            
            if(Input::has('profile_first_time'))
            {
                return Redirect::to('company/additional/'.$company->id.'?setup=profile');
            }
            else
            {
                return Redirect::to('company/additional/'.$company->id);   
            }
        }
        else
        {
            $code = $this->randomCompanyCode();
            $checkAlreadyAdmin = CompanyAdmin::where('company_id',$company->id)->first();
            if($checkAlreadyAdmin)
            {
                $checkAlreadyAdmin->delete();
            }
            $companyAdmin = new CompanyAdmin;
            $companyAdmin->email = $input['admin_email'];
            $companyAdmin->unique_code = $code;
            $companyAdmin->company_id = $company->id;
            $companyAdmin->status = 0;
            $companyAdmin->save();
            
            $url = url().'?company_code='.$code;
            $email = $input['admin_email'];
            //$email = 'chauhan.gordhan@gmail.com';
            $user_id = Auth::user()->id;
            $userData = UserDetails::where('user_id',$user_id)->first();
            $loginUserName = $userData->first_name.' '.$userData->last_name;

            $data = array('name'=>'company admin','email'=>$email,'url'=>$url,'company'=>$company,'loginUserName'=>$loginUserName);
            Input::replace(array('email' => $email,'name'=>'company admin'));
            Mail::send('admin.Emailtemplates.companyAdmin', $data, function($message){
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), Input::get('name'))->subject('Indy John Company Admin details');
            });
        }
        if(Input::has('profile_first_time'))
        {
            return Redirect::to('profile/select-dashboard');
        }
        else
        {
            return Redirect::to('user-dashboard?setup=company_admin')->with('message', 'You have designated a company administrator.');   
        }
         
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show Company Information
        $company = Company::find($id);
        
        if($company->owner_id != '')
        {
            $userData = UserDetails::where('user_id',$company->owner_id)->first();
            if($userData)
            {
                $company->owner_name = $userData->first_name.' '.$userData->last_name;    
            }
            else
            {
                $company->owner_name = '';
            } 
        }
        else
        {
            $company->owner_name = '';
        }
        
        return view('admin.Company.view')->with(['company'=>$company]);
    }
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $checkIfOwner = Company::find($id);
        if($checkIfOwner->owner_id != $user_id)
        {
            return Redirect::to('not-authorized');
        }

        $user = User::find($user_id);

        if($user->access_level == 2 || $user->access_level == 3)
        {
            $company_id = $user->userdetail->company_id;
            $userCompany = Company::find($company_id);
            /*if($user->id != $userCompany->owner_id)
            {
                return Redirect::to('not-authorized');
            }*/
        }
        elseif($user->access_level == 4)
        {
            $company_id = $user->companydetail->id;
        }
        /*if($company_id != $id)
        {
            return Redirect::to('not-authorized');
        }*/
        //Edit company information.
        $company = Company::find($id);
        $packages = CompanyAccount::all();
        $languages = AppsLanguages::all();
        $countries = AppsCountries::all();
        $packages = CompanyAccount::all();
        $languages = AppsLanguages::all();
        $countries = AppsCountries::all();
        $industries = Industry::all();
        $companyTypes = CompanyTypes::all();
        $techServices = TechService::all();

        // selected industry
        $selectedIndustry = array();
        foreach ($company->industries as $industry)
        {
            $selectedIndustry[] = $industry->industry->id;
        }

        // selected company type
        $selectedCompanyType = array();
        foreach($company->types as $type)
        {
            $selectedCompanyType[] = $type->type->id;
        }

        //selected Technical services
        $selectedCompanyTech = array();
        foreach($company->techServices as $techService)
        {
            $selectedCompanyTech[] = $techService->techService->id;
        }

        if($company->owner_id != '')
        {
            $userData = UserDetails::where('user_id',$company->owner_id)->first();
            if($userData)
            {
                $company->owner_name = $userData->first_name.' '.$userData->last_name;
            }
            else
            {
                $company->owner_name = '';
            }
        }
        else
        {
            $company->owner_name = '';
        }

        $selectedLanguageArray = array();
        if($company->languages != '')
        {
            $allLanguages = explode(',',$company->languages);
            foreach($allLanguages as $language)
            {
                $selectedLanguageArray[] = $language;
            }
        }

        return view('admin.Company.edit')->with([
                                                'company'=>$company,
                                                'packages'=>$packages,
                                                'languages'=>$languages,
                                                'countries'=>$countries,
                                                'selectedLanguage'=>$selectedLanguageArray,
                                                'industries'=>$industries,
                                                'selectedIndustry'=>$selectedIndustry,
                                                'companyTypes'=>$companyTypes,
                                                'selectedCompanyType'=>$selectedCompanyType,
                                                'techServices'=>$techServices,
                                                'selectedCompanyTech'=>$selectedCompanyTech
                                                ]);
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
        //Updating Company
        $company = Company::findOrFail($id);

        //Validations
        $input = $request->all();
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);
        
        /// check user acreated or not
        $userObj = User::where('email',$input['email'])->first();
        if($userObj)
        {
            $userObj->name = $input['name'];
            $userObj->email = $input['email'];
            $userObj->save();
            $input['user_id'] = $userObj->id;
        }
        else
        {
            $password = $this->randomPassword();
            //$password = '123456';
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt($password),
                'access_level' => 4,
                'email_verify' => 1,
            ]);
            $input['user_id'] = $user->id;
            $data = array('name'=>$input['name'],'email'=>$input['email'],'password'=>$password);
            Mail::send('admin.Emailtemplates.emailTemplate', $data, function($message){
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), Input::get('name'))->subject('Indy John account update');
            });
            
        }
        
        
        
        $languages = '';
        if(Input::has('languages'))
        {
            foreach($input['languages'] as  $index=>$language)
            {
                if($index == 0)
                {
                    $languages = $language;
                }
                else
                {
                    $languages .= ','.$language;
                }
            }
        }
        $input['languages'] = $languages;
        
        ///////////////
        $company->fill($input)->save();
        
        // company industries
        if(Input::has('company_industries')){
            //first of all delete existing rows and create new one.
            CompanyIndustries::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_industries') as $acc){
                $industry = new CompanyIndustries();
                $industry->company_id = $company->id;
                $industry->industry_id = $acc;
                $industry->save();
            }
        }
        
        // company type
        if(Input::has('company_types'))
        {
            //first of all delete existing rows and create new one.
            CompanyTypeMapping::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_types') as $type){
                $preference = new CompanyTypeMapping();
                $preference->company_id = $company->id;
                $preference->company_type_id = $type;
                $preference->save();
            }
        }
        
        // company Category
        if(Input::has('company_categories'))
        {
            //first of all delete existing rows and create new one.
            CompanyCategories::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_categories') as $acc){
                $companyCat = new CompanyCategories();
                $companyCat->company_id = $company->id;
                $companyCat->category_id = $acc;
                $companyCat->save();
            }
        }
        
        // company Technical Services
        if(Input::has('company_techservice'))
        {
            //first of all delete existing rows and create new one.
            CompanyTechServices::whereRaw("company_id = ? ",array($company->id))->delete();
    
            foreach(Input::get('company_techservice') as $acc){
                $companyService = new CompanyTechServices();
                $companyService->company_id = $company->id;
                $companyService->technical_service_id = $acc;
                $companyService->save();
            }
        }
        
        
        // redirect to index page
        
        if($input['formtype'] == 'additional')
        {
            if(Input::has('profile_first_time'))
            {
                return Redirect::to('company/additional/'.$company->id.'?setup=profile')->with('message', 'Your company details have been changed.');
            }
            else
            {
                return Redirect::to('company/additional/'.$company->id)->with('message', 'Your company details have been changed.');
            }
        }
        else
        {
            $user_id = Auth::user()->id;
            $user_access_level = Auth::user()->access_level;
            if($user_access_level != 1)
            {
                $userObj = UserDetails::where('user_id',$user_id)->first();
                if($userObj)
                {
                    $company_id = $userObj->company_id;
                    return Redirect::to('company/admin/'.$company_id)->with('message', 'Your details have been changed.');  
                }
                
            }
            if(Input::has('profile_first_time'))
            {
                return Redirect::to('profile/select-dashboard'); 
            }
            else
            {
                return Redirect::to('company/admin/'.$company->id)->with('message', 'Your details have been changed.');
            }
               
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
        //Delete Category
        $company = Company::find($id);
        $company->delete();
        return Redirect::to('companies')->with('message', 'Your company details have been changed.');
    }
    
    /** user search for company owner
     */
    public function ownerSearch()
    {
        if(isset($_GET['q']))
        {
            $search = $_GET['q'];
            $users = UserDetails::whereRaw("(first_name LIKE '%$search%' OR first_name LIKE '%$search%') AND is_active = 1 ")->get();
            $usersArray = array();
            foreach($users as $user)
            {
                $dataArray = array();
                $dataArray['id'] = $user->user_id;
                $dataArray['full_name'] = $user->first_name.' '.$user->last_name;
                $usersArray[] = $dataArray;
            }
        }
        else
        {
            $usersArray = array();
        }
        
        $ajaxArray = array();
        $ajaxArray['incomplete_results'] = false;
        $ajaxArray['items'] = $usersArray;
        return Response::json($ajaxArray);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function companyAdditionalInfo($id){
        $company = Company::find($id);
        return view('admin.Company.AdditionalInfo.index')->with(['company'=>$company]);
    }

    /**
     * Add more company accredations
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCompanyAccreditation($id){
        $company = Company::find($id);
        $current = $company->accreditations()->get(array('accreditations_id'))->toArray();
        $result = array();
        foreach($current as $value){
            $result[] = $value["accreditations_id"];
        }
        $accreditations = Accreditation::whereNotIn("id",$result)->get();
        return view('admin.Company.AdditionalInfo.Accreditations.create')->with(['company'=>$company,'accreditations'=>$accreditations]);
    }

    /**
     * Save more company accredations
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCompanyAccreditation(){
        $company = Company::find(Input::get('company_id'));

        //first of all delete existing rows and create new one.
        CompanyAccreditation::whereRaw("company_id = ? ",array($company->id))->delete();

        foreach(Input::get('company_accreditations') as $acc){
            $companyAcc = new CompanyAccreditation();
            $companyAcc->company_id = $company->id;
            $companyAcc->accreditations_id = $acc;
            $companyAcc->save();
        }
        return Redirect::to('companies/info/'.$company->id)->with('message', 'Your company details have been changed.');
    }

    /**
     * Add more company categories
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCompanyCategory($id){
        $company = Company::find($id);
        $current = $company->categories()->get(array('category_id'))->toArray();
        $result = array();
        foreach($current as $value){
            $result[] = $value["category_id"];
        }
        $categories = Category::whereNotIn("id",$result)->get();
        return view('admin.Company.AdditionalInfo.Category.create')->with(['company'=>$company,'categories'=>$categories]);
    }
    
    /**
     * Search Category for add in compnay
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
     * Save more company categories
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCompanyCategory(){
        $company = Company::find(Input::get('company_id'));

        //first of all delete existing rows and create new one.
        CompanyCategories::whereRaw("company_id = ? ",array($company->id))->delete();

        foreach(Input::get('company_categories') as $acc){
            $companyCat = new CompanyCategories();
            $companyCat->company_id = $company->id;
            $companyCat->category_id = $acc;
            $companyCat->save();
        }
        return Redirect::to('companies/info/'.$company->id)->with('message', 'Your company details have been changed.');
    }

    /**
     * Add more company tech services
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCompanyServices($id){
        $company = Company::find($id);
        $current = $company->techServices()->get(array('technical_service_id'))->toArray();
        $result = array();
        foreach($current as $value){
            $result[] = $value["technical_service_id"];
        }
        $techServices = TechService::whereNotIn("id",$result)->get();
        return view('admin.Company.AdditionalInfo.Services.create')->with(['company'=>$company,'techServices'=>$techServices]);
    }

    /**
     * Save more company tech services
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCompanyServices(){
        $company = Company::find(Input::get('company_id'));

        //first of all delete existing rows and create new one.
        CompanyTechServices::whereRaw("company_id = ? ",array($company->id))->delete();

        foreach(Input::get('company_services') as $acc){
            $companyService = new CompanyTechServices();
            $companyService->company_id = $company->id;
            $companyService->technical_service_id = $acc;
            $companyService->save();
        }
        return Redirect::to('companies/info/'.$company->id)->with('message', 'Your company details have been changed.');
    }

    /**
     * Add more company quality standards
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCompanyQualityStandards($id){
        $company = Company::find($id);
        $current = $company->qualityStandards()->get(array('quality_standards_id'))->toArray();
        $result = array();
        foreach($current as $value){
            $result[] = $value["quality_standards_id"];
        }
        $qualityStandards = QualityStandards::whereNotIn("id",$result)->get();
        return view('admin.Company.AdditionalInfo.QualityStandards.create')->with(['company'=>$company,'qualityStandards'=>$qualityStandards]);
    }

    /**
     * Save more company quality standards
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCompanyQualityStandards(){
        $company = Company::find(Input::get('company_id'));

        //first of all delete existing rows and create new one.
        CompanyQualityStandards::whereRaw("company_id = ? ",array($company->id))->delete();

        foreach(Input::get('quality_standards') as $acc){
            $standard = new CompanyQualityStandards();
            $standard->company_id = $company->id;
            $standard->quality_standards_id = $acc;
            $standard->save();
        }
        return Redirect::to('companies/info/'.$company->id)->with('message', 'Your company details have been changed.');
    }

    /**
     * Add more company industry
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCompanyIndustries($id){
        $company = Company::find($id);
        $current = $company->industries()->get(array('industry_id'))->toArray();
        $result = array();
        foreach($current as $value){
            $result[] = $value["industry_id"];
        }
        $industries = Industry::whereNotIn("id",$result)->get();
        return view('admin.Company.AdditionalInfo.Industry.create')->with(['company'=>$company,'industries'=>$industries]);
    }

    /**
     * Save more company industries
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCompanyIndustries(){
        $company = Company::find(Input::get('company_id'));

        //first of all delete existing rows and create new one.
        CompanyIndustries::whereRaw("company_id = ? ",array($company->id))->delete();

        foreach(Input::get('company_industries') as $acc){
            $industry = new CompanyIndustries();
            $industry->company_id = $company->id;
            $industry->industry_id = $acc;
            $industry->save();
        }
        return Redirect::to('companies/info/'.$company->id)->with('message', 'Your company details have been changed.');
    }

    /**
     * Add more company markets
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCompanyMarkets($id){
        $company = Company::find($id);
        $current = $company->markets()->get(array('main_markets_id'))->toArray();
        $result = array();
        foreach($current as $value){
            $result[] = $value["main_markets_id"];
        }
        $markets = Markets::whereNotIn("id",$result)->get();
        return view('admin.Company.AdditionalInfo.Markets.create')->with(['company'=>$company,'markets'=>$markets]);
    }

    /**
     * Save more company markets
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCompanyMarkets(){
        $company = Company::find(Input::get('company_id'));

        //first of all delete existing rows and create new one.
        CompanyMarkets::whereRaw("company_id = ? ",array($company->id))->delete();

        foreach(Input::get('company_markets') as $acc){
            $market = new CompanyMarkets();
            $market->company_id = $company->id;
            $market->main_markets_id = $acc;
            $market->save();
        }
        return Redirect::to('companies/info/'.$company->id)->with('message', 'Your company details have been changed.');
    }

    /**
     * Add more company shipping preferences
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCompanyShippingPreferences($id){
        $company = Company::find($id);
        $current = $company->shippingPreferences()->get(array('shipping_preference_id'))->toArray();
        $result = array();
        foreach($current as $value){
            $result[] = $value["shipping_preference_id"];
        }
        $shippingPreferences = ShippingPreference::whereNotIn("id",$result)->get();
        return view('admin.Company.AdditionalInfo.ShippingPreference.create')->with(['company'=>$company,'shippingPreferences'=>$shippingPreferences]);
    }

    /**
     * Save more company markets
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCompanyShippingPreferences(){
        $company = Company::find(Input::get('company_id'));

        //first of all delete existing rows and create new one.
        CompanyShippingPreference::whereRaw("company_id = ? ",array($company->id))->delete();

        foreach(Input::get('shipping_preferences') as $acc){
            $preference = new CompanyShippingPreference();
            $preference->company_id = $company->id;
            $preference->shipping_preference_id = $acc;
            $preference->save();
        }
        return Redirect::to('companies/info/'.$company->id)->with('message', 'Your company details have been changed.');
    }
    
    /**
     * Add more company types
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addCompanyTypes($id){
        $company = Company::find($id);
        $current = $company->types()->get(array('company_type_id'))->toArray();
        $result = array();
        foreach($current as $value){
            $result[] = $value["company_type_id"];
        }
        $CompanyTypes = CompanyTypes::whereNotIn("id",$result)->get();
        return view('admin.Company.AdditionalInfo.Companytype.create')->with(['company'=>$company,'CompanyTypes'=>$CompanyTypes]);
    }

    /**
     * Save more company types
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCompanyTypes(){
        $company = Company::find(Input::get('company_id'));

        //first of all delete existing rows and create new one.
        CompanyTypeMapping::whereRaw("company_id = ? ",array($company->id))->delete();

        foreach(Input::get('company_types') as $type){
            $preference = new CompanyTypeMapping();
            $preference->company_id = $company->id;
            $preference->company_type_id = $type;
            $preference->save();
        }
        return Redirect::to('companies/info/'.$company->id)->with('message', 'Your company details have been changed.');
    }

    /**
     * View company gallery
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function companyGallery($id){
        $company = Company::find($id);
        return view('admin.Company.Gallery.index')->with(['company'=>$company]);
    }

    /**
     * View company gallery
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addImagesToCompanyGallery($id){
        $company = Company::find($id);

        $showCustomCongrates = Session::get('showCustomCongrates');
        return view('admin.Company.Gallery.add')->with(['company'=>$company,'showCustomCongrates'=>$showCustomCongrates]);
    }

    /**
     * View current packages
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCurrentPackages(){
        //Paginating company

        $companies = Company::paginate(15);
        
        $previousPageUrl = $companies->previousPageUrl();//previous page url
        $nextPageUrl = $companies->nextPageUrl();//next page url
        $lastPage = $companies->lastPage(); //Gives last page number
        $total = $companies->total();
        return view('admin.Company.Packages.index')->with(['companies'=>$companies,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }
    
    /**
     * View user's current compnay
     */
    public function userCompany()
    {
        $user_id = Auth::user()->id;
        $userObj = UserDetails::where('user_id',$user_id)->first();
        $company_id = $userObj->company_id;
        if($company_id == '')
        {
            $company = array();
            $companyReq = CompanyUsers::whereRaw('user_id = ? AND status = ?',array($user_id,0))->first();
            if($companyReq)
            {
                $reqCompanyData = Company::find($companyReq->company_id);
            }
            else
            {
                $reqCompanyData = '';
            }
            return view('admin.Company.view')->with(['company'=>$company,'reqCompanyData'=>$reqCompanyData]);
        }
        return Redirect::to('company/profile/'.$company_id);
    }
    
    /**
     * Edit user's current compnay
     */
    public function userEditCompany()
    {
        $user_id = Auth::user()->id;
        $userObj = UserDetails::where('user_id',$user_id)->first();
        $company_id = $userObj->company_id;
        
        if($company_id == '')
        {
            $company = array();
            return view('admin.Company.edit')->with(['company'=>$company]);
        }
        return Redirect::to('companies/'.$company_id.'/edit');
    }
    
    /**
     * user change compnay view
     */
    public function userChangeCompany()
    {
        $user_id = Auth::user()->id;
        $userObj = UserDetails::where('user_id',$user_id)->first();
        $company_id = $userObj->company_id;
        if($company_id != '')
        {
            $company = Company::find($company_id);
        }
        else
        {
            $company = new Company;
        }
        
        return view('admin.Company.change')->with(['company'=>$company]);
    }
    
    /**
     * Compnay serach
     */
    public function searchCompany()
    {
        $companies = array();
        $search = Input::get('q');
        
        $compnayData = Company::whereRaw('is_active = 1 AND ( name LIKE "%'.$search.'%") ')->get()->toArray();
        foreach($compnayData as $compnay)
        {
            
            
            $dataArray = array();
            $dataArray['id'] = $compnay['id'];
            $dataArray['full_name'] = $compnay['name'];
            $companies[] = $dataArray;
            
        }
        
        $ajaxArray = array();
        $ajaxArray['incomplete_results'] = false;
        $ajaxArray['items'] = $companies;
        return Response::json($ajaxArray);
    }
    
    /**
     * change user compnay
     */
    public function saveCompanyChange()
    {
        $company_id = Input::get('company_id');
        
        $company = Company::find($company_id);
        $fist_flg = 0;
        if(Input::has('first_time'))
        {
            $fist_flg = 1;
        }
        elseif(Input::has('profile_first_time'))
        {
            $fist_flg = 2;
        }
        else
        {
            $fist_flg = 0;
        }
        if($company)
        {
            $user_id = Auth::user()->id;
            $userObj = UserDetails::where('user_id',$user_id)->first();
            
            /// If compnay changed than request send to compnay for accept
            $old_company_id = $userObj->company_id;
            if($old_company_id != $company_id)
            {
                $userCompanyObj = CompanyUsers::where('user_id',$user_id)->first();
                if($userCompanyObj)
                {
                    $userCompanyObj->delete();
                }
                $CompanyUsers = new CompanyUsers;
                $CompanyUsers->company_id = $company_id;
                $CompanyUsers->user_id = $user_id;
                $CompanyUsers->status = 0;
                $CompanyUsers->save();
                
                /// User Activity for message
                $usersActivity = new UsersActivity;
                $usersActivity->activity_name = 'You updated your company to '.$company->name.'.';
                $usersActivity->activity_id = $company->id;
                $usersActivity->activity_type = 'company';
                $usersActivity->creater_id = $user_id;
                $usersActivity->receiver_id = null;
                $usersActivity->save();
            }
            else{
                $userObj->company_id = $company_id;
                $userObj->save();
                
                /// User Activity for message
                $usersActivity = new UsersActivity;
                $usersActivity->activity_name = 'You updated your company to '.$company->name.'.';
                $usersActivity->activity_id = $company->id;
                $usersActivity->activity_type = 'company';
                $usersActivity->creater_id = $user_id;
                $usersActivity->receiver_id = null;
                $usersActivity->save();
            }
            /* review mail to receiver */
        
            $senderData = UserDetails::where('user_id',$user_id)->first();
            $sender = User::find($user_id);
            if($senderData->industry_id != '')
            {
                $industry_name = $sender->userdetail->getUserIndustry->name;
            }
            else
            {
                $industry_name = '';
            }
            
            
            $approve_link = url('company/user/accept').'/'.$sender->id;
            $deny_link = url('company/user/reject').'/'.$sender->id;
            Input::replace(array('email' => $company->email,'name'=>$company->name));
            $data = array(
                            'company_name'=>Input::get('name'),
                            'first_name'=>$senderData->first_name,
                            'last_name'=>$senderData->last_name,
                            'date_joined'=>date('Y-m-d',strtotime($sender->created_at)),
                            'user_email'=>$sender->email,
                            'user_phone'=>$senderData->phone,
                            'user_industry'=>$industry_name,
                            'approve_link'=>$approve_link,
                            'deny_link' => $deny_link
                            );
            Mail::send('admin.Emailtemplates.companyNewUserAddAccount', $data, function($message){
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), Input::get('name'))->subject('A user has requested to be added to your company');
            });
            
            if($fist_flg == 1)
            {
                // set wizard track
                $wizardObj = UserWizardTrack::where('user_id',$user_id)->first();
                $wizardObj->wizard_step = 5;
                $wizardObj->save();
                
                return Redirect::to('user/billing/plans');
            }
            elseif($fist_flg == 2)
            {
                return Redirect::to('user-dashboard?setup=company_admin');
            }
            else
            {
                if($old_company_id == '')
                {
                    $company = array();
                    return Redirect::to('user/currentCompany')->with('message', 'Your company request has been sent.');
                }
                return Redirect::to('company/profile/'.$old_company_id)->with('message', 'Your company request has been sent.');  
            }
        }
        
        if($fist_flg == 1)
        {
            return Redirect::to('user/company/select')->with('message', 'Please make a selection before proceeding.');
        }
        elseif($fist_flg == 2)
        {
            return Redirect::to('user-dashboard?setup=company_admin');
        }
        else
        {
            return Redirect::to('user-dashboard?setup=company_admin');    
        }
    }
    
    /**
     * View Company
     */
    public function viewCompnay()
    {
        $user_id = Auth::user()->id;
        $company = Company::where('user_id',$user_id)->first();
        $id = $company->id;
        $company->user = User::find($company->user_id);
        
        if($company->user->account_member == 'gold')
        {
            $company->star = 'gold';
        }
        elseif($company->user->account_member == 'silver')
        {
            $company->star = 'silver';
        }
        else
        {
            $company->star = 'none';
        }
        
        /// marketplace products
        $products = MarketplaceProducts::where('company_id',$id)->paginate(10);
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
        $endorsements = $company->user->endorsements;
        
        foreach($endorsements as $endorse)
        {
            $sender_id = $endorse->sender_id;
            
            /// find detail of review receiver
            $endorse->sender_id = $sender_id;
            $endorse->user = User::find($sender_id);
            if($endorse->user->access_level == 4)
            {
                $endorse->sendername = $endorse->user->companydetail->name;
                $endorse->sender_avatar = $endorse->user->companydetail->logo;
                $endorse->companyname = '';
            }
            else
            {
                $senderData = UserDetails::where('user_id',$sender_id)->first();
            
                $endorse->sendername = $senderData->first_name.' '.$senderData->last_name;
                $endorse->sender_avatar = $senderData->profile_picture;
                /// find compnay detail of review receiver
                if($senderData->company_id != '')
                {
                    $Endorsecompany = Company::find($senderData->company_id);
                    $endorse->companyname = $Endorsecompany->name;    
                }
                else
                {
                    $endorse->companyname = '';
                }
            }
            
            
        }
        
        // reviews
        
        $reviews = $company->user->reviews;
        
        foreach($reviews as $review)
        {
            $sender_id = $review->sender_id;
            
            /// find detail of review receiver
            $review->sender_id = $sender_id;
            $senderUser = User::find($sender_id);
            $review->user = $senderUser;
            $review->review = count($senderUser->reviews);
            if($senderUser->access_level == 4)
            {
                $review->sendername = $senderUser->companydetail->name;
                $review->sender_avatar = $senderUser->companydetail->logo;
                $review->senderfrom = $senderUser->companydetail->city.','.$senderUser->companydetail->state.','.$senderUser->companydetail->country;
                $review->companyname = '';
            }
            else
            {
                $senderData = UserDetails::where('user_id',$sender_id)->first();
            
                $review->sendername = $senderData->first_name.' '.$senderData->last_name;
                $review->sender_avatar = $senderData->profile_picture;
                $review->senderfrom = $senderData->city.','.$senderData->state.','.$senderData->country;
                /// find compnay detail of review receiver
                if($senderData->company_id != '')
                {
                    $reviewCompany = Company::find($senderData->company_id);
                    $review->companyname = $reviewCompany->name;    
                }
                else
                {
                    $review->companyname = '';
                }
            }
            
            
        }
        
        $companyArray = $company->toArray();
        $company->rAndD = $companyArray['r&d_capacity'];
        $payment_acceptes = [
            array('id'=>1,'name'=>'Credit Cards'),
            array('id'=>2,'name'=>'Bank Transfer'),
            array('id'=>3,'name'=>'Online Payments/Paypal'),
            array('id'=>4,'name'=>'Cheque'),
            array('id'=>5,'name'=>'COD'),
            array('id'=>6,'name'=>'Other')
        ]; 
        $payment_str = array();
        if($company->accepted_payment_type != '')
        {
            $accepted_payment_types = explode(',',$company->accepted_payment_type);
            foreach($accepted_payment_types as $index=>$payment)
            {
                foreach($payment_acceptes as $pay)
                {
                    if($pay['id'] == $payment)
                    {
                        $payment_str[] = $pay['name'];
                    }
                }
            }
        }
        else
        {
            $payment_str = array();
        }
        
        return view('company.company.view')->with([
                                                'company'=>$company,
                                                'products'=>$products,
                                                'payment_str'=>$payment_str,
                                                'endorsements'=>$endorsements,
                                                'reviews' => $reviews
                                            ]);
        //return view('company.company.view')->with(['company'=>$company]);
    }
    
    /**
     * Company Users
     */
    public function companyUsers()
    {
        //Paginating products
        $user_id = Auth::user()->id;
        $company = Company::where('user_id',$user_id)->first();
        
        $users = UserDetails::where('company_id',$company->id)->orderBy('id','desc')->paginate(15);
        
        foreach($users as $user)
        {
            $userObj = User::find($user->user_id);
            $user->email = $userObj->email;
        }
        
        $previousPageUrl = $users->previousPageUrl();//previous page url
        $nextPageUrl = $users->nextPageUrl();//next page url
        $lastPage = $users->lastPage(); //Gives last page number
        $total = $users->total();
        
        return view('company.users.index')->with(['users'=>$users,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }
    
    /** 
     * Company Request by users
     */
    public function companyUsersRequest()
    {
        //Paginating products
        $user_id = Auth::user()->id;
        $company = Company::where('user_id',$user_id)->first();
        
        $users = CompanyUsers::where('company_id',$company->id)->orderBy('id','desc')->paginate(15);
        
        foreach($users as $user)
        {
            $userData = UserDetails::where('user_id',$user->user_id)->first();
            $userObj = User::find($userData->user_id);
            $user->name = $userData->first_name.' '.$userData->last_name;
            $user->phone = $userData->phone;
            $user->account_type = $userData->account_type;
            $user->email = $userObj->email;
            $user->userdetail_id = $userData->id;
        }
        
        $previousPageUrl = $users->previousPageUrl();//previous page url
        $nextPageUrl = $users->nextPageUrl();//next page url
        $lastPage = $users->lastPage(); //Gives last page number
        $total = $users->total();
        
        return view('company.users.request')->with(['users'=>$users,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }
    
    /**
     * Compnay remove from user
     */
    public function companyUsersRemove($id)
    {
        $user = UserDetails::find($id);
        $company_id = $user->company_id;
        $user->company_id = NULL;
        $user->save();
        
        $company = Company::find($company_id);
        
        Input::replace(array('email' => $company->email,'name'=>$company->name));
        $data = array(
                        'company_name'=>Input::get('name'),'base_url'=>url()
                        );
        Mail::send('admin.Emailtemplates.companyUserRemoved', $data, function($message){
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to(Input::get('email'), Input::get('name'))->subject('A user has been removed from your Company Page');
        });
        
        return Redirect::back()->with('message', 'User has been removed from Company Page.');
    }
    
    /**
     * User request accept by company
     */
    public function companyUsersAccept($id)
    {
        $companyUser = CompanyUsers::find($id);
        $company_id = $companyUser->company_id;
        $user_id = $companyUser->user_id;
        
        $userObj = UserDetails::where('user_id',$user_id)->first();
        $userObj->company_id = $company_id;
        $userObj->save();
        
        /// remove request after add company in user
        $companyUser->delete();
        
        $company = Company::find($company_id);
        /* review mail to receiver */
        
        $senderData = UserDetails::where('user_id',$user_id)->first();
        $sender = User::find($user_id);

        Input::replace(array('email' => $company->email,'name'=>$company->name));
        $data = array(
                        'name' => $senderData->first_name,
                        'company_name'=>Input::get('name'),
                        'first_name'=>$senderData->first_name,
                        'last_name'=>$senderData->last_name,
                        'date_joined'=>date('Y-m-d',strtotime($sender->created_at)),
                        'base_url'=>url()
                        );
        Mail::send('admin.Emailtemplates.companyNewUserAddedToCompany', $data, function($message){
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to(Input::get('email'), Input::get('name'))->subject('A new users has been added to your Company Page.');
        });
        
        return Redirect::back()->with('message', 'User has been added to the Company Page.');
    }
    
    /**
     * Compnay remove user request
     */
    public function companyUserReject($id)
    {
        $user = CompanyUsers::find($id);
        $user->delete();
        return Redirect::back()->with('message', 'User has been removed from the Company Page.');
    }
    
    /**
     * Company Logo Upload
     */
    public function uploadLogo(){

        //validations of number of images.
        $company = Company::find(Input::get("company_id"));
        $destinationPath = 'public/company/logo'; // upload path
        $files = Input::file('files');
        $resultArray = array();
        foreach($files as $file){
            $extension = $file->getClientOriginalExtension(); // getting image extension
            if(strtolower($extension) == "png" ||  strtolower($extension) == "jpg" || strtolower($extension) == "jpeg"){
                $size = $file->getSize();
                $fileName = str_replace(' ','_',$company->name).'_'.rand(11111,99999).'.'.$extension; // renaming image
                $file->move(base_path() . '/'.$destinationPath, $fileName); // uploading file to given path
                $fullURL = url()."/".$destinationPath."/".$fileName;
                $company->logo = $destinationPath."/".$fileName;
                $company->save();
                $resultArray[] = array(
                    "name" => $fileName,
                    "size"=> $size,
                    "url"=>$fullURL,
                    "thumbnailUrl"=>$fullURL,
                    "deleteUrl"=>url()."/company/logo/remove/".$company->id,
                    "deleteType"=> "GET"
                );
            }else{
                $size = $file->getSize();
                $resultArray[] = array(
                    "name" => $file->getName(),
                    "size"=> $size,
                    "error"=>"Not supported extension",
                );
            }
        }
        return array("files" => $resultArray);
    }
    
    /**
     * remove company logo
     */
     public function removeCompanyLogo($id){
        $resultArray = array();
        $company = Company::find($id);
        $resultArray[] = array($company->logo => true);
        $destinationPath = $company->logo;
        File::delete($destinationPath);
        $company->logo = '';
        $company->save();
        return array("files" => $resultArray);
    }
    
    /**
     * Company Logo Upload
     */
    public function uploadBackground(){

        //validations of number of images.
        $company = Company::find(Input::get("company_id"));
        $destinationPath = 'public/company/background'; // upload path
        $files = Input::file('files');
        $resultArray = array();
        foreach($files as $file){
            $extension = $file->getClientOriginalExtension(); // getting image extension
            if(strtolower($extension) == "png" ||  strtolower($extension) == "jpg" || strtolower($extension) == "jpeg"){
                $size = $file->getSize();
                $fileName = str_replace(' ','_',$company->name).'_'.rand(11111,99999).'.'.$extension; // renaming image
                $file->move(base_path() . '/'.$destinationPath, $fileName); // uploading file to given path
                $fullURL = url()."/".$destinationPath."/".$fileName;
                $company->background_image = $destinationPath."/".$fileName;
                $company->save();
                $resultArray[] = array(
                    "name" => $fileName,
                    "size"=> $size,
                    "url"=>$fullURL,
                    "thumbnailUrl"=>$fullURL,
                    "deleteUrl"=>url()."/company/background/remove/".$company->id,
                    "deleteType"=> "GET"
                );
            }else{
                $size = $file->getSize();
                $resultArray[] = array(
                    "name" => $file->getName(),
                    "size"=> $size,
                    "error"=>"Not supported extension",
                );
            }
        }
        return array("files" => $resultArray);
    }
    
    /**
     * remove company Background
     */
     public function removeCompanyBackground($id){
        $resultArray = array();
        $company = Company::find($id);
        $resultArray[] = array($company->background_image => true);
        $destinationPath = $company->background_image;
        File::delete($destinationPath);
        $company->background_image = '';
        $company->save();
        return array("files" => $resultArray);
    }
    
    /**
     * Company Page View
     */
    public function companyProfileView($id)
    {
        $company = Company::find($id);

        $user = UserDetails::where('company_id',$id)->first();

        $checkUser = User::find($user->user_id);
        if($checkUser->is_using_temporary_password == 1){
            $claimCompany = 1;
        }else{
            $claimCompany = 0;
        }

        $companyMembers = UserDetails::whereIn('user_id', function($query) use ($id){
            $query->select('id')
                ->from('users')
                ->where('is_using_temporary_password',0);
        })->where('company_id',$id)->get();

        // for set unique number
        if($company->unique_number == '')
        {
            // for user unique number
            $unique = UserUnique::first();
            $next = $unique->number+1;
            $unique->number = $next;
            $unique->save();
            
            $unique_number = 'IJU-'.$next;
            
            $company->unique_number = $unique_number;
            $company->save();
            
        }
        
        // for set external url if blank
        if($company->external_link == '')
        {
            $company->external_url = $this->seo_friendly_url($company->name).'-'.$company->unique_number;    
            $company->save();
        }
        
        $company->user = User::find($company->user_id);
        if($company->user != '')
        {
            if($company->user->account_member == 'gold')
            {
                $company->star = 'gold';
            }
            elseif($company->user->account_member == 'silver')
            {
                $company->star = 'silver';
            }
            else
            {
                $company->star = 'none';
            }
        }


        /// marketplace products
        $products = MarketplaceProducts::where('company_id',$id)->paginate(10);
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
            if($product->user->account_member = 'gold')
            {
                $product->star = 'gold';
            }
            elseif($product->user->account_member = 'silver')
            {
                $product->star = 'silver';
            }
            else
            {
                $product->star = 'none';
            }
        }

        // endorsments
        $endorsements = '';
        if($company->user != '')
        {
            $endorsements = $company->user->endorsements;
            if($endorsements){
                foreach($endorsements as $endorse)
                {
                    $sender_id = $endorse->sender_id;

                    /// find detail of review receiver
                    $endorse->sender_id = $sender_id;
                    $endorse->user = User::find($sender_id);
                    if($endorse->user->access_level == 4)
                    {
                        $endorse->sendername = $endorse->user->companydetail->name;
                        $endorse->sender_avatar = $endorse->user->companydetail->logo;
                        $endorse->current_position = '';
                        $endorse->companyname = '';
                    }
                    else
                    {
                        $senderData = UserDetails::where('user_id',$sender_id)->first();

                        $endorse->sendername = $senderData->first_name.' '.$senderData->last_name;
                        $endorse->sender_avatar = $senderData->profile_picture;
                        $endorse->current_position = $senderData->current_position;
                        /// find compnay detail of review receiver
                        if($senderData->company_id != '')
                        {
                            $Endorsecompany = Company::find($senderData->company_id);
                            $endorse->companyname = $Endorsecompany->name;
                        }
                        else
                        {
                            $endorse->companyname = '';
                        }
                    }
                }
            }
        }

        // reviews
        $reviews = '';
        if($company->user != '')
        {
            $reviews = $company->user->reviews;
            if($reviews){
                foreach($reviews as $review)
                {
                    $sender_id = $review->sender_id;

                    /// find detail of review receiver
                    $review->sender_id = $sender_id;
                    $senderUser = User::find($sender_id);
                    $review->user = $senderUser;
                    $review->review = count($senderUser->reviews);
                    if($senderUser->access_level == 4)
                    {
                        $review->sendername = $senderUser->companydetail->name;
                        $review->sender_avatar = $senderUser->companydetail->logo;
                        $review->senderfrom = $senderUser->companydetail->city.','.$senderUser->companydetail->state.','.$senderUser->companydetail->country;
                        $review->companyname = '';
                    }
                    else
                    {
                        $senderData = UserDetails::where('user_id',$sender_id)->first();

                        $review->sendername = $senderData->first_name.' '.$senderData->last_name;
                        $review->sender_avatar = $senderData->profile_picture;
                        $review->senderfrom = $senderData->city.','.$senderData->state.','.$senderData->country;
                        /// find compnay detail of review receiver
                        if($senderData->company_id != '')
                        {
                            $reviewCompany = Company::find($senderData->company_id);
                            $review->companyname = $reviewCompany->name;
                        }
                        else
                        {
                            $review->companyname = '';
                        }
                    }
                }
            }
        }

        $companyArray = $company->toArray();
        $company->rAndD = $companyArray['r&d_capacity'];
        $payment_acceptes = [
            array('id'=>1,'name'=>'Credit Cards'),
            array('id'=>2,'name'=>'Bank Transfer'),
            array('id'=>3,'name'=>'Online Payments/Paypal'),
            array('id'=>4,'name'=>'Cheque'),
            array('id'=>5,'name'=>'COD'),
            array('id'=>6,'name'=>'Other')
        ];
        $payment_str = array();
        if($company->accepted_payment_type != '')
        {
            $accepted_payment_types = explode(',',$company->accepted_payment_type);
            foreach($accepted_payment_types as $index=>$payment)
            {
                foreach($payment_acceptes as $pay)
                {
                    if($pay['id'] == $payment)
                    {
                        $payment_str[] = $pay['name'];
                    }
                }
            }
        }
        else
        {
            $payment_str = array();
        }

        if($company->facebook_url != '' || $company->facebook_url != NULL){
            $url = $company->facebook_url;
            $host = explode(':',$url);

            if($host[0] == 'http'){
                $facebookUrl = $url;
            }else{
                $facebookUrl = 'http://'.$url;
            }
        }else{
            $facebookUrl = '';
        }

        if($company->twitter_url != '' || $company->twitter_url != NULL){
            $url = $company->twitter_url;
            $host = explode(':',$url);

            if($host[0] == 'http'){
                $twitterUrl = $url;
            }else{
                $twitterUrl = 'http://'.$url;
            }
        }else{
            $twitterUrl = '';
        }

        if($company->insta_url != '' || $company->insta_url != NULL){
            $url = $company->insta_url;
            $host = explode(':',$url);

            if($host[0] == 'http'){
                $instaUrl = $url;
            }else{
                $instaUrl = 'http://'.$url;
            }
        }else{
            $instaUrl = '';
        }

        if($company->youtube_url != '' || $company->youtube_url != NULL){
            $url = $company->youtube_url;
            $host = explode(':',$url);

            if($host[0] == 'http'){
                $youtubeUrl = $url;
            }else{
                $youtubeUrl = 'http://'.$url;
            }
        }else{
            $youtubeUrl = '';
        }

        return view('company.profile')->with([
            'company'=>$company,
            'products'=>$products,
            'payment_str'=>$payment_str,
            'endorsements'=>$endorsements,
            'reviews' => $reviews,
            'claimCompany'=>$claimCompany,
            'companyMembers'=>$companyMembers,
            'facebookUrl'=>$facebookUrl,
            'twitterUrl'=>$twitterUrl,
            'instaUrl'=>$instaUrl,
            'youtubeUrl'=>$youtubeUrl
        ]);
    }
    
    public function companyAllUser()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if($user->access_level == 2 || $user->access_level == 3)
        {
            $company_id = $user->userdetail->company_id;
            $userCompany = Company::find($company_id);
            if($user->id != $userCompany->owner_id)
            {
                return Redirect::to('not-authorized');
            }
        }
        // admin user company
        $company = Company::find($user->userdetail->company_id);
        
        // company connected users
        $companyConnectedUsers = UserDetails::where('company_id',$company->id)->orderBy('id','desc')->get();
        foreach($companyConnectedUsers as $connectedUser)
        {
            $connectedUser->user = User::find($connectedUser->user_id);
        }
        
        // company pendding users
        $companyPenddingUsers = CompanyUsers::where('company_id',$company->id)->orderBy('id','desc')->get();
        foreach($companyPenddingUsers as $penddingUser)
        {
            $penddingUser->user = User::find($penddingUser->user_id);
        }
        
        return view('company.users.companyUsers')->with([
            'company'=>$company,
            'connectedUsers'=>$companyConnectedUsers,
            'penddingUsers'=>$companyPenddingUsers
        ]);
    }
    
    public function startOrJoinCompany()
    {
        return view('user.start-join-company');
    }

    /**
     * Company List
     */
    public function companyList()
    {
            $companies = Company::orderBy('id','desc')->paginate(15);
            $previousPageUrl = $companies->previousPageUrl();//previous page url
            $nextPageUrl = $companies->nextPageUrl();//next page url
            $lastPage = $companies->lastPage(); //Gives last page number
            $total = $companies->total();
            return view('admin.Company.companyList')->with(['companies'=>$companies,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }


    /*public function companyUsersList()
    {
        //Paginating products
        //$user_id = Auth::user()->id;
        //$company = Company::where('user_id',$user_id)->first();

        $companyUsers = CompanyUsers::orderBy('id','desc')->paginate(15);

        foreach($companyUsers as $user)
        {
            $user->companyUser_id = $user->id;
            $userData = UserDetails::where('user_id',$user->user_id)->first();
            $user->name = $userData->first_name.' '.$userData->last_name;
            $user->company_name = Company::find('company_id')->name;
        }

        $previousPageUrl = $companyUsers->previousPageUrl();//previous page url
        $nextPageUrl = $companyUsers->nextPageUrl();//next page url
        $lastPage = $companyUsers->lastPage(); //Gives last page number
        $total = $companyUsers->total();

        return view('company.users.list')->with(['companyUsers'=>$companyUsers,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }*/

    public function companyURLs()
   {
       $companies = Company::orderBy('id','desc')->paginate(15);

       $previousPageUrl = $companies->previousPageUrl();//previous page url
       $nextPageUrl = $companies->nextPageUrl();//next page url
       $lastPage = $companies->lastPage(); //Gives last page number
       $total = $companies->total();

       return view('company.urls')->with(['companies'=>$companies,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
   }

    public function claimCompanyStartPage($companyId){

        $companyName = Company::find($companyId)->name;
        return view('user.start-join-company-claim')->with(['companyId'=>$companyId,'companyName'=>$companyName]);
    }

    public function saveCompanyOwner(){

        if(isset($_REQUEST['companyId'])){
            $id = $_REQUEST['companyId'];
        }else{
            $id = Input::get('companyId');
        }

        $user_id = Auth::user()->id;
        $company = Company::find($id);
        $company->owner_id = $user_id;
        $company->save();

        $userData = UserDetails::where('user_id',$user_id)->first();
        $userData->company_id = $id;
        $userData->save();

        $users = User::where('is_using_temporary_password',1)->get();
        $userArray = array();
        foreach($users as $user){
            $userArray[] = $user->id;
        }
        $userData = UserDetails::whereIn('user_id',$userArray)->where('company_id',$id)->first();

        if($userData){

            $user = User::find($userData->user_id);
            $user->is_using_temporary_password = 0;
            $user->password = NULL;
            $user->save();

            $data = array('email'=>$user->email,'name'=>$userData->first_name,'fullName'=>$userData->first_name.' '.$userData->last_name);
            Mail::send('admin.Emailtemplates.companyClaimEmail', $data, function($message) use ($data) {
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to($data['email'],$data['name'])->subject('Deactivation from Company Page');
            });
        }

        $ajaxDataArray = array();
        $ajaxDataArray['companyId'] = $id;
        if(isset($_REQUEST['companyId'])){
            return Redirect::to('companies/'.$id.'/edit');
        }else{
            return Response::json($ajaxDataArray);
        }
    }

}
