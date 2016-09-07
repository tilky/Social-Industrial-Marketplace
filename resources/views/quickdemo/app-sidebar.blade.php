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
<ul class="page-sidebar-menu  page-header-fixed buyer_sidebar" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
<li class="sidebar-toggler-wrapper hide" id="home1">
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="sidebar-toggler"> </div>
    <!-- END SIDEBAR TOGGLER BUTTON -->
</li>
<li id="dashboard-menu" class="nav-item {{ (Route::getFacadeRoot()->current()->uri() == 'user-dashboard') ? 'active open' : '' }}">
    <a href="{{url('user-dashboard')}}" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>  
        <span class="title">Home</span>
    </a>
</li>
<li class="nav-item pulsate-one-target pulsate-four-target" data-toggle="modal" data-target="#signup_warning" id="buyer-tool-main-menu">
    <a href="javascript:;" class="nav-link">
        <i class="fa fa-cogs"></i>  
        <span class="title">Quote-Lead System</span>
        <span id="buyer-tool-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="create-quote-menu">
            <a href="{{url('request-product-quotes/create')}}" class="nav-link">
                <i class="fa fa-plus"></i>  
                <span class="title">Request a Quote</span>
            </a>
        </li>
        <li class="nav-item" id="buy-request-view-menu">
            <a href="{{url('quote/view-buy-requests')}}" class="nav-link">
                <i class="fa fa-send-o"></i>  
                <span class="title">Manage Buy Requests</span>
            </a>
        </li>
        <li class="nav-item" id="default-setting-quote-menu">
            <a href="{{url('quote/defaultsettings')}}" class="nav-link">
                <i class="fa fa-cogs"></i>  
                <span class="title">Buy Request Defaults</span>
            </a>
        </li>
        <li class="nav-item" id="quote-received-menu">
            <a href="{{url('supplier-quotes')}}" class="nav-link ">
                <i class="fa fa-share"></i>  
                <span class="title">Quotes Received</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item pulsate-three-target"  id="marketplace-main-menu">
    <a href="javascript:;" class="nav-link">
        <i class="fa fa-money"></i>  
        <span class="title">Indy John Market</span>
        <span id="marketplace-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="" id="marketplace-product-search-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" >
                <i class="fa fa-search"></i>  
                <span class="title">Search Products</span>
            </a>
        </li>
        <li class=""  id="marketplace-create-product-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" >
                <i class="fa fa-shopping-cart"></i>  
                <span class="title">Post a Product</span>
            </a>
        </li>
        <li class=""  id="marketplace-view-product-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" >
                <i class="fa fa-sticky-note"></i>  
                <span class="title">Listing Manager</span>
            </a>
        </li>
    </ul>
</li>


<li class="nav-item" id="compnay-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-archive"></i>  
        <span class="title">Your Company Center</span>
        <span class="arrow" id="conpmay-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="current-company-menu">
            <a href="{{url('user/currentCompany')}}" class="nav-link ">
                <i class="fa fa-sticky-note"></i>  
                <span class="title">View Your Company</span>
            </a>
        </li>

        
        <li class="nav-item" id="change-compnay-menu">
            <a href="{{url('user/change-company')}}" class="nav-link ">
                <i class="fa fa-exchange"></i>  
                <span class="title">Change Company</span>
            </a>
        </li>
        <li class="nav-item" id="create-compnay-menu">
            <a href="{{url('companies/create')}}" class="nav-link ">
                <i class="fa fa-plus"></i>  
                <span class="title">Add a New Company</span>
            </a>
        </li>
    </ul>
</li>

<li id="contact-list-main-menu" class="nav-item  pulsate-six-target">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-bars"></i>  
        <span class="title">Social Center</span>
        <span id="contact-list-menu-arrow" class="arrow"></span>
    </a>
<ul class="sub-menu">
        <li id="contact-list-view-menu" class="nav-item">
            <a href="{{url('messages')}}" class="nav-link ">
                <i class="fa fa-sticky-note"></i>  
                <span class="title">Messaging Hub</span>
            </a>
        </li>
<li id="contact-list-view-menu" class="nav-item">
            <a href="{{url('contactusers')}}" class="nav-link ">
                <i class="fa fa-sticky-note"></i>  
                <span class="title">Connection Manager</span>
            </a>
        </li>

<li id="contact-list-view-menu" class="nav-item">
            <a href="{{url('review')}}" class="nav-link ">
                <i class="fa fa-star"></i>  
                <span class="title">Review Center</span>
            </a>
        </li>


<li id="contact-list-view-menu" class="nav-item">
            <a href="{{url('endorsement')}}" class="nav-link ">
                <i class="fa fa-sticky-note"></i>  
                <span class="title">Endorsements</span>
            </a>
        </li>


        
    </ul>
</li>

<li class="nav-item pulsate-seven-target" id="referrals-main-menu">
    <a href="javascript:;" class="nav-link">
        <i class="fa fa-users"></i>  
        <span class="title">Referral Program</span>
        <span class="arrow" id="referrals-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="referral-about-program-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="nav-link ">
                <i class="fa fa-info-circle"></i>  
                <span class="title">About the Program</span>
            </a>
        </li>
        <li class="nav-item" id="referral-link-menu">
            <a href="" data-toggle="modal" data-target="#signup_warning" class="nav-link">
                <i class="fa fa-link"></i>  
                <span class="title">Your Referral Tools</span>
            </a>
        </li>
        <li class="nav-item" id="view-referrals-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="nav-link ">
                <i class="fa fa-sticky-note"></i>  
                <span class="title">View Your Referrals</span>
            </a>
        </li>
<li id="contact-pandding-invite-menu" class="nav-item">
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="nav-link ">
                <i class="fa fa-send-o"></i>  
                <span class="title">Your Pending Referrals</span>
            </a>
        </li>

        <li class="nav-item" id="referral-generated-income-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="nav-link ">
                <i class="fa fa-file-text-o"></i>  
                <span class="title">View Referral Payouts</span>
            </a>
        </li>
        <li class="nav-item" id="referral-payment-info-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="nav-link ">
                <i class="fa fa-money"></i>  
                <span class="title">Payout Options</span>
            </a>
        </li>
    </ul>
</li>



<li class="nav-item" id="account-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-user-secret"></i>  
        <span class="title">Your Indy John Account</span>
        <span class="arrow" id="account-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="sidebar-upgrade-buyer">
            <a href="#upgrade-supplier-acount-modal" data-toggle="modal" class="nav-link ">
               <i class="fa fa-money"></i>  
                <span class="title">Upgrade Your Account</span>        <!-- Put upgrade modal here -->
            </a>
        </li>
 <li class="nav-item" id="quotetek-user-verification-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="nav-link ">
                <i class="fa fa-plus"></i>  
                <span class="title">Verify Your Account</span>
            </a>
        </li>


<li class="nav-item" id="account-package-menu">
            <a href="{{url('user/packages')}}" class="nav-link ">
                <i class="fa fa-hdd-o"></i>  
                <span class="title">Subscriptions</span>
            </a>
        </li>

        <li class="nav-item" id="account-payment-info-menu">
            <a href="{{url('user/payment-info')}}" class="nav-link ">
                <i class="fa fa-credit-card"></i>  
                <span class="title">Account Payment Details</span>
            </a>
        </li>
        <li class="nav-item" id="account-payment-history-menu">
            <a href="{{url('user/payment-history')}}" class="nav-link ">
                <i class="fa fa-money"></i>  
                <span class="title">Account Payment History</span>
            </a>
        </li>
        <li class="nav-item" id="user-cards-view-menu">
            <a href="{{url('account-cards')}}" class="nav-link ">
                <i class="fa fa-credit-card"></i>  
                <span class="title">Payment Cards</span>
            </a>
        </li>
        <li class="nav-item" id="user-caccount-settings-view-menu">
            <a href="{{url('account/settings')}}" class="nav-link ">
                <i class="fa fa-cogs"></i>  
                <span class="title">Account Settings</span>
            </a>
        </li>
    </ul>
</li>

  

<li class="nav-item pulsate-three-target" id="jobs-main-menu">
    <a href="javascript:;" class="nav-link ">
        <i class="fa fa-suitcase"></i>  
        <span class="title">Job Board</span>
        <span id="jobs-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="jobs-search-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="nav-link ">
                <i class="fa fa-search"></i>  
                <span class="title">Search Jobs</span>
            </a>
        </li>
        <li class="nav-item" id="jobs-create-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="nav-link ">
                <i class="fa fa-shopping-cart"></i>  
                <span class="title">Post a Job</span>
            </a>
        </li>
        <li class="nav-item" id="jobs-view-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="nav-link ">
                <i class="fa fa-sticky-note"></i>  
                <span class="title">Manage Listed Jobs</span>
            </a>
        </li>
        <li class="nav-item" id="jobs-saved-menu">
            <a href="#" data-toggle="modal" data-target="#signup_warning" class="nav-link ">
                <i class="fa fa-save"></i>  
                <span class="title">Saved Jobs</span>
            </a>
        </li>
</ul>
</li>


<li id="support-tickets-main-menu" class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-support"></i>  
        <span class="title">Help Center</span>
        <span id="support-tickets-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li id="support-ticket-create-menu" class="nav-item  ">
            <a href="{{url('supporttickets/create')}}" class="nav-link ">
                <i class="fa fa-support"></i>  
                <span class="title">Create a Support Ticket</span>
            </a>
        </li>
        <li id="support-ticket-view-menu" class="nav-item  ">
            <a href="{{url('supporttickets')}}" class="nav-link ">
                <i class="fa fa-support"></i>  
                <span class="title">Manage Support Tickets</span>
            </a>
        </li>
        <li id="support-ticket-faq-menu" class="nav-item  ">
            <a href="{{url('supportticket/faq')}}" class="nav-link ">
                <i class="fa fa-question-circle"></i>  
                <span class="title">FAQ</span>
            </a>
        </li>
    </ul>
</li>









</ul>
<!-- END SIDEBAR MENU -->
<!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->

<!-- profile alert -->
<div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content align-center">
            
            <div class="modal-body h3"> Complete your User Profile before using Indy John.</div>
            <div class="modal-footer align-center">
                @if(Route::getFacadeRoot()->current()->uri() == 'user-details')
                <button id="confirmDelete" type="button" data-dismiss="modal" class="btn btn-circle yellow-crusta color-black sml">Continue to Profile Setup</button>
                @else
                <a href="{{url('user-details')}}" class="btn btn-circle yellow-crusta color-black sml">Continue to Profile Setup</a>
                @endif
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end -->
