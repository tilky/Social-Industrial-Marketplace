<?php

namespace App\Http\Controllers;

use App\Feedbacks;
use App\UserDetails;
use App\Company;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Input;
use Auth;
use Response;
use Session;

class FeedbacksController extends Controller
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
        if(Auth::user()->access_level == 1){
            $feedbacks = Feedbacks::orderBy('id','desc')->paginate(10);
        }else{
            $feedbacks = Feedbacks::where('receiver_id',$user_id)->orderBy('id','desc')->paginate(10);
        }

        foreach($feedbacks as $feedback)
        {
            $sender_id = $feedback->sender_id;
            
            /// for sender detail
            $senderData = UserDetails::where('user_id',$sender_id)->first();
            $feedback->sendername = $senderData->first_name.' '.$senderData->last_name;

            $receiver_id = $feedback->receiver_id;

            /// for receiver detail
            $receiverData = UserDetails::where('user_id',$receiver_id)->first();
            $feedback->receivername = $receiverData->first_name.' '.$receiverData->last_name;

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
        $previousPageUrl = $feedbacks->previousPageUrl();//previous page url
        $nextPageUrl = $feedbacks->nextPageUrl();//next page url
        $lastPage = $feedbacks->lastPage(); //Gives last page number
        $total = $feedbacks->total();

        return view('feedback.index')->with(['feedbacks'=>$feedbacks,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
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
        return view('feedback.create')->with(['userData'=>$userData,'receiver_id'=>$receiver_id,'receiverData'=>$receiverData]);
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
            'comment' => 'required',
        ]);
        
        $input = $request->all();
        
        $feedbacks = Feedbacks::create($input);
        return Redirect::to('feedback')->with('message', 'Thank you for your feedback.');
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

    public function feedbackList()
    {
        $feedbacks = Feedbacks::orderBy('id','desc')->paginate(10);

        foreach($feedbacks as $feedback)
        {
            $sender_id = $feedback->sender_id;

            /// for sender detail
            $senderData = UserDetails::where('user_id',$sender_id)->first();
            $feedback->sendername = $senderData->first_name.' '.$senderData->last_name;

            $receiver_id = $feedback->receiver_id;

            /// for receiver detail
            $receiverData = UserDetails::where('user_id',$receiver_id)->first();
            $feedback->receivername = $receiverData->first_name.' '.$receiverData->last_name;

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
        $previousPageUrl = $feedbacks->previousPageUrl();//previous page url
        $nextPageUrl = $feedbacks->nextPageUrl();//next page url
        $lastPage = $feedbacks->lastPage(); //Gives last page number
        $total = $feedbacks->total();

        return view('feedback.list')->with(['feedbacks'=>$feedbacks,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }
}
