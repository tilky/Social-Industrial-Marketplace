@extends('supplier.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
        <li> <span>Assigned Lead Requests</span> </li>
    </ul>
</div>
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
                        <select class="form-control" id="received-team-filter" onchange="ApplyFilter();">
                            <option value="">Select Team to View Members</option>
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
                <div class="portlet-body">
                    @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {{ Session::get('message') }}
                    </div>
                    @endif
                    <div class="col-md-9 paddin-npt">
                        <p class="caption-helper">Assigned Lead Requests:</p>
                    </div>
                    <div class="col-md-12 paddin-npt">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                                <tr>
                                    <th>Lead Request Name</th>
                                    <th>Lead Request ID</th>
                                    <th>Created On</th>
                                    <th>Assigned On</th>
                                    <th>Assigned To</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($allSupplierLeadRequestArray as $supplierLeadRequest)
                                <tr>
                                    <td>{{ $supplierLeadRequest['leadRequestName'] }}</td>
                                    <td>{{ $supplierLeadRequest['leadRequestId'] }}</td>
                                    <td>{{ $supplierLeadRequest['createdOn'] }}</td>
                                    <td>{{ $supplierLeadRequest['assignedOn'] }}</td>
                                    <td><a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">{{ $supplierLeadRequest['assignedTo'] }}</a></td>
                                    <td>
                                        <div class="btn-group"> <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li> <a href="{{url('supplier-leads')}}/{{$supplierLeadRequest['id']}}/edit" target="_blank"><i class="fa fa-eye"></i> View Lead Request</a></li>
                                                <li><a href="#" ><i class="fa fa-file-o"></i> Leads Received </a></li>
                                                <li> <a href="#contact_seller" id="{{$supplierLeadRequest['assigned_to_id']}}" onclick='setReceiver(id)' data-toggle="modal" data-target="#contact_seller" ><i class="fa fa-file-text-o"></i> Message Member(s)</a> </li>
                                                <li class="divider"> </li>
                                                <li> <a href="{{url('cancel-lead-request-assignment')}}/{{$supplierLeadRequest['assigned_id']}}" ><i class="fa fa-pencil-remove"></i> Cancel Assignment</a> </li>
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
            </div>
        </div>
    </div>
</div>
<script>
    $("#team-manager-supplying").addClass("active");
    $('#team-manager-supplying-menu-arrow').addClass('open');
    $('#view-assigned-lead-requests').addClass('active');

    function ApplyFilter()
    {
        var team_id = $('#received-team-filter').val();

        var redirect_url = '{{url("view-assigned-lead-requests")}}?team_id='+team_id;

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
