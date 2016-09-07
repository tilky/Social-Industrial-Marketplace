<style>
.page-sidebar .page-sidebar-menu>li>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li>a{background-color: #2F353B;color: #F3C200;}
.page-sidebar .page-sidebar-menu>li>a>i, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li>a>i{color: #F3C200;}
.page-sidebar .page-sidebar-menu .sub-menu>li>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu .sub-menu>li>a{color: #F3C200;}
.page-sidebar .page-sidebar-menu .sub-menu>li>a>i, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu .sub-menu>li>a>i{color: #F3C200;}
.page-sidebar .page-sidebar-menu .sub-menu, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu .sub-menu{background-color: #2F353B;color: #F3C200;margin: 0px;}
.page-sidebar .page-sidebar-menu li>a>.arrow.open:before, .page-sidebar .page-sidebar-menu li>a>.arrow:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li>a>.arrow.open:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li>a>.arrow:before{color: #F3C200;}
</style>
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
<li id="dashboard-menu" class="nav-item {{ (Route::getFacadeRoot()->current()->uri() == 'user-dashboard') ? 'active open' : '' }}">
    <a href="{{url('user-dashboard')}}" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>  
        <span class="title">Home</span>
    </a>
</li>
<li class="nav-item pulsate-one-target pulsate-four-target" id="quote-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-cogs"></i>  
        <span class="title">Quote-Lead System</span>
        <span id="quote-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="catalog-upload-menu">
            <a href="{{url('supplier-lead/upload-catalog')}}" class="nav-link ">
                <i class="fa fa-cloud-upload"></i>  
                <span class="title">Upload Your Catalog</span>
            </a>
        </li>
        <li class="nav-item" id="leads-add-menu">
            <a href="{{url('supplier-leads/create')}}" class="nav-link ">
                <i class="fa fa-plus"></i>  
                <span class="title">New Lead Request</span>
            </a>
        </li>
        <li class="nav-item" id="leads-view-menu">
            <a href="{{url('supplier-leads')}}" class="nav-link ">
                <i class="fa fa-bars"></i>  
                <span class="title">Lead Request Manager</span>
            </a>
        </li>
        <li class="nav-item" id="quote-view-menu">
            <a href="{{url('request-product-quotes')}}" class="nav-link ">
                <i class="fa fa-sticky-note"></i>  
                <span class="title">Leads Received</span>
            </a>
        </li>
        <li class="nav-item" id="quote-create-supplier-menu">
            <a href="{{url('supplier-create-quote')}}" class="nav-link ">
                <i class="fa fa-plus"></i>  
                <span class="title">Create a Quote</span>
            </a>
        </li>
        <li class="nav-item" id="quote-sent-menu">
            <a href="{{url()}}/supplier-sent-quote" class="nav-link ">
                <i class="fa fa-share-square-o"></i>  
                <span class="title">Quotes Sent Out</span>
            </a>
        </li>
    </ul>
</li>
<!--
<li class="nav-item pulsate-five-target" id="buyer-tool-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-male"></i>  
        <span class="title">Buyer Tools</span>
        <span id="buyer-tool-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="create-quote-menu">
            <a href="{{url('request-product-quotes/create')}}" class="nav-link">
                <i class="fa fa-plus"></i>  
                <span class="title">Request Quotes</span>
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
                <span class="title">Default Settings</span>
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
-->

<li class="nav-item pulsate-three-target" id="marketplace-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-money"></i>  
        <span class="title">Indy John Market</span>
        <span id="marketplace-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="marketplace-product-search-menu">
            <a href="{{url('marketplaceproduct/search')}}" class="nav-link ">
                <i class="fa fa-search"></i>  
                <span class="title">Marketplace Search</span>
            </a>
        </li>
        <li class="nav-item" id="marketplace-view-product-menu">
            <a href="{{url('marketplace/mylistings')}}" class="nav-link ">
                <i class="fa fa-sticky-note"></i>  
                <span class="title">View Listed Products</span>
            </a>
        </li>
        <li class="nav-item" id="marketplace-create-product-menu">
            <a href="{{url('market/post-your-product')}}" class="nav-link ">
                <i class="fa fa-shopping-cart"></i>  
                <span class="title">Post Your Product</span>
            </a>
        </li>
        <!--<li class="nav-item" id="marketplace-default-settings-menu">
            <a href="{{url('marketplaceproducts/product/defaultsettings')}}" class="nav-link ">
                <i class="fa fa-cogs"></i>  
                <span class="title">Default Settings</span>
            </a>
        </li>-->
    </ul>
</li>
<li class="nav-item pulsate-seven-target" id="referrals-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>  
        <span class="title">Referral Program</span>
        <span class="arrow" id="referrals-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="referral-about-program-menu">
            <a href="{{url('referral-link/about-the-program')}}" class="nav-link ">
                <i class="fa fa-info-circle"></i>  
                <span class="title">About Program</span>
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
                <i class="fa fa-sticky-note"></i>  
                <span class="title">View Your Referrals</span>
            </a>
        </li>
        <li class="nav-item" id="referral-generated-income-menu">
            <a href="{{url('referral/generate/income')}}" class="nav-link ">
                <i class="fa fa-file-text-o"></i>  
                <span class="title">Payment History</span>
            </a>
        </li>
        <li class="nav-item" id="referral-payment-info-menu">
            <a href="{{url('referral/payment-info')}}" class="nav-link ">
                <i class="fa fa-money"></i>  
                <span class="title">Payment Info</span>
            </a>
        </li>
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
        <i class="fa fa-archive"></i>  
        <span class="title">Company Pages</span>
        <span class="arrow" id="conpmay-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item" id="current-company-menu">
            <a href="{{url('user/currentCompany')}}" class="nav-link ">
                <i class="fa fa-sticky-note"></i>  
                <span class="title">Your Current Company</span>
            </a>
        </li>
        <li class="nav-item" id="edit-company-menu">
            <a href="{{url('user/editCompany')}}" class="nav-link ">
                <i class="fa fa-edit"></i>  
                <span class="title">Edit Company Details</span>
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
<!--<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-wrench"></i>  
        <span class="title">Pricing Tool</span>
    </a>
</li>-->
<li id="messenger-main-menu" class="nav-item  ">
    <a href="{{url('messages')}}" class="nav-link nav-toggle">
        <i class="fa fa-envelope"></i>  
        <span class="title">Messaging Inbox @include('messenger.unread-count')</span>
    </a>
</li>
<li id="contact-list-main-menu" class="nav-item  pulsate-six-target">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-bars"></i>  
        <span class="title">Network Center</span>
        <span id="contact-list-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li id="contact-list-view-menu" class="nav-item">
            <a href="{{url('contactusers')}}" class="nav-link ">
                <i class="fa fa-sticky-note"></i>  
                <span class="title">Your Connections</span>
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
        <li id="contact-pandding-invite-menu" class="nav-item">
            <a href="{{url('contact/pending/invite')}}" class="nav-link ">
                <i class="fa fa-send-o"></i>  
                <span class="title">Pending Referrals</span>
            </a>
        </li>
        
    </ul>
</li>
<li class="nav-item" id="account-main-menu">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-user-secret"></i>  
        <span class="title">Account Management</span>
        <span class="arrow" id="account-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
<li class="nav-item" id="account-package-menu">
            <a href="{{url('user/packages')}}" class="nav-link ">
                <i class="fa fa-hdd-o"></i>  
                <span class="title">Subscription Information</span>
            </a>
        </li>
        <li class="nav-item" id="account-payment-info-menu">
            <a href="{{url('user/payment-info')}}" class="nav-link ">
                <i class="fa fa-credit-card"></i>  
                <span class="title">Payment Details</span>
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
        <span class="title">Indy John Verification</span>
        <span class="arrow" id="verification-menu-arrow"></span>
    </a>
    <ul class="sub-menu">
        
        <li class="nav-item" id="quotetek-user-verification-menu">
            <a href="{{url('quotetek/user/vrification')}}" class="nav-link ">
                <i class="fa fa-plus"></i>  
                <span class="title">Verification Application</span>
            </a>
        </li>
<li class="nav-item" id="quotetekverification-view-menu">
            <a href="{{url('quotetek/user/vrification/detail')}}" class="nav-link ">
                <i class="fa fa-binoculars"></i>  
                <span class="title">Verification Status</span>
            </a>
        </li>

        <!--<li class="nav-item" id="emailverification-view-menu">
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
        </li>-->
    </ul>
</li>
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
<li id="support-tickets-main-menu" class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-support"></i>  
        <span class="title">Help Center</span>
        <span id="support-tickets-menu-arrow" class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li id="support-ticket-create-menu" class="nav-item  ">
            <a href="{{url()}}/supporttickets/create" class="nav-link ">
                <i class="fa fa-ticket"></i>  
                <span class="title">Create a Ticket</span>
            </a>
        </li>
        <li id="support-ticket-view-menu" class="nav-item  ">
            <a href="{{url()}}/supporttickets" class="nav-link ">
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
<!-- profile alert -->
<div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content align-center">
            
            <div class="modal-body h3"> Complete your User Profile before using Indy John.</div>
            <div class="modal-footer align-center">
                @if(Route::getFacadeRoot()->current()->uri() == 'user-details')
                <button id="confirmDelete" type="button" data-dismiss="modal" class="btn btn-circle yellow-crusta color-black bold">Continue to Profile Setup</button>
                @else
                <a href="{{url('user-details')}}" class="btn btn-circle yellow-crusta color-black bold">Explain your Concern/Comments</a>
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
