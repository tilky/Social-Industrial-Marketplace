<div class="page-header navbar navbar-fixed-top">
<!-- BEGIN HEADER INNER -->
<div class="page-header-inner ">
<!-- BEGIN LOGO -->
<div class="page-logo">
    <a style="margin-top: -18px;" href="{{url()}}/sa">
        <h1 class="logo-default"><img src="{{url('images/indy_john_crm_logo.png')}}" /></h1>
    </a>
    <div class="menu-toggler sidebar-toggler"> </div>
</div>
<!-- END LOGO -->
<!-- BEGIN RESPONSIVE MENU TOGGLER -->
<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
<!-- END RESPONSIVE MENU TOGGLER -->
<!-- BEGIN TOP NAVIGATION MENU -->
<div class="top-menu">
<!-- BEGIN TOP NAVIGATION MENU -->
<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <li class="separator hide"> </li>
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-user dropdown-dark">
            <a href="{{url('user-dashboard')}}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                @if(Auth::user()->is_using_temporary_password == 0)
                <span class="username username-hide-on-mobile"> {{Auth::user()->companydetail->name}}</span>
                @else
                <span class="username username-hide-on-mobile"> {{Auth::user()->name}}</span>
                @endif
                <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                 </a>
            <ul class="dropdown-menu dropdown-menu-default">
                <li>
                    <a href="{{url('auth/logout')}}">
                        <i class="fa fa-sign-out"></i>Sign out</a>
                </li>
            </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
    </ul>
</div>
<!-- END TOP NAVIGATION MENU -->
</div>
<!-- END TOP NAVIGATION MENU -->
</div>
<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
