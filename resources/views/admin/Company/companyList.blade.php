@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="javascript:;">Companies</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Manage Companies</span>
        </li>
    </ul>
</div>
<div class="page-head">
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
        <h1>List All Companies</h1>
    </div>
    <!-- END PAGE TITLE -->
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  Companies </div>
                <div class="actions">
                    <a href="{{ URL::to('companies/create') }}" class="btn btn-circle btn-sm">
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
                        <th> Package </th>
                        <th> Email </th>
                        <th> Phone </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($companies as $company)
                    <tr class="odd gradeX">
                        <td>{{ $company->name }}</td>
                        <td>
                            @if($company->package){{ $company->package->name }}@endif
                        </td>
                        <td>
                            {{ $company->email }}
                        </td>
                        <td>
                            {{ $company->phone }}
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

    /* for show menu active */
    $("#compnay-main-menu").addClass("active");
    $('#compnay-main-menu' ).click();
    $('#conpmay-menu-arrow').addClass('open');
    $('#all-compnay-menu').addClass('active');
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
