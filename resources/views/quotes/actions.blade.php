@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/apps/css/todo.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/apps/css/style2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url()}}/user-dashboard">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <a href="{{url('request-product-quotes')}}">Quotes</a> <i class="fa fa-circle"></i> </li>
    <li> <span>View</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
  <div class="col-md-12 border2x_bottom">
    <div class="col-md-6 col-sm-6">
      <div class="row">
        <h3 class="page-title uppercase"> <i class="fa fa-server color-black"></i> Manage & Receive Quotes </h3>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 text-right">
      <div class="row">
        <h3 class="page-title uppercase">Buy Request#: {{$quote->unique_number}}</h3>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12"> 
    <!-- responsive -->
    <div id="responsive" class="modal fade" tabindex="-1" data-width="760"></div>
    <!-- BEGIN EXAMPLE TABLE PORTLET--> 
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    
    <div class="portlet-body form" id="blockui_sample_1_portlet_body"> @if (Session::has('message'))
      <div id="" class="custom-alerts alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        {{ Session::get('message') }}</div>
      @endif
      @if(Auth::user()->id == $quote->created_by)
      <div class="mt-element-step">
        <div class="row step-line">
          <div id="company-first" class="col-md-4 mt-step-col first done">
            <div class="mt-step-number bg-white">1</div>
            <div class="mt-step-title uppercase font-grey-cascade">Create a Buy Request</div>
          </div>
          <div id="company-second" class="col-md-4 mt-step-col active">
            <div class="mt-step-number bg-white">2</div>
            <div class="mt-step-title uppercase font-grey-cascade">Manage & Receive Quotes</div>
          </div>
          <div id="company-third" class="col-md-4 mt-step-col last">
            <div class="mt-step-number bg-white">3</div>
            <div class="mt-step-title uppercase font-grey-cascade">Actions Taken</div>
          </div>
        </div>
      </div>
      <div class="yellow-crusta-seprator"></div>
      @endif
      <div class="padding-15" id="print_section">
        <link href="{{URL::asset('metronic/apps/css/todo.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('metronic/apps/css/style2.css')}}" rel="stylesheet" type="text/css" />
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
        <div class="actions pull-right title_action" id="activen-view"> @if(Auth::user()->id == $quote->created_by)
          <div class="btn-group"> <a class="btn btn-circle action_bg btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
            <ul class="dropdown-menu pull-right">
              <li> <a href="{{url('supplier-quotes')}}?quote_id={{$quote->id}}">View Quotes Received</a> </li>
              <li class="divider"> </li>
              <li> <a data-toggle="modal" href="#new_notes">Add a New Note</a> </li>
              <li> <a href="javascript:;" onclick="printDiv('print_section')">Print Details</a> </li>
              @if($quote->status == 1)
              <li> <a href="{{url('quote/buy-request/status')}}/{{$quote->id}}?from=view" id="quotepause_{{$quote->id}}" onclick="PauseQuote(id);">Pause Request </a> </li>
              @else
              <li> <a href="{{url('quote/buy-request/status')}}/{{$quote->id}}?from=view" id="quotepause_{{$quote->id}}" onclick="ActiveQuote(id);">Active Request </a> </li>
              @endif
              <li> <a id="{{ route('request-product-quotes.edit', $quote->id) }}" onclick="showModal(id)">Extend Request</a> </li>
            </ul>
          </div>
          @endif </div>
        <div class="clearfix"></div>
        <div class="portlet-body">
          
              <div class="col-md-12">
              <div class="row">
                  
                  <div class="col-md-12 border_top border_bottom">
                    <div class="col-md-12">
                      <div class="row"> Congratulation on selecting the winnig quote. Indy John does not process payment but you can complete following post transection</div>
                    </div>
                    
                  </div>
                </div>
                <div class="row">
                  <h4>Next Step:</h4>
                  <div class="col-md-12 border_top border_bottom">
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="row"> Message the winning supllier profile, <b>%Supllier name%</b> and work the next step to complete the transection </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="row">
                        <button class="btn btn-circle btn-md yellow-light pull-right" data-toggle="modal" href="#new_notes">Send Message</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <h4>After Completing the Transection:</h4>
                  <div class="col-md-12 border_top border_bottom">
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="row"> Visit Back and review you experince with <b>%Supllier name%</b> </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="row">
                        <button class="btn btn-circle btn-md yellow-light pull-right" data-toggle="modal" href="#new_notes">Review</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <h4>After Completing the Transection:</h4>
                  <div class="col-md-12 border_top border_bottom">
                    <div class="col-md-9 col-sm-9 col-xs-9">
                      <div class="row"> Review and endrose the <b>% other Supllier name%</b> that bid on your quote</div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <div class="row">
                        <button class="btn btn-circle btn-md yellow-light pull-right" data-toggle="modal" href="#new_notes">Review</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

  
<!-- responsive -->

<!-- BEGIN EXAMPLE TABLE PORTLET--> 
 
<script src="{{URL::asset('metronic/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/apps/scripts/todo.min.js')}}" type="text/javascript"></script>
@endsection 
