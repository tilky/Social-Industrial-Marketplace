@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url('sa')}}">Home</a>
            <i class="fa fa-circle"></i>  
            @else
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
            @endif
        </li>
        <li>
            @if(Auth::user()->access_level == 1)
            <span>Quotetek Verification Requests</span>
            @else
            <span>Quotetek Verification</span>
            @endif
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-server color-black"></i>  Quotetek Verification </div>
                @if(Auth::user()->access_level != 1)
                    @if($total == 0)
                    <div class="actions">
                        <a href="{{ URL::to('quotetekverification/create') }}" class="btn btn-circle btn-sm">
                            <i class="fa fa-plus"></i>  Add </a>
                    </div>
                    @endif                
                @endif
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                
                <div class="row">
                    <div class="col-md-12">
                        @if($total > 0)
                            @if(Auth::user()->access_level == 1)
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Apply As </th>
                                        <th> LinkedIn </th>
                                        <th> Facebook </th>
                                        <th> Driving License </th>
                                        <th> Status </th>
                                        @if(Auth::user()->access_level == 1)
                                        <th> Action </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($quotetekVerifications as $quotetekVerification)
                                    <tr class="odd gradeX">
                                        <td>{{ $quotetekVerification->apply }}</td>
                                        <td>
                                            {{ $quotetekVerification->linkedin_link }}
                                        </td>
                                        <td>
                                            {{ $quotetekVerification->facebook_link }}
                                        </td>
                                        <td>
                                            {{ $quotetekVerification->driving_license }}
                                        </td>
                                        <td>
                                            @if($quotetekVerification->is_active == 1)
                                                Approve
                                            @elseif($quotetekVerification->is_active == 2)
                                                Disapprove
                                            @else
                                                pending
                                            @endif
                                        </td>
                                        @if(Auth::user()->access_level == 1)
                                        <td>
                
                                            <a href="{{ route('quotetekverification.show', $quotetekVerification->id) }}" class="btn btn-circle btn-success btn-sm">
                                                <i class="fa fa-edit"></i>  View </a>
                                            
                                                @if($quotetekVerification->is_active == 0)
                                                <a href="{{url('quotetekverify/approve')}}/{{$quotetekVerification->id}}" class="btn btn-circle btn-success btn-sm">
                                                    <i class="fa fa-thumbs-o-up"></i>  Approve </a>
                                                <a href="{{ URL::to('quotetekverify/disapprove') }}/{{$quotetekVerification->id}}" class="btn btn-circle btn-danger btn-sm">
                                                    <i class="fa fa-ban"></i>  Disapprove </a>
                                                @endif
                                            
                                            <!--<a href="{{ route('quotetekverification.edit', $quotetekVerification->id) }}" class="btn btn-circle btn-success btn-sm">
                                                <i class="fa fa-edit"></i>  Edit </a>-->
                                            <a id="deleteButton" data-id="{{$quotetekVerification->id}}" data-toggle="modal" href="#deleteConfirmation" class="btn btn-circle btn-danger btn-sm">
                
                                            {!! Form::open([
                                            'method' => 'DELETE',
                                            'id' => 'DELETE_FORM_'.$quotetekVerification->id,
                                            'route' => ['quotetekverification.destroy', $quotetekVerification->id]
                                            ]) !!}
                                            {!! Form::close() !!}
                                                <i class="fa fa-remove"></i>  Suspend </a>
                                            
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                @foreach ($quotetekVerifications as $quotetekVerification)
                                    @if($quotetekVerification->is_active == 1)
                                        Your Verification Approved.
                                    @elseif($quotetekVerification->is_active == 2)
                                        Your Verification Disapproved. Please Send again <a href="{{ URL::to('quotetekverification/create') }}" class="btn btn-circle btn-sm">
                            <i class="fa fa-plus"></i>  Add New</a>
                                    @else
                                        Your verification request is received and pending, we will contact you if any further information is needed.
                                    @endif
                                @endforeach                            
                            @endif
                        @else
                        No Verification available
                        @endif
                    </div>
                </div>
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
    $("#verification-main-menu").addClass("active");
	$('#verification-main-menu' ).click();
	$('#verification-menu-arrow').addClass('open');
	$('#quotetekverification-view-menu').addClass('active');
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
