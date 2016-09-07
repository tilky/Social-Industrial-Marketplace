@extends('buyer.app')
@section('content')
<style>
.select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Dashboard</a>
        </li>
        <li>
            <span>User Detail</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> 
Welcome, {{Auth::user()->userdetail->first_name}} {{Auth::user()->userdetail->last_name}}
</h3>
<div class="row">
    <div class="portlet light bordered" id="form_wizard_1">
        <div  class="portlet-body form">
            @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
            @endif
            <div class="form-wizard">
                <div class="form-body">
                    <ul class="nav nav-pills nav-justified steps">
                        <li class="active">
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="number"> 1 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Company Setup </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Billing & Plans </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="number"> 3 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Invite & Earn </span>
                            </a>
                        </li>
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success" style="width: 33.33%!important;"> </div>
                    </div>
                    <ul class="nav nav-pills nav-justified steps">
                        <li id="compnay-first" class="active">
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="desc">
                                    <i class="fa fa-check"></i> Basic Information </span>
                            </a>
                        </li>
                        <li id="compnay-second">
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="desc">
                                    <i class="fa fa-check"></i> Optional Information </span>
                            </a>
                        </li>
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div id="company-progras" class="progress-bar progress-bar-success" style="width: 50%!important;"> </div>
                    </div>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                    <h3>Create your company <a href="{{url('user/company/select')}}" style="font-size: 13px;">Selecte Listed Company</a></h3>
                    <div id="company-logo" class="row">
                        <form action="{{url()}}/upload/file" class="dropzone dropzone-file-area" id="my-dropzone" style="width:200px; margin-top: 50px;">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <h4 class="">Company Logo, Drop files here or click to upload</h4>
                        </form>
                    </div>
                    
                    <!-- BEGIN FORM-->
                    {!! Form::open([
                    'route' => 'companies.store',
                    'id' => 'submit_form',
                    'class' => 'horizontal-form'
                    ]) !!}
                    <div class="form-body">
                        <input type="hidden" name="logo" id="logo">
                        <input type="hidden" name="first_time" value="1" />
                        <input type="hidden" name="account_id" value="1" />
                        <div id="main-company-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <span class="required" aria-required="true"> * </span>
                                        <input data-required="1" type="text" id="name" value="{{Request::old('name')}}" name="name" class="form-control" placeholder="Name of company">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <span class="required" aria-required="true"> * </span>
                                        <input data-required="1" type="text" name="phone" value="{{Request::old('phone')}}" class="form-control" placeholder="Phone number">
                                    </div>
                                </div>
                            </div>
        
                            <!--<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Active</label><br/>
                                        <input name="is_Active" value="1" type="checkbox" checked class="make-switch form-control" data-size="small">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Subscription Type</label>
                                        <select disabled data-required="1" type="text" id="subscription_type" name="subscription_type"  class="form-control" placeholder="Establishment Year">
                                            <option value="">N/A</option>
                                            <option value="monthly" @if( Request::old('subscription_type') == 'monthly') selected="" @endif>Monthly</option>
                                            <option value="annually" @if( Request::old('subscription_type') == 'annually') selected="" @endif>Annually</option>
                                        </select>
                                    </div>
                                </div>
                            </div>-->
        
                            <!--<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Authorized Contact:</label>
                                        <select id="select2-button-addons-single-input-group-sm" name="owner_id" class="form-control col-md-12 js-data-company-ajax" ></select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Company Package</label>
                                        <span class="required" aria-required="true"> * </span>
                                        <select data-required="1" type="text" id="account_id" name="account_id" class="form-control" placeholder="Establishment Year">
                                            @foreach($packages as $package)
                                            <option value="{{ $package->id }}">{{$package->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>-->
        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <span class="required" aria-required="true"> * </span>
                                        <input data-required="1" type="text" name="email" value="{{Request::old('phone')}}" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Website</label>
                                        <input data-required="1" type="text" name="website" value="{{Request::old('website')}}" class="form-control" placeholder="Website">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Address1</label>
                                        <span class="required" aria-required="true"> * </span>
                                        <textarea data-required="1" type="text" name="address" class="form-control" placeholder="Address">{{Request::old('address')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Address2</label>
                                        <textarea  name="address2" class="form-control" placeholder="Address 2">{{Request::old('address2')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <span class="required" aria-required="true"> * </span>
                                        <input data-required="1" type="text" name="city" value="{{Request::old('city')}}" class="form-control" placeholder="City">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">State</label>
                                        <span class="required" aria-required="true"> * </span>
                                        <input data-required="1" type="text" name="state" value="{{Request::old('state')}}" class="form-control" placeholder="State">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Zip Code</label>
                                        <span class="required" aria-required="true"> * </span>
                                        <input data-required="1" type="text" name="zip" value="{{Request::old('zip')}}" class="form-control" placeholder="Zip">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <span class="required" aria-required="true"> * </span>
                                        <select name="country" class="form-control selectCountry" id="country-dropdown">
                                        <option value="">Please Select Country</option>
                                        @if(Request::old('country'))
                                            @foreach($countries as $country)
                                                @if(Request::old('country') == $country->country_name)
                                                    <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                                                @else
                                                    <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach($countries as $country)
                                                @if($userData->country == $country->country_name)
                                                    <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                                                @else
                                                    <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="company-optional-details" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea data-required="1" type="text" name="description" class="form-control" placeholder="Description">{{Request::old('description')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Establishment Year</label>
                                        <input data-required="1" type="text" name="establishment_year" value="{{Request::old('establishment_year')}}" class="form-control" placeholder="Establishment Year">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Export Start Year</label>
                                        <input data-required="1" type="text" name="export_start_year" value="{{Request::old('export_start_year')}}" class="form-control" placeholder="Export Start Year">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Number of Employees</label>
                                        <select data-required="1" type="text" name="employees_count" class="form-control" placeholder="Establishment Year">
                                            <option value="1-10" @if( Request::old('employees_count') == '1-10') selected="" @endif>1-10</option>
                                            <option value="11-50" @if( Request::old('employees_count') == '11-50') selected="" @endif>11-50</option>
                                            <option value="51-100" @if( Request::old('employees_count') == '51-100') selected="" @endif>51-100</option>
                                            <option value="101-250" @if( Request::old('employees_count') == '101-250') selected="" @endif>101-250</option>
                                            <option value="250-1000" @if( Request::old('employees_count') == '250-1000') selected="" @endif>250-1000</option>
                                            <option value="1000+" @if( Request::old('employees_count') == '1000+') selected="" @endif>1000+</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Total Sales</label>
                                        <input data-required="1" type="text" name="total_sales" value="{{Request::old('total_sales')}}" class="form-control" placeholder="Total Sales">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Trade Capacity</label>
                                        <input data-required="1" type="text" name="trade_capacity" value="{{Request::old('total_sales')}}" class="form-control" placeholder="Trade Capacity">
                                    </div>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Production Capacity</label>
                                        <input data-required="1" type="text" name="production_capacity" value="{{Request::old('production_capacity')}}" class="form-control" placeholder="Production Capacity">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">R & D Capacity</label>
                                        <input data-required="1" type="text" name="r&d_capacity" value="{{Request::old('r&d_capacity')}}" class="form-control" placeholder="R D Capacity">
                                    </div>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Production Line Count</label>
                                        <input data-required="1" type="text" name="production_line_count" value="{{Request::old('production_line_count')}}" class="form-control" placeholder="Production Line Count">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Languages</label>
                                        <select id="single" name="languages[]" class="form-control selectLanguage" multiple="">
                                            <option></option>
                                            @if(Request::old('languages'))
                                                @foreach($languages as $language)
                                                    @if(in_array($language->name,Request::old('languages')))
                                                        <option value="{{$language->name}}" selected="">{{$language->name}}</option>
                                                    @else
                                                        <option value="{{$language->name}}">{{$language->name}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach($languages as $language)
                                                <option value="{{$language->name}}">{{$language->name}}</option>
                                                @endforeach
                                            @endif
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Customer Care Contact Name	</label>
                                        <input data-required="1" type="text" name="customer_care_contact_name" value="{{Request::old('customer_care_contact_name')}}" class="form-control" placeholder="Customer Care Contact Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Customer Care Email</label>
                                        <input data-required="1" type="text" name="customer_care_email" value="{{Request::old('customer_care_email')}}" class="form-control" placeholder="Customer Care Email">
                                    </div>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Customer Care Phone</label>
                                        <input data-required="1" type="text" name="customer_care_phone" value="{{Request::old('customer_care_phone')}}" class="form-control" placeholder="Customer Care Phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Accepted Delivery Terms</label>
                                        <textarea data-required="1" type="text" name="accepted_delivery_terms" class="form-control" placeholder="Accepted Delivery Terms">{{Request::old('accepted_delivery_terms')}}</textarea>
                                    </div>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Accepted Payment Currency</label>
                                        <input data-required="1" type="text" name="accepted_payment_currency" value="{{Request::old('accepted_payment_currency')}}" class="form-control" placeholder="Accepted Payment Currency">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Accepted Payment Types</label>
                                        <input data-required="1" type="text" name="accepted_payment_type" value="{{Request::old('accepted_payment_type')}}" class="form-control" placeholder="Accepted Payment Types">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Average Lead Time</label>
                                        <input data-required="1" type="text" name="average_lead_time" value="{{Request::old('average_lead_time')}}" class="form-control" placeholder="Average Lead Time">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Custom URL</label>
                                        <input readonly data-required="1" type="text" id="unique_company_url" value="{{Request::old('unique_company_url')}}" name="unique_company_url" class="form-control" placeholder="Custom URL">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Facebook Url</label>
                                        <input type="text" name="facebook_url" value="{{Request::old('facebook_url')}}" class="form-control" placeholder="Facebook Url">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Google+ Url</label>
                                        <input type="text" name="google_plus" value="{{Request::old('google_plus')}}" class="form-control" placeholder="Google+ Url">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">LinkedIn Url</label>
                                        <input type="text" name="linkedin" value="{{Request::old('linkedin')}}" class="form-control" placeholder="LinkedIn Url">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Instagram Url</label>
                                        <input type="text" name="insta_url" value="{{Request::old('insta_url')}}" class="form-control" placeholder="Instagram Url">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Pintress Url</label>
                                        <input type="text" name="pintress_url" value="{{Request::old('pintress_url')}}" class="form-control" placeholder="Pintress Url">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Youtube Url</label>
                                        <input type="text" name="youtube_url" value="{{Request::old('youtube_url')}}" class="form-control" placeholder="Youtube Url">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="main-action-button" class="form-actions right padding-top align-right" style="display: none;">
                        <a href="javascript:void(0);" onclick="showBasic();" class="btn btn-circle default button-previous">
                            <i class="fa fa-angle-left"></i> Back </a>
                        <button type="submit" class="btn btn-circle yellow-crusta color-black button-next"> Continue
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                    <div id="sub-action-button" class="form-actions right padding-top align-right">
                        <!--<a href="{{url('user-details')}}" class="btn btn-circle default button-previous">
                            <i class="fa fa-angle-left"></i> Back </a>-->
                        <button type="button" onclick="ShowOptional()" class="btn btn-circle yellow-crusta color-black button-next"> Continue
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                    {!! Form::close() !!}
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function ShowOptional()
{
    $('#company-logo').hide();
    $('#main-company-details').hide();
    $('#company-optional-details').show();
    $('#sub-action-button').hide();
    $('#main-action-button').show();
    $('#compnay-first').removeClass('active');
    $('#compnay-first').addClass('done');
    $('#compnay-second').addClass('active');
    $('#company-progras').width('100%')
}

function showBasic()
{
    $('#company-logo').show();
    $('#main-company-details').show();
    $('#company-optional-details').hide();
    $('#sub-action-button').show();
    $('#main-action-button').hide();
    $('#compnay-first').removeClass('done');
    $('#compnay-first').addClass('active');
    $('#compnay-second').removeClass('active');
    $('#company-progras').width('50%')
}



$(document).on("keyup", "#name", function () {
        if($('#account_id').val() == 1){
            return;
        }
        var val = $('#name').val();
        val = val.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
        $('#unique_company_url').val(val);
    });

    $( "#account_id" ).change(function() {
        if($('#account_id').val() == 1){
            $('#unique_company_url').val("");
            $("#unique_company_url").prop("readonly", true);
            $("#subscription_type").prop("disabled", true);
        }else{
            $("#unique_company_url").prop("readonly", false);
            var val = $('#name').val();
            val = val.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
            $('#unique_company_url').val(val);
            $("#subscription_type").prop("disabled", false);
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
                        $('#logo').val(response.fullURL);
                    },

                    error: function(file, response){
                        alert('Invalid File');
                    }
                }
            }
        };
    }();

    jQuery(document).ready(function() {
        FormDropzone.init();
        
        var placeholder = "Select a Language";

        $(".selectLanguage").select2({
            placeholder: placeholder,
            width: null
        });
        
        var Countryplaceholder = "Select a Country";

        $(".selectCountry").select2({
            placeholder: Countryplaceholder,
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

$(".js-data-company-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/compnay/ownerSearch",
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
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}" type="text/javascript"></script>
<!--<script src="{{URL::asset('metronic/pages/scripts/form-wizard.min.js')}}" type="text/javascript"></script>-->
@endsection
