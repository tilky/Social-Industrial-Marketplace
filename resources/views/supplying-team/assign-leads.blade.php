@extends('buyer.app')

@section('content')
<style>
.media, .media-body{overflow: visible!important;}
</style>
<link href="{{URL::asset('css/style-additions.css')}}" rel="stylesheet" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Assigned Leads</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom hide_print">
      <div class="col-md-9 col-sm-9">
        <div class="row">
          <h3 class="page-title uppercase"> Assigned Leads </h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 text-right">
        <div class="row">
          <div class="actions margin-top-15"> <select id="received-quote-filter"  class="form-control" >
            <option >Sort By:</option>
              <option value="created_at" selected="selected">Selected Team</option>
              <option value="expiry_date">Expiration Date</option>
              <option value="hidden_quotes">Hidden</option>
            </select> </div>
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
      <h3>Leads assigned to you:</h3><br />
        <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6 margin-bottom-15">
          <div class="row">
            
            
              <select id="received-quote-filter" onchange="ApplyFilterQuote();" class="form-control col-md-8" style="float: left;">
          <option value="">Filter By Lead Requests</option>

            
        </select>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-5 margin-bottom-15 pull-right">
          
          <div class="row">
            <select id="received-quote-filter" onchange="ApplyFilter();" class="form-control" style="width: 90%;float: left;">
                       <option >Sort By:</option>
              <option value="" selected="selected">Team</option>
              <option value="">Most Recent</option>
              <option value="">Oldest</option>
            </select> </div>

            <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-down padding-top" style="float: left;padding-left: 5px;"></i></a> </div>
        </div>
        </div>
      </div>
      
      
      <div class="tablebg">
        <div class="colmd12  ">
          <div class="row">
            <div class="col-md-3 text-center">  <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
              <h4>NAME OF LEAD PERSON</h4>
              <h5>VERIFICATION STATUS</h5>
             
              <button type="button" class="btn btn-circle btn-free btn-block">MEMBERSHIP TYPE</button>
             
              <ul class="list-inline profile_num">
                <li> <img alt="" src="{{url('images/cmnt_icon.png')}}"> 0</li>
                <li> <img alt="" src="{{url('images/hrt_icon.png')}}"> 0</li>
                <li> <img alt="" src="{{url('images/star_icon.png')}}"> 0</li>
              </ul>
            </div>
            <div class="col-md-7 received-lead-con">
              <h4>title</h4>
              <h5> Quote date: <strong>07/18/2016</strong> | Buy Request date: <strong>07/18/2016</strong> </h5>
              <h5> Product: 
                <strong>this is a great product</strong>  </h5>
              <h5>Assigned by: <strong>Team Name</strong> </h5>
              <h5>Date Assigned: <strong>07/18/2016</strong> </h5>
            </div>
            <div class="col-md-2 text-center"> 
              <div class="price-text bold">$ 205</div>
              
              <div class="page-actions">
                <div class="btn-group ">
                  <button type="button" class="btn btn_yellow hvr-bounce-to-right dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <span class="hidden-sm hidden-xs">Actions&nbsp;</span> <i class="fa fa-angle-down"></i> </button>
                  <ul class="dropdown-menu pull-right">
                                  <li> <a href="{{url('supplierquote/accept')}}/"> <i class="fa fa-thumbs-o-up"></i> View Lead Request </a> </li>
                    <li> <a href="{{ URL::to('buyer/quote/ignore') }}//"> <i class="fa fa-rocket"></i> Send Quote </a> </li>
                   
                    <li> <a href="{{url('messages/create')}}?buyer=">Message Supplier</a> </li>
                    <li> <a href="{{url('feedback/create')}}?receiver_id=">Message Team Manager</a> </li>
                    
                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-12 padding-top paddin-bottom" style="background: #fff;margin: 10px 0px;">
        <p>You have not received any leads yet. Submit a new lead request.</p>
      </div>
     
      <ul class="pager">

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
