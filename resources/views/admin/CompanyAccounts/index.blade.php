@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="javascript:;">Companies</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Packages</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> Manage Company Accounts
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  Accounts </div>
                <div class="actions">
                    <a href="{{ URL::to('company-packages/create') }}" class="btn btn-circle btn-sm">
                        <i class="fa fa-plus"></i>  Add </a>
                </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th> Name </th>
                        <th> Max Licenses </th>
                        <th> Max Photos </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($accounts as $account)
                    <tr class="odd gradeX">
                        <td>{{ $account->name }}</td>
                        <td>
                            {{ $account->number_of_licenses_allowed }}
                        </td>
                        <td>
                            {{$account->photos_allowed}}
                        </td>
                        <td>


                            <a href="{{ route('company-packages.edit', $account->id) }}" class="btn btn-circle btn-success btn-sm">
                                <i class="fa fa-edit"></i>  Edit </a>
                            <a id="deleteButton" data-id="{{$account->id}}" data-toggle="modal" href="#deleteConfirmation" class="btn btn-circle btn-danger btn-sm">

                            {!! Form::open([
                            'method' => 'DELETE',
                            'id' => 'DELETE_FORM_'.$account->id,
                            'route' => ['company-packages.destroy', $account->id]
                            ]) !!}
                            {!! Form::close() !!}
                                <i class="fa fa-remove"></i>  Delete </a>
                        </td>
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
