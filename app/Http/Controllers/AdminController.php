<?php



namespace App\Http\Controllers;



use App\Category;
use Illuminate\Http\Request;

use App\Quotes;

use App\Thread;

use App\ContactUsers;

use App\UserDetails;

use App\User;

use App\AppsCountries;

use App\MarketplaceProducts;

use App\SupplierIgnoreQuotes;

use App\SupplierLeads;

use App\UsersActivity;

use App\Company;

use App\CompanyAdmin;

use App\CompanyUsers;

use App\UserWizardTrack;

use App\CompanyIndustries;

use App\QuoteIndustries;

use App\EmailVerification;

use App\BuyerIgnoreQuotes;

use App\SupplierQuotes;

use App\Endorsements;

use App\SupplierLeadCategories;

use App\SupplierLeadIndustries;

use App\QuoteCategories;

use App\CompanyCategories;

use App\UserUnique;

use App\SupplierTeam;

use App\BuyerTeam;

use App\BuyerTeamUserAssignedBuyRequest;

use App\BuyerTeamUserAssignedQuote;

use App\SupplierTeamUserLeadRequest;

use App\BuyerTeamTransfer;

use App\SupplierTeamTransfer;

use App\Industry;

use App\OrderTypes;

use App\SupplierLeadSoftware;

use App\SupplierLeadEquipment;

use App\SupplierLeadMaterialsTooling;

use App\SupplierLeadServices;

use App\SupplierLeadConsumableSuppliers;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Route;

use Input;

use Auth;

use Response;

use Session;

use Mail;

use Illuminate\Support\Facades\Hash;

use App\Report;



class AdminController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        //Generating admin dashboard view here.

        if(Auth::user()->access_level == 1){

            Session::put('user_type','admin');

            return view('admin.admin-dashboard');

        }else if(Auth::user()->access_level == 2){



            $user_id = Auth::user()->id;

            $quotes = Quotes::where('created_by',$user_id)->get();

            $quote_cnt = count($quotes);

            $threads_cnt = Thread::forUserWithNewMessages($user_id)->latest('updated_at')->get();

            $products = MarketplaceProducts::whereRaw('user_id = ? AND is_active = ?',array($user_id,1))->get();

            $contacts = ContactUsers::whereRaw('(sender_user_id = ? OR request_user_id = ?) AND status = ?',array($user_id,$user_id,1))->get();

            //$today = date('Y-m-d');

            //$nextDate = date('Y-m-d', strtotime('+2 days', strtotime($today)));

            $userCreatedDate = date('Y-m-d', strtotime(Auth::user()->created_at));
            $currentDate = date('Y-m-d');

            //$quotes = Quotes::whereIn('id',$result)->where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->orderBy('id', $order_by)->paginate(15);

            $userQuotes = Quotes::whereRaw('expiry_date >= ? AND created_at >= ? AND created_by = ? AND status = ?',array($currentDate,$userCreatedDate,$user_id,1))->get();

            foreach($userQuotes as $userQuote)

            {

                $future = strtotime($userQuote->expiry_date); //Future date.

                $timefromdb = strtotime($currentDate);

                $timeleft = $future-$timefromdb;

                $daysleft = round((($timeleft/24)/60)/60);

                $userQuote->daysleft = $daysleft;

            }

            $activities = UsersActivity::whereRaw('creater_id = ? OR receiver_id = ?',array($user_id,$user_id))->orderBy('created_at','desc')->paginate(10);

            foreach($activities as $activitie)

            {

                $creater_id = $activitie->creater_id;

                $createrUser = User::find($creater_id);

                $activitie->createrUser = $createrUser;



                $receiver_id = $activitie->receiver_id;

                if($receiver_id != '')

                {

                    $receiverUser = User::find($receiver_id);

                    $activitie->receiverUser = $receiverUser;

                }

            }

            $msgActivities = UsersActivity::whereRaw('receiver_id = ?',array($user_id))->orderBy('created_at','desc')->get()->toArray();
            $messageActivities = array();
            foreach($msgActivities as $activity)
            {
                $creater_id = $activity['creater_id'];

                $createrUser = User::find($creater_id);
                $activity['senderName'] = $createrUser->name;

                $messageActivities[] = $activity;
            }

            $company_verification_notify = 0;

            $company_owner =  Company::where('owner_id',$user_id)->first();

            if($company_owner)

            {

                $companyUser = User::find($company_owner->user_id);
                if($companyUser){
                    if($companyUser->quotetek_verify != 1)

                    {

                        $company_verification_notify = 1;

                    }
                }

            }





            /// User quote received

            $BuyerIgnoreQuotes = BuyerIgnoreQuotes::where('buyer_id',$user_id)->get();

            $result = array();

            foreach($BuyerIgnoreQuotes as $ignoreQoute)

            {

                $result[] = $ignoreQoute['supplier_quote_id'];

            }

            $current_quote_id = '';

            if(isset($_GET['quote_id']))

            {

                $quote_id = $_GET['quote_id'];

                $current_quote_id = $quote_id;

                $SupplierQuotes = SupplierQuotes::whereNotIn('id',$result)->where('buyer_id',$user_id)->where('buyer_quote_id',$quote_id)->orderBy('id', 'desc')->paginate(15);

            }

            else

            {

                $SupplierQuotes = SupplierQuotes::whereNotIn('id',$result)->where('buyer_id',$user_id)->orderBy('id', 'desc')->paginate(15);

            }



            //endorement received

            $endorsements_cnt = Endorsements::where('receiver_id',$user_id)->count();



            // connection request received

            $contact_cnt = ContactUsers::whereRaw('request_user_id = ? AND status = ?',array($user_id , 0))->count();

            $request_contact = UsersActivity::whereRaw('(creater_id = ? OR receiver_id = ?) AND activity_type = ? ',array($user_id,$user_id,'new user connection'))->where('created_at','desc')->get();

            foreach($request_contact as $request){
                if($request->receiver_id != $user_id){
                    $userData = UserDetails::where('user_id',$request->receiver_id)->first();
                    $userName = $userData->first_name.' '.$userData->last_name;
                    $request->msg = 'You have send requested to'.$userName;
                }else if($request->creater_id != $user_id){
                    $userData = UserDetails::where('user_id',$request->creater_id)->first();
                    $userName = $userData->first_name.' '.$userData->last_name;
                    $request->msg = $userName.'sent you connection Request';
                }
            }
            // team alert activity

            $alertActivities = UsersActivity::where('activity_type','user invitation for team')->where('creater_id',$user_id)->where('created_at','desc')->get();

            // Connection alert activity

            $connectionActivities = UsersActivity::where('activity_type','Approve Connection Request')->where('creater_id',$user_id)->where('created_at','desc')->get();
            foreach($connectionActivities as $connection){
                $userData = UserDetails::where('user_id',$connection->receiver_id)->first();
                $userName = $userData->first_name.' '.$userData->last_name;
                $connection->msg = 'Your connection request has been accepted by '.$userName;
            }
            // Supplier Lead received

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



            // supplier Leads

            $supplierLeads = SupplierLeads::where('created_by',$user_id)->get();


            // user company request akert
            $companyUsers = '';
            if(count(Auth::user()->userCompanyOwner) > 0){
                foreach(Auth::user()->userCompanyOwner as $company){
                    if(Auth::user()->userdetail->company_id == $company->id){
                        $companyUsers = CompanyUsers::where('company_id',$company->id)->get();
                        foreach($companyUsers as $cUser)
                        {
                            $cUser->user = User::find($cUser->user_id);
                            $cUser->company = Company::find($cUser->company_id);
                        }
                    }
                }
            }


            if(Session::has('user_type'))

            {

                if(Session::get('user_type') == 'supplier')

                {

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
                        $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->whereNotIn('id',$veryfyArray)->where('created_at','>',$userCreatedDate)->get();
                    }

                    else{
                        $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->where('created_at','>=',$userCreatedDate)->get();
                    }


                    $finalQuotesArray = array();
                    foreach($quotes as $quote){
                        if($quote->expiry_date == '0000-00-00'){
                            $finalQuotesArray[] = $quote;
                            continue;
                        }else if($quote->expiry_date >= $currentDate){
                            $finalQuotesArray[] = $quote;
                        }
                    }

                    $supplier_lead_count = SupplierLeads::where('created_by',$user_id)->count();



                    //$quotes = Quotes::whereNotIn('id',$result)->get();

                    Session::put('user_type','supplier');

                    //team transfer management

                    if(Session::has('email') && Session::has('teamType') && Session::has('teamId'))

                    {
                        $logInEmail = Auth::user()->email;
                        $email = Session::get('email');

                        if($logInEmail == $email){
                            $user = User::where('email',$email)->first();
                            $teamType = Session::get('teamType');
                            $teamId = Session::get('teamId');

                            if($teamType == 'Purchasing'){
                                $buyerTeam = BuyerTeam::where('team_id',$teamId)->first();
                                $buyerTeam->user_id = $user->id;
                                $buyerTeam->save();

                                $buyerBuyRequests = BuyerTeamUserAssignedBuyRequest::where('buyer_team_id',$buyerTeam->id)->get();
                                if(count($buyerBuyRequests)>0){
                                    foreach($buyerBuyRequests as $buyerBuyRequest){
                                        $buyerBuyRequest->user_id = $user->id;
                                        $buyerBuyRequest->save();
                                    }
                                }

                                $buyerQuotes = BuyerTeamUserAssignedQuote::where('buyer_team_id',$buyerTeam->id)->get();
                                if(count($buyerQuotes)>0){
                                    foreach($buyerQuotes as $buyerQuote){
                                        $buyerQuote->user_id = $user->id;
                                        $buyerQuote->save();
                                    }
                                }

                                $buyerTeamTransfer = BuyerTeamTransfer::whereRaw('buyer_team_id = ? AND new_manager_id = ? AND status = ?',array($buyerTeam->id,$user->id,0))->first();
                                $buyerTeamTransfer->status = 1;
                                $buyerTeamTransfer->save();
                                Session::forget('teamType');
                                Session::forget('teamId');
                            }else{
                                $supplierTeam = SupplierTeam::where('supplier_team_id',$teamId)->first();
                                $supplierTeam->user_id = $user->id;
                                $supplierTeam->save();

                                $supplierLeadRequests = SupplierTeamUserLeadRequest::where('supplier_team_id',$supplierTeam->id)->get();
                                if(count($supplierLeadRequests)>0){
                                    foreach($supplierLeadRequests as $supplierLeadRequest){
                                        $supplierLeadRequest->user_id = $user->id;
                                        $supplierLeadRequest->save();
                                    }
                                }

                                $SupplierTeamTransfer = SupplierTeamTransfer::whereRaw('supplier_team_id = ? AND new_manager_id = ? AND status = ?',array($supplierTeam->id,$user->id,0))->first();
                                $SupplierTeamTransfer->status = 1;
                                $SupplierTeamTransfer->save();
                                Session::forget('teamType');
                                Session::forget('teamId');
                            }
                        }
                    }

                    return view('supplier.supplier-dashboard')->with([

                        'threads_cnt'=>$threads_cnt,

                        'contacts'=>$contacts,

                        'products'=>$products,

                        'activities'=>$activities,

                        'messageActivities'=>$messageActivities,

                        'alertActivities'=>$alertActivities,

                        'connectionActivities'=>$connectionActivities,

                        'userQuotes'=>$userQuotes,

                        'supplier_lead_count'=>$supplier_lead_count,

                        'quote_cnt'=>$quote_cnt,

                        'quote_received'=>$SupplierQuotes,

                        'endorsements_cnt'=>$endorsements_cnt,

                        'contact_cnt'=>$contact_cnt,

                        'request_contact'=>$request_contact,

                        'lead_cnt'=>count($finalQuotesArray),

                        'company_verification_notify'=>$company_verification_notify,

                        'company_request' => $companyUsers]);

                }

                else

                {

                    $quotes = Quotes::where('created_by',$user_id)->get();

                    Session::put('user_type','buyer');

                    //team transfer management

                    if(Session::has('email') && Session::has('teamType') && Session::has('teamId'))

                    {
                        $logInEmail = Auth::user()->email;
                        $email = Session::get('email');

                        if($logInEmail == $email){
                            $user = User::where('email',$email)->first();
                            $teamType = Session::get('teamType');
                            $teamId = Session::get('teamId');


                            if($teamType == 'Purchasing'){
                                $buyerTeam = BuyerTeam::where('team_id',$teamId)->first();
                                $buyerTeam->user_id = $user->id;
                                $buyerTeam->save();

                                $buyerBuyRequests = BuyerTeamUserAssignedBuyRequest::where('buyer_team_id',$buyerTeam->id)->get();
                                if(count($buyerBuyRequests)>0){
                                    foreach($buyerBuyRequests as $buyerBuyRequest){
                                        $buyerBuyRequest->user_id = $user->id;
                                        $buyerBuyRequest->save();
                                    }
                                }

                                $buyerQuotes = BuyerTeamUserAssignedQuote::where('buyer_team_id',$buyerTeam->id)->get();
                                if(count($buyerQuotes)>0){
                                    foreach($buyerQuotes as $buyerQuote){
                                        $buyerQuote->user_id = $user->id;
                                        $buyerQuote->save();
                                    }
                                }

                                $buyerTeamTransfer = BuyerTeamTransfer::whereRaw('buyer_team_id = ? AND new_manager_id = ? AND status = ?',array($buyerTeam->id,$user->id,0))->first();
                                $buyerTeamTransfer->status = 1;
                                $buyerTeamTransfer->save();
                                Session::forget('teamType');
                                Session::forget('teamId');

                            }else{
                                $supplierTeam = SupplierTeam::where('supplier_team_id',$teamId)->first();
                                $supplierTeam->user_id = $user->id;
                                $supplierTeam->save();

                                $supplierLeadRequests = SupplierTeamUserLeadRequest::where('supplier_team_id',$supplierTeam->id)->get();
                                if(count($supplierLeadRequests)>0){
                                    foreach($supplierLeadRequests as $supplierLeadRequest){
                                        $supplierLeadRequest->user_id = $user->id;
                                        $supplierLeadRequest->save();
                                    }
                                }

                                $SupplierTeamTransfer = SupplierTeamTransfer::whereRaw('supplier_team_id = ? AND new_manager_id = ? AND status = ?',array($supplierTeam->id,$user->id,0))->first();
                                $SupplierTeamTransfer->status = 1;
                                $SupplierTeamTransfer->save();
                                Session::forget('teamType');
                                Session::forget('teamId');
                            }
                        }
                    }

                    $BuyerIgnoreQuotes = BuyerIgnoreQuotes::where('buyer_id',$user_id)->get();
                    $result = array();
                    foreach($BuyerIgnoreQuotes as $ignoreQoute)
                    {
                        $result[] = $ignoreQoute['supplier_quote_id'];
                    }
                    $current_quote_id = '';
                    $SupplierQuotes = SupplierQuotes::whereNotIn('id',$result)->whereRaw('buyer_id = ? AND preview = ?',array($user_id,0))->orderBy('id', 'desc')->get();

                    foreach($SupplierQuotes as $SupplierQuote)
                    {
                        $supplier_id = $SupplierQuote->supplier_id;
                        $SupplierQuote->supplierUser = UserDetails::where('user_id',$supplier_id)->first();
                        $SupplierQuote->supplier = User::find($supplier_id);
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

                    return view('buyer.buyer-dashboard')->with([

                        'quotes' => $quotes,

                        'threads_cnt'=>$threads_cnt,

                        'contacts'=>$contacts,

                        'products'=>$products,

                        'activities'=>$activities,

                        'messageActivities'=>$messageActivities,

                        'alertActivities'=>$alertActivities,

                        'connectionActivities'=>$connectionActivities,

                        'userQuotes'=>$userQuotes,

                        'quote_cnt'=>$quote_cnt,

                        'quote_received'=>$SupplierQuotes,

                        'endorsements_cnt'=>$endorsements_cnt,

                        'contact_cnt'=>$contact_cnt,

                        'request_contact'=>$request_contact,

                        'company_verification_notify'=>$company_verification_notify,

                        'company_request' => $companyUsers]);

                }



            }

            else

            {

                $quotes = Quotes::where('created_by',$user_id)->get();

                Session::put('user_type','buyer');

                //team transfer management

                if(Session::has('email') && Session::has('teamType') && Session::has('teamId'))

                {
                    $logInEmail = Auth::user()->email;
                    $email = Session::get('email');

                    if($logInEmail == $email){
                        $user = User::where('email',$email)->first();
                        $teamType = Session::get('teamType');
                        $teamId = Session::get('teamId');

                        if($teamType == 'Purchasing'){
                            $buyerTeam = BuyerTeam::where('team_id',$teamId)->first();
                            $buyerTeam->user_id = $user->id;
                            $buyerTeam->save();

                            $buyerBuyRequests = BuyerTeamUserAssignedBuyRequest::where('buyer_team_id',$buyerTeam->id)->get();
                            if(count($buyerBuyRequests)>0){
                                foreach($buyerBuyRequests as $buyerBuyRequest){
                                    $buyerBuyRequest->user_id = $user->id;
                                    $buyerBuyRequest->save();
                                }
                            }

                            $buyerQuotes = BuyerTeamUserAssignedQuote::where('buyer_team_id',$buyerTeam->id)->get();
                            if(count($buyerQuotes)>0){
                                foreach($buyerQuotes as $buyerQuote){
                                    $buyerQuote->user_id = $user->id;
                                    $buyerQuote->save();
                                }
                            }

                            $buyerTeamTransfer = BuyerTeamTransfer::whereRaw('buyer_team_id = ? AND new_manager_id = ? AND status = ?',array($buyerTeam->id,$user->id,0))->first();
                            $buyerTeamTransfer->status = 1;
                            $buyerTeamTransfer->save();
                            Session::forget('teamType');
                            Session::forget('teamId');

                        }else{
                            $supplierTeam = SupplierTeam::where('supplier_team_id',$teamId)->first();
                            $supplierTeam->user_id = $user->id;
                            $supplierTeam->save();

                            $supplierLeadRequests = SupplierTeamUserLeadRequest::where('supplier_team_id',$supplierTeam->id)->get();
                            if(count($supplierLeadRequests)>0){
                                foreach($supplierLeadRequests as $supplierLeadRequest){
                                    $supplierLeadRequest->user_id = $user->id;
                                    $supplierLeadRequest->save();
                                }
                            }

                            $SupplierTeamTransfer = SupplierTeamTransfer::whereRaw('supplier_team_id = ? AND new_manager_id = ? AND status = ?',array($supplierTeam->id,$user->id,0))->first();
                            $SupplierTeamTransfer->status = 1;
                            $SupplierTeamTransfer->save();
                            Session::forget('teamType');
                            Session::forget('teamId');
                        }
                    }
                }

                return view('buyer.buyer-dashboard')->with([

                    'quotes' => $quotes,

                    'threads_cnt'=>$threads_cnt,

                    'contacts'=>$contacts,

                    'products'=>$products,

                    'activities'=>$activities,

                    'messageActivities'=>$messageActivities,

                    'alertActivities'=>$alertActivities,

                    'connectionActivities'=>$connectionActivities,

                    'userQuotes'=>$userQuotes,

                    'quote_cnt'=>$quote_cnt,

                    'quote_received'=>$SupplierQuotes,

                    'endorsements_cnt'=>$endorsements_cnt,

                    'contact_cnt'=>$contact_cnt,

                    'request_contact'=>$request_contact,

                    'lead_cnt'=>$Supplierquotes,

                    'company_verification_notify'=>$company_verification_notify,

                    'company_request' => $companyUsers]);

            }





        }else if(Auth::user()->access_level == 3){

            $user_id = Auth::user()->id;

            $threads_cnt = Thread::forUserWithNewMessages($user_id)->latest('updated_at')->get();

            $products = MarketplaceProducts::whereRaw('user_id = ? AND is_active = ?',array($user_id,1))->get();

            $contacts = ContactUsers::whereRaw('(sender_user_id = ? OR request_user_id = ?) AND status = ?',array($user_id,$user_id,1))->get();

            //$today = date('Y-m-d');

            //$nextDate = date('Y-m-d', strtotime('+2 days', strtotime($today)));

            $userCreatedDate = date('Y-m-d', strtotime(Auth::user()->created_at));
            $currentDate = date('Y-m-d');

            //$quotes = Quotes::whereIn('id',$result)->where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->orderBy('id', $order_by)->paginate(15);

            $userQuotes = Quotes::whereRaw('expiry_date >= ? AND created_at >= ? AND created_by = ? AND status = ?',array($currentDate,$userCreatedDate,$user_id,1))->get();

            foreach($userQuotes as $userQuote)

            {

                $future = strtotime($userQuote->expiry_date); //Future date.

                $timefromdb = strtotime($currentDate);

                $timeleft = $future-$timefromdb;

                $daysleft = round((($timeleft/24)/60)/60);

                $userQuote->daysleft = $daysleft;

            }

            // team alert activity

            $alertActivities = UsersActivity::where('activity_type','user invitation for team')->where('creater_id',$user_id)->where('created_at','desc')->get();

            // Connection alert activity

            $connectionActivities = UsersActivity::where('activity_type','Approve Connection Request')->where('creater_id',$user_id)->where('created_at','desc')->get();

            foreach($connectionActivities as $connection){
                $userData = UserDetails::where('user_id',$connection->receiver_id)->first();
                $userName = $userData->first_name.' '.$userData->last_name;
                $connection->msg = 'Your connection request has been accepted by '.$userName;
            }

            $activities = UsersActivity::whereRaw('creater_id = ? OR receiver_id = ?',array($user_id,$user_id))->orderBy('created_at','desc')->paginate(10);

            foreach($activities as $activitie)

            {

                $creater_id = $activitie->creater_id;

                $createrUser = User::find($creater_id);

                $activitie->createrUser = $createrUser;



                $receiver_id = $activitie->receiver_id;

                if($receiver_id != '')

                {

                    $receiverUser = User::find($receiver_id);

                    $activitie->receiverUser = $receiverUser;

                }

            }

            $msgActivities = UsersActivity::whereRaw('receiver_id = ?',array($user_id))->orderBy('created_at','desc')->get()->toArray();
            $messageActivities = array();
            foreach($msgActivities as $activity)
            {
                $creater_id = $activity['creater_id'];

                $createrUser = User::find($creater_id);
                $activity['senderName'] = $createrUser->name;

                $messageActivities[] = $activity;
            }

            $company_verification_notify = 0;

            $company_owner =  Company::where('owner_id',$user_id)->first();

            if($company_owner)

            {

                $companyUser = User::find($company_owner->user_id);
                if($companyUser){
                    if($companyUser->quotetek_verify != 1)

                    {

                        $company_verification_notify = 1;

                    }

                }

            }



            $quotes = Quotes::where('created_by',$user_id)->get();

            $quote_cnt = count($quotes);



            /// User quote received

            $BuyerIgnoreQuotes = BuyerIgnoreQuotes::where('buyer_id',$user_id)->get();

            $result = array();

            foreach($BuyerIgnoreQuotes as $ignoreQoute)

            {

                $result[] = $ignoreQoute['supplier_quote_id'];

            }

            $current_quote_id = '';

            if(isset($_GET['quote_id']))

            {

                $quote_id = $_GET['quote_id'];

                $current_quote_id = $quote_id;

                $SupplierQuotes = SupplierQuotes::whereNotIn('id',$result)->where('buyer_id',$user_id)->where('buyer_quote_id',$quote_id)->orderBy('id', 'desc')->paginate(15);

            }

            else

            {

                $SupplierQuotes = SupplierQuotes::whereNotIn('id',$result)->where('buyer_id',$user_id)->orderBy('id', 'desc')->paginate(15);

            }



            //endorement received

            $endorsements_cnt = Endorsements::where('receiver_id',$user_id)->count();



            // connection request received

            $contact_cnt = ContactUsers::whereRaw('request_user_id = ? AND status = ?',array($user_id , 0))->count();


            $request_contact = UsersActivity::whereRaw('(creater_id = ? OR receiver_id = ?) AND activity_type = ? ',array($user_id,$user_id,'new user connection'))->where('created_at','desc')->get();

            foreach($request_contact as $request){
                if($request->receiver_id != $user_id){
                    $userData = UserDetails::where('user_id',$request->receiver_id)->first();
                    $userName = $userData->first_name.' '.$userData->last_name;
                    $request->createmsg = 'You have send requested to '.$userName;
                }else if($request->creater_id != $user_id){
                    $userData = UserDetails::where('user_id',$request->creater_id)->first();
                    $userName = $userData->first_name.' '.$userData->last_name;
                    $request->receivemsg = $userName.' sent you connection Request';
                }
            }
            // Supplier Lead received

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



            // supplier Leads

            $supplierLeads = SupplierLeads::where('created_by',$user_id)->get();


            // user company request akert
            $companyUsers = '';
            if(count(Auth::user()->userCompanyOwner) > 0){
                foreach(Auth::user()->userCompanyOwner as $company){
                    if(Auth::user()->userdetail->company_id == $company->id){
                        $companyUsers = CompanyUsers::where('company_id',$company->id)->get();
                        foreach($companyUsers as $cUser)
                        {
                            $cUser->user = User::find($cUser->user_id);
                            $cUser->company = Company::find($cUser->company_id);
                        }
                    }
                }
            }


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



            $quoteByLeadsArray = array();

            // Quote by Industries

            if(!empty($supplieIndustries))

            {

                foreach($supplieIndustries as $industry)

                {

                    $quoteDatas = '';

                    $quoteDatas = QuoteIndustries::where('industry_id',$industry)->get();

                    foreach($quoteDatas as $quoteData)

                    {

                        $quoteByLeadsArray[] = $quoteData->quote_id;

                    }

                }



            }

            /// Quote By Categories

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





            $Supplierquotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->get();



            /// check for verify

            $veryfyArray = array();

            foreach($Supplierquotes as $quote)

            {

                if($quote->verified_only == 1)

                {

                    $veryfyArray[] = $quote->id;

                }

            }




            if(Auth::user()->quotetek_verify != 1)

            {

                $Supplierquotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->whereNotIn('id',$veryfyArray)->where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->count();

            }

            else{

                $Supplierquotes = Quotes::whereNotIn('id',$result)->whereIn('id',$quoteByLeadsArray)->where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->count();

            }

            if(Session::has('user_type'))

            {



                if(Session::get('user_type') == 'supplier')

                {

                    /// supplier ignore quote

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

                    $userData = UserDetails::where('user_id',$user_id)->first();

                    // quote filter by industries of seller


                    if($userData->company_id != '')

                    {

                        $supplieIndustries = CompanyIndustries::where('company_id',$userData->company_id)->get()->toArray();

                    }

                    $industryArray = array();

                    if(!empty($supplieIndustries))

                    {

                        foreach($supplieIndustries as $industry)

                        {

                            $quoteDatas = '';

                            $quoteDatas = QuoteIndustries::where('industry_id',$industry['industry_id'])->get();

                            foreach($quoteDatas as $quoteData)

                            {

                                $industryArray[] = $quoteData->quote_id;

                            }

                        }



                        $industryArray = array_unique($industryArray);

                    }

                    else

                    {

                        $industryArray = array();

                    }

                    $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$industryArray)->get();



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

                        $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$industryArray)->whereNotIn('id',$veryfyArray)->where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->orderBy('id', 'desc')->paginate(15);

                    }

                    else{

                        $quotes = Quotes::whereNotIn('id',$result)->whereIn('id',$industryArray)->where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->orderBy('id', 'desc')->paginate(15);

                    }



                    $supplier_lead_count = SupplierLeads::where('created_by',$user_id)->count();



                    //$quotes = Quotes::whereNotIn('id',$result)->get();

                    Session::put('user_type','supplier');

                    //team transfer management

                    if(Session::has('email') && Session::has('teamType') && Session::has('teamId'))

                    {
                        $logInEmail = Auth::user()->email;
                        $email = Session::get('email');

                        if($logInEmail == $email){
                            $user = User::where('email',$email)->first();
                            $teamType = Session::get('teamType');
                            $teamId = Session::get('teamId');

                            if($teamType == 'Purchasing'){
                                $buyerTeam = BuyerTeam::where('team_id',$teamId)->first();
                                $buyerTeam->user_id = $user->id;
                                $buyerTeam->save();

                                $buyerBuyRequests = BuyerTeamUserAssignedBuyRequest::where('buyer_team_id',$buyerTeam->id)->get();
                                if(count($buyerBuyRequests)>0){
                                    foreach($buyerBuyRequests as $buyerBuyRequest){
                                        $buyerBuyRequest->user_id = $user->id;
                                        $buyerBuyRequest->save();
                                    }
                                }

                                $buyerQuotes = BuyerTeamUserAssignedQuote::where('buyer_team_id',$buyerTeam->id)->get();
                                if(count($buyerQuotes)>0){
                                    foreach($buyerQuotes as $buyerQuote){
                                        $buyerQuote->user_id = $user->id;
                                        $buyerQuote->save();
                                    }
                                }

                                $buyerTeamTransfer = BuyerTeamTransfer::whereRaw('buyer_team_id = ? AND new_manager_id = ? AND status = ?',array($buyerTeam->id,$user->id,0))->first();
                                $buyerTeamTransfer->status = 1;
                                $buyerTeamTransfer->save();
                                Session::forget('teamType');
                                Session::forget('teamId');

                            }else{
                                $supplierTeam = SupplierTeam::where('supplier_team_id',$teamId)->first();
                                $supplierTeam->user_id = $user->id;
                                $supplierTeam->save();

                                $supplierLeadRequests = SupplierTeamUserLeadRequest::where('supplier_team_id',$supplierTeam->id)->get();
                                if(count($supplierLeadRequests)>0){
                                    foreach($supplierLeadRequests as $supplierLeadRequest){
                                        $supplierLeadRequest->user_id = $user->id;
                                        $supplierLeadRequest->save();
                                    }
                                }

                                $SupplierTeamTransfer = SupplierTeamTransfer::whereRaw('supplier_team_id = ? AND new_manager_id = ? AND status = ?',array($supplierTeam->id,$user->id,0))->first();
                                $SupplierTeamTransfer->status = 1;
                                $SupplierTeamTransfer->save();
                                Session::forget('teamType');
                                Session::forget('teamId');
                            }
                        }
                    }

                    return view('supplier.supplier-dashboard')->with([

                        'quotes' => $quotes,

                        'threads_cnt'=>$threads_cnt,

                        'contacts'=>$contacts,

                        'products'=>$products,

                        'activities'=>$activities,

                        'messageActivities'=>$messageActivities,

                        'alertActivities'=>$alertActivities,

                        'connectionActivities'=>$connectionActivities,

                        'userQuotes'=>$userQuotes,

                        'supplier_lead_count'=>$supplier_lead_count,

                        'quote_cnt'=>$quote_cnt,

                        'quote_received'=>$SupplierQuotes,

                        'endorsements_cnt'=>$endorsements_cnt,

                        'contact_cnt'=>$contact_cnt,

                        'request_contact'=>$request_contact,

                        'lead_cnt'=>$Supplierquotes,

                        'company_verification_notify'=>$company_verification_notify,

                        'company_request' => $companyUsers]);

                }

                else

                {

                    $quotes = Quotes::where('created_by',$user_id)->get();



                    Session::put('user_type','buyer');

                    //team transfer management

                    if(Session::has('email') && Session::has('teamType') && Session::has('teamId'))

                    {
                        $logInEmail = Auth::user()->email;
                        $email = Session::get('email');

                        if($logInEmail == $email){
                            $user = User::where('email',$email)->first();
                            $teamType = Session::get('teamType');
                            $teamId = Session::get('teamId');

                            if($teamType == 'Purchasing'){
                                $buyerTeam = BuyerTeam::where('team_id',$teamId)->first();
                                $buyerTeam->user_id = $user->id;
                                $buyerTeam->save();

                                $buyerBuyRequests = BuyerTeamUserAssignedBuyRequest::where('buyer_team_id',$buyerTeam->id)->get();
                                if(count($buyerBuyRequests)>0){
                                    foreach($buyerBuyRequests as $buyerBuyRequest){
                                        $buyerBuyRequest->user_id = $user->id;
                                        $buyerBuyRequest->save();
                                    }
                                }

                                $buyerQuotes = BuyerTeamUserAssignedQuote::where('buyer_team_id',$buyerTeam->id)->get();
                                if(count($buyerQuotes)>0){
                                    foreach($buyerQuotes as $buyerQuote){
                                        $buyerQuote->user_id = $user->id;
                                        $buyerQuote->save();
                                    }
                                }

                                $buyerTeamTransfer = BuyerTeamTransfer::whereRaw('buyer_team_id = ? AND new_manager_id = ? AND status = ?',array($buyerTeam->id,$user->id,0))->first();
                                $buyerTeamTransfer->status = 1;
                                $buyerTeamTransfer->save();
                                Session::forget('teamType');
                                Session::forget('teamId');

                            }else{
                                $supplierTeam = SupplierTeam::where('supplier_team_id',$teamId)->first();
                                $supplierTeam->user_id = $user->id;
                                $supplierTeam->save();

                                $supplierLeadRequests = SupplierTeamUserLeadRequest::where('supplier_team_id',$supplierTeam->id)->get();
                                if(count($supplierLeadRequests)>0){
                                    foreach($supplierLeadRequests as $supplierLeadRequest){
                                        $supplierLeadRequest->user_id = $user->id;
                                        $supplierLeadRequest->save();
                                    }
                                }

                                $SupplierTeamTransfer = SupplierTeamTransfer::whereRaw('supplier_team_id = ? AND new_manager_id = ? AND status = ?',array($supplierTeam->id,$user->id,0))->first();
                                $SupplierTeamTransfer->status = 1;
                                $SupplierTeamTransfer->save();
                                Session::forget('teamType');
                                Session::forget('teamId');
                            }
                        }
                    }

                    return view('buyer.buyer-dashboard')->with([

                        'quotes' => $quotes,

                        'threads_cnt'=>$threads_cnt,

                        'contacts'=>$contacts,

                        'products'=>$products,

                        'activities'=>$activities,

                        'messageActivities'=>$messageActivities,

                        'alertActivities'=>$alertActivities,

                        'connectionActivities'=>$connectionActivities,

                        'userQuotes'=>$userQuotes,

                        'quote_cnt'=>$quote_cnt,

                        'quote_received'=>$SupplierQuotes,

                        'endorsements_cnt'=>$endorsements_cnt,

                        'contact_cnt'=>$contact_cnt,

                        'request_contact'=>$request_contact,

                        'lead_cnt'=>$Supplierquotes,

                        'company_verification_notify'=>$company_verification_notify,

                        'company_request' => $companyUsers]);

                }



            }

            else

            {

                $quotes = Quotes::where('created_by',$user_id)->get();

                Session::put('user_type','buyer');

                //team transfer management

                if(Session::has('email') && Session::has('teamType') && Session::has('teamId'))

                {
                    $logInEmail = Auth::user()->email;
                    $email = Session::get('email');

                    if($logInEmail == $email){
                        $user = User::where('email',$email)->first();
                        $teamType = Session::get('teamType');
                        $teamId = Session::get('teamId');

                        if($teamType == 'Purchasing'){
                            $buyerTeam = BuyerTeam::where('team_id',$teamId)->first();
                            $buyerTeam->user_id = $user->id;
                            $buyerTeam->save();

                            $buyerBuyRequests = BuyerTeamUserAssignedBuyRequest::where('buyer_team_id',$buyerTeam->id)->get();
                            if(count($buyerBuyRequests)>0){
                                foreach($buyerBuyRequests as $buyerBuyRequest){
                                    $buyerBuyRequest->user_id = $user->id;
                                    $buyerBuyRequest->save();
                                }
                            }

                            $buyerQuotes = BuyerTeamUserAssignedQuote::where('buyer_team_id',$buyerTeam->id)->get();
                            if(count($buyerQuotes)>0){
                                foreach($buyerQuotes as $buyerQuote){
                                    $buyerQuote->user_id = $user->id;
                                    $buyerQuote->save();
                                }
                            }

                            $buyerTeamTransfer = BuyerTeamTransfer::whereRaw('buyer_team_id = ? AND new_manager_id = ? AND status = ?',array($buyerTeam->id,$user->id,0))->first();
                            $buyerTeamTransfer->status = 1;
                            $buyerTeamTransfer->save();
                            Session::forget('teamType');
                            Session::forget('teamId');

                        }else{
                            $supplierTeam = SupplierTeam::where('supplier_team_id',$teamId)->first();
                            $supplierTeam->user_id = $user->id;
                            $supplierTeam->save();

                            $supplierLeadRequests = SupplierTeamUserLeadRequest::where('supplier_team_id',$supplierTeam->id)->get();
                            if(count($supplierLeadRequests)>0){
                                foreach($supplierLeadRequests as $supplierLeadRequest){
                                    $supplierLeadRequest->user_id = $user->id;
                                    $supplierLeadRequest->save();
                                }
                            }

                            $SupplierTeamTransfer = SupplierTeamTransfer::whereRaw('supplier_team_id = ? AND new_manager_id = ? AND status = ?',array($supplierTeam->id,$user->id,0))->first();
                            $SupplierTeamTransfer->status = 1;
                            $SupplierTeamTransfer->save();
                            Session::forget('teamType');
                            Session::forget('teamId');
                        }
                    }
                }

                return view('buyer.buyer-dashboard')->with([

                    'quotes' => $quotes,

                    'threads_cnt'=>$threads_cnt,

                    'contacts'=>$contacts,

                    'products'=>$products,

                    'activities'=>$activities,

                    'messageActivities'=>$messageActivities,

                    'alertActivities'=>$alertActivities,

                    'connectionActivities'=>$connectionActivities,

                    'userQuotes'=>$userQuotes,

                    'quote_received'=>$SupplierQuotes,

                    'endorsements_cnt'=>$endorsements_cnt,

                    'contact_cnt'=>$contact_cnt,

                    'request_contact'=>$request_contact,

                    'lead_cnt'=>$Supplierquotes,

                    'quote_cnt'=>$quote_cnt]);

            }



        }else if(Auth::user()->access_level == 4){

            Session::put('user_type','company');

            $randomCode = Auth::user()->unique_number;
            return view('company.company-dashboard')->with('randomCode',$randomCode);

        }

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



    public function notAuthorized(){

        return view('not-authorized');

    }



    /**

     * Change Supplier CRM

     */

    public function supplierCRM()
    {

        Session::forget('user_type');
        Session::put('user_type','supplier');

        if(isset($_REQUEST['pulsate']))
        {
            Session::put('pulsate',$_REQUEST['pulsate']);
            Session::put('login_fifth',1);
            Session::put('login_first_popup',1);
        }
        if(isset($_REQUEST['popup']))
        {
            return Redirect::to('user-dashboard?popup='.$_REQUEST['popup']);
        }
        else
        {
            return Redirect::to('user-dashboard');
        }

    }



    /**

     * Change Buyer CRM

     */

    public function buyerCRM()
    {
        Session::forget('user_type');
        Session::put('user_type','buyer');
        if(isset($_REQUEST['pulsate']))
        {
            Session::put('pulsate',$_REQUEST['pulsate']);
            Session::put('login_fifth',1);
            Session::put('login_first_popup',1);
        }
        if(isset($_REQUEST['popup']))
        {
            return Redirect::to('user-dashboard?popup='.$_REQUEST['popup']);
        }
        else
        {
            return Redirect::to('user-dashboard');
        }

    }



    /**

     * Buy Supplier CRM view

     */

    public function viewSupplierCRM()

    {

        return view('buyer.supplier-crm');

    }



    /**

     *  save Supplier Package

     */

    public function saveSupplierPackage()

    {

        $user_id = Auth::user()->id;

        $package = Input::get('supplier_package');

        $user = User::find($user_id);

        $user->access_level = 3;

        $user->save();



        $userDetail = UserDetails::where('user_id',$user_id)->first();

        $userDetail->account_type = 'Seller';

        $userDetail->save();



        Session::forget('user_type');

        Session::put('user_type','supplier');



        return Redirect::to('user-dashboard')->with('message', 'Your Indy John mode has changed.');

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



    /**

     * LinkedIn Verification view

     */

    public function viewEmailVerification()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $already_sent_email = '';

        $Verificatio = EmailVerification::where('email',$user->email)->first();

        if($Verificatio)

        {

            $today = date('Y-m-d');

            $EmailVerification = EmailVerification::whereRaw('expiry_date >= ? AND status = ?',array($today,0))->first();

            if($EmailVerification)

            {

                $already_sent_email = 1;

            }

            else

            {

                $already_sent_email = 2;

            }

        }

        else

        {

            $already_sent_email = 0;

        }

        return view('emailverification.index')->with(['user'=>$user,'already_sent_email'=>$already_sent_email]);

    }



    /**

     * Send Verification Email to user

     */

    public function sendEmailVerification()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        /// Email Verification

        $code = $this->randomCode();



        $exp_date = date('Y-m-d', strtotime('+2 days', strtotime(date('Y-m-d'))));



        $oldVerificatio = EmailVerification::where('email',Input::get('email'))->first();

        if($oldVerificatio)

        {

            $oldVerificatio->delete();

        }





        $EmailVerification = new EmailVerification;

        $EmailVerification->user_id = $user->id;

        $EmailVerification->email = Input::get('email');

        $EmailVerification->verification_code = $code;

        $EmailVerification->expiry_date = $exp_date;

        $EmailVerification->status = 0;

        $EmailVerification->save();



        $emaildata = array('name'=>Input::get('firstname').' '.Input::get('lastname'),'code'=>$code);

        Mail::send('admin.Emailtemplates.emailVerificationTemplate', $emaildata, function($message){

            $message->from(env('MAIL_USERNAME'), 'Indy John Team');

            $message->to(Input::get('email'), Input::get('firstname').' '.Input::get('lastname'))->subject('Verify your Indy John E-mail address');

        });



        return Redirect::to('user/email-verification')->with('message', 'A verification e-mail has been sent out to your e-mail address.');

    }



    /**

     * Email verification

     */

    public function emailVerification()

    {

        $success = 0;

        if(isset($_GET['verification_code']))

        {

            $code = $_GET['verification_code'];

            $today = date('Y-m-d');

            $EmailVerification = EmailVerification::whereRaw('verification_code = ? AND expiry_date >= ? AND status = ?',array($code,$today,0))->first();

            if($EmailVerification)

            {

                $EmailVerification->status = 1;

                $EmailVerification->save();

                $email = $EmailVerification->email;

                $user = User::where('email',$email)->first();

                $user->email_verify = 1;

                $user->save();

                return Redirect::to('user/email-verification')->with('message', 'You have successfully verified your e-mail address.');

            }

            else

            {

                return Redirect::to('user/email-verification')->with('message', 'Your e-mail verification link has expired. Please resubmit.');

            }

        }

        else

        {

            return Redirect::to('user/email-verification')->with('message', 'We were unable to verify your e-mail address. Please sign up again.');

        }

    }



    /**

     * LinkedIn Verification view

     */

    public function viewLinkedinVerification()

    {

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $redirect_uri = env('LINKEDIN_REDIRECT_URL', '');

        $client_id = env('LINKEDIN_CLIENT_ID', '');

        $client_secret = env('LINKEDIN_CLIENT_SECRETE', '');

        return view('linkedinverification.index')->with(['user'=>$user,'redirect_uri'=>$redirect_uri,'client_id'=>$client_id,'client_secret'=>$client_secret]);

    }



    /**

     * LinkedIn Verification Response

     */

    public function linkedinVerification()

    {

        $redirect_uri = env('LINKEDIN_REDIRECT_URL', '');

        $client_id = env('LINKEDIN_CLIENT_ID', '');

        $client_secret = env('LINKEDIN_CLIENT_SECRETE', '');

        $user_id = Auth::user()->id;

        $user = User::find($user_id);



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

                return Redirect::to('user/linkedin-verification?verify=0')->with('message',"We're having trouble verifying your LinkedIn profile. Please ensure you have listed your correct name and e-mail address on both LinkedIn and Indy John. Alternatively you can become verified completing Option 1 and Option 2.");

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

                        return Redirect::to('quotetek/user/verification?verify=0')->with('message', "We're having trouble verifying your LinkedIn profile. Please ensure you have listed your correct name and e-mail address on both LinkedIn and Indy John. Alternatively you can become verified completing Option 1 and Option 2.");

                    }

                    else{

                        $Profileresult = json_decode($output, true);

                        $email = $Profileresult['emailAddress'];

                        $useremail = $user->email;

                        if($email == $useremail)

                        {

                            $user->linkedin_verify = 1;

                            $user->save();

                            return Redirect::to('quotetek/user/verification?verify=1')->with('message',"Congratulations! You have successfully verified your Linkedin Profile. Please complete the remaining verification process and submit your application.");

                        }

                        else

                        {

                            return Redirect::to('quotetek/user/verification?verify=0')->with('message', "We're having trouble verifying your LinkedIn profile. Please ensure you have listed your correct name and e-mail address on both LinkedIn and Indy John. Alternatively you can become verified completing Option 1 and Option 2.");

                        }

                    }

                }

            }

        }

        return Redirect::to('quotetek/user/verification?verify=0')->with('message', "We're having trouble verifying your LinkedIn profile. Please ensure you have listed your correct name and e-mail address on both LinkedIn and Indy John. Alternatively you can become verified completing Option 1 and Option 2.");

    }

    public function saveReport(){
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        $report= new Report();
        $report->account_id = $userData->id;
        $report->account_email = $userData->email;
        $report->options = Input::get('reason');
        $report->comments = Input::get('comment');
        $report->ip_address = $_SERVER['REMOTE_ADDR'];
        $report->reported_date = date('Y-m-d');
        $report->reported_time = date('H:i:s');
        $report->save();

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

    public function viewImportCompanies()
    {
        return view('company.company.import_companies');
    }

    public function importCompanies()
    {

        $file = Input::file('file');

        $handle = fopen($file, 'r');
        $t=0;

        while (!feof($handle)) {
            $drs = fgetcsv($handle, 1024);
            $t++;
            if($t > 1 && trim($drs[0]) != "")
            {
                //echo trim($drs[0]).'=>'.trim($drs[1]).'=>',trim($drs[2]).'=>'.trim($drs[3]).'=>'.trim($drs[4]).'=>'.trim($drs[5]).'=>'.trim($drs[6]).'=>'.trim($drs[7]).'<br>';

                // Company
                $company = Company::where('email',trim($drs[2]))->first();
                if($company){
                    continue;
                }

                $company = new Company();
                $company->name = trim($drs[0]);
                $company->email = trim($drs[2]);
                $company->is_active = 1;

                // for user unique number
                $unique = UserUnique::first();
                $next = $unique->number+1;
                $unique->number = $next;
                $unique->save();

                $unique_number = 'IJU-'.$next;

                $company->unique_number = $unique_number;
                //$company->address = trim($drs[0]);
                if($drs[4] == ''){
                    $company->city = '';
                }else{
                    $company->city = trim($drs[4]);
                }

                if($drs[5] == ''){
                    $company->state = '';
                }else{
                    $company->state = trim($drs[5]);
                }

                if($drs[6] == ''){
                    $company->zip = '';
                }else{
                    $company->zip = trim($drs[6]);
                }

                $company->varification_status = 0;
                $company->owner_id = NULL;
                $company->user_id = NULL;
                $company->website	 = trim($drs[1]);
                $company->external_url = $this->seo_friendly_url(trim($drs[0])).'-'.$unique_number;
                $company->save();

                // company Category
                $categories = explode(",", trim($drs[7]));
                $checkCategory = Category::whereIn('id',$categories)->get();

                foreach($checkCategory as $category){

                    $companyCat = new CompanyCategories();
                    $companyCat->company_id = $company->id;
                    $companyCat->category_id = $category->id;
                    $companyCat->save();

                }

                //User
                $user = new User();
                $user->name = trim($drs[0]);
                $user->email = trim($drs[2]);
                $user->temporary_password = trim($drs[3]);
                $user->is_using_temporary_password = 1;
                $user->password = Hash::make($user->temporary_password);
                $user->access_level = 3;
                $user->email_verify = 1;
                $user->unique_number = $unique_number;
                $user->save();

                $userDetails = new UserDetails();
                $userDetails->first_name = $user->name;
                $userDetails->last_name = '';
                $userDetails->user_id = $user->id;
                $userDetails->company_id = $company->id;
                $userDetails->save();

                // Supplier Lead
                $supplierLeads = new SupplierLeads();
                $supplierLeads->created_by = $user->id;
                $supplierLeads->expiry_date = '';
                $supplierLeads->status = 1;
                $supplierLeads->save();

                // Lead Categories

                foreach($checkCategory as $category)
                {
                    $leadCat = new SupplierLeadCategories();
                    $leadCat->supplier_lead_id = $supplierLeads->id;
                    $leadCat->category_id = $category->id;
                    $leadCat->save();
                }

                //Lead Industries

                $industries = Industry::all();
                foreach($industries as $industry)
                {
                    $SupplierLeadIndustries = new SupplierLeadIndustries();
                    $SupplierLeadIndustries->supplier_lead_id = $supplierLeads->id;
                    $SupplierLeadIndustries->industry_id = $industry->id;
                    $SupplierLeadIndustries->save();
                }

                // Lead Equipment order types

                $equipmentOrderTypes = OrderTypes::where('order_type','Equipment')->get();

                foreach($equipmentOrderTypes as $equipment)
                {
                    $SupplierLeadEquipment = new SupplierLeadEquipment();
                    $SupplierLeadEquipment->supplier_lead_id = $supplierLeads->id;
                    $SupplierLeadEquipment->order_type_id = $equipment->id;
                    $SupplierLeadEquipment->save();
                }

                // Lead MaterialsTooling order types

                $materialsToolingOrderTypes = OrderTypes::where('order_type','MaterialsTooling')->get();
                foreach($materialsToolingOrderTypes as $materials_tooling)
                {
                    $SupplierLeadMaterialsTooling = new SupplierLeadMaterialsTooling();
                    $SupplierLeadMaterialsTooling->supplier_lead_id = $supplierLeads->id;
                    $SupplierLeadMaterialsTooling->order_type_id = $materials_tooling->id;
                    $SupplierLeadMaterialsTooling->save();
                }


                // Lead services order types

                $servicesOrderTypes = OrderTypes::where('order_type','Services')->get();
                foreach($servicesOrderTypes as $service)
                {
                    $SupplierLeadServices = new SupplierLeadServices();
                    $SupplierLeadServices->supplier_lead_id = $supplierLeads->id;
                    $SupplierLeadServices->order_type_id = $service->id;
                    $SupplierLeadServices->save();
                }

                // Lead Software order types

                $softwareOrderTypes = OrderTypes::where('order_type','Software')->get();
                foreach($softwareOrderTypes as $software)
                {
                    $SupplierLeadSoftware = new SupplierLeadSoftware();
                    $SupplierLeadSoftware->supplier_lead_id = $supplierLeads->id;
                    $SupplierLeadSoftware->order_type_id = $software->id;
                    $SupplierLeadSoftware->save();
                }

                // Lead ConsumableSuppliers order types

                $consumableSuppliersOrderTypes = OrderTypes::where('order_type','ConsumableSuppliers')->get();
                foreach($consumableSuppliersOrderTypes as $consumable_suppliers)
                {
                    $SupplierLeadConsumableSuppliers = new SupplierLeadConsumableSuppliers();
                    $SupplierLeadConsumableSuppliers->supplier_lead_id = $supplierLeads->id;
                    $SupplierLeadConsumableSuppliers->order_type_id = $consumable_suppliers->id;
                    $SupplierLeadConsumableSuppliers->save();
                }

                // Supplier Team
                $supplierTeam = new SupplierTeam();

                $allSupplierTeam = SupplierTeam::orderBy('created_at','desc')->first();
                $uniqueNo = 'IJE-10001';
                if($allSupplierTeam)
                {
                    $getNo = $allSupplierTeam->supplier_team_id;
                    $number = explode('-',$getNo);
                    $num = $number[1] + 1;
                    $uniqueNo = 'IJE-'.$num;
                }

                $supplierTeam->supplier_team_id = $uniqueNo;
                $supplierTeam->name = trim($drs[0]);
                $supplierTeam->type = 'Private';
                $supplierTeam->description = '';
                $supplierTeam->label = 'Regions';
                $supplierTeam->modified_date = date('Y-m-d');
                $supplierTeam->user_id = $user->id;
                $supplierTeam->save();

            }
        }

        //return Redirect('/')->with('message',"Company Data imported Successfully.");
        return Redirect('/?popup=company_import');
    }

    public function claimProfile(){
        return Redirect::to('/');
    }

    public function saveResetPassword(){
        $email = Auth::user()->email;
        $user = User::where('email',$email)->first();
        $user->is_using_temporary_password = 0;
        $password = Input::get('password');
        $user->password = Hash::make($password);
        $user->save();

        $company = Company::where('email',$email)->first();
        $company->user_id = $user->id;
        $company->save();

        $userDetails = new UserDetails();
        $userDetails->first_name = $user->name;
        $userDetails->last_name = '';
        $userDetails->user_id = $user->id;
        $userDetails->company_id = $company->id;
        $userDetails->save();

        return Redirect::to('/user-dashboard?popup=welcome');
    }

}

