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
            <span>Edit Product</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-crusta color-black" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-edit color-black"></i>Edit {{$product->name}}</div>
                <div class="actions">
                    <a href="{{ URL::to('marketplaceproducts/info/') }}/{{$product->id}}" class="btn btn-circle  color-black btn-sm">
                        <i class="fa fa-pencil color-black"></i> Edit Other Info </a>
                </div>
            </div>

            <div class="portlet-body form" id="blockui_sample_1_portlet_body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <div class="col-md-12 padding-top" id="first-step-quote">
                    <p class="caption-helper">Complete this form to add your Product to the Market.</p>
                    <p>Indy John does not handle order management and payments at this time. We're working on it... Meanwhile, you can add the following optional details to your listing.</p>
                </div>
                <div class="col-md-12 padding-top" id="second-step-quote" style="display: none;">
                    <p class="caption-helper">Choose all Optional Selections that apply to you.</p>
                    <p>Indy John does not handle order management and payments at this time. We're working on it... Meanwhile, you can add the following optional details to your listing.</p>
                </div>
                
                <!-- BEGIN FORM-->
                {!! Form::model($product, [
                'method' => 'PATCH',
                'id' => 'submit-form',
                'route' => ['marketplaceproducts.update', $product->id],
                'class' => 'horizontal-form form-horizontal',
                'files' => true,
                'id' => 'req-form-marketplace'
                ]) !!}
                    <input type="hidden" name="account_type" class="form-control" value="{{$userData->account_type}}">
                    <input type="hidden" name="user_id" class="form-control" value="{{$userData->user_id}}" >
                    <input type="hidden" name="company_id" class="form-control" value="{{$userData->company_id}}">
                <div class="form-wizard">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps" style="display: none;">
                            <li>
                                <a href="#tab1" data-toggle="tab" class="step">
                                    <span class="number"> 1 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Step 1: Required </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab" class="step">
                                    <span class="number"> 2 </span>
                                    <span class="desc">
                                        <i class="fa fa-check"></i> Step 2: Optional </span>
                                </a>
                            </li>
                           
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar" style="display: none;">
                            <div class="progress-bar progress-bar-success"> </div>
                        </div>
                        <div class="tab-content">
                            <div class="alert alert-danger display-none">
                                <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                            <div class="alert alert-success display-none">
                                <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                            <div class="tab-pane active" id="tab1">
                                
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Posting Title:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input data-required="1" type="text" name="post_title" class="form-control" value="{{$product->name}}" placeholder="Posting Title">
                                        <span class="help-block margin-top">Name your Listing.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 paddin-npt">
                                        <label class="col-md-12 paddin-npt">Manufacturer Name:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <input data-required="1" type="text" name="manufacturer_name" class="form-control" value="{{$product->brand_name}}" placeholder="Manufacturer Name">
                                            <span class="help-block margin-top">Enter the Product Manufacturer.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 paddin-npt padding-left">
                                        <label class="col-md-12 paddin-npt">Product Model Number:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <input type="text" name="model_number" class="form-control" value="{{$product->model_number}}" placeholder="Product Model Number">
                                            <span class="help-block margin-top">Enter the Model Number.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 paddin-npt">
                                        <label class="col-md-12 paddin-npt">Product Quality:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <select name="condition" class="form-control margin-bottom" placeholder="Product Condition">
                                                <option value="">Does Not Apply</option>
                                                @if($product->condition == 'new')<option value="new" selected="selected">New</option>@else<option value="new" selected="selected">New</option>@endif
                                                @if($product->condition == 'used')<option value="used" selected="selected">Used</option>@else<option value="used">Used</option>@endif
                                                @if($product->condition == 'refurbished')<option value="refurbished" selected="selected">Refurbished</option>@else<option value="refurbished">Refurbished</option>@endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 paddin-npt padding-left">
                                        <label class="col-md-12 paddin-npt">Condition quality:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <select name="condition_quality" class="form-control margin-bottom" placeholder="Condition quality">
                                                <option value="">Does Not Apply</option>
                                                @if($product->condition_quality == 'excellent')<option value="excellent" selected="selected">Excellent</option>@else<option value="excellent">Excellent</option>@endif
                                                @if($product->condition_quality == 'light usage')<option value="light usage" selected="selected">Light usage</option>@else<option value="light usage">Light usage</option>@endif
                                                @if($product->condition_quality == 'heavy usage')<option value="heavy usage" selected="selected">Heavy usage</option>@else<option value="heavy usage">Heavy usage</option>@endif
                                                @if($product->condition_quality == 'bad but working')<option value="bad but working" selected="selected">Bad but working</option>@else<option value="bad but working">Bad but working</option>@endif
                                                @if($product->condition_quality == 'for parts only')<option value="for parts only" selected="selected">For parts only</option>@else<option value="for parts only">For parts only</option>@endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Select Product Type/Category:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select id="select2-button-addons-single-input-group-sm" name="product_categories[]" class="form-control col-md-12 js-data-category-ajax" multiple>
                                            @foreach($product->categories as $index=>$category)
                                            <option value="{{$category->category->id}}" selected="">{{$category->category->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block margin-top">Select all that apply.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Applicable Industries:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select id="industry-select" name="product_industries[]" class="form-control selectIndustry" id="indutries-dropdown" multiple>
                                            <option value="all">ALL Industries</option>
                                            @foreach($industries as $industry)
                                                @if(in_array($industry->id,$selecteIndustrie))
                                                    <option value="{{$industry->id}}" selected="">{{$industry->name}}</option>
                                                @else
                                                    <option value="{{$industry->id}}">{{$industry->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="help-block margin-top">Filter the Suppliers to your specific industry.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Physical Dimensions:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="text" name="size" class="form-control" value="{{$product->size}}" placeholder="Physical Dimensions">
                                        <span class="help-block margin-top">Enter the Product Physical Dimensions.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Description / Miscellaneous Notes:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <textarea name="description" class="form-control" placeholder="Description / Miscellaneous Notes">{{$product->description}}</textarea>
                                        <span class="help-block margin-top">Include all additional information here.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 paddin-npt">
                                        <label class="col-md-12 paddin-npt">Upload a File:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <div class="">
                                                <a href="{{url()}}/{{$product->attachment_path}}" download>Product PDF</a>
                                                <a href="javascript:void(0)" onclick="showPdfSelect()" class="btn btn-circle btn-sm">Change Pdf</a>
                                                <!--<a href="javascript:void(0)" id="hide-pdf-selecte" onclick="hidePdfSelect()" class="btn btn-circle btn-sm" style="display: none;">Cancel</a>-->
                                            </div>
                                            <div id="pdf-select" class="" style="display: none;padding-top: 10px;">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"> </span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-circle default btn-file">
                                                        <span class="fileinput-new"> Select file </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" data-required="1" name="attachment_path" > </span>
                                                    <a href="javascript:;" class="input-group btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                            <span class="help-block margin-top">Upload PDF/Word/Excel file.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 paddin-npt padding-left">
                                        <label class="col-md-12 paddin-npt">Requested Price:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <input type="text" name="price" class="form-control" value="{{$product->price}}" placeholder="Requested Price">
                                            <span class="help-block margin-top">Enter the Product Physical Dimensions.</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Additional Technical Specifications & Features:</label>
                                    <div class="col-md-12 paddin-npt" id="blockui_sample_1_portlet_body">
                                        @if(!empty($product->specification))
                                            @foreach($product->specification as $index=>$options)
                                                <div id="optionsmain_{{$index+1}}" class="col-md-6 paddin-npt padding-top">
                                                    <div class="col-md-6"><input class="form-control" name="item[{{$index+1}}][lable]" value="{{$options['label']}}" value="" placeholder="Option Label" /></div>
                                                    <div class="col-md-6">
                                                        @foreach($options['options'] as $opt_index=>$opt)
                                                        <div id="option_{{$index+1}}_{{$opt_index+1}}" class="paddin-bottom option-div">
                                                            <input name="item[{{$index+1}}][option][{{$opt_index+1}}]" class="col-md-9 form-control option-inputs" value="{{$opt}}" placeholder="Option Value" />
                                                            @if($opt_index == 0)
                                                            <a href="javascript:void(0)" id="addsub_{{$index+1}}_{{count($options['options'])+1}}" onclick="addSubOption(id)" style="float: left;"><i class="fa fa-plus-circle"></i></a>
                                                            @else
                                                            <a href="javascript:void(0)" style="float: left;" id="remove_{{$index+1}}_{{$opt_index+1}}" onclick="removeSubOption(id)"><i class="fa fa-remove font-red"></i></a>
                                                            @endif
                                                        </div>
                                                        @endforeach
                                                        <div id="suboption_{{$index+1}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                        <div id="optionsmain_1" class="col-md-6 paddin-npt padding-top">
                                            <div class="col-md-6"><input class="form-control" name="item[1][lable]" placeholder="Option Label" /></div>
                                            <div class="col-md-6">
                                                <div id="option_1_1" class="paddin-bottom option-div">
                                                    <input name="item[1][option][1]" class="col-md-9 form-control option-inputs" placeholder="Option Value" />
                                                    <a href="javascript:void(0)" id="addsub_1_2" onclick="addSubOption(id)" style="float: left;"><i class="fa fa-plus-circle"></i></a>
                                                </div>
                                                <div id="suboption_1">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div id="opt-options">
                                        </div>
                                        <label class="col-md-12"><a href="#" id="addmore_{{$product->options_count+1}}" onclick="addMoreOption(id);return false"><i class="fa fa-plus-circle"></i>Add another Row</a></label>
                                    </div>
                                    <span class="help-block margin-top">Add additional specifications and features in a grid format by adding values</span>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 paddin-npt">
                                        <label class="col-md-6 paddin-npt">Search Address:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <input type="text" id="autocomplete" class="form-control" onFocus="geolocate()" value="{{$product->location_city}}"  placeholder="Type to Search" >
                                            <span class="help-block margin-top">What is the current product location.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 paddin-npt">
                                        <label class="col-md-12 paddin-npt">Product Origin:<span style="font-size: 14px;vertical-align: top; red"> (optional)</span></label>
                                        <div class="col-md-12 paddin-npt">
                                            <input id="country" type="text" name="place_of_origin" value="{{$product->place_of_origin}}" class="form-control" placeholder="Product Origin">
                                            <span class="help-block margin-top">Where is the originated from</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Product Certifications:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <textarea name="certification" class="form-control" placeholder="Product Certifications">{{$product->certification}}</textarea>
                                        <span class="help-block margin-top">add any product certification details.</span>
                                    </div>
                                </div>
                                <h3 class="block align-left"><span style="font-size: 19px!important;">Shipping & Returns</span></h3>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Return Policy</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="text" name="return_policy" value="{{$product->return_policy}}" class="form-control" placeholder="Return Policy">
                                        <span class="help-block">Enter your return policy.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Payment Terms</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="text" name="payment_terms" value="{{$product->payment_terms}}" class="form-control" placeholder="Payment Terms">
                                        <span class="help-block">Enter your Specific Payment Terms. For example "Net 30, Due on Delivery</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Payment forms accepted</label>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]" @if(in_array('Credit Cards',$product->payment_accepted)) checked="checked" @endif class="form-control checkbox" value="Credit Cards" /> Credit Cards
                                    </div>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]" @if(in_array('Bank Transfer',$product->payment_accepted)) checked="checked" @endif class="form-control checkbox" value="Bank Transfer" /> Bank Transfer
                                    </div>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]" @if(in_array('Online Payments/Paypal',$product->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Online Payments/Paypal" /> Online Payments/Paypal
                                    </div>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]" @if(in_array('Cheque',$product->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Cheque" /> Cheque
                                    </div>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]" @if(in_array('COD',$product->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="COD" /> COD
                                    </div>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]" @if(in_array('Other',$product->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Other" /> Other
                                    </div>
                                    <span class="help-block col-md-12">Select acceptable Payment options.</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Shipping terms</label>
                                    <div class="col-md-12 paddin-npt">
                                        <textarea name="shipping_terms" class="form-control" placeholder="Shipping terms">{{$product->shipping_terms}}</textarea>
                                        <span>Enter any Shipping Information applicable.</span>
                                    </div>
                                </div>
                                <h3 class="block align-left"><span style="font-size: 19px!important;">Do you have more than one to sell?</span></h3>
                                <div class="form-group">
                                    <div class="col-md-6 paddin-npt">
                                        <label class="col-md-12 paddin-npt">Quantity Available for Sale:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <input type="text" name="quantity_available" value="{{$product->quantity_available}}" class="form-control" placeholder="Quantity Available for Sale">
                                            <span class="help-block margin-top">Enter the quantity available for sale.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 paddin-npt padding-left">
                                        <label class="col-md-12 paddin-npt">Minimum Order Requirement:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <input type="text" name="minimum_quantity" value="{{$product->minimum_quantity}}" class="form-control" placeholder="Minimum Order Requirement">
                                            <span class="help-block margin-top">Enter the Minimum Order Reuqirement.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Discount Available:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <textarea name="discount_percent" class="form-control" placeholder="Discount Available">{{$product->discount_percent}}</textarea>
                                        <span class="help-block margin-top">Enter Specific Discount details.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Fulfillment Capability:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <textarea name="supply_ability" class="form-control" placeholder="Fulfillment Capability">{{$product->supply_ability}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="javascript:;" class="btn btn-circle default button-previous">
                                    <i class="fa fa-angle-left"></i> Back to Required Fields </a>
                                
                                <a href="javascript:;" class="btn btn-circle blue button-next"> View Additional Options
                                    <i class="fa fa-angle-right"></i>
                                </a>
                                <a href="javascript:;" id="post-request" class="btn btn-circle yellow-crusta color-black bold" onclick="postForm();"> <i class="fa fa-check"></i> Submit Request</a>
                                <button type="submit" class="btn btn-circle btn-circle yellow-crusta color-black bold"> <i class="fa fa-check"></i> Submit Request</button>
                            </div>
                        </div>
                    </div>
                    <!--<div class="form-actions right">
                        <a href="{{ URL::to('request-product-quotes') }}" class="btn btn-circle btn-sm">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle blue">
                            <i class="fa fa-check"></i> Start Request</button>
                    </div>-->
                </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
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

function showPdfSelect()
{
    $('#pdf-select').show();
    $('#hide-pdf-selecte').show();
}
function hidePdfSelect()
{
    $('#pdf-select').hide();
    $('#hide-pdf-selecte').hide();
    $('#attachment_pdf').val('');
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

var FormDropzone = function () {
    return {
        //main function to initiate the module
        init: function () {

            Dropzone.options.myDropzone = {
                dictDefaultMessage: "",
                serverFileName : "",
                init: function() {
                    this.on("addedfile", function(file) {
                        console.log('asd');
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn btn-danger btn-sm btn-block'>Remove</a>");

                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                            // Make sure the button click doesn't submit the form:
                            e.preventDefault();
                            e.stopPropagation();

                            // Remove the file preview.
                            _this.removeFile(file);
                            //Ajax request to remove file on server.

                            $.ajax({
                                url: "removeFile/file/"+_this.serverFileName,
                                cache: false
                            }).done(function( json ) {
                                    $('#logo').val(null);
                                });
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });
                },

                success: function(file, response){
                    this.serverFileName = response.fileName;
                    $('#logo').val(response.fileName);
                },

                error: function(file, response){
                    alert('Invalid File');
                }
            }
        }
    };
}();

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
$(".js-data-category-ajax").select2({
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

var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                width: 'auto', 
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            

            var displayConfirm = function() {
                $('#tab2 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function(){ 
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    
                    success.hide();
                    error.hide();
                    
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    
                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function () {
                //alert('Finished! Hope you like it :)');
            }).hide();

            
        }

    };

}();

jQuery(document).ready(function() {
    FormDropzone.init();
    FormWizard.init();
    $('#diversity_options').multiSelect();
    
    var placeholder = "Type and Select one or more applicable industries.";
    $(".selectIndustry").select2({
            placeholder: placeholder,
            width: null
        });
});
</script>
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}" type="text/javascript"></script>

@endsection
