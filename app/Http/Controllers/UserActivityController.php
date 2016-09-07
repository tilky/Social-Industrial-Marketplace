<?php

namespace App\Http\Controllers;

use App\UsersActivity;
use App\User;
use App\Quotes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Input;
use Auth;
use Response;
use Session;

class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $today = date('Y-m-d');
        $nextDate = date('Y-m-d', strtotime('+2 days', strtotime($today)));
        $userQuotes = Quotes::whereRaw('expiry_date >= ? AND expiry_date <= ? AND created_by = ? AND status = ?',array($today,$nextDate,$user_id,1))->get();
        foreach($userQuotes as $userQuote)
        {
            $future = strtotime($userQuote->expiry_date); //Future date.
            $timefromdb = strtotime($today);
            $timeleft = $future-$timefromdb;
            $daysleft = round((($timeleft/24)/60)/60); 
            $userQuote->daysleft = $daysleft;
        }
        
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            if($page > 1)
            {
                $userQuotes = array();
            }
        }
        
        $activities = UsersActivity::whereRaw('creater_id = ? OR receiver_id = ?',array($user_id,$user_id))->orderBy('id','desc')->paginate(20);
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
        $previousPageUrl = $activities->previousPageUrl();//previous page url
        $nextPageUrl = $activities->nextPageUrl();//next page url
        $lastPage = $activities->lastPage(); //Gives last page number
        $total = $activities->total();
        return view('activity.index')->with([
                                                        'activities'=>$activities,
                                                        'previousPageUrl'=>$previousPageUrl,
                                                        'nextPageUrl'=>$nextPageUrl,
                                                        'lastPage'=>$lastPage,
                                                        "total"=>$total,
                                                        'userQuotes'=>$userQuotes
                                                        ]);  
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
     * Ajax Activity update
     */
    public function ajaxActivity()
    {
        $user_id = Auth::user()->id;
        $today = date('Y-m-d');
        $nextDate = date('Y-m-d', strtotime('+2 days', strtotime($today)));
        $userQuotes = Quotes::whereRaw('expiry_date >= ? AND expiry_date <= ? AND created_by = ? AND status = ?',array($today,$nextDate,$user_id,1))->get();
        foreach($userQuotes as $userQuote)
        {
            $future = strtotime($userQuote->expiry_date); //Future date.
            $timefromdb = strtotime($today);
            $timeleft = $future-$timefromdb;
            $daysleft = round((($timeleft/24)/60)/60); 
            $userQuote->daysleft = $daysleft;
        }
        $html = '';
        $activities = UsersActivity::whereRaw('creater_id = ? OR receiver_id = ?',array($user_id,$user_id))->orderBy('id','desc')->paginate(10);
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
        
        if(count($activities) > 0):
            $html .= '<ul class="feeds">';
                foreach($userQuotes as $userQuote):
                    $html .= '<li>';
                            $html .= '<div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-send-o"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('quote/view-buy-requestes').'">Your Quote '.$userQuote->title.'</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> ';
                                if($userQuote->daysleft == 0):
                                $html .= 'Expire Today.';
                                elseif($userQuote->daysleft == 1):
                                $html .= 'Expire in '.$userQuote->daysleft.' days.';
                                else:
                                $html .= 'Expire in '.$userQuote->daysleft.' days.';
                                endif;
                                $html .= '</div>
                            </div>
                        </li>';
                endforeach;
                foreach($activities as $activity):
                    if($activity->activity_type == 'message'):
                        $html .= '<li>';
                        if(Auth::user()->id == $activity->creater_id):
                            if($activity->receiverUser->access_level == 4)
                            {
                                $receiver_name = $activity->receiverUser->companydetail->name;
                            }
                            else
                            {
                                $receiver_name = $activity->receiverUser->userdetail->first_name.' '.$activity->receiverUser->userdetail->last_name;
                            }
                            $html .= '<div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-envelope"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('messages').'/'.$activity->activity_id.'">New Message Send to</a></strong> 
                                        <a href="'.url('home/user/profile').'/'.$activity->receiver_id.'" target="_blank">'.$receiver_name.'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>';
                        else:
                            if($activity->createrUser->access_level == 4)
                            {
                                $creater_name = $activity->createrUser->companydetail->name;
                            }
                            else
                            {
                                $creater_name = $activity->createrUser->userdetail->first_name.' '.$activity->createrUser->userdetail->last_name;
                            }
                            $html .= '<div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-envelope-square"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('messages').'/'.$activity->activity_id.'">Received New Message from</a></strong>   
                                        <a href="'.url('home/user/profile').'/'.$activity->creater_id.'" target="_blank">'.$creater_name.'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .'</div>
                            </div>';
                        endif;
                        $html .= '</li>';
                    endif;
                    if($activity->activity_type == 'match_lead'):
                        if(Auth::user()->id == $activity->receiver_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('quotes').'/'.$activity->activity_id.'">New Match Lead from</a></strong> 
                                        <a href="'.url('home/user/profile').'/'.$activity->creater_id.'" target="_blank">'.$activity->createrUser->userdetail->first_name.' '.$activity->createrUser->userdetail->last_name.'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    if($activity->activity_type == 'job'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('job/view').'/'.$activity->activity_id.'">'.$activity->activity_name.'</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    if($activity->activity_type == 'product'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('marketplaceproducts').'/'.$activity->activity_id.'">'.$activity->activity_name.'</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    
                    if($activity->activity_type == 'quote_disable'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('request-product-quotes').'/'.$activity->activity_id.'">'.$activity->activity_name.'</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    
                    if($activity->activity_type == 'company'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('company/profile').'/'.$activity->activity_id.'">'.$activity->activity_name.'</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    
                    if($activity->activity_type == 'company_verification'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('company/profile').'/'.$activity->activity_id.'">'.$activity->activity_name.'</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    
                    if($activity->activity_type == 'user_profile'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('home/user/profile').'/'.$activity->activity_id.'">'.$activity->activity_name.'</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    
                    if($activity->activity_type == 'invite_associates'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('home/user/profile').'/'.$activity->activity_id.'">'.$activity->activity_name.'</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    
                    if($activity->activity_type == 'user_verification'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('home/user/profile').'/'.$activity->activity_id.'">'.$activity->activity_name.'</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    
                    if($activity->activity_type == 'lead_status'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong>'.$activity->activity_name.'</strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    
                    if($activity->activity_type == 'refferel_payout'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong>'.$activity->activity_name.'</strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    
                    if($activity->activity_type == 'product_delete'):
                        if(Auth::user()->id == $activity->creater_id):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong>'.$activity->activity_name.'</strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                        endif;
                    endif;
                    if($activity->activity_type == 'endorsement'):
                        $html .= '<li>';
                        if(Auth::user()->id == $activity->creater_id):
                            if($activity->receiverUser->access_level == 4)
                            {
                                $receiver_name = $activity->receiverUser->companydetail->name;
                            }
                            else
                            {
                                $receiver_name = $activity->receiverUser->userdetail->first_name.' '.$activity->receiverUser->userdetail->last_name;
                            }
                            $html .= '<div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-comment-o"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('endorse-sent').'">Endorsement Send to</a></strong> 
                                        <a href="'.url('home/user/profile').'/'.$activity->receiver_id.'" target="_blank">'.$receiver_name.'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>';
                        else:
                            if($activity->createrUser->access_level == 4)
                            {
                                $creater_name = $activity->createrUser->companydetail->name;
                            }
                            else
                            {
                                $creater_name = $activity->createrUser->userdetail->first_name.' '.$activity->createrUser->userdetail->last_name;
                            }
                            $html .= '<div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-comments-o"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('endorsement').'">Received New Endorsement from</a></strong>  
                                        <a href="'.url('home/user/profile').'/'.$activity->creater_id.'" target="_blank">'.$creater_name.'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>';
                        endif;
                        $html .= '</li>';
                    endif;
                    if($activity->activity_type == 'reviews'):
                        $html .= '<li>';
                        if(Auth::user()->id == $activity->creater_id):
                            
                            if($activity->receiverUser->access_level == 4)
                            {
                                $receiver_name = $activity->receiverUser->companydetail->name;
                            }
                            else
                            {
                                $receiver_name = $activity->receiverUser->userdetail->first_name.' '.$activity->receiverUser->userdetail->last_name;
                            }
                            $html .= '<div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-star"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('review-sent').'">New Review Send to</a></strong> 
                                        <a href="'.url('home/user/profile').'/'.$activity->receiver_id.'" target="_blank">'.$receiver_name.'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>';
                        else:
                            if($activity->createrUser->access_level == 4)
                            {
                                $creater_name = $activity->createrUser->companydetail->name;
                            }
                            else
                            {
                                $creater_name = $activity->createrUser->userdetail->first_name.' '.$activity->createrUser->userdetail->last_name;
                            }
                            $html .= '<div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-star"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('review').'">Received New review from</a></strong>  
                                        <a href="'.url('home/user/profile').'/'.$activity->creater_id.'" target="_blank">'.$creater_name.'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>';
                        endif;
                        $html .= '</li>';
                    endif;
                    if($activity->activity_type == 'quote_supplier'):
                        $html .= '<li>';
                        if(Auth::user()->id == $activity->creater_id):
                            $html .= '<div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-send-o"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('supplier-sent-quote/view').'/'.$activity->activity_id.'">You Sent a New Quote to </a></strong> 
                                        <a href="'.url('home/user/profile').'/'.$activity->receiver_id.'" target="_blank">'.$activity->receiverUser->userdetail->first_name.' '.$activity->receiverUser->userdetail->last_name.'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>';
                        else:
                            $html .= '<div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-share"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('supplier-quotes').'/'.$activity->activity_id.'">You Received a New Quote from</a></strong>  
                                        <a href="'.url('home/user/profile').'/'.$activity->creater_id.'" target="_blank">'.$activity->createrUser->userdetail->first_name.' '.$activity->createrUser->userdetail->last_name.'</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>';
                        endif;
                        $html .= '</li>';
                    endif;
                    if($activity->activity_type == 'quote_new'):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-send-o"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('quotes').'/'.$activity->activity_id.'">You created and sent a Quote.</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                    endif;
                    if($activity->activity_type == 'quote_extend'):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-send-o"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('quotes').'/'.$activity->activity_id.'">You extend a Quote.</a></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                    endif;
                    if($activity->activity_type == 'support_ticket'):
                        $html .= '<li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-support"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="'.url('supporttickets').'/'.$activity->activity_id.'">You submitted a Support Ticket.</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> '. $activity->created_at->diffForHumans() .' </div>
                            </div>
                        </li>';
                    endif;
                endforeach;
                
            $html .= '</ul>';
            else:
            $html .= 'No Activity found';
            endif;
            
        $ajaxArray = array();
        $ajaxArray['success'] = true;
        $ajaxArray['html'] = $html;
        return Response::json($ajaxArray);
    }
    
    public function myCron()
    {
        $UsersActivity = UsersActivity::where('activity_type','support_ticket')->first();
        $UsersActivity->activity_name = 'There is new activity on your submitted Support Ticket.';
        $UsersActivity->save();
    }
}
