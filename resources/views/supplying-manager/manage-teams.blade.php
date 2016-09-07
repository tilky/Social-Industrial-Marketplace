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
            <div class="col-md-10 col-sm-10">
                <div class="row">
                    <h3 class="page-title uppercase"> <i class="fa fa-exchange color-black"> </i> MANAGE TEAMS </h3>
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
                <div class="dataTables_length pull-right" id="example1_length"><label><select name="example1_length" aria-controls="example1" class="form-control input-sm input-xsmall input-inline"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> Results</label></div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                        <thead>
                            <tr>
                                <th>Name of Team</th>
                                <th>Team ID</th>
                                <th>Member Count</th>
                                <th>Date Created</th>
                                <th>Date Last Active</th>
                                <th class="no-sort" data-orderable="false"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allSupplierTeam as $team)
                            <tr>
                                <td>{{ $team['nameOfTeam'] }}</td>
                                <td>{{ $team['teamId'] }}</td>
                                <td>{{ $team['memberCount'] }}</td>
                                <td>{{ $team['dateCreated'] }}</td>
                                <td>{{ $team['dateLastActive'] }}</td>
                                <td class="no-sort">
                                    <div class="page-actions">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-circle yellow-crusta" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <span class="hidden-sm hidden-xs">Actions&nbsp;</span> <i class="fa fa-angle-down"></i> </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li> <a href="{{url('/edit-supplying-team')}}/{{$team['id']}}" target="_blank"> <i class="fa fa-eye"></i> Edit Team Details </a> </li>
                                                <li class="divider"> </li>
                                                <li> <a href="{{url('/manage-supplying-team-members')}}?team_id={{$team['id']}}" target="_blank"> <i class="fa fa-envelope"></i> Manage Members </a> </li>
                                                <li class="divider"> </li>
                                                <li> <a href="{{url('/edit-supplying-team')}}/{{$team['id']}}#tab2" target="_blank"> <i class="fa fa-envelope"></i> Invite New Members </a> </li>
                                                <li class="divider"> </li>
                                                <li> <a href="{{url('/message-supplying-team')}}?team_id={{$team['id']}}" target="_blank"> <i class="fa fa-envelope"></i> Message Team </a> </li>
                                                <li class="divider"> </li>
                                                <li>
                                                    <a id="deleteButton" data-id="{{$team['id']}}" data-toggle="modal" href="#deleteConfirmation">
                                                        {!! Form::open([
                                                            'method'=>'DELETE',
                                                            'id' => 'DELETE_FORM_'.$team['id'],
                                                            'route'=>['supplierManager.destroy',$team['id']]]) !!}
                                                        {!! Form::close() !!}
                                                        <i class="fa fa-remove"></i> Suspend Team
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<script>
    $("#team-manager-supplying").addClass("active");
    $('#team-manager-supplying-menu-arrow').addClass('open');
    $('#manage-supplying-teams').addClass('active');
    
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
