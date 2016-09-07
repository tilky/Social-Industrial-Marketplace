@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/socicon/socicon.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('marketplaceproducts')}}">Marketplace Products</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Search Marketplace Product</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN FORM-->
                
		
                
                
                <!-- END FORM-->
                
                @if($search != '')
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="{{url('marketplaceproducts/search/product')}}" class="form-horizontal form-row-seperated searchbarresult" enctype="multipart/form-data">
                
                        <input type="hidden" name="user_id" value="{{$userData->user_id}}" />
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        
                        <div id="custom-search-input searchbar">
                            <div class="input-group col-md-12">
                                <input type="text" class="  search-query form-control" name="search" value="{{$search}}" placeholder="Search Product Names or Category Types" />
                                <span class="input-group-btn" style="float: left;">
                                    <button  class="btn btn-circle btn-default" type="submit">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </div>
                        
                        </form>
                    <h4 class="col-md-12 paddin-npt control-label padding-top">Search results for: "{{$search}} - searched"</h4>
                    @if(!empty($products))
                    <div class="col-md-12 body-containt paddin-npt">
                        @foreach($products as $product)
                        <div class="col-md-4 paddin-npt padding-right-15" style="min-height: 420px;">
        					<div class="thumbnail">
        						<a href="{{url('marketplaceproducts')}}/{{$product->id}}">
                                    <img alt="Bootstrap Thumbnail First" src="{{url('marketplace/product/images')}}/{{$product->image}}" alt="{{ $product->name }}" title="{{ $product->name }}" style="width: 100%;height: 275px;" />
                                </a>
        						@if($product->star != 'none')<i class="fa fa-star user-star @if($product->star == 'gold') gold-star @else silver-star @endif" aria-hidden="true"></i>@endif
        						<div class="user-img-thumb">
                                    <a class="pull-left" href="{{url('home/user/profile')}}/{{$product->user->id}}" target="_blank">
                                    @if($product->user->userdetail->profile_picture != '')
                                    <img src="{{url('')}}/{{$product->user->userdetail->profile_picture}}" style="width: 100%;"> 
                                    @else
                                    <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" style="width: 100%;">
                                    @endif
                                    </a>
                                </div>
        						<div class="content-img">
        						<span>NEW</span>
        						<div class="col-md-8 col-xs-8"><span class="fa fa-map-marker"></span> {{$product->location_city}}</div>
        						<div class="col-md-4 col-xs-4 text-right">${{$product->price}}</div>
        						
        						</div>
        						<div class="caption">
        							<h3>
        								{{$product->name}} 
        							</h3>
        							<h5>{{$product->brand_name}} | {{$product->model_number}}</h5>
        							<h4>
                                        @foreach($product->categories as $index=>$category)
                                            @if($index < 5)
                                                @if($index == 0)
                                                {{$category->category->name}}
                                                @else
                                                ,{{$category->category->name}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </h4>
        							<p>
        								{{$product->user->userdetail->first_name}} {{$product->user->userdetail->last_name}}@if($product->user->company) - {{$product->user->company->name}}@endif
        							</p>
        							
        						</div>
        					</div>
        				</div>
                        @endforeach
                        <a href="{{url('market/post-your-product')}}" class="col-md-12 paddin-npt" >
                            <div class="thumbnail post-free">
                                <div class="caption">
                                    <h3>
                                    Can't Find what you're 
                                    looking for ? 
                                    </h3>
                                    <h5>Not all products are listed.</h5>
                                    <button class="btn btn-circle btn-link2">Post a Free Buy Request</button>
                                </div>
                            </div>
                        </div> 
                    </a>
                @else
                <div href="#" class="col-md-12 paddin-npt" >
                    <div class="thumbnail post-free">
                        <div class="caption">
                            <h3>
                            Can't Find what you're 
                            looking for ? 
                            </h3>
                            <h5>Not all products are listed.</h5>
                            <a href="{{url('market/post-your-product')}}" class="btn btn-circle btn-link2">Post a Free Buy Request</a>
                        </div>
                    </div>
                </div>
				
                @endif
                    </div>
                </div>
                @endif
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i> Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i> </a>
                    </li>
                    @endif
                </ul>
    </div>
</div>
<script>
    /* for show menu active */
    $("#marketplace-main-menu").addClass("active");
	$('#marketplace-main-menu' ).click();
	$('#marketplace-menu-arrow').addClass('open')
	$('#marketplace-product-search-menu').addClass('active');
    /* end menu active */
    $(document).ready(function() {
        $('#search-result-table').DataTable({
            columnDefs: [
              { targets: 'no-sort', orderable: false }
            ]
        });
    });
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
<script src="{{URL::asset('metronic/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection
