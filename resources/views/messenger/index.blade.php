@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/apps/css/inbox.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Messaging Hub</span>
        </li>
    </ul>
</div>

<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> Messaging Hub
</h3>
</div>
</div>
<div class="row">
        <div class="col-md-12 padding-top paddin-bottom">
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="inbox">
                <div class="row">
                    <div class="col-md-2">
                        <div class="inbox-sidebar">
                            <a href="{{ URL::to('messages/create') }}" data-title="Compose" class="btn btn-danger compose-btn btn-circle btn-block">
                                <i class="fa fa-edit"></i> Compose </a>
                            <ul class="inbox-nav">
                                <li class="active">
                                    <a href="{{url('messages')}}" data-type="inbox" data-title="Inbox"> Inbox
                                        <span class="badge badge-success">{{Auth::user()->newMessagesCount()}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('message/sent')}}" data-type="sent" data-title="Sent"> Sent </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="inbox-body">
                            <div class="inbox-header">
                                <h1 class="pull-left">Inbox</h1>
                            </div>
                            <div class="inbox-content">
                                <table class="table table-striped table-bordered table-hover dt-responsive table-advance" width="100%" id="search-result-table">
                                    <thead>
                                        <tr>
                                            <th class="no-sort">&nbsp;</th>
                                            <th style="text-align:left !important;">Subject</th>
                                            <th>Last Message</th>
                                            <th>Started By</th>
                                            <th>Participants</th>
                                            <th class="no-sort">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($threads as $thread)
                                        <?php 
                                            $class = $thread->isUnread($currentUserId) ? 'alert-info unread' : '';
                                            $starclass = $thread->isUnread($currentUserId) ? 'inbox-started' : ''; 
                                        ?>
                                        
                                        <tr class="media alert {!!$class!!}">
                                            <td class="no-sort"><i class="fa fa-star @if($starclass != '') inbox-started @endif"></i></td>
                                            <td class="text-left"><a class="color-black" href="{{url()}}/messages/{{$thread->id}}">@if($class != '') <i class="fa fa-envelope-square"></i>@else <i class="fa fa-envelope-o"></i>@endif {{ $thread->subject}}</a></td>
                                            <td>{!! substr($thread->latestMessage->body,0,100) !!}</td>
                                            <td>{!! $thread->creator()->name !!}</td>
                                            <td>{!! $thread->participantsString(Auth::user()->id) !!}</td>
                                            <td class="no-sort">
                                            
                <div class="btn-group">
                  <button type="button" class="btn btn-circle yellow-crusta" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <span class="hidden-sm hidden-xs">Actions&nbsp;</span> <i class="fa fa-angle-down"></i> </button>
                  <ul class="dropdown-menu" role="menu">
                    <li> <a href="{{url()}}/messages/{{$thread->id}}">
                                                    <i class="fa fa-eye"></i> View</a> </li>
                    <li class="divider"> </li>
                    <li> <a id="deleteButton" style="margin-top:5px;" data-id="{{$thread->id}}" data-toggle="modal" href="#deleteConfirmation">
        
                                                    {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'id' => 'DELETE_FORM_'.$thread->id,
                                                    ]) !!}
                                                    <input type="hidden" name="delete_id" value="{{$thread->id}}" />
                                                    {!! Form::close() !!}
                                                        <i class="fa fa-remove"></i> Delete </a> </li>
                   
                  </ul>
                
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
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
</div>
</div>
<script>
    /* for show menu active */
    $("#contact-list-main-menu").addClass("active");

	$('#contact-list-main-menu' ).click();
    $('#contact-list-menu-arrow').addClass('open')
    $('#message-list-view-menu').addClass('active');
    /* end menu active */
    $(document).ready(function() {
        $('#search-result-table').DataTable({
            columnDefs: [
              { targets: 'no-sort', orderable: false }
            ],
            "order": [[ 0, "desc" ]]
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
                window.location.href = "{{url()}}/message/delete/"+jQuery('#deleteConfirmation .modal-body #objectId').val();
                //console.log(jQuery('#deleteConfirmation .modal-body #objectId').val());
                //$( "#DELETE_FORM_" + jQuery('#deleteConfirmation .modal-body #objectId').val() ).submit();
                
            }
        });
    });
</script>
<script src="{{URL::asset('metronic/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection
