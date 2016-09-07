<?php

namespace App\Http\Controllers;

use App\SupportTickets;
use App\SupportTicketComments;
use App\UsersActivity;
use App\UserDetails;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Input;
use Auth;

class SupportTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginating products
        $user_id = Auth::user()->id;
        $user_access_level = Auth::user()->access_level;
        if($user_access_level == 1)
        {
            $tickets = SupportTickets::orderBy('id', 'desc')->paginate(15);    
        }
        else
        {
            $tickets = SupportTickets::where('user_id',$user_id)->orderBy('id', 'desc')->paginate(15);
        }
        
        $previousPageUrl = $tickets->previousPageUrl();//previous page url
        $nextPageUrl = $tickets->nextPageUrl();//next page url
        $lastPage = $tickets->lastPage(); //Gives last page number
        $total = $tickets->total();
        return view('supportticket.index')->with(['tickets'=>$tickets,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total,'user_access_level'=>$user_access_level]);
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
        return view('supportticket.create')->with(['userData'=>$userData]);
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
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $input = $request->all();
        $input['status'] = 0;
        
        $tickets = SupportTickets::create($input);
        
        /// User Activity for message
        $usersActivity = new UsersActivity;
        $usersActivity->activity_name = 'New Support Ticket Crteated';
        $usersActivity->activity_id = $tickets->id;
        $usersActivity->activity_type = 'support_ticket';
        $usersActivity->creater_id = $input['user_id'];
        $usersActivity->receiver_id = null;
        $usersActivity->save();
        
        return Redirect::to('supporttickets')->with('message', 'Your support ticket has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show Ticket Information
        $ticket = SupportTickets::find($id);
        $user_id = Auth::user()->id;
        $user_access_level = Auth::user()->access_level;
        $userData = UserDetails::where('user_id',$user_id)->first();
        if($userData == '')
        {
            $userData = new UserDetails();
            $userData->account_type = '';
            $userData->user_id = $user_id;
            $userData->company_id = '';
        }
        
        // Ticket comments
        $comments = $ticket->comments;
        foreach($comments as $comment)
        {
            $user_id = $comment->user_id;
            $comment->user = User::find($user_id);
        }
        return view('supportticket.view')->with(['ticket'=>$ticket,'userData'=>$userData,'comments'=>$comments,'user_access_level'=>$user_access_level]);
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
        //Delete Ticket
        $ticket = SupportTickets::find($id);
        $ticket->delete();
        return Redirect::to('supporttickets')->with('message', 'Your support ticket has been closed.');
    }
    
    /**
     * Save ticket comment
     *
     * @return \Illuminate\Http\Response
     */
     
    function saveTicketComment($id)
    {
        $ticket = SupportTickets::find($id);
        $ticketCommentObj = new SupportTicketComments();
        $ticketCommentObj->user_id = Input::get('user_id');
        $ticketCommentObj->ticket_id = Input::get('ticket_id');
        $ticketCommentObj->comment = Input::get('comment');
        $ticketCommentObj->save();
        return Redirect::to('supporttickets/'.$ticket->id)->with('message', 'Your support ticket has been created.');
    }
    
    /**
     * Save ticket status
     *
     * @return \Illuminate\Http\Response
     */
     
    function saveTicketStatus($ticket_id,$status)
    {
        $ticket = SupportTickets::find($ticket_id);
        $ticket->status = $status;
        $ticket->save();
        return Redirect::to('supporttickets')->with('message', 'Your support ticket has been updated.');
    }
    
    /**
     * FAQ for help center
     */
    public function faqView()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        return view('supportticket.faq')->with(['user'=>$user]);
    }

    public function viewtickets()
    {

        $tickets = SupportTickets::orderBy('id', 'desc')->paginate(15);

        $previousPageUrl = $tickets->previousPageUrl();//previous page url
        $nextPageUrl = $tickets->nextPageUrl();//next page url
        $lastPage = $tickets->lastPage(); //Gives last page number
        $total = $tickets->total();
        return view('supportticket.list')->with(['tickets'=>$tickets,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }

    public function ticketsReply()
    {

        $tickets = SupportTickets::orderBy('id', 'desc')->paginate(15);

        $previousPageUrl = $tickets->previousPageUrl();//previous page url
        $nextPageUrl = $tickets->nextPageUrl();//next page url
        $lastPage = $tickets->lastPage(); //Gives last page number
        $total = $tickets->total();
        return view('supportticket.reply')->with(['tickets'=>$tickets,'previousPageUrl'=>$previousPageUrl,'nextPageUrl'=>$nextPageUrl,'lastPage'=>$lastPage,"total"=>$total]);
    }
}
