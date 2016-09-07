@extends('buyer.app')

@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url()}}/quotes">Quotes</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>View</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  Quote Create by {{$userData->first_name}} {{$userData->last_name}} 
                </div>
                @if($user_access_level == 3)
                <div class="actions">
                    <a href="{{ URL::to('supplier-quotes/create') }}/{{$userData->id}}" class="btn btn-circle btn-sm">
                        <i class="fa fa-plus"></i>  Submit Detail </a>
                    <a href="{{ URL::to('supplier/quote/ignore') }}/{{$current_user_id}}/{{$quotes->id}}" class="btn btn-circle btn-sm">
                        <i class="fa fa-ban"></i>  Ignore </a>
                </div>
                @endif
            </div>
            <div class="portlet-body form">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h1 style="margin-top: 0px;">{{$quotes->title}}</h1>
                            <div style="padding: 5px 0px 20px;">
                                {{$quotes->specifications}}
                            </div>
                            <p>Expiration Date: {{$quotes->expiry_date}}</p>
                            <p>Request Area: {{$quotes->request_area}}</p>
                            <p>Privacy: {{$quotes->privacy}}</p>
                            <p>Additional File: @if($quotes->additional_file != '')<a href="{{url()}}/{{$quotes->additional_file}}" download>Download File</a>@endif</p>
                            <p>Accreditations: 
                                @foreach($quotes->accreditations as $index=>$accreditation)
                                    @if($index == 0)
                                    {{$accreditation->accreditation->name}}
                                    @else
                                    ,{{$accreditation->accreditation->name}}
                                    @endif
                                @endforeach
                            </p>
                            <p>Diversity Options: 
                                @foreach($quotes->devirsities as $index=>$devirsitie)
                                    @if($index == 0)
                                    {{$devirsitie->diversity->name}}
                                    @else
                                    ,{{$devirsitie->diversity->name}}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <div class="col-md-12">
                            <div class="tabbable-custom " style="padding-top: 10px;">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#tab_5_1" data-toggle="tab"> Quote Type </a>
                                    </li>
                                    <li>
                                        <a href="#tab_5_2" data-toggle="tab"> Quote Additional Data</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_5_1">
                                        <table class="data-table" id="product-attribute-specs-table">
                                            <tr>
                                                <th class="lb-val">Purchase Order</th>
                                                <td class="data-val">
                                                    @foreach($quotes->purchases as $index=>$purchase)
                                                        @if($index == 0)
                                                        {{$purchase->purchase->name}}
                                                        @else
                                                        ,{{$purchase->purchase->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="lb-val">Service Order</th>
                                                <td class="data-val">
                                                    @foreach($quotes->services as $index=>$service)
                                                        @if($index == 0)
                                                        {{$service->service->name}}
                                                        @else
                                                        ,{{$service->service->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="lb-val">Rent/Lease Order</th>
                                                <td class="data-val">
                                                    @foreach($quotes->rentleases as $index=>$rentlease)
                                                        @if($index == 0)
                                                        {{$rentlease->rentlease->name}}
                                                        @else
                                                        ,{{$rentlease->rentlease->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                    <div class="tab-pane" id="tab_5_2">
                                        <table class="data-table" id="product-attribute-specs-table">
                                            <tr>
                                                <th class="lb-val">Products</th>
                                                <td class="data-val">
                                                    @foreach($quotes->products as $index=>$product)
                                                        @if($index == 0)
                                                        {{$product->product->name}}
                                                        @else
                                                        ,{{$product->product->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="lb-val">Categories</th>
                                                <td class="data-val">
                                                    @foreach($quotes->categories as $index=>$category)
                                                        @if($index == 0)
                                                        {{$category->category->name}}
                                                        @else
                                                        ,{{$category->category->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="lb-val">Industries</th>
                                                <td class="data-val">
                                                    @foreach($quotes->industries as $index=>$industry)
                                                        @if($index == 0)
                                                        {{$industry->industry->name}}
                                                        @else
                                                        ,{{$industry->industry->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
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
$("#quote-main-menu").addClass("active");
$('#quote-main-menu' ).click();
$('#quote-menu-arrow').addClass('open')
$('#quote-view-menu').addClass('active');
/* end menu active */

</script>
@endsection
