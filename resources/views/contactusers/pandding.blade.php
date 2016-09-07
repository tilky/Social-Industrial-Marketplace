@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('contactusers')}}">Contact List</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Pandding Request List</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-server color-black"></i>Pending Connections</div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        @if(!empty($panddingConatcList))
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="search-result-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($panddingConatcList as $contactReq)
                                        <tr>
                                            <td>{{$contactReq['sender_user_name']}}</td>
                                            <td>{{$contactReq['sender_user_company_name']}}</td>
                                            <td>{{$contactReq['sender_user_city']}}</td>
                                            <td>{{$contactReq['sender_user_country']}}</td>
                                            <td class="no-sort">
                                                <a href="{{url('contactusers/contact/approve')}}/{{$contactReq['id']}}" class="btn btn-circle blue ">
                                                    <i class="fa fa-thumbs-o-up"></i> Approve Request </a>
                                                <a id="deleteButton" data-id="{{$contactReq['id']}}" data-toggle="modal" href="#deleteConfirmation" class="btn btn-circle btn-danger btn-sm">

                                                {!! Form::open([
                                                'method' => 'DELETE',
                                                'id' => 'DELETE_FORM_'.$contactReq['id'],
                                                'route' => ['contactusers.destroy', $contactReq['id']]
                                                ]) !!}
                                                {!! Form::close() !!}
                                                    <i class="fa fa-remove"></i> Delete </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="col-md-12">No result found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
    /* for show menu active */
    $("#contact-list-main-menu").addClass("active");
	$('#contact-list-main-menu' ).click();
	$('#contact-list-menu-arrow').addClass('open')
	$('#contact-list-pandding-menu').addClass('active');
    /* end menu active */
    $(document).ready(function() {
        $('#search-result-table').DataTable({
            columnDefs: [
              { targets: 'no-sort', orderable: false }
            ]
        });
    });
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
<script src="{{URL::asset('metronic/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection
