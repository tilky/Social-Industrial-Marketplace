@extends('admin.app')

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
            <a href="{{url()}}/marketplaceproducts/info/{{$product->id}}">Additional Information</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Add Industry</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet yellow-crusta form-fit bordered">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="icon-social-dribbble color-black"></i>  
                    <span class="caption-subject bold uppercase">Select Industry</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{url()}}/marketplaceproducts/info/industries/save/{{$product->id}}" class="form-horizontal form-row-seperated">
                    <div class="form-body">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="form-group">
                            <div class="col-md-9">
                                <div class="col-md-3">All</div>
                                <div class="col-md-3">Selected</div>
                                <select multiple="multiple" class="multi-select" id="product_industries" name="product_industries[]">
                                    @foreach($product->industries as $industry)
                                        <option selected value="{{$industry->industry->id}}">{{$industry->industry->name}}</option>
                                    @endforeach
                                    @foreach($industries as $industry)
                                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle green">
                                    <i class="fa fa-check"></i>  Submit</button>
                                <button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>
<script>
    /* for show menu active */
    $("#marketplace-main-menu").addClass("active");
	$('#marketplace-main-menu' ).click();
	$('#marketplace-menu-arrow').addClass('open');
    /* end menu active */
    $( document ).ready(function() {
        $('#product_industries').multiSelect();
    });
</script>
@endsection
