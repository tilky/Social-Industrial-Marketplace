<?php

namespace App\Http\Controllers;

use App\Endorsements;
use App\UserDetails;
use App\User;
use App\Company;
use App\UsersActivity;

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

class EndorsementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        
        //Paginating products
        $endorsements = Endorsements::where('receiver_id',$user_id)->orderBy('id','desc')->paginate(10);
        
        foreach($endorsements as $endorse)
        {
            $sender_id = $endorse->sender_id;
            $endorse->sender = User::find($sender_id);
            /// find detail of review receiver
            $senderData = UserDetails::where('user_id',$sender_id)->first();
            if($senderData)
            {
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
            else
            {
                $sender = User::find($sender_id);
                $endorse->sendername = $sender->name;
                $endorse->sender_avatar = '';    
                /// find compnay detail of review receiver
                $endorse->companyname = $sender->name;
            }
            
            
        }
        
        $previousPageUrl = $endorsements->previousPageUrl();//previous page url
        $nextPageUrl = $endorsements->nextPageUrl();//next page url
        $lastPage = $endorsements->lastPage(); //Gives last page number
        $total = $endorsements->total();
        return view('endorsement.index')->with(['endorsements'=>$endorsements,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
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
    
    /**
     * Endors user
     */    
    public function endorseUser($sender_id,$receiver_id)
    {
        $endorsementsObj = Endorsements::whereRaw('sender_id = ? AND receiver_id = ?',array($sender_id,$receiver_id))->first();
        if($endorsementsObj)
        {
                return Redirect::back()->with('message', 'You have endorsed them previously.');
        }
        else
        {
            $Endorsements = new Endorsements;
            $Endorsements->sender_id = $sender_id;
            $Endorsements->receiver_id = $receiver_id;
            $Endorsements->status = 1;
            $Endorsements->save();
            
            /// User Activity for message
            $usersActivity = new UsersActivity;
            $usersActivity->activity_name = 'Endorsement Send';
            $usersActivity->activity_id = $Endorsements->id;
            $usersActivity->activity_type = 'endorsement';
            $usersActivity->creater_id = $sender_id;
            $usersActivity->receiver_id = $receiver_id;
            $usersActivity->save();
            
            /* review mail to receiver */
            $receiver = User::find($receiver_id);
            
            $senderData = UserDetails::where('user_id',$sender_id)->first();
            if($senderData)
            {
                $receiverUrl = url('home/user/profile').'/'.$senderData->user_id;                 
                $sender_first_name = $senderData->first_name;
                $sender_last_name = $senderData->last_name;
            }
            else
            {
                $sender = User::find($sender_id);
                $receiverUrl = url('company/profile').'/'.$sender->companydetail->id;                
                $sender_first_name = $sender->name;
                $sender_last_name = '';
            }
            
            Input::replace(array('email' => $receiver->email,'name'=>$receiver->name));
            $data = array('name'=>Input::get('name'),'sender_first_name'=>$sender_first_name,'sender_last_name'=>$sender_last_name,'profile_link'=>$receiverUrl);
            Mail::send('admin.Emailtemplates.endorsementReceived', $data, function($message){
                $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                $message->to(Input::get('email'), Input::get('name'))->subject('You have received a New Endorsement on Indy John');
            });
            
            return Redirect::back()->with('message', 'Your have successfully endorsed them.');
        }
    }
    
    /**
     * endorsement sent by user
     */
    public function endorseLeft()
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
        
        //Paginating products
        $endorsements = Endorsements::where('sender_id',$user_id)->orderBy('id','desc')->paginate(10);
        
        foreach($endorsements as $endorse)
        {
            $receiver_id = $endorse->receiver_id;
            
            /// find detail of review receiver
            $receiverData = UserDetails::where('user_id',$receiver_id)->first();
            $endorse->receiver = User::find($receiver_id);
            $endorse->receiver_id = $receiver_id;
            if($receiverData)
            {
                $endorse->receivername = $receiverData->first_name.' '.$receiverData->last_name;
                $endorse->receiver_avatar = $receiverData->profile_picture;    
                /// find compnay detail of review receiver
                if($receiverData->company_id != '')
                {
                    $company = Company::find($receiverData->company_id);
                    $endorse->companyname = $company->name;    
                }
                else
                {
                    $endorse->companyname = '';
                }
            }
            else
            {
                $receiver = User::find($receiver_id);
                $endorse->receivername = $receiver->name;
                $endorse->receiver_avatar = '';    
                /// find compnay detail of review receiver
                $endorse->companyname = $receiver->name;
            }
        }
        
        $previousPageUrl = $endorsements->previousPageUrl();//previous page url
        $nextPageUrl = $endorsements->nextPageUrl();//next page url
        $lastPage = $endorsements->lastPage(); //Gives last page number
        $total = $endorsements->total();
        return view('endorsement.sent')->with(['endorsements'=>$endorsements,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }
}
