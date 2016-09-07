@extends('quickdemo.app')
@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Dashboard</a>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">

<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
Hello, .
</h3>

@if (Session::has('message'))
    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{!! Session::get('message') !!}</div>
@endif
</div>
</div>
<div class="row">
    <div class="col-md-9 dashboard_box border_right" id="main-dashboard-div">
    <div class="col-md-11">
        
    <div class="row" id="activity-counts">
    <div class="col-md-12 col-sm-12"><h4 class="bold">NEW NOTIFICATIONS</h4></div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="">
                 <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="0">0</span>
                    </div>
                    <div class="desc">Quotes Received</div>
                </div>
                <div class="clearfix"></div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{url('messages')}}">
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="0">0</span></div>
                    <div class="desc"> Unread Messages</div>
                </div>
                <div class="clearfix"></div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{url('contactusers/contact/pandding')}}">
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="0">0</span></div>
                    <div class="desc"> New Connections Requests </div>
                </div>
                <div class="clearfix"></div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{url('endorsement')}}">
                
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="0">0</span></div>
                    <div class="desc"> New Endorsements </div>
                </div>
                <div class="clearfix"></div>
            </a>
        </div>
        </div>
        
        </div>
        <div class="col-md-12 col-sm-12 border_top" id="quick-actions">
        <div class="row">
        <div class="col-md-11" >
        <div class="row">
        <div class="col-md-12 col-sm-12"><h4 class="no-margin  margin-bottom bold">QUICK ACTIONS</h4></div>
        </div>
        </div>
        <div class="col-md-11">
        <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{url('request-product-quotes/create')}}">
                <div class="details text-center">
                <i class="fa fa-3x fa-folder-open center-block"></i>  
                    <div class="desc"> Create a <br />Buy Request </div>
                </div>
                <div class="clearfix"></div>
            </a>
            <div class="clearfix"></div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{url('market/post-your-product')}}">
                
                <div class="details text-center">
                <i class="fa fa-3x fa-shopping-cart center-block"></i>  
                    
                    <div class="desc"> Post a <br />Market Listing </div>
                </div>
                <div class="clearfix"></div>
            </a>
            <div class="clearfix"></div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="#upgrade-supplier-acount-modal" data-toggle="modal">
                
                <div class="details text-center">
                <i class="fa fa-3x fa-unlock-alt center-block"></i>  
                    
                    <div class="desc"> Upgrade<br />Your Account </div>
                </div>
                <div class="clearfix"></div>
            </a>
            <div class="clearfix"></div>
        </div>


 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{url('quotetek/user/verification')}}">
                
                <div class="details text-center">
                <i class="fa fa-3x fa-close center-block"></i>  
                    <div class="desc"> Verification Status:<br /> 
                    Not Verified 
                    </div>
                </div>
                <div class="clearfix"></div>
            </a>
            <div class="clearfix"></div>
        </div>
        </div>
        </div>
        </div>
        </div>
        
        
    <div id="activity-main-div" class="col-md-12 border_top recent-activities">
        <div class="row">
        <div class="portlet portlet box">
            
            <div class="portlet-title">
                <div id="activity-title" class="caption">
                    <i class="icon-share"></i>  
                    <span class="caption-subject bold uppercase">Recent Activities</span>
                </div>
                <div class="tools">
                
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    <i class="fa fa-toggle-down"></i>  
                    <i class="fa fa-toggle-up"></i>  
                     </a>
                        
                    </div>
            </div>
            <div class="portlet-body" id="blockui_sample_1_portlet_body">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 182px;"><div id="dashboard-activities" class="scroller" style="height: 182px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible="0" data-initialized="1"><ul class="feeds"><li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="http://localhost/quotetek.v2/job/view/1">An applicant has contacted you regarding your Job Listing New Opening for TDS .</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> 23 hours ago </div>
                            </div>
                        </li><li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="http://localhost/quotetek.v2/job/view/1">An applicant has contacted you regarding your Job Listing New Opening for TDS .</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> 23 hours ago </div>
                            </div>
                        </li><li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="http://localhost/quotetek.v2/job/view/11">You saved a job listing for later viewing.</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> 20 hours ago </div>
                            </div>
                        </li><li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="http://localhost/quotetek.v2/job/view/21">You posted a New Job Listing, gfhfgh.</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> 1 day ago </div>
                            </div>
                        </li><li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="http://localhost/quotetek.v2/job/view/20">You posted a New Job Listing, after payment.</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> 1 day ago </div>
                            </div>
                        </li><li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="http://localhost/quotetek.v2/job/view/19">You posted a New Job Listing, dfsdfd dsf.</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> 1 day ago </div>
                            </div>
                        </li><li>
                            <div class="col1">
                                <div class="cont margin-remove">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-sticky-note"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <strong><a href="http://localhost/quotetek.v2/marketplaceproducts/34">You posted after time zone in the Market.</a></strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="date"> 1 day ago </div>
                            </div>
                        </li></ul></div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 102.87px; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
                <div class="scroller-footer">
                    <div class="btn-arrow-link pull-right">
                        <a href="http://localhost/quotetek.v2/user-activity">See All Notifications</a>
                        <i class="icon-arrow-right"></i>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
    </div>
    <div id="notification-main-div" class="col-md-3 user-alerts">
        <div class="portlet box">
            <div class="portlet-title">
                <div id="activity-title1" class="caption">
                    <i class="fa fa-bell-o"></i>  
                    <span class="caption-subject bold uppercase">User Alerts</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    <i class="fa fa-toggle-down"></i>  
                    <i class="fa fa-toggle-up"></i>  
                     </a>
                </div>
            </div>
            <div class="portlet-body" id="blockui_sample_2_portlet_body">
                <div class="scroller" style="height: 585px;" data-always-visible="1" data-rail-visible="0">
                    <ul class="feeds">
                        <li>
                            <div class="col1">
                                <div class="cont" style="margin: 0px!important;">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-default">
                                            <i class="fa fa-user"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc">
                                            <a href="{{url('quotetek/user/verification')}}">Verify your User Profile.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont" style="margin: 0px!important;">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-default">
                                            <i class="fa fa-archive"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc">
                                            <a href="#company-notification-modal" data-toggle="modal" >Verify your Company Page.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont" style="margin: 0px!important;">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-default">
                                            <i class="fa fa-user-plus"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc">
                                            <a href="#basic" data-toggle="modal">Invite Your Contacts and Earn Payouts.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont" style="margin: 0px!important;">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-default">
                                            <i class="fa fa-cart-plus"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc">
                                            <a href="{{url('request-product-quotes/create')}}">Submit a Buy Bequest and Start Receiving Quotes now.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont" style="margin: 0px!important;">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-default">
                                            <i class="fa fa-camera"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc">
                                            <a href="{{url('user/account')}}#tab_1_2">Get ranked higher by uploading a photo.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="col1">
                                <div class="cont" style="margin: 0px!important;">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-default">
                                            <i class="fa fa-institution"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc">
                                            <a href="{{url('user/change-company')}}">Modify your Company Details.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--<div class="portlet recentactivities light bordered">
            
            <div class="portlet-title">
                <div id="activity-title" class="caption">
                    <i class="icon-share"></i>  
                    <span class="caption-subject bold uppercase">Recent Activities</span>
                </div>
                <div class="actions">
                    <a id="activity-hide" href="javascript:void(0)" onclick="hideActivity();"><i class="fa fa-toggle-right"></i>  </a>
                    <a id="activity-show" href="javascript:void(0)" onclick="showActivity();" style="display: none;"><i class="fa fa-toggle-left"></i>  </a>
                </div>
            </div>
            <div class="portlet-body" id="blockui_sample_1_portlet_body">
                <div id="dashboard-activities" class="scroller" style="height: 400px;" data-always-visible="1" data-rail-visible="0">
                    
                </div>
                <div class="scroller-footer">
                    <div class="btn-arrow-link pull-right">
                        <a href="{{url('user-activity')}}">See All Notifications</a>
                        <i class="icon-arrow-right"></i>  
                    </div>
                </div>
            </div>
        </div>-->
    </div>
    
</div>
<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
<!-- /.modal -->
<div class="modal fade" id="company-notification-modal" tabindex="-1" role="basic" aria-hidden="true" data-width="400">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <div class="col-md-12 margin-top-40 margin-bottom-40">
                        <div class="col-md-12 align-center">
                            <h3 class="modal-title">Please login to your company dashboard and verify it.</h3>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
function hideActivity()
{
    $('#main-dashboard-div').removeClass('col-md-8');
    $('#main-dashboard-div').addClass('col-md-11');
    $('#activity-main-div').removeClass('col-md-4');
    $('#activity-main-div').addClass('col-md-1');
    $('#activity-title').hide();
    $('#activity-title1').hide();
    $('#blockui_sample_1_portlet_body').hide();
    $('#blockui_sample_2_portlet_body').hide();
    $('#activity-hide').hide(10);
    $('#activity-show').show(10);
    $('#activity-hide1').hide(10);
    $('#activity-show1').show(10);
}
function showActivity()
{
    $('#main-dashboard-div').removeClass('col-md-11');
    $('#main-dashboard-div').addClass('col-md-8');
    $('#activity-main-div').removeClass('col-md-1');
    $('#activity-main-div').addClass('col-md-4');
    $('#activity-title').show();
    $('#activity-title1').show();
    $('#blockui_sample_1_portlet_body').show();
    $('#blockui_sample_2_portlet_body').show();
    $('#activity-hide').show(10);
    $('#activity-show').hide(10);
    $('#activity-hide1').show(10);
    $('#activity-show1').hide(10);
}

</script>
@endsection
