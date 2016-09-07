@extends('buyer.app')

@section('content')
<style>
.checkbox input[type=checkbox], .checkbox-inline input[type=checkbox], .radio input[type=radio], .radio-inline input[type=radio]{margin-left: -10px!important;}
.form-horizontal .checkbox, .form-horizontal .radio{min-height: 36px;}
</style>
<style>
.select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('referral/payment-info')}}">Payment Settings</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Edit Cheque Payment</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Edit Cheque Details</div>
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
                <form action="{{url('referral/payment/cheque/update')}}" method="POST" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <input name="cheque_id" value="{{$cheque->id}}" type="hidden" />
                    <input type="hidden" name="user_id" value="{{$cheque->user_id}}" />
                    <input type="hidden" name="payment_via" value="Cheque" />
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Payee Full Name<span class="required" aria-required="true"> * </span></label>
                                <input data-required="1" type="text" name="payee_name" value="{{$cheque->payee_name}}" class="form-control" placeholder="Payee Full Name">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Company Name</label>
                                <input type="text" name="company_name" value="{{$cheque->company_name}}" class="form-control" placeholder="Company Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Address Line 1<span class="required" aria-required="true"> * </span></label>
                                <input data-required="1" type="text" name="address1" value="{{$cheque->address1}}" class="form-control" placeholder="Address Line 1">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Address Line 2</label>
                                <input type="text" name="address2" class="form-control" value="{{$cheque->address2}}" placeholder="Address Line 2">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Country<span class="required" aria-required="true"> * </span></label>
                                <select name="country" class="form-control select2" id="country-dropdown">
                                    @foreach($countries as $country)
                                        @if($cheque->country == $country->country_name)
                                            <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                                        @else
                                            <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">State/Region<span class="required" aria-required="true"> * </span></label>
                                <input type="text" name="state" class="form-control" value="{{$cheque->state}}" placeholder="State/Region">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">City<span class="required" aria-required="true"> * </span></label>
                                <input data-required="1" type="text" name="city" value="{{$cheque->city}}" class="form-control" placeholder="City">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Postal Code<span class="required" aria-required="true"> * </span></label>
                                <input type="text" name="zip" class="form-control" value="{{$cheque->zip}}" placeholder="Postal Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Phone Number<span class="required" aria-required="true"> * </span></label>
                                <input data-required="1" type="text" name="phone" value="{{$cheque->phone}}" class="form-control" placeholder="Phone Number">
                            </div>
                        </div> 
                        <div id="taxt-info" style="display: none;">
                            <h3>Tax Information</h3>
                            <div id="for-us-only" style="display: none;">
                                <p>Your privacy is very important to us - this tax information will be encrypted and stored securely. 
                                All information you provide below MUST match the name and tax identification number information on file with the IRS - YOU WILL NOT RECEIVE PAYMENT UNLESS YOUR LEGAL NAME AND THE TAX ID INFORMATION MATCHES WHAT THE IRS HAS ON FILE. 
                                </p>
                                <p>For individuals, please provide your Social Security Number. For any other type of entity, please provide the exact Legal Name and Federal Employer Identification Number (EIN) or Social Security Number (SSN) information you provided in your Application for Employer Identification Number (Form SS-4). 
                                If you do not remember what information you provided, please call the IRS Business and Specialty Tax line at 1-800-829-4933.
                                </p>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label col-md-3">Legal Name<span class="required" aria-required="true"> * </span></label>
                                        <div class="col-md-9">
                                            <input data-required="1" type="text" name="legal_name" value="{{$cheque->legal_name}}" class="form-control" placeholder="Legal Name">
                                        </div>
                                    </div>
                                </div>
                                <p>
                                Your Legal Name must match the name associated with the Social Security Number or the Federal Employer Identification Number provided below.
                                </p>
                                <div class="form-group">
                                    <div class="col-md-12">
                                    <input type="radio" name="account_type" value="1" @if($cheque->account_type == 1) checked="" @endif />I am registering this account as an individual, sole proprietor with no EIN, or other business entity with no EIN.
                                    </div>
                                    <div id="account_type1" class="col-md-6 desc" style="display: none;">
                                        <label class="control-label">Social Security Number<span class="required" aria-required="true"> * </span></label>
                                        <input data-required="1" type="text" name="social_security_number" id="mask_ssn" value="{{$cheque->social_security_number}}" class="form-control" placeholder="Social Security Number">
                                        <p>For Example: 123-45-6789</p>
                                    </div>
                                    
                                    <div class="col-md-12">
                                    <input type="radio" name="account_type" value="2" @if($cheque->account_type == 2) checked="" @endif />I reside in the United States, and am registering this account as a corporation, sole proprietor, partnership, unincorporated non-profit association, non-profit organization, or other business entity type. This business entity is formally registered with the IRS and has an EIN.
                                    </div>
                                    <div id="account_type2" class="col-md-6 desc" style="display: none;">
                                        <label class="control-label">Federal Employer Identification Number (EIN)<span class="required" aria-required="true"> * </span></label>
                                        <input data-required="1" type="text" name="federal_employer_identification_number" id="mask_tin" value="{{$cheque->federal_employer_identification_number}}" class="form-control" placeholder="Federal Employer Identification Number (EIN)">
                                        <p>For Example: 12-3456789</p>
                                    </div>
                                    
                                </div>
                                <p>You will be paid according to the User Agreement - essentially thirty (30) days after the end of the month during which your Earnings.</p>
                            </div>
                            <div id="for-all-other" style="display: none;">
                                <p>Because you reside outside the United States and IndyGrid is a US-based corporation, we are required by law to collect a signed IRS W-8 BEN form from you before we can authorize payment on your account. </p>
                                <p><a href="{{url('')}}/public/export/fw8ben.pdf" download><b>Click here for DOWNLOAD W-8 BEN Form</b></a></p>
                                <p><b>Once downloaded, please make sure you:</b></p>
                                <ul>
                                    <li>Please verify the information, sign it and date it.</li>
                                    <li>Fill out any other information required.</li>
                                    <li>E-mail the form to <a href="mailto:referrals@indygrid.com">referrals@indygrid.com</a></li>
                                </ul>
                                <p>Please contact Customer Support if you have any questions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a href="{{url('referral/payment-info')}}" class="btn btn-circle btn-sm">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle blue">
                            <i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
/* for show menu active */
$("#referrals-main-menu").addClass("active");
$('#referrals-main-menu' ).click();
$('#referrals-menu-arrow').addClass('open');
$('#referral-payment-info-menu').addClass('active');
/* end menu active */
jQuery(document).ready(function() {
    var placeholder = "Select a Country";
    
    $(".select2").select2({
        placeholder: placeholder,
        width: null
    });
    
});
$(document).ready(function(){
    var country = '{{$cheque->country}}';
    var account_type = '{{$cheque->account_type}}';
    
    if(country == 'United States')
    {
        $("#taxt-info").show();
        $('#for-us-only').show();
        $('#for-all-other').hide();
    }
    else
    {
        $("#taxt-info").show();
        $('#for-us-only').hide();
        $('#for-all-other').show();
    }
    
    $("div.desc").hide();
    $("#account_type" + account_type).show();
});
$("input[name$='account_type']").click(function() {
    var test = $(this).val();

    $("div.desc").hide();
    $("#account_type" + test).show();
});
 $('#country-dropdown').on('change', function() {
  if ( this.value == 'United States')
  {
    $("#taxt-info").show();
    $('#for-us-only').show();
    $('#for-all-other').hide();
  }
  else
  {
    $("#taxt-info").show();
    $('#for-us-only').hide();
    $('#for-all-other').show();
  }
});
</script>
<script src="{{URL::asset('metronic/pages/scripts/form-input-mask.min.js')}}" type="text/javascript"></script>
@endsection
