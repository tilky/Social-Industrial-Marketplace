@extends('admin.app')

@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>List all Feedbacks</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> List all Feedbacks left
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  List all Feedbacks left   </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th> Sender Name </th>
                        <th> Receiver Name </th>
                        <th> Company Name </th>
                        <th> Comment </th>
                        <th> Status </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($feedbacks as $feedback)
                    <tr class="odd gradeX">
                        <td>{{ $feedback->sendername }}</td>
                        <td>{{ $feedback->receivername}}</td>
                        <td>{{ $feedback->companyname}}</td>
                        <td>{{ $feedback->comment }}</td>
                        <td>{{ $feedback->status }}</td>
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
    $("#feedBack-main-menu").addClass("active");
    $('#feedBack-main-menu' ).click();
    $('#feedBack-menu-arrow').addClass('open');
    $('#feedBack-list-menu').addClass('active');
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
