@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Support Tickets</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<div class="col-md-9 col-sm-9">
<div class="row">
<h3 class="page-title uppercase"> 
 <i class="fa fa-server color-black"></i>  Manage Your Support Tickets
</h3>
</div>
</div>
<div class="col-md-3 col-sm-3 text-right">
<div class="row">
 @if($user_access_level != 1)
                <div class="actions margin-top-10">
                    <a href="{{ URL::to('supporttickets/create') }}" class="btn btn-danger btn-sm">
                        <i class="fa fa-plus red"></i>  Add New</a>
                </div>
                @endif
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th> Ticket No. </th>
                        <th> Title </th>
                        <th> Description </th>
                        <!--<th> Total Comments </th>-->
                        <th> Status </th>
                        <th style="text-align:right"> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tickets as $index=>$ticket)
                    <tr class="odd gradeX">
                        <td>{{$index+1}}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>
                            {{substr($ticket->description, 0, 100)}}...
                        </td>
                        <!--<td>
                            {{count($ticket->comments)}}
                        </td>-->
                        <td>
                            @if($ticket->status == 1)
                            <span class="font-red">Closed</span>
                            @else
                            Active
                            @endif
                        </td>
                        <td>
                        <div class="page-actions">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-circle yellow-crusta" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <span class="hidden-sm hidden-xs">Actions&nbsp;</span> <i class="fa fa-angle-down"></i>  </button>
                                            <ul class="dropdown-menu" role="menu">
                                             @if($ticket->status == 0)
                            @if($user_access_level != 1)
                          <li>  <a href="{{ route('supporttickets.show', $ticket->id) }}">
                                <i class="fa fa-edit"></i>  Request more Info </a></li>
                                <li class="divider"> </li>
                            @endif
                            
                          <li>  <a href="{{url('supporttickets/ticket/status')}}/{{$ticket->id}}/1"><i class="fa fa-remove"></i>  Close</a></li>
                            @endif
                            @if($user_access_level == 1)
                            <li class="divider"> </li>
                          <li>  <a id="deleteButton" data-id="{{$ticket->id}}" data-toggle="modal" href="#deleteConfirmation">

                            {!! Form::open([
                            'method' => 'DELETE',
                            'id' => 'DELETE_FORM_'.$ticket->id,
                            'route' => ['supporttickets.destroy', $ticket->id]
                            ]) !!}
                            {!! Form::close() !!}
                                <i class="fa fa-remove"></i>  Delete </a></li>
                            @endif
                                                
                                            </ul>
                                        </div>
                                    </div>
                           
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
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
</div>
<script>
    /* for show menu active */
    $("#support-tickets-main-menu").addClass("active");
	$('#support-tickets-main-menu' ).click();
	$('#support-tickets-menu-arrow').addClass('open')
	$('#support-ticket-view-menu').addClass('active');
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
