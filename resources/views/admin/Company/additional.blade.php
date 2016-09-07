@extends('admin.app')

@section('content')
<style>
.select2-container{display: block!important;}
.mt-element-step .step-line .mt-step-title{font-size: 17px!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<!--<link href="{{URL::asset('metronic/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />-->
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url('sa')}}">Home</a>
            <i class="fa fa-circle"></i>
            @else
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
            @endif
        </li>
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url('companies')}}">Companies</a>
            <i class="fa fa-circle"></i>
            @endif
        </li>
        <li>
            <span>Add Company</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">

<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
 <i class="fa fa-plus color-black"></i> Company Information
</h3>

</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="col-md-12">
            <div  class="portlet-body form">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="col-md-12 padding-top">
                    <p class="caption-helper">Add any information that may apply to your company. This will help other users learn more about you.</p>
                </div>
                <!-- responsive -->
                <div id="responsive" class="modal fade" tabindex="-1" data-width="760">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add New Accreditation and Certification</h4>
                    </div>
                    <form action="{{url('company/certification/save')}}" method="post" class="horizontal-form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="id" value="" />
                        <input type="hidden" name="company_id" value="{{$company->id}}" />
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Name Of Accreditation:</label>
                        				<input type="text" class="form-control" name="certification_name" placeholder="Name Of Accreditation">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Issuing Authority:</label>
                        				<input type="text" class="form-control" name="certifying_authority" placeholder="Issuing Authority">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Date Received:</label>
                                        <div class="">
                                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control" name="date_received">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-circle default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Valid Till:</label>
                                        <div class="">
                                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control" name="valid_till">
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-circle default" data-dismiss="modal">Close</button>
                            <button type="submite" class="btn btn-circle blue">Save</button>
                        </div>
                    </form>
                </div>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="mt-element-step">
                <div class="row step-line">
                    <div id="company-first" class="col-md-3 mt-step-col first done">
                        <div class="mt-step-number bg-white"><i class="fa fa-check"></i></div>
                        <div class="mt-step-title uppercase font-grey-cascade">Contact Information</div>
                    </div>
                    <div id="company-forth" class="col-md-3 mt-step-col done">
                        <div class="mt-step-number bg-white"><i class="fa fa-check"></i></div>
                        <div class="mt-step-title uppercase font-grey-cascade">Company Administrator</div>
                    </div>
                    <div id="company-second" class="col-md-3 mt-step-col active">
                        <div class="mt-step-number bg-white">3</div>
                        <div class="mt-step-title uppercase font-grey-cascade">Company Information</div>
                    </div>
                    <div id="company-third" class="col-md-3 mt-step-col last">
                        <div class="mt-step-number bg-white">4</div>
                        <div class="mt-step-title uppercase font-grey-cascade">Media Center</div>
                    </div>
                </div>
                </div>
                <div class="yellow-crusta-seprator"></div>
                <!-- BEGIN FORM-->
                <form action="{{url('company/additional/save')}}" method="post" class="horizontal-form form-horizontal form-row-seperated">
                <div class="form-body padding-15">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" name="company_id" value="{{$company->id}}" />
                    @if(isset($_REQUEST['setup']))
                    <input type="hidden" name="profile_first_time" value="1" />
                    @endif
                    <div id="company-optional-details">
                        <!-- Industry Information section -->
                        <h3 class="block bold font-red-mint align-left"><span style="font-size: 19px!important;">Your Company Information</span></h3>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Which industry do you serve:</label>
                            <div class="col-md-12 paddin-npt">
                                <select id="industry-select" name="company_industries[]" class="form-control selectIndustry" id="indutries-dropdown" multiple>
                                    @foreach($industries as $industry)
                                        @if(in_array($industry->id,$selectedIndustry))
                                        <option value="{{$industry->id}}" selected="">{{$industry->name}}</option>
                                        @else
                                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">What best describes your industrial offering:</label>
                            <div class="col-md-12 paddin-npt">
                                <select id="single" name="company_types[]" class="form-control selectCompanyType" multiple>
                                    <option></option>
                                    @foreach($companyTypes as $companyType)
                                        @if(in_array($companyType->id,$selectedCompanyType))
                                        <option value="{{$companyType->id}}" selected="">{{$companyType->name}}</option>
                                        @else
                                        <option value="{{$companyType->id}}">{{$companyType->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Please provide a brief description of your company:</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea data-required="1" type="text" name="description" class="form-control" placeholder="Add 3-5 lines to describe your company.">{{$company->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Which product-category types are you interested in Purchasing or Supplying?</label>
                            <div class="col-md-12 paddin-npt">
                                <select id="select2-button-addons-single-input-group-sm" name="company_categories[]" class="form-control col-md-12 js-data-category-ajax" multiple>
                                    @foreach ($company->categories as $category)
                                    <option value="{{ $category->category->id }}" selected="">{{ $category->category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Do you offer any Industrial Services? Search and Add them here:</label>
                            <div class="col-md-12 paddin-npt">
                                <select id="company_techservice" name="company_techservice[]" class="form-control selectCompanyTechService" multiple>
                                    <option></option>
                                    @foreach($techServices as $techService)
                                        @if(in_array($techService->id,$selectedCompanyTech))
                                        <option value="{{$techService->id}}" selected="">{{$techService->name}}</option>
                                        @else
                                        <option value="{{$techService->id}}">{{$techService->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Accreditations and Certifications section -->
                        <h3 class="block bold font-red-mint  align-left">
                            <span style="font-size: 19px!important;">Certifications & Awards</span> 
                        </h3>
                        <div class="form-group">
                           
                                <h4 class="paddin-bottom col-md-12 paddin-npt">Does your Company have any Accreditations or Certifications?</h4>
                            <div class="col-md-12 paddin-bottom paddin-npt">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                    <tr>
                                        <th> Name Of Accreditation </th>
                                        <th>Issuing Authority</th>
                                        <th>Received Date</th>
                                        <th>Valid Till</th>
                                        <th> Action </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($company->companyCertifications as $certification)
                                        <tr>
                                            <td>{{$certification->certification_name}}</td>
                                            <td>{{$certification->certifying_authority}}</td>
                                            <td>{{$certification->date_received}}</td>
                                            <td>{{$certification->valid_till}}</td>
                                            <td>
                                                <a href="javascript:void(0)" id="{{url('company/certification/edit')}}/{{$certification->id}}" onclick="showEditModal(id)" class="btn btn-circle btn-success btn-sm">
                                                    <i class="fa fa-edit"></i> Edit </a>
                                                <a href="javascript:void(0)" id="{{url('company/certification/confirm')}}/{{$certification->id}}" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">
                                                    <i class="fa fa-remove"></i> Delete </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 paddin-npt">
                                <button type="button" id="{{url('company/certification/add')}}/certification" class="btn btn-circle yellow-crusta color-black" onclick="showAddModal(id)"><i class="fa fa-plus"></i> Add Details</button>
                            </div>
                        </div>
                        <!-- Optional Information section -->
                        <h3 class="block font-red-mint  bold align-left"><span style="font-size: 19px!important;">Optional Company Information</span></h3>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">What year were you established?</label>
                            <div class="col-md-12 paddin-npt">
                                <input type="text" name="establishment_year" value="{{$company->establishment_year}}" class="form-control" placeholder="What year were you established?">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">How many employees do you have?</label>
                            <div class="col-md-12 paddin-npt">
                                <select name="employees_count" class="form-control">
                                    <option value="">Please Select</option>
                                    <option value="1-10" @if($company->employees_count == '1-10') selected="" @endif>1-10</option>
                                    <option value="11-50" @if($company->employees_count == '11-50') selected="" @endif>11-50</option>
                                    <option value="51-100" @if($company->employees_count == '51-100') selected="" @endif>51-100</option>
                                    <option value="101-250" @if($company->employees_count == '101-250') selected="" @endif>101-250</option>
                                    <option value="250-1000" @if($company->employees_count == '250-1000') selected="" @endif>250-1000</option>
                                    <option value="1000+" @if($company->employees_count == '1000+') selected="" @endif>1000+</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">What is your estimated total annual sales?</label>
                            <div class="col-md-12 paddin-npt">
                                <!--<input type="text" name="total_sales" value="{{$company->total_sales}}" class="form-control" placeholder="Enter an amount">-->
                                <select class="form-control" name="total_sales">
                                    <option value="">Please Select</option>
                                    <option value="Under $100,000" @if($company->total_sales == 'Under $100,000') selected="" @endif>Under $100,000</option>
                                    <option value="$100,000 to $500,000" @if($company->total_sales == '$100,000 to $500,000') selected="" @endif>$100,000 to $500,000</option>
                                    <option value="$500,000 to $1 Million" @if($company->total_sales == '$500,000 to $1 Million') selected="" @endif>$500,000 to $1 Million</option>
                                    <option value="$1-5 Million" @if($company->total_sales == '$1-5 Million') selected="" @endif>$1-5 Million</option>
                                    <option value="$5 Million +" @if($company->total_sales == '$5 Million +') selected="" @endif>$5 Million +</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Optional Exporter Trade Details section -->
                        <h3 class="block bold font-red-mint  align-left"><span style="font-size: 19px!important;">Trade & Export Details <span style="font-size: 14px;vertical-align: top; red">(optional)</span></span></h3>
                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right-15">
                                <label class="col-md-12 paddin-npt">What's your total Trade Capacity?</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="trade_capacity" value="{{$company->trade_capacity}}" class="form-control" placeholder="Enter an amount.">
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">What's your total Production Capacity?</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="production_capacity" value="{{$company->production_capacity}}" class="form-control" placeholder="Enter an amount">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right-15">
                                <label class="col-md-12 paddin-npt">What's your total R & D Capacity? </label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="r&d_capacity" value="{{$company->rAndD}}" class="form-control" placeholder="Enter an amount">
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">How many production lines do you have ? </label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="production_line_count" value="{{$company->production_line_count}}" class="form-control" placeholder="Enter an amount">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Optional Delivery and Payment Details section -->
                        <h3 class="block font-red-mint  bold align-left"><span style="font-size: 19px!important;">Delivery and Payment Details</span></h3>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">What are your Accepted Delivery Terms? <span style="font-size: 12px;vertical-align: top; red">(optional)</span></label>
                            <div class="col-md-12 paddin-npt">
                                <textarea name="accepted_delivery_terms"  class="form-control auto_expand" placeholder="Enter your delivery details here.">{{$company->accepted_delivery_terms}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">What are your Accepted Payment Types</label>
                            <div class="col-md-12 paddin-npt">
                                <!--<input type="text" name="accepted_payment_type" value="{{$company->accepted_payment_type}}" class="form-control" placeholder="What are your Accepted Payment Types">-->
                                <select name="accepted_payment_type[]" class="form-control selectPaymentType" id="payment-type-dropdown" multiple>
                                    @foreach($payment_acceptes as $payment_accepte)
                                        @if(in_array($payment_accepte['id'],$accepted_payment_types))
                                            <option value="{{$payment_accepte['id']}}" selected="">{{$payment_accepte['name']}}</option>
                                        @else
                                            <option value="{{$payment_accepte['id']}}">{{$payment_accepte['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">What is your accepted payment currency?</label>
                            <div class="col-md-12 paddin-npt">
                                <select name="accepted_payment_currency[]" class="form-control selectPaymentCurrency" id="payment-type-dropdown" multiple>
                                    @foreach($payment_currencies as $payment_currency)
                                        @if(in_array($payment_currency->id,$accepted_payment_currency))
                                            <option value="{{$payment_currency->id}}" selected="">{{$payment_currency->name_code}}</option>
                                        @else
                                            <option value="{{$payment_currency->id}}">{{$payment_currency->name_code}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!-- Social Profile Links section -->
                        <h3 class="block font-red-mint  bold align-left"><span style="font-size: 19px!important;">Social Media</span></h3>
                        <p class="caption-helper">Enter your social media profile links:</p>
                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right-15">
                                <label class="col-md-12 paddin-npt">Facebook Profile</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="facebook_url" value="{{$company->facebook_url}}" class="form-control" placeholder="Facebook Profile">
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">LinkedIn Profile</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="linkedin" value="{{$company->linkedin}}" class="form-control" placeholder="LinkedIn Profile">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                             <div class="col-md-6 paddin-npt padding-right-15">
                                <label class="col-md-12 paddin-npt">Twitter Profile</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="twitter_url" value="{{$company->twitter_url}}" class="form-control" placeholder="Twitter Profile">
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">Youtube Profile</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="youtube_url" value="{{$company->youtube_url}}" class="form-control" placeholder="Youtube Profile">
                                </div>
                            </div>
                        </div>
                       
    
    
                        <!--<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Export Start Year</label>
                                    <input data-required="1" type="text" name="export_start_year" value="{{Request::old('export_start_year')}}" class="form-control" placeholder="Export Start Year">
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                        </div>
                        
    
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Language</label>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Average Lead Time</label>
                                    <input data-required="1" type="text" name="average_lead_time" value="{{Request::old('average_lead_time')}}" class="form-control" placeholder="Average Lead Time">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                
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
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Custom URL</label>
                                    <input readonly data-required="1" type="text" id="unique_company_url" name="unique_company_url" value="{{Request::old('unique_company_url')}}" class="form-control" placeholder="Custom URL">
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                
                <div id="sub-action-button" class="form-actions right padding-top align-right">
                    @if(isset($_REQUEST['setup']))
                    <a href="{{url('company/admin')}}/{{$company->id}}?setup=profile" class="btn btn-circle  red button-next"> <i class="fa fa-angle-left"></i> Go Back</a>
                    @else
                    <a href="{{url('company/admin')}}/{{$company->id}}" class="btn btn-circle  red button-next"> <i class="fa fa-angle-left"></i> Go Back</a>
                    @endif
                    
                    <button type="submit" class="btn btn-circle yellow-crusta color-black bold"> Proceed to Media Center <i class="fa fa-angle-right"></i></button>
                </div>
                </form>
                <!-- END FORM-->
            </div>
</div>
</div>
</div>
<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
<script>
/* for show menu active */
$("#compnay-main-menu").addClass("active");
$('#compnay-main-menu' ).click();
$('#conpmay-menu-arrow').addClass('open');
$('#create-compnay-menu').addClass('active');
/* end menu active */
function showAddModal(id)
{
    
    $('#responsive').modal('show');
    $('.date-picker').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        autoclose: true
    });
}
function showEditModal(id)
{
    
      var url = id;
      $.ajax({
        url: url,
        type: 'get',
        success: function(data) {
            $('#responsive').html('');
            $('#responsive').html(data.html);
            $('#responsive').modal('show');
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
        },   
        done: function() {
            //console.log('error');
            Metronic.unblockUI('#item-data');
        },
        error: function() {
            //console.log('error');
            Metronic.unblockUI('#item-data');
        }
        
    });
}
function showDeleteModal(id)
{
    
      var url = id;
      $.ajax({
        url: url,
        type: 'get',
        success: function(data) {
            $('#responsive').html('');
            $('#responsive').html(data.html);
            $('#responsive').modal('show');
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
        },   
        done: function() {
            //console.log('error');
            Metronic.unblockUI('#item-data');
        },
        error: function() {
            //console.log('error');
            Metronic.unblockUI('#item-data');
        }
        
    });
}
jQuery(document).ready(function() {
    var placeholder = "Select a Language";
    $(".selectLanguage").select2({
        placeholder: placeholder,
        width: null
    });
    
    var PaymentAcceptplaceholder = "Type and Select all that apply";
    $(".selectPaymentType").select2({
            placeholder: PaymentAcceptplaceholder,
            width: null
        });
    var PaymentCurrencyplaceholder = "Type and Select all that apply";
    $(".selectPaymentCurrency").select2({
            placeholder: PaymentCurrencyplaceholder,
            width: null
        });
    
    var companyTypeplaceholder = "Click and Select the Most Applicable";

    $(".selectCompanyType").select2({
        placeholder: companyTypeplaceholder,
        width: null
    });
    
    var companyTechplaceholder = "Type and Select the Most Applicable Services";

    $(".selectCompanyTechService").select2({
        placeholder: companyTechplaceholder,
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

var categoryPlaceholder = "Type and select up to twelve products or categories";   
$(".js-data-category-ajax").select2({
    placeholder: categoryPlaceholder,
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
jQuery(document).ready(function() {
    
    var placeholder = "Type and Select One or more industries";
    $(".selectIndustry").select2({
            placeholder: placeholder,
            width: null
        });
});

</script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<!--<script src="{{URL::asset('metronic/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>-->
<script >
var textarea = document.querySelector('textarea.auto_expand');

textarea.addEventListener('keydown', autosize);
             
function autosize(){
  var el = this;
  setTimeout(function(){
    el.style.cssText = 'height:auto; padding:0';
    // for box-sizing other than "content-box" use:
    // el.style.cssText = '-moz-box-sizing:content-box';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}
</script>
@endsection
