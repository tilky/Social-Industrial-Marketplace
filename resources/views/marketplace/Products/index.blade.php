@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Marketplace Products</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">

<div class="col-md-12 border2x_bottom hide_print">
<div class="col-md-6 col-sm-6">
                <div class="row">
<h3 class="page-title uppercase"> 
 <i class="fa fa-server color-black"></i> LISTING MANAGER
</h3>
</div>
</div>
<div class="col-md-6 col-sm-6 text-right">
                <div class="row">
                <div class="actions margin-top-15">
                    <a href="{{ URL::to('marketplaceproducts/create') }}" class="btn btn-circle btn-danger btn-sm">
                        <i class="fa fa-plus"></i> Add a new Product </a>
                </div>
                </div>
                </div>
</div>
</div>

    
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
       
            
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="col-md-8 padding-top">
                    <p class="caption-helper">Manage the products that you have listed in the marketplace.</p>
                </div>
                
                <div class="col-md-4 padding-top margin-top-20" style="text-align: right;padding-bottom: 10px;">
                    Sort by: 
                    @if($mp_hidden_val == 'desc')
                    <a href="{{url('marketplaceproducts')}}?mp_order_name=created_at&mp_order_by=asc">@if($mp_hidden_name == 'created_at')<b>Posted Date <i class="fa fa-long-arrow-down"></i></b> @else Posted Date @endif </a> | 
                    <a href="{{url('marketplaceproducts')}}?mp_order_name=condition&mp_order_by=asc">@if($mp_hidden_name == 'condition')<b>Condition <i class="fa fa-long-arrow-down"></i></b> @else Condition @endif </a> | 
                    <a href="{{url('marketplaceproducts')}}?mp_order_name=name&mp_order_by=asc">@if($mp_hidden_name == 'name')<b>Name <i class="fa fa-long-arrow-down"></i></b> @else Name @endif </a>                 
                    @else
                    <a href="{{url('marketplaceproducts')}}?mp_order_name=created_at&mp_order_by=desc">@if($mp_hidden_name == 'created_at')<b>Posted Date <i class="fa fa-long-arrow-up"></i></b> @else Posted Date @endif </a> | 
                    <a href="{{url('marketplaceproducts')}}?mp_order_name=condition&mp_order_by=desc">@if($mp_hidden_name == 'condition')<b>Condition <i class="fa fa-long-arrow-up"></i></b> @else Condition @endif </a> | 
                    <a href="{{url('marketplaceproducts')}}?mp_order_name=name&mp_order_by=desc">@if($mp_hidden_name == 'name')<b>Name <i class="fa fa-long-arrow-up"></i></b> @else Name @endif </a>
                    @endif
                    <!--<div class="col-md-2 font-wh">
                        Sort By: 
                        <select id="received-quote-filter" onchange="ApplyFilter();" class="form-control" style="width: 90%;float: left;">
                            <option value="created_at" selected="selected">Submission Date</option>
                            <option value="expiry_date">Expiration Date</option>
                            <option value="title">Name</option>
                        </select>
                                                    <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-down padding-top" style="float: left;padding-left: 5px;"></i></a>
                                            </div>-->
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="mt-comments col-md-12 col-sm-12 center-block margin-bottom-20 float_none">
                    @foreach ($products as $product)
                    <div class="mt-comments col-md-12 col-sm-12 center-block no_filter">
                    <p class="text-right res_found">&nbsp;</p>
                        <div class="mt-comment result">
                        <div class="mt-comment-img">
                            <a class="pull-left" href="{{ route('marketplaceproducts.show', $product->id) }}">
                              <img src="{{url('marketplace/product/images')}}/{{$product->image}}" alt="{{ $product->name }}" width="160px" height="90px" title="{{ $product->name }}"  />
                            </a>
                            </div>
                            <div class="mt-comment-body">
                                <div class="col-md-12 paddin-npt">
                                    <div class="col-md-8">
                                        <h4 style="margin: 0px; margin-bottom: 10px;">
                                            @if($product->brand_name != ''){{$product->brand_name}} - @endif {{ $product->name }} @if($product->model_number)({{$product->model_number}})@endif</h4>
                                          
                                        <span><b>Status: </b>@if($product->is_active == 1)Active @else Inactive @endif</span>
                                        <br />
                                        <span><b> Condition: </b>{{$product->condition}}</span>
                                        <br />
                                        <span><b>Industries: </b>
                                       
                                        @foreach($product->industries as $index=>$industry)
                                            @if($index < 5)
                                                @if($index == 0)
                                                {{$industry->industry->name}}
                                                @else
                                                ,{{$industry->industry->name}}
                                                @endif
                                            @endif
                                        @endforeach |
                                        </span>
                                       <span>
                                        <b>Categories: </b>
                                        
                                        @foreach($product->categories as $index=>$category)
                                            @if($index < 5)
                                                @if($index == 0)
                                                {{$category->category->name}}
                                                @else
                                                ,{{$category->category->name}}
                                                @endif
                                            @endif
                                        @endforeach
                                        </span>
                                        
                                    </div>
                                    
                                    <div class="col-md-4 text-right">
                                       <div class="text-muted  paddin-npt"><small>Posted {!! $product->created_at->diffForHumans() !!}</small></div>
                                        
                                       
                                        <div class="btn-group  margin-top-10"> <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                    <ul class="dropdown-menu pull-right">
                      <li> <a href="{{ route('marketplaceproducts.show', $product->id) }}">View</a></li>
                      
                                            @if($product->is_active == 1) 
                                            <li class="divider"> </li>
                                            <li><a href="{{url('marketplaceproducts/product/inactive')}}/{{$product->id}}" >Inactive</a></li>
                                            @else
                      <li class="divider"> </li>
                                            <li> <a href="{{url('marketplaceproducts/product/active')}}/{{$product->id}}" >Active</a> </li>
                                            @endif
                      <li class="divider"> </li>
                      <li> <a id="deleteButton" data-id="{{$product->id}}" data-toggle="modal" href="#deleteConfirmation"> 
                                    {!! Form::open([
                                    'method' => 'DELETE',
                                    'id' => 'DELETE_FORM_'.$product->id,
                                    'route' => ['marketplaceproducts.destroy', $product->id]
                                    ]) !!}
                                    {!! Form::close() !!}
                                        Delete </a></li>
                      
                    </ul>
                  </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                    </div>
                </div>
                
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
        
        <!-- END EXAMPLE TABLE PORTLET-->
    

<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
<script>
    /* for show menu active */
    $("#marketplace-main-menu").addClass("active");
	$('#marketplace-main-menu' ).click();
	$('#marketplace-menu-arrow').addClass('open');
	$('#marketplace-view-product-menu').addClass('active');
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
