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
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url()}}/quotes">Quotes</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Start a New Purchasing Team</span>
        </li>
    </ul>
</div>
 <div class="col-md-12 main_box">

<div class="row">
    <div class="col-md-12 border2x_bottom" id="form_wizard_1">
              <h3 class="page-title uppercase"> 
                <i class="fa fa-check color-black"> </i> Start a New Purchasing Team
              </h3>
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
                            <div class="mt-step-title uppercase font-grey-cascade">ADD TEAM DETAILS</div>
                        </div>
                        <div id="company-second" class="col-md-4 mt-step-col">
                            <div class="mt-step-number bg-white">2</div>
                            <div class="mt-step-title uppercase font-grey-cascade">INVITE MEMBERS</div>
                        </div>
                        
                    </div>
                </div>
                <div class="yellow-crusta-seprator"></div>
                
                <div class="col-md-12 font-red-mint padding-top" id="first-step-quote">
<div class="row">
<h3 class="block  align-left"><span style="font-size: 20px!important;">Fill this form to create a Purchasing Team. </span></h3></div>


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
                        
                        
                        <div class="tab-content">
                            <div class="alert alert-danger display-none">
                                <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                            <div class="alert alert-success display-none">
                                <button class="close" data-dismiss="alert"></button> Your Buy Request form was successfully submitted. </div>
                            <div class="tab-pane active" id="tab1">
                            <div class="form-group">
                            <label class="col-md-12 paddin-npt">As a Purchasing Team Manager, you can -</label>
                        
</div>
                                <!--<p class="select-all"><input type="checkbox" id="checkAll"  class="form-control"  /> select All</p>-->
                                <div class="form-group paddin-bottom">
                                <ul><li><i class="fa fa-check color-black"> </i>   Assign Buy Requests to team members</li>
	<li><i class="fa fa-check color-black"> </i> Assign Quotes Received to team members</li>
	<li><i class="fa fa-check color-black"> </i> Create a channel of communication between members</li>
	<li><i class="fa fa-check color-black"> </i> Manage Subscription for team members</li>
    </ul>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 font-red-mint padding-top" id="first-step-quote">
<div class="row">
<h3 class="block  align-left"><span style="font-size: 20px!important;">Enter Team Details </span></h3></div>


                </div>
                                    <div class="col-md-12 paddin-npt">
                                    <label class="col-md-12 paddin-npt">Name Your Team</label>
                                       <input type="text" name="" value="" placeholder="Name Your Team" />
                                        <span class="help-block margin-top">Name Your Team</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                   
                                        <label class="col-md-12 paddin-npt">Add Team Description</label>
                                        <div class="col-md-12 paddin-npt">
                                            <input type="text" name="specification" value="" data-role="tagsinput" id="taginputin" placeholder="Type something and hit enter" />
    										<span class="help-block margin-top">Add Team Description</span>
                                      
                                    </div>
                                   
                                        <label class="col-md-12 paddin-npt">Select Sorting Label</label>
                                        <div class="col-md-12 paddin-npt">
                                            <select  class="form-control" value="" placeholder="Select Sorting Label"> 
                                            <option>Regions</option>
                                            <option>Products</option>
                                            <option>Categories</option>
                                            </select>
    										<span class="help-block margin-top">Select Sorting Label.</span>
                                        </div>
                                    </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Add Technical Specifications & Product Options:</label>
                                    <input type="text" name="specification" value="" data-role="tagsinput" id="taginputin" placeholder="Type something and hit enter" />
                                    <span class="help-block margin-top"> </span>
                                </div>
                                
                           
                            </div>
                            
                   
                    <div class="form-actions right">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                
                                
                                <a href="javascript:;" class="btn btn-circle btn-danger button-next"> Cancel
                                    <i class="fa fa-angle-right"></i>
                                </a>
                               <!-- <a href="javascript:;" id="post-request" class="btn btn-circle btn_yellow hvr-bounce-to-right" onclick="setTitel();"> <i class="fa fa-check"></i> Submit Request</a> -->
                                <button type="submit" class="btn btn-circle yellow-crusta"> <i class="fa fa-check"></i>Create Team and Invite Members</button>
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
var categoryPlaceholder = "Type and select one or more.";
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
