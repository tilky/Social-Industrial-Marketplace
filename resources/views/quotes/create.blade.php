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
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url()}}/quotes">Quotes</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Create a Buy Request</span>
        </li>
    </ul>
</div>
 <div class="col-md-12 main_box">

<div class="row">
    <div class="col-md-12 border2x_bottom" id="form_wizard_1">
        <div class="col-md-6">
            <div class="row">
              <h3 class="page-title uppercase"> 
                <img src="{{URL::asset('images/icons/fast-black.svg')}}" height="40px" width="40px"/> Create a Buy Request
              </h3>
            </div>
        </div>
        <div class="col-md-6 uppercase text-right">
            <h3 class="page-title uppercase"> Buy Request#: Not Assigned</h3>
        </div>
    </div>
</div>
            
<div class="row">
<div class="col-md-12 col-sm-12">
<div class="col-md-12 col-sm-12">
            <div class="portlet-body form" id="blockui_sample_1_portlet_body">
            <div class="col-md-12 col-sm-12">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <div class="mt-element-step">
                    <div class="row step-line">
                        <div id="company-first" class="col-md-4 mt-step-col first active">
                            <div class="mt-step-number bg-white">1</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Create a Buy Request</div>
                        </div>
                        <div id="company-second" class="col-md-4 mt-step-col">
                            <div class="mt-step-number bg-white">2</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Manage & Receive Quotes</div>
                        </div>
                        <div id="company-third" class="col-md-4 mt-step-col last">
                            <div class="mt-step-number bg-white">3</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Actions Taken</div>
                        </div>
                    </div>
                </div>
                <div class="yellow-crusta-seprator"></div>
                
                <div class="col-md-12 font-red-mint padding-top" id="first-step-quote">
<div class="row">
<h3 class="block  align-left"><span style="font-size: 20px!important;">Complete a Buy Request and have access to our Supplier Network.</span></h3></div>


                </div>
                <div class="col-md-12 font-red-mint padding-top" id="second-step-quote" style="display: none;">

<h3 class="block  align-left"><span style="font-size: 20px!important;">These fields contain optional information that can be sent with your Buy Request.</span></h3>

                </div>
                </div>
                
                <!-- BEGIN FORM-->
                {!! Form::open([
                'route' => 'request-product-quotes.store',
                'class' => 'horizontal-form form-horizontal',
                'files' => true,
                'id' => 'req-form-quote'
                ]) !!}
                    <input type="hidden" name="created_by" value="{{$userData->user_id}}" />
                    <input type="hidden" name="status" value="1" />
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
                                        <i class="fa fa-check"></i> Step 2: Optionals </span>
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
                                <button class="close" data-dismiss="alert"></button> Your Buy Request form was successfully submitted. </div>
                            <div class="tab-pane active" id="tab1">
                            <div class="form-group">
                            <label class="col-md-12 paddin-npt">What type of products or services are you looking for? Check all the apply:</label>
</div>
                                <!--<p class="select-all"><input type="checkbox" id="checkAll"  class="form-control"  /> select All</p>-->
                                <div class="form-group paddin-bottom">
                                    <div class="col-md-2 col-md-2n paddin-npt">
                                        <label class="control-label col-md-12 align-left main-lab select-all-eqp paddin-npt paddin-bottom"><input type="checkbox" id="checkAllEqup"  class="form-control checkbox"  /> <b>Equipment:</b></label>
                                        <div class="col-md-12 ">
                                            @foreach($equipmentOrderTypes as $equipment)
                                            <div class="col-md-12 paddin-npt equip">
                                                @if(Request::old('equipment'))
                                                    @if(in_array($equipment->id,Request::old('equipment')))
                                                        <input type="checkbox" name="equipment[]" class="form-control checkbox eqp-chk" checked="" value="{{$equipment->id}}" /> {{$equipment->name}}
                                                    @else
                                                        <input type="checkbox" name="equipment[]" class="form-control checkbox eqp-chk" value="{{$equipment->id}}" /> {{$equipment->name}} 
                                                    @endif 
                                                @else
                                                <input type="checkbox" name="equipment[]" class="form-control checkbox eqp-chk" value="{{$equipment->id}}" /> {{$equipment->name}}
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-md-2n paddin-npt">
                                        <label class="control-label col-md-12 align-left main-lab select-all-mt paddin-npt paddin-bottom"><input type="checkbox" id="checkAllMT"  class="form-control checkbox"  /><b>Instrumentation:</b></label>
                                        <div class="col-md-12">
                                            @foreach($materialsToolingOrderTypes as $materialsTooling)
                                            <div class="col-md-12 paddin-npt mattool">
                                                @if(Request::old('materials_tooling'))
                                                    @if(in_array($materialsTooling->id,Request::old('materials_tooling')))
                                                        <input type="checkbox" name="materials_tooling[]" class="form-control checkbox mattools" checked="" value="{{$materialsTooling->id}}" /> {{$materialsTooling->name}}
                                                    @else
                                                        <input type="checkbox" name="materials_tooling[]" class="form-control checkbox mattools" value="{{$materialsTooling->id}}" /> {{$materialsTooling->name}} 
                                                    @endif 
                                                @else
                                                <input type="checkbox" name="materials_tooling[]" class="form-control checkbox mattools" value="{{$materialsTooling->id}}" /> {{$materialsTooling->name}}
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-md-2n paddin-npt">
                                        <label class="control-label col-md-12 align-left main-lab select-all-srv paddin-npt paddin-bottom"><input type="checkbox" id="checkAllSERV"  class="form-control checkbox"  /> <b>Services:</b></label>
                                        <div class="col-md-12">
                                            @foreach($servicesOrderTypes as $service)
                                            <div class="col-md-12 paddin-npt servspan">
                                                @if(Request::old('services'))
                                                    @if(in_array($service->id,Request::old('services')))
                                                        <input type="checkbox" name="services[]" class="form-control checkbox servchk" checked="" value="{{$service->id}}" /> @if($service->name == 'Repairs') Repair @else {{$service->name}} @endif
                                                    @else
                                                        <input type="checkbox" name="services[]" class="form-control checkbox servchk" value="{{$service->id}}" /> @if($service->name == 'Repairs') Repair @else {{$service->name}} @endif 
                                                    @endif 
                                                @else
                                                <input type="checkbox" name="services[]" class="form-control checkbox servchk" value="{{$service->id}}" /> @if($service->name == 'Repairs') Repair @else {{$service->name}} @endif
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-md-2n paddin-npt">
                                        <label class="control-label col-md-12 align-left main-lab select-all-soft paddin-npt paddin-bottom"><input type="checkbox" id="checkAllSOF"  class="form-control checkbox"  /><b>Software:</b></label>
                                        <div class="col-md-12">
                                            @foreach($softwareOrderTypes as $software)
                                            <div class="col-md-12 paddin-npt softspn">
                                                @if(Request::old('software'))
                                                    @if(in_array($software->id,Request::old('software')))
                                                        <input type="checkbox" name="software[]" class="form-control checkbox softchk" checked="" value="{{$software->id}}" /> {{$software->name}}
                                                    @else
                                                        <input type="checkbox" name="software[]" class="form-control checkbox softchk" value="{{$software->id}}" /> {{$software->name}} 
                                                    @endif 
                                                @else
                                                <input type="checkbox" name="software[]" class="form-control checkbox softchk" value="{{$software->id}}" /> {{$software->name}}
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-md-2n paddin-npt">
                                        <label class="control-label col-md-12 align-left main-lab select-all-cs paddin-npt paddin-bottom"><input type="checkbox" id="checkAllCS"  class="form-control checkbox"  /><b>Consumables/ Materials:</b></label>
                                        <div class="col-md-12">
                                            @foreach($consumableSuppliersOrderTypes as $consumableSuppliers)
                                            @if($consumableSuppliers->name != 'Stationary' && ($consumableSuppliers->name == 'New' || $consumableSuppliers->name == 'Used'))
                                            <div class="col-md-12 paddin-npt csspn">
                                                @if(Request::old('consumable_suppliers'))
                                                    @if(in_array($consumableSuppliers->id,Request::old('consumable_suppliers')))
                                                        <input type="checkbox" name="consumable_suppliers[]" class="form-control checkbox cschk" checked="" value="{{$consumableSuppliers->id}}" /> {{$consumableSuppliers->name}}
                                                    @else
                                                        <input type="checkbox" name="consumable_suppliers[]" class="form-control checkbox cschk" value="{{$consumableSuppliers->id}}" /> {{$consumableSuppliers->name}} 
                                                    @endif 
                                                @else
                                                <input type="checkbox" name="consumable_suppliers[]" class="form-control checkbox cschk" value="{{$consumableSuppliers->id}}" /> {{$consumableSuppliers->name}}
                                                @endif
                                            </div>
                                            @endif
                                            @endforeach
                                            @foreach($consumableSuppliersOrderTypes as $consumableSuppliers)
                                            @if($consumableSuppliers->name != 'Stationary' && ($consumableSuppliers->name == 'Suppliers' || $consumableSuppliers->name == 'Other'))
                                            <div class="col-md-12 paddin-npt csspn">
                                                @if(Request::old('consumable_suppliers'))
                                                    @if(in_array($consumableSuppliers->id,Request::old('consumable_suppliers')))
                                                        <input type="checkbox" name="consumable_suppliers[]" class="form-control checkbox cschk" checked="" value="{{$consumableSuppliers->id}}" /> @if($consumableSuppliers->name == 'Suppliers') Supplies @else {{$consumableSuppliers->name}} @endif
                                                    @else
                                                        <input type="checkbox" name="consumable_suppliers[]" class="form-control checkbox cschk" value="{{$consumableSuppliers->id}}" /> @if($consumableSuppliers->name == 'Suppliers') Supplies @else {{$consumableSuppliers->name}} @endif 
                                                    @endif 
                                                @else
                                                <input type="checkbox" name="consumable_suppliers[]" class="form-control checkbox cschk" value="{{$consumableSuppliers->id}}" /> @if($consumableSuppliers->name == 'Suppliers') Supplies @else {{$consumableSuppliers->name}} @endif
                                                @endif
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Enter the Product-Category type that fits your Buy Request:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select id="quote-categories" name="categories[]"  class="form-control col-md-12 js-data-category-ajax"  multiple></select>
                                          <span class="help-block margin-top-10"> Suggested: <button type="button" class="btn btn-circle btn-sm red btn-sm btn-outline">Category 1</button> <button type="button" class="btn btn-circle btn-sm red btn-outline">Category 2</button> <button type="button" class="btn btn-circle btn-sm red btn-outline">Category 3</button></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 paddin-npt padding-right">
                                        <label class="col-md-12 paddin-npt">Preferred Manufacturer:<span style="font-size: 12px;vertical-align: top;"> (optional)</span></label>
                                        <div class="col-md-12 paddin-npt">
                                            <input type="text" name="manufacturer" class="form-control" value="{{Request::old('manufacturer')}}" placeholder="Enter here" />
    										   <span class="help-block margin-top-10"> </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 paddin-npt">
                                        <label class="col-md-12 paddin-npt">Preferred Model Number:<span style="font-size: 12px;vertical-align: top; red"> (optional)</span></label>
                                        <div class="col-md-12 paddin-npt">
                                            <input type="text" name="model_number" class="form-control" value="{{Request::old('model_number')}}" placeholder="Enter here" />
    										
                                        </div>
                                    </div>
                                </div>
                                          
                                          
                                            <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Required Technical Specifications & Product Options:</label>
                                    <input type="text" name="specification" value="" data-role="tagsinput" id="taginputin" placeholder="Start typing and hit enter." />
                                    
                                </div>
                                
                                
                          
                                
                                                    
                                
                                 <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Required Product Accreditations or Certifications:<span style="font-size: 12px;vertical-align: top;"> (optional)</span></label>
                                    <div class="col-md-12 paddin-npt">
                                        <select id="select2-button-addons-single-input-group-sm" name="accredations[]" class="form-control col-md-12 js-data-accrediton-ajax" multiple>
                                        
                                            @if(!empty($default['default_acccreditations']))
                                            @foreach($default['default_acccreditations'] as $default_acccreditation)
                                                <option value="{{$default_acccreditation['id']}}" selected="">{{$default_acccreditation['name']}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <span class="help-block margin-top-10">Are you requesting any Product Accreditations or Certifications? </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Add a Product Accreditation or Certification Requirement:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="text" name="other_accreditation" value="{{Request::old('other_accreditation')}}" data-role="tagsinput"  placeholder="Unable to find your required Accreditation? You can add a new Accrediation here. " style="width: 100%!important;">
                                      
                                    </div>
                                </div>
                                
                                
                                
                                      <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Limit your supplier reach to a Specific Industry:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select id="industry-select" name="industries[]" class="form-control selectIndustry" id="indutries-dropdown" multiple>
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
                                                @if(Request::old('industries'))
                                                    @if(in_array($industry->id,Request::old('industries')))
                                                        <option value="{{$industry->id}}" selected="">{{$industry->name}}</option>
                                                    @else
                                                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                                                    @endif
                                                @else
                                                    @if($userData->industry_id == $industry->id)
                                                    <option value="{{$industry->id}}" selected="">{{$industry->name}}</option>
                                                    @else
                                                    <option value="{{$industry->id}}">{{$industry->name}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="help-block margin-top-10"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Shipping Address:</label>
                                    <div class="col-md-12 paddin-npt" id="locationField" >
                                        @if($default['address'] == '' && $default['address2'] == '' && $default['city'] == '' && $default['state'] == '' && $default['zip'] == '' && $default['country'] == '')
                                        <input type="text" id="autocomplete" class="form-control" onFocus="geolocate()" value="" placeholder="Type to Search" >
                                        @else
                                        <input type="text" id="autocomplete" class="form-control" onFocus="geolocate()" @if($default['address'] != '' && $default['address2'] != '') value="{{$default['address']}}, {{$default['address2']}}, {{$default['city']}}, {{$default['state']}}, {{$default['zip']}}, {{$default['country']}}" @elseif($default['address'] == '') value="{{$default['address2']}}, {{$default['city']}}, {{$default['state']}}, {{$default['zip']}}, {{$default['country']}}" @elseif($default['address2'] == '') value="{{$default['address']}}, {{$default['city']}}, {{$default['state']}}, {{$default['zip']}}, {{$default['country']}}" @elseif($default['address'] == '' && $default['address2'] == '') value="{{$default['city']}}, {{$default['state']}}, {{$default['zip']}}, {{$default['country']}}" @else value="" @endif  placeholder="Type to Search" >
                                        @endif
                                    </div>
                                </div>

                                <div id="multi-items">
                                    <div class="form-group">
                                        <div class="col-md-6 paddin-npt padding-right-15">
                                            <label class="col-md-12 paddin-npt">Address Line 1:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <textarea data-required="1" id="street_number" name="address" class="form-control" placeholder="Enter your Company Address Line 1">{{$default['address']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 paddin-npt">
                                            <label class="col-md-12 paddin-npt">Address Line 2:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <textarea id="route" name="address2" class="form-control" placeholder="Company Address Line 2:">{{$default['address2']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 paddin-npt padding-right-15">
                                            <label class="col-md-12 paddin-npt">City:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <input data-required="1" id="locality" type="text" name="city" value="{{$default['city']}}" class="form-control" placeholder="Enter the City Name">
                                            </div>
                                        </div>
                                        <div class="col-md-3 paddin-npt padding-right-15">
                                            <label class="col-md-12 paddin-npt">State:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <input data-required="1" id="administrative_area_level_1"  type="text" name="state" value="{{$default['state']}}" class="form-control" placeholder="Enter the State Name">
                                            </div>
                                        </div>
                                        <div class="col-md-3 paddin-npt padding-right-15">
                                            <label class="col-md-12 paddin-npt">Zip Code:</label>
                                            <div class="col-md-12 paddin-npt">
                                                <input data-required="1" id="postal_code" type="text" name="zip" value="{{$default['zip']}}" class="form-control" placeholder="Enter your Zip code">
                                            </div>
                                        </div>
                                        <div class="col-md-3 paddin-npt">
                                            <label class="col-md-12 paddin-npt">Country</label>
                                            <div class="col-md-12 paddin-npt">
                                                <select id="country" name="country" class="form-control selectCountry">
                                                    <option></option>
                                                    @foreach($countries as $country)
                                                    @if($default['country'] == $country->country_name)
                                                    <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                                                    @else
                                                    <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Quantity Requested:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="number" name="qty_request" class="form-control" value="{{Request::old('qty_request')}}" placeholder="" />
										<span class="help-block margin-top-10"></span>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Add additional notes to your Buy Request:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <textarea name="specifications" class="form-control" rows="4" placeholder="Describe your Specific Requirements and Desired Technical Specifications">@if($default['specifications'] != ''){{$default['specifications']}} @else {{Request::old('specifications')}} @endif</textarea>
                                        <span class="help-block margin-top-10"></span>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Upload a Specifications File: <span>(optional)</span></label>
                                    <div class="col-md-12 paddin-npt">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="row">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                  
                                                       <span class="fileinput-filename"> Click here to upload a WORD/PDF/Excel/CSV/TXT file</span>
                                                       
                                                </div>&nbsp; &nbsp;
                                                    <span class="input-group-addon btn btn-circle btn-danger btn-file" style="display:table-cell !important;">
                                                       <span class="fileinput-new"> Select file </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" data-required="1" name="additional_file">
                                                    </span>
                                                    <a href="javascript:;" class="input-group btn btn-danger bold fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            </div>
                                        </div>
                                        <span class="help-block margin-top-10"></span>
                                    </div>
                                </div> 
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Name your Buy Request:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="text" name="title" id="summary-title" class="form-control" value="{{Request::old('title')}}" placeholder="Enter Name here" />
                                      
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Apply a Diversity Preference to my Buy Request:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <div class="col-md-6">All</div>
                                        <div class="col-md-6">Selected</div>
                                        <select multiple="multiple" class="multi-select" id="diversity_options" name="diversity_options[]">
                                            @if(!empty($default['default_diversity']))
                                            @foreach($default['default_diversity'] as $default_diversity)
                                                <option value="{{$default_diversity['id']}}" selected="">{{$default_diversity['name']}}</option>
                                            @endforeach
                                            @endif
                                            @foreach($default['all_diversity'] as $diversity)
                                                <option value="{{$diversity->id}}">{{$diversity->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block margin-top-10"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Add a Diversity Option:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="text" name="other_diversity" value="{{Request::old('other_diversity')}}" data-role="tagsinput" placeholder="Unable to find an organization? You can add one here." style="width: 100%!important;">
                                       
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Adjust the privacy setting of your Buy Request:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select name="privacy" class="form-control" placeholder="Privacy Setting">
                                            <option value="1" @if($default['privacy'] == 1) selected="selected" @endif>Open to the General Public</option>
                                            <option value="2" @if($default['privacy'] == 2 || $default['privacy'] == '') selected="selected" @endif>All Free and Valued Suppliers</option>
                                            <option value="3" @if($default['privacy'] == 3) selected="selected" @endif>Valued Suppliers Only</option>
                                        </select>
                                        <span class="help-block margin-top-10"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Limit your Supplier Reach:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select name="request_area" class="form-control" placeholder="Request Area">
                                            <option value="1" @if($default['request_area'] == 1) selected="selected" @endif>Local</option>
                                            <option value="2" @if($default['request_area'] == 2) selected="selected" @endif>State</option>
                                            <option value="3" @if($default['request_area'] == 3) selected="selected" @endif>Country</option>
                                            <option value="4" @if($default['request_area'] == 4 || $default['request_area'] == '') selected="selected" @endif>International</option>
                                        </select>
                                        <span class="help-block margin-top-10"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Set a Buy Request Expiration Date:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                            <input type="text" class="form-control" value="{{Request::old('expiry_date')}}" name="expiry_date">
                                            <span class="input-group-btn">
                                                <button class="btn btn-circle default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Limit to Indy John Verified Supplier Network:</label>
                                    <div class="col-md-12 paddin-npt paddin-bottom">
                                    <input name="verified_only" value="1" type="checkbox" class="make-switch form-control" data-size="small" data-on-text="Enable" data-off-text="Disable">
                                 <span class="help-block margin-top-10"></span>    
                                    </div>
                                
                            </div>
                        </div>
                   
                    <div class="form-actions right">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="javascript:;" class="btn btn-circle btn-danger button-previous" style="display: none;">
                                    <i class="fa fa-angle-left"></i> Back to Required Fields </a>
                                
                                <a href="javascript:;" class="btn btn-circle btn-danger button-next"> View Optional Selections
                                    <i class="fa fa-angle-right"></i>
                                </a>
                               <!-- <a href="javascript:;" id="post-request" class="btn btn-circle btn_yellow hvr-bounce-to-right" onclick="setTitel();"> <i class="fa fa-check"></i> Submit Request</a> -->
                                <button type="submit" class="btn btn-circle yellow-crusta"> <i class="fa fa-check"></i> Submit Request</button>
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
        route: 'long_name',
        //premise: 'short_name',
        street_number: 'short_name',
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

        //var premiseOrStreetNo = place.address_components[0].types[0];
        //user.setId;
        //$('textarea[name=address]').setAttribute("id","premise");

        for (var component in componentForm) {

            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;

        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        var addressLine1 = '';
        var addressLine2 = '';
        var formattedAddressLine = false;

        for (var i = 0; i < place.address_components.length; i++) {

            var addressType = place.address_components[i].types[0];

            if(addressType == 'street_number' || addressType == 'premise'){
                addressLine1 = addressLine1 + place.address_components[i]['long_name'];
            }
            if(addressType == 'route'){
                addressLine1 = addressLine1+','+ place.address_components[i]['long_name'];
                formattedAddressLine = true;
            }

            if(addressType == 'sublocality_level_2'){
                addressLine2 = place.address_components[i]['long_name'];
            }

            if (componentForm[addressType]) {

                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;

            }
        }

        if(formattedAddressLine == true){
            document.getElementById('street_number').value = addressLine1;
            document.getElementById('route').value = addressLine2;
        }

        $('#multi-items').show();
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
$("#buyer-tool-main-menu").addClass("active");
$('#buyer-tool-main-menu' ).click();
$('#buyer-tool-menu-arrow').addClass('open');
$('#create-quote-menu').addClass('active');
/* end menu active */

$(document).ready(function() {
	$('.date-picker').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true
    });
    
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


$("#checkAllEqup").click(function(){    
   var check=$(this).prop('checked');
   if(check==true) {
     $('.equip .checker').find('span').addClass('checked');
     $('.eqp-chk').prop('checked',true);
   } else {
     $('.equip .checker').find('span').removeClass('checked');
     $('.eqp-chk').prop('checked',false);
   }
});

$("#checkAllMT").click(function(){    
   var check=$(this).prop('checked');
   if(check==true) {
     $('.mattool .checker').find('span').addClass('checked');
     $('.mattools').prop('checked',true);
   } else {
     $('.mattool .checker').find('span').removeClass('checked');
     $('.mattools').prop('checked',false);
   }
});

$("#checkAllSERV").click(function(){    
   var check=$(this).prop('checked');
   if(check==true) {
     $('.servspan .checker').find('span').addClass('checked');
     $('.servchk').prop('checked',true);
   } else {
     $('.servspan .checker').find('span').removeClass('checked');
     $('.servchk').prop('checked',false);
   }
});

$("#checkAllSOF").click(function(){    
   var check=$(this).prop('checked');
   if(check==true) {
     $('.softspn .checker').find('span').addClass('checked');
     $('.softchk').prop('checked',true);
   } else {
     $('.softspn .checker').find('span').removeClass('checked');
     $('.softchk').prop('checked',false);
   }
});

$("#checkAllCS").click(function(){    
   var check=$(this).prop('checked');
   if(check==true) {
     $('.csspn .checker').find('span').addClass('checked');
     $('.cschk').prop('checked',true);
   } else {
     $('.csspn .checker').find('span').removeClass('checked');
     $('.cschk').prop('checked',false);
   }
});

$("#checkAll").click(function(){    
   var check=$(this).prop('checked');
   if(check==true) {
     $('.checker').find('span').addClass('checked');
     $('.checkbox').prop('checked',true);
   } else {
     $('.checker').find('span').removeClass('checked');
     $('.checkbox').prop('checked',false);
   }
});
$('.checkbox').on('click',function(){
    //console.log('lenth 1: '+$('.checkbox:checked').length +' lend 2: ' +$('.checkbox').length);
    
    
    if($('.eqp-chk:checked').length == $('.eqp-chk').length){
        $('.select-all-eqp .checker').find('span').addClass('checked');
        $('#checkAllEqup').prop('checked',true);
    }else{
        $('.select-all-eqp .checker').find('span').removeClass('checked');
        $('#checkAllEqup').prop('checked',false);
    }
    
    if($('.mattools:checked').length == $('.mattools').length){
        $('.select-all-mt .checker').find('span').addClass('checked');
        $('#checkAllMT').prop('checked',true);
    }else{
        $('.select-all-mt .checker').find('span').removeClass('checked');
        $('#checkAllMT').prop('checked',false);
    }
    
    if($('.servchk:checked').length == $('.servchk').length){
        $('.select-all-srv .checker').find('span').addClass('checked');
        $('#checkAllSERV').prop('checked',true);
    }else{
        $('.select-all-srv .checker').find('span').removeClass('checked');
        $('#checkAllSERV').prop('checked',false);
    }
    
    if($('.softchk:checked').length == $('.softchk').length){
        $('.select-all-soft .checker').find('span').addClass('checked');
        $('#checkAllSOF').prop('checked',true);
    }else{
        $('.select-all-soft .checker').find('span').removeClass('checked');
        $('#checkAllSOF').prop('checked',false);
    }
    
    if($('.cschk:checked').length == $('.cschk').length){
        $('.select-all-cs .checker').find('span').addClass('checked');
        $('#checkAllCS').prop('checked',true);
    }else{
        $('.select-all-cs .checker').find('span').removeClass('checked');
        $('#checkAllCS').prop('checked',false);
    }
    
    if($('.checkbox:checked').length == $('.checkbox').length){
        $('.select-all .checker').find('span').addClass('checked');
        $('#checkAll').prop('checked',true);
    }else{
        $('.select-all .checker').find('span').removeClass('checked');
        $('#checkAll').prop('checked',false);
    }
});

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

$(".js-data-products-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/getquote/productSearch",
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
var categoryPlaceholder = "Type and select one or more Product-Categories that you're looking for.";
$(".js-data-category-ajax").select2({
    placeholder:categoryPlaceholder,
    width: "off",
    ajax: {
        url: "{{url()}}/getquote/categorySearch",
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
$(".js-data-accrediton-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url('getquote/accredationSearch')}}",
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
$(".js-data-industries-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/getquote/industrySearch",
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
$('.button-next').click(function(){
    $('#post-request').hide();
    $('#first-step-quote').hide();
    $('#second-step-quote').show();
    $('#tab2').show();
    $('#tab1').hide();
    $('.button-next').hide();
    $('.button-previous').show();
    $('html, body').animate({scrollTop : 0},800);
});
$('.button-previous').click(function(){
    $('#post-request').show();
    $('#first-step-quote').show();
    $('#second-step-quote').hide();
    $('#tab2').hide();
    $('#tab1').show();
    $('.button-next').show();
    $('.button-previous').hide();
    $('html, body').animate({scrollTop : 0},800);
});
function setTitel()
{
    var categoryies = $('#quote-categories').val();
    var categoryName = '';
    if(categoryies == null)
    {
        alert('Please Select Category');
    }
    else
    {
        App.blockUI({
            target: '#blockui_sample_1_portlet_body',
            animate: true
        });
        var cat_length = categoryies.length;
        if(cat_length == 1)
        {
            var baseurl = "{{url('ajax/categoryname')}}/"+categoryies[0]+'/0';
            jQuery.ajax({
                url: baseurl,
                type: 'get',
                success: function(data) {
                            $('#summary-title').val(data.name);
                            App.unblockUI('#blockui_sample_1_portlet_body');
                            $('#req-form-quote').submit();
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
        else
        {
            App.blockUI({
                target: '#blockui_sample_1_portlet_body',
                animate: true
            });
            var categoryName1 = categoryies[0];
            var categoryName2 = categoryies[1];
            var baseurl = "{{url('ajax/categoryname')}}/"+categoryName1+'/'+categoryName2;
            jQuery.ajax({
                url: baseurl,
                type: 'get',
                success: function(data) {
                            //console.log(data.name);
                            $('#summary-title').val(data.name);
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
        
         
    }
    
    
}
function getCategoryName(id)
{
    var baseurl = "{{url('ajax/categoryname')}}/"+id;
    jQuery.ajax({
        url: baseurl,
        type: 'get',
        success: function(data) {
                    return data.name;
                 },
        done: function() {
            //console.log('error');
        },
        error: function() {
            //console.log('error');
        }
        
    }); 
}

jQuery(document).ready(function() {
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
@endsection
