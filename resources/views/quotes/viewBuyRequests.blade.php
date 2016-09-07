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
    <li> <span>Manage Buy Requests</span> </li>
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
          <div class="col-md-10 col-sm-10">
            <div class="row">
              <h3 class="page-title uppercase"> <i class="fa fa-toggle-on color-black"> </i> Manage Buy Requests </h3>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 text-right">
            <div class="row">
              <div class="actions margin-top-15"> <a href="{{ URL::to('request-product-quotes/create') }}" class="btn btn-circle btn-danger btn-sm"> <i class="fa fa-plus"></i> Create New Request</a> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">
      <div class="col-md-12">
      <div class="portlet-body form" id="blockui_sample_1_portlet_body"> @if($total > 0)
        <div class="paddin-bottom padding-top"> <span class="caption-helper">These are the Buy Requests you have submitted. You can view and manage your Received Quotes or Start a new Buy Request here.</span> </div>
        <div class="col-md-12 col-sm-12 col-xs-12 padding-top paddin-bottom" >
        <div class="row">
         <div class="col-md-4 col-sm-4 align-center font-wh">&nbsp;</div>
          <div class="col-md-2 col-sm-2 hidden-xs  align-center font-wh">Submission Date</div>
          <div class="col-md-2 col-sm-2 hidden-xs  align-center font-wh">Quote Received</div>
          <div class="col-md-2 col-sm-2 hidden-xs align-center font-wh">Status</div>
           <div class="col-md-2 col-sm-2 col-xs-12 pull-right" > <div class="row"><select id="received-quote-filter" onchange="ApplyFilter();" class="form-control" style="width: 90%;float: left;">
           <option>Sort By:</option>
              <option value="created_at" @if($quote_hidden_name == 'created_at') selected="selected" @endif>Submission Date</option>
              <option value="expiry_date" @if($quote_hidden_name == 'expiry_date') selected="selected" @endif>Expiration Date</option>
              <option value="title" @if($quote_hidden_name == 'title') selected="selected" @endif>Name</option>
              <!--option value="received_quotes" @if($quote_hidden_name == 'received_quotes') selected="selected" @endif>Quote Received</option-->
            </select>
            @if($quote_hidden_val == 'desc') <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-down padding-top" style="float: left;padding-left: 5px;"></i></a> @else <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-up padding-top" style="float: left;padding-left: 5px;"></i></a> @endif </div>
            </div>
            </div>
        </div>
        @foreach ($quotes as $index=>$quote)
        <div class="tablebg">
          <div class="colmd12  lead-expire ">
            <div class="col-md-4 col-sm-4 quote-grid">
            <div class="row">
              <h3 class="quote-title">{{ $quote->title }}</h3>
            
              <p><b>Product-Categories Selection: </b> @foreach($quote->categories as $index=>$category)
                @if($index < 5)
                @if($index == 0)
                {{$category->category->name}}
                @else
                , {{$category->category->name}}
                @endif
                @endif
                @endforeach </p>
              <p><b>Industry Reach Selection: </b> @foreach($quote->industries as $index=>$industry)
                @if($index < 5)
                @if($index == 0)
                {{$industry->industry->name}}
                @else
                , {{$industry->industry->name}}
                @endif
                @endif
                @endforeach </p>
                  <p><b>Additional Notes: </b>{{substr($quote->specifications, 0, 100)}}</p>
            </div>
            </div>
            <div class="col-md-2 col-sm-2 align-center"><div class="row"><span class="hidden-sm hidden-md hidden-lg">Submission Date: </span>{{ date('m/d/Y',strtotime($quote->created_at)) }}</div></div>
            <div class="col-md-2 col-sm-2 align-center"><div class="row"><span class="hidden-sm hidden-md hidden-lg">Quote Received: </span>{{count($quote->receivedQuotes)}}</div></div>
            <div class="col-md-2 col-sm-2 align-center"><div class="row"><span class="hidden-sm hidden-md hidden-lg">Status: </span>@if($quote->status == 1)Active @else Inactive @endif</div></div>
            <div class="col-md-2 col-sm-2 align-right"><div class="row">
              <div class="page-actions">
                <div class="btn-group">
                  <button type="button" class="btn btn-circle btn_yellow hvr-bounce-to-right" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <span class="hidden-sm hidden-xs">Actions&nbsp;</span> <i class="fa fa-angle-down"></i> </button>
                  <ul class="dropdown-menu" role="menu">
                    <li> <a href="{{url('request-product-quotes')}}/{{$quote->id}}" id="quoteview_{{$quote->id}}"> <i class="icon-eye"></i> View Buy Request </a> </li>
                    <li class="divider"> </li>
                   <!-- <li> <a href="javascript:;" id="quoteview_{{$quote->id}}" onclick="ViewQuote(id);"> <i class="icon-docs"></i> Expand to View </br> Full Details </a> </li> -->
                    <li class="divider"> </li>
                    @if($quote->status == 1)
                    <li> <a href="{{url('quote/buy-request/status')}}/{{$quote->id}}" id="quotepause_{{$quote->id}}" onclick="PauseQuote(id);"> <i class="fa fa-pause"></i> Change Status to Pause</a> </li>
                    @else
                    <li> <a href="{{url('quote/buy-request/status')}}/{{$quote->id}}" id="quotepause_{{$quote->id}}" onclick="ActiveQuote(id);"> <i class="fa fa-play"></i> Change Status to Active </a> </li>
                    @endif
                    <li class="divider"> </li>
                    <li> <a id="deleteButton" data-id="{{$quote->id}}" data-toggle="modal" href="#deleteConfirmation" > {!! Form::open([
                      'method' => 'DELETE',
                      'id' => 'DELETE_FORM_'.$quote->id,
                      'route' => ['request-product-quotes.destroy', $quote->id]
                      ]) !!}
                      {!! Form::close() !!} <i class="fa fa-remove"></i> Delete Request </a> </li>
                    <li class="divider"> </li>
                    <li> <a href="javascript:void(0)" id="{{ route('request-product-quotes.edit', $quote->id) }}" onclick="showModal(id)"> <i class="fa fa-pencil-square-o"></i> Extend Request </a> </li>
                    <li class="divider"> </li>
                    <li> <a href="{{url('supplier-quotes')}}?quote_id={{$quote->id}}"> <i class="fa fa-sitemap"></i> View Request Quotes</a> </li>
                  </ul>
                </div>
              </div>
              </div>
            </div>
            <div class="col-md-12 padding-top paddin-bottom grid-show" style="display: none;" id="quoteextend-{{$quote->id}}">
              <div  class="align-right"> <a href="javascript:;" id="quoteview_{{$quote->id}}" onclick="CloseQuote(id);"> <i class="fa fa-remove"></i> Close</a> </div>
              <div class="col-md-12">
                <div class="pull-left">
                  <h2><strong>{{$quote->title}}</strong></h2>
                  <h5><strong>Quantity Requested:</strong> {{$quote->qty_request}} </h5>
                  <h5><strong>Product-Categories Selection:</strong> @foreach($quote->categories as $index=>$category)
                    @if($index < 3)
                    @if($index == 0)
                    {{$category->category->name}}
                    @else
                    ,{{$category->category->name}}
                    @endif
                    @endif
                    @endforeach </h5>
                  <h5><strong>Submission Date:</strong> {{date('M d, Y',strtotime($quote->created_at))}} | <strong>Expiration Date:</strong> @if(strtotime($quote->expiry_date) > 0){{date('M d, Y',strtotime($quote->expiry_date))}} @else N/A @endif</h5>
                  <h5><strong>Status:</strong> @if($quote->status == 1)Active @else Inactive @endif</h5>
                </div>
                <div class="col-md-12 paddin-npt padding-top">
                  <label>Product | Category | Industry :</label>
                  <table class="data-table" id="product-attribute-specs-table">
                    <tr>
                      <th class="lb-val">Categories</th>
                      <td class="data-val"> @foreach($quote->categories as $index=>$category)
                        @if($index == 0)
                        {{$category->category->name}}
                        @else
                        ,{{$category->category->name}}
                        @endif
                        @endforeach </td>
                    </tr>
                    <tr>
                      <th class="lb-val">Industries</th>
                      <td class="data-val"> @foreach($quote->industries as $index=>$industry)
                        @if($index == 0)
                        {{$industry->industry->name}}
                        @else
                        ,{{$industry->industry->name}}
                        @endif
                        @endforeach </td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-12 paddin-npt padding-top">
                  <label>Quote Type :</label>
                  <table class="data-table" id="product-attribute-specs-table">
                    <tr>
                      <th class="lb-val">Equipment</th>
                      <td class="data-val"> @foreach($quote->Equipments as $index=>$Equipments)
                        @if($index == 0)
                        {{$Equipments->equipment->name}}
                        @else
                        ,{{$Equipments->equipment->name}}
                        @endif
                        @endforeach </td>
                    </tr>
                    <tr>
                      <th class="lb-val">Instrumentation</th>
                      <td class="data-val"> @foreach($quote->materialsToolings as $index=>$materialsTooling)
                        @if($index == 0)
                        {{$materialsTooling->materialsTooling->name}}
                        @else
                        ,{{$materialsTooling->materialsTooling->name}}
                        @endif
                        @endforeach </td>
                    </tr>
                    <tr>
                      <th class="lb-val">Services</th>
                      <td class="data-val"> @foreach($quote->services as $index=>$service)
                        @if($index == 0)
                        @if($service->service->name == 'Repairs') Repair @else {{$service->service->name}} @endif
                        @else
                        ,@if($service->service->name == 'Repairs') Repair @else {{$service->service->name}} @endif
                        @endif
                        @endforeach </td>
                    </tr>
                    <tr>
                      <th class="lb-val">Software</th>
                      <td class="data-val"> @foreach($quote->softwares as $index=>$software)
                        @if($index == 0)
                        {{$software->software->name}}
                        @else
                        ,{{$software->software->name}}
                        @endif
                        @endforeach </td>
                    </tr>
                    <tr>
                      <th class="lb-val">Consumables/ Materials</th>
                      <td class="data-val"> @foreach($quote->consumables as $index=>$consumable)
                        @if($index == 0)
                        @if($consumable->consumable->name == 'Suppliers') Supplies @else {{$consumable->consumable->name}} @endif
                        @else
                        ,@if($consumable->consumable->name == 'Suppliers') Supplies @else {{$consumable->consumable->name}} @endif
                        @endif
                        @endforeach </td>
                    </tr>
                  </table>
                </div>
                <div class="padding-top" style="clear: both;"></div>
                <p>Expiration Date: {{$quote->expiry_date}}</p>
                <p>Request Area: {{$quote->request_area}}</p>
                <p>Privacy: {{$quote->privacy}}</p>
                <p>Additional File: @if($quote->additional_file != '')<a href="{{url()}}/{{$quote->additional_file}}" download>Download File</a>@endif</p>
                <p>Accreditations: 
                  @foreach($quote->accreditations as $index=>$accreditation)
                  @if($index == 0)
                  {{$accreditation->accreditation->name}}
                  @else
                  ,{{$accreditation->accreditation->name}}
                  @endif
                  @endforeach </p>
                <p>Diversity Options: 
                  @foreach($quote->devirsities as $index=>$devirsitie)
                  @if($index == 0)
                  {{$devirsitie->diversity->name}}
                  @else
                  ,{{$devirsitie->diversity->name}}
                  @endif
                  @endforeach </p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @else
        <p /><h4>You have not received any quotes yet. Start by creating a new <a href="{{url('request-product-quotes/create')}}">Buy Request.</a></h4>
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
$("#buyer-tool-main-menu").addClass("active");
$('#buyer-tool-main-menu' ).click();
$('#buyer-tool-menu-arrow').addClass('open');
$('#buy-request-view-menu').addClass('active');
/* end menu active */
$(document).ready(function() {
	$('.date-picker').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true
    });

});
function ViewQuote(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    $( "#quoteextend-"+divId ).slideDown(300);
}
function CloseQuote(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    $( "#quoteextend-"+divId ).slideUp(300);
}
function showModal(id)
{
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
      var url = id;
      $.ajax({
        url: url,
        type: 'get',
        success: function(data) {
            $('#responsive').html('');
            $('#responsive').html(data.html);
            $('#responsive').modal('show');
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
            App.unblockUI('#blockui_sample_1_portlet_body');
        },   
        done: function() {
            //console.log('error');
            App.unblockUI('#blockui_sample_1_portlet_body');
        },
        error: function() {
            //console.log('error');
            App.unblockUI('#blockui_sample_1_portlet_body');
        }
        
    });
}

function ApplyFilter()
{
    var order_name = $('#received-quote-filter').val();
    console.log(order_name);
    var order_dir = '{{$quote_hidden_val}}';
    
    if(order_dir == 'asc')
    {
        var redirect_url = '{{url("quote/view-buy-requests")}}?quote_order_name='+order_name+'&quote_order_by=desc';
    }
    else
    {
        var redirect_url = '{{url("quote/view-buy-requests")}}?quote_order_name='+order_name+'&quote_order_by=asc';
    }
    window.location.href = redirect_url;
}

    
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
</script> 
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
@endsection 
