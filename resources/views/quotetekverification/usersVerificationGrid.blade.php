@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('sa')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Quotetek Verification</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="verification-delete" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <a href="" id="verification-delete-btn" class="btn btn-circle yellow-crusta color-black">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-server color-black"></i>  Users Verification </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                
                <div class="row">
                    <div class="col-md-12">
                        @if($total > 0)
                            
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Name </th>
                                    @if(Auth::user()->access_level != 1)
                                    <th> Utility Bill </th>
                                    <th> State Id Proof </th>
                                    @endif
                                    <th> LinkedIn </th>
                                    @if(Auth::user()->access_level != 1)
                                    <th>Payment</th>                                        
                                    <th> Status </th>
                                    @endif
                                    @if(Auth::user()->access_level == 1)
                                    <th> Phone </th>
                                    <th> Email </th>
                                    <th> Action </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($quotetekVerifications as $quotetekVerification)
                                <tr class="odd gradeX">
                                    <td>{{ $quotetekVerification->user->userdetail->first_name }} {{ $quotetekVerification->user->userdetail->last_name }}</td>
                                    @if(Auth::user()->access_level != 1)
                                    <td>
                                        @if($quotetekVerification->utility_bill_path != '')<a href="{{url('/')}}/{{$quotetekVerification->utility_bill_path}}" download>{{ explode('/',$quotetekVerification->utility_bill_path)[3] }}</a> @endif
                                    </td>
                                    <td>
                                        @if($quotetekVerification->state_id_path != '')<a href="{{url('/')}}/{{$quotetekVerification->state_id_path}}" download>{{ explode('/',$quotetekVerification->state_id_path)[3] }}</a> @endif
                                    </td>
                                    @endif
                                    <td>
                                        @if($quotetekVerification->linkedin_vification == 1)
                                            Verified
                                        @else
                                            Not Verified
                                        @endif
                                    </td>
                                    @if(Auth::user()->access_level != 1)
                                    <td>
                                        @if($quotetekVerification->payment == 1)
                                            Paid
                                        @else
                                            Not Paid
                                        @endif
                                    </td>
                                    <td>
                                        @if($quotetekVerification->status == 1)
                                            Approve
                                        @elseif($quotetekVerification->status == 2)
                                            Disapprove
                                        @else
                                            pending
                                        @endif
                                    </td>
                                    @endif
                                    @if(Auth::user()->access_level == 1)
                                    <td>{{ $quotetekVerification->user->userdetail->phone }}</td>
                                    <td>{{ $quotetekVerification->user->email }}</td>
                                    <td>
            
                                        <a href="{{url('verififcation/view/user')}}/{{$quotetekVerification->id}}" class="btn btn-circle btn-success btn-sm">
                                            <i class="fa fa-edit"></i>  View </a>
                                        
                                            @if($quotetekVerification->status == 0)
                                            <a href="{{url('verififcation/approve/user')}}/{{$quotetekVerification->id}}" class="btn btn-circle btn-success btn-sm">
                                                <i class="fa fa-thumbs-o-up"></i>  Approve </a>
                                            <a href="{{ URL::to('verififcation/disapprove/user') }}/{{$quotetekVerification->id}}" class="btn btn-circle btn-danger btn-sm">
                                                <i class="fa fa-ban"></i>  Disapprove </a>
                                            @endif
                                        <a class="btn btn-circle btn-danger btn-sm" id="{{url('verififcation/destroy/user')}}/{{$quotetekVerification->id}}" onclick="showDeteleModal(id)">
                                            <i class="fa fa-remove"></i>  Suspend </a>
                                        
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                           
                        @else
                        No Verification available
                        @endif
                    </div>
                </div>
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i>  Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i>  </a>
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
$("#verification-main-menu").addClass("active");
$('#verification-main-menu' ).click();
$('#verification-menu-arrow').addClass('open');
$('#users-verification-view-menu').addClass('active');
/* end menu active */

function showDeteleModal(id)
{
    $('#verification-delete-btn').attr('href',id);
    $('#verification-delete').modal('show');
}
    
</script>
@endsection
