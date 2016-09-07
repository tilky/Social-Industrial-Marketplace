@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url('sa')}}">Home</a>
            <i class="fa fa-circle"></i>  
            @else
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
            @endif
        </li>
        <li>
            @if(Auth::user()->access_level == 1)
            <span>Email Verification Requests</span>
            @else
            <span>Email Verification</span>
            @endif
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-server color-black"></i>  Email Verification </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                
                <div class="row">
                    <div class="col-md-12">
                        @if($user->email_verify == 0)
                            @if($already_sent_email == 0)
                            <p>Please verify your Email. <a href="{{url('send/verification/email')}}?email={{$user->email}}&firstname={{$user->userdetail->first_name}}&lastname={{$user->userdetail->last_name}}">Click Here</a></p>
                            @elseif($already_sent_email == 2)
                            <p>Your verification Link Expire, Please <a href="{{url('send/verification/email')}}?email={{$user->email}}&firstname={{$user->userdetail->first_name}}&lastname={{$user->userdetail->last_name}}">Click Here</a> for get new verififcation link again.</p>
                            @else
                            <p>If you didn't get verififcation link, Please <a href="{{url('send/verification/email')}}?email={{$user->email}}&firstname={{$user->userdetail->first_name}}&lastname={{$user->userdetail->last_name}}">Click Here</a> for get link again.</p>
                            @endif
                        @else
                        <p class="green">Your have successfully verified your email.</p>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
    /* for show menu active */
    $("#verification-main-menu").addClass("active");
	$('#verification-main-menu' ).click();
	$('#verification-menu-arrow').addClass('open');
	$('#emailverification-view-menu').addClass('active');
    /* end menu active */
</script>
@endsection
