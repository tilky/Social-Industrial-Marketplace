@extends('buyer.app')

@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url('contactusers')}}">Contact List</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Contact User Profile</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-user color-black"></i>  {{$userDetail->first_name}} {{$userDetail->last_name}} 
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        @if (Session::has('message'))
                            <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                        @endif
                        <div class="col-md-12">
                            <h3>Personal Info:</h3>
                            <p>Name: {{$userDetail->first_name}} {{$userDetail->last_name}}</p>
                            <p>E-mail: {{$user->email}}</p>
                            <p>Phone: {{$userDetail->phone}}</p>
                            <p>Company: {{$userCompany->name}}</p>
                        </div>
                        <div class="col-md-12">
                            <h3>Other Info:</h3>
                            <div class="tabbable-custom " style="padding-top: 10px;">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#tab_5_1" data-toggle="tab"> Address Information </a>
                                    </li>
                                    <li>
                                        <a href="#tab_5_2" data-toggle="tab"> Company Information </a>
                                    </li>
                                    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_5_1">
                                      <p>{{$userDetail->address1}}</p>
                                      @if($userDetail->address2 != '')<p>{{$userDetail->address2}}</p>@endif
                                      <p>{{$userDetail->city}},{{$userDetail->state}} - {{$userDetail->zip}}</p>
                                      <p>{{$userDetail->country}}</p>
                                    </div>
                                    <div class="tab-pane" id="tab_5_2">
                                        <h3>{{$userCompany->name}}</h3>
                                        <p>Phone: {{$userCompany->phone}}</p>
                                        <p>email: {{$userCompany->email}}</p>
                                        <h3>Company Address:</h3>
                                        <p>{{$userCompany->address}}</p>
                                        <p>{{$userCompany->city}},{{$userCompany->state}} - {{$userCompany->zip}}</p>
                                        <p>{{$userCompany->country}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
$('#contact-list-view-menu').addClass('active');
/* end menu active */

</script>
@endsection
