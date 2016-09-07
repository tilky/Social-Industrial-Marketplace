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
        <li> <span>Lead Request Manager</span> </li>
    </ul>
</div>
<div class="row">
<div class="col-md-12">
<!-- responsive -->
<div id="responsive" class="modal fade" tabindex="-1" data-width="760"></div>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
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
                <h3 class="page-title uppercase"> <i class="fa fa-toggle-on color-black"> </i> Lead Request Manager </h3>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 text-right">
            <div class="row">
                @if($user_access_level == 3)
                <div class="actions margin-top-10"> <a href="{{ URL::to('supplier-leads/create') }}" class="btn btn-circle btn-danger btn-sm"> <i class="fa fa-plus"></i> Create a Lead Request</a> </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-md-12">
<div class="col-md-12">
<div class="portlet-body form" id="blockui_sample_1_portlet_body"> @if($total > 0)
<div class="paddin-bottom padding-top"> <span class="caption-helper">Manage your Product-Category Lead Requests.</span> </div>
<div class="col-md-12 col-sm-12 col-xs-12 padding-top paddin-bottom" >
    <div class="row">
        <div class="col-md-4 col-sm-4 align-center font-wh">&nbsp;</div>
        <div class="col-md-2 col-sm-2 hidden-xs  align-center font-wh">Submission Date</div>
        <div class="col-md-2 col-sm-2 hidden-xs  align-center font-wh">Lead(s) Received</div>
        <div class="col-md-2 col-sm-2 hidden-xs align-center font-wh">Lead Request Status</div>
        <div class="col-md-2 col-sm-2 col-xs-12 pull-right" > <div class="row"><select id="received-leads-filter" onchange="ApplyFilter();" class="form-control" style="width: 90%;float: left;">
                    <option>Sort By:</option>
                    <option value="expiry_date" @if($lead_hidden_name == 'expiry_date') selected="selected" @endif>Expiration Date</option>
                    <option value="created_at" @if($lead_hidden_name == 'created_at') selected="selected" @endif>Submission Date</option>
                </select>
                @if($lead_hidden_val == 'desc') <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-down padding-top" style="float: left;padding-left: 5px;"></i></a> @else <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-up padding-top" style="float: left;padding-left: 5px;"></i></a> @endif </div>
        </div>
    </div>
</div>
@foreach($supplierLeads as $index=>$lead)
<div class="tablebg">
    <div class="colmd12  lead-expire ">
        <div class="col-md-4 col-sm-4 quote-grid">
            <div class="row">
                @if($user_access_level == 1)
                <p><b>Created By: </b>{{$lead->userName}}</p>
                @endif
                <p><b>Product-Categories Selection: </b>
                    @foreach($lead->categories as $cat_index=>$category)
                    @if($cat_index == 0)
                    {{$category->category->name}}
                    @else
                    , {{$category->category->name}}
                    @endif
                    @endforeach
                    </p>
                <p><b>Industry Selection: </b>
                    @if(count($lead->industries) > 0)
                        @foreach($lead->industries as $ind_index=>$industry)
                            @if($ind_index == 0)
                            {{$industry->industry->name}}
                            @else
                            , {{$industry->industry->name}}
                            @endif
                        @endforeach
                    @else
                        N/A
                    @endif
                </p>
            </div>
        </div>
        <div class="col-md-2 col-sm-2 align-center margin-top-30"><div class="row"><span class="hidden-sm hidden-md hidden-lg">Submission Date: </span>{{date('M d, Y',strtotime($lead->created_at))}}</div></div>
        <div class="col-md-2 col-sm-2 align-center margin-top-30"><div class="row"><span class="hidden-sm hidden-md hidden-lg">Lead Received: </span>{{count($lead->receivedQuotes)}}</div></div>
        <div class="col-md-2 col-sm-2 align-center margin-top-20"><div class="row"><span class="hidden-sm hidden-md hidden-lg">Status: </span>
                @if($lead->status == 0)
                <a href="{{url('supplierlead/status/update')}}/{{$lead->id}}/1" class="btn btn-circle red btn-sm">
                    <i class="fa fa-pause"></i> Inactive </a>
                @else
                <a href="{{url('supplierlead/status/update')}}/{{$lead->id}}/0" class="btn btn-circle green-haze btn-sm">
                    <i class="fa fa-play"></i> Active </a>
                @endif</div></div>
        <div class="col-md-2 col-sm-2 align-right margin-top-20">
            <div class="row">
                <div class="page-actions">
                    <div class="btn-group">
                        <button type="button" class="btn btn-circle yellow-crusta" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <span class="hidden-sm hidden-xs">Actions&nbsp;</span> <i class="fa fa-angle-down"></i> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('supplier-leads.edit', $lead->id) }}">
                                    <i class="fa fa-edit"></i> Edit Request </a></li>
                            <li class="divider"> </li>
                            @if($lead->status == 0)
                            <li><a href="{{url('supplierlead/status/update')}}/{{$lead->id}}/1">
                                    <i class="fa fa-play"></i> Change Status </a></li>
                            @else
                            <li><a href="{{url('supplierlead/status/update')}}/{{$lead->id}}/0">
                                    <i class="fa fa-pause"></i> Change Status </a></li>
                            @endif
                            <li class="divider"> </li>
                            <li><a id="deleteButton" data-id="{{$lead->id}}" data-toggle="modal" href="#deleteConfirmation">

                                    {!! Form::open([
                                    'method' => 'DELETE',
                                    'id' => 'DELETE_FORM_'.$lead->id,
                                    'route' => ['supplier-leads.destroy', $lead->id]
                                    ]) !!}
                                    {!! Form::close() !!}
                                    <i class="fa fa-remove"></i> Delete Request </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach
@else
<p /><h4>You have not received any leads yet. Start by creating a new <a href="{{url('supplier-leads/create')}}">Lead Request.</a></h4>
@endif
<ul class="pager">
    @if($previousPageUrl != '')
    <li class="previous"> <a  href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i> Prev </a> </li>
    @endif
    @if($nextPageUrl != '')
    <li class="next"> <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i> </a> </li>
    @endif
</ul>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
</div>
<div>
</div>
</div>
</div>
<script>
    /* for show menu active */
    $("#quote-main-menu").addClass("active");
    $('#quote-main-menu' ).click();
    $('#quote-menu-arrow').addClass('open');
    $('#leads-view-menu').addClass('active');
    /* end menu active */
    $(document).ready(function() {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true
        });

    });

    $(document).on("click", "#deleteButton", function () {
        var id = $(this).data('id');
        jQuery('#deleteConfirmation .modal-body #objectId').val( id );
    });

    jQuery('#deleteConfirmation .modal-footer button').on('click', function (e) {
        var $target = $(e.target); // Clicked button element
        $(this).closest('.modal').on('hidden.bs.modal', function () {
            if($target[0].id == 'confirmDelete'){
                $( "#DELETE_FORM_" + jQuery('#deleteConfirmation .modal-body #objectId').val() ).submit();
            }
        });
    });

    function ApplyFilter()
    {
        var order_name = $('#received-leads-filter').val();
        console.log(order_name);
        var order_dir = '{{$lead_hidden_name}}';

        if(order_dir == 'asc')
        {
            var redirect_url = '{{url("supplier-leads")}}?lead_order_name='+order_name+'&lead_order_by=desc';
        }
        else
        {
            var redirect_url = '{{url("supplier-leads")}}?lead_order_name='+order_name+'&lead_order_by=asc';
        }
        window.location.href = redirect_url;
    }

</script>
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
@endsection 
