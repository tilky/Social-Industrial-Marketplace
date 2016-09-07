@extends('buyer.app')@section('content')
<link href="{{URL::asset('metronic/pages/css/invoice-2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/apps/css/todo.min.css')}}" />
<link href="{{URL::asset('marketplace/productview/css/custom.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('marketplace/productview/css/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('css/style_custom.css')}}" rel="stylesheet" type="text/css" />
<style>
.active img{width: 104px!important;}.invoice-content-2{}
</style>
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url()}}/user-dashboard">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <a href="{{url('marketplaceproducts')}}">Marketplace Products</a> <i class="fa fa-circle"></i> </li>
    <li> <span>View</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box " id="print_section">
  <div class="row"> @if (Session::has('message'))
    <div id="" class="custom-alerts alert alert-success fade in">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      {{ Session::get('message') }}</div>
    @endif
    <div class="col-md-12 border2x_bottom hide_print">
      <div class="col-md-9 col-sm-9">
        <div class="row">
          <h3 class="page-title uppercase"> {{$product->name}} </h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 text-right">
        <div class="row">
          <div class="actions margin-top-10">
            <div class="btn-group"> <a class="btn btn-circle action_bg btn-circle" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
              <ul class="dropdown-menu pull-right">
                <li> <a href="javascript:void(0)" id="{{url('view/product')}}/{{$product->external_url}}" onclick="showShare(id,'{{$product->name}}')">Share</a></li>
                <li class="divider"> </li>
                <li><a href="#" onclick="printDiv('print_section')">Print</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row"> <!-- BEGIN PAGE BASE CONTENT -->
    <div class="invoice-content-2 bordered" style="padding:0px 20px !important;">
      <div class="product-details" style="margin:0px 0px !important;">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="row">
              <div class="portlet light request_page" >
                <div class="clearfix"></div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6 col-sm-6 product_images">
                      <div class="row">
                        <ul class="pgwSlideshow">
                          @if(count($product->gallery) > 0)                          @foreach($product->gallery as $image)
                          <li><img src="{{url()}}/public/marketplace/product/images/{{$image->path}}" ></li>
                          @endforeach                          @else
                          <li><img id="image-full" src="{{url('marketplace/product/images/placeholder_png.jpg')}}" /></li>
                          @endif
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 about_product_images">
                      <div class="row">
                        <div class="h4 mt-comment">
                          <div class="col-md-12 margin-bottom-10">
                            <div class="col-md-5 col-sm-4 col-xs-6">
                              <div class="row">Manufacturer:</div>
                            </div>
                            <div class="col-md-7 col-sm-8 col-xs-6">
                              <div class="row"><strong>{{$product->brand_name}} </strong></div>
                            </div>
                          </div>
                          <div class="col-md-12 margin-bottom-10">
                            <div class="col-md-5 col-sm-4 col-xs-6">
                              <div class="row">Model Number:</div>
                            </div>
                            <div class="col-md-7 col-sm-8 col-xs-6">
                              <div class="row"><strong>{{$product->model_number}} </strong></div>
                            </div>
                          </div>
                          <div class="col-md-12 margin-bottom-10">
                            <div class="col-md-5 col-sm-4 col-xs-6">
                              <div class="row">Condition:</div>
                            </div>
                            <div class="col-md-7 col-sm-8 col-xs-6">
                              <div class="row"><strong>{{$product->condition}} @if($product->condition_quality != '')- {{$product->condition_quality}}@endif</strong></div>
                            </div>
                          </div>
                          <div class="col-md-12 margin-bottom-10">
                            <div class="col-md-5 col-sm-4 col-xs-6">
                              <div class="row">Location:</div>
                            </div>
                            <div class="col-md-7 col-sm-8 col-xs-6">
                              <div class="row"><strong>{{$product->location_city}}</strong></div>
                            </div>
                          </div>
                          <div class="col-md-12 margin-bottom-10">
                            <div class="col-md-5 col-sm-4 col-xs-6">
                              <div class="row">Requested Price:</div>
                            </div>
                            <div class="col-md-7 col-sm-8 col-xs-6">
                              <div class="row"><strong>${{number_format($product->price,2,'.',',')}}</strong></div>
                            </div>
                          </div>
                          <div class="col-md-12 margin-bottom-15">
                            <div class="col-md-5 col-sm-4 col-xs-6">
                              <div class="row">IJ Product ID:</div>
                            </div>
                            <div class="col-md-7 col-sm-8 col-xs-6">
                              <div class="row"><strong>{{$product->unique_number}}</strong></div>
                            </div>
                          </div>
                          <div class=" clearfix"></div>
                          <div class="col-md-12 margin-bottom-15">
                            <div class="col-md-12 text-center with_bg">
                              <div class="row">
                                <h4 class="bold uppercase">Seller Information</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                          <div class="col-md-12 col-sm-12 about_user">
                            <div class="col-md-4 col-sm-5 text-center user_info user_product">
                              <div class="row">
                                <div class="mt-comment-img"> @if($sellerUser->userdetail->profile_picture != '') <img class="img-circle" src="{{url('')}}/{{$sellerUser->userdetail->profile_picture}}" height="80px" width="80px"> @else <img class="img-circle" src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" height="80px" width="80px"> @endif </div>
                                <div class=" clearfix"></div>
                                <div class="mt-comment-text"> @if($sellerUser->quotetek_verify == 1)                                  VERIFIED MEMBER                                  @else                                  NOT VERIFIED                                  @endif </div>
                                <div class=" clearfix"></div>
                                @if($sellerUser->star == 'gold') <span class="label label-sm label-default label-warning"> Gold Supplier </span> @elseif($sellerUser->star == 'silver') <span class="label label-sm label-default "> Silver Supplier </span> @else <span class="label label-sm label-free "> Free Member </span> @endif
                                <div class=" clearfix"></div>
                                <ul>
                                  <li><i class="fa fa-comment-o"></i> {{$sellerUser->message_count}}</li>
                                  <li><i class="glyphicon glyphicon-heart-empty"></i> {{$sellerUser->endorse_count}}</li>
                                  <li><i class="glyphicon glyphicon-star-empty"></i> {{$sellerUser->review_count}}</li>
                                </ul>
                                <div class=" clearfix"></div>
                              </div>
                            </div>
                            <div class="col-md-8 col-sm-7">
                              <div class="row">
                                <div class="mt-comment-body">
                                  <div class="mt-comment-info"> <span class="mt-comment-author user_name">{{$sellerUser->userdetail->first_name}} {{$sellerUser->userdetail->last_name}} </span> </div>
                                  <div class="clearfix"></div>
                                  <div class="mt-comment-status company_address"> @if($sellerUser->userdetail->current_position != '') {{$sellerUser->userdetail->current_position}} @endif </div>
                                  <div class="clearfix"></div>
                                  <div class="mt-comment-info"> <span class="mt-comment-author company_name">{{$sellerUser->company->name}} </span> </div>
                                  <div class="clearfix"></div>
                                  <div class="mt-comment-status company_address">{{$sellerUser->userdetail->city}}, {{$sellerUser->userdetail->state}}, {{$sellerUser->userdetail->country}}</div>
                                  <div class="mt-comment-text company_address"> @if($product->totalProducts > 0)                                     {{$product->totalProducts}} @if($product->totalProducts == 1) Product @else Products @endif listed. @if($product->totalProducts > 1) <a href="{{url('general/search')}}?query={{$product->user_id}}"> View all other listings </a> @endif                                    @endif </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 margin-bottom-15 margin-top-15">
                            <div class="col-md-12 text-center with_bg">
                              <div class="row">
                                <h4 class="bold uppercase">Interested in this Product?</h4>
                              </div>
                            </div>
                          </div>
                      <div class="col-md-6 text-center margin-top-10 contact_seller margin-bottom-30"> <a href="#contact_seller" id="{{$sellerUser->id}}" onclick='setReceiver(id)' data-toggle="modal" data-target="#contact_seller" class="btn btn-circle message-seller large_btn_padding">
                      <h4>  Message the Seller</h4>
                        </a>  </div>
                        <div class="col-md-6 text-center margin-top-10 contact_seller margin-bottom-30"> <a href="#request_quote" data-toggle="modal" data-target="#request_quote" class="btn btn-circle yellow-crusta large_btn_padding">
                     <h4>   Request Checkout
                        </h4></a> </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 ">
              <h5 class="border_bottom border_top padding-tittle">
                <ul class="job_listing product_listing with_bg">
                  <li><a href="#product"><b>Product Information</b></a></li>
                  <li><a href="#company"><b>Company Profile</b></a></li>
                  <li><a href="#listing"><b>Fulfillment Details</b></a></li>
                  <li><a href="#similar"><b>Similar Products</b></a></li>
                </ul>
              </h5>
              <div class="portlet light portlet-fit product_details">
                <div class="portlet-title with_bg"> <a data-toggle="collapse" href="#product" aria-expanded="" class="caption-subject">
                  <h3 class="pull-left "> Product Information</h3>
                  <i class="fa fa-2x fa-plus pull-right"></i>
                  <div class="clearfix"></div>
                  </a> </div>
                <div class="all_details collapse in" id="product" aria-expanded="true">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-12 margin-bottom-15 border-bottom-grey">
                        <div class="col-md-5 col-sm-4">
                          <div class="row">
                            <h4>Product Type or Categories:</h4>
                          </div>
                        </div>
                        <div class="col-md-7 col-sm-8">
                          <div class="row">
                            <h4> @foreach($product->categories as $index=>$category)                              @if($index == 0)                              {{$category->category->name}}                              @else                              ,{{$category->category->name}}                              @endif                              @endforeach </h4>
                          </div>
                        </div>
                      </div>
                      @if(count($product->specification) > 0)
                      <div class="col-md-12 margin-bottom-15 border-bottom-grey">
                        <div class="col-md-5 col-sm-4">
                          <div class="row">
                            <h4>Product Options:</h4>
                          </div>
                        </div>
                        <div class="col-md-7 col-sm-8">
                          <div class="row"> @foreach($product->specification as $options)
                            <div class="col-md-6">
                              <div class="row"> @if(key_exists('keyword',$options))
                                <h4>{{$options['keyword']}}</h4>
                                @endif </div>
                            </div>
                            @endforeach </div>
                        </div>
                      </div>
                      @endif                                            @if($product->size != '')
                      <div class="col-md-12 margin-bottom-15 border-bottom-grey">
                        <div class="col-md-5 col-sm-4">
                          <div class="row">
                            <h4>Physical Dimensions:</h4>
                          </div>
                        </div>
                        <div class="col-md-7 col-sm-8">
                          <div class="row">
                            <h4>{{$product->size}}</h4>
                          </div>
                        </div>
                      </div>
                      @endif                                            @if($product->place_of_origin != '')
                      <div class="col-md-12 margin-bottom-15 border-bottom-grey">
                        <div class="col-md-5 col-sm-4">
                          <div class="row">
                            <h4>Product Origin:</h4>
                          </div>
                        </div>
                        <div class="col-md-7 col-sm-8">
                          <div class="row">
                            <h4>{{$product->place_of_origin}}</h4>
                          </div>
                        </div>
                      </div>
                      @endif                                            @if($product->certification != '')
                      <div class="col-md-12 margin-bottom-15 border-bottom-grey">
                        <div class="col-md-5 col-sm-4">
                          <div class="row">
                            <h4>Product Certificates:</h4>
                          </div>
                        </div>
                        <div class="col-md-7 col-sm-8">
                          <div class="row">
                            <h4>{{$product->certification}} </h4>
                          </div>
                        </div>
                      </div>
                      @endif                                            @if($product->description != '')
                      <div class="col-md-12  border-bottom-grey">
                        <div class="col-md-5 col-sm-4">
                          <div class="row">
                            <h4>Description:</h4>
                          </div>
                        </div>
                        <div class="col-md-7 col-sm-8">
                          <div class="row">
                            <h4>{{$product->description}} </h4>
                          </div>
                        </div>
                      </div>
                      @endif                                            @if($product->attachment_path != '')
                      <div class="col-md-12 margin-bottom-40">
                        <div class="col-md-5 col-sm-4">
                          <div class="row">
                            <h4>Additional File:</h4>
                          </div>
                        </div>
                        <div class="col-md-7 col-sm-8">
                          <div class="row">
                            <h4><a href="{{url()}}/{{$product->attachment_path}}" class="bg" download>Click to Download Additional Specification File.</a></h4>
                          </div>
                        </div>
                      </div>
                      @endif </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              @if($sellerUser->company->name != '')
              <div class="portlet light portlet-fit product_details">
                <div class="portlet-title with_bg"> <a data-toggle="collapse" href="#company" aria-expanded="" class="caption-subject">
                  <h3 class="pull-left ">Company Profile</h3>
                  <i class="fa fa-2x fa-plus pull-right"></i>
                  <div class="clearfix"></div>
                  </a> </div>
                <div class="all_details collapse in" id="company" aria-expanded="true"> <!--  <div class="col-md-12">                    <div class="col-md-3 col-sm-3 text-center user_info company_info margin-bottom-40">                      <div class="row">                        <div class="mt-comment-img"> @if($sellerUser->company->logo != '') <img src="{{url('/')}}/{{$sellerUser->company->logo}}" height="80px" width="80px"> @else <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" height="80px" width="80px"> @endif </div>                        <div class="clearfix"></div>                        @if($sellerUser->company->star == 'gold') <span class="label label-sm label-default gold-member">GOLD SUPPLIER</span> @elseif($sellerUser->company->star == 'silver') <span class="label label-sm label-default silver-member">SILVER SUPPLIER</span> @else <span class="label label-sm label-default">FREE MEMBER</span> @endif                        <div class="clearfix"></div>                        @if($sellerUser->company->user->quotetek_verify == 1) <span class="label label-sm label-default">VERIFIED </span> @else <span class="label label-sm label-default"> NOT VERIFIED </span> @endif                        <div class="clearfix"></div>                        <ul>                          <li><i class="fa fa-comment-o"></i> {{count($sellerUser->company->user->messages)}}</li>                          <li><i class="glyphicon glyphicon-heart-empty"></i> {{count($sellerUser->company->user->endorsements)}}</li>                          <li><i class="glyphicon glyphicon-star-empty"></i> {{count($sellerUser->company->user->reviews)}}</li>                        </ul>                        <ul class="social_icons">                          <li><a href="{{$sellerUser->company->facebook_url}}" target="_blank"><span class="fa fa-2x fa-facebook"></span></a></li>                          <li><a href="{{$sellerUser->company->insta_url}}" target="_blank"><span class="fa fa-2x fa-instagram"></span></a></li>                          <li><a href="{{$sellerUser->company->pintress_url}}" target="_blank"><span class="fa fa-2x fa-pinterest"></span></a></li>                          <li><a href="{{$sellerUser->company->youtube_url}}" target="_blank"><span class="fa fa-2x fa-youtube"></span></a></li>                        </ul>                        <div class="clearfix"></div>                      </div>                    </div>                    <div class="col-md-9 col-sm-9 ">                      <div class="row">                        <div class="mt-comment-body"> @foreach($sellerUser->company->industries as $index=>$industry) <span class="label label-default btn-circle font-red-haze bio">{{$industry->industry->name}}</span> @endforeach                          <div class="mt-comment-info margin-top-20"> <span class="mt-comment-author company_name">{{$sellerUser->company->name}} </span> </div>                          <div class="clearfix"></div>                          <div class="h4">{{$sellerUser->company->city}}, {{$sellerUser->company->state}}, {{$sellerUser->company->country}}</div>                          <div class="clearfix"></div>                          <div class="h4">{{$sellerUser->company->name}}</div>                          <div class="clearfix"></div>                          <div class="mt-comment-status">{{$sellerUser->company->description}}</div>                          <div class="h4"> Established: {{$sellerUser->company->establishment_year}}. Joined Quotetek: {{date('Y',strtotime($sellerUser->company->created_at))}}</div>                          <div class="col-md-12 margin-top-15 ">                            <div class="row"> @if($sellerUser->id != Auth::user()->id ) <a href="{{url('endorse-user')}}/{{Auth::user()->id}}/{{$sellerUser->company->user_id}}" class="btn btn-circle btn-lg with_border btn-circle yellow-crusta">Endorse </a> <a href="javascript:void(0)" class="btn btn-circle btn-lg with_border btn-circle yellow-crusta">Request Quote </a> <a href="{{url('messages/create')}}?buyer={{$sellerUser->company->user_id}}" class="btn btn-circle btn-lg with_border btn-circle yellow-crusta">Contact </a> @endif </div>                          </div>                        </div>                      </div>                    </div>                  </div>-->
                  <div class="profile-inner-section margin-bottom-40">
                    <div class="col-md-3 text-center profile_info">
                      <div class="stopMenu" id="stopMenu" style="padding-top: 0px;">
                        <div class="relative"> @if($sellerUser->company->user->quotetek_verify == 1) <span class="verified-text pull-left"> <a class="btn btn-circle btn-icon-only light-green" href="javascript:;"> <i class="fa fa fa-check"></i> </a> Verified </span> @else <span class="verified-text pull-left"> <a class="btn btn-circle btn-icon-only red" href="javascript:;"> <i class="fa fa fa-close"></i> </a> NOT VERIFIED </span> @endif
                          <div class="profile" style="margin-top: 0px!important;"> @if($sellerUser->company->logo != '') <img src="{{url('/')}}/{{$sellerUser->company->logo}}" height="80px" width="230px" style="border-radius: 50%;"> @else <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64" height="80px" width="80px"> @endif </div>
                          <div class="profile_name">{{$sellerUser->company->name}}</div>
                          <div class="position">{{$sellerUser->company->city}}, {{$sellerUser->company->state}}, {{$sellerUser->company->country}}</div>
                          @if($sellerUser->company->website != '')
                          <div class="company_name">{{$sellerUser->company->website}}</div>
                          @endif
                          <div class="membership"> @if($sellerUser->company->star == 'gold') <a href="" class="btn yellow-crusta color-black btn-circle font-yellow-crusta gold-member">GOLD SUPPLIER</a> @elseif($sellerUser->company->star == 'silver') <a href="" class="btn yellow-crusta color-black btn-circle font-yellow-crusta silver-member">SILVER SUPPLIER</a> @else <a href="" class="btn yellow-crusta color-black btn-circle font-yellow-crusta silver-member">FREE MEMBER</a> @endif </div>
                        </div>
                        <div class="todo-tasklist">
                          <div class="todo-tasklist-item todo-tasklist-item-border-green"> <a href="#"><i class="fa fa-home pull-left"></i>
                            <div class="todo-tasklist-item-title"> CONNECT </div>
                            </a> </div>
                          <!--<div class="todo-tasklist-item todo-tasklist-item-border-green">                                    <a href="{{url('messages/create')}}?buyer={{$sellerUser->company->user_id}}" > <i class="fa fa-cog  pull-left"></i>                                    <div class="todo-tasklist-item-title"> Message </div></a>                                </div>-->
                          <div class="todo-tasklist-item todo-tasklist-item-border-green"> <a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser({{$sellerUser->company->user_id}})"> <i class="fa fa-cog  pull-left"></i>
                            <div class="todo-tasklist-item-title"> Message </div>
                            </a> </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-9 profile_details">
                      <div class="profile_details_inner"> <!-- Nav tabs -->
                        <div class="profile-details-block aboutme">
                          <h3>{{$sellerUser->company->name}}<span class="pull-right">User ID: {{$sellerUser->company->unique_number}}</span></h3>
                          <div class="profile-block col-md-12">
                            <p>{{$sellerUser->company->description}}</p>
                            <div class="mt-element-list">
                              <div class="mt-list-container list-simple">
                                <ul>
                                  <li class="mt-list-item"> @if(count($sellerUser->company->industries) > 0)                                        @foreach($sellerUser->company->industries as $index=>$industry) <a class="btn dark btn-red btn-circle btn-sm" href="javascript:;"> {{$industry->industry->name}} </a> @endforeach                                        @endif </li>
                                  <li class="mt-list-item"> <i class="fa fa-circle"></i> <span class="list-content"> Industry Classification:                                    @foreach($sellerUser->company->types as $index=>$type)                                        @if($index == 0)                                        {{$type->type->name}}                                        @else                                        ,{{$type->type->name}}                                        @endif                                    @endforeach </span> </li>
                                  <li class="mt-list-item"> <i class="fa fa-circle"></i> <span class="list-content">Established: {{$sellerUser->company->establishment_year}}. Joined Quotetek: {{date('Y',strtotime($sellerUser->company->created_at))}} </span> </li>
                                  <li class="mt-list-item"> <i class="fa fa-circle"></i> <span class="list-content"> <strong> {{$sellerUser->company->name}} has Expertise in:</strong> </span> <!-- industries services -->
                                    <div class="expertise"> @foreach($sellerUser->company->techServices as $techService) <a class="btn dark btn-outline btn-circle btn-sm" href="javascript:;"> {{$techService->techService->name}}</a> @endforeach </div>
                                    <!-- end --> </li>
                                </ul>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="row"> @if($sellerUser->id != Auth::user()->id ) <a href="{{url('endorse-user')}}/{{Auth::user()->id}}/{{$sellerUser->company->user_id}}" class="btn btn-circle btn-lg with_border btn-circle yellow-crusta">Endrose </a> <a href="javascript:void(0)" class="btn btn-circle btn-lg with_border btn-circle yellow-crusta">Request Quote </a> <a href="{{url('messages/create')}}?buyer={{$sellerUser->company->user_id}}" class="btn btn-circle btn-lg with_border btn-circle yellow-crusta">Contact </a> @endif </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              @endif
              <div class="clearfix"></div>
              @if($product->quantity_available != '')
              <div class="col-md-12">
                <h3 class="block font-red-mint align-left"> <span style="font-size: 19px!important;">Do you have multiple items available?</span>
                  <input name="multi_select_items" id="multi-select-items" @if(Request::old('multi_select_items')== "on") checked="" @endif  type="checkbox" data-on-text="Yes" data-off-text="No" class="make-switch form-control" data-size="small">
                </h3>
              </div>
              @endif
              <div class="clearfix"></div>
              <div id="multi-items" style="display: none;">
                <div class="portlet light portlet-fit product_details">
                  <div class="portlet-title with_bg"> <a data-toggle="collapse" href="#listing" aria-expanded="" class="caption-subject">
                    <h3 class="pull-left ">Fulfillment Details</h3>
                    <i class="fa fa-2x fa-plus pull-right"></i>
                    <div class="clearfix"></div>
                    </a> </div>
                  <div class="all_details collapse in" id="listing" aria-expanded="true">
                    <div class="col-md-12">
                      <div class="row"> @if($product->quantity_available != '')
                        <div class="col-md-12 margin-bottom-15 border-bottom-grey">
                          <div class="col-md-5 col-sm-4">
                            <div class="row">
                              <h4>Quantity Available:</h4>
                            </div>
                          </div>
                          <div class="col-md-7 col-sm-8">
                            <div class="row">
                              <h4>{{$product->quantity_available}}</h4>
                            </div>
                          </div>
                        </div>
                        @endif                                @if($product->minimum_quantity != '')
                        <div class="col-md-12 margin-bottom-15 border-bottom-grey">
                          <div class="col-md-5 col-sm-4">
                            <div class="row">
                              <h4>Minimum Order Requirement:</h4>
                            </div>
                          </div>
                          <div class="col-md-7 col-sm-8">
                            <div class="row">
                              <h4>{{$product->minimum_quantity}} Products</h4>
                            </div>
                          </div>
                        </div>
                        @endif                                @if($product->discount_percent != '')
                        <div class="col-md-12 margin-bottom-15 border-bottom-grey">
                          <div class="col-md-5 col-sm-4">
                            <div class="row">
                              <h4>Discount Available:</h4>
                            </div>
                          </div>
                          <div class="col-md-7 col-sm-8">
                            <div class="row">
                              <h4>{{$product->discount_percent}}</h4>
                            </div>
                          </div>
                        </div>
                        @endif                                @if($product->supply_ability != '')
                        <div class="col-md-12 margin-bottom-15">
                          <div class="col-md-5 col-sm-4">
                            <div class="row">
                              <h4>Fulfillment Capability:</h4>
                            </div>
                          </div>
                          <div class="col-md-7 col-sm-8">
                            <div class="row">
                              <h4>{{$product->supply_ability}}</h4>
                            </div>
                          </div>
                        </div>
                        @endif </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="portlet light portlet-fit product_details">
                <div class="portlet-title with_bg"> <a data-toggle="collapse" href="#similar" aria-expanded="" class="caption-subject">
                  <h3 class="pull-left ">Similar Products</h3>
                  <i class="fa fa-2x fa-plus pull-right"></i>
                  <div class="clearfix"></div>
                  </a> </div>
                <div class="all_details collapse in" id="similar" aria-expanded="true">
                  <div class="clearfix"></div>
                </div>
              </div>
              <!-- <button class="btn btn-circle btn-success pull-right" onclick="printDiv('print_section')" ><i class="glyphicon glyphicon-print"></i> Print</button>--> </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>


<script>// ------------------------------// http://twitter.com/mattsince87// ------------------------------function scrollNav() {  $('.job_listing a').click(function(){      //Toggle Class    $(".active").removeClass("active");          $(this).closest('li').addClass("active");    var theClass = $(this).attr("class");    $('.'+theClass).parent('li').addClass('active');    //Animate    $('html, body').stop().animate({        scrollTop: $( $(this).attr('href') ).offset().top - 160    }, 400);    return false;  });  $('.scrollTop a').scrollTop();}scrollNav();</script><script>    $(document).ready(function() {        $('.pgwSlideshow').pgwSlideshow();    });/* for show menu active */$("#marketplace-main-menu").addClass("active");$('#marketplace-main-menu' ).click();$('#marketplace-menu-arrow').addClass('open');$('#marketplace-view-product-menu').addClass('active');/* end menu active */</script><script>    function setReceiver(id) {        //console.log(id);        document.getElementById('message_receiver').value = id;    }    jQuery(document).ready(function() {        var multi_sel = "{{Request::old('multi_select_items')}}";        if(multi_sel == 'on')        {            $('#multi-items').show();        }    });    $('input[name="multi_select_items"]').on('switchChange.bootstrapSwitch', function(event, state) {        //console.log(state); // true | false        if(state === true)        {            $('#multi-items').show();        }        else        {            $('#multi-items').hide();        }    });</script><!--<script>/* for show menu active */$("#marketplace-main-menu").addClass("active");$('#marketplace-main-menu' ).click();$('#marketplace-menu-arrow').addClass('open');$('#marketplace-view-product-menu').addClass('active');/* end menu active */jQuery.noConflict();jQuery(document).on("click", ".viewImage", function () {    var src = $(this).data('src');    jQuery('#imageViewer .modal-body #image').attr( "src",'');    jQuery('#imageViewer .modal-body #image').attr( "src", src);});function showimage(imgsrc){    //alert(imgsrc);    //document.getElementById('image').src=imgsrc;    jQuery('#image-full').attr('src',imgsrc);    jQuery('#main-img-a').data('src',imgsrc);}</script>--> <!--<script src="{{URL::asset('marketplace/productview/js/owl.carousel.js')}}"></script><script src="{{URL::asset('marketplace/productview/js/jquery.elevatezoom.js')}}"></script><script src="http://malsup.github.io/min/jquery.cycle2.min.js"></script><script src="http://malsup.github.io/min/jquery.cycle2.carousel.min.js"></script>--> <!--<script> setInterval(function(){$('#img_01').each(function(index, el) {  var a=$(this).attr('src') var b=a; var dimg=$(this).attr('data-zoom-image') $(this).attr('data-zoom-image',dimg)$('.zoomWindowContainer div').css('background-image','url('+b+')');$('#fancybox-img').attr('src',dimg)});   }) 	$(function(){//initiate the plugin and pass the id of the div containing gallery images $("#img_01").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: false}); $("#img_01").elevateZoom({gallery:'gal2', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon:false}); //pass the images to Fancybox $("#img_01").bind("click", function(e) { var ez = $('#img_01').data('elevateZoom');	$.fancybox(ez.getGalleryList()); return false; }); 	var height = $( document ).height(); // returns height of HTML documentvar scroll = (height/100)*50;    // fade in #back-top    $(window).scroll(function () {            if ($(this).scrollTop() > scroll) {				console.log("Bigger");                $('.scrolltotop').fadeIn();            } else {				console.log("Not Bigger");                $('.scrolltotop').fadeOut();            }        });$('.scrolltotop').click(function(){	$('html, body').animate({scrollTop : 0},2000);});$('#gal2').owlCarousel({    // loop:true,    addClassActive: false,    margin:10,    loop:false,    responsive:{        0:{            items:2,            nav:false        },        700:{            items:2,            nav:false        },             },    })$('#prev3').click(function(event) {  /* Act on the event */  $('#gal2').trigger('prev.owl')});$('#next3').click(function(event) {  /* Act on the event */  $('#gal2').trigger('next.owl')});$('.owl-carousel').owlCarousel({    // loop:true,    addClassActive: false,    responsive:{        0:{            items:1,            nav:true        },        600:{            items:2,            nav:true        },        1000:{            items:3,            nav:true,            loop:false        }    },})})</script>--> @endsection 