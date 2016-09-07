@extends('buyer.app')
@section('content')
<style>
.signup-invite-friends-page .form a:hover img {
    filter: grayscale(0);
    -webkit-filter: grayscale(0);
    transform: scale(1.1);
}
.signup-invite-friends-page .form img {
    width: 130px;
    margin: 23px auto;
    -webkit-filter: grayscale(30%);
    filter: grayscale(30%);
    transition: all 0.5s ease;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
}
.user-container .user-img img {
    width: 65px;
    height: 65px;
    margin-top: 9px;
}

.select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Dashboard</a>
        </li>
        <li>
            <span>User Detail</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> 
Welcome, {{Auth::user()->userdetail->first_name}} {{Auth::user()->userdetail->last_name}}
</h3>
<div class="row">
    <div class="portlet light bordered" id="form_wizard_1">
        <div  class="portlet-body form" id="blockui_sample_1_portlet_body">
            @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
            @endif
            <div class="form-wizard">
                <div class="form-body signup-invite-friends-page">
                    <ul class="nav nav-pills nav-justified steps">
                        <li class="done">
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="number"> 1 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Company Setup </span>
                            </a>
                        </li>
                        <li class="done">
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Billing & Plans </span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="number"> 3 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Invite & Earn </span>
                            </a>
                        </li>
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success" style="width: 100%!important;"> </div>
                    </div>
                    <div class="title align-center">
                        <h2>Find your Collegues Aready on IndyJohn </h2>
                        <p>Find and Invite your collegues and friends to grow your network.</p>
                    </div>
                    <div class="form align-center paddin-bottom" style="width: 40%;margin: 0 auto;">
                        <!--  form-body  -->
            
                        <div class="align-center" >
                            <div class="row">
                                <div class="col-md-6 ">
                                    <a href="{{Session::get('google_invite_url')}}"><img src="{{url('images/Indy-John/gmail-icon.png')}}" class="img-circle center-block"></a>
                                </div>
                                <div class="col-md-6 ">
                                    <a href="javascript:void(0)" onclick="GetYahooFirstContact();"><img src="{{url('images/Indy-John/yahoo-icon.png')}}" class="img-circle center-block"></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <a href="{{Session::get('msn_invite_url')}}"><img src="{{url('images/Indy-John/outlook-icon.png')}}" class="img-circle center-block"></a>
                                </div>
                                <div class="col-md-6 ">
                                    <a href="{{url('invite/email')}}"><img src="{{url('images/Indy-John/mail-icon.png')}}" class="img-circle center-block"></a>
                                </div>
                            </div>
                            <div class="text-center">
                                <p>You will have an opportunity to select people to invite next.</p>
                                <p class="small">
                                    We will send them an one e-mail now, and one as an reminder to individuals you select. </p>
                                <a href="{{url('user-dashboard')}}">Skip This Step</a>
                            </div>
                        </div>
                        <!--  /form-body  -->
            
                    </div>
                    <div class="form-actions right padding-top align-right">
                        <a href="{{url('user/billing/plans')}}" class="btn btn-circle default button-previous">
                            <i class="fa fa-angle-left"></i> Back </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function GetYahooFirstContact()
{
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    
    jQuery.ajax({
        url: '{{url("invite/yahoo/url")}}',
        type: 'get',
        success: function(data) {
                    window.location.href = data.url;
                    App.unblockUI('#blockui_sample_1_portlet_body');
                 },
        done: function() {
            //console.log('error');
        },
        error: function() {
            //console.log('error');
        }
        
    }); 
}

</script>

<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}" type="text/javascript"></script>
<!--<script src="{{URL::asset('metronic/pages/scripts/form-wizard.min.js')}}" type="text/javascript"></script>-->
@endsection
