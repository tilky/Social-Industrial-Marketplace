<?php

namespace App\Http\Controllers;

use App\Reviews;
use App\UserDetails;
use App\Company;
use App\ContactUsers;
use App\Endorsements;
use App\Feedbacks;
use App\User;
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

class ReviewsController extends Controller
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
        $reviews = Reviews::whereRaw('receiver_id = ? AND approve = ?',array($user_id,1))->orderBy('id','desc')->paginate(10);
        foreach($reviews as $review)
        {
            $sender_id = $review->sender_id;
            
            /// for sender detail
            $review->sender_id = $sender_id;
            $sender = User::find($sender_id);
            $review->sender = $sender;
            if($sender->access_level == 4)
            {
                $review->sendername = $sender->companydetail->name;
                $review->sender_avatar = $senderData->companydetail->logo;
                $review->companyname = '';
            }
            else
            {
                $senderData = UserDetails::where('user_id',$sender_id)->first();
                if($senderData)
                {
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
                else
                {
                    $review->sendername = '';
                    $review->sender_avatar = '';
                    $review->companyname = '';
                }
            }
            
            /// for check sender already connected or not 
            $connect = ContactUsers::whereRaw('((sender_user_id = ? AND request_user_id = ?) OR (sender_user_id = ? AND request_user_id = ?)) AND status = ?',array($user_id,$sender_id,$sender_id,$user_id,1))->first();
            if($connect)
            {
                $review->connect = 1;
            }
            else
            {
                $review->connect = 0;
            }
            
            /// check sender already endorse or not
            $endorsement = Endorsements::whereRaw('sender_id = ? AND receiver_id = ?',array($user_id, $review->sender_id))->first();
            if($endorsement)
            {
                $review->endorse = 1;
            }
            else
            {
                $review->endorse = 0;
            }
            
        }

        $previousPageUrl = $reviews->previousPageUrl();//previous page url
        $nextPageUrl = $reviews->nextPageUrl();//next page url
        $lastPage = $reviews->lastPage(); //Gives last page number
        $total = $reviews->total();

        $reviewApproval = Reviews::whereRaw('receiver_id = ? AND approve = ?',array($user_id,0))->orderBy('id','desc')->paginate(10);
        foreach($reviewApproval as $review)
        {
            $sender_id = $review->sender_id;

            /// for sender detail
            $review->sender_id = $sender_id;
            $sender = User::find($sender_id);
            $review->sender = $sender;

            $senderData = UserDetails::where('user_id',$sender_id)->first();
            if($senderData)
            {
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
            else
            {
                $review->sendername = '';
                $review->sender_avatar = '';
                $review->companyname = '';
            }
        }

        $previousPage = $reviewApproval->previousPageUrl();//previous page url
        $nextPage = $reviewApproval->nextPageUrl();//next page url
        $last = $reviewApproval->lastPage(); //Gives last page number
        $subTotal = $reviewApproval->total();

        return view('review.index')->with(['reviews'=>$reviews,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total,"reviewApproval"=>$reviewApproval,'previousPage'=>$previousPage,'nextPage'=>$nextPage,'last'=>$last,"subTotal"=>$subTotal]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receiver_id = '';
        $receiverData = '';
        if(isset($_REQUEST['receiver_id']))
        {
            $receiver_id = $_REQUEST['receiver_id'];
            $receiverData = UserDetails::where('user_id',$receiver_id)->first();
        }
        
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
        return view('review.create')->with(['userData'=>$userData,'receiver_id'=>$receiver_id,'receiverData'=>$receiverData]);
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
        $this->validate($request, [
            'receiver_id' => 'required',
            'title' => 'required',
            'comment' => 'required',
            'stars' => 'required',
        ]);
        
        $input = $request->all();
        $input['approve'] = 0;
        $reviews = Reviews::create($input);
        
        
        /// User Activity for message
        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'New Review Send';
        $usersActivity->activity_id = $reviews->id;
        $usersActivity->activity_type = 'reviews';
        $usersActivity->creater_id = $input['sender_id'];
        $usersActivity->receiver_id = $input['receiver_id'];
        $usersActivity->save();
        
        /* review mail to receiver */
        $receiver = User::find($reviews->receiver_id);
        if($receiver->access_level ==4)
        {
            $receiverUrl = url('company/profile').'/'.$receiver->companydetail->id;
            $name = $receiver->companydetail->name;
        }
        else
        {
            $receiverUrl = url('home/user/profile').'/'.$receiver->id;
            $name = $receiver->userdetail->first_name.' '.$receiver->userdetail->last_name;    
        }
        
        $senderData = User::find($reviews->sender_id);
        if($senderData->access_level == 4)
        {
            $sender_first_name = $senderData->companydetail->name;
            $sender_last_name = '';
        }
        else
        {
            $sender_first_name = $senderData->userdetail->first_name;
            $sender_last_name = $senderData->userdetail->last_name;
        }
        
        Input::replace(array('email' => $receiver->email,'name'=>$name));
        $data = array('name'=>Input::get('name'),'sender_first_name'=>$sender_first_name,'sender_last_name'=>$sender_last_name,'profile_link'=>$receiverUrl);
        Mail::send('admin.Emailtemplates.reviewReceived', $data, function($message){
            $message->from(env('MAIL_USERNAME'), 'Indy John Team');
            $message->to(Input::get('email'), Input::get('name'))->subject('You have received a new Review on Indy John');
        });
        
        return Redirect::to('review-sent')->with('message', 'Your review has been sent.');
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
     * Search User for send review
    */
    public function searchUser()
    {
        $users = array();
        $user_id = Auth::user()->id;
        $search = Input::get('q');
        
        $usersData = UserDetails::whereRaw('user_id != '.$user_id.' AND account_type != "Super Admin" AND ( first_name LIKE "%'.$search.'%" OR last_name LIKE "%'.$search.'%") ')->get()->toArray();
        foreach($usersData as $user)
        {
            
            
            $dataArray = array();
            $dataArray['id'] = $user['user_id'];
            $dataArray['full_name'] = $user['first_name'].' '.$user['last_name'];
            $users[] = $dataArray;
            
        }
        $CompanyData = Company::whereRaw('user_id != '.$user_id.' AND ( name LIKE "%'.$search.'%" ) ')->get()->toArray();
        foreach($CompanyData as $company)
        {
            
            
            $dataArray = array();
            $dataArray['id'] = $company['user_id'];
            $dataArray['full_name'] = $company['name'];
            $users[] = $dataArray;
            
        }
        //echo '<pre>';print_r($users);
        //exit(0);
        $ajaxArray = array();
        $ajaxArray['incomplete_results'] = false;
        $ajaxArray['items'] = $users;
        return Response::json($ajaxArray);
    }
    
    /** Review left by user
     * 
     */
    public function reviewLeft()
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
        $reviews = Reviews::where('sender_id',$user_id)->orderBy('id','desc')->paginate(10);
        foreach($reviews as $review)
        {
            $receiver_id = $review->receiver_id;
            
            /// find detail of review receiver
            $review->receiver_id= $receiver_id;
            $receiver = User::find($receiver_id);
            $review->receiver = $receiver;
            if($receiver->access_level == 4)
            {
                $review->receivername = $receiver->companydetail->name;
                $review->receiver_avatar = $receiver->companydetail->logo;
                $review->companyname = '';
            }
            else
            {
                $receiverData = UserDetails::where('user_id',$receiver_id)->first();
                if($receiverData)
                {
                    $review->receivername = $receiverData->first_name.' '.$receiverData->last_name;
                    $review->receiver_avatar = $receiverData->profile_picture;
                    /// find compnay detail of review receiver
                    if($receiverData->company_id != '')
                    {
                        $company = Company::find($receiverData->company_id);
                        $review->companyname = $company->name;    
                    }
                    else
                    {
                        $review->companyname = '';
                    }
                }
                else
                {
                    $review->receivername = '';
                    $review->receiver_avatar = '';
                    $review->companyname = '';
                }
            }
            
            /// check review receiver already connected or not
            $connect = ContactUsers::whereRaw('((sender_user_id = ? AND request_user_id = ?) OR (sender_user_id = ? AND request_user_id = ?)) AND status = ?',array($user_id,$receiver_id,$receiver_id,$user_id,1))->first();
            if($connect)
            {
                $review->connect = 1;
            }
            else
            {
                $review->connect = 0;
            }
            
            /// check receiver already endorse or not
            $endorsement = Endorsements::whereRaw('sender_id = ? AND receiver_id = ?',array($review->sender_id, $review->receiver_id))->first();            
            if($endorsement)
            {
                $review->endorse = 1;
            }
            else
            {
                $review->endorse = 0;
            }
            
        }
        $previousPageUrl = $reviews->previousPageUrl();//previous page url
        $nextPageUrl = $reviews->nextPageUrl();//next page url
        $lastPage = $reviews->lastPage(); //Gives last page number
        $total = $reviews->total();
        return view('review.sent')->with(['reviews'=>$reviews,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }
    
    /**
     * User Profile who given review
     */
    public function reviewUserProfile($id)
    {
        $user = User::find($id);
        $userData = UserDetails::where('user_id',$id)->first();
        if($userData->company_id != '')
        {
            $company = Company::find($userData->company_id);    
        }
        else
        {
            $company = '';
        }
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        
        // user review
        $reviews = $user->reviews;
        foreach($reviews as $review)
        {
            $sender_id = $review->sender_id;
            
            /// for sender detail
            $senderData = UserDetails::where('user_id',$sender_id)->first();
            $review->sendername = $senderData->first_name.' '.$senderData->last_name;
            
            /// for get sender company
            if($senderData->company_id != '')
            {
                $companyData = Company::find($senderData->company_id);
                $review->companyname = $companyData->name;    
            }
            else
            {
                $review->companyname = '';
            }
        }
        
        /// user Feedbacks
        $feedbacks = $user->feedbacks;
        foreach($feedbacks as $feedback)
        {
            $sender_id = $feedback->sender_id;
            
            /// for sender detail
            $senderData = UserDetails::where('user_id',$sender_id)->first();
            $feedback->sendername = $senderData->first_name.' '.$senderData->last_name;
            
            /// for get sender company
            if($senderData->company_id != '')
            {
                $companyData = Company::find($senderData->company_id);
                $feedback->companyname = $companyData->name;    
            }
            else
            {
                $feedback->companyname = '';
            }
        }
        
        /// user endorsements
        $endorsements = $user->endorsements;
        foreach($endorsements as $endorse)
        {
            $sender_id = $endorse->sender_id;
            
            /// find detail of review receiver
            $senderData = UserDetails::where('user_id',$sender_id)->first();
            $endorse->sendername = $senderData->first_name.' '.$senderData->last_name;
            
            /// find compnay detail of review receiver
            if($senderData->company_id != '')
            {
                $companyData = Company::find($senderData->company_id);
                $endorse->companyname = $company->name;    
            }
            else
            {
                $endorse->companyname = '';
            }
        }
        
        return view('user.view')->with(['user'=>$user,'userData'=>$userData,'company'=>$company,'reviews'=>$reviews,'feedbacks'=>$feedbacks,'endorsements'=>$endorsements]);
    }

    public function approveReview($id)
    {
        $review = Reviews::find($id);
        $review->approve = 1;
        $review->save();
    }

    public function rejectReview($id)
    {
        $review = Reviews::find($id);
        $review->delete();
    }
}
