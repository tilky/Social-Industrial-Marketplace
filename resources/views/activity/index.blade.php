@extends('buyer.app')

@section('content')
<style>
.feeds li .col1 {
    width: 80% !important;
    float: left;
}
.feeds li .col1 + .col-md-12 {
    width: 20% !important;
    float: right;
	text-align:right;
}

.feeds li .col1>.cont {
   
    width: 100%;
}
@media(max-width:480px) {
	.feeds li .col1 {
    width: 100% !important;
    float: left;
}
.feeds li .col1 + .col-md-12 {
    width: 100% !important;
    float: right;
	text-align:right;
}
.feeds li .col1>.cont {
   
    width: 100%;
}
	}
</style>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>User Activities</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
    <div class="col-md-12 border2x_bottom" id="form_wizard_1">
                 <div class="col-md-9 col-sm-12">
                <div class="row">
                  <h3 class="page-title uppercase"> 
<i class="fa fa-server color-black"></i>  User Activities
</h3>
</div>
</div>
                    
                    
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="col-md-12">
            
            <div class="portlet-body">
            
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        @if(count($userQuotes) > 0)
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                    <h3>Quote Remainder</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="feeds feedsssss">
                                            @foreach($userQuotes as $userQuote)
                                                <li class="col-md-12">
                                                    <div class="col1">
                                                        <div class="cont margin-remove">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-info">
                                                                    <i class="fa fa-send-o"></i>  
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> <strong><a href="{{url('quote/view-buy-requestes')}}">Your Created a New Buy Request titled: {{$userQuote->title}}.</a></strong> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="date">
                                                            @if($userQuote->daysleft == 0)
                                                            Expire Today.
                                                            @elseif($userQuote->daysleft == 1)
                                                            Expire in {{$userQuote->daysleft}} days.
                                                            @else
                                                            Expire in {{$userQuote->daysleft}} days.
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($total > 0)
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                <h3>Activities</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <ul class="feeds">
                                    @foreach($activities as $activity)
                                        @if($activity->activity_type == 'message')
                                            <li class="col-md-12">
                                            @if(Auth::user()->id == $activity->creater_id)
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-envelope"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('messages')}}/{{$activity->activity_id}}">You sent a Message to</a></strong> 
                                                                @if($activity->receiverUser->access_level == 4)
                                                                <a href="{{url('company/profile')}}/{{$activity->receiver_id}}" target="_blank">{{$activity->receiverUser->name}}</a>.
                                                                @else
                                                                <a href="{{url('home/user/profile')}}/{{$activity->receiver_id}}" target="_blank">{{$activity->receiverUser->userdetail->first_name}} {{$activity->receiverUser->userdetail->last_name}}</a>.
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            @else
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-envelope-square"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('messages')}}/{{$activity->activity_id}}">You received a New Message from</a></strong>   
                                                            @if($activity->createrUser->access_level == 4)
                                                            <a href="{{url('company/profile')}}/{{$activity->creater_id}}" target="_blank">{{$activity->createrUser->name}}</a>.
                                                            @else
                                                            <a href="{{url('home/user/profile')}}/{{$activity->creater_id}}" target="_blank">{{$activity->receiverUser->userdetail->first_name}} {{$activity->receiverUser->userdetail->last_name}}</a>.
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            @endif
                                            </li>
                                        @endif
                                        @if($activity->activity_type == 'match_lead')
                                            @if(Auth::user()->id == $activity->receiver_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"><strong><a href="{{url('quotes')}}/{{$activity->activity_id}}">You Received a New Lead from</a></strong> 
                                                            <a href="{{url('home/user/profile')}}/{{$activity->creater_id}}" target="_blank">{{$activity->createrUser->userdetail->first_name}} {{$activity->createrUser->userdetail->last_name}}</a>.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'endorsement')
                                            <li class="col-md-12">
                                            @if(Auth::user()->id == $activity->creater_id)
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-comment-o"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('endorse-sent')}}">You Endorsed </a></strong> 
                                                            @if($activity->receiverUser->access_level == 4)
                                                            <a href="{{url('company/profile')}}/{{$activity->receiver_id}}" target="_blank">{{$activity->receiverUser->name}}</a>.
                                                            @else
                                                            <a href="{{url('home/user/profile')}}/{{$activity->receiver_id}}" target="_blank">{{$activity->receiverUser->userdetail->first_name}} {{$activity->receiverUser->userdetail->last_name}}</a>.
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            @else
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-comments-o"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('endorsement')}}">You were Endorsed by </a></strong>  
                                                            @if($activity->createrUser->access_level == 4)
                                                            <a href="{{url('company/profile')}}/{{$activity->creater_id}}" target="_blank">{{$activity->createrUser->name}}</a>.
                                                            @else
                                                            <a href="{{url('home/user/profile')}}/{{$activity->creater_id}}" target="_blank">{{$activity->receiverUser->userdetail->first_name}} {{$activity->receiverUser->userdetail->last_name}}</a>.
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            @endif
                                            </li>
                                        @endif
                                        @if($activity->activity_type == 'reviews')
                                            <li class="col-md-12">
                                            @if(Auth::user()->id == $activity->creater_id)
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-star"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('review-sent')}}">You  Reviewed</a></strong> 
                                                            @if($activity->receiverUser->access_level == 4)
                                                            <a href="{{url('company/profile')}}/{{$activity->receiver_id}}" target="_blank">{{$activity->receiverUser->name}}</a>.
                                                            @else
                                                                <a href="{{url('home/user/profile')}}/{{$activity->receiver_id}}" target="_blank">{{$activity->receiverUser->userdetail->first_name}} {{$activity->receiverUser->userdetail->last_name}}</a>.
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            @else
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-star"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('review')}}">You were Reviewed by</a></strong>  
                                                            @if($activity->createrUser->access_level == 4)
                                                            <a href="{{url('company/profile')}}/{{$activity->creater_id}}" target="_blank">{{$activity->createrUser->name}}</a>.
                                                            @else
                                                            <a href="{{url('home/user/profile')}}/{{$activity->creater_id}}" target="_blank">{{$activity->receiverUser->userdetail->first_name}} {{$activity->receiverUser->userdetail->last_name}}</a>.
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            @endif
                                            </li>
                                        @endif
                                        
                                        @if($activity->activity_type == 'job')
                                            @if(Auth::user()->id == $activity->creater_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"><strong><a href="{{url('job/view')}}/{{$activity->activity_id}}">You posted a New Job Listing, {{$activity->activity_name}}</a></strong>. 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'product')
                                            @if(Auth::user()->id == $activity->creater_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"><strong><a href="{{url('marketplaceproducts')}}/{{$activity->activity_id}}">You removed a Job Listing, {{$activity->activity_name}}</a></strong>. 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'product_delete')
                                            @if(Auth::user()->id == $activity->creater_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"><strong>You Created a New Company Page, {{$activity->activity_name}}.</strong> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'company')
                                            @if(Auth::user()->id == $activity->creater_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                          <div class="desc"><strong><a href="{{url('company/profile')}}/{{$activity->activity_id}}">You Verified your Company, {{$activity->activity_name}}</a></strong>. 
                                                            </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'company_verification')
                                            @if(Auth::user()->id == $activity->creater_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"><strong><a href="{{url('company/profile')}}/{{$activity->activity_id}}">You Created a new porfile, {{$activity->activity_name}}</a></strong>. 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'user_profile')
                                            @if(Auth::user()->id == $activity->creater_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                          <div class="desc"><strong><a href="{{url('home/user/profile')}}/{{$activity->activity_id}}">You have Verified your User Profile {{$activity->activity_name}}</a></strong> 
                                                            </div>
                                                      </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'user_verification')
                                            @if(Auth::user()->id == $activity->creater_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"><strong><a href="{{url('home/user/profile')}}/{{$activity->activity_id}}">You have Invited New Associates To Indy John.</a></strong> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'invite_associates')
                                            @if(Auth::user()->id == $activity->creater_id)

                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                        <div class="desc"><strong><a href="{{url('home/user/profile')}}/{{$activity->activity_id}}">You Disabled a Recent Buy Request. {{$activity->activity_name}}</a></strong>. 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'quote_disable')
                                            @if(Auth::user()->id == $activity->creater_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                  <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                    <div class="cont-col2">
                                                            <div class="desc"><strong><a href="{{url('request-product-quotes')}}/{{$activity->activity_id}}">You Edited the Status of your Lead, {{$activity->activity_name}}</a></strong>.</div>
                                                    </div>
                                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                      <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                        </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'lead_status')
                                            @if(Auth::user()->id == $activity->creater_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                      <div class="cont-col2">
                                                            <div class="desc"><strong>You earned Referral on your Invites! </strong>
                                                              
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                                <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                              </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'refferel_payout')
                                            @if(Auth::user()->id == $activity->creater_id)
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-sticky-note"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"><strong>You Received a Quote from a Supplier for, {{$activity->activity_name}}</strong>. 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                            @endif
                                        @endif
                                        
                                        @if($activity->activity_type == 'quote_supplier')
                                            <li class="col-md-12">
                                            @if(Auth::user()->id == $activity->creater_id)
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-send-o"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('supplier-sent-quote/view')}}/{{$activity->activity_id}}">You  sent a Quote to </a></strong><a href="{{url('home/user/profile')}}/{{$activity->receiver_id}}" target="_blank">{{$activity->receiverUser->userdetail->first_name}} {{$activity->receiverUser->userdetail->last_name}}</a>.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            @else
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-share"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('supplier-quotes')}}/{{$activity->activity_id}}">You  received a New Quote from </a></strong>  
                                                            <a href="{{url('home/user/profile')}}/{{$activity->creater_id}}" target="_blank">{{$activity->createrUser->userdetail->first_name}} {{$activity->createrUser->userdetail->last_name}}.</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            @endif
                                            </li>
                                        @endif
                                        @if($activity->activity_type == 'quote_new')
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-send-o"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('quotes')}}/{{$activity->activity_id}}">You extended a Buy Request.</a></strong> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                        @endif
                                        @if($activity->activity_type == 'quote_extend')
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-send-o"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('quotes')}}/{{$activity->activity_id}}">You  received an update on your Support Ticket</a></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                        @endif
                                        @if($activity->activity_type == 'support_ticket')
                                            <li class="col-md-12">
                                                <div class="col1">
                                                    <div class="cont margin-remove">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-support"></i>  
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> <strong><a href="{{url('supporttickets')}}/{{$activity->activity_id}}">You  created a new Support Ticket</a></strong> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="date"> {!! $activity->created_at->diffForHumans() !!} </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                    
                                </ul>
                                </div>
                            </div>
                        </div>
                        @else
                        No Activity found
                        @endif
                    </div>
                </div>
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> <i class="fa fa-arrow-left"></i>  Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next <i class="fa fa-arrow-right"></i>  </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

@endsection
