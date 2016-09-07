@extends('admin.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Products</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> View Products
</h3>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>  Products </div>
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
                        <th> Name </th>
                        <th> Status </th>
                        <th> Category </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                    <tr class="odd gradeX">
                        <td>{{ $product->name }}</td>
                        <td>
                            @if($product->is_active == '1')
                            <span class="label label-sm label-success"> Active</span>
                            @else
                            <span class="label label-sm label-danger"> Inactive </span>
                            @endif
                        </td>
                        <td>
                            {{$product->category->name}}
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
    $("#product-main-menu").addClass("active");
    $('#product-main-menu' ).click();
    $('#product-menu-arrow').addClass('open');
    $('#view-product-menu').addClass('active');
    /* end menu active */

</script>
@endsection
