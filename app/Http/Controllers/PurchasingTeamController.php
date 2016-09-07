<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Industry;
use App\BuyerTeam;
use App\BuyerTeamTags;
use App\BuyerTeamUser;
use App\UserDetails;
use App\User;
use App\Company;
use App\Quotes;
use App\BuyerTeamUserAssignedBuyRequest;
use App\BuyerTeamUserAssignedQuote;
use App\Endorsements;
use App\Reviews;
use App\Message;
use App\Participant;
use App\SupplierQuotes;
use App\UsersActivity;
use Carbon\Carbon;
use App\Thread;
use App\MessageAttachments;
use App\SingupEmailVerification;
use App\ContactUsers;
use App\Http\Requests;
use App\BuyerIgnoreQuotes;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Mail;
use Session;



class PurchasingTeamController extends Controller
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
                $usersActivity->activity_name = 'Send New Message to Purchasing Team Members';
                $usersActivity->activity_id = $thread->id;
                $usersActivity->activity_type = 'purchasing team message';
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
        $buyereTeamUser = BuyerTeamUser::where('user_id','=',$id)->first();


        $userDetails = UserDetails::where('user_id',$buyereTeamUser->user_id)->first();
        $user = User::find($buyereTeamUser->user_id);
        if($userDetails)
        {
            $userName = $userDetails->first_name.' '.$userDetails->last_name;
        }
        else
        {
            $userName = $user->name;
        }

        $userEmail = $user->email;
        $teamName = BuyerTeam::find($buyereTeamUser->team_id)->name;

        $buyereTeamUser->delete();

        $messageDetail = 'You have been removed from the '.strtoupper($teamName).'. You will no longer be able to access any assigned items.';

        $data = array('name'=>$userName,'email'=>$userEmail,'messageDetail'=>$messageDetail);
        Mail::send('admin.Emailtemplates.teamMessage', $data, function($message) use ($data) {
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to($data['email'],$data['name'])->subject('Message from IndyJohn for removing Purchasing Team Member');
        });

        return Redirect('/manage-purchasing-team-members')->with('message','Your Purchasing Team Member has been removed.');
    }

    public function aboutPurchasingTeam(){
        return view('purchasing-team.about-purchasing-teams');
    }

    public function startPurchasingTeam(){

        $buyerTeam = new BuyerTeam();

        return view('purchasing-team.start-purchasing-team')->with([
            'buyerTeam'=>$buyerTeam,
            'inviteUsers'=>0
        ]);
    }

    public function editPurchasingTeam($id)
    {
        $buyerTeam = BuyerTeam::find($id);
        $buyerTeamTags = BuyerTeamTags::where('buyer_team_id',$id)->get()->toArray();
        if(count($buyerTeamTags) > 0)
        {
            $allBuyerTeamTags = implode(', ', array_column($buyerTeamTags,'tag'));
        }
        else
        {
            $allBuyerTeamTags = '';
        }

        $buyerTeamUser = BuyerTeamUser::where('team_id',$id)->where('status',1)->get()->toArray();
        $buyerArray = array();
        if(count($buyerTeamUser) > 0)
        {
            foreach($buyerTeamUser as $buyerTeamUsers){
                $dataArray = array();
                $userData = UserDetails::where('user_id',$buyerTeamUsers['user_id'])->first();
                $dataArray['userId']  = $buyerTeamUsers['user_id'];
                $dataArray['userName']  = $userData->first_name.''.$userData->last_name;

                $buyerArray[] = $dataArray;
            }
        }

        $allUsers = UserDetails::all();

        $inviteUsers = 0;
        if(Input::has('inviteUsers')){
            $inviteUsers = 1;
        }

        return view('purchasing-team.start-purchasing-team')->with([
            'id'=>$id,
            'buyerTeam'=>$buyerTeam,
            'buyerTeamTags'=>$allBuyerTeamTags,
            'buyerArray'=>$buyerArray,
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

    public function savePurchasingTeam()
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
                foreach($buyerTeamUser as $users)
                {
                    $users->delete();
                }
            }
        }
        else
        {
            $editOrAdd = 'add';
            $buyerTeam = new BuyerTeam();
            $allBuyerTeam = BuyerTeam::orderBy('created_at','desc')->first();
            $uniqueNo = 'IJE-10001';
            if($allBuyerTeam)
            {
                $getNo = $allBuyerTeam->team_id;
                $number = explode('-',$getNo);
                $num = $number[1] + 1;
                $uniqueNo = 'IJE-'.$num;
            }
            $buyerTeam->team_id = $uniqueNo;

            /*$messageDetail = 'You have created a New Purchasing Team. Log in to Indy John and invite members to join your team.';

           $data = array('name'=>$managerName,'email'=>$managerEmail,'messageDetail'=>$messageDetail);
           Mail::send('admin.Emailtemplates.teamMessage', $data, function($message) use ($data) {
               $message->from(env('MAIL_USERNAME'), 'Indy John Team');
               $message->to($data['email'],$data['name'])->subject('Message from IndyJohn for Purchasing Team Creation');
           });*/
        }

        $buyerTeam->name = Input::get('name');
        $buyerTeam->type = Input::get('type');
        $buyerTeam->description = Input::get('description');
        $buyerTeam->label = Input::get('label');
        $buyerTeam->modified_date = date('Y-m-d');
        $buyerTeam->user_id = Auth::user()->id;
        $buyerTeam->save();

        if(Input::has('tags'))
        {
            $allTags = Input::get('tags');
            $tags = explode(',',$allTags);
            foreach($tags as $tag)
            {
                $buyerTeamTags = new BuyerTeamTags();
                $buyerTeamTags->buyer_team_id = $buyerTeam->id;
                $buyerTeamTags->tag = $tag;
                $buyerTeamTags->save();
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
                        return redirect('edit-purchasing-team/'.$buyerTeam->id.'#tab2')->with('message','Email already exists.');
                    }

                    $singupemail = new SingupEmailVerification;
                    $singupemail->email = $userEmail;
                    $singupemail->verification_code = $code;
                    $singupemail->referral_code = '';
                    $singupemail->expiry_date = date('Y-m-d');
                    $singupemail->status = 1;
                    $singupemail->save();

                    $messageDetail = 'You have been added to '.strtoupper($buyerTeam->name).' ( Team Id : '.$buyerTeam->team_id.' ) by '.strtoupper($managerName).' Access your Team details from the Purchasing Team Menu.';

                    $url = url('verification/link').'/'.$code.'?email='.$userEmail.'&type=Purchasing&teamId='.$buyerTeam->team_id;
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
                    $buyerTeamUser = new BuyerTeamUser();
                    $buyerTeamUser->team_id = $buyerTeam->id;
                    $buyerTeamUser->user_id = $user;
                    $buyerTeamUser->status = 1;
                    $buyerTeamUser->save();

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
                    $usersActivity->activity_name = 'You have been added to '.strtoupper($buyerTeam->name).' ( Team Id : '.$buyerTeam->team_id.' ) for purchasing team member';
                    $usersActivity->activity_id = $buyerTeam->user_id;
                    $usersActivity->activity_type = 'user invitation for team';
                    $usersActivity->creater_id =  Auth::user()->id;
                    $usersActivity->receiver_id = $user;
                    $usersActivity->save();

                    $messageDetail = 'You have been added to '.strtoupper($buyerTeam->name).' ( Team Id : '.$buyerTeam->team_id.' ) by '.strtoupper($managerName).' Access your Team details from the Purchasing Team Menu.';

                    $data = array('name'=>$name,'email'=>$userData->email,'messageDetail'=>$messageDetail);
                    Mail::send('admin.Emailtemplates.teamMessage', $data, function($message) use ($data) {
                        $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                        $message->to($data['email'],$data['name'])->subject('Invitation from IndyJohn to Join Purchasing Team');
                    });
                }
            }
        }

        if($editOrAdd == 'edit')
        {
            return Redirect('/manage-purchasing-teams')->with('message','Your Purchasing Team has been updated.');
        }
        else
        {
            return Redirect('/edit-purchasing-team/'.$buyerTeam->id."?inviteUsers=true")->with('message','Your Purchasing Team has been created.');
        }
    }

    public function managePurchasingTeams(){

        $userId = Auth::user()->id;
        //$buyerTeam = BuyerTeam::where('user_id',$userId)->paginate(10);
        $buyerTeam = BuyerTeam::whereIn('id', function($query)use ($userId){
            $query->select('team_id')
                ->from('buyer_team_user')
                ->where('user_id', $userId);
        })->union(BuyerTeam::where('user_id',$userId))->get();

        $myBuyerTeam = array();
        foreach($buyerTeam as $team)
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

            $myBuyerTeam[] = $teamArray;
        }

        $previousPageUrl = '';//$buyerTeam->previousPageUrl();//previous page url
        $nextPageUrl = '';//$buyerTeam->nextPageUrl();//next page url
        $lastPage = '';//$buyerTeam->lastPage(); //Gives last page number
        $total = count($buyerTeam);//$buyerTeam->total();

        return view('purchasing-team.manage-my-teams')->with([
            'mySupplierTeam'=>$myBuyerTeam,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total
        ]);
    }

    public function viewBuyerTeamMembers($teamId)
    {
        $checkIfUserAuthenticated = BuyerTeam::find($teamId);
        $userId = Auth::user()->id;

        $buyerTeam = BuyerTeam::whereIn('id', function($query)use ($userId){
            $query->select('team_id')
                ->from('buyer_team_user')
                ->where('user_id', $userId);
        })->get()->toArray();
        //$buyerTeam = BuyerTeam::where('user_id',$userId)->get()->toArray();

        $buyerTeamUser = BuyerTeamUser::where('team_id',$teamId)->where('status',1)->get();
        $allBuyerTeamUser = array();
        foreach($buyerTeamUser as $teamUser)
        {
            $userArray = array();
            $userDetails = UserDetails::where('user_id',$teamUser->user_id)->first();
            $userArray['fullName'] = $userDetails->first_name.' '.$userDetails->last_name;
            $userArray['userId'] = $userDetails->user_id;
            $userArray['profilePicture'] = $userDetails->profile_picture;
            $user = User::find($teamUser->user_id);
            $userArray['uniqueNumber'] = $user->unique_number;
            $userArray['lastLogin'] = date('d/m/Y',strtotime($user->updated_at));
            $tagsArray = BuyerTeamTags::where('buyer_team_id',$teamId)->get()->toArray();
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

            $allBuyerTeamUser[] = $userArray;
        }

        return view('purchasing-team.view-team-members')->with([
            'buyerTeam'=>$buyerTeam,
            'buyerTeamUser'=>$allBuyerTeamUser
        ]);

        /*if($checkIfUserAuthenticated->user_id == $userId)
        {

        }
        else
        {
            return redirect('not-authorized');
        }*/
    }

    public function assignedBuyRequests()
    {
        $userId = Auth::user()->id;

        $allBuyerTeam = BuyerTeam::whereIn('id', function($query)use ($userId){
            $query->select('team_id')
                ->from('buyer_team_user')
                ->where('user_id', $userId);
        })->get();




        $team_id = null;
        if(isset($_REQUEST['team_id']))
        {
            $team_id = $_REQUEST['team_id'];
            Session::put('team_id', $team_id);

            $team_id = Session::get('team_id');
            if($team_id == '')
            {
                $buyerRequests = BuyerTeamUserAssignedBuyRequest::whereIn('buyer_team_user_id', function($query)use ($userId){
                    $query->select('id')
                        ->from('buyer_team_user')
                        ->where('user_id', $userId);
                })->paginate(10);
            }
            else
            {
                $buyerRequests = BuyerTeamUserAssignedBuyRequest::whereIn('buyer_team_user_id', function($query)use ($userId, $team_id){
                    $query->select('id')
                        ->from('buyer_team_user')
                        ->where('user_id', $userId)
                        ->where('team_id', $team_id);
                })->paginate(10);
            }
        }
        else
        {
            $buyerRequests = BuyerTeamUserAssignedBuyRequest::whereIn('buyer_team_user_id', function($query)use ($userId){
                $query->select('id')
                    ->from('buyer_team_user')
                    ->where('user_id', $userId);
            })->paginate(10);
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
            $buyerRequestArray['assigned_id'] = $quote->id;
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

        return view('purchasing-team.view-assigned-buy-requests')->with([
            'buyerRequests'=>$buyerRequests,
            'allBuyRequestArray'=>$allBuyRequestArray,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            'total'=>$total,
            'teamId'=>$team_id,
            'allBuyerTeam'=>$allBuyerTeam,
            'team_id'=>$team_id
        ]);
    }

    public function assignedQuotes(){

        $userId = Auth::user()->id;

        $userQuotes = Quotes::where('created_by',$userId)->get();

        $current_quote_id = '';

        $buyerQuotes = BuyerTeamUserAssignedQuote::whereIn('buyer_team_user_id', function($query)use ($userId){
            $query->select('id')
                ->from('buyer_team_user')
                ->where('user_id', $userId);
        })->paginate(10);



        foreach($buyerQuotes as $buyerQuote)
        {
            $team_user_id = $buyerQuote->buyer_team_user_id;
            $buyerQuote->teamUser = UserDetails::where('user_id',BuyerTeamUser::find($team_user_id)->user_id)->first();

            if($buyerQuote->teamUser->company_id != '')
            {
                $buyerQuote->buyerCompany = Company::find($buyerQuote->teamUser->company_id);
            }
            else
            {
                $buyerQuote->buyerCompany = '';
            }
            if($buyerQuote->teamUser->account_member == 'gold')
            {
                $buyerQuote->star = 'gold';
            }
            elseif($buyerQuote->teamUser->account_member == 'silver')
            {
                $buyerQuote->star = 'silver';
            }
            else
            {
                $buyerQuote->star = 'none';
            }

            /// Buy request data
            $buyRequest = $buyerQuote->buyer_quote_id;
            $buyerQuote->buy_request = Quotes::find($buyRequest);

            /// Endorsement Count
            $buyerQuote->endorsement = count(Endorsements::where('receiver_id',$team_user_id)->get());

            /// Review Count
            $reviewCount = count(Reviews::where('receiver_id',$team_user_id)->get());
            $totalStarts = Reviews::where('receiver_id',$team_user_id)->sum('stars');
            if($reviewCount > 0)
            {
                $buyerQuote->reviews = ($totalStarts/$reviewCount);
            }
            else
            {
                $buyerQuote->reviews = 0;
            }

            $quote = SupplierQuotes::find($buyerQuote->buyer_quote_id);
            $buyerQuote->supplier_id = $quote->supplier_id;
            $buyerQuote->quote_id = $quote->id;
            $buyerQuote->manager_id = BuyerTeam::find($buyerQuote->buyer_team_id)->user_id;
            if($quote->status == 0){
                $buyerQuote->action_status = 'pending';
            }else{
                $buyerQuote->action_status = 'actioned';
            }
        }

        $previousPageUrl = $buyerQuotes->previousPageUrl();//previous page url
        $nextPageUrl = $buyerQuotes->nextPageUrl();//next page url
        $lastPage = $buyerQuotes->lastPage(); //Gives last page number
        $total = $buyerQuotes->total();


        return view('purchasing-team.assigned-quotes')->with([
            'buyerQuotes'=>$buyerQuotes,
            'previousPageUrl'=>$previousPageUrl,
            'nextPageUrl'=>$nextPageUrl,
            'lastPage'=>$lastPage,
            "total"=>$total,
            'current_user_id'=>$userId,
            'userquotes' => $userQuotes,
            'current_quote_id' => $current_quote_id
        ]);
    }

    public function acceptQuoteFromTeam($id){
        $SupplierQuotes = SupplierQuotes::find($id);
        $SupplierQuotes->status = 1;
        $SupplierQuotes->save();

        $user_id = Auth::user()->id;
        $BuyerIgnoreQuotes = BuyerIgnoreQuotes::where('buyer_id',$user_id)->get();
        $result = array();
        foreach($BuyerIgnoreQuotes as $ignoreQoute)
        {
            $result[] = $ignoreQoute['supplier_quote_id'];
        }
        $SupplierQuotes = SupplierQuotes::whereNotIn('id',$result)->where('id','!=',$id)->whereRaw('buyer_id = ? AND preview = ?',array($user_id,0))->where('buyer_quote_id',$SupplierQuotes->buyer_quote_id)->get();
        foreach($SupplierQuotes as $quotes)
        {
            $quotes->status = 2;
            $quotes->save();
        }
        return Redirect::back()->with('message', 'You accepted the quote.');
    }

    public function ignoreQuoteFromTeam($id){
        $buyer_id = Auth::user()->id;
        $BuyerIgnoreQuotes = new BuyerIgnoreQuotes();
        $BuyerIgnoreQuotes->buyer_id = $buyer_id;
        $BuyerIgnoreQuotes->supplier_quote_id = $id;
        $BuyerIgnoreQuotes->save();
        return Redirect::back()->with('message', 'You ignored the quote.');
    }

    public function messagePurchasingTeam(){

        $userId = Auth::user()->id;

        $allBuyerTeam = BuyerTeam::whereIn('id', function($query)use ($userId){
            $query->select('team_id')
                ->from('buyer_team_user')
                ->where('user_id', $userId);
        })->get();
        //$allBuyerTeam = BuyerTeam::where('user_id',$userId)->get();

        $buyerTeamUserArray = array();
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
                $buyerTeamUser = BuyerTeamUser::where('team_id',$team_id)->where('status',1)->get()->toArray();

                if(count($buyerTeamUser) > 0)
                {
                    foreach($buyerTeamUser as $buyerUser)
                    {
                        $dataArray = array();
                        $userData = UserDetails::where('user_id',$buyerUser['user_id'])->first();
                        $dataArray['userId']  = $buyerUser['user_id'];
                        $dataArray['userName']  = $userData->first_name.''.$userData->last_name;

                        $buyerTeamUserArray[] = $dataArray;
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
                $buyerTeam = BuyerTeam::where('id',$team_manager_id)->get()->toArray();

                if(count($buyerTeam) > 0)
                {
                    foreach($buyerTeam as $team)
                    {
                        $dataArray = array();
                        $userData = UserDetails::where('user_id',$team['user_id'])->first();
                        $dataArray['userId']  = $team['user_id'];
                        $dataArray['userName']  = $userData->first_name.''.$userData->last_name;

                        $buyerTeamUserArray[] = $dataArray;
                    }
                }
            }
        }

        return view('purchasing-team.message-team', compact('users'))->with([
            'allBuyerTeam'=>$allBuyerTeam,
            'team_id'=>$team_id,
            'buyerTeamUserArray'=>$buyerTeamUserArray
        ]);

    }

    public function sendMessage(){
        $user_id = Auth::user()->id;
        $userData = User::find($user_id);

        $thread= new Thread();
        $thread->subject = Input::get('subject');
        $thread->save();
        // Message
        $message= new Message();
        $message->thread_id = $thread->id;
        $message->user_id = $user_id;
        $message->body = Input::get('body');
        $message->save();
        // Sender
        $message= new Participant();
        $message->thread_id = $thread->id;
        $message->user_id = $user_id;
        $message->last_read = new Carbon;
        $message->save();
        // Recipient

        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'Message for Team Manager';
        $usersActivity->activity_id = $thread->id;
        $usersActivity->activity_type = 'message';
        $usersActivity->creater_id = $user_id;
        $usersActivity->receiver_id = Input::get('receiver_id');
        $usersActivity->save();
    }
}
