@extends('buyer.app')

@section('content')
<style>
.bootstrap-tagsinput {
  width: 100% !important;
}
.main-lab{font-size: 15px!important;font-weight: bold;}
.select2-container{display: block!important;}
.ms-container{width: 90%!important;}
.input-large {
    width: 380px!important;
}
.select2-container{display: block!important;}
.select2-container--default .select2-results__option[aria-selected=true]{display: none!important;}
.form-group{float: left;width: 100%;}
h3.block {margin-top: 0px!important;}
@media (min-width: 992px){
.col-md-2n {
    width: 20%!important;
}    
}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('supplier-leads')}}">Supplier Leads</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Lead</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
 <img src="{{URL::asset('images/icons/hand-shake-black.svg')}}" height="40px" width="40px"/> Create a New Lead Request
</h3>
</div>
</div>
<div class="row">
<div class="col-md-12">
    <div class="col-md-12">
            <div class="portlet-body form" id="blockui_sample_1_portlet_body" style="float: left;width: 100%;">
                @if($errors->any())
                <div class="alert alert-danger">
                
                    <p>Please upload a file or select Product-Category types.</p>
                </div>
                @endif
                <div class="col-md-12 padding-top">
                <div class="row">
                <p class="caption-helper">Create a Lead Request by completing this easy form. Once submitted, Indy John will match you with New Buy Requests.</p>
                </div>
                </div>
                <!--<form action="#" id="catlogform" enctype="multipart/form-data" method="post" class="form-horizontal">
                    <input type="hidden" id="userid" name="userid" value="{{$userData->user_id}}" />
                    <div class="form-body">
                         <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-5 paddin-npt">
                                        <label for="inputEmail3" class="col-md-12 paddin-npt">Upload your catalog:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="input-group input-large">
                                                    <div class="form-control uneditable-input input-fixed input-large" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"> Click here to upload a WORD/PDF/Excel/CSV/TXT file</span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-circle default btn-file">
                                                        <span class="fileinput-new"> Select file </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" data-required="1" name="upload_catalog"> </span>
                                                    <a href="javascript:;" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="inputEmail3" class="control-label">&nbsp;</label>
                                        <div class="">
                                        <button type="submit" class="btn btn-circle yellow-crusta color-black bold">
                                            <i class="fa fa-check"></i> Submit</button>
                                        </div>
                                    </div>
                                    <div class="col-md-12 paddin-npt">
                                    <span class="help-block">Upload your catalog file and we will auto-select the product-types and categories for you. This process usually takes 1-2 hours or can take upto 24 hours depending on the size of your upload.</span>
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                    
                    
                </form>-->
                <!-- BEGIN FORM-->
                {!! Form::open([
                'route' => 'supplier-leads.store',
                'class' => 'horizontal-form form-horizontal form-row-seperated',
                'files' => true,
                'id'=> 'lead-create-form'
                ]) !!}
                    <input type="hidden" name="created_by" value="{{$userData->user_id}}" />
                    <input type="hidden" name="status" value="1" />
                    <div class="form-body padding-15" style="float: left;width: 100%;">
                        <h3 class="block align-left no-margin paddin-npt"><span style="font-size: 19px!important;">Select all options that apply to this Lead Request:</span></h3>
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
                        <div class="form-group padding-bottom padding-top">
                            <h3 class="block align-left paddin-npt"><span style="font-size: 19px!important;">Enter Product-Categories that apply to this Lead Request: </span></h3>
                            <label for="inputEmail3" class="col-md-12 paddin-npt font-red-mint">Option 1: Browse and Upload a Product-Category file:</label>
                            <div class="col-md-12 paddin-npt">
                                <div class="fileinput fileinput-new col-md-12" data-provides="fileinput" style="margin-bottom:0px !important;">
                                <div class="row">
                                    <input type="hidden" name="file_path" value="" id="hidden_file_name" />
                                    <div class="input-group input-large">
                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                            <span class="fileinput-filename"> Click here to upload a WORD/PDF/Excel/CSV/TXT file</span>
                                        </div>
                                        <span class="input-group-addon btn btn-danger btn-file">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" data-required="1" name="upload_catalog" id="upload_catalog"> </span>
                                        <a href="javascript:;" class="input-group btn btn-circle default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                             <!--   <span class="help-block">Upload a list or catalog pages with your product offering for this Lead Request. This process usually takes 1-2 hours or can take upto 24 hours depending on the size of your upload.</span> -->
                            </div>
                            <div class="col-md-10 padding-top paddin-bottom">
                                <div class="font-red-mint  col-xs-offset-3">
                                    <strong style="font-size: 19px;">- OR -</strong>
                                </div>
                            </div>
                            <label for="inputEmail3" class="col-md-12 paddin-npt font-red-mint">Option 2: Type and Select Product-Categories:</label>
                            <div class="col-md-12 paddin-npt">
                                <select id="select2-button-addons-single-input-group-sm" name="categories[]" class="form-control col-md-12 js-data-category-ajax"  multiple></select>
                             <!--   <span class="help-block">Type and Select desired Product Type or Category</span> -->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group padding-bottom padding-top">
                         <h3 class="block align-left paddin-npt"><span style="font-size: 19px!important;">Enter all Industrial Markets you serve:</h3></span>

    

         <div class="col-md-12 paddin-npt">
                                <select name="industries[]" class="form-control selectIndustry" id="industry-select" multiple>
                                    @if(Request::old('industries'))
                                        @if(in_array("all",Request::old('industries')))
                                            <option value="all" selected="">All Industries</option>
                                        @else
                                            <option value="all">All Industries</option>
                                        @endif
                                    @else
                                        <option value="all">All Industries</option>
                                    @endif
                                    
                                    @foreach($industries as $industry)
                                        @if(Request::old('industries'))
                                            @if(in_array($industry->id,Request::old('industries')))
                                                <option value="{{$industry->id}}" selected="">{{$industry->name}}</option>
                                            @else
                                                <option value="{{$industry->id}}">{{$industry->name}}</option>
                                            @endif
                                        @else
                                            <option value="{{$industry->id}}">{{$industry->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="help-block">Type and Select one or more applicable industries.</span>
                            </div>
                            </div>
                        </div>




                        <div class="form-group padding-bottom padding-top">
                          <h3 class="block align-left paddin-npt"><span style="font-size: 19px!important;">Set an Optional Expiration Date:</span></h3> 
                        
                            <div class="col-md-12 paddin-npt">
                                <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                    <input type="text" class="form-control" name="expiry_date" value="{{Request::old('expiry_date')}}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-circle default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block">Set a request Expiration Date for this lead request. </span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-actions right padding-top align-right">
                        <a href="{{ URL::to('supplier-leads') }}" class="btn btn-circle btn-danger bold red btn-sm">
                            Cancel </a>
                        <button type="button" id="lead-submit-btn" class="btn btn-circle yellow-crusta color-black bold">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>
                    </div>
                    
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
    </div>
    </div>
</div>
</div>
<script>
/* for show menu active */
$("#quote-main-menu").addClass("active");
$('#quote-main-menu' ).click();
$('#quote-menu-arrow').addClass('open')
$('#leads-add-menu').addClass('active');
/* end menu active */

$('#lead-submit-btn').click(function(){

    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    $('#lead-create-form').submit();    
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
// Variable to store your files
	var files;

	// Add events
	$('input[type=file]').on('change', prepareUpload);
	$('#catlogform').on('submit', uploadFiles);

	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		files = event.target.files;
	}

	// Catch the form submit and upload the files
	function uploadFiles(event)
	{
		event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening

        // START A LOADING SPINNER HERE

        // Create a formdata object and add the files
		var data = new FormData();

		data.append("fileToUpload", files[0]);
        data.append("userid", $('#userid').val());
        data.append("_token", "{{csrf_token()}}");
        App.blockUI({
            target: '#blockui_sample_1_portlet_body',
            animate: true
        });
        $('#loading').show();
        clock();
        $.ajax({
            url: "{{url('supplier-lead-catalog/save')}}",
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {
                $('#hidden_file_name').val(data.filename);
                App.unblockUI('#blockui_sample_1_portlet_body');
                return false;
            	$('#loading').hide();
            	$('#results').html();
            	$('#results').html(data.message);
            	
            	if(typeof data.error === 'undefined')
            	{
            		// Success so call function to process the form
            		submitForm(event, data);
            	}
            	else
            	{
            		// Handle errors here
            		console.log('ERRORS: ' + data.error);
                    App.unblockUI('#blockui_sample_1_portlet_body');
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            	console.log('ERRORS: ' + textStatus);
                App.unblockUI('#blockui_sample_1_portlet_body');
            	// STOP LOADING SPINNER
            }
        });
    }

    function submitForm(event, data)
	{
		// Create a jQuery object from the form
		$form = $(event.target);
		
		// Serialize the form data
		var formData = $form.serialize();
		
		// You should sterilise the file names
		$.each(data.files, function(key, value)
		{
			formData = formData + '&fileToUpload=' + value;
		});

		$.ajax({
			url: 'submit.php',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR)
            {
                
                if(typeof data.error === 'undefined')
            	{
            		// Success so call function to process the form
            		console.log('SUCCESS: ' + data.success);
            	}
            	else
            	{
            		// Handle errors here
            		console.log('ERRORS: ' + data.error);
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            	console.log('ERRORS: ' + textStatus);
            },
            complete: function()
            {
            	// STOP LOADING SPINNER
            }
		});
	}
function clock(){
	$('#timer').html();
    $('#timer').html('<div id="clock"><label id="minutes">00</label>:<label id="seconds">00</label></div>');
         var totalSeconds = 0;
        setInterval(setTime, 1000);
        function setTime()
        {
            ++totalSeconds;
            $('#clock > #seconds').html(pad(totalSeconds%60));
            $('#clock > #minutes').html(pad(parseInt(totalSeconds/60)));
        }
        function pad(val)
        {
            var valString = val + "";
            if(valString.length < 2)
            {
                return "0" + valString;
            }
            else
            {
                return valString;
            }
        }
}	
$("input[name='upload_catalog']").change(function() { 
    if($('#upload_catalog').val() != '')
    {
        uploadFiles(event);
    }
});

$(document).ready(function() {
	$('.date-picker').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true
    });
    
    var placeholder = "Type and Select one or more applicable industries.";
    $(".selectIndustry").select2({
            placeholder: placeholder,
            width: null
        });    
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
var categoryPlaceholder = 'Type and Select';
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
</script>
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
