@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/pages/css/invoice-2.min.css')}}" rel="stylesheet" type="text/css" />


<link href="{{URL::asset('marketplace/productview/css/custom.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('marketplace/productview/css/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
<style>
.active img{width: 104px!important;}
.invoice-content-2{padding: 30px!important;}
</style>
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
            <span>View</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="invoice-content-2 bordered">
            <div class="product-details">
                
                    <div class="product-details-in">
                        <div class="row">
                          <div class="col-sm-12 col-md-6">
                            <div class="product-photos">
                            <div class="row">
                            	
                                @if(count($product->gallery) > 0)
                                    <div class="rel col-sm-3 col-xs-12">
                                    
                                    <div id="gal1" class="slideshow vertical  cycle-slideshow hidden-xs" 
                            data-cycle-fx="carousel"
                            data-cycle-timeout="0"
                            data-cycle-next="#next3"
                            data-cycle-prev="#prev3"
                            data-cycle-carousel-visible="5"
                            data-cycle-slides=".item"
                            data-cycle-carousel-vertical="true"> 
                            
                            
                            
                                    @foreach($product->gallery as $image)
                                    <a href="#" class="item" data-image="{{url()}}/public/marketplace/product/images/{{$image->path}}" data-zoom-image="{{url()}}/public/marketplace/product/images/{{$image->path}}"> <img  src="{{url()}}/public/marketplace/product/images/{{$image->path}}" width="104" height="71" /> </a> 
                                    @endforeach
                                    </div>
                                    
                                    
                                    
                            
                            
                                    <div id="gal2" class=" hidden-sm hidden-md hidden-lg visible-xs"> 
                            
                            
                                    @foreach($product->gallery as $image)
                                    <a href="#" class="item" data-image="{{url()}}/public/marketplace/product/images/{{$image->path}}" data-zoom-image="{{url()}}/public/marketplace/product/images/{{$image->path}}"> <img  src="{{url()}}/public/marketplace/product/images/{{$image->path}}" width="104" height="71" /> </a> 
                                    @endforeach
                                    </div>
                                    
                                                     
                                    
                                    
                                    
                                	<img src="{{url('marketplace/productview/image/icon_slider_toparrow.png')}}" alt="" class="top_arrow" id="prev3">
                                    <img src="{{url('marketplace/productview/image/icon_slider_bottomarrow.png')}}" alt="" class="bottom_arrow" id="next3">
                                    
                                    </div>
                                    
                                    <div class="rel col-sm-9" >
                                   	
                                        @foreach($product->gallery as $index=>$image)
                                            @if($index == 0)
                                            <img id="img_01" src="{{url()}}/public/marketplace/product/images/{{$image->path}}" data-zoom-image="{{url()}}/public/marketplace/product/images/{{$image->path}}"/>
                                            @endif
                                        @endforeach                    
                                       
                                    
                                    </div>
                                    @else
                                    <div class="rel col-sm-3 col-xs-12">&nbsp;</div>
                                    <div class="rel col-sm-9">
                                
                                    <img id="image-full" src="{{url('marketplace/product/images/placeholder_png.jpg')}}" style="width: 80%;"/>
                                
                            </div>
                                    @endif
                            </div>
            				
                                                
                            </div>
                          </div>
                          
                          <div class="col-sm-12 col-md-6">
                              <div class="product-info">
                                  <div class="product-info-line">
                                    <div class="row"><div class="col-xs-6"><span>Name:</span></div> <div class="col-xs-6"><span class="text-right">{{$product->name}}</span></div></div>
                                  </div>
                                  <div class="product-info-line">
                                    <div class="row"><div class="col-xs-6"><span>Brand Name:</span></div> <div class="col-xs-6"><span class="text-right">{{$product->brand_name}}</span></div></div>
                                  </div>
                                  <div class="product-info-line">
                                   <div class="row"><div class="col-xs-6"><span>Model Number:</span></div> <div class="col-xs-6"><span class="text-right">{{$product->model_number}}</span></div></div>
                                  
                                  </div>
                                  <div class="product-info-line">
                                  <div class="row"><div class="col-xs-6"><span>Condition:</span></div> <div class="col-xs-6"><span class="text-right">Used</span></div></div>
                                  
                                  </div>
                                  
                                  <div class="product-info-line">
                                  	<div class="row"><div class="col-xs-6"><span>Price:</span></div> <div class="col-xs-6"><span class="text-right">Starting at ${{number_format($product->price,'2','.',',')}}</span></div></div>
                                   
                                  </div>
                                  @if($sellerUser->id != Auth::user()->id )
                                  <div class="product-info-ftr">
                                  
                                    <a href="{{url('contactusers/contact/send')}}/{{Auth::user()->id}}/{{$sellerUser->id}}">Contact Seller</a>
                                  </div>
                                  @endif
                              </div>          
                          </div>
                        </div>
                    </div>
                    <div class="product-spec">
                      
                        <div class="product-spec-hdr">     
                              <div class="row">
                                <div class="col-sm-12">
                                  <h3>Specifications</h3>        
                                </div>
                              </div>        
                            </div>
                      
                      <div class="product-spec-info">
                           <div class="product-spec-in">
                              <div class="row">
                                <div class="col-sm-6">
                                        <div class="product-spec-infoline">
                                          <div class="product-spec-line">
                                          	<div class="row"><div class="col-xs-6 col-lg-4"><span>Place Of Origin:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$product->place_of_origin}}</span></div></div>
                                            
                                          </div>
                                          <div class="product-spec-line">
                                            <div class="row"><div class="col-xs-6 col-lg-4"><span>Condition:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$product->condition}}</span></div></div>
                                            
                                          </div>
                                          <div class="product-spec-line">
                                          	<div class="row"><div class="col-xs-6 col-lg-4"><span>Condition Quality:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$product->condition_quality}}</span></div></div>
                                           
                                          </div>
                                          <div class="product-spec-line">
                                          <div class="row"><div class="col-xs-6 col-lg-4"><span>Size:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$product->size}}</span></div></div>
                                           
                                          </div>
                                          <div class="product-spec-line">
                                           <div class="row"><div class="col-xs-6 col-lg-4"><span>Unit type:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$product->unit_type}}</span></div></div>
                                          </div>
                                            <div class="product-spec-line">
                                          <div class="row"><div class="col-xs-6 col-lg-4"><span>Supply ability:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$product->supply_ability}}</span></div></div>
                    
                                          </div>
                                          <div class="product-spec-line">
                                          <div class="row"><div class="col-xs-6 col-lg-4"><span>Package size:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$product->package_size}}</span></div></div>
                    
                                          </div>
                                          @if($product->attachment_path != '')
                                          <div class="product-info-ftr">
                                            <a href="{{url()}}/{{$product->attachment_path}}" class="bg" download>Download Pdf Specification <img src="{{url('marketplace/productview/image/icon_pdf.png')}}" alt=""></a>
                                          </div>
                                          @endif
                                      </div>      
                                </div> 
                    
                                <div class="col-sm-6">
                                        <div class="product-spec-infoline">
                                          
                                          <div class="product-spec-line">
                                          <div class="row"><div class="col-xs-6 col-lg-4"><span>Category:</span></div> <div class="col-xs-6 col-lg-8">
                                            <span class="text-right">
                                                @foreach($product->categories as $index=>$category)
                                                    @if($index == 0)
                                                    {{$category->category->name}}
                                                    @else
                                                    ,{{$category->category->name}}
                                                    @endif
                                                @endforeach
                                            </span></div></div>
                    
                                          </div>
                                          <div class="product-spec-line">
                                          <div class="row"><div class="col-xs-6 col-lg-4"><span>Industries:</span></div> 
                                            <div class="col-xs-6 col-lg-8">
                                                <span class="text-right">
                                                    @foreach($product->industries as $index=>$industry)
                                                    @if($index == 0)
                                                    {{$industry->industry->name}}
                                                    @else
                                                    ,{{$industry->industry->name}}
                                                    @endif
                                                @endforeach
                                                </span>
                                            </div></div>
                    
                                          </div>
                                          @if(!empty($product->specification))
                                            @foreach($product->specification as $label=>$options)
                                                <div class="product-spec-line">
                                                    <div class="row">
                                                    <div class="col-xs-6 col-lg-4"><span>{{$label}}:</span></div>
                                                    <div class="col-xs-6 col-lg-8"><span class="text-right">
                                                    @foreach($options as $index=>$opt)
                                                        @if($index == 0)
                                                        {{$opt}}
                                                        @else
                                                        ,{{$opt}}
                                                        @endif
                                                    @endforeach
                                                    </span></div>
                                                    </div>
                                                </div>
                                            @endforeach  
                                        @endif
                                          <div class="product-spec-line">
                                          <div class="row"><div class="col-xs-6 col-lg-4"><span>Discount percent:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$product->discount_percent}}</span></div></div>
                    
                                          </div>
                                           
                                          <div class="product-spec-line">
                                            <div class="row"><div class="col-xs-6 col-lg-4"><span>Certification:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$product->certification}}</span></div></div>
                    
                                          </div>                  
                    
                                          <div class="product-info-ftr">
                                            <a href="" class="sm">Share</a>
                                          </div>                      
                                      </div>         
                    
                                
                    
                              </div>
                           </div>
                         </div>
                      
                      </div>
                      <!--Product spec info ends-->  
                    
                    </div>
                    <!--Product spec ends-->
                    
                    <div class="product-dscp">
                      
                        <div class="product-dscp-hdr">     
                              <div class="row">
                                <div class="col-sm-12">
                                  <h3>Description</h3>        
                                </div>
                              </div>        
                            </div>
                       
                    
                        
                        
                      <div class="product-dscp-info">
                         
                           <div class="product-dscp-in">
                              <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                      {{$product->description}}                   
                                    </p>  
                                </div>           
                              </div>
                           </div>
                         
                      </div>
                      <!--Product spec info ends-->  
                    
                    </div>
                    <!--Product desc ends-->
                    
                    <div class="product-sellr">
                      
                        <div class="product-sellr-hdr">     
                              <div class="row">
                                <div class="col-sm-12">
                                  <h3>Seller Profile</h3>        
                                </div>
                              </div>        
                            </div>
                        
                    
                        
                        
                      <div class="product-sellr-info">
                         
                           <div class="product-sellr-in">
                              <div class="row">
                                <div class="col-sm-12 col-md-3">
                                    <div class="seller-lt">
                                      <div class="seller-lt-up">
                                        @if($sellerUser->userdetail->profile_picture != '')
                                        <img src="{{url('')}}/{{$sellerUser->userdetail->profile_picture}}"> 
                                        @else
                                        <img src="//www.gravatar.com/avatar/18051c749493cc76ad88dd94789cc74e?s=64">
                                        @endif
                                        @if($sellerUser->quotetek_verify == 1)<div class="checked"></div>@endif
                                      </div>
                                      <div class="seller-lt-bt">
                                          <p>Membership Level</p>
                                          <ul>
                                            <li><img src="{{url('marketplace/productview/image/Comment.png')}}" alt=""> {{$sellerUser->message_count}}</li>
                                            <li><img src="{{url('marketplace/productview/image/Heart.png')}}" alt=""> {{$sellerUser->endorse_count}}</li>
                                          </ul>
                                      </div>                  
                                    </div>
                                </div>           
                    
                                <div class="col-sm-12 col-md-9">
                                <div class="seller-rt">
                                    <div class="seller-rt-up">
                                      <div class="col-sm-12 col-md-7">
                                      <h4>{{$sellerUser->userdetail->first_name}} {{$sellerUser->userdetail->last_name}}</h4>                  
                                                       
                                    </div>
                    
                                    <div class="col-sm-12 col-md-5">
                                      <div class="seller-btn-group">
                                        @if($sellerUser->id != Auth::user()->id )
                                            <a href="{{url('contactusers/contact/send')}}/{{Auth::user()->id}}/{{$sellerUser->id}}">Add to Contact</a>
                                            <a href="{{url('endorse-user')}}/{{Auth::user()->id}}/{{$sellerUser->id}}">Endorse</a>
                                        @endif                             
                                                            
                                    </div>
                                    <!-- Seller btn btn-circle group ends -->
                                    </div>
                                    <!-- Seller-rt-up ends-->
                    
                                    <div class="seller-rt-bt">
                                      <div class="col-sm-12">
                                      
                                        <p>
                                        {{$sellerUser->userdetail->about}}
                                        </p>
                                        
                                        <ul>
                                          <li><a href=""><img src="{{url('marketplace/productview/image/icon_location.png')}}" alt="">{{$sellerUser->userdetail->city}},{{$sellerUser->userdetail->state}},{{$sellerUser->userdetail->country}}</a></li>
                                          <li><a href=""><img src="{{url('marketplace/productview/image/icon_university.png')}}" alt="">
                                          
                                            @foreach($sellerUser->userEducationDetails as $index=>$educt)
                                                @if($index == 0)
                                                    {{$educt->degree}} - {{$educt->institute_name}}({{date('Y',strtotime($educt->date_received))}})
                                                @else
                                                    ,{{$educt->degree}} - {{$educt->institute_name}}({{date('Y',strtotime($educt->date_received))}})
                                                @endif
                                            @endforeach
                                          </a></li>
                                        </ul>
                    
                                      </div>
                                    </div>
                                    <!-- Seller-rt-up ends -->
                    
                                    </div>
                        
                    
                                  </div>
                                </div>
                    
                                <div class="clearfix"></div>
                    
                              </div>
                           </div>
                        
                      </div>
                      <!--Product spec info ends-->  
                    
                    </div>
                    <!--Product desc ends-->
                    @if($sellerUser->company->name != '')
                    <div class="company-prof">
                      
                        <div class="company-prof-hdr">     
                              <div class="row">
                                <div class="col-sm-12">
                                  <h3>Company Profile</h3>        
                                </div>
                              </div>        
                            </div>
                      
                      <div class="company-prof-info">
                         
                           <div class="company-prof-in">
                              <div class="row">
                                <div class="col-sm-12">
                                        <div class="company-prof-infoline">
                                          <div class="company-prof-line">
                                          <div class="row"><div class="col-xs-6 col-lg-4"><span>Name:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$sellerUser->company->name}}</span></div></div>
                                          
                                          </div>
                                          <div class="company-prof-line">
                                           <div class="row"><div class="col-xs-6 col-lg-4"><span>Email:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$sellerUser->company->email}}</span></div></div>
                                           
                                            <span></span> 
                                          </div>
                                          
                                          <div class="company-prof-line">
                                           <div class="row"><div class="col-xs-6 col-lg-4"><span>Accredations:</span></div> <div class="col-xs-6 col-lg-8">
                                            <span class="text-right">
                                                @foreach($sellerUser->company->accreditations as $index=>$accreditation)
                                                    @if($index == 0)
                                                    {{$accreditation->accreditation->name}}
                                                    @else
                                                    , {{$accreditation->accreditation->name}}
                                                    @endif
                                                @endforeach
                                            </span>
                                           </div></div>
                                           
                                          </div>
                                          
                                          
                    					  <div class="company-prof-line">
                    						<div class="row"><div class="col-xs-6 col-lg-4"><span>Number Of Employees:</span></div> <div class="col-xs-6 col-lg-8"><span class="text-right">{{$sellerUser->company->employees_count}}</span></div></div>
                    
                                          </div>
                    
                    							
                                      
                                      </div>      
                                </div> 
                    
                           </div>
                         </div>
                      
                      </div>
                      <!--Product spec info ends-->  
                    
                    </div>
                    <!--Product spec ends-->
                    @endif
                    <div class="more-product">
                      
                        <div class="more-product-hdr">     
                              <div class="row">
                                <div class="col-sm-12">
                                  <h3>More Items From This Seller</h3>        
                                </div>
                              </div>        
                            </div>
                        
                    
                      <div class="more-product-info">
                         <div class="container row">
                           <div class="more-product-in">
                            
                                <div class="col-sm-12" style="padding:0!important">
                                    <div class="owl-carousel">
                                        @if(count($sellerUser->products) > 0)
                                            @foreach($sellerUser->products as $sellProduct)
                                                
                                                <div class="item">
                                                    <div class="item-inner">
                                                      <div class="more-product-img">
                                                        @if(count($sellProduct->gallery) > 0)
                                                        @foreach($sellProduct->gallery as $index=>$image)
                                                            @if($index == 0)
                                                            <img src="{{url()}}/public/marketplace/product/images/{{$image->path}}" style="width: 297px!important;height: 201px!important;"/>
                                                            @endif
                                                        @endforeach
                                                        @else
                                                            <img src="{{url('images/placeholder_png.jpg')}}" alt="" style="width: 297px!important;height: 201px!important;">
                                                        @endif
                                                        
                                                      </div>  
                                                      
                                                       <div class="more-product-info">
                            							<div class="row">
                                                        <div class="col-xs-12">
                                                        <h3>{{$sellProduct->name}}</h3>                            
                                                        </div>
                            
                            							<div class="clearfix"></div>
                                                        <div class="col-xs-6">
                                                        <p><span>Price:</span></p>
                                                        </div>
                                                        <div class="col-xs-6">
                                                        	<p class="text-right">{{number_format($sellProduct->price,'2','.',',')}}$</p>
                                                        </div>
                                                        
                                                        <div class="clearfix"></div>
                                                        
                                                        <div class="col-xs-6">
                                                        <p><span>Condition:</span></p>
                                                        </div>
                                                        <div class="col-xs-6">
                                                        	<p class="text-right">{{$sellProduct->condition}}</p>
                                                        </div>
                                                        
                                                        <div class="clearfix"></div>
                                                        
                                                        <div class="col-xs-6">
                                                        <p><span>Brand Name:</span></p>
                                                        </div>
                                                        <div class="col-xs-6">
                                                        	<p class="text-right">{{$sellProduct->brand_name}}</p>
                                                        </div>
                                                        
                                                        <div class="clearfix"></div>
                                                        
                            							</div>
                                                      </div>
                                                      
                                                      <div class="product-ftr-info">
                                                      	<div class="products-btns">
                                                        	<a href="{{url('marketplaceproducts')}}/{{$sellProduct->id}}">View More Details</a>
                                                        </div>
                                                      </div>
                                                      
                                                    </div>
                                                  </div>
                                            @endforeach
                                        @else
                                            <p>Not More Product Available</p>
                                        @endif
                                    </div>
                                    <!--Owl carousel ends-->
                    
                                </div>           
                            
                           </div>
                         </div>
                      </div>
                      <!--More product info ends-->  
                    
                    </div>
                    <!--More product ends-->
                    
                    <div class="terms-dscp">
                      
                        <div class="terms-dscp-hdr">     
                              <div class="row">
                                <div class="col-sm-12">
                                  <h3>Terms & Shipping</h3>        
                                </div>
                              </div>        
                            </div>
                        
                          
                      <div class="terms-dscp-info">
                         
                           <div class="terms-dscp-in">
                              <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                        Free shipping:
                                        @if($product->free_shipping == 1)
                                            <b>Yes</b>
                                            @else
                                            <b>No</b>
                                            @endif
                                    </p>
                                    <p>
                                    Free shipping continents: 
                                        <b>
                                        @foreach($product->free_shipping_continents as $index=>$free_shipping_continents)
                                            @if($index == 0)
                                            {{$free_shipping_continents}}
                                            @else
                                            ,{{$free_shipping_continents}}
                                            @endif
                                        @endforeach
                                        </b>
                                    </p>
                                    <p>
                                        Shipping fee: {{$product->shipping_fee}}
                                    </p>
                                    <p>
                                        {{$product->shipping_terms}}
                                    </p>
                                </div>           
                              </div>
                           </div>
                         
                      </div>
                      <!--terms spec info ends-->  
                    
                    </div>
                    <!--terms desc ends-->
                    
                    <div class="terms-dscp">
                      
                        <div class="terms-dscp-hdr">     
                              <div class="row">
                                <div class="col-sm-12">
                                  <h3>Payment Terms</h3>        
                                </div>
                              </div>        
                            </div>
                        
                          
                      <div class="terms-dscp-info">
                         
                           <div class="terms-dscp-in">
                              <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                      {{$product->payment_terms}}                 
                                    </p>  
                                </div>           
                              </div>
                           </div>
                         
                      </div>
                      <!--terms spec info ends-->  
                    
                    </div>
                    <!--terms desc ends-->
                    
                    <div class="terms-dscp">
                      
                        <div class="terms-dscp-hdr">     
                              <div class="row">
                                <div class="col-sm-12">
                                  <h3>Return Plociy</h3>        
                                </div>
                              </div>        
                            </div>
                        
                          
                      <div class="terms-dscp-info">
                         
                           <div class="terms-dscp-in">
                              <div class="row">
                                <div class="col-sm-12">
                                    <p>
                                      {{$product->return_policy}}                 
                                    </p>  
                                </div>           
                              </div>
                           </div>
                         
                      </div>
                      <!--terms spec info ends-->  
                    
                    </div>
                    <!--terms desc ends-->
            </div>
            
        </div>
        
    </div>
</div>
<script>
/* for show menu active */
$("#marketplace-main-menu").addClass("active");
$('#marketplace-main-menu' ).click();
$('#marketplace-menu-arrow').addClass('open');
$('#marketplace-view-product-menu').addClass('active');
/* end menu active */
jQuery.noConflict();
jQuery(document).on("click", ".viewImage", function () {
    var src = $(this).data('src');
    jQuery('#imageViewer .modal-body #image').attr( "src",'');
    jQuery('#imageViewer .modal-body #image').attr( "src", src);
});
function showimage(imgsrc)
{
    //alert(imgsrc);
    //document.getElementById('image').src=imgsrc;
    jQuery('#image-full').attr('src',imgsrc);
    jQuery('#main-img-a').data('src',imgsrc);
}
</script>
<script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
<link href="{{URL::asset('marketplace/productview/')}}" rel="stylesheet" type="text/css" />
<script src="{{URL::asset('marketplace/productview/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('marketplace/productview/js/owl.carousel.js')}}"></script>
<script src="{{URL::asset('marketplace/productview/js/jquery.elevatezoom.js')}}"></script>
<script src="http://malsup.github.io/min/jquery.cycle2.min.js"></script>

<script src="http://malsup.github.io/min/jquery.cycle2.carousel.min.js"></script>
<script>

 setInterval(function(){
$('#img_01').each(function(index, el) {
 
 var a=$(this).attr('src')
 var b=a;
 

var dimg=$(this).attr('data-zoom-image')
 

$(this).attr('data-zoom-image',dimg)



$('.zoomWindowContainer div').css('background-image','url('+b+')');

$('#fancybox-img').attr('src',dimg)

});
 
  })
 

	

$(function(){


//initiate the plugin and pass the id of the div containing gallery images 
$("#img_01").elevateZoom({gallery:'gal1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: false}); 
$("#img_01").elevateZoom({gallery:'gal2', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon:false}); 


//pass the images to Fancybox 
$("#img_01").bind("click", function(e) { var ez = $('#img_01').data('elevateZoom');	
$.fancybox(ez.getGalleryList()); return false; }); 
	
var height = $( document ).height(); // returns height of HTML document

var scroll = (height/100)*50;
    // fade in #back-top

    $(window).scroll(function () {
            if ($(this).scrollTop() > scroll) {
				console.log("Bigger");
                $('.scrolltotop').fadeIn();
            } else {
				console.log("Not Bigger");
                $('.scrolltotop').fadeOut();
            }
        });


$('.scrolltotop').click(function(){
	$('html, body').animate({scrollTop : 0},2000);
});


$('#gal2').owlCarousel({
    // loop:true,
    addClassActive: false,
    margin:10,
    loop:false,
    responsive:{
        0:{
            items:2,
            nav:false

        },
        700:{
            items:2,
            nav:false
        },
         
    },


    

})

$('#prev3').click(function(event) {
  /* Act on the event */
  $('#gal2').trigger('prev.owl')
});


$('#next3').click(function(event) {
  /* Act on the event */
  $('#gal2').trigger('next.owl')
});

$('.owl-carousel').owlCarousel({
    // loop:true,
    addClassActive: false,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:2,
            nav:true
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        }
    },

})

})

</script>

@endsection
