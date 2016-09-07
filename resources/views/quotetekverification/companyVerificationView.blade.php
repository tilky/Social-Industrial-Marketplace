@extends('company.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Quotetek Verification</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-server color-black"></i>  Quotetek Verification </div>
                @if($companyVerififcation != '')
                    @if($companyVerififcation->status == 2)
                        <div class="actions">
                            <a href="{{ URL::to('quotetek/user/vrification') }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-plus"></i>  Add </a>
                        </div>
                    @endif
                @else
                    <div class="actions">
                        <a href="{{ URL::to('quotetek/user/vrification') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-plus"></i>  Add </a>
                    </div>
                @endif
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                
                <div class="row">
                    <div class="col-md-12">
                        @if($companyVerififcation != '')
                            @if($companyVerififcation->status == 1)
                                Your Verification Approved.
                            @elseif($companyVerififcation->status == 2)
                                Your Verification Disapproved. Please Send again 
                                <a href="{{ URL::to('quotetek/company/vrification') }}" class="btn btn-circle btn-sm"><i class="fa fa-plus"></i>  Add New</a>
                            @else
                                Your verification request is received and pending, we will contact you if any further information is needed.
                            @endif
                        @else
                            Please Send Verification request <a href="{{ URL::to('quotetek/company/vrification') }}" class="btn btn-circle btn-sm"><i class="fa fa-plus"></i>  Add New</a>
                        @endif
                    </div>
                </div>
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
</script>
@endsection
