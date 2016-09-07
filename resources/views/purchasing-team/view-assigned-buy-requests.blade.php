@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Assigned Buy Requests</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">

    <div class="row">
        <div class="col-md-12 border2x_bottom" id="form_wizard_1">
            <div class="col-md-9 col-sm-9">
                <div class="row">
                    <h3 class="page-title uppercase"> <i class="fa fa-exchange color-black"> </i> Assigned Buy Requests </h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="row">
                    <div class="actions margin-top-15">
                        <select class="form-control" id="received-team-filter" onchange="ApplyFilter();">
                            <option value="">Select Team to View Buy Requests</option>
                            @foreach($allBuyerTeam as $team)
                            @if($team->id == $teamId)
                            <option selected value="{{ $team->id }}" @if($team_id == $team->id) selected="selected" @endif>{{ $team->name }}</option>
                            @else
                            <option value="{{ $team->id }}" @if($team_id == $team->id) selected="selected" @endif>{{ $team->name }}</option>
                            @endif
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
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet-body">
           @if (Session::has('message'))
             <div id="" class="custom-alerts alert alert-success fade in">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            {{ Session::get('message') }}</div>
           @endif
           <div class="col-md-9 paddin-npt">
            <p class="caption-helper">Assigned Buy Requests:</p>
           </div>
           <div class="col-md-12 paddin-npt">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
              <thead>
                <tr>
                  <th> Buy Request Name </th>
                  <th> Buy Request ID</th>
                  <th> Created On</th>
                  <th> Assigned On</th>
                  <th>Assigned To</th>
                  <th> Actions </th>
                </tr>
              </thead>
              <tbody>
              @foreach($allBuyRequestArray as $buyRequest)
              <tr>
                  <td>{{ $buyRequest['buyRequestName'] }}</td>
                  <td>{{ $buyRequest['buyRequestId'] }}</td>
                  <td>{{ $buyRequest['createdOn'] }}</td>
                  <td>{{ $buyRequest['assignedOn'] }}</td>
                  <td><a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">{{ $buyRequest['assignedTo'] }}</a></td>
                  <td><div class="btn-group"> <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                          <ul class="dropdown-menu pull-right">
                              <li> <a href="{{url('request-product-quotes')}}/{{$buyRequest['id']}}" target="_blank"><i class="fa fa-eye"></i> View Buy Request</a></li>
                              <li class="divider"> </li>
                              <li><a  href="{{url('request-product-quotes')}}/{{$buyRequest['id']}}#portlet_comments_2" ><i class="fa fa-file-o"></i> View Quotes Received </a></li>
                              <li class="divider"> </li>
                              <li> <a href="#contact_seller" id="{{$buyRequest['assigned_to_id']}}" onclick='setReceiver(id)' data-toggle="modal" data-target="#contact_seller" ><i class="fa fa-file-text-o"></i> Message Member</a> </li>
                          </ul>
                      </div>
                  </td>
              </tr>
              @endforeach
                </tbody>
            </table>
          </div>
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
        <!-- end -->
        <!-- END EXAMPLE TABLE PORTLET-->
      </div>
    </div>
  </div>
</div>

<script>
    $("#team-purchasing").addClass("active");
    $('#team-purchasing-menu-arrow').addClass('open');
    $('#assigned-buy-requests').addClass('active');

    function ApplyFilter()
    {
        var team_id = $('#received-team-filter').val();

        var redirect_url = '{{url("assigned-buy-requests")}}?team_id='+team_id;

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
@endsection
