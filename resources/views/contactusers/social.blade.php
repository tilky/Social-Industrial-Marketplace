@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/socicon/socicon.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url()}}/contactusers">Contact List</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Contact</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-plus color-black"></i>Add {{$type}} Contact</div>
            </div>

            <div class="portlet-body form">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                
                
                <div class="row">
                    <div class="col-md-12">
                @if(!empty($searchContac))
                
                    <div class="col-md-12" style="padding-top: 20px;">
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
                                @foreach($searchContac as $contact)
                                <tr>
                                    <td>{{$contact['req_user_name']}}</td>
                                    <td>{{$contact['req_user_company_name']}}</td>
                                    <td>{{$contact['req_user_city']}}</td>
                                    <td>{{$contact['req_user_country']}}</td>
                                    <td class="no-sort">
                                        @if($contact['common_req'] == 1)
                                            <a href="{{url('contactusers/contact/approve')}}/{{$contact['id']}}" class="btn btn-circle blue ">
                                                <i class="fa fa-thumbs-o-up"></i> Approve Request </a>
                                            <a id="deleteButton" data-id="{{$contact['id']}}" data-toggle="modal" href="#deleteConfirmation" class="btn btn-circle btn-danger btn-sm">

                                                {!! Form::open([
                                                'method' => 'DELETE',
                                                'id' => 'DELETE_FORM_'.$contact['id'],
                                                'route' => ['contactusers.destroy', $contact['id']]
                                                ]) !!}
                                                {!! Form::close() !!}
                                                    <i class="fa fa-remove"></i> Delete </a>
                                        @else
                                        <a href="{{url('contactusers/contact/send')}}/{{$userData->user_id}}/{{$contact['req_user_id']}}" class="btn btn-circle btn-success btn-sm">
                                            <i class="fa fa-paper-plane"></i> Send Request </a>
                                        @endif
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
    </div>
</div>
<script>
    /* for show menu active */
    $("#contact-list-main-menu").addClass("active");
	$('#contact-list-main-menu' ).click();
	$('#contact-list-menu-arrow').addClass('open')
	$('#contact-list-create-menu').addClass('active');
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
