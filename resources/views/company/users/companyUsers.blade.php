@extends('buyer.app')

@section('content')
<style>
.nav-tabs{max-width: 100%!important;}
</style>
<link href="{{URL::asset('metronic/plugins/socicon/socicon.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Contact List</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
    <div class="col-md-12 border2x_bottom" id="form_wizard_1">
                <div class="col-md-10 col-sm-10">
                <div class="row">
                  <h3 class="page-title uppercase"> 
<i class="fa fa-exchange color-black"> </i> COMPANY USERS MANAGER
</h3>
</div>
</div>
                    
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
    <div class="portlet light ">
                                 @if (Session::has('message'))
            <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
        @endif
                                <div class="portlet-body">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs">
                                        <li class="active padding-right-20">
                                            <h4 class="bold uppercase"><a class="color-black" href="#tab_1_1" data-toggle="tab"> Current Users </a></h4>
                                        </li>
                                        <li class="padding-right-20">
                                            <h4 class="bold uppercase"><a class="color-black" href="#tab_1_2" data-toggle="tab"> Pending Users </a></h4>
                                        </li>
                                        
                                    </ul>
                                    <div class="tab-content">
                                        <!-- Current Users -->
                                        <div class="tab-pane fade active in" id="tab_1_1">
                                           
                                            @if(count($connectedUsers) > 0)
                                                <h3>Current Users</h3>
                                                
                                                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="example">
                                                        <thead>
                                                            <tr>
                                                                <th> Sr. No. </th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th class="no-sort" data-orderable="false"> Action </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($connectedUsers as $index=>$connectedUser)
                                                            <tr>
                                                                <td>{{$index+1}}</td>
                                                                <td>{{$connectedUser->user->userdetail->first_name}} {{$connectedUser->user->userdetail->last_name}}</td>
                                                                <td>{{$connectedUser->user->email}}</td>
                                                                <td>{{$connectedUser->user->userdetail->phone}}</td>
                                                                <td class="no-sort">
                                                                    <a href="{{url('home/user/profile')}}/{{$connectedUser->user->id}}" target="_blank" class="btn btn-circle btn-success btn-sm">
                                                                        <i class="fa fa-eye"></i> View </a>
                                                                    <a href="{{url('messages/create')}}?buyer={{$connectedUser->user->id}}" target="_blank" class="btn btn-circle btn-success btn-sm">
                                                                        <i class="fa fa-envelope"></i> Message </a>
                                                                    <a id="deleteButton" data-id="{{url('company/user/remove')}}/{{$connectedUser->id}}" data-toggle="modal" href="#deleteConfirmation" class="btn btn-circle btn-danger btn-sm">
                                                                        <i class="fa fa-remove"></i> Remove </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                
                                                @else
                                                    <p>There were no Connections.</p>
                                                @endif
                                            </div>
                                            <!-- Pending Connections -->
                                            <div class="tab-pane fade" id="tab_1_2">
                                                @if(count($penddingUsers) > 0)
                                                    <h3>Pending Users</h3>
                                                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="example1">
                                                            <thead>
                                                                <tr>
                                                                    <th> Sr. No. </th>
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th>Phone</th>
                                                                    <th class="no-sort" data-orderable="false"> Action </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($penddingUsers as $index=>$penddingUser)
                                                                <tr>
                                                                    <td>{{$index+1}}</td>
                                                                    <td>{{$penddingUser->user->userdetail->first_name}} {{$penddingUser->user->userdetail->last_name}}</td>
                                                                    <td>{{$penddingUser->user->email}}</td>
                                                                    <td>{{$penddingUser->user->userdetail->phone}}</td>
                                                                    <td class="no-sort">
                                                                        <a href="{{url('company/user/accept')}}/{{$penddingUser->id}}" class="btn btn-circle yellow-crusta color-black "><i class="fa fa-thumbs-o-up"></i> Accept Request </a>
                                                                        <a id="deleteButton" data-id="{{url('company/user/reject')}}/{{$penddingUser->id}}" data-toggle="modal" href="#deleteConfirmation" class="btn btn-circle btn-danger btn-sm">
                                                                            <i class="fa fa-remove"></i> Disapprove </a>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                @else
                                                    <p>There were no Pending User.</p>
                                                @endif
                                            </div>
                                            
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
    /* for show menu active */


$("#admin-company-main-menu").addClass("active");
$('#admin-company-main-menu' ).click();
$('#admin-conpmay-menu-arrow').addClass('open');
$('#users-company-menu').addClass('active');
/* end menu active */
    
    $(document).on("click", "#deleteButton", function () {
        var id = $(this).data('id');
        jQuery('#deleteConfirmation .modal-body #objectId').val( id );
    });

    jQuery('#deleteConfirmation .modal-footer button').on('click', function (e) {
        var $target = $(e.target); // Clicked button element
        $(this).closest('.modal').on('hidden.bs.modal', function () {
            if($target[0].id == 'confirmDelete'){
                window.location.href = jQuery('#deleteConfirmation .modal-body #objectId').val();
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
