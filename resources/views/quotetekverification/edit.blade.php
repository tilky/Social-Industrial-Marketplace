@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url('quotetekverification')}}">Quotetek Verification</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Edit Product</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-gift color-black"></i>  Edit {{$product->name}}</div>
                <div class="actions">
                    <a href="{{ URL::to('marketplaceproducts/info/') }}/{{$product->id}}" class="btn btn-circle color-black btn-sm">
                        <i class="fa fa-pencil color-black"></i>  Edit Other Info </a>
                </div>
            </div>

            <div class="portlet-body form">
                
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- BEGIN FORM-->
                {!! Form::model($product, [
                'method' => 'PATCH',
                'id' => 'submit-form',
                'route' => ['marketplaceproducts.update', $product->id],
                'class' => 'horizontal-form',
                'files' => true
                ]) !!}
                    <input type="hidden" name="account_type" class="form-control" value="{{$userData->account_type}}">
                    <input type="hidden" name="user_id" class="form-control" value="{{$userData->user_id}}" >
                    <input type="hidden" name="company_id" class="form-control" value="{{$userData->company_id}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="control-label">General</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <span class="required" aria-required="true"> * </span>
                                    <input data-required="1" type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Name of Product">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Brand Name</label>
                                    <span class="required" aria-required="true"> * </span>
                                    <input data-required="1" type="text" name="brand_name" value="{{$product->brand_name}}" class="form-control" placeholder="Barnd Name of Product">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Model Number</label>
                                    <input type="text" name="model_number" class="form-control" value="{{$product->model_number}}" placeholder="Model Number of Product">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Description">{{$product->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Condition</label>
                                    <select name="condition" class="form-control" placeholder="Product Condition">
                                        @if($product->condition == 'new')<option value="new" selected="selected">New</option>@else<option value="new" selected="selected">New</option>@endif
                                        @if($product->condition == 'used')<option value="used" selected="selected">Used</option>@else<option value="used">Used</option>@endif
                                        @if($product->condition == 'refurbished')<option value="refurbished" selected="selected">Refurbished</option>@else<option value="refurbished">Refurbished</option>@endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Condition quality</label>
                                    <select name="condition_quality" class="form-control" placeholder="Condition quality">
                                        @if($product->condition_quality == 'excellent')<option value="excellent" selected="selected">Excellent</option>@else<option value="excellent">Excellent</option>@endif
                                        @if($product->condition_quality == 'light usage')<option value="light usage" selected="selected">Light usage</option>@else<option value="light usage">Light usage</option>@endif
                                        @if($product->condition_quality == 'heavy usage')<option value="heavy usage" selected="selected">Heavy usage</option>@else<option value="heavy usage">Heavy usage</option>@endif
                                        @if($product->condition_quality == 'bad but working')<option value="bad but working" selected="selected">Bad but working</option>@else<option value="bad but working">Bad but working</option>@endif
                                        @if($product->condition_quality == 'for parts only')<option value="for parts only" selected="selected">For parts only</option>@else<option value="for parts only">For parts only</option>@endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Price</label>
                                    <span class="required" aria-required="true"> * </span>
                                    <input type="text" name="price" value="{{$product->price}}" class="form-control" placeholder="Price of Product">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Unit type</label>
                                    <input type="text" name="unit_type" value="{{$product->unit_type}}" class="form-control" placeholder="Unit type of Product">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="control-label">Specifications</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 paddin-npt" id="blockui_sample_1_portlet_body">
                                <div class="form-group">
                                    <label class="col-md-12 control-label">Item Specifics value:  <a href="#" id="addmore_{{$product->options_count+1}}" onclick="addMoreOption(id);return false"><i class="fa fa-plus-circle"></i>  Add More</a></label>
                                    @if(!empty($product->specification))
                                        @foreach($product->specification as $index=>$options)
                                            <div id="optionsmain_{{$index+1}}" class="col-md-6 paddin-npt padding-top">
                                                <div class="col-md-6"><input class="form-control" name="item[{{$index+1}}][lable]" value="{{$options['label']}}" value="" placeholder="Option Label" /></div>
                                                <div class="col-md-6">
                                                    @foreach($options['options'] as $opt_index=>$opt)
                                                    <div id="option_{{$index+1}}_{{$opt_index+1}}" class="paddin-bottom option-div">
                                                        <input name="item[{{$index+1}}][option][{{$opt_index+1}}]" class="col-md-9 form-control option-inputs" value="{{$opt}}" placeholder="Option Value" />
                                                        @if($opt_index == 0)
                                                        <a href="javascript:void(0)" id="addsub_{{$index+1}}_{{count($options['options'])+1}}" onclick="addSubOption(id)" style="float: left;"><i class="fa fa-plus-circle"></i>  </a>
                                                        @else
                                                        <a href="javascript:void(0)" style="float: left;" id="remove_{{$index+1}}_{{$opt_index+1}}" onclick="removeSubOption(id)"><i class="fa fa-remove font-red"></i>  </a>
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
                                                <a href="javascript:void(0)" id="addsub_1_2" onclick="addSubOption(id)" style="float: left;"><i class="fa fa-plus-circle"></i>  </a>
                                            </div>
                                            <div id="suboption_1">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div id="opt-options">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Size</label>
                                    <input type="text" name="size" value="{{$product->size}}" class="form-control" placeholder="Size of Product">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Certification</label>
                                    <textarea name="certification" class="form-control" placeholder="Certification of Product">{{$product->certification}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Product PDF file</label>
                                    <div class="">
                                        <a href="{{url()}}/{{$product->attachment_path}}" download>Product PDF</a>
                                        <a href="javascript:void(0)" onclick="showPdfSelect()" class="btn btn-circle btn-sm">Change Pdf</a>
                                        <!--<a href="javascript:void(0)" id="hide-pdf-selecte" onclick="hidePdfSelect()" class="btn btn-circle btn-sm" style="display: none;">Cancel</a>-->
                                    </div>
                                    <div id="pdf-select" class="" style="display: none;padding-top: 10px;">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>  &nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn btn-circle default btn-file">
                                                    <span class="fileinput-new"> Select file </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" data-required="1" id="attachment_pdf" name="attachment_path"> </span>
                                                <a href="javascript:;" class="input-group btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Place of origin</label>
                                    <input type="text" name="place_of_origin" value="{{$product->place_of_origin}}" class="form-control" placeholder="Place of origin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Supply Ability</label>
                                    <input type="text" name="supply_ability" value="{{$product->supply_ability}}" class="form-control" placeholder="Supply Ability">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Package Size</label>
                                    <input type="text" name="package_size" value="{{$product->package_size}}" class="form-control" placeholder="Package Size">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="control-label">Payment & Terms</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Payment Terms</label>
                                    <textarea name="payment_terms" class="form-control" placeholder="Payment Terms">{{$product->payment_terms}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Return Policy</label>
                                    <textarea name="return_policy" class="form-control" placeholder="Return Policy">{{$product->return_policy}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 paddin-bottom">
                                <div class="form-group">
                                    <label class="control-label col-md-12 paddin-npt">Payment forms accepted</label>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]"  @if(in_array('Credit Cards',$product->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Credit Cards" /> Credit Cards
                                    </div>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]" @if(in_array('Bank Transfer',$product->payment_accepted)) checked="checked"  @endif class="form-control checkbox" value="Bank Transfer" /> Bank Transfer
                                    </div>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]" @if(in_array('Paypal',$product->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Paypal" /> Paypal
                                    </div>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]" @if(in_array('Cheque',$product->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Cheque" /> Cheque
                                    </div>
                                    <div class="col-md-2 paddin-npt">
                                        <input type="checkbox" name="payment_accepted[]" @if(in_array('COD',$product->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="COD" /> COD
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="control-label">Shipping Info</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Shipping terms</label>
                                    <input type="text" name="shipping_terms" value="{{$product->shipping_terms}}" class="form-control" placeholder="Shipping terms">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Shipping Fee</label>
                                    <input type="text" name="shipping_fee" value="{{$product->shipping_fee}}" class="form-control" placeholder="Shipping Fee">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 control-label">Free Shipping Continents</label>
                                    <div class="col-md-3">All</div>
                                    <div class="col-md-3">Selected</div>
                                    <select multiple="multiple" class="multi-select" id="free_shipping_continents" name="free_shipping_continents[]">
                                        @if(in_array('United States',$product->free_shipping_continents))<option value="United States" selected="selected">United States</option>@else<option value="United States">United States</option>@endif
                                        @if(in_array('Canada',$product->free_shipping_continents))<option value="Canada" selected="selected">Canada</option>@else<option value="Canada">Canada</option>@endif
                                        @if(in_array('Europe',$product->free_shipping_continents))<option value="Europe" selected="selected">Europe</option>@else<option value="Europe">Europe</option>@endif
                                        @if(in_array('Asia-China',$product->free_shipping_continents))<option value="Asia-China" selected="selected">Asia-China</option>@else<option value="Asia-China">Asia-China</option>@endif
                                        @if(in_array('Asia-India',$product->free_shipping_continents))<option value="Asia-India" selected="selected">Asia-India</option>@else<option value="Asia-India">Asia-India</option>@endif
                                        @if(in_array('Asia-Others',$product->free_shipping_continents))<option value="Asia-Others" selected="">Asia-Others</option>@else<option value="Asia-Others">Asia-Others</option>@endif
                                        @if(in_array('South America',$product->free_shipping_continents))<option value="South America" selected="selected">South America</option>@else<option value="South America">South America</option>@endif
                                        @if(in_array('Australia',$product->free_shipping_continents))<option value="Australia" selected="selected">Australia</option>@else<option value="Australia">Australia</option>@endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Free Shipping</label>
                                    <input name="free_shipping" value="1" type="checkbox" @if($product->free_shipping == 1)checked @endif data-on-text="Yes" data-off-text="No" data-on-color="danger" data-off-color="default" class="make-switch form-control" data-size="small">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4 class="control-label">Inventory & Supply (optional)</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Discount percent</label>
                                    <input type="text" name="discount_percent" value="{{$product->discount_percent}}" class="form-control" placeholder="Discount percent of Product">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Minimum Quantity</label>
                                    <input type="text" name="minimum_quantity" value="{{$product->minimum_quantity}}" class="form-control" placeholder="Minimum Quantity of Product">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Quantity Available</label>
                                    <input type="text" name="quantity_available" value="{{$product->quantity_available}}" class="form-control" placeholder="Quantity Available">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-actions right">
                        <button type="submit" class="btn btn-circle green">Submit</button>
                                <a href="{{ URL::to('companies') }}" class="btn btn-circle btn-sm">
                                    Cancel </a>
                    </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
    /* for show menu active */
    $("#marketplace-main-menu").addClass("active");
	$('#marketplace-main-menu' ).click();
	$('#marketplace-menu-arrow').addClass('open');
    /* end menu active */
    $( document ).ready(function() {
        $('#free_shipping_continents').multiSelect();
        $('#product_color').multiSelect();
        $('#product_usage').multiSelect();
    });
    
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
</script>
@endsection
