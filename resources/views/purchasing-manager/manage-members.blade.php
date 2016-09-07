@extends('buyer.app')

@section('content')
<style>
.nav-tabs{max-width: 100%!important;}
#example_wrapper .col-md-6{ float:right;}
#example_wrapper .col-md-6 .dataTables_length{ float:right;}
#example_wrapper .col-md-6 + .col-md-6{ display:none !important;}
</style>
<link href="{{URL::asset('metronic/plugins/socicon/socicon.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Contact List</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom" id="form_wizard_1">
      <div class="col-md-9 col-sm-9">
        <div class="row">
          <h3 class="page-title uppercase"> <i class="fa fa-exchange color-black"> </i> Manage Team Members </h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-3">
        <div class="row">
            <div class="actions margin-top-15">
                <select class="form-control" id="received-team-filter" onchange="ApplyFilter();">
                    <option value="">Select Team to View Members</option>
                    @foreach($allBuyerTeam as $team)
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
      <div class="portlet light ">
        @if (Session::has('message'))
        <div id="" class="custom-alerts alert alert-success fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
          {{ Session::get('message') }}
        </div>
        @endif

        <div class="portlet-body">
          <!-- Current Users -->
          <h3>Manage Team Members:</h3>
          <div class="dataTables_length pull-right" id="example1_length"><label><select name="example1_length" aria-controls="example1" class="form-control input-sm input-xsmall input-inline"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> Results</label></div>
          <table class="table table-striped table-bordered table-hover table-checkable order-column" >
            <thead>
              <tr>
                <th>Team Name</th>
                <th>Member Name</th>
                <th>Member Since</th>
                <th>Status </th>
                <th>Region</th>
                <th>Account-Type</th>
                <th class="no-sort" data-orderable="false"> Action </th>
              </tr>
            </thead>
            <tbody>
            @if(count($buyerTeamArray) > 0)
                @foreach($buyerTeamArray as $member)
                    <tr>
                        <td>{{ $member['teamName'] }}</td>
                        <td>{{ $member['memberName'] }}</td>
                        <td>{{ $member['memberSince'] }}</td>
                        @if($member['status'] == 1)
                        <td>Active</td>
                        @else
                        <td>Inactive</td>
                        @endif
                        <td>{{ $member['region'] }}</td>
                        @if($member['accountType'] != null)
                        <td>{{ $member['accountType'] }}</td>
                        @else
                        <td> </td>
                        @endif
                        <td class="no-sort">
                            <div class="page-actions">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-circle yellow-crusta" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <span class="hidden-sm hidden-xs">Actions&nbsp;</span> <i class="fa fa-angle-down"></i> </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>

                                            @if($member['is_connected'] == false)
                                            <a href="{{url('contactusers/contact/send')}}/{{Auth::user()->id}}/{{$member['userId']}}">

                                                <i class="fa fa-user-plus"></i> Request To Connect</a>
                                            @else
                                            <a href="#contact_seller" id="{{$member['userId']}}" onclick='setReceiver(id)' data-toggle="modal" data-target="#contact_seller">

                                            <i class="fa fa-eye"></i> Send Private Message</a>
                                            @endif

                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            <a id="deleteButton" data-id="{{$member['userId']}}" data-toggle="modal" href="#deleteConfirmation">
                                                {!! Form::open([
                                                'method'=>'DELETE',
                                                'id' => 'DELETE_FORM_'.$member['userId'],
                                                'route'=>['purchasingTeam.destroy',$member['userId']]]) !!}
                                                {!! Form::close() !!}
                                                <i class="fa fa-remove"></i> Remove from Team
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
            <tr>
                <td colspan="7">No Team Members found</td>
            </tr>
            @endif
            </tbody>
          </table>
          <div class="col-md-12 margin-top-15 margin-bottom-15 text-right">
              <div class="row" id="addNewMembers">

              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>

<script>
    $("#team-manager-purchasing").addClass("active");
    $('#team-manager-purchasing-menu-arrow').addClass('open');
    $('#manage-purchasing-team-members').addClass('active');

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
        var team_id = $('#received-team-filter').val();

        var redirect_url = '{{url("manage-purchasing-team-members")}}?team_id='+team_id;

        window.location.href = redirect_url;
    }

    jQuery(document).ready(function () {
        var team_id = $('#received-team-filter').val();
        if(team_id)
        {
            var redirectUrl = '{{url("edit-purchasing-team/")}}/'+team_id+'#tab2';
            $("#addNewMembers").html('<a href='+redirectUrl+' class="btn btn-danger" target="_blank" >Add New Members</a>');
        }

    });

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

<script type="text/javascript">

$(function() {
    $("#example").dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true,
        "order": [ 0, 'asc' ],
        "language": {
            "lengthMenu": "_MENU_ Results",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing _START_ to _END_ of _TOTAL_ Results",
            "infoEmpty": "No resilt available",
            "infoFiltered": "(filtered from _MAX_ total results)"
        }
    });
    
});
$(function() {
    $("#example1").dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true,
        "order": [ 0, 'asc' ],
        "language": {
            "lengthMenu": "_MENU_ Results",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing _START_ to _END_ of _TOTAL_ Results",
            "infoEmpty": "No resilt available",
            "infoFiltered": "(filtered from _MAX_ total results)"
        }
    });
    
});
</script>

<script src="{{URL::asset('metronic/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection 
