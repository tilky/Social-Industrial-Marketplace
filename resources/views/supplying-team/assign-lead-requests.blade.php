@extends('buyer.app')

@section('content')
<style>
.portlet.box{float: left!important;width: 100%!important;}
.portlet.box>.portlet-title{float: left;width: 100%;}
.portlet.box>.portlet-body{float: left;width: 100%;}

.quote-title{margin-top: 5px!important;}
.quote-grid p{margin-bottom: 5px!important;}
.modal-dialog{margin: 0 auto!important;width: auto!important;}
</style>
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('css/style-additions.css')}}" rel="stylesheet" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-toggle-on"></i> </li>
        <li> <span>Assigned Lead Requests</span> </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="responsive" class="modal fade" tabindex="-1" data-width="760"></div>
        @if (Session::has('message'))
        <div id="" class="custom-alerts alert alert-success fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
          {{ Session::get('message') }}</div>
        @endif
        <div class="col-md-12 main_box">
            <div class="row">
                <div class="col-md-12 border2x_bottom">
                    <div class="col-md-9 col-sm-9">
                        <div class="row">
                            <h3 class="page-title uppercase"> <i class="fa fa-group color-black"></i> Assigned Lead Requests </h3>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="row">
                            <div class="actions margin-top-15">
                                <select class="form-control" name="selectTeam" id="received-team-filter" onchange="ApplyFilter();">
                                    <option value="">Select Team to View Lead Requests</option>
                                    @foreach($allSupplierTeam as $team)
                                    <option value="{{ $team->id }}" @if($team_id == $team->id) selected="selected" @endif>{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="portlet-body form" id="blockui_sample_1_portlet_body">
                            <div class="paddin-bottom padding-top"> <span class="caption-helper">These are your assigned Lead Requests:</span> </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 padding-top paddin-bottom" >
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 align-center font-wh">&nbsp;</div>
                                    <div class="col-md-2 col-sm-2 hidden-xs  align-center font-wh">Submission Date</div>
                                    <div class="col-md-2 col-sm-2 hidden-xs  align-center font-wh">Lead Received</div>
                                    <div class="col-md-2 col-sm-2 hidden-xs align-center font-wh">Status</div>
                                    <div class="col-md-2 col-sm-2 col-xs-12 pull-right" >
                                        <div class="row">
                                            <select id="received-leads-filter" onchange="ApplyFilter();" class="form-control col-md-8" style="float: left;">
                                                <option>Sort By : (Recent / Oldest)</option>
                                                <option value="created_at" @if($lead_hidden_name == 'created_at') selected="selected" @endif >Submitted Date</option>
                                            </select>
                                            @if($lead_hidden_val == 'desc') <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-down padding-top" style="float: left;padding-left: 5px;"></i></a> @else <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-up padding-top" style="float: left;padding-left: 5px;"></i></a> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach($supplierLeadsArray as $leads)
                        <div class="tablebg">
                            <div class="colmd12  lead-expire ">
                                <div class="col-md-4 col-sm-4 quote-grid">
                                    <div class="row">
                                        <h3 class="quote-title"></h3>
                                            <p><b>Specification : </b>{{ $leads['specification'] }}</p>
                                            <p><b>Product Types/ Categories Selected : </b>
                                                @foreach($leads['productTypes'] as $index=>$category)
                                                    @if($index < 5)
                                                        @if($index == 0)
                                                            {{$category->category->name}}
                                                        @else
                                                            , {{$category->category->name}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </p>
                                            <p><b>Assign in Team : </b>{{ $leads['assignInTeam'] }}</p>
                                            <p><b>Industry Selection : </b>
                                                @foreach($leads['industrySelected'] as $ind_index=>$industry)
                                                    @if($ind_index == 0)
                                                        {{$industry->industry->name}}
                                                    @else
                                                        , {{$industry->industry->name}}
                                                    @endif
                                                @endforeach
                                            </p>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 align-center"><div class="row"><span class="hidden-sm hidden-md hidden-lg">Submission Date: </span>{{ $leads['dateSubmitted'] }}</div></div>
                                <div class="col-md-2 col-sm-2 align-center"><div class="row"><span class="hidden-sm hidden-md hidden-lg">Quote Received: </span>{{ count($leads['leadReceived']) }}</div></div>
                                <div class="col-md-2 col-sm-2 align-center"><div class="row"><span class="hidden-sm hidden-md hidden-lg">Status: </span>@if($leads['status'] == 1) Active @else Inactive @endif</div></div>
                                <div class="col-md-2 col-sm-2 align-right">
                                    <div class="row">
                                        <div class="page-actions">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-circle btn_yellow hvr-bounce-to-right" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <span class="hidden-sm hidden-xs">Actions&nbsp;</span> <i class="fa fa-angle-down"></i> </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li> <a href="{{url('supplier-leads')}}/{{$leads['id']}}/edit" > <i class="icon-eye"></i> View Lead Request  </a> </li>
                                                    <li class="divider"> </li>
                                                    <li> <a href="#" > <i class="icon-docs"></i> Received Leads  </a> </li>

                                                    <li class="divider"> </li>
                                                    <li> <a href="#contact_seller" id="{{$leads['assigned_to_id']}}" onclick='setReceiver(id)' data-toggle="modal" data-target="#contact_seller" ><i class="fa fa-file-text-o"></i> Message Member</a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <ul class="pager">
                            @if($previousPageUrl != '')
                            <li class="previous">
                                <a href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i> Prev </a>
                            </li>
                            @endif
                            @if($nextPageUrl != '')
                            <li class="next">
                                <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i> </a>
                            </li>
                            @endif
                        </ul>
                </div>
            </div>
        </div>
        <div>
    </div>
    </div>
</div>

<script>

    $("#team-supplying").addClass("active");
    $('#team-supplying-menu-arrow').addClass('open');
    $('#assign-lead-requests').addClass('active');

    $(document).ready(function() {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true
        });
    });

    function ApplyFilter()
    {
        var order_name = $('#received-leads-filter').val();
        var order_dir = '{{$lead_hidden_name}}';
        var team_id = $('#received-team-filter').val();

        if(order_dir == 'asc')
        {
            var redirect_url = '{{url("assign-lead-requests")}}?lead_order_name='+order_name+'&lead_order_by=desc&team_id='+team_id;
        }
        else
        {
            var redirect_url = '{{url("assign-lead-requests")}}?lead_order_name='+order_name+'&lead_order_by=asc&team_id='+team_id;
        }

        window.location.href = redirect_url;
    }

    function setReceiver(id){
        $('#message_receiver').val(id);
        $('#message_box_title').html('SEND MESSAGE TO TEAM MEMBER');
        $('#contactTeamMember').show();
        $('#contactSeller').hide();
    }

    function sendTeamMemberMessage(){
        var subject =  document.getElementById('subject').value;
        var body =  document.getElementById('message_body').value;
        var receiver =  document.getElementById('message_receiver').value;
        var baseurl = "{{url('member/message/send')}}";

        $.ajax({
            type : 'POST',
            url : baseurl,
            data:{
                '_token':'{{csrf_token()}}',
                subject : subject,
                body : body,
                receiver_id : receiver
                //reportType : reportType
            },
            success:function(data) {
                $('#contact_seller').modal('hide');
            },
            done: function() {
            },
            error: function() {
            }
        });
    }

</script> 
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
@endsection 
