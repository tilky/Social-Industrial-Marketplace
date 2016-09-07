<!-- for tutorial -->
<link rel="stylesheet" href="{{url('tutorialize/css/tutorialize.css')}}" type="text/css"/>
<!-- Main Tutorialize JS script file -->
<script type="text/javascript" src="{{url('tutorialize/js/jquery.tutorialize.js')}}"></script>
<!-- end -->
<style>
    .page-header.navbar .top-menu .navbar-nav>li.dropdown .dropdown-menu{margin-top: 0px!important;}
</style>
<div class="page-header navbar navbar-fixed-top">
<!-- BEGIN HEADER INNER -->
<div class="page-header-inner ">
<!-- BEGIN LOGO -->
<div class="page-logo">
    <a style="margin-top: -18px;" href="{{url('user-dashboard')}}">
        <h1 class="logo-default"><img src="{{url('images/indy_john_crm_logo.png')}}" /></h1>
    </a>
    <div class="menu-toggler sidebar-toggler"> </div>
</div>
<!-- END LOGO -->
<!-- BEGIN RESPONSIVE MENU TOGGLER -->
<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
<!-- END RESPONSIVE MENU TOGGLER -->
<!-- BEGIN PAGE ACTIONS -->
<!-- DOC: Remove "hide" class to enable the page header actions -->
<div class="page-actions" id="header-quick-start">
    <div class="btn-group">
        <button type="button" class="btn btn-circle btn-default red" id="show-dashboad-select" >
            <i class="fa fa-bolt"></i>
            <span class="hidden-sm hidden-xs">Quick Start</span>
            </i>
        </button>

    </div>

</div>
<div class="page-actions">
    <div class="btn-group">
        <a href="{{url('user-dashboard')}}?setup=tutorial" class="btn btn-circle btn-default red" >
            <i class="fa fa-road"></i>
            <span class="hidden-sm hidden-xs">Tutorial</span>
            </i>
        </a>

    </div>

</div>
<div class="page-actions">
    <div class="btn-group">
        <button type="button" class="btn btn-circle btn-default red" id="show-overview-info" >
            <i class="fa fa-info-circle"></i>
            <span class="hidden-sm hidden-xs">Overview</span>
            </i>
        </button>
    </div>

</div>
<!-- END PAGE ACTIONS -->
<div class="buttons-toggle">
    <div class="btn-toolbar" id="switch-crm-menu">
        <div class="btn-group btn-group-solid dashboard_btns">
            <a href="{{url('dashboard/buyer')}}" class="btn yellow-bg color-black radious-remove-right btn-circle"><img src="{{url('images/chckbx_chckd.png')}}" width="18px" /> Buyer Dashboard</a>
            <a href="{{url('dashboard/supplier')}}" class="btn dark btn-circle font-yellow-crusta radious-remove-left">Supplier CRM <i class="fa fa-circle-thin font-white" style="font-size: 17px;vertical-align: middle;"></i></a>
        </div>
    </div>
</div>
<!-- BEGIN PAGE TOP -->
<div class="page-top">
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
            <li class="separator hide"> </li>
            <li class="dropdown dropdown-extended quick-sidebar-toggler" style="padding-top: 20px!important;">
                <button id="invite-user-header" class="btn btn-default red btn-circle"><i class="fa fa-plus-circle"></i> <span class="hidden-sm hidden-xs">Invite Users </span></button>
            </li>
            <li class="dropdown dropdown-extended quick-sidebar-toggler" style="padding-top: 20px!important;">
                <button id="upgrade-supplier-modal" class="btn btn-default red btn-circle"><i class="fa fa-unlock-alt"></i> <span class="hidden-sm hidden-xs">Upgrade </span></button>
            </li>
            <li class="dropdown dropdown-extended dropdown-inbox quick-sidebar-toggler message" style="padding-top: 20px!important;">
                <a href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" class="btn btn-default red btn-circle dropdown-toggle"><i class="fa fa-envelope"></i>  <span class="hidden-sm hidden-xs">  {{Auth::user()->newMessagesCount()}} </span></a>

                <ul class="dropdown-menu">
                    <li class="external">
                        <h3>You have
                            @if(count(Session::get('new_messages')) > 0)
                            <span class="bold">{{count(Session::get('new_messages'))}} New</span> Messages
                            @else
                            <span class="bold">{{count(Session::get('new_messages'))}} New</span> Message
                            @endif
                        </h3>

                        <a href="{{url('messages')}}">view all</a>
                    </li>
                    <li>
                        @if(Session::has('new_messages'))
                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                            @foreach(Session::get('new_messages') as $index=>$thread)
                            @if($index < 5)
                            <li>
                                <a href="{{url('messages')}}/{{$thread->id}}">
                                                    <span class="photo">
                                                        @if($thread->user->userdetail->profile_picture != '')
                                                        <img src="{{url('')}}/{{$thread->user->userdetail->profile_picture}}" class="img-circle" alt="">
                                                        @else
                                                        <img src="{{url('images/default-user.png')}}" class="img-circle" alt="">
                                                        @endif
                                                    </span>
                                                    <span class="subject">
                                                        <span class="from"> {{$thread->user->userdetail->first_name}} {{$thread->user->userdetail->last_name}} </span>
                                                        <span class="time">{!! $thread->created_at->diffForHumans() !!} </span>
                                                    </span>
                                    <span class="message"> {{ substr(strip_tags($thread->latestMessage->body),0,50) }}... </span>
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </li>
                </ul>
            </li>
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            <li id="user-profile-header" class="dropdown dropdown-user">
                <a href="{{url('user/profile')}}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <!--<span class="username username-hide-on-mobile"> My Profile </span>-->
                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                    @if(Auth::user()->is_using_temporary_password == 0)
                    @if(Auth::user()->userdetail->profile_picture != '')
                    <img src="{{url('')}}/{{Auth::user()->userdetail->profile_picture}}" class="img-responsive" alt="">
                    @else
                    <img src="{{url('images/default-user.png')}}" alt="sell" class="img-responsive">
                    @endif
                    @endif
                </a>
                <ul id="profile-submenu-header" class="dropdown-menu dropdown-menu-default">
                    <li>
                        <a class="pull-left" href="{{url('home/user/profile')}}/{{Auth::user()->id}}">
                            <i class="pull-left fa fa-user"></i><div class="pull-left"><h6>ACCOUNT HOLDER</h6> @if(Auth::user()->is_using_temporary_password == 0){{Auth::user()->userdetail->first_name}} {{Auth::user()->userdetail->last_name}}@endif</div></a> <a class="pull-right" href="{{url('user-details')}}"><i class="fa fa-gear"></i></a>
                    </li>

                    <li>
                        <a class="pull-left" href="{{url('home/user/profile')}}/{{Auth::user()->id}}">
                            <i class="pull-left fa fa-user"></i><div class="pull-left"><h6>INDY JOHN USER ID</h6>@if(Auth::user()->is_using_temporary_password == 0){{Auth::user()->unique_number}}@endif</div></a> <a class="pull-right" href="#"></a>
                    </li>


                    <!-- <li>
                         <a class="pull-left" href="{{url('user-details')}}">
                             <i class="fa fa-user-plus"></i>Edit Your Profile</a> <a class="pull-right" href="#"><i class="fa fa-gear"></i></a>
                     </li>-->
                    @if(Auth::user()->is_using_temporary_password == 0)
                    @if(Auth::user()->userdetail->UserCompany)
                    <li>
                        <a class="pull-left" href="{{url('user/currentCompany/')}}">
                            <i class="pull-left fa fa-archive"></i><div class="pull-left"> <h6>COMPANY PAGE</h6> {{Auth::user()->userdetail->UserCompany->name}}</div>
                        </a>
                        @if(count(Auth::user()->userCompanyOwner) > 0)
                        @foreach(Auth::user()->userCompanyOwner as $company)
                        @if(Auth::user()->userdetail->company_id == $company->id)
                        <a class="pull-right" href="{{url('user/editCompany')}}"><i class="fa fa-gear"></i></a>
                        @endif
                        @endforeach
                        @else
                        <a class="pull-right" href="{{url('start-or-join-company')}}"><i class="fa fa-gear"></i></a>
                        @endif
                    </li>
                    @endif


                    @if(Auth::user()->quotetek_verify == 1)
                    <li>
                        <a class="pull-left" href="{{url('quotetek/user/verification')}}">
                            <i class="pull-left fa fa-user"></i><div class="pull-left"> <h6>VERIFICATION STATUS</h6> Verified User</div><a class="pull-right" href="{{url('quotetek/user/verification')}}"}} ><i class="fa fa-gear"></i></a>
                    </li>
                    @else
                    <li>
                        <a class="pull-left" href="{{url('quotetek/user/verification')}}">
                            <i class="pull-left fa fa-user"></i><div class="pull-left"> <h6>VERIFICATION STATUS</h6> Not Verified</div> </a><a class="pull-right" href="{{url('quotetek/user/verification')}}"><i class="fa fa-gear"></i></a>
                    </li>
                    @endif

                    <li>
                        <a class="pull-left" href="#" data-toggle="modal" data-target="#upgrade-supplier-acount-modal">
                            <i class="pull-left fa fa-credit-card"></i><div class="pull-left"><h6>BUYER DASHBOARD ACCOUNT</h6> @if(Auth::user()->account_plan == 'buyerplus' || Auth::user()->account_plan == 'buyerplus_annual') BUYER+ @else @if(Auth::user()->account_plan == null) FREE @else {{Auth::user()->account_plan}} @endif @endif ACCOUNT </div></a><a class="pull-right" href="{{url('user/packages/')}}"><i class="fa fa-gear"></i></a>
                    </li>
                    <li>
                        <a class="pull-left" href="#" data-toggle="modal" data-target="#upgrade-supplier-acount-modal">
                            <i class="pull-left fa fa-user"></i><div class="pull-left"><h6>SUPPLIER CRM ACCOUNT</h6>@if(Auth::user()->account_member == null) FREE @else {{Auth::user()->account_member}} @endif ACCOUNT</div></a> <a class="pull-right" href="{{url('user/packages/')}}"><i class="fa fa-gear"></i></a>
                    </li>
                    @endif
                    <li>
                        <a class="pull-left" href="{{url('auth/logout')}}">
                            <i class="fa fa-sign-out"></i>log out</a><a class="pull-right" href="#"></a>
                    </li>
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
        </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
</div>
</div>
<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
