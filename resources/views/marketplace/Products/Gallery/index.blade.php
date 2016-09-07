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
            <span>Gallery</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-server color-black"></i>  {{$product->name}} - Gallery </div>
                <div class="actions">
                    <a href="{{ URL::to('marketplaceproducts/gallery/add') }}/{{$product->id}}" class="btn btn-circle color-black btn-sm">
                        <i class="fa fa-plus color-black"></i>  Add Images </a>
                </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div id="delete-image-success" class="custom-alerts alert alert-success fade in" style="display: none;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Successfully Image deleted!!!!</div>
                <div class="row">
                    
                    @foreach($product->gallery as $image)
                        <div class="col-md-3" style="text-align: center;">
                            <a data-src="{{url()}}/public/marketplace/product/images/{{$image->path}}" class="viewImage" data-toggle="modal" href="#imageViewer"><img height="150" width="150" src="{{url()}}/public/marketplace/product/images/{{$image->path}}"/></a>
                            <div style="text-align: center;padding-top: 10px;">
                                <a href="javascript:void(0)" id="{{url()}}/marketplaceproducts/gallery/remove/{{$image->id}}" onclick="RemoveImage(id);" class="btn btn-circle btn btn-danger delete">Remove</a>
                            </div>
                        </div>
                    @endforeach
                    
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
    $(document).on("click", ".viewImage", function () {
        var src = $(this).data('src');
        jQuery('#imageViewer .modal-body #image').attr( "src", src);
    });
    function RemoveImage(id)
    {
        var imgRemoveUrl = id;
        
        jQuery.ajax({
            url: imgRemoveUrl,
            type: 'get',
            success: function(data) {
                
                if(data.success == 1)
                {
                    location.reload();
                }
            },   
            done: function() {
                //console.log('error');
            },
            error: function() {
                //console.log('error');
                
            }
            
        });
    }
</script>
@endsection
