<?php

namespace App\Http\Controllers;

use App\Message;
use App\Participant;
use App\Thread;
use App\MessageAttachments;
use App\UsersActivity;
use App\Quotes;
use App\SupplierTeamUserLeadRequest;
use App\Industry;
use App\SupplierTeam;
use App\SupplierTeamTags;
use App\SupplierTeamUser;
use App\UserDetails;
use App\User;
use App\Company;
use App\ContactUsers;
use Illuminate\Http\Request;
use App\SingupEmailVerification;

use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Mail;
use Session;

class SupplierTeamController extends Controller
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
        $input = Input::all();

        $destinationPath = 'public/message/attchments'; // upload path

        $this->validate($request, [
            'recipients' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);


        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );
        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
            ]
        );
        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants($input['recipients']);

            /// User Activity for message
            foreach($input['recipients'] as $receiver)
            {
                $usersActivity = new UsersActivity;
                $usersActivity->activity_name = 'Send New Message to Supplying Team Members';
                $usersActivity->activity_id = $thread->id;
                $usersActivity->activity_type = 'supplying team message';
                $usersActivity->creater_id = Auth::user()->id;
                $usersActivity->receiver_id = $receiver;
                $usersActivity->save();
            }

        }

        if(Input::file('additional_file'))
        {
            foreach(Input::file('additional_file') as $file)
            {
                if(!empty($file))
                {
                    $attachment_path = '';
                    $filename = str_replace(' ','_',$input['subject']).'_'.rand(11111,99999). '.' .$file->getClientOriginalExtension();
                    $file->move(
                        base_path() . '/'.$destinationPath, $filename
                    );

                    $attachment_path = 'message/attchments/'.$filename;

                    $MessageAttachments = new MessageAttachments;
                    $MessageAttachments->thread_id = $thread->id;
                    $MessageAttachments->attachment_path = $attachment_path;
                    $MessageAttachments->save();
                }
            }
        }


        /* message mail to receiver */
        $message_detail = substr($input['message'], 0, 50);

        $senderData = User::find(Auth::user()->id);

        $sender_first_name = $senderData->userdetail->first_name;
        $sender_last_name = $senderData->userdetail->last_name;

        if (Input::has('recipients'))
        {
            foreach(Input::get('recipients') as $index => $receiver)
            {
                $receiver = User::find($receiver);

                $receiverUrl = url('home/user/profile').'/'.$receiver->userdetail->user_id;
                $name = $receiver->userdetail->first_name.' '.$receiver->userdetail->last_name;

                Input::replace(array('email' => $receiver->email,'name'=>$name));

                $data = array('name'=>Input::get('name'),'fromEmail'=>$senderData->email,'sender_first_name'=>$sender_first_name,'sender_last_name'=>$sender_last_name,'message_detail'=>$message_detail);
                Mail::send('admin.Emailtemplates.messageReceived', $data, function($message) use ($data) {
                    $message->from($data['fromEmail'], 'Indy John Team');
                    $message->to(Input::get('email'), Input::get('name'))->subject('You Received a New Message on Indy John.');
                });
            }
        }

        return redirect('messages')->with('message', 'Your message was sent.');

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
        $supplierTeamUser = SupplierTeamUser::where('user_id','=',$id)->first();

        $userDetails = UserDetails::where('user_id',$supplierTeamUser->user_id)->first();
        $user = User::find($supplierTeamUser->user_id);
        if($userDetails)
        {
            $userName = $userDetails->first_name.' '.$userDetails->last_name;
        }
        else
        {
            $userName = $user->name;
        }

        $userEmail = $user->email;
        $teamName = SupplierTeam::find($supplierTeamUser->supplier_team_id)->name;

        $messageDetail = 'You have been removed from the '.strtoupper($teamName).'. You will no longer be able to access any assigned items.';

        $data = array('name'=>$userName,'email'=>$userEmail,'messageDetail'=>$messageDetail);
        Mail::send('admin.Emailtemplates.teamMessage', $data, function($message) use ($data) {
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to($data['email'],$data['name'])->subject('Message from IndyJohn for removing Supplying Team Member');
        });



        return Redirect('/manage-supplying-team-members')->with('message','Your Supplier Team Member has been removed.');
    }

    public function aboutSupplyingTeams()
    {
        return view('supplying-team.about-supplying-teams');
    }

    public function startSupplyingTeams()
    {
        $supplierTeam = new SupplierTeam;

        return view('supplying-team.start-supplying-team')->with([
            'supplierTeam'=>$supplierTeam,
            'inviteUsers'=>0
        ]);
    }

    public function editSupplyingTeam($id)
    {
        $supplierTeam = SupplierTeam::find($id);
            $supplierTeamTags = SupplierTeamTags::where('supplier_team_id',$id)->get()->toArray();
        if(count($supplierTeamTags) > 0)
        {
            $allSupplierTeamTags = implode(', ', array_column($supplierTeamTags,'tag'));
        }
        else
        {
            $allSupplierTeamTags = '';
        }
        $supplierTeamUser = SupplierTeamUser::where('supplier_team_id',$id)->where('status',1)->get()->toArray();
        $supplierTeamUserArray = array();
        if(count($supplierTeamUser) > 0)
        {
            foreach($supplierTeamUser as $supplierUsers)
            {
                $dataArray = array();
                $userData = UserDetails::where('user_id',$supplierUsers['user_id'])->first();
                $dataArray['userId']  = $supplierUsers['user_id'];
                $dataArray['userName']  = $userData->first_name.''.$userData->last_name;

                $supplierTeamUserArray[] = $dataArray;
            }
        }

        $allUsers = UserDetails::all();

        $inviteUsers = 0;
        if(Input::has('inviteUsers')){
            $inviteUsers = 1;
        }

        return view('supplying-team.start-supplying-team')->with([
            'id'=>$id,
            'supplierTeam'=>$supplierTeam,
            'supplierTeamTags'=>$allSupplierTeamTags,
            'supplierTeamUserArray'=>$supplierTeamUserArray,
            'allUsers'=>$allUsers,
            'inviteUsers'=>$inviteUsers
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

    public function saveSupplierTeam()
    {
        $authId = Auth::user()->id;

        $authUser = UserDetails::where('user_id',$authId)->first();
        $loginUser = User::find($authId);
        if($authUser)
        {
            $managerName = $authUser->first_name.' '.$authUser->last_name;
        }
        else
        {
            $managerName = $loginUser->name;
        }

        $managerEmail = $loginUser->email;

        if(Input::has('id'))
        {
            $editOrAdd = 'edit';
            $id = Input::get('id');
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
                foreach($supplierTeamUser as $users)
                {
                    $users->delete();
                }
            }
        }
        else
        {
            $editOrAdd = 'add';
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

            /*$messageDetail = 'You have created a New Supplying Team. Log in to Indy John and invite members to join your team.';

            $data = array('name'=>$managerName,'email'=>$managerEmail,'messageDetail'=>$messageDetail);
            Mail::send('admin.Emailtemplates.teamMessage', $data, function($message) use ($data) {
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to($data['email'],$data['name'])->subject('Message from IndyJohn for Supplying Team Creation');
            });*/
        }

        $supplierTeam->name = Input::get('name');
        $supplierTeam->type = Input::get('type');
        $supplierTeam->description = Input::get('description');
        $supplierTeam->label = Input::get('label');
        $supplierTeam->modified_date = date('Y-m-d');
        $supplierTeam->user_id = Auth::user()->id;
        $supplierTeam->save();

        if(Input::has('tags'))
        {
            $allTags = Input::get('tags');
            $tags = explode(',',$allTags);
            foreach($tags as $tag)
            {
                $supplierTeamTags = new SupplierTeamTags();
                $supplierTeamTags->supplier_team_id = $supplierTeam->id;
                $supplierTeamTags->tag = $tag;
                $supplierTeamTags->save();
            }
        }

        $inviteNowOrLater = Input::get('invite');
        if($inviteNowOrLater == 'inviteNow')
        {

            $code = $this->randomCode();

            $title = Input::get('title');
            $email = Input::get('email');
            for($i=0;$i<count($title);$i++)
            {
                $userName = $title[$i];
                $userEmail = $email[$i];

                if($userName != '' && $userEmail != '')
                {
                    $checkEmail = User::where('email',$userEmail)->first();
                    if($checkEmail){
                        return redirect('edit-purchasing-team/'.$supplierTeam->id.'#tab2')->with('message','Email already exists.');
                    }

                    $singupemail = new SingupEmailVerification;
                    $singupemail->email = $userEmail;
                    $singupemail->verification_code = $code;
                    $singupemail->referral_code = '';
                    $singupemail->expiry_date = date('Y-m-d');
                    $singupemail->status = 1;
                    $singupemail->save();

                    $messageDetail = 'You have been added to '.strtoupper($supplierTeam->name).' ( Team Id : '.$supplierTeam->supplier_team_id.' ) by '.strtoupper($managerName).' Access your Team details from the Supplying Team Menu.';

                    $url = url('verification/link').'/'.$code.'?email='.$userEmail.'&type=Supplying&teamId='.$supplierTeam->supplier_team_id;
                    $data = array('name'=>$userName,'email'=>$userEmail,'messageDetail'=>$messageDetail,'url'=>$url);
                    Mail::send('admin.Emailtemplates.teamMemberVerification', $data, function($message) use ($data) {
                        $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                        $message->to($data['email'],$data['name'])->subject('Invitation from IndyJohn to Join Team');
                    });
                }
            }

            if(Input::has('indyJohnUsers'))
            {
                $indyJohnUsers = Input::get('indyJohnUsers');
                foreach($indyJohnUsers as $user)
                {
                    $supplierTeamUser = new SupplierTeamUser();
                    $supplierTeamUser->supplier_team_id = $supplierTeam->id;
                    $supplierTeamUser->user_id = $user;
                    $supplierTeamUser->status = 1;
                    $supplierTeamUser->save();

                    $userDetails = UserDetails::where('user_id',$user)->first();
                    $userData = User::find($user);
                    if($userDetails)
                    {
                        $name = $userDetails->first_name.' '.$userDetails->last_name;
                    }
                    else
                    {
                        $name = $userData->name;
                    }

                    /// User Activity for message
                    $usersActivity = new UsersActivity;
                    $usersActivity->activity_name = 'You have been added to '.strtoupper($supplierTeam->name).' ( Team Id : '.$supplierTeam->supplier_team_id.' ) for supplying team member';
                    $usersActivity->activity_id = $supplierTeam->user_id;
                    $usersActivity->activity_type = 'user invitation for team';
                    $usersActivity->creater_id =  Auth::user()->id;
                    $usersActivity->receiver_id = $user;
                    $usersActivity->save();

                    $messageDetail = 'You have been added to '.strtoupper($supplierTeam->name).' ( Team Id : '.$supplierTeam->supplier_team_id.' ) by '.strtoupper($managerName).' Access your Team details from the Supplying Team Menu.';

                    $data = array('name'=>$name,'email'=>$userData->email,'messageDetail'=>$messageDetail);
                    Mail::send('admin.Emailtemplates.teamMessage', $data, function($message) use ($data) {
                        $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                        $message->to($data['email'],$data['name'])->subject('Invitation from IndyJohn to Join Supplying Team');
                    });
                }
            }
        }

        if($editOrAdd == 'edit')
        {
            return Redirect('/manage-supplying-teams')->with('message','Your Supplier Team has been updated.');
        }
        else
        {
            return Redirect('/edit-supplying-team/'.$supplierTeam->id."?inviteUsers=true")->with('message','Your Supplier Team has been created.');
        }
    }

    public function manageSupplyingTeams()
    {
        $userId = Auth::user()->id;
        $supplierTeam = SupplierTeam::whereIn('id', function($query)use ($userId){
            $query->select('supplier_team_id')
                ->from('supplier_team_user')
                ->where('user_id', $userId);
        })->union(SupplierTeam::where('user_id',$userId))->get();

        $mySupplierTeam = array();
        foreach($supplierTeam as $team)
        {
            $teamArray = array();
            $teamArray['teamName'] = $team->name;
            if($team->user_id == $userId){
                $teamArray['role'] = 'Manager';
            }else{
                $teamArray['role'] = 'Member';
            }
            $teamArray['lastTeamActivity'] = date('d-m-Y',strtotime($team->modified_date));
            $teamArray['assignedTerritory'] = 'N/A';
                $userData = UserDetails::where('user_id',$team->user_id)->first();
            $teamArray['teamManager'] = $userData->first_name.' '.$userData->last_name;
            $teamArray['teamCreationDate'] = date('d-m-Y',strtotime($team->created_at));
            $teamArray['teamId'] = $team->id;
            $mySupplierTeam[] = $teamArray;
        }

        $previousPageUrl = '';//$supplierTeam->previousPageUrl();//previous page url
        $nextPageUrl = '';//$supplierTeam->nextPageUrl();//next page url
        $lastPage = '';//$supplierTeam->lastPage(); //Gives last page number
        $total = count($supplierTeam);

        return view('supplying-team.manage-my-teams')->with([
            'mySupplierTeam'=>$mySupplierTeam,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total
        ]);
    }

    public function viewTeamMembers($teamId)
    {
        $checkIfUserAuthenticated = SupplierTeam::find($teamId);
        $userId = Auth::user()->id;

        $supplierTeam = SupplierTeam::whereIn('id', function($query)use ($userId){
            $query->select('supplier_team_id')
                ->from('supplier_team_user')
                ->where('user_id', $userId);
        })->get();
        //$supplierTeam = SupplierTeam::where('user_id',$userId)->get()->toArray();

        $supplierTeamUser = SupplierTeamUser::where('supplier_team_id',$teamId)->where('status',1)->get();
        $allSupplierTeamUser = array();
        foreach($supplierTeamUser as $teamUser)
        {
            $userArray = array();
            $userDetails = UserDetails::where('user_id',$teamUser->user_id)->first();
            $userArray['fullName'] = $userDetails->first_name.' '.$userDetails->last_name;
            $userArray['userId'] = $userDetails->user_id;
            $userArray['profilePicture'] = $userDetails->profile_picture;
            $user = User::find($teamUser->user_id);
            $userArray['uniqueNumber'] = $user->unique_number;
            $userArray['lastLogin'] = date('d/m/Y',strtotime($user->updated_at));
            $tagsArray = SupplierTeamTags::where('supplier_team_id',$teamId)->get()->toArray();
            if(count($tagsArray) > 0)
            {
                $userArray['assignedTerritory'] = implode(', ', array_column($tagsArray,'tag'));
            }
            else
            {
                $userArray['assignedTerritory'] = '';
            }
            $userArray['star'] = User::find($teamUser->user_id)->account_member;
            $userArray['quotetekVerify'] = User::find($teamUser->user_id)->quotetek_verify;
            $userArray['currentPosition'] = $userDetails->current_position;
            if($userDetails->company_id != null)
            {
                $userArray['companyName'] = Company::find($userDetails->company_id)->name;
            }
            else
            {
                $userArray['companyName'] = '';
            }
            $userArray['about'] = $userDetails->about;
            $userArray['city'] = $userDetails->city;
            $userArray['state'] = $userDetails->state;
            $userArray['country'] = $userDetails->country;
            if($userDetails->industry_id != '')
            {
                $userArray['industry'] = Industry::find($userDetails->industry_id)->name;
            }
            else
            {
                $userArray['industry'] = '';
            }

            //Check if user is in connection or else
            $ContactUsersObj = ContactUsers::whereRaw('sender_user_id = ? AND request_user_id = ? AND status = ? ',array($userId,$userDetails->user_id, 1))->first();
            if(empty($ContactUsersObj)){
                $ContactUsersObj = ContactUsers::whereRaw('sender_user_id = ? AND request_user_id = ? AND status = ? ',array($userDetails->user_id,$userId, 1))->first();
                if(empty($ContactUsersObj)){
                    $userArray['is_connected'] = false;
                }else{
                    $userArray['is_connected'] = true;
                }
            }else{
                $userArray['is_connected'] = true;
            }

            $allSupplierTeamUser[] = $userArray;
        }

        return view('supplying-team.view-team-members')->with([
            'supplierTeam'=>$supplierTeam,
            'supplierTeamUser'=>$allSupplierTeamUser
        ]);

        /*if($checkIfUserAuthenticated->user_id == $userId)
        {

        }
        else
        {
            return redirect('not-authorized');
        }*/
    }

    public function assignLeadRequest()
    {
        $userId = Auth::user()->id;

        $allSupplierTeam = SupplierTeam::whereIn('id', function($query)use ($userId){
            $query->select('supplier_team_id')
                ->from('supplier_team_user')
                ->where('user_id', $userId);
        })->get();

        if(Session::get('lead_order_name') != '')
        {
            if(isset($_REQUEST['lead_order_name']))
            {
                $order_name = $_REQUEST['lead_order_name'];
                $order_by = $_REQUEST['lead_order_by'];
                $hidden_val = $order_by;
                Session::put('lead_order_name', $order_name);
                Session::put('lead_order_by', $order_by);
                Session::put('lead_hidden_val', $hidden_val);
                Session::put('lead_hidden_name', $order_name);
            }
        }
        else
        {
            $order_name = 'created_at';
            $order_by = 'desc';
            $hidden_val = 'desc';
            $hidden_name = 'created_at';
            Session::put('lead_order_name', $order_name);
            Session::put('lead_order_by', $order_by);
            Session::put('lead_hidden_val', $hidden_val);
            Session::put('lead_hidden_name', $hidden_name);
        }

        $order_name = Session::get('lead_order_name');
        $order_by = Session::get('lead_order_by');
        $hidden_val = Session::get('lead_hidden_val');
        $hidden_name = Session::get('lead_hidden_name');

        $team_id = '';
        if(isset($_REQUEST['team_id']))
        {
            $team_id = $_REQUEST['team_id'];
            Session::put('team_id', $team_id);

            $team_id = Session::get('team_id');
            if($team_id == '')
            {
                $supplierTeamUserLeadRequests = SupplierTeamUserLeadRequest::whereIn('supplier_team_user_id', function($query)use ($userId){
                    $query->select('id')
                        ->from('supplier_team_user')
                        ->where('user_id', $userId);
                })->orderBy($order_name, $order_by)->paginate(10);
            }
            else
            {
                $supplierTeamUserLeadRequests = SupplierTeamUserLeadRequest::whereIn('supplier_team_user_id', function($query)use ($userId, $team_id){
                    $query->select('id')
                        ->from('supplier_team_user')
                        ->where('user_id', $userId)
                        ->where('supplier_team_id', $team_id);
                })->orderBy($order_name, $order_by)->paginate(10);
            }
        }
        else
        {
            $supplierTeamUserLeadRequests = SupplierTeamUserLeadRequest::whereIn('supplier_team_user_id', function($query)use ($userId){
                $query->select('id')
                    ->from('supplier_team_user')
                    ->where('user_id', $userId);
            })->orderBy($order_name, $order_by)->paginate(10);
        }

        $supplierLeadsArray = array();
        foreach($supplierTeamUserLeadRequests as $leads)
        {
            $leadsArray = array();
                $quote = Quotes::find($leads->lead_request_id);
            $leadsArray['specification'] = $quote->specifications;
            $leadsArray['productTypes'] = $quote->categories;
            $leadsArray['assignInTeam'] = SupplierTeam::find($leads->supplier_team_id)->name;
            $leadsArray['industrySelected'] = $quote->industries;
            $leadsArray['dateSubmitted'] = date('d-m-Y',strtotime($leads->created_at));
            $leadsArray['leadReceived'] = $quote->receivedQuotes;
            $leadsArray['status'] = $quote->status;
                $userDetails = UserDetails::where('user_id',SupplierTeamUser::find($leads->supplier_team_user_id)->user_id)->first();
            $leadsArray['assigned_to_id'] = $userDetails->user_id;
            $leadsArray['id'] = $quote->id;
            $supplierLeadsArray[] = $leadsArray;
        }

        $previousPageUrl = $supplierTeamUserLeadRequests->previousPageUrl();//previous page url
        $nextPageUrl = $supplierTeamUserLeadRequests->nextPageUrl();//next page url
        $lastPage = $supplierTeamUserLeadRequests->lastPage(); //Gives last page number
        $total = $supplierTeamUserLeadRequests->total();

        return view('supplying-team.assign-lead-requests')->with([
            'allSupplierTeam'=>$allSupplierTeam,
            'supplierLeadsArray'=>$supplierLeadsArray,
            'team_id'=>$team_id,
            'lead_hidden_val' => $hidden_val,
            'lead_hidden_name' => $hidden_name,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total
        ]);
    }

    public function assignLeads(){
        return view('supplying-team.assign-leads');
    }

    public function messageTeam()
    {
        $userId = Auth::user()->id;

        $allSupplierTeam = SupplierTeam::whereIn('id', function($query)use ($userId){
            $query->select('supplier_team_id')
                ->from('supplier_team_user')
                ->where('user_id', $userId);
        })->get();
        //$allSupplierTeam = SupplierTeam::where('user_id',$userId)->get();

        $supplierTeamUserArray = array();
        $team_id = '';
        if(isset($_REQUEST['team_id']))
        {
            $team_id = $_REQUEST['team_id'];
            Session::put('team_id', $team_id);

            $team_id = Session::get('team_id');
            if($team_id == '')
            {

            }
            else
            {
                $supplierTeamUser = SupplierTeamUser::where('supplier_team_id',$team_id)->where('status',1)->get()->toArray();

                if(count($supplierTeamUser) > 0)
                {
                    foreach($supplierTeamUser as $supplierUsers)
                    {
                        $dataArray = array();
                        $userData = UserDetails::where('user_id',$supplierUsers['user_id'])->first();
                        $dataArray['userId']  = $supplierUsers['user_id'];
                        $dataArray['userName']  = $userData->first_name.''.$userData->last_name;

                        $supplierTeamUserArray[] = $dataArray;
                    }
                }
            }
        }
        elseif(isset($_REQUEST['team_manager_id']))
        {
            $team_manager_id = $_REQUEST['team_manager_id'];

            if($team_manager_id == '')
            {

            }
            else
            {
                $supplierTeam = SupplierTeam::where('id',$team_manager_id)->get()->toArray();

                if(count($supplierTeam) > 0)
                {
                    foreach($supplierTeam as $team)
                    {
                        $dataArray = array();
                            $userData = UserDetails::where('user_id',$team['user_id'])->first();
                        $dataArray['userId']  = $team['user_id'];
                        $dataArray['userName']  = $userData->first_name.''.$userData->last_name;

                        $supplierTeamUserArray[] = $dataArray;
                    }
                }
            }
        }

        return view('supplying-team.message-team', compact('users'))->with([
            'allSupplierTeam'=>$allSupplierTeam,
            'team_id'=>$team_id,
            'supplierTeamUserArray'=>$supplierTeamUserArray
        ]);
    }
}
