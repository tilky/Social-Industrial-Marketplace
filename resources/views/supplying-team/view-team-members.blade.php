@extends('buyer.app')
@section('content')
<style>@charset "utf-8";
/* CSS Document */
    .mt-comments .result .mt-comment-body {	overflow: visible !important;	padding-left: 105px;}
    .mt-comments .result:hover {	background:none;}
    .mt-comments .result .mt-comment-body span.label {	margin-right: 8px !important;	border-radius:25px;	color:#000;	font-weight: 600;}
    .mt-comments .result .mt-comment-body span.label-warning {	background-color: #F3C200;}
    .mt-comments .result .mt-comment-body span.label-default {	background-color: #E0E0E0;}
    .mt-comments .result .mt-comment-img {	width: 45px;}
    .mt-comments .result .mt-comment-author {	margin-right:5px !important;}
    .mt-comments .result .mt-comment-author a {	color:#0C0;}
    .result .mt-comment-text {	padding:2px 0px;}
    .mt-comments .result .mt-comment-info {	float: left;	width: 100%;}
    .center-nav { float: none !important; margin-bottom:-4px !important;}
    .filter_list ul {	margin:0px;	padding:0px;	list-style:none;}
    .mt-comments .result .mt-comment-img {    width: 90px;    height: 90px;	margin:1px 0px;    float: left;}
    .mt-comments .result .mt-comment-img img {    width: 90px;    height: 90px;}
    .filter_list ul li {	padding:15px 0px;	border-bottom: 4px solid #36c6d3;}
    .no_filter{ float:none;}
    .filter_list ul li ul li {	border-bottom: 1px solid #999 !important;}
    .filter_list ul li a {	color:#999;}
    .filter_list .task-list {	width:100%;	float:left;}
    .result{min-height: 90px;}.mt-comments p{margin: 0px!important;}
    .fliter:hover, .fliter:focus{ text-decoration:none;}
    .no_filter {    //background-color: #e7505a;}
    @media(max-width:480px) {
        .result .mt-comment-body span.label {
            margin-right: 8px !important; margin-bottom: 8px; display: inline-block;
        }
</style>

<style>
    .nav-tabs{max-width: 100%!important;}
</style>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>View Team Members</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
    <div class="row">
        <div class="col-md-12 border2x_bottom" id="form_wizard_1">
            <div class="col-md-10 col-sm-10">
                <div class="row">
                    <h3 class="page-title uppercase">
                        <i class="fa fa-group color-black"> </i> View Team Members
                    </h3>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 text-right">
                <select class="btn btn-danger" id="team" name="selectTeam">
                    <option>Select a Team</option>
                    @foreach($supplierTeam as $team)
                    <option value="{{$team['id']}}">{{$team['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
            <div id="" class="custom-alerts alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                {{ Session::get('message') }}
            </div>
            @endif
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="portlet_comments_1">
                        <!-- BEGIN: Comments -->
                        @if(count($supplierTeamUser) > 0)
                        <div class="mt-comments col-md-12 col-sm-12 center-block margin-bottom-20 float_none">
                            <div class="clearfix"></div>
                            @foreach ($supplierTeamUser as $teamUser)
                            <div class="mt-comments col-md-12 col-sm-12 center-block no_filter">
                                <p class="text-right res_found">&nbsp;</p>
                                <div class="mt-comment result">
                                    <div class="mt-comment-img">
                                        <a href="{{url('home/user/profile')}}/{{$teamUser['userId']}}" target="_blank">
                                            @if($teamUser['profilePicture'] != '')
                                            <img src="{{url('')}}/{{$teamUser['profilePicture']}}" alt="{{$teamUser['fullName']}}" class="img-circle">
                                            @else
                                            <img src="{{url('images/default-user.png')}}" alt="{{$teamUser['fullName']}}" class="img-circle" width="80px">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="mt-comment-body">
                                        <div class="mt-comment-info">
                                            <a href="{{url('home/user/profile')}}/{{$teamUser['userId']}}" target="_blank">
                                                <span class="mt-comment-author font-20">
                                                    {{$teamUser['fullName']}}
                                                </span><br />
                                            </a>
                                            IJ Username : {{$teamUser['uniqueNumber']}}<br />
                                            Last Login : {{$teamUser['lastLogin']}} <br />
                                            Assigned Sales Territory : {{$teamUser['assignedTerritory']}} <br /><br />
                                            @if($teamUser['star'] == 'gold')
                                            <span class="label label-sm label-warning gold-member caps-on"> Gold Supplier </span>
                                            @elseif($teamUser['star'] == 'silver')
                                            <span class="label label-sm label-default silver-member caps-on"> Silver Supplier </span>
                                            @else
                                            <span class="label label-sm label-default free-member caps-on"> Free Member </span>
                                            @endif
                                            @if($teamUser['quotetekVerify'] == 1)
                                            <span class="label label-sm label-default verify-member caps-on"> Verified Member</span>
                                            @else
                                            <span class="label label-sm label-default verify-member caps-on"> Not Verified Member</span>
                                            @endif
                                            <div class="actions pull-right">
                                                <div class="btn-group">
                                                    <a class="btn btn-circle  btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="{{url('home/user/profile')}}/{{$teamUser['userId']}}" target="_blank">
                                                                <i class="icon-eye"></i> View Profile </a>
                                                        </li>
                                                        <li class="divider"> </li>
                                                        <li>
                                                            @if($teamUser['is_connected'] == false)
                                                            <a href="{{url('contactusers/contact/send')}}/{{Auth::user()->id}}/{{$teamUser['userId']}}">

                                                                <i class="fa fa-user-plus"></i> Request To Connect</a>
                                                            @else
                                                            <a href="#contact_seller" id="{{$teamUser['userId']}}" onclick='setReceiver(id)' data-toggle="modal" data-target="#contact_seller"">

                                                            <i class="fa fa-user-plus"></i> Send Private Message</a>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="mt-comment-author">
                                            @if($teamUser['currentPosition'] != '')
                                            {{$teamUser['currentPosition']}}
                                            @endif
                                            @if($teamUser['companyName'] != '')
                                            , {{$teamUser['companyName']}}
                                            @endif
                                        </span>
                                        <div class="mt-comment-text">{{substr($teamUser['about'],0,90)}}</div>
                                        <span class="mt-comment-status">@if($teamUser['city'] != ''){{$teamUser['city']}},{{$teamUser['state']}},{{$teamUser['country']}} @endif @if($teamUser['industry'] != '' )| {{$teamUser['industry']}}@endif</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="mt-comments col-md-9 col-sm-12 center-block float_none">
                                <div class="row">
                                    <p class="text-center res_found">No Team Members found.</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 align-center">
                    </div>
                </div>
            </div>
        </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<script>
    $("#team-supplying").addClass("active");
    $('#team-supplying-menu-arrow').addClass('open');
    $('#manage-my-supplying-teams').addClass('active');

    function setReceiver(id){
        $('#message_receiver').val(id);
        $('#message_box_title').html('SEND MESSAGE TO TEAM MEMBER');
        $('#contactTeamMember').show();
        $('#contactSeller').hide();
    }

    function sendTeamMemberMessage(){
        var subject =  document.getElementById('subject').value;
        var body =  document.getElementById('message_body').value;
        var receiver =  document.getElementById('message_receiver').value;
        var baseurl = "{{url('member/message/send')}}";

        $.ajax({
            type : 'POST',
            url : baseurl,
            data:{
                '_token':'{{csrf_token()}}',
                subject : subject,
                body : body,
                receiver_id : receiver
                //reportType : reportType
            },
            success:function(data) {
                $('#contact_seller').modal('hide');
            },
            done: function() {
            },
            error: function() {
            }
        });
    }

    $('select[name=selectTeam]').on('change',function() {
        var teamId = $( "#team option:selected" ).val();
        var teamMemberUrl = '{{url('viewTeamMembers/')}}'+'/'+teamId;
        window.location.href = teamMemberUrl;
    });
</script>

@endsection
