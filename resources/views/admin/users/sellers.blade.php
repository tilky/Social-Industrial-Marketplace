@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Seller Users</span>
        </li>
    </ul>
</div>
@if(Auth::user()->access_level == 1)
    <h3 class="page-title"> List Of Seller Users
@else
    <h3 class="page-title"> Manage Seller Users
@endif
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  Users </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th> Name </th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Account type</th>
                        @if(Auth::user()->access_level != 1)
                        <th> Action </th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr class="odd gradeX">
                        <td>{{ $user->userdetail->first_name }} {{ $user->userdetail->last_name }}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->userdetail->phone }}</td>
                        <td>{{ $user->compnayname}}</td>
                        <td>{{ $user->userdetail->account_type }}</td>
                        @if(Auth::user()->access_level != 1)
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-circle btn-success btn-sm">
                                <i class="fa fa-edit"></i>  Edit </a>
                            <a id="deleteButton" data-id="{{$user->id}}" data-toggle="modal" href="#deleteConfirmation" class="btn btn-circle btn-danger btn-sm">

                            {!! Form::open([
                            'method' => 'DELETE',
                            'id' => 'DELETE_FORM_'.$user->id,
                            'route' => ['users.destroy', $user->id]
                            ]) !!}
                            {!! Form::close() !!}
                                <i class="fa fa-remove"></i>  Delete </a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> ← Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next → </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
    /* for show menu active */
    $("#users-main-menu").addClass("active");
	$('#users-main-menu' ).click();
	$('#users-menu-arrow').addClass('open');
	$('#users-seller-menu').addClass('active');
    /* end menu active */
    
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
@endsection
