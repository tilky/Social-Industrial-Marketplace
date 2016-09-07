
@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Show categories</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> View quotes left per industry
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  Show categories seller has signed up for list  </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th> Seller Name </th>
                        <th> Categories </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($supplierLeadsArray as $supplier)
                    <tr class="odd gradeX">
                        <td>{{ $supplier['seller_Name'] }}</td>
                        <td>
                            @if(!empty($supplier['supplierCategory']))
                                @foreach($supplier['supplierCategory'] as $categoryArray)
                                {{ $categoryArray['category_name'] }},
                                @endforeach
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
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
    $("#industries-main-menu").addClass("active");
    $('#industries-main-menu' ).click();
    $('#industries-menu-arrow').addClass('open');
    $('#product-industries-menu').addClass('active');
    /* end menu active */

</script>
@endsection
