@extends('supplier.app')

@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Dashboard</a> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom">
      <h3 class="page-title uppercase"> @if(Session::has('new_user_singup')) Welcome, @else Hello, @endif {{Auth::user()->userdetail->first_name}}. </h3>
      @if (Session::has('message'))
      <div id="" class="custom-alerts alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        {!! Session::get('message') !!}</div>
      @endif </div>
  </div>
  <div class="row">
    <div class="col-md-9 dashboard_box border_right" id="main-dashboard-div">
      <div class="col-md-11">
        <div class="row" id="activity-counts">
          <div class="col-md-12 col-sm-12">
            <h4 class="bold">NEW NOTIFICATIONS</h4>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 black" href="{{url('request-product-quotes')}}">
            <div class="details">
              <div class="number"> <span data-counter="counterup" data-value="{{$lead_cnt}}">0</span> </div>
              <div class="desc"> New leads<br />
                Received </div>
            </div>
            <div class="clearfix"></div>
            </a>
            <div class="clearfix"></div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 black" href="{{url('messages')}}">
            <div class="details">
              <div class="number"> <span data-counter="counterup" data-value="{{count($threads_cnt)}}">0</span> </div>
              <div class="desc"> Unread Messages</div>
            </div>
            <div class="clearfix"></div>
            </a>
            <div class="clearfix"></div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 black" href="{{url('contact/user/pending')}}">
            <div class="details">
              <div class="number"> <span data-counter="counterup" data-value="{{$contact_cnt}}">0</span> </div>
              <div class="desc"> New Connections Requests</div>
            </div>
            <div class="clearfix"></div>
            </a>
            <div class="clearfix"></div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 black" href="{{url('endorsement')}}">
            <div class="details">
              <div class="number"> <span data-counter="counterup" data-value="{{$endorsements_cnt}}">0</span> </div>
              <div class="desc"> New Endorsements </div>
            </div>
            <div class="clearfix"></div>
            </a>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 border_top" id="quick-actions">
        <div class="row">
          <div class="col-md-11" >
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <h4 class="bold">QUICK ACTIONS</h4>
              </div>
            </div>
          </div>
          <div class="col-md-11" >
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 black" href="{{url('supplier-leads/create')}}">
                <div class="details text-center"> <i class="fa fa-3x fa-folder-open center-block"></i>
                  <div class="desc"> Create a <br />
                    Lead Request </div>
                </div>
                <div class="clearfix"></div>
                </a>
                <div class="clearfix"></div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 black" href="{{url('market/post-your-product')}}">
                <div class="details text-center"> <i class="fa fa-3x fa-shopping-cart center-block"></i>
                  <div class="desc"> Post a <br />
                    Market Listing </div>
                </div>
                <div class="clearfix"></div>
                </a>
                <div class="clearfix"></div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 black" href="#upgrade-supplier-acount-modal" data-toggle="modal">
                <div class="details text-center"> <i class="fa fa-3x fa-unlock-alt center-block"></i>
                  <div class="desc"> Upgrade <br />
                    Your Account </div>
                </div>
                <div class="clearfix"></div>
                </a>
                <div class="clearfix"></div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 black" href="{{url('quotetek/user/verification')}}">
                <div class="details text-center"> @if(Auth::user()->quotetek_verify == 1) <i class="fa fa-3x fa-check-circle center-block"></i> @else <i class="fa fa-3x fa-close center-block"></i> @endif
                  <div class="desc"> Verification Status:<br />
                    @if(Auth::user()->quotetek_verify == 1)
                    
                    Verified
                    
                    @else
                    
                    Not Verified 
                    
                    @endif </div>
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
          <div class="tabbable tabbable-tabdrop">
            <div class="portlet">
              <ul class="nav nav-tabs pull-left">
                <li class="active"> <a href="#tab1" data-toggle="tab">
                  <div id="activity-title1" class="caption"> <i class="fa fa-bell-o"></i> <span class="caption-subject bold uppercase">User Alerts</span> </div>
                  </a> </li>
                <li> <a href="#tab2" data-toggle="tab">
                  <div id="activity-title" class="caption"> <i class="icon-share"></i> <span class="caption-subject bold uppercase">Recent Activities</span> </div>
                  </a> </li>
              </ul>
              <div class="portlet-title">
                <div class="tools"> <a href="javascript:;" class="collapse" data-original-title="" title=""> <i class="fa fa-toggle-down"></i> <i class="fa fa-toggle-up"></i> </a> </div>
              </div>
              <div class="tab-content portlet-body" id="blockui_sample_2_portlet_body">
                <div class="tab-pane active" id="tab1">
                  <div class="portlet-body" id="blockui_sample_2_portlet_body">
                    <div class="scroller" style="height: 182px;" data-always-visible="1" data-rail-visible="0">
                      <ul class="feeds">
                        <li>
                          <div class="col1">
                            <div class="cont" style="margin: 0px!important;">
                              <div class="cont-col1">
                                <div class="label label-sm label-default"> <i class="fa fa-money"></i> </div>
                              </div>
                              <div class="cont-col2">
                                <div class="desc"> @if(Session::get('user_type') == 'supplier') <a href="javascript:void(0)" id="upgrade-supplier-modal-notification">Upgrade your Account to unlock all features.</a> @else <a href="javascript:void(0)" id="upgrade-buyer-modal-notification">Upgrade your Account to unlock all features.</a> @endif </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        @if(Auth::user()->quotetek_verify != 1)
                        <li>
                          <div class="col1">
                            <div class="cont" style="margin: 0px!important;">
                              <div class="cont-col1">
                                <div class="label label-sm label-default"> <i class="fa fa-user"></i> </div>
                              </div>
                              <div class="cont-col2">
                                <div class="desc"> <a href="{{url('quotetek/user/verification')}}">Verify your User Profile.</a> </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        @endif 
                        
                        <!--@if($company_verification_notify == 1)

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

                        @endif-->
                        
                        <li>
                          <div class="col1">
                            <div class="cont" style="margin: 0px!important;">
                              <div class="cont-col1">
                                <div class="label label-sm label-default"> <i class="fa fa-user-plus"></i> </div>
                              </div>
                              <div class="cont-col2">
                                <div class="desc"> <a href="#basic" data-toggle="modal">Invite Your Contacts and Earn Payouts.</a> </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        @if($supplier_lead_count == 0)
                        <li>
                          <div class="col1">
                            <div class="cont" style="margin: 0px!important;">
                              <div class="cont-col1">
                                <div class="label label-sm label-default"> <i class="fa fa-paper-plane-o"></i> </div>
                              </div>
                              <div class="cont-col2">
                                <div class="desc"> <a href="{{url('supplier-lead/upload-catalog')}}"><b>Upload your Catalog</b> and Start Receiving Leads.</a> </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li>
                          <div class="col1">
                            <div class="cont" style="margin: 0px!important;">
                              <div class="cont-col1">
                                <div class="label label-sm label-default"> <i class="fa fa-paper-plane-o"></i> </div>
                              </div>
                              <div class="cont-col2">
                                <div class="desc"> <a href="{{url('supplier-leads/create')}}">Create a <b>New Lead Request</b> and Start Receiving New Leads.</a> </div>
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
                                <div class="label label-sm label-default"> <i class="fa fa-camera"></i> </div>
                              </div>
                              <div class="cont-col2">
                                <div class="desc"> <a href="{{url('user/account')}}#tab_1_2">Get ranked higher by uploading a photo.</a> </div>
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
                                <div class="label label-sm label-default"> <i class="fa fa-institution"></i> </div>
                              </div>
                              <div class="cont-col2">
                                <div class="desc"> <a href="{{url('user/change-company')}}">Modify your Company Details.</a> </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        @endif
                        
                        @if($company_request != '')
                        
                        @foreach($company_request as $c_request)
                        <li>
                          <div class="col1">
                            <div class="cont" style="margin: 0px!important;">
                              <div class="cont-col1">
                                <div class="label label-sm label-default"> <i class="fa fa-user-plus"></i> </div>
                              </div>
                              <div class="cont-col2">
                                <div class="desc"> <a href="{{url('company/all-users')}}#tab_1_2">{{$c_request->user->userdetail->first_name}} {{$c_request->user->userdetail->last_name}} requested to be added to.</a> </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        @endforeach
                        
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tab2">
                  <div class="portlet-body" id="blockui_sample_1_portlet_body">
                    <div id="dashboard-activities" class="scroller" style="height: 182px;" data-always-visible="1" data-rail-visible="0"> </div>
                    <div class="scroller-footer">
                      <div class="btn-arrow-link pull-right"> <a href="{{url('user-activity')}}">See All Notifications</a> <i class="icon-arrow-right"></i> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--<div class="portlet portlet box">
            <div class="portlet-title">
              <div id="activity-title" class="caption"> <i class="icon-share"></i> <span class="caption-subject bold uppercase">Recent Activities</span> </div>
              <div class="tools"> <a href="javascript:;" class="collapse" data-original-title="" title=""> <i class="fa fa-toggle-down"></i> <i class="fa fa-toggle-up"></i> </a> </div>
            </div>
            <div class="portlet-body" id="blockui_sample_1_portlet_body">
              <div id="dashboard-activities" class="scroller" style="height: 182px;" data-always-visible="1" data-rail-visible="0"> </div>
              <div class="scroller-footer">
                <div class="btn-arrow-link pull-right"> <a href="{{url('user-activity')}}">See All Notifications</a> <i class="icon-arrow-right"></i> </div>
              </div>
            </div>
          </div>--> 
        </div>
      </div>
    </div>
    <div class="col-md-3 user-alerts relative" id="notification-main-div"> 
      
      <!-- notifications -->
      
      
      <h4 class="bold uppercase text-center"><i class="pull-left fa fa-bell-o"></i> Indy John <b>Now</b> </h4>
        <div class="tabbable tabbable-tabdrop portlet-body">
          <div class="portlet">
            <ul class="nav nav-tabs pull-left">
              <li class="active"> <a href="#tab3" data-toggle="tab">
                <div id="activity-title1" class="caption"> <i class="icon-share"></i> <span class="caption-subject bold uppercase">My Feed</span> </div>
                </a> </li>
              <li> <a href="#tab4" data-toggle="tab">
                <div id="activity-title" class="caption"> <i class="icon-share"></i> <span class="caption-subject bold uppercase">Everyone</span> </div>
                </a> </li>
            </ul>
            <div class="portlet-title">
              <div class="tools"> <a href="javascript:;" class="collapse" data-original-title="" title=""> <i class="fa fa-toggle-down"></i> <i class="fa fa-toggle-up"></i> </a> </div>
            </div>
            <div class="tab-content portlet-body" id="blockui_sample_2_portlet_body">
              <div class="tab-pane active" id="tab3">
                <div class="portlet-body" id="blockui_sample_2_portlet_body">
                <p>Keep in touch with people and compaines that metter to you and your business.</p>
                <div class="uppercase john_now">Indy John <b>Now</b><br />Launching Soon</div>
                 </div>
              </div>
              <div class="tab-pane" id="tab4">
                <div class="portlet-body" id="blockui_sample_1_portlet_body">
                <p>Keep in touch with people and compaines that metter to you and your business.</p>
                <div class="uppercase john_now">Indy John <b>Now</b><br />Launching Soon</div>
                 </div>
              </div>
            </div>
          </div>
        </div>
       
      
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

    $('#activity-main-div').removeClass('col-md-9');

    $('#activity-main-div').addClass('col-md-1');

    $('#activity-title').hide();

    $('#blockui_sample_1_portlet_body').hide();

    $('#activity-hide').hide(10);

    $('#activity-show').show(10);

}

function showActivity()

{

    $('#activity-main-div').removeClass('col-md-1');

    $('#activity-main-div').addClass('col-md-9');

    $('#activity-title').show();

    $('#blockui_sample_1_portlet_body').show();

    $('#activity-hide').show(10);

    $('#activity-show').hide(10);

}

function hideNotification()

{

    $('#main-dashboard-div').removeClass('col-md-9');

    $('#main-dashboard-div').addClass('col-md-11');

    $('#notification-main-div').removeClass('col-md-3');

    $('#notification-main-div').addClass('col-md-1');

    $('#activity-title1').hide();

    $('#blockui_sample_2_portlet_body').hide();

    $('#activity-hide1').hide(10);

    $('#activity-show1').show(10);

}

function showNotification()

{

    $('#main-dashboard-div').removeClass('col-md-11');

    $('#main-dashboard-div').addClass('col-md-9');

    $('#notification-main-div').removeClass('col-md-1');

    $('#notification-main-div').addClass('col-md-3');

    $('#activity-title1').show();

    $('#blockui_sample_2_portlet_body').show();

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
