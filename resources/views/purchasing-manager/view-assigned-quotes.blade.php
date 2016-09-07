@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Assigned Quotes</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom" id="form_wizard_1">
      <div class="col-md-9 col-sm-9">
        <div class="row">
          <h3 class="page-title uppercase"> <i class="fa fa-exchange color-black"> </i> Assigned Quotes</h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-3">

      </div>
      </div>
    </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet-body">
            @if (Session::has('message'))
              <div id="" class="custom-alerts alert alert-success fade in">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
              {{ Session::get('message') }}
              </div>
          @endif
          <div class="col-md-9 paddin-npt">
            <p class="caption-helper">Here's the list of your Quotes that you have Assigned:</p>
          </div>
          <div class="col-md-12 paddin-npt">
              <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                  <thead>
                  <tr>
                      <th> Quote Received From </th>
                      <th> Buy Request Name</th>
                      <th> Received On</th>
                      <th> Assigned On</th>
                      <th>Assigned To</th>
                      <th> Actions </th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($buyerQuotesArray as $buyerQuotes)
                  <tr>
                      <td>{{$buyerQuotes['quote_received_from']}}</td>
                      <td>{{$buyerQuotes['buy_request_name']}}</td>
                      <td>{{date('d-m-Y',strtotime($buyerQuotes['created_on']))}}</td>
                      <td><a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">{{date('d-m-Y',strtotime($buyerQuotes['assigned_on']))}}</a></td>
                      <td><a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">{{$buyerQuotes['assigned_to']}}</a></td>
                      <td>
                          <div class="btn-group">
                              <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                              <ul class="dropdown-menu pull-right">
                                  <li><a href="{{url('supplier-quotes')}}/{{$buyerQuotes['quote_id']}}"><i class="fa fa-eye"></i> View Quote</a></li>
                                  <li class="divider"> </li>
                                  <li><a href="{{url('request-product-quotes')}}/{{$buyerQuotes['buy_request_id']}}"><i class="fa fa-eye"></i> View Buy Request</a></li>
                                  <li class="divider"> </li>
                                  <li><a href="#contact_seller" id="{{$buyerQuotes['supplier_id']}}" onclick='setSupplierReceiver(id)' data-toggle="modal" data-target="#contact_seller" ><i class="fa fa-file-o"></i>Message Supplier</a></li>
                                  <li class="divider"> </li>
                                  <li><a href="#contact_seller" id="{{$buyerQuotes['assigned_to_id']}}" onclick='setReceiver(id)' data-toggle="modal" data-target="#contact_seller"><i class="fa fa-file-text-o"></i> Message Team Member</a> </li>
                                  <li class="divider"> </li>
                                  <li> <a href="{{url('dismiss-quote-assignment')}}/{{$buyerQuotes['assigned_id']}}" ><i class="fa fa-pencil-remove"></i> Dismiss Assignment</a> </li>
                              </ul>
                          </div>
                      </td>
                  </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
          
           
         {{-- strike out until Hiren Enables Pagination. 
          <ul class="pager">
            @if($previous Page Url != '')
            <li class="previous"> <a class="btn btn-danger" href="{{$previousPageUrl}}"> ← Prev </a> </li>
            @endif
            
            @if($next Page Url != '')
            <li class="next"> <a class="btn btn-danger" href="{{$nextPageUrl}}"> Next → </a> </li>
            @endif
          </ul>
      --}}
                    
        </div>
  
        <!-- end --> 
        
        <!-- END EXAMPLE TABLE PORTLET--> 
        
      </div>
    </div>

  </div>
</div>

<script>
    $("#team-manager-purchasing").addClass("active");
    $('#team-manager-purchasing-menu-arrow').addClass('open');
    $('#view-assigned-quotes').addClass('active');

    function setReceiver(id){
        $('#message_receiver').val(id);
        $('#message_box_title').html('SEND MESSAGE TO TEAM MEMBER');
        $('#contactTeamMember').show();
        $('#contactSeller').hide();
    }

    function setSupplierReceiver(id){
        $('#message_receiver').val(id);
        $('#message_box_title').html('SEND MESSAGE TO SUPPLIER');
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

@endsection 
