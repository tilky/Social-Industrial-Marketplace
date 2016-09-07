@extends('buyer.app')



@section('content')
<style>

.checkbox input[type=checkbox], .checkbox-inline input[type=checkbox], .radio input[type=radio], .radio-inline input[type=radio]{margin-left: -10px!important;}

.form-horizontal .checkbox, .form-horizontal .radio{min-height: 36px;}

</style>
<style>

.select2-container{display: block!important;}

</style>
<!--<link href="{{URL::asset('metronic/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />-->
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <a href="{{url('referrals')}}">Referrals</a> <i class="fa fa-circle"></i> </li>
    <li> <span>About Proram</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom">
      <h3 class="page-title uppercase"> <i class="fa fa-money color-black"></i> Payout Options </h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12">
        <div class="portlet-body form" id="blockui_sample_1_portlet_body"> @if (Session::has('message'))
          <div id="" class="custom-alerts alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            {{ Session::get('message') }}</div>
          @endif 
          
          <!-- BEGIN EXAMPLE TABLE PORTLET--> 
          
          @if($errors->any())
          <div class="alert alert-danger" style="float: left;width: 100%;"> @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach </div>
          @endif 
          
          <!-- Paypal Form start -->
          
          <form id="payment-form" action="{{url('referral/payment/paypal/save')}}" method="POST" class="form-horizontal">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="hidden" name="user_id" value="{{$user_id}}" />
            <div class="form-body">
              <h3>How do you want to be paid?</h3>
              <div class="form-group">
                <div class="col-md-12">
                  <div>
                   <label class="control-label"> <input type="radio" name="payment_via" @if($paymentInfo) @if($paymentInfo->
                    payment_via == "Paypal") checked="" @endif @else @if(Request::old('payment_via') == "Paypal") checked="" @endif @endif value="Paypal"  />  Request Payment via PayPal</label> </div>
                  <div>
                  <div class="col-md-12">
                    <label class="col-md-12" style="font-size: 17px!important;"><span class="required" aria-required="true"> * </span>Please enter the email address for your PayPal account: </label>
                    <div class="col-md-12">
                      <input data-required="1" type="text" name="paypal_email" @if($paymentInfo) value="{{$paymentInfo->paypal_email}}" @else value="{{Request::old('paypal_email')}}" @endif class="form-control" placeholder="Paypal Email">
                    </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <label class="control-label"><input type="radio" name="payment_via" @if($paymentInfo) @if($paymentInfo->
                  payment_via == "Cheque") checked="" @endif @else @if(Request::old('payment_via') == "Cheque") checked="" @endif @endif value="Cheque"  /> Request Payment via Check</label> </div>
              </div>
              <div class="black_line"></div>
              <h3 class="padding-top">Payee Information:</h3>
              <div class="form-group">
                <div class="col-md-6">
                  <label class="control-label">Payee Full Name<span class="required" aria-required="true"> * </span></label>
                  <input data-required="1" type="text" name="payee_name" @if($paymentInfo) value="{{$paymentInfo->payee_name}}" @else value="{{Request::old('payee_name')}}" @endif  class="form-control" placeholder="Payee Full Name">
                </div>
                <div class="col-md-6">
                  <label class="control-label">Company Name</label>
                  <input type="text" name="company_name" @if($paymentInfo) value="{{$paymentInfo->company_name}}" @else value="{{Request::old('company_name')}}" @endif class="form-control" placeholder="Company Name">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
                  <label class="control-label">Address Line 1<span class="required" aria-required="true"> * </span></label>
                  <input data-required="1" type="text" name="address1" @if($paymentInfo) value="{{$paymentInfo->address1}}" @else value="{{Request::old('address1')}}" @endif class="form-control" placeholder="Address Line 1">
                </div>
                <div class="col-md-6">
                  <label class="control-label">Address Line 2</label>
                  <input type="text" name="address2" class="form-control" @if($paymentInfo) value="{{$paymentInfo->address2}}" @else value="{{Request::old('address2')}}" @endif placeholder="Address Line 2">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
                  <label class="control-label">Country<span class="required" aria-required="true"> * </span></label>
                  <select name="country" class="form-control select2" id="country-dropdown">
                    <option value="">Please Select Country</option>
                    

                                    @if($paymentInfo)

                                        @foreach($countries as $country)

                                            @if($paymentInfo->country == $country->country_name)

                                                
                    <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                    

                                            @else

                                                
                    <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                    

                                            @endif

                                        @endforeach

                                    @elseif(Request::old('country'))

                                        @foreach($countries as $country)

                                            @if(Request::old('country') == $country->country_name)

                                                
                    <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                    

                                            @else

                                                
                    <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                    

                                            @endif

                                        @endforeach

                                    @else

                                        @foreach($countries as $country)

                                            @if($country->country_name == 'United States')

                                                
                    <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                    

                                            @else

                                                
                    <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                    

                                            @endif

                                        @endforeach

                                    @endif

                                
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="control-label">State/Region<span class="required" aria-required="true"> * </span></label>
                  <input type="text" name="state" class="form-control" @if($paymentInfo) value="{{$paymentInfo->state}}" @else value="{{Request::old('state')}}" @endif placeholder="State/Region">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
                  <label class="control-label">City<span class="required" aria-required="true"> * </span></label>
                  <input data-required="1" type="text" name="city" @if($paymentInfo) value="{{$paymentInfo->city}}" @else value="{{Request::old('city')}}" @endif class="form-control" placeholder="City">
                </div>
                <div class="col-md-6">
                  <label class="control-label">Postal Code<span class="required" aria-required="true"> * </span></label>
                  <input type="text" name="zip" class="form-control" @if($paymentInfo) value="{{$paymentInfo->zip}}" @else value="{{Request::old('zip')}}" @endif placeholder="Postal Code">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
                  <label class="control-label">Phone Number<span class="required" aria-required="true"> * </span></label>
                  <input data-required="1" type="text" name="phone" @if($paymentInfo) value="{{$paymentInfo->phone}}" @else value="{{Request::old('phone')}}" @endif class="form-control" placeholder="Phone Number">
                </div>
              </div>
              <div class="black_line margin-top-30"></div>
              <div id="taxt-info">
                <h3 class="font-red">Tax Information Requirement</h3>
              *The following fields are required because Referral payouts exceeding certain limites are taxable. Contact your tax professional to learn more. <br />
                <div id="for-us-only" @if($paymentInfo) @if($paymentInfo->country == "United States") style="display: block;" @else style="display: none;" @endif @else style="display: block;" @endif>
                  <label class="control-label" style="text-align:left !important;">Your privacy is very important to us - this tax information will be encrypted and stored securely. 
                    
                    All information you provide below MUST match the name and tax identification number information on file with the IRS - YOU WILL NOT RECEIVE PAYMENT UNLESS YOUR LEGAL NAME AND THE TAX ID INFORMATION MATCHES WHAT THE IRS HAS ON FILE. </label>
                  <label class="control-label" style="text-align:left !important;">For individuals, please provide your Social Security Number. For any other type of entity, please provide the exact Legal Name and Federal Employer Identification Number (EIN) or Social Security Number (SSN) information you provided in your Application for Employer Identification Number (Form SS-4). 
                    
                    If you do not remember what information you provided, please call the IRS Business and Specialty Tax line at 1-800-829-4933. </label>
                  <div class="form-group">
                    <div class="col-md-6">
                      <label class="control-label">Legal Name<span class="required" aria-required="true"> * </span></label>
                      <input data-required="1" type="text" name="legal_name" @if($paymentInfo) value="{{$paymentInfo->legal_name}}" @else value="{{Request::old('legal_name')}}" @endif class="form-control" placeholder="Legal Name">
                    </div>
                    <div class="col-md-12">
                      <p class="no-margin"> Your Legal Name must match the name associated with the Social Security Number or the Federal Employer Identification Number provided below. </p>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12 margin-top-20 margin-bottom-20">
                     <label class="control-label"> <input type="radio" name="account_type" value="1" @if($paymentInfo) @if($paymentInfo->
                      account_type == 1) checked="" @endif @else @if(Request::old('account_type') == 1) checked="" @endif @endif />I am registering this account as an individual, sole proprietor with no EIN, or other business entity with no EIN.</label> </div>
                    <div id="account_type1" class="col-md-6 desc">
                    <div class="col-md-12">
                    <div class="col-md-12">
                      <label class="control-label">Social Security Number<span class="required" aria-required="true"> * </span></label>
                      <input data-required="1" type="text" name="social_security_number" id="mask_ssn" @if($paymentInfo) value="{{$paymentInfo->social_security_number}}" @else value="{{Request::old('social_security_number')}}" @endif class="form-control" placeholder="Social Security Number">
                      <p class="no-margin">For Example: 123-45-6789</p>
                      </div>
                      </div>
                    </div>
                    <div class="col-md-12 margin-top-20 margin-bottom-20 radio_left">
                     <label class="control-label" style="text-align:left !important;"> <input type="radio" name="account_type" value="2" @if($paymentInfo) @if($paymentInfo->
                      account_type == 2) checked="" @endif @else @if(Request::old('account_type') == 2) checked="" @endif @endif /><div style="margin-left:31px; margin-top:4px;">I reside in the United States, and am registering this account as a corporation, sole proprietor, partnership, unincorporated non-profit association, non-profit organization, or other business entity type. This business entity is formally registered with the IRS and has an EIN.</div></label> </div>
                    <div id="account_type2" class="col-md-6 desc">
                    <div class="col-md-12">
                    <div class="col-md-12">
                      <label class="control-label">Federal Employer Identification Number (EIN)<span class="required" aria-required="true"> * </span></label>
                      <input data-required="1" type="text" name="federal_employer_identification_number" id="mask_tin" @if($paymentInfo) value="{{$paymentInfo->federal_employer_identification_number}}" @else value="{{Request::old('federal_employer_identification_number')}}" @endif class="form-control" placeholder="Federal Employer Identification Number (EIN)">
                      <p class="no-margin">For Example: 12-3456789</p>
                      </div>
                      </div>
                    </div>
                  </div>
               
                </div>
                <div id="for-all-other" @if($paymentInfo) @if($paymentInfo->country != "United States") style="display: block;" @else style="display: none;" @endif @else style="display: none;" @endif>
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
            <div class="form-actions right"> <a href="{{url('referral/payment-info')}}" class="btn btn-danger btn-circle bold"> Cancel </a>
              <button type="submit" class="btn btn-circle yellow-crusta color-black btn-circle bold"> <i class="fa fa-check"></i> Save</button>
            </div>
          </form>
          
          <!-- end paypal form --> 
          
        </div>
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

$(document).ready( function() {

    var placeholder = "Select a Country";

    

    $(".select2").select2({

        placeholder: placeholder,

        width: null

    });

    var country = "{{Request::old('country')}}";

    if(country != '')

    {

        if (country  == 'United States')

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

    }

    

    

   $('#select-payment-type').change( function() {

      var payment_type = $(this).val();

      console.log(payment_type);

      if(payment_type == 'Paypal')

      {

        $('#payment-form-div').hide();

        $('#for-papal-only').show();

        $('#payment_via').val(payment_type);

        var paypal_url = "{{url('referral/payment/paypal/save')}}";

        $('#payment-form').attr('action', paypal_url);

        $('#payment-form-div').show(500);

        

      }

      else if(payment_type == 'Cheque')

      {

        $('#payment-form-div').hide();

        $('#for-papal-only').hide();

        $('#payment_via').val(payment_type);

        var cheque_url = "{{url('referral/payment/cheque/save')}}";

        $('#payment-form').attr('action', cheque_url);

        $('#payment-form-div').show(500);

      }

      else

      {

        $('#payment-form-div').hide(500);

      }

   });

});





 $('#country-dropdown').on('change', function() {

    $('#init-tax').hide();

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
<!--<script src="{{URL::asset('metronic/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script> -->
@endsection 
