<?php
use Illuminate\Support\Facades\Route;
?>
<div class="page-sidebar-wrapper">
<!-- BEGIN SIDEBAR -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
<!-- BEGIN SIDEBAR MENU -->
<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
<li class="sidebar-toggler-wrapper hide">
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="sidebar-toggler"> </div>
    <!-- END SIDEBAR TOGGLER BUTTON -->
</li>
<li class="nav-item {{ (Route::getFacadeRoot()->current()->uri() == 'user-dashboard') ? 'active open' : '' }}">
    <a href="{{url()}}/user-dashboard" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>  
        <span class="title">Overview</span>
    </a>
</li>
<li class="nav-item" id="compnay-main-menu">
    <a href="{{url('company/view')}}" class="nav-link nav-toggle">
        <i class="fa fa-institution"></i>  
        <span class="title">Compnay Profile</span>
    </a>
</li>
<li class="nav-item" id="company-user-menu">
    <a href="{{url('company/users')}}" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>  
        <span class="title">Company Users</span>
    </a>
</li>
<li class="nav-item" id="company-request-menu">
    <a href="{{url('company/requests')}}" class="nav-link nav-toggle">
        <i class="fa fa-user-plus"></i>  
        <span class="title">User Requests</span>
    </a>
</li>
<li class="nav-item" id="account-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-money"></i>  
        <span class="title">Company Payment</span>
        <span class="arrow" id="account-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="account-payment-info-menu">
            <a href="{{url('user/payment-info')}}" class="nav-link ">
                <i class="fa fa-credit-card"></i>  
                <span class="title">Payment Information</span>
            </a>
        </li>
        <li class="nav-item" id="account-payment-history-menu">
            <a href="{{url('user/payment-history')}}" class="nav-link ">
                <i class="fa fa-money"></i>  
                <span class="title">Payment History</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item" id="verification-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-file-text"></i>  
        <span class="title">Verification</span>
        <span class="arrow" id="verification-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="quotetekverification-view-menu">
            <a href="{{url('quotetek/company/vrification/detail')}}" class="nav-link ">
                <i class="fa fa-binoculars"></i>  
                <span class="title">Verification Status</span>
            </a>
        </li>
        <li class="nav-item" id="quotetek-user-verification-menu">
            <a href="{{url('quotetek/company/vrification')}}" class="nav-link ">
                <i class="fa fa-plus"></i>  
                <span class="title">Company Verification</span>
            </a>
        </li>
    </ul>
</li>
<!--li class="nav-item" id="company-request-menu">
    <a href="{{url('company/massImport')}}" class="nav-link nav-toggle">
        <i class="fa fa-user-plus"></i>  
        <span class="title">Company Import</span>
    </a>
</li-->
</ul>
<!-- END SIDEBAR MENU -->
<!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
