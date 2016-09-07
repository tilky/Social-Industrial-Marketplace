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
<li class="nav-item {{ (Route::getFacadeRoot()->current()->uri() == 'sa') ? 'active open' : '' }}">
    <a href="{{url()}}/sa" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>  
        <span class="title">Overview</span>
    </a>
</li>
<li class="nav-item" id="users-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>  
        <span class="title">User Accounts</span>
        <span class="arrow" id="users-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="all-users-menu">
            <a href="{{url('users')}}" class="nav-link ">
                <i class="fa fa-user"></i>  
                <span class="title">Manage Users </span>
            </a>
        </li>
        <li class="nav-item" id="users-buyer-menu">
            <a href="{{url('user/payment-history')}}" class="nav-link ">
                <i class="fa fa-shopping-cart"></i>  
                <span class="title">User Billing </span>
            </a>
        </li>
        <li class="nav-item" id="users-buyer-menu">
            <a href="{{url('users')}}" class="nav-link ">
                <i class="fa fa-shopping-cart"></i>  
                <span class="title">List All Users</span>
            </a>
        </li>
        <li class="nav-item" id="users-buyer-menu">
            <a href="{{url('user/buyers')}}" class="nav-link ">
                <i class="fa fa-shopping-cart"></i>  
                <span class="title">List Only Buyers</span>
            </a>
        </li>
        <li class="nav-item" id="users-seller-menu">
            <a href="{{url('user/sellers')}}" class="nav-link ">
                <i class="fa fa-money"></i>  
                <span class="title">List Only Suppliers </span>
            </a>
        </li>
        <li class="nav-item" id="users-verification-view-menu">
            <a href="{{url('users/verififcation')}}" class="nav-link ">
                <i class="fa fa-users"></i>  
                <span class="title">Verification</span>
            </a>
        </li>
        <li class="nav-item" id="users-buyer-menu">
            <a href="{{url('user/buyers')}}" class="nav-link ">
                <i class="fa fa-shopping-cart"></i>  
                <span class="title">Pending Users </span>
            </a>
        </li>
        <li class="nav-item" id="users-buyer-menu">
            <a href="{{url('userContacts/view')}}" class="nav-link ">
                <i class="fa fa-shopping-cart"></i>  
                <span class="title">View User Contacts </span>
            </a>
        </li>
        <li class="nav-item" id="users-buyer-menu">
            <a href="{{url('userProducts/view')}}" class="nav-link ">
                <i class="fa fa-shopping-cart"></i>  
                <span class="title">View User Assets </span>
            </a>
        </li>
    </ul>
</li>


    <li class="nav-item" id="category-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cube"></i>  
            <span class="title">Product-Categories</span>
            <span class="arrow" id="category-menu-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item" id="category-users-menu">
                <a href="{{url('viewCategories')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">View all Categories </span>
                </a>
            </li>
            <li class="nav-item  {{ (strrpos(Route::getFacadeRoot()->current()->uri(), 'categories') === false) ? '' : 'active' }}" id="all-users-menu">
                <a href="{{url('categories')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Manage Categories </span>
                </a>
            </li>
            <li class="nav-item" id="all-users-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">View Pricing Module</span>
                </a>
            </li>
        </ul>
    </li>


    @if(strrpos(Route::getFacadeRoot()->current()->uri(), 'company-packages') !== false || strrpos(Route::getFacadeRoot()->current()->uri(), 'companies') !== false
    || strrpos(Route::getFacadeRoot()->current()->uri(), 'company/packages') !== false)
    <li class="nav-item active open" id="settingsMenu">
        @else
    <li class="nav-item " id="settingsMenu">
        @endif
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-institution"></i>  
            <span class="title">Companies</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item {{ (strrpos(Route::getFacadeRoot()->current()->uri(), 'companies') === false) ? '' : 'active' }}" id="all-company-menu">
                <a href="{{url('company/list')}}" class="nav-link ">
                    <i class="fa fa-briefcase"></i>  
                    <span class="title">List All Companies</span>
                </a>
            </li>
            <li class="nav-item {{ (strrpos(Route::getFacadeRoot()->current()->uri(), 'companies') === false) ? '' : 'active' }}" id="all-users-menu">
                <a href="{{url('companies')}}" class="nav-link ">
                    <i class="fa fa-briefcase"></i>  
                    <span class="title">Manage Companies </span>
                </a>
            </li>
            <li class="nav-item {{ (strrpos(Route::getFacadeRoot()->current()->uri(), 'companies') === false) ? '' : 'active' }}" id="all-users-menu">
                <a href="{{url('company/users')}}" class="nav-link ">
                    <i class="fa fa-briefcase"></i>  
                    <span class="title">Manage Company Users</span>
                </a>
            </li>
            <li class="nav-item {{ (strrpos(Route::getFacadeRoot()->current()->uri(), 'company-packages') === false) ? '' : 'active' }}" id="all-users-menu">
                <a href="{{url('company-packages')}}" class="nav-link ">
                    <i class="fa fa-suitcase"></i>  
                    <span class="title">Company Packages</span>
                </a>
            </li>
            <li class="nav-item" id="company-url-menu">
                <a href="{{url('company/urls')}}" class="nav-link ">
                    <i class="fa fa-briefcase"></i>  
                    <span class="title">Company URLs</span>
                </a>
            </li>
            <li class="nav-item" id="company-verification-view-menu" id="all-users-menu">
                <a href="{{url('company/verification')}}" class="nav-link ">
                    <i class="fa fa-home"></i>  
                    <span class="title">Companies Verification</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" id="email-template-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-edit"></i>  
            <span class="title">Email Templates</span>
            <span class="arrow" id="email-template-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item" id="new-template-menu-1">
                <a href="{{url('email/templates')}}/1" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Buyer Email Template</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-2">
                <a href="{{url('email/templates')}}/2" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Seller</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-3">
                <a href="{{url('email/templates')}}/3" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Quote Request Posted</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-4">
                <a href="{{url('email/templates')}}/4" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Marketplace Product Posted</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-5">
                <a href="{{url('email/templates')}}/5" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Lead Matched for Seller</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-6">
                <a href="{{url('email/templates')}}/6" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Lear Matched for buyer</span>
                </a>
            </li><li class="nav-item" id="new-template-menu-7">
                <a href="{{url('email/templates')}}/7" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Lead matched but seller not authorized to view</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-8">
                <a href="{{url('email/templates')}}/8" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">Support Ticket Initial</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-9">
                <a href="{{url('email/templates')}}/9" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Message Received</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-10">
                <a href="{{url('email/templates')}}/10" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New quote Received </span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-11">
                <a href="{{url('email/templates')}}/11" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Endorsement</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-12">
                <a href="{{url('email/templates')}}/12" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Feedback</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-13">
                <a href="{{url('email/templates')}}/13" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Purchase interested in Marketplace product </span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-14">
                <a href="{{url('email/templates')}}/14" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">New Referral Received  </span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-15">
                <a href="{{url('email/templates')}}/15" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">Account Suspended email </span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-16">
                <a href="{{url('email/templates')}}/16" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">Package Expired Email</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-17">
                <a href="{{url('email/templates')}}/17" class="nav-link ">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">Package Subscription payment received email</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item  ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-inbox"></i>  
            <span class="title">Message Center</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu" >
            <li class="nav-item" id="new-template-menu-14">
                <a href="{{url('message/sent')}}" class="nav-link ">
                    <i class="fa fa-send"></i>  
                    <span class="title">Message Sent</span>
                </a>
            </li>
            <li class="nav-item" id="new-template-menu-14">
                <a href="#" class="nav-link ">
                    <i class="fa fa-envelope-square"></i>  
                    <span class="title">Message Unopened</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('messages')}}" id="new-template-menu-14">
                    <i class="fa fa-envelope-o"></i>  
                    <span class="title">Messages Moderation</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" id="new-template-menu-14">
                    <i class="fa fa-ban"></i>  
                    <span class="title">Spam block</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" id="referral-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cube"></i>  
            <span class="title">Referral System</span>
            <span class="arrow" id="referral-menu-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item" id="referral-list-menu">
                <a href="{{url('referrals')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">List all Referred Users </span>
                </a>
            </li>
            <li class="nav-item" id="recently-referral-menu">
                <a href="{{url('recentlyReferred/users')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Recently Referred </span>
                </a>
            </li>
            <li class="nav-item" id="referral-payment-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Payment Setup</span>
                </a>
            </li>
            <li class="nav-item " id="referral-payout-menu">
                <a href="{{url('referral-payout')}}" class="nav-link nav-toggle">
                    <i class="fa fa-money"></i>  
                    <span class="title">Referral Payment history</span>
                </a>
            </li>
            <li class="nav-item " id="referral-url-menu">
                <a href="{{url('referralsURLs')}}" class="nav-link nav-toggle">
                    <i class="fa fa-money"></i>  
                    <span class="title">Referral Urls</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" id="feedBack-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cube"></i>  
            <span class="title">FeedBack System </span>
            <span class="arrow" id="feedBack-menu-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item" id="feedBack-list-menu">
                <a href="{{url('feedbackList')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">List all Feedbacks left</span>
                </a>
            </li>
            <li class="nav-item" id="manage-feedBack-menu">
                <a href="{{url('feedback')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Manage Feedbacks </span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" id="industries-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cube"></i>  
            <span class="title">Industries </span>
            <span class="arrow" id="industries-menu-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item" id="industries-list-menu">
                <a href="{{url('viewIndustries')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">View all Industries </span>
                </a>
            </li>
            <li class="nav-item" id="manage-industries-menu">
                <a href="{{url('industries')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Manage Industries</span>
                </a>
            </li>
            <li class="nav-item" id="user-industries-list-menu">
                <a href="{{url('userIndustries')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">View users listed various industries </span>
                </a>
            </li>
            <li class="nav-item" id="product-industries-menu">
                <a href="{{url('productIndustries')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">View count of products listed under industries </span>
                </a>
            </li>
            <li class="nav-item" id="quote-industries-menu">
                <a href="{{url('quoteIndustries')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">View quotes left per industry </span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" id="feedBack-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cube"></i>  
            <span class="title">Quotes Requested by Buyers  </span>
            <span class="arrow" id="feedBack-menu-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item" id="feedBack-list-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">List all open Requests</span>
                </a>
            </li>
            <li class="nav-item" id="manage-feedBack-menu">
                <a href="" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Show Pending unmatched requests only</span>
                </a>
            </li>
            <li class="nav-item" id="feedBack-list-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Show requests ending soon </span>
                </a>
            </li>
            <li class="nav-item" id="manage-feedBack-menu">
                <a href="" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Quotes Matched List </span>
                </a>
            </li>
            <li class="nav-item" id="manage-feedBack-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Match Quotes to Suppliers Manually</span>
                </a>
            </li>
            <li class="nav-item" id="feedBack-list-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Quotes E-mailed to Suppliers </span>
                </a>
            </li>
            <li class="nav-item" id="manage-feedBack-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Show closed requests</span>
                </a>
            </li>
            <li class="nav-item" id="manage-feedBack-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Show all requests </span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" id="feedBack-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cube"></i>  
            <span class="title">Leads Categories by Sellers </span>
            <span class="arrow" id="feedBack-menu-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item" id="feedBack-list-menu">
                <a href="{{url('supplierlead/categories')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Show categories seller has signed up for list </span>
                </a>
            </li>
            <li class="nav-item" id="manage-feedBack-menu">
                <a href="{{url('supplier-leads')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Manage Signed up Leads </span>
                </a>
            </li>
            <li class="nav-item" id="feedBack-list-menu">
                <a href="{{url('supplierlead/categoryPackage')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Count of Categories per Supplier + package info </span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" id="product-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cube"></i>  
            <span class="title">MarketPlace</span>
            <span class="arrow" id="product-menu-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  {{ (strrpos(Route::getFacadeRoot()->current()->uri(), 'products') === false) ? '' : 'active' }}" id="view-product-menu">
                <a href="{{url('viewProducts')}}" class="nav-link nav-toggle">
                    <i class="fa fa-sitemap"></i>  
                    <span class="title">View Products </span>
                </a>
            </li>
            <li class="nav-item" id="supplier-product-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Supplier / Product count </span>
                </a>
            </li>
            <li class="nav-item" id="manage-product-menu">
                <a href="{{url('products')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Manage Products </span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" id="feedBack-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cube"></i>  
            <span class="title">Finance</span>
            <span class="arrow" id="feedBack-menu-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item" id="feedBack-list-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Subscriptions</span>
                </a>
            </li>
            <li class="nav-item" id="manage-feedBack-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">QuoteTek Service Fee</span>
                </a>
            </li>
            <li class="nav-item" id="feedBack-list-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">QuoteTek Payment methods</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" id="feedBack-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cube"></i>  
            <span class="title">Pricing Module</span>
            <span class="arrow" id="feedBack-menu-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item" id="feedBack-list-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Category Viewer</span>
                </a>
            </li>
            <li class="nav-item" id="manage-feedBack-menu">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-cube"></i>  
                    <span class="title">Manage / Manual Entry </span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item" id="ticket-main-menu">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-cube"></i>  
            <span class="title">Support Center</span>
            <span class="arrow" id="ticket-menu-arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item" id="ticket-list-menu">
                <a href="{{url('viewtickets')}}" class="nav-link nav-toggle">
                    <i class="fa fa-support"></i>  
                    <span class="title">View Tickets </span>
                </a>
            </li>
            <li class="nav-item" id="reply-ticket-menu">
                <a href="{{url('ticketsReply')}}" class="nav-link nav-toggle">
                    <i class="fa fa-support"></i>  
                    <span class="title">Reply to Tickets </span>
                </a>
            </li>
            <li class="nav-item" id="manage-ticket-menu">
                <a href="{{url('supporttickets')}}" class="nav-link nav-toggle">
                    <i class="fa fa-sticky-note"></i>  
                    <span class="title">Manage Tickets</span>
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
