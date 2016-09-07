<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quotes;
use App\UserDetails;
use App\OrderTypes;
use App\Company;
use App\Product;
use App\ContactUsers;
use App\UserEducationDetails;
use App\Industry;
use App\Category;
use App\Accreditation;
use App\Diversity;
use App\QuoteAccreditation;
use App\QuoteCategories;
use App\QuoteProducts;
use App\QuoteIndustries;
use App\QuoteTypePurchase;
use App\QuoteTypeRentlease;
use App\QuoteTypeService;
use App\QuoteDiversity;
use App\SupplierIgnoreQuotes;
use App\MarketplaceProducts;
use App\MarketplaceProductGallery;
use App\EmailVerification;
use App\User;
use App\Jobs;
use App\SingupEmailVerification;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Input;
use Auth;
use Response;
use Session;
use Mail;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	/*public function __construct()
	{
		$this->middleware('guest');
	}*/
    
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->access_level == 1):
            return Redirect::to('sa');
        else:
            return Redirect::to('user-dashboard');
        endif;
        
    }
    
    /**
     * Home view
     */
    public function viewHome()
    {
        $industries = Industry::all();
        if(isset($_REQUEST['company_code']))
        {
            Session::put('company_code',$_REQUEST['company_code']);
        }
        if(Input::has('referral')){
            Session::put('referral', Input::get('referral'));
        }

        /*if(isset($_REQUEST['email']) && isset($_REQUEST['type']) && isset($_REQUEST['teamId']))
        {
            Session::put('email',$_REQUEST['email']);
            Session::put('type',$_REQUEST['type']);
            Session::put('teamId',$_REQUEST['teamId']);
        }*/

        $isReferral = false;
        $referralCode = '';
        if(Session::has('referral')){
            $isReferral = true;
            $referralCode = Session::get('referral');
        }


        $cookie = '';
        $cookie_name = "home";
        $cookie_value = "Mobile App";
        if(!isset($_COOKIE[$cookie_name])) {
            $cookie = setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); // 86400 = 1 day
        }

        return view('home.home')->with(['industries'=>$industries,'isReferral'=>$isReferral,'referralCode'=>$referralCode,'cookie'=>$cookie]);
    }
    
    /**
     * Supplier Home view
     */
    public function viewSupplierHome()
    {
        $industries = Industry::all();
        if(isset($_REQUEST['company_code']))
        {
            Session::put('company_code',$_REQUEST['company_code']);
        }
        
        return view('home.supplier')->with(['industries'=>$industries]);
    }
    
    public function viewBuyerFeatures()
    {
        $industries = Industry::all();
        return view('home.buyer-fatures')->with(['industries'=>$industries]);
    }
    
    public function viewSupplierNetwork()
    {
        $industries = Industry::all();
        return view('home.supplier-network')->with(['industries'=>$industries]);
    }
    
    public function viewReferralProgram()
    {
        $industries = Industry::all();
        return view('home.referral-program')->with(['industries'=>$industries]);
    }

    public function industriesList()
    {
        $industries = Industry::all();
        return view('home.industries')->with(['industries'=>$industries]);
    }
    
    public function viewFaq()
    {
        $industries = Industry::all();
        return view('home.faq')->with(['industries'=>$industries]);
    }
    
    public function viewAboutUs()
    {
        $industries = Industry::all();
        return view('home.about-us')->with(['industries'=>$industries]);
    }
    
    public function viewNews()
    {
        $industries = Industry::all();
        return view('home.news')->with(['industries'=>$industries]);
    }
    
    public function viewInvestorOutreach()
    {
        $industries = Industry::all();
        return view('home.investor-outreach')->with(['industries'=>$industries]);
    }
    
    public function viewContactUs()
    {
        $industries = Industry::all();
        return view('home.contact-us')->with(['industries'=>$industries]);
    }
    
    public function viewPrivacyPolicy()
    {
        $industries = Industry::all();
        return view('home.privacy-policy')->with(['industries'=>$industries]);
    }
    
    public function viewTerms()
    {
        $industries = Industry::all();
        return view('home.terms')->with(['industries'=>$industries]);
    }
    
    public function viewStudents()
    {
        $industries = Industry::all();
        return view('home.students')->with(['industries'=>$industries]);
    }
    
    public function overView()
    {
        $industries = Industry::all();
        return view('home.indyjohn-overview')->with(['industries'=>$industries]);
    }
    
    public function sendContactUs(Request $request)
    {
        $input = $request->all();
        //Validations
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'department' => 'required',
            'message' => 'required'
        ]);
        
        $data = array('name'=>$input['name'],'email'=>$input['email'],'phone'=>$input['phone'],'department'=>$input['department'],'description'=>$input['message']);
        
        Mail::send('admin.Emailtemplates.contact-us', $data, function($message){
            $message->from(Input::get('email'), Input::get('email'));
            $message->to(env('CONTACT_TO_EMAIL'), env('CONTACT_TO_NAME'))->subject('Contact Indy John Team');
        });
        
        return Redirect::to('contact-us')->with('message', 'Thank you. Your message has been received by Indy John team.');
    }
    
    public function viewIndustrialServiceProvider()
    {
        $industries = Industry::all();
        return view('home.industrial-service-provider')->with(['industries'=>$industries]);
    }
    
    public function viewHowItWorks()
    {
        $industries = Industry::all();
        return view('home.how-it-works')->with(['industries'=>$industries]);
    }
    
    public function viewMarketingSolutions()
    {
        $industries = Industry::all();
        return view('home.marketing-solutions')->with(['industries'=>$industries]);
    }
    
    public function viewAdvertiseWithUs()
    {
        $industries = Industry::all();
        return view('home.advertise-with-us')->with(['industries'=>$industries]);
    }
    
    public function viewPartnerWithUs()
    {
        $industries = Industry::all();
        return view('home.partner-with-us')->with(['industries'=>$industries]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    public function quoteSave(Request $request)
    {
        $input = $request->all();
        Session::forget('requestquote');
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|max:255',
            'product' => 'required',
            'category' => 'required',
        ]);
        
        Session::put('requestquote',$input);
        return Redirect::to('homepage/quote');
    }
    
    public function saveListNewProduct(Request $request)
    {
        Session::forget('productdata');
        $input = $request->all();
        $this->validate($request, [
            'name' => 'required',
            'brand_name' => 'required',
            'price' => 'required|integer',
            'discount_percent' => 'numeric',
            'minimum_quantity' => 'integer',
            'quantity_available' => 'integer',
            'shipping_fee' => 'numeric',
            'attachment_path'  => 'required|required_if:requestType,sick|mimes:pdf,doc,docx',
            'product_img'  => 'required|required_if:requestType,sick|mimes:jpg,png,gif,jpeg',
        ]);
        
        /// Product Image upload
        $imgdestinationPath = 'public/marketplace/product/images'; // upload path
        $imageName = str_replace(' ','_',$input['name']).'_'.rand(11111,99999). '.' .$request->file('product_img')->getClientOriginalExtension();
        $request->file('product_img')->move(
            base_path() . '/'.$imgdestinationPath, $imageName
        );
        
        $input['product_img'] = $imageName;
        
        /// PDF file upload to public folder ///
        $destinationPath = 'public/marketplace/pdf'; // upload path
        $pdfName = str_replace(' ','_',$input['name']).'_'.rand(11111,99999). '.' .$request->file('attachment_path')->getClientOriginalExtension();
        $request->file('attachment_path')->move(
            base_path() . '/'.$destinationPath, $pdfName
        );
        
        $input['attachment_path'] = $destinationPath.'/'.$pdfName;
        
        Session::put('productdata',$input);
        
        return Redirect::to('homepage/login');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        Session::forget('quotedata');
        $this->validate($request, [
            'title' => 'required',
            'specifications' => 'required'
        ]);
        //Creating accreditations and go back to index.
        $input = $request->all();
        ///file upload to public folder ///
        if(Input::file('additional_file'))
        {
            $destinationPath = 'public/quotes'; // upload path
            $fileName = str_replace(' ','_',$input['title']).'_'.rand(11111,99999). '.' .$request->file('additional_file')->getClientOriginalExtension();
            $request->file('additional_file')->move(
                base_path() . '/'.$destinationPath, $fileName
            );
            
            $input['additional_file'] = 'quotes/'.$fileName;
        }
        else
        {
            $input['additional_file'] = '';
        }
        
        Session::put('quotedata',$input);
        
        return Redirect::to('homepage/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
    
    /**
     * Company Create or login
     */
    public function companyView()
    {
        if(Session::has('quotedata'))
        {
            $quotedata = Session::get('quotedata');
            $request_quote = Session::get('requestquote');
            $product = Product::find($request_quote['product']);
            $quotedata['product_name'] = $product->name;
            $category = Category::find($request_quote['category']);
            $quotedata['category_name'] = $category->name;
            $industry = Industry::find($request_quote['industry']);
            $quotedata['industry_name'] = $industry->name;
            return view('home.login')->with(['quotedata' => $quotedata]);    
        }
        elseif(Session::has('productdata')){
            $quotedata = array();
            return view('home.login')->with(['quotedata' => $quotedata]);
        }
        else{
            return Redirect::to('request-quote');
        }
    }
    
    /**
     * Quote page on homepage
     */
    public function quoteHome()
    {
        if(Session::has('requestquote'))
        {
            $request_quote = Session::get('requestquote');
            $product = Product::find($request_quote['product']);
            $request_quote['product_name'] = $product->name;
            $category = Category::find($request_quote['category']);
            $request_quote['category_name'] = $category->name;
            $industry = Industry::find($request_quote['industry']);
            $request_quote['industry_name'] = $industry->name;
            
            // purchase order types
            $purchaseOrderTypes = OrderTypes::where('order_type','Purchase order')->get();
            
            // service order types
            $serviceOrderTypes = OrderTypes::where('order_type','Service Order')->get();
            
            // ren/lease order types
            $rentleaseOrderTypes = OrderTypes::where('order_type','Rent/Lease Order')->get();
            
            // Accreditation options
            $Accreditations = Accreditation::where('is_active',1)->get();
            
            // Diversity Options
            $Diversityoptions = Diversity::where('is_active',1)->get();
            
            return view('home.quote')->with([
                                            'purchaseOrderTypes' => $purchaseOrderTypes,
                                            'serviceOrderTypes' => $serviceOrderTypes,
                                            'rentleaseOrderTypes' => $rentleaseOrderTypes,
                                            'Accreditations' => $Accreditations,
                                            'Diversityoptions' => $Diversityoptions,
                                            'request_quote' => $request_quote
                                            ]);
        }
        else{
            return Redirect::to('request-quote');
        }
    }
    
    /**
     * Register First Step
     */
    public function firstStepSingup(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
            ]);
        Session::forget('register_step_first');
        Session::put('register_step_first',$input);
        return Redirect::to('singup/select-industry');
    }
    
    /**
     * Register Second Step - User Type select View
     */
    public function secondStepSingup()
    {
        $registerFirstStep = Session::get('register_step_first');
        $industries = Industry::all();
        return view('home.select-industry')->with(['registerFirstStep'=>$registerFirstStep,'industries'=>$industries]);
    }
    
    /**
     * second stepdata save
     */
    public function secondStepSave(Request $request)
    {
        $this->validate($request, [
                //'main_industry' => 'required',
                'password' => 'required|confirmed|min:6',
            ]);
        $input = $request->all();
        Session::forget('register_step_two');
        Session::put('register_step_two',$input);
        return Redirect::to('singup/select-about');
    }
    
    /**
     * tell about your self view
     */
     public function thirdStepSingup()
     {
        return view('home.select-about');
     }
     
     /**
      * save about user
      */
     public function thirdStepSave(Request $request)
     {
        $input = $request->all();
        Session::forget('register_step_three');
        Session::put('register_step_three',$input);
        return Redirect::to('singup/select-account');
     }
     
     /**
      * user account selection
      */
     public function fourthStepSingup()
     {
        return view('home.select-account');
     }
    
    /**
     * Register user type select
     */
    public function selectUserType($id)
    {
        $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
        Session::forget('register_user_type');
        Session::put('register_user_type',$id);
        if($id == 4)
        {
            return Redirect::to('singup/add/company');
        }
        else
        {
            return Redirect::to('singup/company');   
        }   
    }
    
    /**
     * Register Company Select View
     */
    public function selectCompany()
    {
        return view('home.company');
    }
    
    /**
     * Register User Company Save
     */
    public function saveUserCompany()
    {
        Session::forget('user_company');
        Session::put('user_company',Input::get('user_company'));
        return Redirect::to('singup/user-picture');
    }
    
    /**
     * Register Add Company View
     */
    public function addCompany()
    {
        if(Session::get('register_user_type') == 4)
        {
            $registerFirstStep = Session::get('register_step_first');
            $email = $registerFirstStep['email'];
        }
        else
        {
            $email = '';  
        }
        return view('home.addCompany')->with(['email'=>$email]);
    }
    
    /**
     * Register Save New company Data
     */
    public function saveNewCompany(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
                'email' => 'required|email|max:255|unique:users',
            ]);
        $registerFirstStep = Session::get('register_step_first');
        if(Session::get('register_user_type') != 4)
        {
            if($registerFirstStep['email'] == $input['email'])
            {
                return Redirect::to('singup/add/company')->withErrors('Please use different email than '.$registerFirstStep['email']);
            }
            
        }
        Session::forget('user_company');
        Session::put('user_company','create');
        Session::forget('user_company_data');
        Session::put('user_company_data',$input);
        return Redirect::to('singup/company/auth');
    }
    
    /**
     * Register Company Auth
     */
    public function viewCompanyAuth()
    {
        return view('home.companyAuth');
    }
    
    /**
     * Register Company Owner Set
     */
    public function saveCompanyAuth($id)
    {
        Session::forget('company_owner');
        Session::put('company_owner',$id);
        return Redirect::to('singup/user-picture');
    }
    
    /**
     * Register User Picture View
     */
    public function viweUserPicture()
    {
        if(isset($_REQUEST['skip']))
        {
            Session::forget('user_company');
            Session::put('user_company',NULL);
        }
        $registerFirstStep = Session::get('register_step_first');
        $userType = Session::get('register_user_type');
        $userCompany = Session::get('user_company');
        if(Session::has('user_company_data'))
        {
            $companyData = Session::get('user_company_data');
        }
        else
        {
            $companyData = array();
        }
        return view('home.userPicture')->with(['registerFirstStep'=>$registerFirstStep]);
    }
    
    /**
     * Register Supplier Company - Industry
     */
    public function viewSupplierSelect()
    {
        return view('home.supplierSelection');
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
     * Search Product for add in quote
     */
    public function searchProducts()
    {
        if(isset($_GET['q']))
        {
            $search = $_GET['q'];
            $products = Product::whereRaw("(name LIKE '%$search%') AND is_active = 1 ")->get();
            $productArray = array();
            foreach($products as $product)
            {
                $dataArray = array();
                $dataArray['id'] = $product->id;
                $dataArray['full_name'] = $product->name;
                $productArray[] = $dataArray;
            }
        }
        else
        {
            $productArray = array();
        }
        
        $ajaxArray = array();
        $ajaxArray['incomplete_results'] = false;
        $ajaxArray['items'] = $productArray;
        return Response::json($ajaxArray);
    }
    
    /**
     * Search Industries for add in quote
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
     * Search Category for add in quote
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
     * Marketplace Products
     */
    public function marketplaceProducts()
    {
        $products = MarketplaceProducts::take(5)->orderBy('id','desc')->get();
        foreach($products as $product)
        {
            $product_id = $product->id;
            $image = MarketplaceProductGallery::where('product_id',$product_id)->first();
            if($image)
            {
                $product->image = $image->path;    
            }
            else
            {
                $product->image = '';
            }
            
        }
        return view('home.marketplace')->with(['products'=>$products]);
    } 
    
    /**
     * Supplier Buyer Profile
     */
    public function supplierBuyerProfile()
    {
        return view('home.profile');
    }
    
    /**
     * Company Page
     */
    public function companyProfile()
    {
        return view('home.companyprofile');
    }
    
    /**
     * List New product
     */
    public function listProduct()
    {
        return view('home.listnew');
    }
    
    /**
     * LinkedIn Login Url
     */
    public function LinkedInLoginUrl()
    {
        $redirect_uri = env('LINKEDIN_LOGIN_REDIRECT_URL', '');
        $client_id = env('LINKEDIN_CLIENT_ID', '');
        $client_secret = env('LINKEDIN_CLIENT_SECRETE', '');
        $LinkedLoginUrl = "https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=".$client_id."&redirect_uri=".$redirect_uri."&state=ab234aatdssda12345";
        $ajaxArray = array();
        $ajaxArray['url'] = $LinkedLoginUrl;
        return Response::json($ajaxArray);
    }
    
    /**
     * LinkedIn Login
     */
    public function LinkedInLogin()
    {
        $redirect_uri = env('LINKEDIN_LOGIN_REDIRECT_URL', '');
        $client_id = env('LINKEDIN_CLIENT_ID', '');
        $client_secret = env('LINKEDIN_CLIENT_SECRETE', '');
        
        
        if(Input::has('code'))
        {
            $code = Input::get('code');
            
            /// for get accesstoken
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://www.linkedin.com/uas/oauth2/accessToken");
            curl_setopt($ch, CURLOPT_POST, 5); // number of post parameters
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                        "code=".$code."&client_id=".$client_id."&redirect_uri=".$redirect_uri."&grant_type=authorization_code&client_secret=".$client_secret);
            
            // receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $server_output = curl_exec ($ch);
            curl_close ($ch);
            
            if($server_output === false)
            {
                return Redirect::to('/')->withErrors('LinkedIn Login Faild Try again.');
            }
            else
            {
                $result = json_decode($server_output, true);
                
                $access_token = $result['access_token'];
                
                if($access_token != '')
                {
                    // for get customer email
                    $datach = curl_init();  
                    $authorization = 'Authorization: Bearer '.$access_token;
                    curl_setopt($datach,CURLOPT_URL,'https://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name)?format=json');
                    curl_setopt($datach,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($datach, CURLOPT_HTTPHEADER, array($authorization));
                 
                    $output=curl_exec($datach);
                 
                    curl_close($datach);
                    if($output === false)
                    {
                        return Redirect::to('/')->withErrors('LinkedIn Login Faild Try again.');
                    }
                    else{
                        $Profileresult = json_decode($output, true);
                        $email = $Profileresult['emailAddress'];
                        $user = User::where('email',$email)->first();
                        if($user)
                        {
                            
                            Auth::login($user);
                            if($user->access_level == 1)
                            {
                                return Redirect::to('sa');
                            }
                            else
                            {
                                return Redirect::to('user-dashboard');
                            }
                        }
                        else
                        {
                            return Redirect::to('/')->withErrors('LinkedIn Login Faild Try again for .'.$email);
                        }
                    }    
                }   
            }
        }
        return Redirect::to('/')->withErrors('LinkedIn Login Faild Try again.');
    }
    
    /**
     * 404 page not found
     */
    public function viewPageNotFound()
    {
        $industries = Industry::all();
        return view('home.404')->with(['industries'=>$industries]);
    }
    
    /**
     * User frontend view
     */
    public function viewUserDetail($external_url)
    {
        $industries = Industry::all();
        $user = User::where('external_url',$external_url)->first();
        if($user)
        {
            // first check user logged in or not
            
            // if user logged in than internal url redirect
            if (Auth::check())
            {
                return Redirect::to('home/user/profile/'.$user->id);
            }
            
            $userData = UserDetails::where('user_id',$user->id)->first();
            
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
                $coworkers = UserDetails::whereRaw('company_id = ? AND user_id != ?',array($UserCompany,$user->id))->get()->toArray();
                
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
            $products = MarketplaceProducts::where('user_id',$user->id)->paginate(10);
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
            $contacts = ContactUsers::whereRaw('sender_user_id = ? AND status = ?',array($user->id,1))->get();
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

        
            return view('external.view-user-detail')->with([
                                                'user'=>$user,
                                                'userData'=>$userData,
                                                'current_user_id'=>$user->id,
                                                'endorsements'=>$endorsements,
                                                'contacts'=>$contacts,
                                                'feedbacks'=>$feedbacks,
                                                'coworkers'=>$coworkers,
                                                'reviews' => $reviews,
                                                'products'=>$products,
                                                'company'=>$UserCompany,
                                                'item_specifics_value'=>$item_specifics_value,
                                                'industries'=>$industries
                                                ]);
        }
        else
        {
            return Redirect::to('/page-not-found');
        }        
    }
    
    /**
     * Company frontend view
     */
    public function viewCompanyDetail($external_url)
    {
        $industries = Industry::all();
        $company = Company::where('external_url',$external_url)->first();
        if($company)
        {
            // first check user logged in or not
            
            // if user logged in than internal url redirect
            if (Auth::check())
            {
                return Redirect::to('company/profile/'.$company->id);
            }
            
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
            $products = MarketplaceProducts::where('company_id',$company->id)->paginate(10);
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
    
            // reviews
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
    
            return view('external.view-company-detail')->with([
                'company'=>$company,
                'products'=>$products,
                'payment_str'=>$payment_str,
                'endorsements'=>$endorsements,
                'reviews' => $reviews,
                'industries'=>$industries
            ]);
        }
        else
        {
            return Redirect::to('/page-not-found');
        }        
    }
    
    /**
     * Product frontend view
     */
    public function viewProductDetail($external_url)
    {
        $industries = Industry::all();
        $marketplaceproduct = MarketplaceProducts::where('external_url',$external_url)->first();
        if($marketplaceproduct)
        {
            // first check user logged in or not
            
            // if user logged in than internal url redirect
            if (Auth::check())
            {
                return Redirect::to('marketplaceproducts/'.$marketplaceproduct->id);
            }
            
            $payment_accepted = $marketplaceproduct->payment_accepted;
            $marketplaceproduct->payment_accepted = explode(',',$payment_accepted);
            
            $free_shipping_continents = $marketplaceproduct->free_shipping_continents;
            $marketplaceproduct->free_shipping_continents = explode(',',$free_shipping_continents);
            
            if($marketplaceproduct->item_specifics_value != ''){
                if(@unserialize($marketplaceproduct->item_specifics_value))
                {
                    $item_specifics_value = unserialize($marketplaceproduct->item_specifics_value);
                    if(!empty($item_specifics_value))
                    {
                        $marketplaceproduct->specification = $item_specifics_value;
                        $marketplaceproduct->options_count = count($marketplaceproduct->specification);
                        
                    }
                    else
                    {
                        $marketplaceproduct->specification = array();
                        $marketplaceproduct->options_count = 1;
                    }
                }
                else
                {
                    $marketplaceproduct->specification = array();
                    $marketplaceproduct->options_count = 1;
                }
                
            }else{
                $marketplaceproduct->specification = array();
                $marketplaceproduct->options_count = 1;
            }
            
            $seller_user_id = $marketplaceproduct->user_id;
            $sellerUser = User::find($seller_user_id);
            if($sellerUser->account_member = 'gold')
            {
                $sellerUser->star = 'gold';
            }
            elseif($sellerUser->account_member = 'silver')
            {
                $sellerUser->star = 'silver';
            }
            else
            {
                $sellerUser->star = 'none';
            }
            $sellerUser->review_count = count($sellerUser->reviews);
            $sellerUser->endorse_count = count($sellerUser->endorsements);
            $sellerUser->message_count = count($sellerUser->messages);
            $SellerUserData = UserDetails::where('user_id',$seller_user_id)->first();
            $sellerUser->products = MarketplaceProducts::whereRaw('user_id = ? AND is_active = ?',array($seller_user_id,1))->paginate(10);
            $company_id = $SellerUserData->company_id;
            if($company_id != '')
            {
                $company = Company::find($company_id);
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
                $sellerUser->company = $company;
            }
            else
            {
                $company = new Company;
                $company->star = 'none';
                $sellerUser->company = $company;
                $coworkers = array();
            }
            
            $marketplaceproduct->totalProducts = MarketplaceProducts::where('user_id',$sellerUser->id)->count();
            
            return view('external.view-product-detail')->with(['product'=>$marketplaceproduct,'sellerUser'=>$sellerUser,'industries'=>$industries]);
        }
        else
        {
            return Redirect::to('/page-not-found');
        }        
    }
    
    /**
     * Job frontend view
     */
    public function viewJobDetail($external_url)
    {
        $industries = Industry::all();
        $job = Jobs::where('external_url',$external_url)->first();
        if($job)
        {
            // first check user logged in or not
            
            // if user logged in than internal url redirect
            if (Auth::check())
            {
                return Redirect::to('job/view/'.$job->id);
            }
            
            $user = User::find($job->user_id);
            
            // skills
            if($job->skills_expertise != ''){
                if(@unserialize($job->skills_expertise))
                {
                    $item_specifics_value = unserialize($job->skills_expertise);
                    if(!empty($item_specifics_value))
                    {
                        $job->specification = $item_specifics_value;
                    }
                    else
                    {
                        $job->specification = array();
                    }
                }
                else
                {
                    $job->specification = array();
                }
                
            }else{
                $job->specification = array();
            }
            
            $company_id = $user->userdetail->company_id;
            if($company_id != '')
            {
                $UserCompany = Company::find($company_id);
                $UserCompany->user = User::find($UserCompany->user_id);
                $user->company = $UserCompany;
                $coworkers = UserDetails::whereRaw('company_id = ? AND user_id != ?',array($UserCompany,$user->id))->get()->toArray();
            }
            else
            {
                $UserCompany = new Company;
                $user->company = $UserCompany;
                $coworkers = array();
            }
            
            // get similar jobs of current
            $similarJobs = Jobs::getSimilarJob($job->id);
            foreach($similarJobs as $sm_job)
            {
                $jobUser = User::find($sm_job->user_id);
                $company_id = $jobUser->userdetail->company_id;
                if($company_id != '')
                {
                    $UserCompany = Company::find($company_id);
                    $UserCompany->user = User::find($UserCompany->user_id);
                    $sm_job->company = $UserCompany;
                }
                else
                {
                    $UserCompany = new Company;
                    $sm_job->company = $UserCompany;
                }
            }
            
            // more jobs posted by same user
            $moreJobs = Jobs::where('user_id',$job->user_id)->whereNotIn('id',array($job->id))->orderBy('id','desc')->take(6)->get();
            foreach($moreJobs as $moreJob)
            {
                $jobUser = User::find($sm_job->user_id);
                $company_id = $jobUser->userdetail->company_id;
                if($company_id != '')
                {
                    $UserCompany = Company::find($company_id);
                    $UserCompany->user = User::find($UserCompany->user_id);
                    $moreJob->company = $UserCompany;
                }
                else
                {
                    $UserCompany = new Company;
                    $moreJob->company = $UserCompany;
                }
            }
            
            return view('external.view-job-detail')->with(['job'=>$job,'user'=>$user,'industries'=>$industries,'company'=>$UserCompany,'similar_jobs'=>$similarJobs,'moreJobs'=>$moreJobs]);
        }
        else
        {
            return Redirect::to('/page-not-found');
        }        
    }
    
    public function emailVerificationSend(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:users|unique:singup_email_verification',
        ]);
        $verification_code = $this->randomCode();
        $referral_code = '';
        if(Input::has('referral_singup'))
        {
            $referral_code = $input['referral_singup'];
        }
        
        $singupemail = new SingupEmailVerification;
        $singupemail->email = $input['email'];
        $singupemail->verification_code = $verification_code;
        $singupemail->referral_code = $referral_code;
        $singupemail->expiry_date = date('Y-m-d');
        $singupemail->status = 1;
        $singupemail->save();
        $url = url('verification/link').'/'.$verification_code.'?email='.$input['email'].'&industry='.$input['industry'];
        $data = array('name'=>'User','url'=>$url);
        Input::replace(array('email' => $input['email'],'name'=>'User'));
        Mail::send('admin.Emailtemplates.SingupEmailVerification', $data, function($message){
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to(Input::get('email'), Input::get('name'))->subject('Indy John E-mail Verification');
        });
       return Redirect::to('/?sendemail=1&email='.$input['email']); 
    }
    
    /**
     * resend verification link
     */
    public function emailResendVerificationLink()
    {
        if(isset($_REQUEST['email']))
        {
            $email = $_REQUEST['email'];
            $singupemail = SingupEmailVerification::where('email',$email)->first();
            if($singupemail)
            {
                $url = url('verification/link').'/'.$singupemail->verification_code.'?email='.$singupemail->email;
                $data = array('name'=>'User','url'=>$url);
                Input::replace(array('email' => $email,'name'=>'User'));
                Mail::send('admin.Emailtemplates.SingupEmailVerification', $data, function($message){
                    $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                    $message->to(Input::get('email'), Input::get('name'))->subject('Indy John E-mail Verification');
                });
               return Redirect::to('/?sendemail=1&email='.$email);    
            }
            
        }
        return Redirect::to('/');
    }
    
    /**
     * email verification
     */
    public function emailVerificationLink($code)
    {
        $email = $_REQUEST['email'];

        if(isset($_REQUEST['email']) && isset($_REQUEST['teamId']) && ($_REQUEST['type']))
        {
            $teamId = $_REQUEST['teamId'];
            $type = $_REQUEST['type'];
            Session::forget('teamType');
            Session::forget('teamId');
            Session::put('teamType',$type);
            Session::put('teamId',$teamId);
            if($type == "Purchasing"){
                return redirect('/?verify=1&email='.$email.'&type=Purchasing&teamId='.$teamId);
            }else{
                return redirect('/?verify=1&email='.$email.'&type=Supplying&teamId='.$teamId);
            }

        }
        else if(isset($_REQUEST['email']))
        {
            $industry = $_REQUEST['industry'];
            $singupemail = SingupEmailVerification::whereRaw('email = ? AND verification_code = ?',array($email,$code))->first();
            if($singupemail)
            {
                $referral_code = '';
                $referral_code = $singupemail->referral_code;
                // for check referral code available or not
                if($referral_code != '')
                {
                    return Redirect::to('/?verify=1&email='.$email.'&referral='.$referral_code.'&industry='.$industry);
                }
                else
                {
                    return Redirect::to('/?verify=1&email='.$email.'&industry='.$industry);
                }
            }
        }
        return Redirect::to('/');
    }
    
    /**
     * View Quick Demo
     */
    public function viewQuickDemo()
    {
        return view('quickdemo.buyer-dashboard');
    }
    
    /**
     * Indy Grid
     */
    public function viewIndyGrid()
    {
        $industries = Industry::all();
        if(isset($_REQUEST['company_code']))
        {
            Session::put('company_code',$_REQUEST['company_code']);
        }
        
        return view('home.indygrid')->with(['industries'=>$industries]);
        
    }
}
