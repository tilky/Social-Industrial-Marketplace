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
            <span>Edit Lead</span>
        </li>
    </ul>
</div>
 <div class="col-md-12 main_box" >
 <div class="row">
 <div class="col-md-12 border2x_bottom hide_print">
                <div class="row">
<h3 class="page-title uppercase"> 
<i class="fa fa-gift"></i> Edit your Lead Request
</h3>

</div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="col-md-12">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- BEGIN FORM-->
                {!! Form::model($SupplierLead, [
                'method' => 'PATCH',
                'id' => 'submit-form',
                'route' => ['supplier-leads.update', $SupplierLead->id],
                'class' => 'horizontal-form form-horizontal form-row-seperated',
                'files' => true
                ]) !!}
                <input type="hidden" name="created_by" value="{{$userData->user_id}}" />
                    <input type="hidden" name="status" value="{{$SupplierLead->status}}" />
                    <div class="form-body padding-15" style="float: left;width: 100%;">
                        <h3 class="block align-left" style="margin-top: 0px!important;"><span style="font-size: 19px!important;">What best describes your Product Offering?</span></h3>
                        <!--<p class="select-all"><input type="checkbox" id="checkAll"  class="form-control"  /> select All</p>-->
                        <div class="form-group" style="float: left;width: 100%;">
                            <div class="col-md-2 col-md-2n paddin-npt">
                                <label class="control-label col-md-12 align-left main-lab select-all-eqp paddin-npt paddin-bottom"><input type="checkbox" id="checkAllEqup"  class="form-control checkbox"  /> <b>Equipment:</b></label>
                                <div class="col-md-12">
                                    @foreach($equipmentOrderTypes as $equipment)
                                    <div class="col-md-12 paddin-npt equip">
                                        @if(in_array($equipment->id,$selecteequipments))
                                            <input type="checkbox" name="equipment[]" class="form-control checkbox eqp-chk" checked="" value="{{$equipment->id}}" /> {{$equipment->name}}
                                        @else
                                            <input type="checkbox" name="equipment[]" class="form-control checkbox eqp-chk" value="{{$equipment->id}}" /> {{$equipment->name}} 
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-2 col-md-2n paddin-npt">
                                <label class="control-label col-md-12 align-left main-lab select-all-mt paddin-npt paddin-bottom"><input type="checkbox" id="checkAllMT"  class="form-control checkbox"  /><b>Materials Tooling:</b></label>
                                <div class="col-md-12">
                                    @foreach($materialsToolingOrderTypes as $materialsTooling)
                                    <div class="col-md-12 paddin-npt mattool">
                                        @if(in_array($materialsTooling->id,$selecteMaterials))
                                            <input type="checkbox" name="materials_tooling[]" class="form-control checkbox mattools" checked="" value="{{$materialsTooling->id}}" /> {{$materialsTooling->name}}
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
                                        @if(in_array($service->id,$selecteServices))
                                            <input type="checkbox" name="services[]" class="form-control checkbox servchk" checked="" value="{{$service->id}}" /> @if($service->name == 'Repairs') Repair @else {{$service->name}} @endif
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
                                        @if(in_array($software->id,$selecteSoftware))
                                            <input type="checkbox" name="software[]" class="form-control checkbox softchk" checked="" value="{{$software->id}}" /> {{$software->name}}
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
                                        @if(in_array($consumableSuppliers->id,$selecteConsumable))
                                            <input type="checkbox" name="consumable_suppliers[]" class="form-control checkbox cschk" checked="" value="{{$consumableSuppliers->id}}" /> {{$consumableSuppliers->name}}
                                        @else
                                            <input type="checkbox" name="consumable_suppliers[]" class="form-control checkbox cschk" value="{{$consumableSuppliers->id}}" /> {{$consumableSuppliers->name}} 
                                        @endif 
                                    </div>
                                    @endif
                                    @endforeach
                                    @foreach($consumableSuppliersOrderTypes as $consumableSuppliers)
                                    @if($consumableSuppliers->name != 'Stationary' && ($consumableSuppliers->name == 'Suppliers' || $consumableSuppliers->name == 'Other'))
                                    <div class="col-md-12 paddin-npt csspn">
                                        @if(in_array($consumableSuppliers->id,$selecteConsumable))
                                            <input type="checkbox" name="consumable_suppliers[]" class="form-control checkbox cschk" checked="" value="{{$consumableSuppliers->id}}" /> @if($consumableSuppliers->name == 'Suppliers') Supplies @else {{$consumableSuppliers->name}} @endif
                                        @else
                                            <input type="checkbox" name="consumable_suppliers[]" class="form-control checkbox cschk" value="{{$consumableSuppliers->id}}" /> @if($consumableSuppliers->name == 'Suppliers') Supplies @else {{$consumableSuppliers->name}} @endif 
                                        @endif 
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="float: left;width: 100%;">
                            <label for="inputEmail3" class="col-md-12 paddin-npt">Type and Select Product Types or Category:</label>
                            <div class="col-md-12 paddin-npt">
                                <select id="select2-button-addons-single-input-group-sm" name="categories[]" class="form-control col-md-12 js-data-category-ajax"  multiple>
                                @foreach($SupplierLead->categories as $cat_index=>$category)
                                    <option value="{{$category->category->id}}" selected="">{{$category->category->name}}</option>
                                @endforeach
                                </select>
                                <span class="help-block">Start Typing the product name and select the best one from the suggestions</span>
                            </div>
                        </div>
                        <div class="form-group" style="float: left;width: 100%;display: none">
                            <label for="inputEmail3" class="col-md-12 paddin-npt">Select Applicable Industrial Markets:</label>
                            <div class="col-md-12 paddin-npt">
                                <select name="industries[]" class="form-control selectIndustry" id="industry-select" multiple>
                                    <option value="all">All Industries</option>
                                    @foreach($industries as $industry)
                                        @if(in_array($industry->id,$selecteIndustrie))
                                        <option value="{{$industry->id}}" selected="">{{$industry->name}}</option>
                                        @else
                                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="help-block">Select relevent industries</span>
                            </div>
                        </div>
                        <div class="form-group" style="float: left;width: 100%;">
                            <label class="col-md-12 paddin-npt">Set an Expiration Date (optional):</label>
                            <div class="col-md-12 paddin-npt">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                    <input type="text" class="form-control" value="{{$SupplierLead->expiry_date}}" name="expiry_date">
                                    <span class="input-group-btn">
                                        <button class="btn btn-circle default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <span class="help-block">Set a request Expiration Date for this lead request. </span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form">
                    <div class="form-actions text-right padding-top">
                        <a href="{{ URL::to('supplier-leads') }}" class="btn btn-danger bold btn-sm">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle yellow-crusta bold color-black">
                            <i class="fa fa-check"></i> Save</button>
                    </div>
                    </div>
                {!! Form::close() !!}
                <!-- END FORM-->
        
    </div>
    </div>
</div>
</div>
<script>
/* for show menu active */
$("#quote-main-menu").addClass("active");
$('#quote-main-menu' ).click();
$('#quote-menu-arrow').addClass('open')
$('#leads-view-menu').addClass('active');
/* end menu active */
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

$(".js-data-category-ajax").select2({
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
