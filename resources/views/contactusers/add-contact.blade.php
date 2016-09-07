@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url('contactusers')}}">Contact Users</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Add New Contact</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-envelope color-black"></i>  Add Contact</div>
            </div>

            <div class="portlet-body form">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                                
                <!-- BEGIN FORM-->
                
                <form method="post" action="{{url('contact/add/save')}}" class="horizontal-form form-horizontal">
                <input type="hidden" name="user_id" value="{{$userData->user_id}}" />
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <div class="form-body">
                    <div class="form-group">
                        <label class="col-md-12">Name:</label>
                        <div class="col-md-12">
                            <input type="text" name="name" class="form-control" value="{{Request::old('name')}}" placeholder="Invite Name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Email:</label>
                        <div class="col-md-12">
                            <input type="email" name="email" class="form-control" value="{{Request::old('email')}}" placeholder="Invite email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Phone:</label>
                        <div class="col-md-12">
                            <input type="text" name="phone" class="form-control" value="{{Request::old('phone')}}" placeholder="Phone"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Company:</label>
                        <div class="col-md-12">
                            <input type="text" name="company" class="form-control" value="{{Request::old('company')}}" placeholder="Company Name"/>
                        </div>
                    </div>
                </div>
                <div class="form-actions right">
                    <a href="{{ URL::to('contactusers') }}" class="btn btn-circle btn-sm">
                        Cancel </a>
                    <button type="submit" class="btn btn-circle blue">
                        <i class="fa fa-check"></i>  Send</button>
                </div>
                
                </form>
                <!-- END FORM-->  
            </div>
        </div>
    </div>
</div>
<script>
/* for show menu active */
$("#contact-list-main-menu").addClass("active");
$('#contact-list-main-menu' ).click();
$('#contact-list-menu-arrow').addClass('open')
$('#contact-list-create-menu').addClass('active');
/* end menu active */
</script>
@endsection
