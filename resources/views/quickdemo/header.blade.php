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
    <a style="margin-top: -18px;" href="{{url('/')}}">
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
        <button type="button" class="btn btn-circle btn-default red" data-toggle="modal" data-target="#signup_warning" id="show-dashboad-select" >
            <i class="fa fa-bolt"></i>
            <span class="hidden-sm hidden-xs">Quick Start</span>
           </i>
        </button>
       
    </div>
    
</div>
<div class="page-actions">
    <div class="btn-group">
        <a href="#" data-toggle="modal" data-target="#signup_warning" class="btn btn-circle btn-default red" >
            <i class="fa fa-road"></i>
            <span class="hidden-sm hidden-xs">Tutorial</span>
           </i>
        </a>
       
    </div>
    
</div>
<div class="page-actions">
    <div class="btn-group">
        <button type="button" class="btn btn-circle btn-default red" data-toggle="modal" data-target="#signup_warning" id="show-overview-info" >
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
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="btn yellow-bg color-black radious-remove-right btn-circle"><img src="{{url('images/chckbx_chckd.png')}}" width="18px" /> Buyer Dashboard</a>
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="btn dark btn-circle font-yellow-crusta radious-remove-left">Supplier CRM <i class="fa fa-circle-thin font-white" style="font-size: 17px;vertical-align: middle;"></i></a>
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
            <button id="invite-user-header" class="btn btn-default red btn-circle" data-toggle="modal" data-target="#signup_warning"><i class="fa fa-plus-circle"></i> <span class="hidden-sm hidden-xs">Invite Users </span></button>
        </li>
        <li class="dropdown dropdown-extended quick-sidebar-toggler" style="padding-top: 20px!important;">
            <button id="upgrade-supplier-modal" class="btn btn-default red btn-circle" data-toggle="modal" data-target="#signup_warning"><i class="fa fa-unlock-alt"></i> <span class="hidden-sm hidden-xs">Upgrade </span></button>
        </li>
        <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark quick-sidebar-toggler message" style="padding-top: 20px!important;">
            <a href="javascript:;" data-toggle="modal" data-target="#signup_warning" class="btn btn-default red btn-circle dropdown-toggle">
                <i class="fa fa-envelope"></i>  <span class="hidden-sm hidden-xs">  0 </span></a>

            
        </li>
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li id="user-profile-header" class="dropdown dropdown-user dropdown-dark">
            <a href="{{url('user/profile')}}" class="dropdown-toggle" data-toggle="modal" data-target="#signup_warning">
                <!--<span class="username username-hide-on-mobile"> My Profile </span>-->
                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                <img src="{{url('images/default-user.png')}}" alt="sell" class="img-responsive">
            </a>
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
