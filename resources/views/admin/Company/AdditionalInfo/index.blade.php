@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
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
            @elseif(Auth::user()->access_level == 4)
            <a href="{{url('company/view')}}">Company</a>
            <i class="fa fa-circle"></i>  
            @else
            <a href="{{url()}}/companies/{{$company->id}}">Companies</a>
            <i class="fa fa-circle"></i>  
            @endif
        </li>
        <li>
            <span>Additional Information</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> Add Additional Information About Company - {{$company->name}}
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  Additional Information </div>
                <div class="actions">
                <a href="{{ URL::to('companies') }}/{{$company->id}}" class="btn btn-circle btn-success btn-sm">
                    <i class="fa fa-arrow-left"></i>  back </a>
                <a href="{{ URL::to('companies/gallery/') }}/{{$company->id}}" class="btn btn-circle btn-danger btn-sm">
                    <i class="fa fa-eye"></i>  View Gallery </a>
                    
                    </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>  Accreditations </div>
                                <div class="actions">
                                    <a href="{{ URL::to('companies/info/accreditations/').'/'.$company->id }}" class="btn btn-circle btn-sm">
                                        <i class="fa fa-plus"></i>  Change </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($company->accreditations as $accreditation)
                                    <tr class="odd gradeX">
                                        <td>{{ $accreditation->accreditation->name }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-sitemap"></i>  Categories Catered</div>
                                <div class="actions">
                                    <a href="{{ URL::to('companies/info/categories/').'/'.$company->id }}" class="btn btn-circle btn-sm">
                                        <i class="fa fa-plus"></i>  Change </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($company->categories as $category)
                                    <tr class="odd gradeX">
                                        <td>{{ $category->category->name }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-life-ring"></i>  Technical Services Offered </div>
                                <div class="actions">
                                    <a href="{{ URL::to('companies/info/services/').'/'.$company->id }}" class="btn btn-circle btn-sm">
                                        <i class="fa fa-plus"></i>  Change </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($company->techServices as $techService)
                                    <tr class="odd gradeX">
                                        <td>{{ $techService->techService->name }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>  Quality Standards </div>
                                <div class="actions">
                                    <a href="{{ URL::to('companies/info/quality-standards/').'/'.$company->id }}" class="btn btn-circle btn-sm">
                                        <i class="fa fa-plus"></i>  Change </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($company->qualityStandards as $qualityStandard)
                                    <tr class="odd gradeX">
                                        <td>{{ $qualityStandard->qualityStandard->name }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-institution"></i>  Industries Catered </div>
                                <div class="actions">
                                    <a href="{{ URL::to('companies/info/industries/').'/'.$company->id }}" class="btn btn-circle btn-sm">
                                        <i class="fa fa-plus"></i>  Change </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($company->industries as $industry)
                                    <tr class="odd gradeX">
                                        <td>{{ $industry->industry->name }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-bank"></i>  Main Markets </div>
                                <div class="actions">
                                    <a href="{{ URL::to('companies/info/markets/').'/'.$company->id }}" class="btn btn-circle btn-sm">
                                        <i class="fa fa-plus"></i>  Change </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($company->markets as $market)
                                    <tr class="odd gradeX">
                                        <td>{{ $market->market->name }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 ">
                        <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-truck"></i>  Shipping Preferences</div>
                                <div class="actions">
                                    <a href="{{ URL::to('companies/info/shipping-preferences/').'/'.$company->id }}" class="btn btn-circle btn-sm">
                                        <i class="fa fa-plus"></i>  Change </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($company->shippingPreferences as $shippingPreference)
                                    <tr class="odd gradeX">
                                        <td>{{ $shippingPreference->shippingPreference->name }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-tags"></i>  Company Types</div>
                                <div class="actions">
                                    <a href="{{ URL::to('companies/info/company-type/').'/'.$company->id }}" class="btn btn-circle btn-sm">
                                        <i class="fa fa-plus"></i>  Change </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Name </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($company->types as $type)
                                    <tr class="odd gradeX">
                                        <td>{{ $type->type->name }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
    $("#compnay-main-menu").addClass("active");
	$('#compnay-main-menu' ).click();
	$('#conpmay-menu-arrow').addClass('open');
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
