@extends('buyer.app')

@section('content')
<style>
.bootstrap-tagsinput {
  width: 100% !important;
}
.main-lab{font-size: 15px!important;font-weight: bold;}
.select2-container{display: block!important;}
.ms-container{width: 90%!important;}
@media (min-width: 992px){
.col-md-2n {
    width: 20%!important;
}    
}
.margin-top{margin-top: 5px!important;}
.form-group{border-bottom: 1px solid #eef1f5!important;}
.fileinput{margin-bottom: 0px!important;}
.form-horizontal .form-group{margin-left: 15px!important;margin-right: 15px!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/typeahead/typeahead.css')}}" rel="stylesheet" type="text/css" />

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
            <span>POST A MARKET LISTING</span>
        </li>
    </ul>
</div>




<div class="col-md-12 main_box">
<div class="row">

<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-cart-plus bold color-black"></i> POST A MARKET LISTING
</h3>
</div>
</div>
<div class="row">
    <div class="col-md-12">
      
            <div class="portlet-body form" id="blockui_sample_1_portlet_body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <div class="mt-element-step">
                    <div class="row step-line">
                        <div id="company-first" class="col-md-6 mt-step-col first active">
                            <div class="mt-step-number bg-white">1</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Product Information</div>
                        </div>
                        <div id="company-second" class="col-md-6 mt-step-col last">
                            <div class="mt-step-number bg-white">2</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Upload Photos</div>
                        </div>
                    </div>
                </div>
                <div class="yellow-crusta-seprator"></div>
                <div class="col-md-12 font-red-mint padding-top" id="first-step-quote">
<h3 class="block align-left"><span style="font-size: 19px!important;">Complete this form and add your listing to the Indy John Market.</span></h3>
                   


                </div>
                <div class="col-md-12 padding-top" id="second-step-quote" style="display: none;">
                    <p class="caption-helper">Choose all Optional Selections that apply to you.</p>
                    
                </div>

                <!-- mayank edit on 6/8, we want a photo media manager, this does not work for our needs
                <div class="col-md-12" id="product-default-img">
                    <div id="company-logo" class="row">
                        <form action="{{url('marketplaceproduct/default/upload/image')}}" class="dropzone dropzone-file-area" id="my-dropzone" style="width:250px;">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <h4 class="">Product Default Image, Drop files here or click to upload</h4>
                        </form>
                    </div>
                </div>

-->
                <!-- BEGIN FORM-->
                {!! Form::open([
                'route' => 'marketplaceproducts.store',
                'class' => 'horizontal-form form-horizontal',
                'files' => true,
                'id' => 'req-form-marketplace'
                ]) !!}
                    <input type="hidden" name="company_id" class="form-control" value="{{$userData->company_id}}">
                    <input type="hidden" name="logo" id="logo">
                    <input type="hidden" name="user_id" class="form-control" value="{{$userData->user_id}}" >
                    <input type="hidden" name="account_type" class="form-control" value="{{$userData->account_type}}">
                    <input type="hidden" name="version" value="simple" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Posting Title:</label>
                            <div class="col-md-12 paddin-npt">
                                <input data-required="1" type="text" name="post_title" class="form-control" value="{{Request::old('post_title')}}" placeholder="Posting Title">
                                <span class="help-block margin-top">Name your Listing.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">Manufacturer Name:<span style="font-size: 14px;vertical-align: top; red"> (optional)</span></label>
                                <div class="col-md-12 paddin-npt">
                                    <input data-required="1" type="text" name="manufacturer_name" class="form-control" value="{{Request::old('manufacturer_name')}}" placeholder="Manufacturer Name">
                                    <span class="help-block margin-top">Enter the Product Manufacturer.</span>
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt padding-left">
                                <label class="col-md-12 paddin-npt">Product Model Number:<span style="font-size: 14px;vertical-align: top; red"> (optional)</span></label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="model_number" class="form-control" value="{{Request::old('model_number')}}" placeholder="Product Model Number">
                                    <span class="help-block margin-top">Enter the Model Number.</span>
                                </div>
                            </div>
                        </div>
			           <div class="form-group">

                            <label class="col-md-12 paddin-npt">Enter a Product-Category that fits this listing:</label>
                            <div class="col-md-12 paddin-npt">
                                <select id="select2-button-addons-single-input-group-sm" name="product_categories[]" class="form-control col-md-12 js-data-category-ajax" multiple></select>
                                <span class="help-block margin-top">Type and Select all that apply.</span>
                            </div>
                        </div>
	
						 <div class="form-group">
                            <label class="col-md-12 paddin-npt">Add item Specifications and Options to this listing:</label>
                            <input type="text" name="specification" value="" data-role="tagsinput" id="taginputin" placeholder="Type something and hit enter" />
                             <span class="help-block margin-top">Enter any techincal specifications or product options for the product.</span>
                            
                            <!--<div class="col-md-12 paddin-npt" id="blockui_sample_1_portlet_body">
                                <div id="optionsmain_1" class="col-md-12 paddin-npt padding-top">
                                    <div class="col-md-6"><input class="form-control" name="item[1][lable]" placeholder="Enter the Field Label" /></div>
                                    <div class="col-md-6">
                                        <div id="option_1_1" class="paddin-bottom option-div">
                                            <input name="item[1][option][1]" class="col-md-9 form-control option-inputs" placeholder="Enter the Value" />
                                            <a href="javascript:void(0)" id="addsub_1_2" onclick="addSubOption(id)" style="float: left;"><i class="fa fa-plus-circle"></i></a>
                                        </div>
                                        <div id="suboption_1">
                                        </div>
                                    </div>
                                </div>
                                <div id="opt-options">
                                </div>
                                <label class="col-md-12 paddin-npt"><a href="#" id="addmore_2" onclick="addMoreOption(id);return false"><i class="fa fa-plus-circle"></i>Add another Specification</a></label>
                            </div>-->
                            <span class="help-block margin-top"> </span>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">Condition of your Product:</label>
                                <div class="col-md-12 paddin-npt">
                                    <select name="condition" id="pro-condition" class="form-control margin-bottom" placeholder="Product Condition" onchange="showConditionQuality();">
                                        <option value="" ></option>
                                        @if(Request::old('condition') == 'new')
                                            <option value="new" selected="selected">New</option>
                                        @else
                                            @if(!Request::old('condition'))
                                            <option value="new" selected="">New</option>
                                            @endif
                                        @endif
                                        @if(Request::old('condition') == 'used')<option value="used" selected="selected">Used</option>@else<option value="used">Used</option>@endif
                                        @if(Request::old('condition') == 'refurbished')<option value="refurbished" selected="selected">Refurbished</option>@else<option value="refurbished">Refurbished</option>@endif
                                        @if(Request::old('condition') == 'other')<option value="other" selected="selected">Other</option>@else<option value="other">Other</option>@endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt padding-left">
                                <div id="product-condition" style="display: none;">
                                <label class="col-md-12 paddin-npt">Condition Quality of your Product:</label>
                                <div class="col-md-12 paddin-npt">
                                    <select name="condition_quality" class="form-control margin-bottom" placeholder="Condition of your Product">
                                        <option value="">Does Not Apply</option>
                                        @if(Request::old('condition_quality') == 'excellent')<option value="excellent" selected="selected">Excellent</option>@else<option value="excellent">Excellent</option>@endif
                                        @if(Request::old('condition_quality') == 'light usage')<option value="light usage" selected="selected">Light usage</option>@else<option value="light usage">Light usage</option>@endif
                                        @if(Request::old('condition_quality') == 'heavy usage')<option value="heavy usage" selected="selected">Heavy usage</option>@else<option value="heavy usage">Heavy usage</option>@endif
                                        @if(Request::old('condition_quality') == 'bad but working')<option value="bad but working" selected="selected">Bad but working</option>@else<option value="bad but working">Bad but working</option>@endif
                                        @if(Request::old('condition_quality') == 'for parts only')<option value="for parts only" selected="selected">For parts only</option>@else<option value="for parts only">For parts only</option>@endif
                                    </select>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Requested Price:</label>
                            <div class="col-md-12 paddin-npt">
                                <input type="number" name="price" class="form-control" value="{{Request::old('price')}}" placeholder="Requested Price">
                                <span class="help-block margin-top">Enter the Requested Price.</span>
                            </div>
                        </div>


                        
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Applicable Industries:</label>
                            <div class="col-md-12 paddin-npt">
                                <select id="industry-select" name="product_industries[]" class="form-control selectIndustry" id="indutries-dropdown" multiple>
                                    @if(Request::old('industries'))
                                        @if(in_array('all',Request::old('industries')))
                                        <option value="all" selected="">ALL Industries</option>
                                        @else
                                        <option value="all">ALL Industries</option>
                                        @endif
                                    @else
                                        <option value="all">ALL Industries</option>
                                    @endif
                                    @foreach($industries as $industry)
                                        @if(Request::old('product_industries'))
                                            @if(in_array($industry->id,Request::old('product_industries')))
                                                <option value="{{$industry->id}}" selected="">{{$industry->name}}</option>
                                            @else
                                                <option value="{{$industry->id}}">{{$industry->name}}</option>
                                            @endif
                                        @else
                                            <option value="{{$industry->id}}">{{$industry->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="help-block margin-top">Type and Select industries applicable to this product listing.</span>
                            </div>
                        </div>
                     


                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Add a Description or Notes to your listing:</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea name="description" class="form-control" placeholder="Description / Miscellaneous Notes">{{Request::old('description')}}</textarea>
                                <span class="help-block margin-top">Include all additional information here.</span>
                            </div>
                        </div>
<div class="col-md-12">
                        <h3 class="block font-red-mint align-left"><span style="font-size: 19px!important;">Add Optional Product Details to your listing:</span></h3>
</div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Upload a Specifications File:</label>
                            <div class="col-md-12 paddin-npt">
                                <div class="fileinput fileinput-new col-md-12" data-provides="fileinput">
                                <div class="row">
                                    <div class="input-group input-large">
                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                            <span class="fileinput-filename"> </span>
                                        </div>
                                        <span class="input-group-addon btn btn-danger btn-circle  btn-file" style="display:table-cell !important;">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file"  name="attachment_path" > </span>
                                        <a href="javascript:;" class="input-group btn btn-danger bold fileinput-exists" data-dismiss="fileinput">X</a>
                                    </div>
                                    </div>
                                </div>
                                <span class="help-block margin-top">Upload a PDF/Word/Excel file.</span>
                            </div>
                        </div>
					
					
	
					
					   <div class="form-group">
                            <label class="col-md-12 paddin-npt">Product Certifications:</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea name="certification" class="form-control" placeholder="Does this product have any Certification? Enter them here seperated with a comma.">{{Request::old('certification')}}</textarea>
                                <span class="help-block margin-top">Add any product certification details.</span>
                            </div>
                        </div>
					
                 
					
					 
					     <div class="form-group">
                            <label class="col-md-12 paddin-npt">Physical Dimensions:</label>
                            <div class="col-md-12 paddin-npt">
                                <input type="text" name="size" class="form-control" value="{{Request::old('size')}}" placeholder="Physical Dimensions">
                                <span class="help-block margin-top">Enter the Product Physical Dimensions.</span>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 paddin-npt">
                                <label class="col-md-6 paddin-npt">Product Location:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="product_location" id="autocomplete" class="form-control" onFocus="geolocate()" value="@if(Request::old('product_location')) {{Request::old('product_location')}} @else @if($userData->city != '') {{$userData->city}},{{$userData->state}},{{$userData->country}} @endif @endif"  placeholder="Type to Search" >
                                    <span class="help-block margin-top">What is the current product location.</span>
                                </div>
                            </div>
                        </div>
					    <div class="form-group">
                            <div class="col-md-12 paddin-npt">
                                <label class="col-md-6 paddin-npt">Product Origin:<span style="font-size: 14px;vertical-align: top; red"> (optional)</span></label>
                                <div class="col-md-12 paddin-npt">
                                    <input id="country" type="country" type="text" name="place_of_origin" value="{{Request::old('place_of_origin')}}" class="form-control" placeholder="Product Origin">
                                    <span class="help-block margin-top">Where is the Product originated from</span>
                                </div>
                            </div>
                        </div>
					  
					  	   
                        <!-- edited by mayank on 6/8 as we don't need shipping and payment on products right now 

                        <h3 class="block align-left"><span style="font-size: 19px!important;">Shipping & Returns</span></h3>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Return Policy</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea name="return_policy" class="form-control" placeholder="Return Policy">{{$default->return_policy}}</textarea>
                                <span class="help-block">Enter your return policy.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Payment Terms</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea name="payment_terms" class="form-control" placeholder="Payment Terms">{{$default->payment_terms}}</textarea>
                                <span class="help-block">Enter your Specific Payment Terms. For example "Net 30, Due on Delivery</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Payment forms accepted</label>
                            <div class="col-md-2 paddin-npt">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('Credit Cards',$default->payment_accepted)) checked="checked" @endif class="form-control checkbox" value="Credit Cards" /> Credit Cards
                            </div>
                            <div class="col-md-2 paddin-npt">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('Bank Transfer',$default->payment_accepted)) checked="checked" @endif class="form-control checkbox" value="Bank Transfer" /> Bank Transfer
                            </div>
                            <div class="col-md-2 paddin-npt">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('Online Payments/Paypal',$default->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Online Payments/Paypal" /> Online Payments/Paypal
                            </div>
                            <div class="col-md-2 paddin-npt">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('Cheque',$default->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Cheque" /> Cheque
                            </div>
                            <div class="col-md-2 paddin-npt">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('COD',$default->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="COD" /> COD
                            </div>
                            <div class="col-md-2 paddin-npt">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('Other',$default->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Other" /> Other
                            </div>
                            <span class="help-block col-md-12">Select acceptable Payment options.</span>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Shipping terms</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea name="shipping_terms" class="form-control" placeholder="Shipping terms">{{$default->shipping_terms}}</textarea>
                                <span>Enter any Shipping Information applicable.</span>
                            </div>
                        </div>
                        -->
                        <div class="col-md-12">
                        <h3 class="block font-red-mint align-left">
                            <span style="font-size: 19px!important;">Do you have multiple items available?</span> 
                            <input name="multi_select_items" id="multi-select-items" @if(Request::old('multi_select_items')== "on") checked="" @endif  type="checkbox" data-on-text="Yes" data-off-text="No" class="make-switch form-control" data-size="small">
                        </h3>
                        </div>
                        <div id="multi-items" style="display: none;">
                            <div class="form-group">
                                <div class="col-md-6 paddin-npt">
                                    <label class="col-md-12 paddin-npt">Quantity Available for Sale:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="number" name="quantity_available" value="{{Request::old('quantity_available')}}" class="form-control" placeholder="Quantity Available for Sale">
                                        <span class="help-block margin-top">Enter the quantity available for sale.</span>
                                    </div>
                                </div>
                                <div class="col-md-6 paddin-npt padding-left">
                                    <label class="col-md-12 paddin-npt">Minimum Order Requirement:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="number" name="minimum_quantity" value="{{Request::old('minimum_quantity')}}" class="form-control" placeholder="Minimum Order Requirement">
                                        <span class="help-block margin-top">Enter the Minimum Order Requirement..</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Discount Available:</label>
                                <div class="col-md-12 paddin-npt">
                                    <textarea name="discount_percent" class="form-control" placeholder="Discount Available">{{Request::old('discount_percent')}}</textarea>
                                    <span class="help-block margin-top">Enter Specific Discount details.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Fulfillment Capability:</label>
                                <div class="col-md-12 paddin-npt">
                                    <textarea name="supply_ability" class="form-control" placeholder="Enter your Fulfillment Capability">{{Request::old('supply_ability')}}</textarea>
                                </div>
                            </div>
                        </div>
                             
                    </div>
                    <div class="form-actions right">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle yellow-crusta color-black bold"> <i class="fa fa-check"></i>Continue to Photo Center</button>
                            </div>
                        </div>
                    </div>
                    <!--<div class="form-actions right">
                        <a href="{{ URL::to('request-product-quotes') }}" class="btn btn-circle btn-sm">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle blue">
                            <i class="fa fa-check"></i> Start Request</button>
                    </div>-->
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
    </div>
</div>
<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6bkZqMRGyPwECqAnwqQapOX94md7Y9UY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        premise: 'long_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    $('#autocomplete').keypress(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});
        //console.log("aaa");
        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();


        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        var productLocation = '';
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                if(addressType == 'country'){
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }

                if(addressType == 'locality'){
                    productLocation+= place.address_components[i][componentForm[addressType]]+',';
                }

                if(addressType == 'administrative_area_level_1'){
                    productLocation+= place.address_components[i][componentForm[addressType]]+',';
                }

                if(addressType == 'country'){
                    productLocation+= place.address_components[i][componentForm[addressType]]+',';
                }
            }
        }

        document.getElementById('productLocation').value = productLocation;
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }else{
            console.log('not defined.');
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiDNVH3xsDq4YPf8dMkHBzXrH17wF_JZw&libraries=places&callback=initAutocomplete"async defer></script>
<script>
/* for show menu active */
$("#marketplace-main-menu").addClass("active");
$('#marketplace-main-menu' ).click();
$('#marketplace-menu-arrow').addClass('open')
$('#marketplace-create-product-menu').addClass('active');
/* end menu active */

jQuery(document).ready(function() {
    
    $('#diversity_options').multiSelect();
    
    var placeholder = "Type and Select one or more applicable industries.";
    $(".selectIndustry").select2({
            placeholder: placeholder,
            width: null
        });
    var cond_val = "{{Request::old('condition')}}"
    if(cond_val == 'new' || cond_val == '')
    {
        $('#product-condition').hide();
    }
    else
    {
        $('#product-condition').show();
    }
    
    var multi_sel = "{{Request::old('multi_select_items')}}";
    if(multi_sel == 'on')
    {
        $('#multi-items').show();
    }
    
     var citynames = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: {
        url: "{{url('tech/specification/options')}}",
        filter: function(list) {
          return $.map(list, function(cityname) {
            return { name: cityname }; });
        }
      }
    });
    citynames.initialize();
    
    $('#taginputin').tagsinput({
      typeaheadjs: {
        name: 'citynames',
        displayKey: 'name',
        valueKey: 'name',
        source: citynames.ttAdapter()
      }
    }); 
    
});

$('input[name="multi_select_items"]').on('switchChange.bootstrapSwitch', function(event, state) {
  //console.log(state); // true | false
  if(state === true)
  {
    $('#multi-items').show();
    
  }
  else
  {
    $('#multi-items').hide();
  }
});

function showConditionQuality()
{
    var condition_value = $('#pro-condition').val();
    if(condition_value == 'new' || condition_value == '')
    {
        $('#product-condition').hide();
    }
    else
    {
        $('#product-condition').show();
    }
}

function addMoreOption(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    var baseurl = "{{url('marketplaceproducts/product/addOption')}}"+'/'+divId;
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    
    jQuery.ajax({
        url: baseurl,
        type: 'get',
        success: function(data) {
                    var element = document.getElementById("opt-options");
                    $( "#opt-options" ).append(data.html);
                    var newId = 'addmore_'+data.next_id;
                    $('#'+id).attr("id",newId);
                    App.unblockUI('#blockui_sample_1_portlet_body');
                 },
        done: function() {
            //console.log('error');
            App.unblockUI('#blockui_sample_1_portlet_body');
        },
        error: function() {
            //console.log('error');
            App.unblockUI('#blockui_sample_1_portlet_body');
        }
        
    }); 
}
function addSubOption(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var maindivId = allIds[1];
    var divId = allIds[2];
    var baseurl = "{{url('marketplaceproducts/product/addSubOption')}}"+'/'+maindivId+'/'+divId;
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    
    jQuery.ajax({
        url: baseurl,
        type: 'get',
        success: function(data) {
                    var element = document.getElementById("#suboption_"+maindivId);
                    $( "#suboption_"+maindivId ).append(data.html);
                    var newId = 'addsub_'+maindivId+'_'+data.next_id;
                    $('#'+id).attr("id",newId);
                    App.unblockUI('#blockui_sample_1_portlet_body');
                 },
        done: function() {
            //console.log('error');
            App.unblockUI('#blockui_sample_1_portlet_body');
        },
        error: function() {
            //console.log('error');
            App.unblockUI('#blockui_sample_1_portlet_body');
        }
        
    }); 
}
function removeSubOption(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var maindivId = allIds[1];
    var divId = allIds[2];
    $('#option_'+maindivId+'_'+divId).html('');
    $('#option_'+maindivId+'_'+divId).hide();
}
function removeMainOption(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    $('#optionsmain_'+divId).html('');
    $('#optionsmain_'+divId).hide();
}



$('#industry-select').on('change',function(){
   console.log($('#industry-select').val());
   var industries = $('#industry-select').val();
   if(industries != null)
   {
        if(industries[0] == 'all')
       {
            $('#industry-select option').prop('selected', true);;
       } 
   }
   
});



function formatRepo(repo) {
    if (repo.loading) return repo.text;

    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.full_name +"</div>";
    
    markup += "</div></div>";

    return markup;
}

function formatRepoSelection(repo) {
    return repo.full_name || repo.text;
}
var placeholder_category = 'Type and Select all that apply';
$(".js-data-category-ajax").select2({
    placeholder: placeholder_category,
    width: "off",
    ajax: {
        url: "{{url()}}/marketplaceproducts/info/category/search",
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function(data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
                results: data.items
            };
        },
        cache: true
    },
    escapeMarkup: function(markup) {
        return markup;
    }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});
$(".js-data-industry-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/marketplaceproducts/info/industry/search",
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function(data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
                results: data.items
            };
        },
        cache: true
    },
    escapeMarkup: function(markup) {
        return markup;
    }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});
$(".select2, .select2-multiple, .select2-allow-clear, .js-data-example-ajax").on("select2:open", function() {
            if ($(this).parents("[class*='has-']").length) {
                var classNames = $(this).parents("[class*='has-']")[0].className.split(/\s+/);

                for (var i = 0; i < classNames.length; ++i) {
                    if (classNames[i].match("has-")) {
                        $("body > .select2-container").addClass(classNames[i]);
                    }
                }
            }
        });

        $(".js-btn-set-scaling-classes").on("click", function() {
            $("#select2-multiple-input-sm, #select2-single-input-sm").next(".select2-container--bootstrap").addClass("input-sm");
            $("#select2-multiple-input-lg, #select2-single-input-lg").next(".select2-container--bootstrap").addClass("input-lg");
            $(this).removeClass("btn-primary btn-outline").prop("disabled", true);
        });
</script>
<script>
function postForm()
{
    $('#req-form-marketplace').submit();
}
$('.button-next').click(function(){
    $('#post-request').hide();
    $('#first-step-quote').hide();
    $('#product-default-img').hide();
    $('#second-step-quote').show();
});
$('.button-previous').click(function(){
    $('#post-request').show();
    $('#first-step-quote').show();
    $('#product-default-img').show();
    $('#second-step-quote').hide();
});


</script>

<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}" type="text/javascript"></script>


@endsection
