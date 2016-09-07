@extends('buyer.app')
@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Dashboard</a>
        </li>
    </ul>
</div>
<h3 class="page-title"> 
Welcome {{Auth::user()->userdetail->first_name}}, to your Indy John Dashboard.
</h3>
<p class="font-wh"></p>
@if (Session::has('message'))
    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{!! Session::get('message') !!}</div>
@endif

<!-- BEGIN DASHBOARD STATS 1-->
                    <div class="row">
                    <div class="col-md-9 dashboard_box">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                
                                <div class="details">
                                <i class="fa fa-2x fa-cogs pull-right"></i>  
                                    <div class="number">
                                        <span data-counter="counterup" data-value="15">0</span>
                                    </div>
                                    <div class="desc"> New Quote Received </div>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                
                                <div class="details">
                                <i class="fa fa-2x fa-cogs pull-right"></i>  
                                    <div class="number">
                                        <span data-counter="counterup" data-value="155">0</span>
                                    </div>
                                    <div class="desc"> New <br>Messages </div>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                
                                <div class="details">
                                <i class="fa fa-2x fa-cogs pull-right"></i>  
                                    <div class="number">
                                        <span data-counter="counterup" data-value="15">0</span>
                                    </div>
                                    <div class="desc"> New Connections </div>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                
                                <div class="details">
                                <i class="fa fa-2x fa-cogs pull-right"></i>  
                                    <div class="number">
                                        <span data-counter="counterup" data-value="15">0</span>
                                    </div>
                                    <div class="desc"> New Endorsements </div>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 orange" href="#">
                                <div class="details text-center">
                                <i class="fa fa-4x fa-cogs center-block"></i>  
                                    
                                    <div class="desc"> Create a buy request </div>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                
                                <div class="details text-center">
                                <i class="fa fa-4x fa-cogs center-block"></i>  
                                    
                                    <div class="desc"> Post a Listing </div>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 orange" href="#">
                               <div class="details">
                                <i class="fa fa-2x fa-cogs pull-right"></i>  
                                    <div class="number">
                                        <span data-counter="counterup" data-value="15">0</span>
                                    </div>
                                    <div class="desc"> New Connections </div>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 orange" href="#">
                              <div class="details">
                                <i class="fa fa-2x fa-cogs pull-right"></i>  
                                    <div class="number">
                                        <span data-counter="counterup" data-value="15">0</span>
                                    </div>
                                    <div class="desc"> New Endorsements </div>
                                </div>
                                <div class="clearfix"></div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        </div>
                        <div class="row">
                        
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                               <div class="details text-center">
                                <i class="fa fa-4x fa-cogs center-block"></i>  
                                    
                                    <div class="desc"> Create a buy request </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                               <div class="details text-center">
                                <i class="fa fa-4x fa-cogs center-block"></i>  
                                    
                                    <div class="desc"> Post a Listing </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                               <div class="details">
                                <i class="fa fa-2x fa-cogs pull-right"></i>  
                                    <div class="number">
                                        <span data-counter="counterup" data-value="15">0</span>
                                    </div>
                                    <div class="desc"> New Connections </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                <div class="details">
                                <i class="fa fa-2x fa-cogs pull-right"></i>  
                                    <div class="number">
                                        <span data-counter="counterup" data-value="15">0</span>
                                    </div>
                                    <div class="desc"> New Endorsements </div>
                                </div>
                            </a>
                        </div>
                        </div>
                        </div>
                        <div class="col-md-3">
                        cdcs
                        </div>
                    </div>
                    <div class="clearfix"></div>


    <div id="activity-main-div" class="col-md-4">
        <!--<div class="portlet recentactivities light bordered">
            <div class="portlet-title">
                <div id="activity-title1" class="caption">
                    <i class="fa fa-bell-o"></i>  
                    <span class="caption-subject bold uppercase">User Notifications</span>
                </div>
                <div class="actions">
                    <a id="activity-hide1" href="javascript:void(0)" onclick="hideActivity();"><i class="fa fa-toggle-right"></i>  </a>
                    <a id="activity-show1" href="javascript:void(0)" onclick="showActivity();" style="display: none;"><i class="fa fa-toggle-left"></i>  </a>
                </div>
            </div>
            <div class="portlet-body" id="blockui_sample_2_portlet_body">
                <div class="scroller" style="height: 140px;" data-always-visible="1" data-rail-visible="0">
                    <ul class="feeds">
                        @if($wizard != 6)
                        <li>
                            <div class="col1">
                                <div class="cont" style="margin: 0px!important;">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-default">
                                            <i class="fa fa-magic"></i>  
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc">
                                            @if($wizard == 2)
                                                <a href="{{url('user-additional-details')}}">Create your Profile</a>
                                            @elseif($wizard == 3)
                                                <a href="{{url('user/upload/photo')}}">Finish your profile by uploading a photo.</a>
                                            @elseif($wizard == 4)
                                                <a href="{{url('user/company/select')}}">Create a Free Company Page and be discovered.</a>
                                            @elseif($wizard == 5)
                                                <a href="{{url('user/billing/plans')}}">Create your Profile</a>
                                            @else
                                                <a href="{{url('user-details')}}">Begin by Creating your Free User Profile</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endif
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
                                            <a href="{{url('invite/email')}}">Invite Your Contacts and Earn Payouts.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @if($quote_cnt == 0)
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
                        @endif
                        @if(Auth::user()->userdetail->profile_picture == '')
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
                        @endif
                        @if(Auth::user()->userdetail->company_id == '')
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
                        @endif
                    </ul>
                </div>
            </div>
        </div>-->
        <div class="portlet recentactivities light bordered">
            
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
        </div>
    </div>
    
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
$(document).ready(function() {
    
    ActivityUpdate();
});
function ActivityUpdate()
{
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    var baseurl = "{{url('dashboard/activity')}}";
    
    jQuery.ajax({
        url: baseurl,
        type: 'get',
        success: function(data) {
                  $('#dashboard-activities').html('');
                  $('#dashboard-activities').html(data.html);
                  App.unblockUI('#blockui_sample_1_portlet_body');
                 },
        done: function() {
            //console.log('error');
        },
        error: function() {
            //console.log('error');
        }
        
    }); 
}
var interval = setInterval(function () { ActivityUpdate(); }, 10000);
</script>
@endsection
