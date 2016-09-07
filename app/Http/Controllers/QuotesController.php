<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Quotes;

use App\QuoteDefaultAccreditations;

use App\QuoteDefaultDiversityOptions;

use App\QuoteDefaultSettings;

use App\UserDetails;

use App\User;

use App\OrderTypes;

use App\Company;

use App\QuoteUnique;

use App\CompanyIndustries;

use App\Product;

use App\AppsCountries;

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

use App\QuoteTypeServices;

use App\QuoteTypeConsumableSuppliers;

use App\QuoteTypeEquipment;

use App\QuoteTypeMaterialsTooling;

use App\QuoteTypeSoftware;

use App\QuoteDiversity;

use App\SupplierIgnoreQuotes;

use App\UsersActivity;

use App\SupplierLeads;

use App\SupplierLeadCategories;

use App\SupplierLeadIndustries;

use App\Endorsements;

use App\SubscriptionPlans;

use App\Subscriptions;

use App\Reviews;

use App\QuoteNotes;

use App\SupplierQuotes;

use App\SupplierQuoteItems;

use App\BuyerIgnoreQuotes;

use App\TechnicalSpecificationOptions;



use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Route;

use Input;

use Auth;

use Response;

use Session;

use Mail;


class QuotesController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $user_id = Auth::user()->id;


        $userCreatedDate = date('Y-m-d', strtotime(Auth::user()->created_at));
        $currentDate = date('Y-m-d');


        $userData = UserDetails::where('user_id',$user_id)->first();

        if($userData == '')

        {

            $userData = new UserDetails();

            $userData->account_type = '';

            $userData->user_id = $user_id;

            $userData->company_id = '';

        }

        $user_access_level = Auth::user()->access_level;

        if(Session::get('sellerquote_order_name') != '')

        {

            if(isset($_REQUEST['sellerquote_order_name']))

            {

                $order_name = $_REQUEST['sellerquote_order_name'];

                $order_by = $_REQUEST['sellerquote_order_by'];

                $hidden_val = $order_by;

                Session::put('sellerquote_order_name', $order_name);

                Session::put('sellerquote_order_by', $order_by);

                Session::put('sellerquote_hidden_val', $hidden_val);

                Session::put('sellerquote_hidden_name', $order_name);

            }

        }

        else

        {

            $order_name = 'created_at';

            $order_by = 'desc';

            $hidden_val = 'desc';

            $hidden_name = 'created_at';

            Session::put('sellerquote_order_name', $order_name);

            Session::put('sellerquote_order_by', $order_by);

            Session::put('sellerquote_hidden_val', $hidden_val);

            Session::put('sellerquote_hidden_name', $hidden_name);

        }



        $order_name = Session::get('sellerquote_order_name');

        $order_by = Session::get('sellerquote_order_by');

        $hidden_val = Session::get('sellerquote_hidden_val');

        $hidden_name = Session::get('sellerquote_hidden_name');

        // supplier Leads
        if(isset($_REQUEST['lead']))
        {
            if($_REQUEST['lead'] == 'all')
            {
                $supplierLeads = SupplierLeads::where('created_by',$user_id)->orderBy('id','desc')->get();
            }
            else
            {
                $supplierLeads = SupplierLeads::whereRaw('id = ? AND created_by = ? ',array($_REQUEST['lead'],$user_id))->orderBy('id','desc')->get();
            }
        }
        else
        {
            $supplierLeads = SupplierLeads::where('created_by',$user_id)->orderBy('id','desc')->get();
        }
        $allSupplierLeads = SupplierLeads::where('created_by',$user_id)->orderBy('id','desc')->get();


        if($order_name != 'hidden_quotes')

        {


            // Seller Ignore quote filter

            $SupplierIgnoreQuotes = SupplierIgnoreQuotes::where('supplier_id',$user_id)->get();

            $result = array();

            foreach($SupplierIgnoreQuotes as $ignoreQoute)

            {

                $result[] = $ignoreQoute['quote_id'];

            }



            // Seller own quote filter

            $Sellerquotes = Quotes::where('created_by',$user_id)->get();

            foreach($Sellerquotes as $sellerQt)

            {

                $result[] = $sellerQt['id'];

            }



            $result = array_unique($result);


            // quote filter by industries & Categories of seller Leads

            $supplieIndustries = array();

            $supplieCategories = array();

            foreach($supplierLeads as $supplierLead)

            {

                $leadIndustries = SupplierLeadIndustries::where('supplier_lead_id',$supplierLead->id)->get();

                foreach($leadIndustries as $leadindustry)

                {

                    $supplieIndustries[] = $leadindustry->industry_id;

                }



                $leadCategories = SupplierLeadCategories::where('supplier_lead_id',$supplierLead->id)->get();

                foreach($leadCategories as $leadCategory)

                {

                    $supplieCategories[] = $leadCategory->category_id;

                }

            }

            $supplieIndustries = array_unique($supplieIndustries);

            $supplieCategories = array_unique($supplieCategories);

            /// Quote By Categories
            $quoteByLeadsArray = array();

            if(!empty($supplieCategories))

            {

                foreach($supplieCategories as $category)

                {

                    $quoteDatas = '';

                    $quoteDatas = QuoteCategories::where('category_id',$category)->get();

                    foreach($quoteDatas as $quoteData)

                    {

                        $quoteByLeadsArray[] = $quoteData->quote_id;

                    }

                }



            }

            if(!empty($quoteByLeadsArray))

            {

                $quoteByLeadsArray = array_unique($quoteByLeadsArray);

            }
            $finalQuotesLeadsArray = array();
            foreach($quoteByLeadsArray as $quote_id){
                $industryCount = QuoteIndustries::where('quote_id',$quote_id)->whereIn('industry_id', $supplieIndustries)->count();
                if($industryCount > 0){
                    $finalQuotesLeadsArray[] = $quote_id;
                }
            }


            $quoteByLeadsArray = $finalQuotesLeadsArray;

            //echo"<pre>"; print_r($quoteByLeadsArray); exit(0);
            if(!empty($quoteByLeadsArray))

            {

                $quoteByLeadsArray = array_unique($quoteByLeadsArray);

            }

            $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->get();


            /// check for verify

            $veryfyArray = array();

            foreach($quotes as $quote)

            {

                if($quote->verified_only == 1)

                {

                    $veryfyArray[] = $quote->id;

                }

            }



            if(Auth::user()->quotetek_verify != 1)

            {
                $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->whereNotIn('id',$veryfyArray)->where('created_at','>',$userCreatedDate)->orderBy($order_name, $order_by)->paginate(15);

            }

            else{
                $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->where('created_at','>=',$userCreatedDate)->orderBy($order_name, $order_by)->paginate(15);

            }

            foreach($quotes as $quote)

            {

                $created_by = $quote->created_by;



                $buyer_id = $created_by;

                $quote->buyer = User::find($buyer_id);

                $quote->buyerUser = UserDetails::where('user_id',$buyer_id)->first();

                if($quote->buyerUser->company_id != '')

                {

                    $quote->buyerCompany = Company::find($quote->buyerUser->company_id);

                }

                else

                {

                    $quote->buyerCompany = '';

                }



                if($quote->buyerUser->account_member == 'gold')

                {

                    $quote->star = 'gold';

                }

                elseif($quote->buyerUser->account_member == 'silver')

                {

                    $quote->star = 'silver';

                }

                else

                {

                    $quote->star = 'none';

                }



                // Quote Privvacy option

                $privacy = $quote->privacy;

                if($privacy != 0)

                {

                    $privacryOptionArray = array('1' => 'All Visitors on the Web','2' => 'All Free and Premium Suppliers', '3' => 'Premium Suppliers Only');

                    foreach($privacryOptionArray as $key=>$privacyVal)

                    {

                        if($key == $privacy)

                        {

                            $quote->privacy = $privacyVal;

                        }

                    }

                }

                else

                {

                    $quote->privacy = 'N/A';

                }



                $request_area = $quote->request_area;

                if($request_area != 0)

                {

                    $areaOptionArray = array('1' => 'Local','2' => 'State', '3' => 'Country' , '4' => 'International', '5' => 'WorldWide');

                    foreach($areaOptionArray as $key=>$areaVal)

                    {

                        if($key == $request_area)

                        {

                            $quote->request_area = $areaVal;

                        }

                    }

                }

                else

                {

                    $quote->request_area = 'N/A';

                }

                /// Endorsement Count

                $quote->endorsement = count(Endorsements::where('receiver_id',$buyer_id)->get());



                /// Review Count

                $reviewCount = count(Reviews::where('receiver_id',$buyer_id)->get());

                $totalStarts = Reviews::where('receiver_id',$buyer_id)->sum('stars');

                if($reviewCount > 0)

                {

                    $quote->reviews = ($totalStarts/$reviewCount);

                }

                else

                {

                    $quote->reviews = 0;

                }

            }

        }

        else

        {
            $SupplierIgnoreQuotes = SupplierIgnoreQuotes::where('supplier_id',$user_id)->get();

            $result = array();

            foreach($SupplierIgnoreQuotes as $ignoreQoute)

            {

                $result[] = $ignoreQoute['quote_id'];

            }



            $quotes = Quotes::whereIn('id',$result)->where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->orderBy('id', $order_by)->paginate(15);

            foreach($quotes as $quote)

            {

                $created_by = $quote->created_by;



                $buyer_id = $created_by;

                $quote->buyer = User::find($buyer_id);

                $quote->buyerUser = UserDetails::where('user_id',$buyer_id)->first();

                if($quote->buyerUser->company_id != '')

                {

                    $quote->buyerCompany = Company::find($quote->buyerUser->company_id);

                }

                else

                {

                    $quote->buyerCompany = '';

                }



                // Quote Privvacy option

                $privacy = $quote->privacy;

                if($privacy != 0)

                {

                    $privacryOptionArray = array('1' => 'All Visitors on the Web','2' => 'All Free and Premium Suppliers', '3' => 'Premium Suppliers Only');

                    foreach($privacryOptionArray as $key=>$privacyVal)

                    {

                        if($key == $privacy)

                        {

                            $quote->privacy = $privacyVal;

                        }

                    }

                }

                else

                {

                    $quote->privacy = 'N/A';

                }



                $request_area = $quote->request_area;

                if($request_area != 0)

                {

                    $areaOptionArray = array('1' => 'Local','2' => 'State', '3' => 'Country' , '4' => 'International', '5' => 'WorldWide');

                    foreach($areaOptionArray as $key=>$areaVal)

                    {

                        if($key == $request_area)

                        {

                            $quote->request_area = $areaVal;

                        }

                    }

                }

                else

                {

                    $quote->request_area = 'N/A';

                }



                /// Endorsement Count

                $quote->endorsement = count(Endorsements::where('receiver_id',$buyer_id)->get());



                /// Review Count

                $reviewCount = count(Reviews::where('receiver_id',$buyer_id)->get());

                $totalStarts = Reviews::where('receiver_id',$buyer_id)->sum('stars');

                if($reviewCount > 0)

                {

                    $quote->reviews = ($totalStarts/$reviewCount);

                }

                else

                {

                    $quote->reviews = 0;

                }



            }

        }


        //check here for expiry date

        $finalQuotesArray = array();
        foreach($quotes as $quote){
            if($quote->expiry_date == '0000-00-00'){
                $finalQuotesArray[] = $quote;
                continue;
            }else if($quote->expiry_date >= $currentDate){
                $finalQuotesArray[] = $quote;
            }
        }


        $previousPageUrl = $quotes->previousPageUrl();//previous page url

        $nextPageUrl = $quotes->nextPageUrl();//next page url

        $lastPage = $quotes->lastPage(); //Gives last page number

        $total = $quotes->total();

        return view('quotes.index')->with([

            'quotes'=>$finalQuotesArray,

            'previousPageUrl'=>$previousPageUrl,

            'nextPageUrl'=>$nextPageUrl,

            'lastPage'=>$lastPage,

            "total"=>$total,

            'user_access_level'=>$user_access_level,

            'userData'=>$userData,

            'sellerquote_hidden_val' => $hidden_val,

            'sellerquote_hidden_name' => $hidden_name,

            'supplierLeads'=>$allSupplierLeads

        ]);

    }



    /**

     * View Buy Requestes

     */

    public function viewBuyRequest()

    {

        $user_id = Auth::user()->id;

        $userData = UserDetails::where('user_id',$user_id)->first();

        if($userData == '')

        {

            $userData = new UserDetails();

            $userData->account_type = '';

            $userData->user_id = $user_id;

            $userData->company_id = '';

        }

        if($userData->company_id != '')

        {

            $company = Company::find($userData->company_id);

        }

        else

        {

            $company = '';

        }

        $user_access_level = Auth::user()->access_level;

        if(Session::get('quote_order_name') != '')

        {

            if(isset($_REQUEST['quote_order_name']))

            {

                $order_name = $_REQUEST['quote_order_name'];

                $order_by = $_REQUEST['quote_order_by'];

                $hidden_val = $order_by;

                Session::put('quote_order_name', $order_name);

                Session::put('quote_order_by', $order_by);

                Session::put('quote_hidden_val', $hidden_val);

                Session::put('quote_hidden_name', $order_name);

            }

        }

        else

        {

            $order_name = 'created_at';

            $order_by = 'desc';

            $hidden_val = 'desc';

            $hidden_name = 'created_at';

            Session::put('quote_order_name', $order_name);

            Session::put('quote_order_by', $order_by);

            Session::put('quote_hidden_val', $hidden_val);

            Session::put('quote_hidden_name', $hidden_name);

        }



        $order_name = Session::get('quote_order_name');

        $order_by = Session::get('quote_order_by');

        $hidden_val = Session::get('quote_hidden_val');

        $hidden_name = Session::get('quote_hidden_name');

        $userCreatedDate = date('Y-m-d', strtotime(Auth::user()->created_at));
        $currentDate = date('Y-m-d');

        //$countReceivedQuotes = Quotes::where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->where('created_by',$user_id)->orderBy($order_name, $order_by)->count();

        $quotes = Quotes::where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->where('created_by',$user_id)->orderBy($order_name, $order_by)->paginate(5);

        foreach($quotes as $quote)

        {
            //$quote->countReceivedQuotes = SupplierQuotes::where('buyer_quote_id',$quote->id)->count();

            $created_by = $quote->created_by;

            $buyerData = UserDetails::where('user_id',$created_by)->first();

            if($buyerData->company_id != '')

            {

                $buyerCompnay = Company::find($buyerData->company_id);

                $quote->companyname = $buyerCompnay->name;

            }

            else

            {

                $quote->companyname = '';

            }



            $quote->buyername = $buyerData->first_name.' '.$buyerData->last_name;

            // Quote Privvacy option

            $privacy = $quote->privacy;

            if($privacy != 0)

            {

                $privacryOptionArray = array('1' => 'All Visitors on the Web','2' => 'All Free and Premium Suppliers', '3' => 'Premium Suppliers Only');

                foreach($privacryOptionArray as $key=>$privacyVal)

                {

                    if($key == $privacy)

                    {

                        $quote->privacy = $privacyVal;

                    }

                }

            }

            else

            {

                $quote->privacy = 'N/A';

            }



            // Quote request area option

            $request_area = $quote->request_area;

            if($request_area != 0)

            {

                $areaOptionArray = array('1' => 'Local','2' => 'State', '3' => 'Country' , '4' => 'International', '5' => 'WorldWide');

                foreach($areaOptionArray as $key=>$areaVal)

                {

                    if($key == $request_area)

                    {

                        $quote->request_area = $areaVal;

                    }

                }

            }

            else

            {

                $quote->request_area = 'N/A';

            }



        }

        //exit(0);

        $previousPageUrl = $quotes->previousPageUrl();//previous page url

        $nextPageUrl = $quotes->nextPageUrl();//next page url

        $lastPage = $quotes->lastPage(); //Gives last page number

        $total = $quotes->total();

        return view('quotes.viewBuyRequests')->with([

            'quotes'=>$quotes,

            'previousPageUrl'=>$previousPageUrl,

            'nextPageUrl'=>$nextPageUrl,

            'lastPage'=>$lastPage,

            "total"=>$total,

            'user_access_level'=>$user_access_level,

            'userData'=>$userData,

            'quote_hidden_val' => $hidden_val,

            'quote_hidden_name' => $hidden_name

        ]);

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

        $userData = UserDetails::where('user_id',$user_id)->first();

        if($userData == '')

        {

            $userData = new UserDetails();

            $userData->account_type = '';

            $userData->user_id = $user_id;

            $userData->company_id = '';

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



        // purchase order types

        $purchaseOrderTypes = OrderTypes::where('order_type','Purchase order')->get();



        // Equipment order types

        $equipmentOrderTypes = OrderTypes::where('order_type','Equipment')->get();



        // service order types

        $serviceOrderTypes = OrderTypes::where('order_type','Service Order')->get();



        // MaterialsTooling order types

        $materialsToolingOrderTypes = OrderTypes::where('order_type','MaterialsTooling')->get();



        // services order types

        $servicesOrderTypes = OrderTypes::where('order_type','Services')->get();



        // Software order types

        $softwareOrderTypes = OrderTypes::where('order_type','Software')->get();



        // ConsumableSuppliers order types

        $consumableSuppliersOrderTypes = OrderTypes::where('order_type','ConsumableSuppliers')->get();



        // ren/lease order types

        $rentleaseOrderTypes = OrderTypes::where('order_type','Rent/Lease Order')->get();



        $user_id = Auth::user()->id;

        $SettingArray = array();



        $defaultSettings = QuoteDefaultSettings::where('user_id',$user_id)->first();



        if($defaultSettings)

        {

            $SettingArray['privacy'] = $defaultSettings->privacy;

            $SettingArray['request_area'] = $defaultSettings->request_area;

            $SettingArray['specifications'] = $defaultSettings->specifications;

            $SettingArray['address'] = $defaultSettings->address;

            $SettingArray['address2'] = $defaultSettings->address2;

            $SettingArray['city'] = $defaultSettings->city;

            $SettingArray['state'] = $defaultSettings->state;

            $SettingArray['zip'] = $defaultSettings->zip;

            $SettingArray['country'] = $defaultSettings->country;

        }

        else{

            $SettingArray['privacy'] = '';

            $SettingArray['request_area'] = '';

            $SettingArray['specifications'] = '';

            $SettingArray['address'] = '';

            $SettingArray['address2'] = '';

            $SettingArray['city'] = '';

            $SettingArray['state'] = '';

            $SettingArray['zip'] = '';

            $SettingArray['country'] = '';

        }



        $quoteDefaultAccreditations = QuoteDefaultAccreditations::where('user_id',$user_id)->get();

        if($quoteDefaultAccreditations)

        {

            foreach($quoteDefaultAccreditations as $quoteDefaultAccreditation)

            {

                $dataArray = array();

                $accredition = Accreditation::find($quoteDefaultAccreditation->accreditation_id);

                $dataArray['id'] = $accredition->id;

                $dataArray['name'] = $accredition->name;

                $SettingArray['default_acccreditations'][] = $dataArray;

            }



        }

        else{

            $dataArray = array();

            $SettingArray['default_cccreditations'][] = $dataArray;

        }



        $quoteDefaultDiversityOptions = QuoteDefaultDiversityOptions::where('user_id',$user_id)->get();

        if($quoteDefaultDiversityOptions)

        {

            $diversityResult = array();

            foreach($quoteDefaultDiversityOptions as $quoteDefaultDiversityOption)

            {

                $dataArray = array();

                $diversity = Diversity::find($quoteDefaultDiversityOption->diversity_options_id);

                $dataArray['id'] = $diversity->id;

                $dataArray['name'] = $diversity->name;

                $diversityResult[] = $diversity->id;

                $SettingArray['default_diversity'][] = $dataArray;

            }

            $SettingArray['all_diversity'] = Diversity::whereNotIn('id',$diversityResult)->get();

        }

        else{

            $dataArray = array();

            $SettingArray['default_diversity'][] = $dataArray;

            $SettingArray['all_diversity'] = Diversity::all();

        }

        $industries = Industry::all();

        $countries = AppsCountries::all();

        return view('quotes.create')->with([

            'userData'=>$userData,

            'countries'=>$countries,

            'purchaseOrderTypes' => $purchaseOrderTypes,

            'serviceOrderTypes' => $serviceOrderTypes,

            'rentleaseOrderTypes' => $rentleaseOrderTypes,

            'default' => $SettingArray,

            'industries' => $industries,

            'equipmentOrderTypes'=>$equipmentOrderTypes,

            'materialsToolingOrderTypes'=>$materialsToolingOrderTypes,

            'servicesOrderTypes'=>$servicesOrderTypes,

            'softwareOrderTypes'=>$softwareOrderTypes,

            'consumableSuppliersOrderTypes' => $consumableSuppliersOrderTypes

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

        $this->validate($request, [

            'categories' => 'required',

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



        if($input['title'] == '')

        {

            $title = '';

            if(Input::has('categories'))

            {

                $catcount = 0;

                foreach(Input::get('categories') as $category)

                {

                    $categoryObj = Category::find($category);

                    $catcount++;

                    if($catcount < 3)

                    {

                        if($catcount == 1)

                        {

                            $title = $categoryObj->name;

                        }

                        else

                        {

                            $title .= ' and '.$categoryObj->name;

                        }

                    }

                }

            }

            $input['title'] = $title;

        }



        $SpecificationArray = array();



        if(!empty($input['specification']))

        {

            $allSpecifications = explode(',',$input['specification']);

            foreach($allSpecifications as $specification)

            {

                if($specification != '')

                {

                    $dataArray = array();

                    $opt = TechnicalSpecificationOptions::where('keyword',$specification)->first();

                    if($opt)

                    {

                        $dataArray['id'] = $opt->id;

                        $dataArray['keyword'] = $opt->keyword;

                    }

                    else

                    {

                        $newOpt = new TechnicalSpecificationOptions;

                        $newOpt->keyword = $specification;

                        $newOpt->save();

                        $dataArray['id'] = $newOpt->id;

                        $dataArray['keyword'] = $newOpt->keyword;

                    }

                    $SpecificationArray[] = $dataArray;

                }

            }

        }



        $serialized_array=serialize($SpecificationArray);

        $input['specifics_value'] = $serialized_array;



        $unique = QuoteUnique::first();

        $next = $unique->number+1;

        $unique->number = $next;

        $unique->save();



        $input['unique_number'] = 'IJB-'.$next;



        $quotes = Quotes::create($input);



        $quotes_id = $quotes->id;



        if($input['other_diversity'] != '')

        {

            $otherDiversities = explode(',',$input['other_diversity']);

            foreach($otherDiversities as $otherDiversity)

            {

                $diversity = new Diversity;

                $diversity->name = $otherDiversity;

                $diversity->is_active = 1;

                $diversity->save();

                $input['diversity_options'][] = $diversity->id;

            }

        }



        if($input['other_accreditation'] != '')

        {

            $otherAccreditations = explode(',',$input['other_accreditation']);

            foreach($otherAccreditations as $otherAccreditation)

            {

                $accreditation = new Accreditation;

                $accreditation->name = $otherAccreditation;

                $accreditation->is_active = 1;

                $accreditation->save();

                $input['accredations'][] = $accreditation->id;

            }

        }



        /// quote diversity value set

        if(key_exists('diversity_options',$input))

        {

            foreach($input['diversity_options'] as $diversityOption)

            {

                $QuoteDiversity = new QuoteDiversity();

                $QuoteDiversity->quote_id = $quotes_id;

                $QuoteDiversity->diversity_option_id = $diversityOption;

                $QuoteDiversity->save();

            }

        }



        /// quote accreditations value set

        if(key_exists('accredations',$input))

        {

            foreach($input['accredations'] as $accreditation_id)

            {

                $QuoteAccreditation = new QuoteAccreditation();

                $QuoteAccreditation->quote_id = $quotes_id;

                $QuoteAccreditation->accreditations_id = $accreditation_id;

                $QuoteAccreditation->save();

            }

        }



        /// quote products value set

        if(Input::has('products'))

        {

            foreach(Input::get('products') as $product)

            {

                $QuoteProducts = new QuoteProducts();

                $QuoteProducts->quote_id = $quotes_id;

                $QuoteProducts->product_id = $product;

                $QuoteProducts->save();

            }

        }



        /// quote industries value set

        if(Input::has('industries'))

        {

            foreach(Input::get('industries') as $industry)

            {

                if($industry != 'all')

                {

                    $QuoteIndustries = new QuoteIndustries();

                    $QuoteIndustries->quote_id = $quotes_id;

                    $QuoteIndustries->industry_id = $industry;

                    $QuoteIndustries->save();

                }

            }

        }



        /// quote equipment order value set

        if(Input::has('equipment'))

        {

            foreach(Input::get('equipment') as $equipment)

            {

                $QuoteTypeEquipment = new QuoteTypeEquipment();

                $QuoteTypeEquipment->quote_id = $quotes_id;

                $QuoteTypeEquipment->order_type_id = $equipment;

                $QuoteTypeEquipment->save();

            }

        }



        /// quote Materials Tooling order value set

        if(Input::has('materials_tooling'))

        {

            foreach(Input::get('materials_tooling') as $materials_tooling)

            {

                $QuoteTypeMaterialsTooling = new QuoteTypeMaterialsTooling();

                $QuoteTypeMaterialsTooling->quote_id = $quotes_id;

                $QuoteTypeMaterialsTooling->order_type_id = $materials_tooling;

                $QuoteTypeMaterialsTooling->save();

            }

        }



        /// quote services order value set

        if(Input::has('services'))

        {

            foreach(Input::get('services') as $service)

            {

                $QuoteTypeServices = new QuoteTypeServices();

                $QuoteTypeServices->quote_id = $quotes_id;

                $QuoteTypeServices->order_type_id = $service;

                $QuoteTypeServices->save();

            }

        }



        /// quote software order value set

        if(Input::has('software'))

        {

            foreach(Input::get('software') as $software)

            {

                $QuoteTypeSoftware = new QuoteTypeSoftware();

                $QuoteTypeSoftware->quote_id = $quotes_id;

                $QuoteTypeSoftware->order_type_id = $software;

                $QuoteTypeSoftware->save();

            }

        }



        /// quote software order value set

        if(Input::has('consumable_suppliers'))

        {

            foreach(Input::get('consumable_suppliers') as $consumable_suppliers)

            {

                $QuoteTypeConsumableSuppliers = new QuoteTypeConsumableSuppliers();

                $QuoteTypeConsumableSuppliers->quote_id = $quotes_id;

                $QuoteTypeConsumableSuppliers->order_type_id = $consumable_suppliers;

                $QuoteTypeConsumableSuppliers->save();

            }

        }



        /// quote categories order value set

        if(Input::has('categories'))

        {

            $categoryIdsArray = array();

            /// get parents child category

            foreach(Input::get('categories') as $category)

            {

                $childCatObj = Category::whereRaw('parent_id = ? AND is_active = ?',array($category,1))->get()->toArray();

                if(!empty($childCatObj))

                {

                    foreach($childCatObj as $child)

                    {

                        $categoryIdsArray[] = $child['id'];

                    }

                }

                $categoryIdsArray[] = $category;

            }



            $quoteCatIds = array_unique($categoryIdsArray);

            foreach($quoteCatIds as $catId)

            {

                $QuoteCategories = new QuoteCategories();

                $QuoteCategories->quote_id = $quotes_id;

                $QuoteCategories->category_id = $catId;

                $QuoteCategories->save();

            }

        }



        /// User Activity for message

        $usersActivity = new UsersActivity;

        $usersActivity->activity_name = 'New Quote Crteated';

        $usersActivity->activity_id = $quotes_id;

        $usersActivity->activity_type = 'quote_new';

        $usersActivity->creater_id = $input['created_by'];

        $usersActivity->receiver_id = null;

        $usersActivity->save();



        $userArray = array();

        $verify = $quotes->verified_only;

        if($verify == 1)

        {

            $users = User::whereRaw('access_level = ? AND quotetek_verify = ? AND id != ? ',array('3','1',$quotes->created_by))->get();

            foreach($users as $user)

            {

                $userArray[] = $user->id;

            }

        }

        else{



            $users = User::whereRaw('access_level = ? AND id != ?  ',array(3,$quotes->created_by))->get();

            foreach($users as $user)

            {

                $userArray[] = $user->id;

            }

        }



        $quoteIndustries = QuoteIndustries::where('quote_id',$quotes->id)->get();



        foreach($quoteIndustries as $industry)

        {

            $finalUsers = array();

            foreach($userArray as $userId)

            {

                $userData = UserDetails::where('user_id',$userId)->first();



                $supplierLeads = SupplierLeads::where('created_by',$userId)->get();

                $leadIndustries = array();

                foreach($supplierLeads as $supplierLead)

                {

                    $SupplierLeadIndustries = SupplierLeadIndustries::where('supplier_lead_id',$supplierLead->id)->get();

                    foreach($SupplierLeadIndustries as $SupplierLeadIndustry)

                    {

                        $leadIndustries[] = $SupplierLeadIndustry->industry_id;

                    }

                }

                if(in_array($industry->industry_id,$leadIndustries))

                {

                    $finalUsers[] = $userId;

                }

            }

        }

        $finalUsers = array_unique($finalUsers);



        if(!empty($finalUsers))

        {

            $senderData = UserDetails::where('user_id',Auth::user()->id)->first();

            $sender = User::find(Auth::user()->id);

            $buyer_name = $senderData->first_name.' '.$senderData->last_name;

            $buyer_email = $sender->email;

            $buyer_profile_link = url('home/user/profile').'/'.$senderData->user_id;

            $product_type = $input['title'];

            $industries = '';

            foreach($quotes->industries as $index=>$industry)

            {

                if($index == 0)

                {

                    $industries = $industry->industry->name;

                }

                else

                {

                    $industries .= ','.$industry->industry->name;

                }

            }



            foreach($finalUsers as $userval)

            {

                $receiverData = UserDetails::where('user_id',$userval)->first();

                $receiver = User::find($userval);

                Input::replace(array('email' => $receiver->email,'name'=>$receiverData->first_name.' '.$receiverData->last_name));

                //Input::replace(array('email' => 'chauhan.gordhan@gmail.com','name'=>$invitename));

                $data = array(

                    'name'=>Input::get('name'),

                    'product_type'=>$product_type,

                    'industries'=>$industries,

                    'buyer_name'=>$buyer_name,

                    'buyer_email'=>$buyer_email,

                    'buyer_profile_link'=>$buyer_profile_link,

                    'base_url'=>url()

                );

                Mail::send('admin.Emailtemplates.sellerReceivedMatchLead', $data, function($message){

                    $message->from(env('MAIL_USERNAME'), 'Indy John Team');

                    $message->to(Input::get('email'), Input::get('name'))->subject('You Received a new Lead on Indy John.');

                });

            }

        }



        return Redirect::to('request-product-quotes/'.$quotes_id)->with('message', 'Your Buy Request has been added.');

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //Show product Information

        $Quotes = Quotes::find($id);

        if(Auth::user()->id != $Quotes->created_by)
        {
            return Redirect::to('not-authorized');
        }

        $user_id = $Quotes->created_by;

        // Quote Privvacy option

        $privacy = $Quotes->privacy;

        if($privacy != 0)

        {

            $privacryOptionArray = array('1' => 'All Visitors on the Web','2' => 'All Free and Premium Suppliers', '3' => 'Premium Suppliers Only');

            foreach($privacryOptionArray as $key=>$privacyVal)

            {

                if($key == $privacy)

                {

                    $Quotes->privacy = $privacyVal;

                }

            }

        }

        else

        {

            $Quotes->privacy = 'N/A';

        }



        // Quote request area option

        $request_area = $Quotes->request_area;

        if($request_area != 0)

        {

            $areaOptionArray = array('1' => 'Local','2' => 'State', '3' => 'Country' , '4' => 'International', '5' => 'WorldWide');

            foreach($areaOptionArray as $key=>$areaVal)

            {

                if($key == $request_area)

                {

                    $Quotes->request_area = $areaVal;

                }

            }

        }

        else

        {

            $Quotes->request_area = 'N/A';

        }





        if($Quotes->specifics_value != ''){

            $item_specifics_value = unserialize($Quotes->specifics_value);

            if(!empty($item_specifics_value))

            {

                $Quotes->techSpecification = $item_specifics_value;



            }

            else

            {

                $Quotes->techSpecification = '';

            }

        }else{

            $Quotes->techSpecification = '';

        }





        /// supplier quote received

        $BuyerIgnoreQuotes = BuyerIgnoreQuotes::where('buyer_id',$user_id)->get();

        $result = array();

        foreach($BuyerIgnoreQuotes as $ignoreQoute)

        {

            $result[] = $ignoreQoute['supplier_quote_id'];

        }



        $SupplierQuotes = SupplierQuotes::whereNotIn('id',$result)->where('buyer_quote_id',$id)->orderBy('id', 'desc')->get();

        foreach($SupplierQuotes as $SupplierQuote)

        {

            $supplier_id = $SupplierQuote->supplier_id;

            $SupplierQuote->supplierUser = UserDetails::where('user_id',$supplier_id)->first();

            $SupplierQuote->supplier = User::find($supplier_id);

            if($SupplierQuote->supplierUser->company_id != '')

            {

                $company = Company::find($SupplierQuote->supplierUser->company_id);

                $SupplierQuote->companyuser =  User::find($company->user_id);

            }

            else

            {

                $SupplierQuote->companyuser =  '';

            }



            if($SupplierQuote->supplierUser->company_id != '')

            {

                $SupplierQuote->supplierCompany = Company::find($SupplierQuote->supplierUser->company_id);

            }

            else

            {

                $SupplierQuote->supplierCompany = '';

            }

            if($SupplierQuote->supplierUser->account_member == 'gold')

            {

                $SupplierQuote->star = 'gold';

            }

            elseif($SupplierQuote->supplierUser->account_member == 'silver')

            {

                $SupplierQuote->star = 'silver';

            }

            else

            {

                $SupplierQuote->star = 'none';

            }



            /// Buy request data

            $buyRequest = $SupplierQuote->buyer_quote_id;

            $SupplierQuote->buy_request = Quotes::find($buyRequest);



            /// Endorsement Count

            $SupplierQuote->endorsement = count(Endorsements::where('receiver_id',$supplier_id)->get());



            /// Review Count

            $reviewCount = count(Reviews::where('receiver_id',$supplier_id)->get());

            $totalStarts = Reviews::where('receiver_id',$supplier_id)->sum('stars');

            if($reviewCount > 0)

            {

                $SupplierQuote->reviews = ($totalStarts/$reviewCount);

            }

            else

            {

                $SupplierQuote->reviews = 0;

            }

            $subtotal = 0;

            foreach($SupplierQuote->SupplierQuoteItems as $item)

            {

                $subtotal += $item->price*$item->qty;

            }

            $SupplierQuote->price = $subtotal;

        }



        return view('quotes.view')->with(['quote'=>$Quotes,'current_user_id'=>$user_id,'SupplierQuotes'=>$SupplierQuotes]);

    }







    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $quote = Quotes::find($id);

        $html = '';

        $html .= '<div class="modal-dialog">

                <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                    <h4 class="modal-title">'.$quote->title.'</h4>

                </div>

                <form action="'.url("quote/expirydate/save").'" method="post" class="horizontal-form">

                <input type="hidden" name="quote_id" value="'.$quote->id.'" />

                <input type="hidden" name="_token" value="'.csrf_token().'" />

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12 form-group">

                            <label class="control-label">Expiry Date:</label>

                            <div class="">

                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">

                                    <input type="text" class="form-control" value="'.$quote->expiry_date.'" name="expiry_date">

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

                <div class="modal-footer">

                    <button type="button" class="btn red btn-circle" data-dismiss="modal">Close</button>

                    <button type="submite" class="btn yellow-crusta color-black btn-circle">Save changes</button>

                </div>

            </form></div></div>';

        $ajaxDataArray = array();

        $ajaxDataArray['html'] = $html;

        return Response::json($ajaxDataArray);

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

     * Save Extended Expiry Date

     */

    public function saveExtendExpiry()

    {

        $quote_id = Input::get('quote_id');

        $quote = Quotes::find($quote_id);

        $quote->expiry_date = Input::get('expiry_date');

        $quote->save();



        /// User Activity for message

        $usersActivity = new UsersActivity;

        $usersActivity->activity_name = 'Extend Quote';

        $usersActivity->activity_id = $quote_id;

        $usersActivity->activity_type = 'quote_extend';

        $usersActivity->creater_id = $quote->created_by;

        $usersActivity->receiver_id = null;

        $usersActivity->save();



        return Redirect::to('request-product-quotes/'.$quote_id)->with('message', 'Your Buy Request has been Extended.');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $quote = Quotes::find($id);

        $old_file = $quote->additional_file;

        if($old_file != '')

        {
            unlink('public/'.$old_file);

        }



        $quote->delete();

        return Redirect::to('quote/view-buy-requests')->with('message', 'Your Buy Request has been deleted.');

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

     * Search Product for add in quote

     */

    public function searchAccredations()

    {

        if(isset($_GET['q']))

        {

            $search = $_GET['q'];

            $accredations = Accreditation::whereRaw("(name LIKE '%$search%') AND is_active = 1 ")->get();

            $accredationArray = array();

            foreach($accredations as $accredation)

            {

                $dataArray = array();

                $dataArray['id'] = $accredation->id;

                $dataArray['full_name'] = $accredation->name;

                $accredationArray[] = $dataArray;

            }

        }

        else

        {

            $accredationArray = array();

        }



        $ajaxArray = array();

        $ajaxArray['incomplete_results'] = false;

        $ajaxArray['items'] = $accredationArray;

        return Response::json($ajaxArray);

    }



    /**

     * Changes status Active/Inactive

     */

    public function changeStatusViewBuyRequest($id)

    {

        $quote = Quotes::find($id);

        $status = $quote->status;

        if($status == 1)

        {

            $quote->status = 0;

            $quote->save();



            /// User Activity for message

            $usersActivity = new UsersActivity;

            $usersActivity->activity_name = 'You disabled a Buy Request, '.$quote->title.'.';

            $usersActivity->activity_id = $quote->id;

            $usersActivity->activity_type = 'quote_disable';

            $usersActivity->creater_id = $quote->created_by;

            $usersActivity->receiver_id = null;

            $usersActivity->save();



            if(isset($_REQUEST['from']))

            {

                return Redirect::to('request-product-quotes/'.$quote->id)->with('message', 'Your Buy Request has been Paused.');

            }

            else

            {

                return Redirect::to('quote/view-buy-requests')->with('message', 'Your Buy Request has been Paused.');

            }

        }

        else

        {

            $quote->status = 1;

            $quote->save();

            /// User Activity for message

            $usersActivity = new UsersActivity;

            $usersActivity->activity_name = 'You Created a Buy Request, '.$quote->title.'.';

            $usersActivity->activity_id = $quote->id;

            $usersActivity->activity_type = 'quote_disable';

            $usersActivity->creater_id = $quote->created_by;

            $usersActivity->receiver_id = null;

            $usersActivity->save();



            if(isset($_REQUEST['from']))

            {

                return Redirect::to('request-product-quotes/'.$quote->id)->with('message', 'Your Buy Request has been Activated.');

            }

            else

            {

                return Redirect::to('quote/view-buy-requests')->with('message', 'Your Buy Request has been Activated.');

            }

        }

    }



    /**

     * Quote Ignore by supplier

     */

    public function supplierQuoteIgnore($supplier_id,$quote_id)

    {

        $SupplierIgnoreQuotes = new SupplierIgnoreQuotes();

        $SupplierIgnoreQuotes->supplier_id = $supplier_id;

        $SupplierIgnoreQuotes->quote_id = $quote_id;

        $SupplierIgnoreQuotes->save();

        return Redirect::to('request-product-quotes')->with('message', 'The selected quote has been ignored and hidden.');

    }



    /**

     * Set Match Leads

     */

    public function matchLeads()

    {

        $quotes = Quotes::where('process_satus',0)->get();



        foreach($quotes as $quote)

        {

            $userArray = array();

            $verify = $quote->verified_only;

            if($verify == 1)

            {

                $users = User::whereRaw('access_level = ? AND quotetek_verify = ? AND id != ? ',array('3','1',$quote->created_by))->get();

                foreach($users as $user)

                {

                    $userArray[] = $user->id;

                }

            }

            else{



                $users = User::whereRaw('access_level = ? AND id != ?  ',array(3,$quote->created_by))->get();

                foreach($users as $user)

                {

                    $userArray[] = $user->id;

                }

            }

            $quoteIndustries = QuoteIndustries::where('quote_id',$quote->id)->get();



            foreach($quoteIndustries as $industry)

            {

                $finalUsers = array();

                foreach($userArray as $userId)

                {

                    $userData = UserDetails::where('user_id',$userId)->first();

                    $supplierLeads = SupplierLeads::where('created_by',$userId)->get();

                    $leadIndustries = array();

                    foreach($supplierLeads as $supplierLead)

                    {

                        $SupplierLeadIndustries = SupplierLeadIndustries::where('supplier_lead_id',$supplierLead->id)->get();

                        foreach($SupplierLeadIndustries as $SupplierLeadIndustry)

                        {

                            $leadIndustries[] = $SupplierLeadIndustry->industry_id;

                        }

                    }

                    if(in_array($industry->industry_id,$leadIndustries))

                    {

                        $finalUsers[] = $userId;

                    }

                }

            }

            $finalUsers = array_unique($finalUsers);

            if(!empty($finalUsers))

            {

                foreach($finalUsers as $userval)

                {

                    /// User Activity for message

                    $usersActivity = new UsersActivity;

                    $usersActivity->activity_name = 'Match Lead to supplier';

                    $usersActivity->activity_id = $quote->id;

                    $usersActivity->activity_type = 'match_lead';

                    $usersActivity->creater_id = $quote->created_by;

                    $usersActivity->receiver_id = $userval;

                    $usersActivity->save();

                }

            }

        }

    }



    /**

     * quote default settings

     */

    public function addDefaultSettings()

    {

        $user_id = Auth::user()->id;

        $SettingArray = array();



        $defaultSettings = QuoteDefaultSettings::where('user_id',$user_id)->first();



        if($defaultSettings)

        {

            $SettingArray['privacy'] = $defaultSettings->privacy;

            $SettingArray['request_area'] = $defaultSettings->request_area;

            $SettingArray['specifications'] = $defaultSettings->specifications;
        }

        else{

            $SettingArray['privacy'] = '';

            $SettingArray['request_area'] = '';

            $SettingArray['specifications'] = '';

        }

        $countries = AppsCountries::all();


        $quoteDefaultAccreditations = QuoteDefaultAccreditations::where('user_id',$user_id)->get();

        if($quoteDefaultAccreditations)

        {

            foreach($quoteDefaultAccreditations as $quoteDefaultAccreditation)

            {

                $dataArray = array();

                $accredition = Accreditation::find($quoteDefaultAccreditation->accreditation_id);

                $dataArray['id'] = $accredition->id;

                $dataArray['name'] = $accredition->name;

                $SettingArray['default_acccreditations'][] = $dataArray;

            }



        }

        else{

            $dataArray = array();

            $SettingArray['default_cccreditations'][] = $dataArray;

        }



        $quoteDefaultDiversityOptions = QuoteDefaultDiversityOptions::where('user_id',$user_id)->get();

        if($quoteDefaultDiversityOptions)

        {

            $diversityResult = array();

            foreach($quoteDefaultDiversityOptions as $quoteDefaultDiversityOption)

            {

                $dataArray = array();

                $diversity = Diversity::find($quoteDefaultDiversityOption->diversity_options_id);

                $dataArray['id'] = $diversity->id;

                $dataArray['name'] = $diversity->name;

                $diversityResult[] = $diversity->id;

                $SettingArray['default_diversity'][] = $dataArray;

            }

            $SettingArray['all_diversity'] = Diversity::whereNotIn('id',$diversityResult)->get();

        }

        else{

            $dataArray = array();

            $SettingArray['default_diversity'][] = $dataArray;

            $SettingArray['all_diversity'] = Diversity::all();

        }



        return view('quotes.defaultsettings')->with(['default' => $SettingArray,'user_id' => $user_id,'countries'=>$countries,'defaultSettings'=>$defaultSettings]);

    }



    public function saveDefaultSettings()

    {

        $input = Input::all();



        $oldQuoteDefaultSettings = QuoteDefaultSettings::where('user_id',$input['user_id'])->first();

        if($oldQuoteDefaultSettings)

        {

            $oldQuoteDefaultSettings->user_id = $input['user_id'];

            $oldQuoteDefaultSettings->privacy = $input['privacy'];

            $oldQuoteDefaultSettings->request_area = $input['request_area'];

            //$oldQuoteDefaultSettings->specifications = $input['specifications'];

            $oldQuoteDefaultSettings->address = $input['address'];

            $oldQuoteDefaultSettings->address2 = $input['address2'];

            $oldQuoteDefaultSettings->city = $input['city'];

            $oldQuoteDefaultSettings->state = $input['state'];

            $oldQuoteDefaultSettings->zip = $input['zip'];

            $oldQuoteDefaultSettings->country = $input['country'];

            $oldQuoteDefaultSettings->save();

        }

        else

        {

            $quoteDefaultSettings = new QuoteDefaultSettings;

            $quoteDefaultSettings->user_id = $input['user_id'];

            $quoteDefaultSettings->privacy = $input['privacy'];

            $quoteDefaultSettings->request_area = $input['request_area'];

            $quoteDefaultSettings->address = $input['address'];

            $quoteDefaultSettings->address2 = $input['address2'];

            $quoteDefaultSettings->city = $input['city'];

            $quoteDefaultSettings->state = $input['state'];

            $quoteDefaultSettings->zip = $input['zip'];

            $quoteDefaultSettings->country = $input['country'];

            $quoteDefaultSettings->save();

        }



        if($input['other_diversity'] != '')

        {

            $otherDiversities = explode(',',$input['other_diversity']);

            foreach($otherDiversities as $otherDiversity)

            {

                $diversity = new Diversity;

                $diversity->name = $otherDiversity;

                $diversity->is_active = 1;

                $diversity->save();

                $input['diversity_options'][] = $diversity->id;

            }

        }



        if($input['other_accreditation'] != '')

        {

            $otherAccreditations = explode(',',$input['other_accreditation']);

            foreach($otherAccreditations as $otherAccreditation)

            {

                $accreditation = new Accreditation;

                $accreditation->name = $otherAccreditation;

                $accreditation->is_active = 1;

                $accreditation->save();

                $input['accredations'][] = $accreditation->id;

            }

        }



        if(key_exists('diversity_options',$input))

        {

            $oldDiversities = QuoteDefaultDiversityOptions::where('user_id',$input['user_id'])->get();

            if($oldDiversities)

            {

                foreach($oldDiversities as $oldDiversity)

                {

                    $oldDiversity->delete();

                }

            }

            foreach($input['diversity_options'] as $diversityOption)

            {

                $quoteDefaultDiversityOption = new QuoteDefaultDiversityOptions;

                $quoteDefaultDiversityOption->user_id = $input['user_id'];

                $quoteDefaultDiversityOption->diversity_options_id = $diversityOption;

                $quoteDefaultDiversityOption->save();

            }

        }



        if(key_exists('accredations',$input))

        {

            $oldAccredations = QuoteDefaultAccreditations::where('user_id',$input['user_id'])->get();

            if($oldAccredations)

            {

                foreach($oldAccredations as $oldAccredation)

                {

                    $oldAccredation->delete();

                }

            }

            foreach($input['accredations'] as $accreditation_id)

            {

                $quoteDefaultAccreditation = new QuoteDefaultAccreditations;

                $quoteDefaultAccreditation->user_id = $input['user_id'];

                $quoteDefaultAccreditation->accreditation_id = $accreditation_id;

                $quoteDefaultAccreditation->save();

            }

        }

        return Redirect::to('quote/defaultsettings')->with('message', 'Your settings have been updated.');

    }



    public function ajaxCategoryName($first_id,$second_id)

    {

        $categoryName = '';

        $Firstcategory = Category::find($first_id);

        if($second_id != 0)

        {

            $secondCategory = Category::find($second_id);



            $categoryName = $Firstcategory->name.' and '.$secondCategory->name.' Request';

        }

        else

        {

            $categoryName = $Firstcategory->name.' Request';

        }



        $ajaxDataArray = array();

        $ajaxDataArray['name'] = $categoryName;

        return Response::json($ajaxDataArray);

    }



    /**

     * Quote Note save

     */

    public function saveQuoteNote(Request $request)

    {

        $input = Input::all();



        if(Input::file('attachment'))

        {

            /// PDF file upload to public folder ///

            $destinationPath = 'public/quotes/notes'; // upload path

            $pdfName = str_replace(' ','_',$input['subject']).'_'.rand(11111,99999). '.' .$request->file('attachment')->getClientOriginalExtension();

            $request->file('attachment')->move(

                base_path() . '/'.$destinationPath, $pdfName

            );



            $input['attachment'] = 'quotes/notes/'.$pdfName;

        }

        else{

            $input['attachment'] = '';

        }



        $quote_note = new QuoteNotes;

        $quote_note->user_id = $input['user_id'];

        $quote_note->quote_id = $input['quote_id'];

        $quote_note->subject = $input['subject'];

        $quote_note->description = $input['description'];

        $quote_note->attachment = $input['attachment'];

        $quote_note->save();

        return Redirect::to('request-product-quotes/'.$input['quote_id'].'#portlet_comments_3')->with('message', 'Your note has been added.');

    }



    /**

     * Buyer Quote Data

     */

    public function ajaxBuyerQuote($id)

    {

        $quote = Quotes::find($id);

        $html = '';

        $html .= '<div class="pull-left">

                    <h2><strong>'.$quote->title.'</strong></h2>

                    <h5><strong>Quantity Requested:</strong> '.$quote->qty_request.' </h5>

                    <h5><strong>Product-Categories Selection: </strong>';

        foreach($quote->categories as $index=>$category):

            if($index < 3):

                if($index == 0):

                    $html .= ''.$category->category->name.'';

                else:

                    $html .= ' ,'.$category->category->name.'';

                endif;

            endif;

        endforeach;

        $html .= '</h5>

                    <h5><strong>Submission Date:</strong> '.date('M d, Y',strtotime($quote->created_at)).' | <strong>Expiration Date: </strong>';

        if(strtotime($quote->expiry_date) > 0):

            $html .= date('M d, Y',strtotime($quote->expiry_date));

        else:

            $html .= 'N/A';

        endif;

        $html .= '</h5>

                    <h5><strong>Buy Request Status: </strong>';

        if($quote->status == 1):

            $html .= 'Active';

        else:

            $html .= 'Inactive';

        endif;

        $html .= '</h5>

                    <h5><strong>Shipping Address: </strong>';

        if($quote->address != '' ):

            $html .= $quote->address.', '.$quote->city.', '.$quote->state.'-'.$quote->zip.', '.$quote->country;

        else:

            $html .= 'N/A';

        endif;

        $html .= '</h5>

                    <a target="_blank" href="'.url('request-product-quotes').'/'.$id.'" target="_blank" class="btn btn-sm red btn-circle block">View Buy Request</a>

                </div>';


        $ajaxArray = array();

        $ajaxArray['html'] = $html;

        return Response::json($ajaxArray);

    }

    public function leadShare($created_by,$id){

        return view('quotes.shareLeadRequest', compact('users'))->with(['sender'=>$created_by,'quoteId'=>$id]);
    }

    public function sentLead(){
        $input = Input::all();

        $quote = Quotes::find($input['quoteId']);
        $date_submitted = date('m/d/Y',strtotime($quote->created_at));

        $userDetails = UserDetails::where('user_id',$input['createdBy'])->first();
        $person_name = $userDetails->first_name.' '.$userDetails->last_name;

        $categories = QuoteCategories::where('quote_id',$quote->id)->get();
        $categoryArray = array();
        foreach($categories as $category)
        {
            $dataArray = array();
            $dataArray['category'] = Category::find($category->category_id)->name;
            $categoryArray[] = $dataArray;
        }
        $categoryString = implode(', ', array_column($categoryArray, 'category'));

        $industries = QuoteIndustries::where('quote_id',$quote->id)->get();
        $industryArray = array();
        foreach($industries as $industry)
        {
            $dataArray = array();
            $dataArray['industry'] = Industry::find($industry->industry_id)->name;
            $industryArray[] = $dataArray;
        }
        $industryString = implode(', ', array_column($industryArray, 'industry'));

        $user_id = Auth::user()->id;
        $userData = UserDetails::where('user_id',$user_id)->first();
        $sender_name = $userData->first_name.' '.$userData->last_name;

        if (Input::has('recipients')) {

            if($input['recipients'] != ''){
                foreach($input['recipients'] as $value){

                    $user = User::find($value);
                    $userData = UserDetails::where('user_id',$user->id)->first();
                    $forward_to_name = $userData->first_name.' '.$userData->last_name;

                    $data = array('email'=>$user->email,'forward_to_name'=>$forward_to_name,'sender_name'=>$sender_name,'product_category'=>$categoryString,'date_submitted'=>$date_submitted,'person_name'=>$person_name,'categories'=>$categoryString,'indutries'=>$industryString);
                    Mail::send('admin.Emailtemplates.forwardLeadSeller', $data, function($message) use ($data){
                        $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                        $message->to($data['email'],$data['forward_to_name'])->subject('You Received a New Message on Indy John.');
                    });
                }
            }
        }

        if (Input::has('emails')) {

            if($input['emails'] != ''){

                $emails = explode(",", $input['emails']);
                foreach($emails as $value){

                    $data = array('email'=>$value,'forward_to_name'=>'','sender_name'=>$sender_name,'product_category'=>$categoryString,'date_submitted'=>$date_submitted,'person_name'=>$person_name,'categories'=>$categoryString,'indutries'=>$industryString);
                    Mail::send('admin.Emailtemplates.forwardLeadSeller', $data, function($message) use ($data){
                        $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                        $message->to($data['email'],$data['forward_to_name'])->subject('You Received a New Message on Indy John.');
                    });
                }
            }
        }

        return Redirect::to('request-product-quotes')->with('message', 'Lead request is shared.');
    }
}

