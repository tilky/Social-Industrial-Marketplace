@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url()}}/supporttickets">Support Tickets</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Create a Support Ticket</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-support color-black"></i>  Create a Support Ticket
</h3>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="col-md-12">
            <div class="portlet-body form">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- BEGIN FORM-->
                {!! Form::open([
                'route' => 'supporttickets.store',
                'class' => 'horizontal-form',
                'files' => true
                ]) !!}
                    <input type="hidden" name="user_id" value="{{$userData->user_id}}" />
                    <div class="form-body">
<h3>We're sorry that you're having problems using Indy John. </h3>
<p>Contact Indy John Support Team by creating a Support Ticket listing your issues and concerns. </p>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Ticket Title:</label>
                                    <span class="required" aria-required="true"> * </span>
                                    <input data-required="1" type="text" name="title" value="{{Request::old('title')}}" class="form-control" placeholder="Create a tagline for your issue.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Add Details</label>
                                    <span class="required" aria-required="true"> * </span>
                                    <textarea name="description"  class="form-control" rows="6" placeholder="Add any details or description that may apply">{{Request::old('description')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions text-right">
                        <a href="{{ URL::to('supporttickets') }}" class="btn btn-circle btn-danger bold">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle yellow-crusta color-black bold">
                            <i class="fa fa-check"></i>  Submit Ticket</button>
                    </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
            </div>
            </div>
</div>
</div>
<script>
/* for show menu active */
    $("#support-tickets-main-menu").addClass("active");
	$('#support-tickets-main-menu' ).click();
	$('#support-tickets-menu-arrow').addClass('open')
	$('#manage-ticket-menu').addClass('active');
    /* end menu active */
</script>
@endsection
