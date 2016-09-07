@extends('buyer.app')

@section('content')
<style>
.media, .media-body{overflow: visible!important;}
</style>
<link href="{{URL::asset('css/style-additions.css')}}" rel="stylesheet" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Received Product Quotes</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom hide_print">
      <div class="col-md-9 col-sm-8">
        <div class="row">
          <h3 class="page-title uppercase"> Manage Received Quotes</h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-4 text-right">
        <div class="row">
          <div class="actions margin-top-15"> <a href="{{ URL::to('request-product-quotes/create') }}" class="btn btn-circle btn-danger btn-sm"> <i class="fa fa-plus"></i> Submit a new Buy Request</a> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12"> @if (Session::has('message'))
      <div id="" class="custom-alerts alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        {{ Session::get('message') }}</div>
      @endif
      <div class="col-md-12 margin-top-15">
        <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6 margin-bottom-15">
          <div class="row">
            
            
              <select id="received-quote-filter" onchange="ApplyFilterQuote();" class="form-control col-md-8" style="float: left;">
          <option value="">Filter By Buy Request</option>
          
                @foreach($userquotes as $userquote)
                    
          <option value="{{$userquote->id}}" @if($userquote->id == $current_quote_id) selected="selected" @endif>{{$userquote->title}}</option>
          
                @endforeach
            
        </select>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-5 margin-bottom-15 pull-right">
          
          <div class="row">
            <select id="received-quote-filter" onchange="ApplyFilter();" class="form-control" style="width: 90%;float: left;">
            <option >Sort By:</option>
              <option value="created_at" selected="selected">Submission Date</option>
              <option value="expiry_date">Expiration Date</option>
              <option value="hidden_quotes">View Ignored Quotes</option>
            </select>
            <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-down padding-top" style="float: left;padding-left: 5px;"></i></a> </div>
        </div>
        </div>
      </div>
      
      @if($total > 0)
      @foreach ($SupplierQuotes as $index=>$quote)
      <div class="tablebg">
        <div class="colmd12 @if($quote->buy_request->status == 0) lead-inactive @elseif(strtotime(date('Y-m-d')) > strtotime($quote->buy_request->expiry_date)) lead-expire @else lead-active @endif ">
          <div class="row">
            <div class="col-md-3 text-center"> @if($quote->supplierUser->profile_picture != '') <img src="{{url('')}}/{{$quote->supplierUser->profile_picture}}" alt="sell" class="img-circle" width="70px"> @else <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px"> @endif
              <h5>{{$quote->supplierUser->first_name}} {{$quote->supplierUser->last_name}} @if($quote->supplierCompany != '') | {{$quote->supplierCompany->name}} @endif</h5>
              <h5> @if($quote->supplier->quotetek_verify == 1) VERIFIED MEMBER @else NOT VERIFIED @endif </h5>
              @if($quote->star == 'gold')
              <button type="button" class="btn btn-circle btn-gold btn-block">GOLD SUPPLIER</button>
              @elseif($quote->star == 'silver')
              <button type="button" class="btn btn-circle btn-silver btn-block">SILVER SUPPLIER</button>
              @else
              <button type="button" class="btn btn-circle btn-free btn-block">FREE MEMBER</button>
              @endif
              <ul class="list-inline profile_num">
                <li> <img alt="" src="{{url('images/cmnt_icon.png')}}"> {{count($quote->supplier->messages)}}</li>
                <li> <img alt="" src="{{url('images/hrt_icon.png')}}"> {{count($quote->supplier->endorsements)}}</li>
                <li> <img alt="" src="{{url('images/star_icon.png')}}"> {{count($quote->supplier->reviews)}}</li>
              </ul>
            </div>
            <div class="col-md-7 received-lead-con">
              <h4>{{$quote->title}}</h4>
              <h5> Quote Date: <strong>{{date('m/d/Y',strtotime($quote->created_at))}}</strong> | Buy Request Date: <strong>{{date('m/d/Y',strtotime($quote->buy_request->created_at))}}</strong> </h5>
             
           
              <h5> Quote Product Details : 
                @foreach($quote->SupplierQuoteItems as $index=>$item) <strong>@if($index == 0)
                {{$item->title}}
                @else
                ,{{$item->title}},
                @endif</strong> @endforeach </h5>
              <h5> </h5>
            </div>
            <div class="col-md-2 text-center"> @if($quote->price == 0)
              <div class="price-text bold">N/A</div>
              @else
              <div class="price-text bold">${{$quote->price}}</div>
              @endif
              <div class="page-actions margin-top-40">
                <div class="btn-group margin-top-20">
                  <button type="button" class="btn btn_yellow hvr-bounce-to-right dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <span class="hidden-sm hidden-xs">Actions&nbsp;</span> <i class="fa fa-angle-down"></i> </button>
                  <ul class="dropdown-menu pull-right">
                    <li> <a href="{{ route('supplier-quotes.show', $quote->id) }}">View Quote Details</a> </li>
                    @if($quote->status == 0)
                    <li> <a href="{{url('supplierquote/accept')}}/{{$quote->id}}">Accept Quote </a> </li>
                    <li> <a href="{{ URL::to('buyer/quote/ignore') }}/{{$current_user_id}}/{{$quote->id}}">Ignore Quote</a> </li>
                    @endif
                    <li>
                        <a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser({{$quote->supplier_id}})">
                             Message Supplier </a>
                        <!--<a href="{{url('messages/create')}}?buyer={{$quote->supplier_id}}">Message Supplier</a>-->
                    </li>
                <!--    <li> <a href="{{url('feedback/create')}}?receiver_id={{$quote->supplierData->id}}">Offer Feedback</a> </li> -->
                  </ul>
                </div>
              </div>
              <!--<div class="btn-group pull-right" style="width: 60%;">
                          <div class="actions" style="width: 100%;">
                            <div class="btn-group" style="width: 100%;padding: 10px;">
                                <a class="btn btn-danger-haze btn-m dropdown-toggle" style="padding: 10px 21px;" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="{{ route('supplier-quotes.show', $quote->id) }}">View Quote</a>
                                    </li>
                                    @if($quote->status == 0)
                                    <li>
                                        <a href="{{url('supplierquote/accept')}}/{{$quote->id}}">
                                        <i class="fa fa-thumbs-o-up"></i> Accept Quote </a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::to('buyer/quote/ignore') }}/{{$current_user_id}}/{{$quote->id}}">
                                        <i class="fa fa-ban"></i> Ignore </a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{url('messages/create')}}?buyer={{$quote->supplier_id}}">Message Supplier</a>
                                    </li>
                                    <li>
                                        <a href="{{url('feedback/create')}}?receiver_id={{$quote->supplierData->id}}">Feedback</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </div>--> 
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @else
      <div class="col-md-12 padding-top paddin-bottom" style="background: #fff;margin: 0px 0px;">
        <h4>You have not received any Quotes yet.</h4>
      </div>
      @endif
      <ul class="pager">
        @if($previousPageUrl != '')
        <li class="previous"> <a href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i> Prev </a> </li>
        @endif
        @if($nextPageUrl != '')
        <li class="next"> <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i> </a> </li>
        @endif
      </ul>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<script>
/* for show menu active */
$("#buyer-tool-main-menu").addClass("active");
$('#buyer-tool-main-menu' ).click();
$('#buyer-tool-menu-arrow').addClass('open');
$('#quote-received-menu').addClass('active');
/* end menu active */
    
function ApplyFilterQuote()
{
    var quote_id = $('#received-quote-filter').val();
    var redirect_url = '{{url("supplier-quotes")}}?quote_id='+quote_id;
    window.location.href = redirect_url;
}    
</script> 
<script src="{{URL::asset('js/starrr.js')}}" type="text/javascript"></script>
@endsection 
