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
            <span>LinkedIn Verification Requests</span>
            @else
            <span>LinkedIn Verification</span>
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
                    <i class="fa fa-server color-black"></i>  LinkedIn Verification </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                
                <div class="row">
                    <div class="col-md-12">
                        @if($user->linkedin_verify == 0)
                        <p>Please verify your LinkedIn account. <a href="https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id={{$client_id}}&redirect_uri={{$redirect_uri}}&state=ab234aatdssda">Click Here</a></p>
                        @else
                        <p class="green">Your LinkedIn Account Verified</p>
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
	$('#linkedinverification-view-menu').addClass('active');
    /* end menu active */
</script>
@endsection
