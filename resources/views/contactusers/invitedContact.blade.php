@extends('buyer.app')

@section('content')


<style>
@charset "utf-8";
/* CSS Document */

.mt-comments .result .mt-comment-body {
	overflow: visible !important;
	padding-left: 105px;
}
.mt-comments .result:hover {
	background:none;
}
.mt-comments .result .mt-comment-body span.label {
	margin-right: 8px !important;
	border-radius:25px;
	color:#000;
	font-weight: 600;
}
.mt-comments .result .mt-comment-body span.label-warning {
	background-color: #F3C200;
}
.mt-comments .result .mt-comment-body span.label-default {
	background-color: #E0E0E0;
}
.mt-comments .result .mt-comment-img {
	width: 45px;
}
.mt-comments .result .mt-comment-author {
	margin-right:5px !important;
}
.mt-comments .result .mt-comment-author a {
	color:#0C0;
}
.result .mt-comment-text {
	padding:2px 0px;
}
.mt-comments .result .mt-comment-info {
	float: left;
	width: 100%;
}
.center-nav { float: none !important; margin-bottom:-4px !important;}


.filter_list ul {
	margin:0px;
	padding:0px;
	list-style:none;
}
.mt-comments .result .mt-comment-img {
    width: 90px;
    height: 90px;
	margin:1px 0px;
    float: left;
}
.mt-comments .result .mt-comment-img img {
    width: 90px;
    height: 90px;
}
.filter_list ul li {
	padding:15px 0px;
	border-bottom: 4px solid #36c6d3;
}
.no_filter{ float:none;}
.filter_list ul li ul li {
	border-bottom: 1px solid #999 !important;
}
.filter_list ul li a {
	color:#999;
}
.filter_list .task-list {
	width:100%;
	float:left;
}
.result{min-height: 90px;}
.mt-comments p{margin: 0px!important;}
.fliter:hover, .fliter:focus{ text-decoration:none;}

 @media(max-width:480px) {

.result .mt-comment-body span.label {
 margin-right: 8px !important;
 margin-bottom: 8px;
 display: inline-block;
}

</style>
<style>
.nav-tabs.center-nav{max-width: 100%!important;}

</style>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Contact List</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
    <div class="col-md-12 border2x_bottom" id="form_wizard_1">
                 <div class="col-md-9 col-sm-9">
                <div class="row">
                  <h3 class="page-title uppercase"> 
<i class="fa fa-exchange color-black"> </i> CONNECTION MANAGER
</h3>
</div>
</div>
                    <div class="col-md-3 col-sm-3">
                <div class="row">
                    <div class="actions margin-top-10 text-right">
                        <a class="btn btn-circle btn-danger" href="#basic" data-toggle="modal">Invite More</a>
                    </div>
                </div>
            </div>
                    
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
    
        @if (Session::has('message'))
            <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
        @endif
        
            <div class="portlet-body">
            <div class="tabbable-line">
                <ul class="nav nav-tabs center-nav">
                    <li>
                        <a class="color-black" href="{{url('contactusers')}}" ><h5 class="bold uppercase">My Connections</h5></a>
                    </li>
                    <li>
                        <a class="color-black" href="{{url('contact/user/saved')}}"><h5 class="bold uppercase">Saved Contacts</h5></a>
                    </li>
                    <li>
                        <a class="color-black" href="{{url('company/saved')}}"><h5 class="bold uppercase">Saved Companies</h5></a>
                    </li>
                    <li>
                        <a class="color-black" href="{{url('contact/user/pending')}}" ><h5 class="bold uppercase">Pending Connections</h5></a>
                    </li>
                    
                    <li>
                        <a class="color-black" href="{{url('contact/user/awaiting')}}"><h5 class="bold uppercase">awaiting connections</h5></a>
                    </li>
                    <li class="active">
                        <a class="color-black" href="{{url('contact/user/invited')}}"><h5 class="bold uppercase">Invited Users</h5></a>
                    </li>
                    
                </ul> 
            
                <div class="tab-content">
                    <div class="tab-pane active" id="portlet_comments_1"> 
                        <!-- BEGIN: Comments -->
                        @if(count($contacts) > 0)
                            <div class="mt-comments col-md-12 col-sm-12 center-block margin-bottom-20 float_none">
                             <div class="clearfix"></div>
                            @foreach ($contacts as $conatct)
                                <div class="mt-comments col-md-12 col-sm-12 center-block no_filter">
                                    <p class="text-right res_found">&nbsp;</p>
                                    <div class="mt-comment result">
                                        <div class="mt-comment-img">
                                            @if($conatct->accept == 0)
                                                <img src="{{url('images/default-user.png')}}" alt="{{$conatct->name}}" class="img-circle" width="80px">
                                            @else
                                                @if($conatct->user->access_level == 4)
                                                    <a href="{{url('company/profile')}}/{{$conatct->user->companydetail->id}}" target="_blank">
                                                    @if($conatct->user->companydetail->logo != '')
                                                    <img src="{{url('')}}/{{$conatct->user->companydetail->logo}}" alt="{{$conatct->user->companydetail->name}}" class="img-circle">
                                                    @else
                                                    <img src="{{url('images/default-user.png')}}" alt="{{$conatct->user->companydetail->name}}" class="img-circle" width="80px">
                                                    @endif
                                                    </a>
                                                @else
                                                    <a href="{{url('company/profile')}}/{{$conatct->user->userdetail->id}}" target="_blank">
                                                    @if($conatct->user->userdetail->profile_picture != '')
                                                    <img src="{{url('')}}/{{$conatct->user->userdetail->profile_picture}}" alt="{{$conatct->user->userdetail->first_name}} {{$conatct->user->userdetail->last_name}}" class="img-circle">
                                                    @else
                                                    <img src="{{url('images/default-user.png')}}" alt="{{$conatct->user->userdetail->first_name}} {{$conatct->user->userdetail->last_name}}" class="img-circle" width="80px">
                                                    @endif
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mt-comment-body">
                                            @if($conatct->accept == 0)
                                                <div class="mt-comment-info">
                                                    <span class="mt-comment-author font-20">
                                                        {{$conatct->name}}
                                                    </span>
                                                    <div class="mt-comment-text">{{$conatct->email}}</div>
                                                    <div class="mt-comment-text">Status: <b>Not Joined</b></div>
                                                    <!--<div class="actions pull-right">
                                                        <div class="btn-group"> 
                                                            <a class="btn btn-circle  btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li>
                                                                    <a href="{{url('contactusers/contact/send')}}/{{Auth::user()->id}}/{{$conatct->email}}" >
                                                                                <i class="fa fa-paper-plane"></i> Again Send Request </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>-->
                                                </div>
                                            @else
                                            <div class="mt-comment-info"> 
                                                @if($conatct->user->access_level == 4)
                                                    <a href="{{url('company/profile')}}/{{$conatct->user->companydetail->id}}" target="_blank">
                                                    <span class="mt-comment-author font-20">
                                                        {{$conatct->user->name}}
                                                    </span>
                                                    </a>
                                                @else
                                                    <a href="{{url('company/profile')}}/{{$conatct->user->id}}" target="_blank">
                                                    <span class="mt-comment-author font-20">
                                                        {{$conatct->user->userdetail->first_name}} {{$conatct->user->userdetail->last_name}}
                                                    </span>
                                                    </a>
                                                @endif
                                                @if($conatct->user->account == 'gold')
                                                <span class="label label-sm label-warning gold-member caps-on"> Gold Supplier </span> 
                                                @elseif($conatct->user->star == 'silver')
                                                <span class="label label-sm label-default silver-member caps-on"> Silver Supplier </span> 
                                                @else
                                                <span class="label label-sm label-default free-member caps-on"> Free Member </span> 
                                                @endif
                                                @if($conatct->user->quotetek_verify == 1)
                                                <span class="label label-sm label-default verify-member caps-on"> Verified Member</span>
                                                @else
                                                <span class="label label-sm label-default verify-member caps-on"> Not Verified Member</span>
                                                @endif
                                                <div class="actions pull-right">
                                                    <div class="btn-group"> 
                                                        <a class="btn btn-circle  btn_yellow hvr-bounce-to-right" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                            @if($conatct->user->access_level == 4)
                                                                <a href="{{url('company/profile')}}/{{$conatct->user->companydetail->id}}" target="_blank">
                                                                    <i class="icon-eye"></i> View Profile </a>
                                                            @else
                                                                <a href="{{url('home/user/profile')}}/{{$conatct->user->id}}" target="_blank">
                                                                    <i class="icon-eye"></i> View Profile </a>
                                                            @endif
                                                            </li>
                                                            @if($conatct->linked == 0)
                                                            <li class="divider"> </li>
                                                            <li>
                                                                <a href="{{url('contactusers/contact/send')}}/{{Auth::user()->id}}/{{$conatct->user->id}}" >
                                                                            <i class="fa fa-paper-plane"></i> Send Connection Request </a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="mt-comment-author">
                                                @if($conatct->user->userdetail->current_position != '')
                                                {{$conatct->user->userdetail->current_position}}
                                                @endif
                                                @if($conatct->user->company_name != '')
                                                    , {{$conatct->user->company_name}}
                                                @endif
                                            </span>
                                            <div class="mt-comment-text">Status: <b>Joined</b></div>
                                            <div class="mt-comment-text">{{substr($conatct->user->userdetail->about,0,90)}}</div>
                                            <span class="mt-comment-status">@if($conatct->user->userdetail->city != ''){{$conatct->user->userdetail->city}},{{$conatct->user->userdetail->state}},{{$conatct->user->userdetail->country}} @endif @if($conatct->user->userdetail->getUserIndustry)| {{$conatct->user->userdetail->getUserIndustry->name}}@endif</span> 
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="mt-comments col-md-9 col-sm-12 center-block float_none">
                            <div class="row">
                                <p class="text-center res_found">You have not invited any User Connections. Start by clicking on Invite Users.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 align-center">
                {!! $contacts->render() !!}
            </div>
                                
        </div>
       
    </div>
</div>
<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
<script>
    /* for show menu active */
    $("#contact-list-main-menu").addClass("active");
	$('#contact-list-main-menu' ).click();
	$('#contact-list-menu-arrow').addClass('open')
	$('#contact-list-view-menu').addClass('active');
    /* end menu active */
    
    $(document).on("click", "#deleteButton", function () {
        var id = $(this).data('id');
        jQuery('#deleteConfirmation .modal-body #objectId').val( id );
    });

    jQuery('#deleteConfirmation .modal-footer button').on('click', function (e) {
        var $target = $(e.target); // Clicked button element
        $(this).closest('.modal').on('hidden.bs.modal', function () {
            if($target[0].id == 'confirmDelete'){
                $( "#DELETE_FORM_" + jQuery('#deleteConfirmation .modal-body #objectId').val() ).submit();
            }
        });
    });
</script>

@endsection
