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
<li class="sidebar-toggler-wrapper hide">
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
<li class="nav-item pulsate-one-target pulsate-four-target" id="buyer-tool-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <img src="{{URL::asset('images/icons/fast.svg')}}" height="40px" width="40px"/>
        <span class="title"><b>Quote-Lead System</b></span>
        <span id="buyer-tool-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="create-quote-menu">
            <a href="{{url('request-product-quotes/create')}}" class="nav-link">
                  <img src="{{URL::asset('images/icons/fast-black.svg')}}" height="20px" width="20px"/>
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


<li class="nav-item pulsate-three-target" id="team-purchasing">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-group"></i>
        <span class="title">Team Purchasing</span>
        <span id="team-purchasing-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="about-purchasing-teams">
            <a href="{{url('about-purchasing-teams')}}" class="nav-link ">
                <i class="fa fa-group"></i>
                <span class="title">About Teams</span>
            </a>
        </li>
 <li class="nav-item" id="start-purchasing-team">
            <a href="{{url('start-purchasing-team')}}" class="nav-link ">
                <i class="fa fa-sitemap"></i>
                <span class="title">Start a New Team</span>
            </a>
        </li>



        <li class="nav-item" id="manage-my-purchasing-teams">
            <a href="{{url('manage-my-purchasing-teams')}}" class="nav-link ">
                <i class="fa fa-briefcase"></i>
                <span class="title">Manage My Teams</span>
            </a>
        </li>
       
        <li class="nav-item" id="assigned-buy-requests">
            <a href="{{url('assigned-buy-requests')}}" class="nav-link ">
                <i class="fa fa-check-square-o"></i>
                <span class="title">Assigned Buy Requests</span>
            </a>
        </li>
        <li class="nav-item" id="assigned-quotes">
            <a href="{{url('assigned-quotes')}}" class="nav-link ">
                <i class="fa fa-check-square-o"></i>
                <span class="title">Assigned Quotes</span>
            </a>
        </li>

        <li class="nav-item">
             <li class="nav-item" id="message-purchasing-team">
            <a href="{{url('message-purchasing-team')}}" class="nav-link ">
                <i class="fa fa-comment"></i>
                <span class="title">Team Messaging</span>
            </a>
        </li>
<!--
 <li class="nav-item">
             <li class="nav-item" id="marketplace-view-product-menu">
            <a href="" class="nav-link ">
                <i class="fa fa-sticky-note"></i>
                <span class="title">Team Notes</span>
            </a>
        </li>
 <li class="nav-item">
             <li class="nav-item" id="marketplace-view-product-menu">
            <a href="" class="nav-link ">
                <i class="fa fa-sticky-note"></i>
                <span class="title">Team Files</span>
            </a>
        </li>

-->
    </ul>
</li>

@if(count(Auth::user()->getBuyerTeam) > 0)
<li class="nav-item pulsate-three-target" id="team-manager-purchasing">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-user-plus"></i>
        <span class="title">Team Manager</span>
        <span id="team-manager-purchasing-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item">
             <li class="nav-item" id="manage-purchasing-teams">
            <a href="{{url('manage-purchasing-teams')}}" class="nav-link ">
                <i class="fa fa-group"></i>
                <span class="title">Manage Teams</span>
            </a>
        </li>
          <!--li class="nav-item">
                     <li class="nav-item" id="marketplace-view-product-menu">
                    <a href="#" class="nav-link ">
                        <i class="fa fa-sticky-note"></i>
                        <span class="title">Edit Team</span>
                    </a>
                </li-->

        <li class="nav-item">
            <li class="nav-item" id="manage-purchasing-team-members">
            <a href="{{url('manage-purchasing-team-members')}}" class="nav-link ">
                <i class="fa fa-sitemap"></i>
                <span class="title">Manage Team Members</span>
            </a>
        </li>

        <li class="nav-item" id="manager-assign-buy-requests">
            <a href="{{url('manager-assign-buy-requests')}}" class="nav-link ">
                <i class="fa fa-search"></i>
                <span class="title">Assign Buy Requests</span>
            </a>
        </li>

        <li class="nav-item" id="manager-assign-quotes">
            <a href="{{url('manager-assign-quotes')}}" class="nav-link ">
                <i class="fa fa-shopping-cart"></i>
                <span class="title">Assign Quotes</span>
            </a>
        </li>

        <li class="nav-item" id="view-assigned-buy-requests">
            <a href="{{url('view-assigned-buy-requests')}}" class="nav-link ">
                <i class="fa fa-tasks"></i>
                <span class="title">View Assigned Buy Requests</span>
            </a>
        </li>

        <li class="nav-item" id="view-assigned-quotes">
            <a href="{{url('view-assigned-quotes')}}" class="nav-link ">
                <i class="fa fa-navicon"></i>
                <span class="title">View Assigned Quotes</span>
            </a>
        </li>

        <li class="nav-item">
             <li class="nav-item" id="purchasing-team-billing">
            <a href="{{url('purchasing-team-billing')}}" class="nav-link ">
                <i class="fa fa-cog"></i>
                <span class="title">Team Billing</span>
            </a>
        </li>
        <!--
        <li class="nav-item">
                     <li class="nav-item" id="marketplace-view-product-menu">
                    <a href="" class="nav-link ">
                        <i class="fa fa-sticky-note"></i>
                        <span class="title">Manage Team Notes</span>
                    </a>
                </li>

        <li class="nav-item">
                     <li class="nav-item" id="marketplace-view-product-menu">
                    <a href="" class="nav-link ">
                        <i class="fa fa-sticky-note"></i>
                        <span class="title">Manage Team Files</span>
                    </a>
                </li>
        -->
        <li class="nav-item">
             <li class="nav-item" id="transfer-purchasing-team">
            <a href="{{url('transfer-purchasing-team')}}" class="nav-link ">
                <i class="fa fa-unlock"></i>
                <span class="title">Transfer Team</span>
            </a>
        </li>
    </ul>
</li>
@endif



<li class="nav-item pulsate-three-target" id="marketplace-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-tags"></i>
        <span class="title">Indy John Market</span>
        <span id="marketplace-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="marketplace-product-search-menu">
            <a href="{{url('marketplaceproduct/search')}}" class="nav-link ">
                <i class="fa fa-search"></i>
                <span class="title">Search Products</span>
            </a>
        </li>
           <li class="nav-item" id="marketplace-view-product-menu">
            <a href="{{url('market/checkout/received-checkouts')}}" class="nav-link ">
                <i class="fa fa-list-ul"></i>
                <span class="title">Checkout Requests</span>
            </a>
        </li>
        
        <li class="nav-item" id="marketplace-create-product-menu">
            <a href="{{url('market/post-your-product')}}" class="nav-link ">
                <i class="fa fa-shopping-cart"></i>
                <span class="title">Post a Product</span>
            </a>
        </li>
        <!--<li class="nav-item" id="marketplace-default-settings-menu">
            <a href="{{url('marketplaceproducts/product/defaultsettings')}}" class="nav-link ">
                <i class="fa fa-cogs"></i>
                <span class="title">Default Settings</span>
            </a>
        </li>-->
        <li class="nav-item" id="marketplace-view-product-menu">
            <a href="{{url('marketplace/mylistings')}}" class="nav-link ">
                <i class="fa fa-list-ul"></i>
                <span class="title">Listing Manager</span>
            </a>
        </li>
       
        <li class="nav-item" id="marketplace-view-product-menu">
            <a href="{{url('market/leads/received-checkout')}}" class="nav-link ">
                <i class="fa fa-list-ul"></i>
                <span class="title">Seller Lead Manager</span>
            </a>
        </li>
        
       <!-- <li class="nav-item">
            <a href="#" onclick='addReport(id)' id="market_listings" >
                <i class="fa fa-sticky-note"></i>
                <span class="title">Add Report</span>
            </a>
        </li> -->
    </ul>
</li>

<!--
<li class="nav-item" id="invite-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-user-plus"></i>
        <span class="title">Invite Center</span>
        <span class="arrow" id="invite-menu-arraow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="google-invite-view-menu">
            <a href="{{Session::get('google_invite_url')}}" target="_blank" class="nav-link ">
                <i class="fa fa-google-plus"></i>
                <span class="title">Google+</span>
            </a>
        </li>
        <li class="nav-item" id="msn-invite-view-menu">
            <a href="{{Session::get('msn_invite_url')}}" target="_blank" class="nav-link ">
                <i class="fa fa-windows"></i>
                <span class="title">Windows</span>
            </a>
        </li>
        <li class="nav-item" id="yahoo-invite-view-menu">
            <a href="javascript:void(0)" onclick="GetYahooContact();" class="nav-link ">
                <i class="fa fa-yahoo"></i>
                <span class="title">Yahoo</span>
            </a>
        </li>
        <li class="nav-item" id="emailinvite-view-menu">
            <a href="{{url('invite/email')}}" target="_blank" class="nav-link ">
                <i class="fa fa-at"></i>
                <span class="title">Email</span>
            </a>
        </li>
    </ul>
</li>
-->
<li class="nav-item" id="compnay-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-briefcase"></i>
        <span class="title">My Company Center</span>
        <span class="arrow" id="conpmay-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="current-company-menu">
            <a href="{{url('user/currentCompany')}}" class="nav-link ">
                <i class="fa fa-eye"></i>
                <span class="title">View My Company</span>
            </a>
        </li>
        <!--
                <li class="nav-item" id="edit-company-menu">
                    <a href="{{url('user/editCompany')}}" class="nav-link ">
                        <i class="fa fa-edit"></i>
                        <span class="title">Edit Company Page</span>
                    </a>
                </li>
        -->

        <li class="nav-item" id="change-compnay-menu">
            <a href="{{url('user/change-company')}}" class="nav-link ">
                <i class="fa fa-exchange"></i>
                <span class="title">Change My Company</span>
            </a>
        </li>
        <li class="nav-item" id="create-compnay-menu">
            <a href="{{url('start-or-join-company')}}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title">Start-Join Company Page</span>
            </a>
        </li>
        <!--
        <li class="nav-item">
            <a href="#" onclick='addReport(id)' id="company_profile">
                <i class="fa fa-sticky-note"></i>
                <span class="title">Add Report</span>
            </a>
        </li>
        -->
    </ul>
</li>
@if(count(Auth::user()->userCompanyOwner) > 0)
@foreach(Auth::user()->userCompanyOwner as $company)
@if(Auth::user()->userdetail->company_id == $company->id)
<li class="nav-item" id="admin-company-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-user"></i>
        <span class="title">Company Page Listing</span>
        <span class="arrow" id="admin-company-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="users-company-menu">
            <a href="{{url('company/all-users')}}" class="nav-link ">
                <i class="fa fa-users"></i>
                <span class="title">Manage Employees</span>
            </a>
        </li>
        <li class="nav-item" id="edit-company-menu">
            <a href="{{url('user/editCompany')}}" class="nav-link ">
                <i class="fa fa-edit"></i>
                <span class="title">Manage Company Page</span>
            </a>
        </li>
        <li class="nav-item" id="transfer-admin-company-menu">
            <a href="{{url('company/admin')}}/{{$company->id}}" class="nav-link ">
                <i class="fa fa-unlock"></i>
                <span class="title">Transfer Admin Rights</span>
            </a>
        </li>
    </ul>
</li>
@endif
@endforeach
@endif
<!--<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class=" fa fa-wrench"></i>
        <span class="title">Pricing Tool</span>
    </a>
</li>

<li id="messenger-main-menu" class="nav-item  ">
    <a href="{{url('messages')}}" class="nav-link nav-toggle">
        <i class="fa fa-envelope"></i>
        <span class="title">Messaging Inbox @include('messenger.unread-count')</span>
    </a>
</li>
-->
<li id="contact-list-main-menu" class="nav-item  pulsate-six-target">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-comments"></i>
        <span class="title">Social Center</span>
        <span id="contact-list-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li id="message-list-view-menu" class="nav-item">
            <a href="{{url('messages')}}" class="nav-link ">
                <i class="fa fa-comment-o"></i>
                <span class="title">Messaging Hub</span>
            </a>
        </li>
        <li id="contact-list-view-menu" class="nav-item">
            <a href="{{url('contactusers')}}" class="nav-link ">
                <i class="fa fa-user-plus"></i>
                <span class="title">Connection Manager</span>
            </a>
        </li>

        <li id="reviews-list-view-menu" class="nav-item">
            <a href="{{url('review')}}" class="nav-link ">
                <i class="fa fa-star-o"></i>
                <span class="title">Review Center</span>
            </a>
        </li>


        <li id="endorsement-list-view-menu" class="nav-item">
            <a href="{{url('endorsement')}}" class="nav-link ">
                <i class="fa fa-thumbs-o-up"></i>
                <span class="title">Endorsements</span>
            </a>
        </li>

        <!--connection spot sub-menu things
                <li id="contact-list-view-menu" class="nav-item">
                    <a href="{{url('contactusers')}}" class="nav-link ">
                        <i class="fa fa-sticky-note"></i>
                        <span class="title">My Connections</span>
                    </a>
                </li>
                <li id="contact-list-create-menu" class="nav-item">
                    <a href="{{url('contactusers/create')}}" class="nav-link ">
                        <i class="fa fa-user-plus"></i>
                        <span class="title">Find New Connections</span>
                    </a>
                </li>
                <li id="contact-list-pandding-menu" class="nav-item">
                    <a href="{{url('contactusers/contact/pandding')}}" class="nav-link ">
                        <i class="fa fa-file-powerpoint-o"></i>
                        <span class="title">Pending Connections</span>
                    </a>
                </li>



          <li class="nav-item" id="endorsement-receive-menu">
                    <a href="{{url('endorsement')}}" class="nav-link ">
                        <i class="fa fa-comments-o"></i>
                        <span class="title">Endorsement Received</span>
                    </a>
                </li>
         <li class="nav-item" id="endorsement-sent-menu">
                    <a href="{{url('endorse-sent')}}" class="nav-link ">
                        <i class="fa fa-comment-o"></i>
                        <span class="title">Endorsed Users</span>
                    </a>
                </li>
               <li class="nav-item" id="review-receive-menu">
                    <a href="{{url('review')}}" class="nav-link ">
                        <i class="fa fa-comments-o"></i>
                        <span class="title">Reviews Received</span>
                    </a>
                </li>

                <li class="nav-item" id="review-sent-menu">
                    <a href="{{url('review-sent')}}" class="nav-link ">
                        <i class="fa fa-comment-o"></i>
                        <span class="title">Reviews Sent Out</span>
                    </a>
                </li>
        -->

    </ul>
</li>

<li class="nav-item pulsate-seven-target" id="referrals-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-money"></i>
        <span class="title">Referral Program</span>
        <span class="arrow" id="referrals-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="referral-about-program-menu">
            <a href="{{url('referral-link/about-the-program')}}" class="nav-link ">
                <i class="fa fa-info-circle"></i>
                <span class="title">About the Program</span>
            </a>
        </li>
        <li class="nav-item" id="referral-link-menu">
            <a href="{{url('referral-link')}}" class="nav-link">
                <i class="fa fa-link"></i>
                <span class="title">Referral Tools</span>
            </a>
        </li>
        <li class="nav-item" id="view-referrals-menu">
            <a href="{{url('referrals')}}" class="nav-link ">
                <i class="fa fa-share"></i>
                <span class="title">View My Referrals</span>
            </a>
        </li>
        <li id="contact-pandding-invite-menu" class="nav-item">
            <a href="{{url('contact/pending/invite')}}" class="nav-link ">
                <i class="fa fa-send-o"></i>
                <span class="title">My Pending Referrals</span>
            </a>
        </li>

        <li class="nav-item" id="referral-generated-income-menu">
            <a href="{{url('referral/generate/income')}}" class="nav-link ">
                <i class="fa fa-file-text-o"></i>
                <span class="title">View Referral Payouts</span>
            </a>
        </li>
        <li class="nav-item" id="referral-payment-info-menu">
            <a href="{{url('referral/payment-info')}}" class="nav-link ">
                <i class="fa fa-money"></i>
                <span class="title">Payout Options</span>
            </a>
        </li>
    </ul>
</li>



<li class="nav-item" id="account-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-user"></i>
        <span class="title">My Indy John Account</span>
        <span class="arrow" id="account-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="sidebar-upgrade-buyer">
            <a href="#upgrade-supplier-acount-modal" data-toggle="modal" class="nav-link ">
                <i class="fa fa-money"></i>
                <span class="title">Upgrade My Account</span>        <!-- Put upgrade modal here -->
            </a>
        </li>
        <li class="nav-item" id="quotetek-user-verification-menu">
            <a href="{{url('quotetek/user/verification')}}" class="nav-link ">
                <i class="fa fa-plus"></i>
                <span class="title">Verify My Account</span>
            </a>
        </li>


        <li class="nav-item" id="account-package-menu">
            <a href="{{url('user/packages')}}" class="nav-link ">
                <i class="fa fa-hdd-o"></i>
                <span class="title">My Subscriptions</span>
            </a>
        </li>
        <!--
        <li class="nav-item" id="quotetekverification-view-menu">
                    <a href="{{url('quotetek/user/vrification/detail')}}" class="nav-link ">
                        <i class="fa fa-binoculars"></i>
                        <span class="title">Verification Status </span>
                    </a>
                </li>

        -->

        <!--<li class="nav-item" id="account-payment-info-menu">
            <a href="{{url('user/payment-info')}}" class="nav-link ">
                <i class="fa fa-credit-card"></i>
                <span class="title">Account Payment Details</span>
            </a>
        </li>-->
        <li class="nav-item" id="account-payment-history-menu">
            <a href="{{url('user/payment-history')}}" class="nav-link ">
                <i class="fa fa-money"></i>
                <span class="title">Account Payment History</span>
            </a>
        </li>
        <li class="nav-item" id="user-cards-view-menu">
            <a href="{{url('account-cards')}}" class="nav-link ">
                <i class="fa fa-credit-card"></i>
                <span class="title">Payment Information</span>
            </a>
        </li>
            <li class="nav-item" id="user-caccount-settings-view-menu">
            <a href="{{url('account/quotecheckout')}}" class="nav-link ">
                <i class="fa fa-cogs"></i>
                <span class="title">Quote Checkout Settings</span>
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

<!--
<li class="nav-item" id="verification-main-menu">
<a href="javascript:;" class="nav-link nav-toggle">
    <i class="fa fa-file-text"></i>
    <span class="title">Indy John Verification</span>
    <span class="arrow" id="verification-menu-arrow"></span>
</a>
<ul class="sub-menu">

    <li class="nav-item" id="quotetek-user-verification-menu">
        <a href="{{url('quotetek/user/vrification')}}" class="nav-link ">
            <i class="fa fa-plus"></i>
            <span class="title">User Verification</span>
        </a>
    </li>
<li class="nav-item" id="quotetekverification-view-menu">
        <a href="{{url('quotetek/user/vrification/detail')}}" class="nav-link ">
            <i class="fa fa-binoculars"></i>
            <span class="title">Verification Application</span>
        </a>
    </li>

    <li class="nav-item" id="emailverification-view-menu">
        <a href="{{url('user/email-verification')}}" class="nav-link ">
            <i class="fa fa-at"></i>
            <span class="title">Email Verification</span>
        </a>
    </li>
    <li class="nav-item" id="linkedinverification-view-menu">
        <a href="{{url('user/linkedin-verification')}}" class="nav-link ">
            <i class="fa fa-linkedin"></i>
            <span class="title">LinkedIn Verification</span>
        </a>
    </li>
</ul>
</li>-->
<!--
<li class="nav-item" id="review-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-registered"></i>
        <span class="title">Review Center</span>
        <span class="arrow" id="review-menu-arrow"></span>
    </a>
 <ul class="sub-menu">
  <li class="nav-item" id="endorsement-receive-menu">
            <a href="{{url('endorsement')}}" class="nav-link ">
                <i class="fa fa-comments-o"></i>
                <span class="title">Endorsement Received</span>
            </a>
        </li>
 <li class="nav-item" id="endorsement-sent-menu">
            <a href="{{url('endorse-sent')}}" class="nav-link ">
                <i class="fa fa-comment-o"></i>
                <span class="title">Endorsed Users</span>
            </a>
        </li>
       <li class="nav-item" id="review-receive-menu">
            <a href="{{url('review')}}" class="nav-link ">
                <i class="fa fa-comments-o"></i>
                <span class="title">Reviews Received</span>
            </a>
        </li>

        <li class="nav-item" id="review-sent-menu">
            <a href="{{url('review-sent')}}" class="nav-link ">
                <i class="fa fa-comment-o"></i>
                <span class="title">Reviews Sent Out</span>
            </a>
        </li>


    </ul>
</li>
-->


<li class="nav-item pulsate-three-target" id="jobs-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-thumb-tack"></i>
        <span class="title">Job Board</span>
        <span id="jobs-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="jobs-search-menu">
            <a href="{{url('jobs/search')}}" class="nav-link ">
                <i class="fa fa-search"></i>
                <span class="title">Search Jobs</span>
            </a>
        </li>
        <li class="nav-item" id="jobs-create-menu">
            <a href="{{url('job/create')}}" class="nav-link ">
                <i class="fa fa-thumb-tack"></i>
                <span class="title">Post a Job</span>
            </a>
        </li>
        <li class="nav-item" id="jobs-view-menu">
            <a href="{{url('job')}}" class="nav-link ">
                <i class="fa fa-list-ul"></i>
                <span class="title">Manage Listed Jobs</span>
            </a>
        </li>
        <li class="nav-item" id="jobs-saved-menu">
            <a href="{{url('jobs/saved')}}" class="nav-link ">
                <i class="fa fa-save"></i>
                <span class="title">Saved Jobs</span>
            </a>
        </li>
       <!-- <li class="nav-item">
            <a href="#" onclick='addReport(id)' id="job_profile" >
                <i class="fa fa-sticky-note"></i>
                <span class="title">Add Report</span>
            </a>
        </li> -->
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
                <i class="fa fa-th-list"></i>
                <span class="title">Manage Support Tickets</span>
            </a>
        </li>
        <li id="support-ticket-faq-menu" class="nav-item  ">
            <a href="{{url('supportticket/faq')}}" class="nav-link ">
                <i class="fa fa-question-circle"></i>
                <span class="title">FAQ</span>
            </a>
        </li>
        <li id="support-ticket-create-menu" class="nav-item  ">
            <a href="#footer-feedback" data-toggle="modal" data-target="#footer-feedback"  class="nav-link ">
                <i class="fa fa-heart"></i>
                <span class="title">Provide Feedback</span>
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
<div class="modal fade user-welcome-modal" id="small" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
<div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="55" width="260" /></div>
            </div>
            <div class="modal-body"><h3 class="align-center margin-top-30 margin-bottom-30"> Complete your User Profile before using Indy John.</h3></div>
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
<script>
    function GetYahooContact()
    {
        jQuery.ajax({
            url: '{{url("invite/yahoo/url")}}',
            type: 'get',
            success: function(data) {
                //window.location.href = data.url;
                window.open(data.url,'_blank');
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
    @if(Auth::user()->is_using_temporary_password == 0)
    <script>
    $(document).ready(function() {
        $("a.nav-link").click(function() {

            var href = $(this).attr("href");
            var profile_complete = '{{Auth::user()->userdetail->profile_complete}}';
            if(profile_complete == 0)
            {
                $('#small').modal('show');
                return false;
            }
            else
            {
                window.location.href = href;
            }
        });
    });
    </script>
    @endif

    <script>
    function addReport(id) {
        console.log(id);
        $('#report_page').modal('show');
        var reasonType = $('#reason');
        if(id = "market_listing"){
            reasonType.html('<option value="This listing is spam">This listing is spam</option><option value="This information is incorrect">This information is incorrect</option><option value="This is a stolen item">This is a stolen item</option><option value="This product needs verification">This product needs verification</option>');
        }
        if(id = "job_profile"){
            reasonType.html('<option value="This listing is spam">This listing is spam</option><option value="This information is incorrect">This information is incorrect</option><option value="This company is fraudulent">This company is fraudulent</option><option value="Other ">Other </option>');
        }
        if(id = "company_profile"){
            reasonType.html('<option value="This company profile is fake">This company profile is fake</option><option value="Content/ illegal information">Content/ illegal information</option><option value="Identity Theft">Identity Theft</option><option value="Other ">Other </option>');
        }
    }

</script>

