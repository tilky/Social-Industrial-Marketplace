@extends('buyer.app')

@section('content')
<style>
.modal-dialog{margin: 0 auto!important;width: auto!important;}
</style>
<!--<link href="{{URL::asset('metronic/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Invite Join</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12 blockui_sample_1_portlet_body">
        <!-- responsive -->
        <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add an optional message</h4>
            </div>
            <form action="{{url('contact/invite/message')}}" method="post" class="horizontal-form">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="invite_id" value="" id="invite-user-id" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">message:</label>
                            <div class="">
                                <textarea name="message" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle default" data-dismiss="modal">Close</button>
                    <button type="submite" class="btn btn-circle blue">Send</button>
                </div>
            </form>
        </div>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>Manage Invite Join 
                    
                </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                @if(count($savedContacts) > 0)
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($savedContacts as $savedContact)
                        <tr>
                            <td>{{$savedContact->name}}</td>
                            <td>{{$savedContact->email}}</td>
                            <td>{{$savedContact->phone}}</td>
                            <td>{{$savedContact->company}}</td>
                            <td class="no-sort">
                                <a href="{{url('contact/invite/send')}}/{{$savedContact->id}}?pedingInvite=2" class="btn btn-circle btn-success btn-sm">
                                    <i class="fa fa-user-plus"></i> Invite</a>
                                <a href="javascript:void(0)" id="{{ $savedContact->id }}" onclick="showModal(id)" class="btn btn-circle btn-success btn-sm">
                                    <i class="fa fa-envelope"></i> Add an optional message</a>
                                <a href="{{url('contact/invite/remove')}}/{{$savedContact->id}}?pedingInvite=2" class="btn btn-circle btn-danger btn-sm">
                                    <i class="fa fa-remove"></i> Remove </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="col-md-12">
                    <p>No Saved Contact</p>
                </div>
                @endif
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i> Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i> </a>
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
$("#contact-list-main-menu").addClass("active");
$('#contact-list-main-menu' ).click();
$('#contact-list-menu-arrow').addClass('open')
$('#contact-invite-join-menu').addClass('active');
/* end menu active */
function showModal(id)
{
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    $('#invite-user-id').val(id);
    $('#responsive').modal('show');
    App.unblockUI('#blockui_sample_1_portlet_body');
}
</script>
<!--<script src="{{URL::asset('metronic/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>-->
@endsection
