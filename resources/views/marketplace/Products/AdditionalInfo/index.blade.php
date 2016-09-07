@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url()}}/marketplaceproducts">Marketplace Products</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Additional Information</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-server color-black"></i>  Add Additional Information About Product - {{$product->name}} </div>
                <div class="actions">
                <a href="{{ URL::to('marketplaceproducts/gallery/') }}/{{$product->id}}" class="btn btn-circle color-black btn-sm">
                    <i class="fa fa-plus color-black"></i>  View Gallery </a>
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
                                    <i class="fa fa-gift"></i>  Categories Catered</div>
                                <div class="actions">
                                    <a href="{{ URL::to('marketplaceproducts/info/categories/').'/'.$product->id }}" class="btn btn-circle btn-sm">
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
                                    @foreach ($product->categories as $category)
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
                                    <i class="fa fa-gift"></i>  Industries Catered </div>
                                <div class="actions">
                                    <a href="{{ URL::to('marketplaceproducts/info/industries/').'/'.$product->id }}" class="btn btn-circle btn-sm">
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
                                    @foreach ($product->industries as $industry)
                                    <tr class="odd gradeX">
                                        <td>{{ $industry->industry->name }}</td>
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
    $("#marketplace-main-menu").addClass("active");
	$('#marketplace-main-menu' ).click();
	$('#marketplace-menu-arrow').addClass('open');
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
