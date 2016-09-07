<?php

namespace App\Http\Controllers;

use App\BuyerTeam;
use App\BuyerTeamUser;
use App\Quotes;
use App\SupplierLeadCategories;
use App\User;
use App\BuyerTeamTags;
use App\SupplierQuotes;
use App\UserDetails;
use App\BuyerTeamUserAssignedBuyRequest;
use App\BuyerTeamUserAssignedQuote;
use App\SupplierTeam;
use App\SupplierTeamUserLeadRequest;
use App\BuyerTeamTransfer;
use App\BuyerIgnoreQuotes;
use App\SupplierTeamTransfer;
use App\Subscriptions;
use App\ContactUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use Input;
use Auth;
use Response;
use Session;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PurchasingManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $buyerTeam = BuyerTeam::find($id);
        $buyerTeamTags = BuyerTeamTags::where('buyer_team_id',$id)->get();
        if($buyerTeamTags)
        {
            foreach($buyerTeamTags as $tags)
            {
                $tags->delete();
            }
        }

        $buyerTeamUser = BuyerTeamUser::where('team_id',$id)->get();
        if($buyerTeamUser)
        {
            foreach($buyerTeamUser as $teamUser)
            {
                $teamUser->delete();
            }
        }

        $buyerTeam->delete();

        return Redirect('/manage-purchasing-teams')->with('message','Your Purchasing Team and its Members has been removed.');
    }

    public function managePurchasingTeam(){

        $userId = Auth::user()->id;
        $buyerTeam = BuyerTeam::where('user_id',$userId)->get()->toArray();
        $allBuyerTeam = array();
        foreach($buyerTeam as $team)
        {
            $teamArray = array();
            $teamArray['id'] = $team['id'];
            $teamArray['nameOfTeam'] = $team['name'];
            $teamArray['teamId'] = $team['team_id'];
            $teamArray['memberCount'] = BuyerTeamUser::where('team_id',$team['id'])->where('status',1)->count();
            $teamArray['dateCreated'] = date('d-m-Y',strtotime($team['created_at']));
            $teamArray['dateLastActive'] = $team['modified_date'];
            $allBuyerTeam[] = $teamArray;
        }

        return view('purchasing-manager.manage-teams')->with([
            'allBuyerTeam'=>$allBuyerTeam
        ]);
    }

    /*public function editPurchasingTeam(){
        return view('purchasing-manager.edit-team');
    }*/

    public function manageMembers(){

        $team_id = '';
        $userId = Auth::user()->id;

        $allBuyerTeam = BuyerTeam::where('user_id',$userId)->get();

        if(isset($_REQUEST['team_id']))
        {
            $team_id = $_REQUEST['team_id'];
            Session::put('team_id', $team_id);

            $team_id = Session::get('team_id');
            if($team_id == '')
            {
                $buyerTeam = BuyerTeam::where('user_id',$userId)->get();
            }
            else
            {
                $buyerTeam = BuyerTeam::where('id',$team_id)->get();
            }
        }
        else
        {
            $buyerTeam = BuyerTeam::where('user_id',$userId)->get();
        }

        $buyerTeamArray = array();
        foreach($buyerTeam as $team)
        {
            $buyerTeamUser = BuyerTeamUser::where('team_id',$team->id)->where('status',1)->get();
            if($buyerTeamUser)
            {
                foreach($buyerTeamUser as $user)
                {
                    $userArray = array();
                    $userArray['teamName'] = $team->name;
                    $userDetails = UserDetails::where('user_id',$user->user_id)->first();
                    $userArray['userId'] = $userDetails->user_id;
                    $userArray['memberName'] = $userDetails->first_name.' '.$userDetails->last_name;
                    $userArray['memberSince'] = date('d-m-Y',strtotime($user->created_at));
                    $userArray['status'] = $userDetails->is_active;
                    if($team->label == 'Region')
                    {
                        $buyerTeamTags = BuyerTeamTags::where('buyer_team_id',$team->id)->get()->toArray();
                        if(count($buyerTeamTags) > 0)
                        {
                            $userArray['region'] = implode(', ', array_column($buyerTeamTags,'tag'));
                        }
                        else
                        {
                            $userArray['region'] = '';
                        }
                    }
                    else
                    {
                        $userArray['region'] = '';
                    }
                    $users = User::find($user->user_id);
                    if(!empty($users)){
                        $ContactUsersObj = ContactUsers::whereRaw('sender_user_id = ? AND request_user_id = ? AND status = ? ',array($userId,$users->id, 1))->first();
                        if(empty($ContactUsersObj)){
                            $ContactUsersObj = ContactUsers::whereRaw('sender_user_id = ? AND request_user_id = ? AND status = ? ',array($users->id,$userId, 1))->first();
                            if(empty($ContactUsersObj)){
                                $userArray['is_connected'] = false;
                            }else{
                                $userArray['is_connected'] = true;
                            }
                        }else{
                            $userArray['is_connected'] = true;
                        }

                        $userArray['accountType'] = $users->account_member;
                        $buyerTeamArray[] = $userArray;
                    }
                }
            }
            else
            {
                $buyerTeamArray = array();
            }
        }

        return view('purchasing-manager.manage-members')->with([
            'allBuyerTeam'=>$allBuyerTeam,
            'buyerTeamArray'=>$buyerTeamArray,
            'team_id'=>$team_id
        ]);
    }

    public function assignBuyRequest()
    {
        $userCreatedDate = date('Y-m-d', strtotime(Auth::user()->created_at));
        $currentDate = date('Y-m-d');
        $user_id = Auth::user()->id;

        $buyerTeam = BuyerTeam::where('user_id',$user_id)->orderBy('id', 'desc')->get();

        $teamId = null;
        if(Input::has('team_id')){
            $teamId = Input::get('team_id');
        }

        $SupplierQuotes = SupplierQuotes::whereRaw('buyer_id = ? AND preview = ?',array($user_id,0))->get();

        $date = date('Y-m-d');
        $buyerRequests = BuyerTeamUserAssignedBuyRequest::where('user_id',$user_id)->where('created_at','LIKE', '%'.$date.'%')->paginate(15);

        $quotes = Quotes::where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->where('created_by',$user_id)->get();

        $buyerRequestsArray = array();
        foreach($buyerRequests as $buyerRequest){
            $dataArray = array();
            $dataArray['teamId'] = $buyerRequest->buyer_team_id;
            $quote = Quotes::find($buyerRequest->buy_request_id);
            $dataArray['buy_request_name'] = $quote->title;
            $dataArray['id'] = $quote->id;
            $dataArray['assigned_id'] = $buyerRequest->id;
            $dataArray['buy_request_id'] = $quote->unique_number;
            $dataArray['created_on'] = $quote->created_at;
            $dataArray['assigned_on'] = $buyerRequest->created_at;
            $userDetails = UserDetails::where('user_id',BuyerTeamUser::find($buyerRequest->buyer_team_user_id)->user_id)->first();
            $dataArray['assigned_to'] = $userDetails->first_name.' '.$userDetails->last_name;
            $dataArray['assigned_to_id'] = $userDetails->user_id;

            $buyerRequestsArray[] = $dataArray;
        }
        $previousPageUrl = $buyerRequests->previousPageUrl();//previous page url
        $nextPageUrl = $buyerRequests->nextPageUrl();//next page url
        $lastPage = $buyerRequests->lastPage(); //Gives last page number
        $total = $buyerRequests->total();
        return view('purchasing-manager.assign-buy-requests')->with([
            'teamId'=>$teamId,
            'quotes'=>$quotes,
            'buyerTeam'=>$buyerTeam,
            'SupplierQuotes'=>$SupplierQuotes,
            'buyerRequestsArray'=>$buyerRequestsArray,
            'buyerRequests'=>$buyerRequests,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total]);
    }

    /**
     * Search Team User for send Lead Request
     */
    public function searchTeamUser()
    {
        $teamId = Input::get('teamId');

        $teamUsers = BuyerTeamUser::where('team_id',$teamId)->where('status',1)->get();
        $userListArray = array();
        foreach($teamUsers as $teamUser)
        {
            $dataArray = array();
            $dataArray['id'] = $teamUser->id;
            $usersData = UserDetails::where('user_id',$teamUser->user_id)->first();
            $dataArray['full_name'] = $usersData['first_name'].' '.$usersData['last_name'];
            $userListArray[] = $dataArray;
        }

        $ajaxArray = array();
        $ajaxArray['incomplete_results'] = false;
        $ajaxArray['items'] = $userListArray;
        return Response::json($ajaxArray);
    }

    public function saveBuyerRequests()
    {
        $teamMembers = Input::get('recipients');
        foreach($teamMembers as $value){
            $buyerRequests = new BuyerTeamUserAssignedBuyRequest();
            $buyerRequests->buyer_team_id = Input::get('team_name');
            $buyerRequests->buyer_team_user_id = $value;
            $buyerRequests->buy_request_id = Input::get('buyRequest');
            $buyerRequests->user_id = Auth::user()->id;
            $buyerRequests->save();
        }

        return Redirect('manager-assign-buy-requests')->with('message','Buy Request has been Assigned.');
    }

    public function viewAssignedBuyRequests()
    {
        $userId = Auth::user()->id;

        $allBuyerTeam = BuyerTeam::where('user_id',$userId)->get();

        $team_id = '';
        if(isset($_REQUEST['team_id']))
        {
            $team_id = $_REQUEST['team_id'];
            Session::put('team_id', $team_id);

            $team_id = Session::get('team_id');
            if($team_id == '')
            {
                $buyerRequests = BuyerTeamUserAssignedBuyRequest::where('user_id',$userId)->paginate(10);
            }
            else
            {
                $buyerRequests = BuyerTeamUserAssignedBuyRequest::where('buyer_team_id',$team_id)->paginate(10);
            }
        }
        else
        {
            $buyerRequests = BuyerTeamUserAssignedBuyRequest::where('user_id',$userId)->paginate(10);
        }

        $allBuyRequestArray = array();

        foreach($buyerRequests as $buyerRequest)
        {
            $buyerRequestArray = array();
            $buyerRequestArray['teamId'] = $buyerRequest->buyer_team_id;
            $quote = Quotes::find($buyerRequest->buy_request_id);
            $buyerRequestArray['buyRequestName'] = $quote->title;
            $buyerRequestArray['id'] = $quote->id;
            $buyerRequestArray['buyRequestId'] = $quote->unique_number;
            $buyerRequestArray['assigned_id'] = $buyerRequest->id;
            $buyerRequestArray['createdOn'] = date('d-m-Y',strtotime($quote->created_at));
            $buyerRequestArray['assignedOn'] = date('d-m-Y',strtotime($buyerRequest->created_at));
            $userDetails = UserDetails::where('user_id',BuyerTeamUser::find($buyerRequest->buyer_team_user_id)->user_id)->first();
            $buyerRequestArray['assigned_to_id'] = $userDetails->user_id;
            $buyerRequestArray['assignedTo'] = $userDetails->first_name.' '.$userDetails->last_name;

            $allBuyRequestArray[] = $buyerRequestArray;
        }

        $previousPageUrl = $buyerRequests->previousPageUrl();//previous page url
        $nextPageUrl = $buyerRequests->nextPageUrl();//next page url
        $lastPage = $buyerRequests->lastPage(); //Gives last page number
        $total = $buyerRequests->total();

        return view('purchasing-manager.view-assigned-buy-requests')->with([
            'buyerRequests'=>$buyerRequests,
            'allBuyRequestArray'=>$allBuyRequestArray,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total,
            'allBuyerTeam'=>$allBuyerTeam,
            'team_id'=>$team_id
        ]);
    }

    public function assignQuotes(){

        $user_id = Auth::user()->id;

        $buyerTeam = BuyerTeam::where('user_id',$user_id)->orderBy('id', 'desc')->get();

        $userQuotes = Quotes::where('created_by',$user_id)->get();

        $BuyerIgnoreQuotes = BuyerIgnoreQuotes::where('buyer_id',$user_id)->get();
        $result = array();
        $teamId = null;

        if(Input::has('team_id')){
            $teamId = Input::get('team_id');
        }
        foreach($BuyerIgnoreQuotes as $ignoreQoute)
        {
            $result[] = $ignoreQoute['supplier_quote_id'];
        }

        $quotes = SupplierQuotes::whereNotIn('id',$result)->whereRaw('buyer_id = ? AND preview = ?',array($user_id,0))->orderBy('id', 'desc')->get();

        foreach($quotes as $SupplierQuote)
        {
            $supplier_id = $SupplierQuote->supplier_id;
            $SupplierQuote->supplierUser = UserDetails::where('user_id',$supplier_id)->first();
            $SupplierQuote->supplier = User::find($supplier_id);
            /// Buy request data
            $buyRequest = $SupplierQuote->buyer_quote_id;
            $SupplierQuote->buy_request = Quotes::find($buyRequest);

            $subtotal = 0;
            foreach($SupplierQuote->SupplierQuoteItems as $item)
            {
                $subtotal += $item->price*$item->qty;
            }
            $SupplierQuote->price = $subtotal;
        }

        $date = date('Y-m-d');
        $buyerQuotes = BuyerTeamUserAssignedQuote::where('user_id',$user_id)->where('created_at','LIKE', '%'.$date.'%')->paginate(15);


        $buyerQuotesArray = array();
        foreach($buyerQuotes as $buyerQuote){

            $dataArray = array();
            $userData = UserDetails::where('user_id',$user_id)->first();
            $quote = SupplierQuotes::find($buyerQuote->buyer_quote_id);
            $supplierUser = UserDetails::where('user_id',$quote->supplier_id)->first();
            $dataArray['quote_received_from'] = $supplierUser->first_name.' '.$supplierUser->last_name;
            $dataArray['buy_request_name'] = Quotes::find($buyerQuote->buyer_quote_id)->title;
            $dataArray['quote_id'] = $quote->id;
            $dataArray['supplier_id'] = $quote->supplier_id;
            $dataArray['buy_request_id'] = $buyerQuote->buyer_quote_id;
            $dataArray['created_on'] = $quote->created_at;
            $dataArray['assigned_on'] = $buyerQuote->created_at;
            $userDetails = UserDetails::where('user_id',BuyerTeamUser::find($buyerQuote->buyer_team_user_id)->user_id)->first();
            $dataArray['assigned_to'] = $userDetails->first_name.' '.$userDetails->last_name;
            $dataArray['assigned_to_id'] = $userDetails->user_id;
            $dataArray['assigned_id'] = $buyerQuote->id;
            $dataArray['teamId'] = $buyerQuote->buyer_team_id;

            $buyerQuotesArray[] = $dataArray;
        }

        $previousPageUrl = $buyerQuotes->previousPageUrl();//previous page url
        $nextPageUrl = $buyerQuotes->nextPageUrl();//next page url
        $lastPage = $buyerQuotes->lastPage(); //Gives last page number
        $total = $buyerQuotes->total();

        return view('purchasing-manager.assign-quotes')->with(['teamId'=>$teamId, 'buyerTeam'=>$buyerTeam,'quotes'=>$quotes,'buyerQuotesArray'=>$buyerQuotesArray,'buyerQuotes'=>$buyerQuotes,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);

    }

    public function saveQuotes()
    {
        $teamMembers = Input::get('recipients');
        foreach($teamMembers as $value){
            $buyerQuotes = new BuyerTeamUserAssignedQuote();
            $buyerQuotes->buyer_team_id = Input::get('team_name');
            $buyerQuotes->buyer_team_user_id = $value;
            $buyerQuotes->buyer_quote_id = Input::get('quote');
            $buyerQuotes->user_id = Auth::user()->id;
            $buyerQuotes->save();
        }

        return Redirect('manager-assign-quotes')->with('message','Quote has been Assigned.');
    }

    public function viewAssignedQuotes(){

        $userId = Auth::user()->id;

        $allBuyerQuotesArray = array();

        $buyerQuotes = BuyerTeamUserAssignedQuote::where('user_id',$userId)->paginate(10);
        foreach($buyerQuotes as $buyerQuote)
        {
            $dataArray = array();
            $userData = UserDetails::where('user_id',$userId)->first();
            $quote = SupplierQuotes::find($buyerQuote->buyer_quote_id);
            $supplierUser = UserDetails::where('user_id',$quote->supplier_id)->first();
            $dataArray['quote_received_from'] = $supplierUser->first_name.' '.$supplierUser->last_name;
            $dataArray['buy_request_name'] = Quotes::find($buyerQuote->buyer_quote_id)->title;
            $dataArray['quote_id'] = $quote->id;
            $dataArray['supplier_id'] = $quote->supplier_id;
            $dataArray['buy_request_id'] = $buyerQuote->buyer_quote_id;
            $dataArray['created_on'] = $quote->created_at;
            $dataArray['assigned_on'] = $buyerQuote->created_at;
            $userDetails = UserDetails::where('user_id',BuyerTeamUser::find($buyerQuote->buyer_team_user_id)->user_id)->first();
            $dataArray['assigned_to'] = $userDetails->first_name.' '.$userDetails->last_name;
            $dataArray['assigned_to_id'] = $userDetails->user_id;
            $dataArray['assigned_id'] = $buyerQuote->id;
            $dataArray['teamId'] = $buyerQuote->buyer_team_id;

            $buyerQuotesArray[] = $dataArray;
        }

        $previousPageUrl = $buyerQuotes->previousPageUrl();//previous page url
        $nextPageUrl = $buyerQuotes->nextPageUrl();//next page url
        $lastPage = $buyerQuotes->lastPage(); //Gives last page number
        $total = $buyerQuotes->total();

        return view('purchasing-manager.view-assigned-quotes')->with([
            'buyerQuotesArray'=>$buyerQuotesArray,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total
        ]);
    }

    public function transferTeam(){
        $userId = Auth::user()->id;
        $buyerTeam = BuyerTeam::where('user_id',$userId)->get();

        $buyerTeamTransfer = BuyerTeamTransfer::paginate(10);
        foreach($buyerTeamTransfer as $transfer){
            $transfer->team_name = BuyerTeam::find($transfer->buyer_team_id)->name;
        }

        $previousPageUrl = $buyerTeamTransfer->previousPageUrl();//previous page url
        $nextPageUrl = $buyerTeamTransfer->nextPageUrl();//next page url
        $lastPage = $buyerTeamTransfer->lastPage(); //Gives last page number
        $total = $buyerTeamTransfer->total();

        return view('purchasing-manager.transfer-team')->with([
            'buyerTeam'=>$buyerTeam,
            'buyerTeamTransfer'=>$buyerTeamTransfer,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total
        ]);
    }

    public function transferManager(){

        $teamId = Input::get('team_id');
        $buyerTeam = BuyerTeam::find($teamId);

        $user_id = Auth::user()->id;
        $userInfo = UserDetails::where('user_id',$user_id)->first();
        $loginUsereName = $userInfo->first_name.' '.$userInfo->last_name;

        $userId = Input::get('manager_id');
        $user = User::find($userId);
        $userData = UserDetails::where('user_id',$userId)->first();
        $name = $userData->first_name.' '.$userData->last_name;
        $email = $user->email;

        $messageDetail = $loginUsereName.' have requested to transfer Team management for '.strtoupper($buyerTeam->name).' ( Team Id : '.$buyerTeam->team_id.' ) to you';

        $url = url('acceptForTeamTransfer').'?email='.$email.'&type=Purchasing&teamId='.$buyerTeam->team_id;
        $data = array('name'=>$name,'toEmail'=>$email,'messageDetail'=>$messageDetail,'url'=>$url);
        Mail::send('admin.Emailtemplates.messageForTeamTransfer', $data, function($message) use ($data) {
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to($data['toEmail'], $data['name'])->subject('You Received a New Message for team transfer on Indy John.');
        });

        $buyerTeamTransfer = new BuyerTeamTransfer();
        $buyerTeamTransfer->buyer_team_id = $teamId;
        $buyerTeamTransfer->old_manager_id = $buyerTeam->user_id;
        $buyerTeamTransfer->new_manager_id = $userId;
        $buyerTeamTransfer->initiated_date = date('Y-m-d');
        $buyerTeamTransfer->status = 0;
        $buyerTeamTransfer->save();

        return Redirect('/transfer-purchasing-team')->with('message','Team Transfer has been Requested.');
    }

    public function acceptTeamTransfer(){

        $user = Auth::user();
        if($user){
            $email = $user->email;
            if($_REQUEST['email'] == $email) {
                $teamId = $_REQUEST['teamId'];
                $teamType = $_REQUEST['type'];
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

                    return Redirect('/manage-purchasing-teams')->with('message','You are now Manager of'.$buyerTeam->name);

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

                    return Redirect('/manage-supplying-teams')->with('message','You are now Manager of'.$supplierTeam->name);
                }
            }else{
                $email = $_REQUEST['email'];
                $teamId = $_REQUEST['teamId'];
                $teamType = $_REQUEST['type'];

                Session::forget('email');
                Session::forget('teamType');
                Session::forget('teamId');

                Session::put('email',$email);
                Session::put('teamType',$teamType);
                Session::put('teamId',$teamId);

                return Redirect('/');
            }

        }else{

            $email = $_REQUEST['email'];
            $teamId = $_REQUEST['teamId'];
            $teamType = $_REQUEST['type'];

            Session::forget('email');
            Session::forget('teamType');
            Session::forget('teamId');

            Session::put('email',$email);
            Session::put('teamType',$teamType);
            Session::put('teamId',$teamId);

            return Redirect('/');
        }

    }

    public function cancelBuyRequestAssignment($id){
        $assignment = BuyerTeamUserAssignedQuote::find($id);
        $assignment->delete();
        return Redirect::back()->with('message', 'Quote assignment is canceled.');
    }

    public function teamBilling(){

        $teamId = null;
        if(Input::has('team_id')){
            $teamId = Input::get('team_id');
        }
        $userId = Auth::user()->id;

        $userId = Auth::user()->id;
        $buyerTeams = null;

        if($teamId != null){
            $buyerTeams = BuyerTeam::whereRaw('user_id = ? AND id = ?',array($userId,$teamId))->get();
        }else{
            $buyerTeams = BuyerTeam::where('user_id',$userId)->get();
        }

        $finalArray = array();
        $userArray = array(
            "active" => array(),
            "no_subscription" => array(),
            "completed" => array()
        );
        $activeUserArray = array();
        $inActiveUserArray = array();
        $completedArray = array();
        foreach($buyerTeams as $buyerTeam)
        {
            $buyerTeamUsers = BuyerTeamUser::where('team_id',$buyerTeam->id)->where('status',1)->get();

            foreach($buyerTeamUsers as $teamUser)
            {
                $activeSubscriptionsArray = array();
                $activeSupplierPackage = Subscriptions::whereRaw('user_id = ? AND status = ?',array($teamUser->user_id,'Active'))->whereIn('plan_id', [1, 6])->first();

                if($activeSupplierPackage){
                    $userData = UserDetails::where('user_id',$teamUser->user_id)->first();
                    $activeSubscriptionsArray['personName'] = $userData->first_name.' '.$userData->last_name;
                    $activeSubscriptionsArray['accountType'] = $activeSupplierPackage->name;
                    $activeSubscriptionsArray['billedOn'] =  $activeSupplierPackage->subscription_start;
                    $activeSubscriptionsArray['periodEnd'] = $activeSupplierPackage->subscription_end;
                    $activeSubscriptionsArray['paymentId'] = $activeSupplierPackage->payment_id;
                    $activeSubscriptionsArray['isCanceled'] = $activeSupplierPackage->is_canceled;
                    $activeSubscriptionsArray['id'] = $activeSupplierPackage->id;

                    $activeUserArray[] = $activeSubscriptionsArray;
                }else{
                    $userData = UserDetails::where('user_id',$teamUser->user_id)->first();
                    $createSubscriptionsArray['personName'] = $userData->first_name.' '.$userData->last_name;
                    $createSubscriptionsArray['user_id'] = $teamUser->user_id;
                    $createSubscriptionsArray['accountType'] = 'FREE ACCOUNT';
                    $inActiveUserArray[] = $createSubscriptionsArray;
                }

                $completedSubscriptionsArray = array();
                $package = Subscriptions::whereRaw('user_id = ? AND status = ?', array($teamUser->user_id, 'Completed'))->whereIn('plan_id', [1, 6])->get();
                $packages = $package->toArray();


                if(!empty($packages)){
                    foreach($packages as $package){
                        $dataArray = array();
                        $userData = UserDetails::where('user_id',$teamUser->user_id)->first();
                        $dataArray['personName'] = $userData->first_name.' '.$userData->last_name;
                        $dataArray['accountType'] = $package['name'];
                        $dataArray['billedOn'] =  $package['subscription_start'];
                        $dataArray['periodEnd'] = $package['subscription_end'];
                        $dataArray['paymentId'] = $package['payment_id'];

                        $completedArray[] = $dataArray;
                    }
                }
            }
            $finalArray[] = $userArray;
        }

        /*echo '<pre>';
        print_r($activeUserArray);
        print_r($inActiveUserArray);
        print_r($completedArray);
        echo '</pre>';
        exit();*/
        $buyerTeams = BuyerTeam::where('user_id',$userId)->get();

        return view('purchasing-manager.team-billing')->with([
            'buyuerTeams'=>$buyerTeams,
            'activeUserArray'=>$activeUserArray,
            'inActiveUserArray'=>$inActiveUserArray,
            'completedArray'=>$completedArray,
            'teamId'=>$teamId
        ]);
    }
}
