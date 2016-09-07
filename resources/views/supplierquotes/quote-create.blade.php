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
.form-group{border-bottom: 1px solid #eef1f5!important;padding-bottom: 15px;}
.fileinput{margin-bottom: 0px!important;}
.form-horizontal .form-group{margin-left: 15px!important;margin-right: 15px!important;}
.btn-default.active, .btn-default:active, .btn-default:hover, .open>.btn-default.dropdown-toggle{background-color: #f3c200!important;color: #000!important;}
.min-width{min-width: 150px!important;}
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
            <a href="{{url('quotes')}}">Quotes</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Create & Send an Quote</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-plus color-black"></i> Create & Send an Quote
</h3>
</div>
</div>
<div class="row">
  <div class="col-md-12">
  
 
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet-body form" id="blockui_sample_1_portlet_body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- BEGIN FORM-->
                {!! Form::open([
                'route' => 'supplier-quotes.store',
                'class' => 'horizontal-form form-horizontal',
                'files' => true
                ]) !!}
                    <input type="hidden" name="supplier_id" value="{{$userData->user_id}}" />
                    <input type="hidden" id="buyer_quote" name="buyer_quote_id" value="" />
                    <input type="hidden" name="sup-quote-create" value="1" />
                    <input type="hidden" name="random_quote" value="" id="random-quote" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">

 <h4 class="block bold font-red-mint align-left">Step 1: Select a Buy Request to Quote:</h4>
</label>
<div class="col-md-12">
                            <div class="col-md-12 paddin-npt" style="z-index: 99;">
                                <select class="form-control selectLead" name="lead" id="buyer-quote-select" onchange="buyerQuote();">
                                    <option value=""></option>
                                    @foreach($quotes as $quote)
                                        <option value="{{$quote->id}}">{{$quote->title}} ( By: {{$quote->user->userdetail->first_name}} {{$quote->user->userdetail->last_name}} ) On: {{date('M d, Y',strtotime($quote->created_at))}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="buyer-quote-detail"></div>
                            </div>
                        </div>
                        <div class="form-group">
<h4 class="block bold font-red-mint align-left">Step 2: Enter your Quote Details:</h4>

<div class="col-md-12">
                            <div class="col-md-6 paddin-npt padding-right">


                                <label class="col-md-12 paddin-npt">Your Company Quote Number: <span style="font-size: 12px;vertical-align: top; red">(optional)</span></label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="company_quote_number" value="{{Request::old('company_quote_number')}}" class="form-control"  placeholder="Enter Your Company Quote Number" />
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">Enter Company Tax ID:<span style="font-size: 12px;vertical-align: top; red"> (optional)</span></label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="company_tax_number" value="{{Request::old('company_tax_number')}}" class="form-control"  placeholder="Enter Company tax ID" />
                                </div>
                            </div>
                        </div>
                        </div>
                        
                <div class="form-group">
                            
                          
                        
                        <div class="form-group">
                        
                            <label class="col-md-12 paddin-npt">Add items to this Quote:</label>
                          
                            <div id="quote-product-div">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                        <tr>
                                            <th>Item Number </th>
                                            <th>Item Description</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Condition</th>
                                            <th>Taxable</th>
                                            <th> Action </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                            </div>
                            <button type="button" id="{{url('company/reference/add/1')}}" class="btn btn-circle bold yellow-crusta color-black reference-add-btn-1" onclick="showAddModal(id,'first')"  ><i class="fa fa-plus"></i> Add Item</button>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 paddin-npt padding-right">
                                <label class="col-md-12 paddin-npt">Quote Expiration Date: <span style="font-size: 12px;vertical-align: top; red">(optional)</span></label>
                                <div class="col-md-12 paddin-npt">
                                    <div class="">
                                        <div class="input-group input-large date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                            <input type="text" class="form-control" name="expiry_date" value="{{Request::old('expiry_date')}}">
                                            <span class="input-group-btn">
                                                <button class="btn btn-circle default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right">
                                <label class="col-md-12 paddin-npt">Would you like to apply Sales Tax to this Quote:</label>
                                <div class="col-md-12 paddin-npt">
                                  
                                    <select name="salestax" id="salestax-val" class="form-control" onchange="salesTaxValue();">
                                        <option value="No">No, this quote is Flat Rate</option>
                                        <option value="Percent">Apply Applicable Percentage on Items</option>
                                        <option value="Fixed Amount">Add a Fixed Tax Amount to the Quote</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt" id="sales-amount-div" style="display: none;">
                                <label class="col-md-12 paddin-npt" id="sales-amount-label">Enter the Applicable Tax Percentage:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="number" id="salestax-amount" name="salestax_amount" value="{{Request::old('salestax_amount')}}" class="form-control"  placeholder="Enter the tax percentage. For example, 9.5." />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right">
                                <label class="col-md-12 paddin-npt">Would you like to Add Shipping and Handling Fee:</label>
                                <div class="col-md-12 paddin-npt">

                                    <select id="shipping_charge" name="shipping_charge" class="form-control" onchange="shippingCharge();">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt" id="shipping-amount-div" style="display: none;">
                                <label class="col-md-12 paddin-npt" id="shipping-amount-label">Enter the Shipping & Handling Fee:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="number" id="shipping-amount" name="shipping_charge_amount"  value="{{Request::old('shipping_charge')}}" class="form-control"  placeholder="Enter the Shipping Charge." />
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Add a Note for the Buyer:</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea class="form-control" name="custom_note" placeholder="Send a Note to The Buyer">{{Request::old('custom_note')}}</textarea>
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="col-md-12 paddin-npt">Add Payment Terms & Additional Details:</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea class="form-control" name="payment_terms" placeholder="Add Payment Terms & More">{{Request::old('payment_terms')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <button type="submit" class="btn btn-circle yellow-crusta bold color-black  btn-circle ">
                            <i class="fa fa-check"></i> Preview And Submit Quote</button>
                    </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
            </div>
   
   </div>
</div>
</div>
<!-- Add item responsive -->
<div id="responsive-item-add" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    
</div>
<script>
/* for show menu active */
$("#quote-main-menu").addClass("active");
$('#quote-main-menu' ).click();
$('#quote-menu-arrow').addClass('open')
$('#quote-create-supplier-menu').addClass('active');
/* end menu active */
$(document).ready(function() {
	$('.date-picker').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true
    });

    var placeholder = "Type and Select a Lead";
    $(".selectLead").select2({
            placeholder: placeholder,
            width: null
        });
     
});
function salesTaxValue()
{
    sales_type = $('#salestax-val').val();
    if(sales_type == 'No')
    {
        $('#sales-amount-div').hide();
    }
    else
    {
        $('#sales-amount-div').show();
        if(sales_type == 'Percent')
        {
            $('#sales-amount-label').text('Enter Applicable Tax Percentage:');
            $('#salestax-amount').attr('placeholder','Enter the tax percentage to be applied to taxable items. Example: 9.5');
        }
        else
        {
            $('#sales-amount-label').text('Enter the Fixed Tax Total Amount:');
            $('#salestax-amount').attr('placeholder','Enter the fixed total to be added in the invoice. Example: 50');
        }
    }
}

function shippingCharge()
{
    shipping_type = $('#shipping_charge').val();
    if(shipping_type == 'No')
    {
        $('#shipping-amount-div').hide();
    }
    else
    {
        $('#shipping-amount-div').show();

        $('#shipping-amount-label').text('Enter the Shipping & Handling Fee:');
        $('#shipping-amount').attr('placeholder','Enter the Shipping Charge');

    }
}

function AddNewProduct(id){
    
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    var baseurl = "{{url('supplierquotes/addproduct')}}"+'/'+divId;
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    jQuery.ajax({
        url: baseurl,
        type: 'get',
        success: function(data) {
                    var element = document.getElementById("otherproducts");
                    $( "#otherproducts" ).append(data.html);
                    var newId = 'productnext_'+data.next_id;
                    $('#'+id).attr("id",newId);
                    App.unblockUI('#blockui_sample_1_portlet_body');
                 },
        done: function() {
            //console.log('error');
        },
        error: function() {
            //console.log('error');
        }
        
    });    
}

function removeProduct(id)
{
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
    $('#added_product_'+divId).html('');
}  

function buyerQuote()
{
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    var buyer_quote_id = $('#buyer-quote-select').val();
    if(buyer_quote_id != '')
    {
        
        jQuery.ajax({
            url: "{{url('buyer/quote/data')}}"+"/"+buyer_quote_id,
            type: 'get',
            success: function(data) {
                        //console.log(data.html);
                        $('#buyer-quote-detail').html('');
                        $('#buyer-quote-detail').html(data.html);
                        $('#buyer-quote-detail').show();
                        App.unblockUI('#blockui_sample_1_portlet_body');
                     },
            done: function() {
                //console.log('error');
            },
            error: function() {
                //console.log('error');
            }
            
        });
    }
}
function showAddModal()
{
    var random = $('#random-quote').val();
    if(random == '')
    {
        sendrandom = 0;
    }
    else
    {
        sendrandom = random;
    }
    var form= $("#quote-items-add");
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    $.ajax({
        url: "{{url('quote/item/add')}}"+"/"+sendrandom,
        type: 'get',
        success: function(data) {
            $('#random-quote').val(data.random);
            $('#responsive-item-add').html('');
            $('#responsive-item-add').html(data.html);
            $("#multi-select-items").bootstrapSwitch();
            $('#responsive-item-add').modal('show');
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
function showEditModal(id)
{
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    $.ajax({
        url: id,
        type: 'get',
        success: function(data) {
            $('#random-quote').val(data.random);
            $('#responsive-item-add').html('');
            $('#responsive-item-add').html(data.html);
            $("#multi-select-items").bootstrapSwitch();
            $('#responsive-item-add').modal('show');
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
function showDeleteModal(id)
{
    var random = $('#random-quote').val();
    
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
      var url = id;
      $.ajax({
        url: url,
        type: 'get',
        success: function(data) {
            $('#random-quote').val(data.random);
            $('#quote-product-div').html('');
            $('#quote-product-div').html(data.html);
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

function saveAuoteItems()
{
    var qty = $('#item-qty').val();
    var price = $('#item-price').val();
    var name = $('#item-name').val();
    
    if(name == '')
    {
        $('#discription-fld-req').show();
        return false
    }
    else
    {
        $('#discription-fld-req').hide();
    }
    
    if(qty == '')
    {
        $('#qty-fld-req').show();
        return false
    }
    else
    {
        $('#qty-fld-req').hide();
    }
    
    if(price == '')
    {
        $('#price-fld-req').show();
        return false
    }
    else
    {
        $('#price-fld-req').hide();
    }
    
    var dataData = new FormData($("#quote-items-add")[0]);
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    
    $.ajax({
        url: "{{url('quote/item/save')}}"+"?_token="+"{{csrf_token()}}",
        type: 'post',
        dataType:'json',
        data:dataData,
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        success: function(data) {
            $('#random-quote').val(data.random);
            $('#quote-product-div').html('');
            $('#quote-product-div').html(data.html);
            $(':input','#quote-items-add')
              .not(':button, :submit, :reset, :hidden')
              .val('')
              .removeAttr('checked')
              .removeAttr('selected');
            $('#responsive-item-add').modal('hide');
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
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}" type="text/javascript"></script>
@endsection
