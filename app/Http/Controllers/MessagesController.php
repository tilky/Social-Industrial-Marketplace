<?php
namespace App\Http\Controllers;
use App\User;
use App\ContactUsers;
use App\UserDetails;
use App\MarketplaceProducts;
use Carbon\Carbon;
use App\Message;
use App\Participant;
use App\Thread;
use App\MessageAttachments;
use App\UsersActivity;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Response;
use Mail;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $currentUserId = Auth::user()->id;
        // All threads, ignore deleted/archived participants
        //$threads = Thread::getAllLatest()->get();
        // All threads that user is participating in
        $user_access_level = Auth::user()->access_level;
        if($user_access_level == 1)
        {
            $threads = Thread::latest('updated_at')->get();
        }else{
            $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();
        }

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();
        return view('messenger.index', compact('threads', 'currentUserId'));
    }
    
    public function userSentMessage()
    {
        $currentUserId = Auth::user()->id;
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();
        $sentThreads = '';
        foreach($threads as $thread)
        {
            if($thread->creator()->id == $currentUserId)
            {
                $sentThreads[] = $thread;
            }
            
        }
        $threads = $sentThreads;
        return view('messenger.sent')->with(['threads' => $threads,'currentUserId'=>$currentUserId]);
    }
    
    /**
     * add new attachment
     */
    public function ajaxAttachmentMessage($id)
    {
        $current_id = $id;
        $next_id = $id + 1;
        $html = '';
        $html .= '<div class="padding-top">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="input-group input-large">
                                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                    <i class="fa fa-file fileinput-exists"></i>  &nbsp;
                                    <span class="fileinput-filename"> </span>
                                </div>
                                <span class="input-group-addon btn default btn-file">
                                    <span class="fileinput-new"> Select file </span>
                                    <span class="fileinput-exists"> Change </span>
                                    <input type="file" data-required="1" name="additional_file[]"> </span>
                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                            </div>
                        </div>
                    </div>';
        $ajaxArray = array();
        $ajaxArray['success'] = true;
        $ajaxArray['html'] = $html;
        $ajaxArray['next_id'] = $next_id;
        return Response::json($ajaxArray);
    }
    
    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $userId = Auth::user()->id;
        $thread_user = $threads = Thread::forUserWithNewMessages($userId)->latest('updated_at')->get();
        foreach($thread_user as $thread)
        {
            $creator_id = $thread->creator()->id;
            $thread->user = User::find($creator_id);
        }
        Session::put('new_messages',$threads);
        
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
        // don't show the current user in list
        
        $threadIds = array();
        $threadIds = $thread->participantsUserIds($userId)->toArray();
        $users = array();
        
        $userConatcs = ContactUsers::whereRaw('sender_user_id = ? AND status = ?',array($userId,1))->get();
        $userConatctListArray = array();
        foreach($userConatcs as $conatclist)
        {
            if(!in_array($conatclist['request_user_id'],$threadIds))
            {
                $userConatctListArray[] = $conatclist['request_user_id'];    
            }
        }
        
        $userAddedConatcs = ContactUsers::whereRaw('request_user_id = ? AND status = ?',array($userId,1))->get();
        foreach($userAddedConatcs as $conatclist)
        {
            if(!in_array($conatclist['sender_user_id'],$threadIds))
            {
                $userConatctListArray[] = $conatclist['sender_user_id'];    
            }
        }
        foreach($userConatctListArray as $userContact)
        {
            $user = User::find($userContact);
            if($user->access_level == 4)
            {
                $users[] = Company::where('user_id', $userContact)->first()->toArray();
            }
            else
            {
                $users[] = UserDetails::where('user_id', $userContact)->first()->toArray();    
            }
            
        }
           
        //$users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
        $thread->markAsRead($userId);
        
        return view('messenger.show', compact('thread', 'users'));
    }
    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $buyerData = '';
        if(isset($_REQUEST['buyer']))
        {
            $buyer_id = $_REQUEST['buyer'];
            $buyerData = User::find($buyer_id);
        }
        $titleData = '';
        if(isset($_REQUEST['product']))
        {
            $product_id = $_REQUEST['product'];
            $product = MarketplaceProducts::find($product_id);
            $titleData = $product->name;
        }
        return view('messenger.create', compact('users'))->with(['buyerData'=>$buyerData,'titleData'=>$titleData]);
    }
    
    /**
     * Search User for send message
    */
    public function searchUser()
    {
        $users = array();
        $user_id = Auth::user()->id;
        $userConatcs = ContactUsers::whereRaw('sender_user_id = ? AND status = ?',array($user_id,1))->get();

        $userConatctListArray = array();
        foreach($userConatcs as $conatclist)
        {
            $userConatctListArray[] = $conatclist['request_user_id'];
        }
        
        $userAddedConatcs = ContactUsers::whereRaw('request_user_id = ? AND status = ?',array($user_id,1))->get();
        foreach($userAddedConatcs as $conatclist)
        {
            $userConatctListArray[] = $conatclist['sender_user_id'];
        }
        foreach($userConatctListArray as $userContact)
        {
            $usersData = UserDetails::where('user_id', $userContact)->first()->toArray();
            
            $dataArray = array();
            $dataArray['id'] = $usersData['user_id'];
            $dataArray['full_name'] = $usersData['first_name'].' '.$usersData['last_name'];
            $users[] = $dataArray;
            
        }

        $ajaxArray = array();
        $ajaxArray['incomplete_results'] = false;
        $ajaxArray['items'] = $users;
        return Response::json($ajaxArray);
    }
    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $input = Input::all();
        
        $redirect_flg = 0;
        if(Input::has('popup_message'))
        {
            $redirect_flg = 1;
        }
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
                $usersActivity->activity_name = 'Send New Message';
                $usersActivity->activity_id = $thread->id;
                $usersActivity->activity_type = 'message';
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
        if($senderData->access_level == 4)
        {
            
        }
        else
        {
            $sender_first_name = $senderData->userdetail->first_name;
            $sender_last_name = $senderData->userdetail->last_name;
        }
        if (Input::has('recipients')) {
            foreach(Input::get('recipients') as $index => $receiver)
            {
                $receiver = User::find($receiver);
                if($receiver->access_level == 4)
                {
                    $receiverUrl = url('company/profile').'/'.$receiver->companydetail->id;
                    $name = $receiver->companydetail->name;
                }
                else
                {
                    $receiverUrl = url('home/user/profile').'/'.$receiver->userdetail->user_id;
                    $name = $receiver->userdetail->first_name.' '.$receiver->userdetail->last_name;
                }
                Input::replace(array('email' => $receiver->email,'name'=>$name));
                //Input::replace(array('email' => 'chauhan.gordhan@gmail.com','name'=>$invitename));
                $data = array('name'=>Input::get('name'),'sender_first_name'=>$sender_first_name,'sender_last_name'=>$sender_last_name,'message_detail'=>$message_detail);
                Mail::send('admin.Emailtemplates.messageReceived', $data, function($message){
                    $message->from(env('MAIL_USERNAME'), 'Indy John Team');
                    $message->to(Input::get('email'), Input::get('name'))->subject('You Received a New Message on Indy John.');
                });
            }
        }
        
        if($redirect_flg == 1)
        {
            return Redirect::back()->with('message', 'Your message was sent.');
        }
        else
        {
            return redirect('messages')->with('message', 'Your message was sent.');    
        }
        
    }
    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        $thread->activateAllParticipants();
        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );
        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants(Input::get('recipients'));
        }
        
        $receivers = Participant::where('thread_id',$thread->id)->get()->toArray();
        if(!empty($receivers))
        {
            foreach($receivers as $receiver)
            {
                if($receiver['user_id'] != Auth::user()->id)
                {
                    $usersActivity = new UsersActivity;
                    $usersActivity->activity_name = 'Send New Message';
                    $usersActivity->activity_id = $thread->id;
                    $usersActivity->activity_type = 'message';
                    $usersActivity->creater_id = Auth::user()->id;
                    $usersActivity->receiver_id = $receiver['user_id'];
                    $usersActivity->save();
                }
            }
        }
        
        return redirect('messages/'.$id)->with('message', 'Your message was successfully sent.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DeleteMessage($id)
    {
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->delete();
        return redirect('messages')->with('message', 'Selected message was successfully deleted.');
    }
}
?>
