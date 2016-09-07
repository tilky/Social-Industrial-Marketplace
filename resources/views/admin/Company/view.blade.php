@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>
            @else
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
            @endif
        </li>
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url()}}/companies">Companies</a>
            <i class="fa fa-circle"></i>
            @else
            <span>Companies</span>
            <i class="fa fa-circle"></i>
            @endif
        </li>
        <li>
            <span>View</span>
        </li>
    </ul>
</div>
 <div class="col-md-12 main_box" >
 <div class="row">

<div class="col-md-12 border2x_bottom hide_print">
<div class="col-md-9 col-sm-9">
                <div class="row">
<h3 class="page-title uppercase"> 
@if(!empty($company))<i class="fa fa-server"></i> {{$company->name}} 
                    @else
                    View Company Details
                    @endif
</h3>
</div>
</div>
<div class="col-md-3 col-sm-3 text-right">
                <div class="row">
                <div class="actions margin-top-10">
 @if(!empty($company))
                    <a href="{{ URL::to('companies/info/') }}/{{$company->id}}" class="btn btn-circle btn-danger btn-sm">
                        <i class="fa fa-eye"></i> View Other Info </a>
                     @endif   
              

            </div>
                </div>
                </div>
</div>
</div>
 
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                @if(!empty($company))
                <div class="row">
                    <div class="col-md-2">
                        @if($company->logo != '')
                        <img src="{{url('')}}/{{$company->logo}}" width="150px" />
                        @else
                            <img src="{{url('images/placeholder_png.jpg')}}" width="150px" />
                        @endif
                    </div>
                    <div class="col-md-3">
                        @if($company->package)<p>Package : {{$company->package->name}} </p>@endif
                        <p>Name : {{$company->name}} </p>
                        <p>Email : {{$company->email}} </p>
                        <p>Owner : @if($company->owner_id != '') {{$company->owner_name}} @endif</p>
                        <p>Phone : {{$company->phone}} </p>
                        <p>Address : {{$company->address}} , {{$company->city}}, {{$company->state}}, {{$company->zip}},{{$company->country}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Description : {{$company->description}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Establishment Year : {{$company->establishment_year}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Export Start Year : {{$company->export_start_year}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Employees Count : {{$company->employees_count}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Trade Capacity : {{$company->trade_capacity}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Production Capacity : {{$company->production_capacity}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>R & D Capacity : {{ $company['r&d_capacity']}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Production Line Count : {{$company->production_line_count}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Website : <a href="{{$company->website}}">{{$company->website}}</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Customer Care Contact Name : {{$company->customer_care_contact_name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Customer Care Email : {{$company->customer_care_email}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Customer Care Phone : {{$company->customer_care_phone}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Accepted Delivery Terms : {{$company->accepted_delivery_terms}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Accepted Payment Currency : {{$company->accepted_payment_currency}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Accepted Payment Types : {{$company->accepted_payment_type}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Languages : {{$company->languages}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Average Lead Time : {{$company->average_lead_time}}</p>
                    </div>
                </div>
                @else
                    @if($reqCompanyData != '')
<p>

<h4>                        You have requested to be added to <b>{{$reqCompanyData->name}}</b> company page. Your add is pending <b>{{$reqCompanyData->name}}</b> administrator approval. </h4> <p><br><p> <p><br><p>
                    @else
                       <h4> You haven't Created or been Added to a Company Page yet. <a href="{{url('start-or-join-company')}}">Start a Company Page Now</a>. </h4><p />
                    @endif
                @endif
            </div>
        <!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<script>
/* for show menu active */
$("#compnay-main-menu").addClass("active");
$('#compnay-main-menu' ).click();
$('#conpmay-menu-arrow').addClass('open');
$('#current-company-menu').addClass('active');
/* end menu active */
</script>
@endsection
