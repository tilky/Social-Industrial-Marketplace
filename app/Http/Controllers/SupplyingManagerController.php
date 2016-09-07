<?php

namespace App\Http\Controllers;

use App\BuyerTeamUser;
use App\Category;
use App\QuoteCategories;
use App\SupplierTeamUserLeadRequest;
use App\SupplierQuotes;
use App\Quotes;
use App\SupplierIgnoreQuotes;
use App\Subscriptions;
use App\SupplierTeam;
use App\SupplierTeamTags;
use App\SupplierTeamUser;
use App\User;
use App\UserDetails;
use App\ContactUsers;
use App\SupplierTeamTransfer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Session;
use Response;
use Mail;
use Illuminate\Support\Facades\Redirect;

class SupplyingManagerController extends Controller
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
        $supplierTeam = SupplierTeam::find($id);
        $supplierTeamTags = SupplierTeamTags::where('supplier_team_id',$id)->get();
        if($supplierTeamTags)
        {
            foreach($supplierTeamTags as $tags)
            {
                $tags->delete();
            }
        }

        $supplierTeamUser = SupplierTeamUser::where('supplier_team_id',$id)->get();
        if($supplierTeamUser)
        {
            foreach($supplierTeamUser as $teamUser)
            {
                $teamUser->delete();
            }
        }

        $supplierTeam->delete();

        return Redirect('/manage-supplying-teams')->with('message','Your Supplier Team and its Members has been removed.');
    }

    public function manageSupplyingTeams()
    {
        $userId = Auth::user()->id;
        $supplierTeam = SupplierTeam::where('user_id',$userId)->get()->toArray();
        $allSupplierTeam = array();
        foreach($supplierTeam as $team)
        {
            $teamArray = array();
            $teamArray['id'] = $team['id'];
            $teamArray['nameOfTeam'] = $team['name'];
            $teamArray['teamId'] = $team['supplier_team_id'];
            $teamArray['memberCount'] = SupplierTeamUser::where('supplier_team_id',$team['id'])->where('status',1)->count();
            $teamArray['dateCreated'] = date('d-m-Y',strtotime($team['created_at']));
            $teamArray['dateLastActive'] = $team['modified_date'];
            $allSupplierTeam[] = $teamArray;
        }

        return view('supplying-manager.manage-teams')->with([
            'allSupplierTeam'=>$allSupplierTeam
        ]);
    }

    public function manageMembers()
    {
        $team_id = '';
        $userId = Auth::user()->id;

        $allSupplierTeam = SupplierTeam::where('user_id',$userId)->get();

        if(isset($_REQUEST['team_id']))
        {
            $team_id = $_REQUEST['team_id'];
            Session::put('team_id', $team_id);

            $team_id = Session::get('team_id');
            if($team_id == '')
            {
                $supplierTeam = SupplierTeam::where('user_id',$userId)->get();
            }
            else
            {
                $supplierTeam = SupplierTeam::where('id',$team_id)->get();
            }
        }
        else
        {
            $supplierTeam = SupplierTeam::where('user_id',$userId)->get();
        }

        $supplierTeamArray = array();
        foreach($supplierTeam as $team)
        {
            $supplierTeamUser = SupplierTeamUser::where('supplier_team_id',$team->id)->where('status',1)->get();
            if($supplierTeamUser)
            {
                foreach($supplierTeamUser as $user)
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
                        $supplierTeamTags = SupplierTeamTags::where('supplier_team_id',$team->id)->get()->toArray();
                        if(count($supplierTeamTags) > 0)
                        {
                            $userArray['region'] = implode(', ', array_column($supplierTeamTags,'tag'));
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
                        $supplierTeamArray[] = $userArray;
                    }
                }
            }
            else
            {
                $supplierTeamArray = array();
            }
        }

        return view('supplying-manager.manage-members')->with([
            'allSupplierTeam'=>$allSupplierTeam,
            'supplierTeamArray'=>$supplierTeamArray,
            'team_id'=>$team_id
        ]);
    }

    public function assignLeadRequests()
    {
        $userId = Auth::user()->id;
        $supplierTeam = SupplierTeam::where('user_id',$userId)->orderBy('id', 'desc')->get();

        $userCreatedDate = date('Y-m-d', strtotime(Auth::user()->created_at));
        $currentDate = date('Y-m-d');

        $teamId = null;
        if(Input::has('team_id')){
            $teamId = Input::get('team_id');
        }

        $SupplierIgnoreQuotes = SupplierIgnoreQuotes::where('supplier_id',$userId)->get();
        $result = array();
        foreach($SupplierIgnoreQuotes as $ignoreQuote)
        {
            $result[] = $ignoreQuote['quote_id'];
        }
        $quotes = Quotes::whereIn('id',$result)->where('expiry_date','>',$currentDate)->where('created_at','>',$userCreatedDate)->get();
        $quoteArray = array();
        foreach($quotes as $quote)
        {
            $newArray = array();
            $newArray['quote_id'] = $quote->id;
            $quoteCategory = QuoteCategories::where('quote_id',$quote->id)->get()->toArray();
            if(count($quoteCategory) > 0)
            {
                $category = Category::whereIn('id',array_column($quoteCategory,'category_id'))->get()->toArray();
                $newArray['fieldLabel'] = implode(' - ', array_column($category,'name'));
                //$newArray['fieldLabel'] = implode(', ', array_column($quoteCategory,'category_id'));
            }
            else
            {
                $newArray['fieldLabel'] = '';
            }
            $newArray['submittedDate'] = date('d/m/Y',strtotime($quote->created_at));
            $quoteArray[] = $newArray;
        }

        $date = date('Y-m-d');
        $supplierTeamUserLeadRequests = SupplierTeamUserLeadRequest::where('user_id',$userId)->where('created_at','LIKE', '%'.$date.'%')->paginate(10);

        $supplierRequestsArray = array();
        foreach($supplierTeamUserLeadRequests as $teamUserRequest)
        {
            $dataArray = array();
            $quote = Quotes::find($teamUserRequest->lead_request_id);
            $dataArray['lead_request_name'] = $quote->title;
            $dataArray['lead_request_id'] = $quote->unique_number;
            $dataArray['id'] = $quote->id;
            $dataArray['created_on'] = date('d-m-Y',strtotime($quote->created_at));
            $dataArray['assigned_on'] = date('d-m-Y',strtotime($teamUserRequest->created_at));
                $userDetails = UserDetails::where('user_id',SupplierTeamUser::find($teamUserRequest->supplier_team_user_id)->user_id)->first();
            $dataArray['assigned_to'] = $userDetails->first_name.' '.$userDetails->last_name;
            $dataArray['teamId'] = $teamUserRequest->supplier_team_id;
            $dataArray['assigned_to_id'] = $userDetails->user_id;
            $dataArray['assigned_id'] = $teamUserRequest->id;

            $supplierRequestsArray[] = $dataArray;
        }

        $previousPageUrl = $supplierTeamUserLeadRequests->previousPageUrl();//previous page url
        $nextPageUrl = $supplierTeamUserLeadRequests->nextPageUrl();//next page url
        $lastPage = $supplierTeamUserLeadRequests->lastPage(); //Gives last page number
        $total = $supplierTeamUserLeadRequests->total();

        return view('supplying-manager.assign-lead-requests')->with([
            'teamId'=>$teamId,
            'supplierTeam'=>$supplierTeam,
            'quotes'=>$quoteArray,
            'supplierRequestsArray'=>$supplierRequestsArray,
            'supplierTeamUserLeadRequests'=>$supplierTeamUserLeadRequests,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total
        ]);
    }

    public function searchTeamUser()
    {
        $teamId = Input::get('teamId');

        $supplierTeamUser = SupplierTeamUser::where('supplier_team_id',$teamId)->where('status',1)->get();
        $supplierTeamUserArray = array();
        foreach($supplierTeamUser as $teamUser)
        {
            $dataArray = array();
            $dataArray['id'] = $teamUser->user_id;
            $userDetails = UserDetails::where('user_id',$teamUser->user_id)->first();
            $dataArray['full_name'] = $userDetails->first_name.' '.$userDetails->last_name;
            $supplierTeamUserArray[] = $dataArray;
        }

        $ajaxArray = array();
        $ajaxArray['incomplete_results'] = false;
        $ajaxArray['items'] = $supplierTeamUserArray;
        return Response::json($ajaxArray);
    }

    public function saveLeadRequests()
    {
        $userId = Auth::user()->id;
        $teamMembers = Input::get('recipients');

        foreach($teamMembers as $value)
        {
            $supplierTeamUserLeadRequests = new SupplierTeamUserLeadRequest();
            $supplierTeamUserLeadRequests->user_id = $userId;
            $supplierTeamUserLeadRequests->supplier_team_id = Input::get('team_name');
            $supplierTeamUserLeadRequests->supplier_team_user_id = $value;
            $supplierTeamUserLeadRequests->lead_request_id = Input::get('leadRequest');
            $supplierTeamUserLeadRequests->save();
        }

        return Redirect('manager-assign-lead-requests')->with('message','Lead Request has been assigned.');
    }

    public function assignLeads()
    {
        return view('supplying-manager.assign-leads');
    }

    public function viewAssignedLeadRequests()
    {
        $userId = Auth::user()->id;

        $allSupplierTeam = SupplierTeam::where('user_id',$userId)->get();

        $team_id = '';
        if(isset($_REQUEST['team_id']))
        {
            $team_id = $_REQUEST['team_id'];
            Session::put('team_id', $team_id);

            $team_id = Session::get('team_id');
            if($team_id == '')
            {
                $supplierLeadRequests = SupplierTeamUserLeadRequest::where('user_id',$userId)->paginate(10);
            }
            else
            {
                $supplierLeadRequests = SupplierTeamUserLeadRequest::where('supplier_team_id',$team_id)->paginate(10);
            }
        }
        else
        {
            $supplierLeadRequests = SupplierTeamUserLeadRequest::where('user_id',$userId)->paginate(10);
        }


        $allSupplierLeadRequestArray = array();

        foreach($supplierLeadRequests as $leadRequest)
        {
            $leadRequestArray = array();
            $leadRequestArray['teamId'] = $leadRequest->supplier_team_id;
            $quote = Quotes::find($leadRequest->lead_request_id);
            $leadRequestArray['leadRequestName'] = $quote->title;
            $leadRequestArray['id'] = $quote->id;
            $leadRequestArray['leadRequestId'] = $quote->unique_number;
            $leadRequestArray['assigned_id'] = $leadRequest->id;
            $leadRequestArray['createdOn'] = date('d-m-Y',strtotime($quote->created_at));
            $leadRequestArray['assignedOn'] = date('d-m-Y',strtotime($leadRequest->created_at));
                $userDetails = UserDetails::where('user_id',SupplierTeamUser::find($leadRequest->supplier_team_user_id)->user_id)->first();
            $leadRequestArray['assigned_to_id'] = $userDetails->user_id;
            $leadRequestArray['assignedTo'] = $userDetails->first_name.' '.$userDetails->last_name;
            $allSupplierLeadRequestArray[] = $leadRequestArray;
        }

        $previousPageUrl = $supplierLeadRequests->previousPageUrl();//previous page url
        $nextPageUrl = $supplierLeadRequests->nextPageUrl();//next page url
        $lastPage = $supplierLeadRequests->lastPage(); //Gives last page number
        $total = $supplierLeadRequests->total();

        return view('supplying-manager.view-assigned-lead-requests')->with([
            'supplierLeadRequests'=>$supplierLeadRequests,
            'allSupplierLeadRequestArray'=>$allSupplierLeadRequestArray,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total,
            'allSupplierTeam'=>$allSupplierTeam,
            'team_id'=>$team_id
        ]);
    }

    public function viewAssignedLeads(){
        return view('supplying-manager.view-assigned-leads');
    }

    public function cancelLeadRequestAssignment($id){
        $assignment = SupplierTeamUserLeadRequest::find($id);
        $assignment->delete();
        return Redirect::back()->with('message', 'Lead assignment is canceled.');
    }

    public function teamBilling(){

        $teamId = null;
        if(Input::has('team_id')){
            $teamId = Input::get('team_id');
        }
        $userId = Auth::user()->id;

        $userId = Auth::user()->id;
        $supplyingTeams = null;

        if($teamId != null){
            $supplyingTeams = SupplierTeam::whereRaw('user_id = ? AND id = ?',array($userId,$teamId))->get();
        }else{
            $supplyingTeams = SupplierTeam::where('user_id',$userId)->get();
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
        foreach($supplyingTeams as $buyerTeam)
        {
            $buyerTeamUsers = SupplierTeamUser::where('supplier_team_id',$buyerTeam->id)->where('status',1)->get();

            foreach($buyerTeamUsers as $teamUser)
            {
                $activeSubscriptionsArray = array();
                $activeSupplierPackage = Subscriptions::whereRaw('user_id = ? AND status = ?',array($teamUser->user_id,'Active'))->whereIn('plan_id', [3, 4, 7, 8])->first();

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
                $package = Subscriptions::whereRaw('user_id = ? AND status = ?', array($teamUser->user_id, 'Completed'))->whereIn('plan_id', [3, 4, 7, 8])->get();
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
        $supplyingTeams = SupplierTeam::where('user_id',$userId)->get();

        return view('supplying-manager.team-billing')->with([
            'supplyingTeams'=>$supplyingTeams,
            'activeUserArray'=>$activeUserArray,
            'inActiveUserArray'=>$inActiveUserArray,
            'completedArray'=>$completedArray,
            'teamId'=>$teamId
        ]);
    }

    public function transferTeam(){
        $userId = Auth::user()->id;
        $supplierTeam = SupplierTeam::where('user_id',$userId)->get();

        $supplierTeamTransfer = SupplierTeamTransfer::paginate(10);
        foreach($supplierTeamTransfer as $transfer){
            $transfer->team_name = SupplierTeam::find($transfer->supplier_team_id)->name;
        }

        $previousPageUrl = $supplierTeamTransfer->previousPageUrl();//previous page url
        $nextPageUrl = $supplierTeamTransfer->nextPageUrl();//next page url
        $lastPage = $supplierTeamTransfer->lastPage(); //Gives last page number
        $total = $supplierTeamTransfer->total();

        return view('supplying-manager.transfer-team')->with([
            'supplierTeam'=>$supplierTeam,
            'supplierTeamTransfer'=>$supplierTeamTransfer,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total
        ]);
    }

    public function transferManager(){

        $teamId = Input::get('team_id');
        $supplierTeam = SupplierTeam::find($teamId);

        $user_id = Auth::user()->id;
        $userInfo = UserDetails::where('user_id',$user_id)->first();
        $loginUsereName = $userInfo->first_name.' '.$userInfo->last_name;

        $userId = Input::get('manager_id');
        $user = User::find($userId);
        $userData = UserDetails::where('user_id',$userId)->first();
        $name = $userData->first_name.' '.$userData->last_name;
        $email = $user->email;

        $messageDetail = $loginUsereName.' have requested to transfer Team management for '.strtoupper($supplierTeam->name).' ( Team Id : '.$supplierTeam->supplier_team_id.' ) to you';

        $url = url('acceptForTeamTransfer').'?email='.$email.'&type=Supplying&teamId='.$supplierTeam->supplier_team_id;
        $data = array('name'=>$name,'toEmail'=>$email,'messageDetail'=>$messageDetail,'url'=>$url);
        Mail::send('admin.Emailtemplates.messageForTeamTransfer', $data, function($message) use ($data) {
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to($data['toEmail'], $data['name'])->subject('You Received a New Message for team transfer on Indy John.');
        });

        $SupplierTeamTransfer = new SupplierTeamTransfer();
        $SupplierTeamTransfer->supplier_team_id = $teamId;
        $SupplierTeamTransfer->old_manager_id = $supplierTeam->user_id;
        $SupplierTeamTransfer->new_manager_id = $userId;
        $SupplierTeamTransfer->initiated_date = date('Y-m-d');
        $SupplierTeamTransfer->status = 0;
        $SupplierTeamTransfer->save();

        return Redirect('/transfer-supplying-team')->with('message','Team Transfer has been Requested.');
    }

}
