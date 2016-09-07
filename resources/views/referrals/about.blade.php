@extends('buyer.app')

@section('content')
<style>
.select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <a href="{{url('referrals')}}">Referrals</a> <i class="fa fa-circle"></i> </li>
    <li> <span>About Our Referral Program</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom">
      <h3 class="page-title uppercase"> <i class="fa fa-gift color-black"></i> About Our Referral Program </h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="portlet-body form"> @if($errors->any())
        <div class="alert alert-danger"> @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
          @endforeach </div>
        @endif
        @if (Session::has('message'))
        <div id="" class="custom-alerts alert alert-success fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
          {{ Session::get('message') }}</div>
        @endif
        <div class="col-md-12">
          <h3 class="animated fadeIn nopadding text-center">Start Referring and Earning with Indy John.</h3>
          <p class="caption-helper"> Can you use some extra income?  All Indy John users can earn residual income by taking advantage of Indy John’s referral program.  Simply tell your Industrial friends about us, if your referral candidate selects one of our valued accounts we’ll split your candidate’s first monthly payment 50/50 as a sign of appreciation.  Referral payouts will be made up to 45 days from the time your candidate’s first account payment. </p>
          <h3 class="animated fadeIn nopadding text-center">Who can I refer to Indy John?</h3>
          <p class="caption-helper"> Indy John is open to all, but most profitable by referring suppliers and service providers. You can refer the following: </p>
          <ul class="caption-helper">
            <li>Your company</li>
            <li>Fellow associates</li>
            <li>Industrial Friends and family</li>
            <li>Any Buyer or Supplier you feel would benefit from Indy John</li>
          </ul>
          
          <!--
<div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img width="20px" src="{{URL::asset('livesite/images/icons/interface-1.png')}}" alt=""/></i>
-->
          
          <div class="animatedParent">
            <h3 class="header_middle text-center  animated fadeIn nopadding go margin-bottom-40">How does the referral program work ?</h3>
            <div class="redprocess section">
              <div class="leftright_section">
                <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/interface-1.png')}}" alt=""></i> Sign Up or Log In to your Indy John account and provide us with some payment details for your referral payouts. </div>
                <div class="number_text left_icon hovicon effect-1 animation-element slide-left">1</div>
              </div>
              <div class="clearfix"></div>
              <div class="leftright_section pull-right border_middle_ver">
                <div class="number_text right_icon hovicon animation-element slide-right">2</div>
                <div class="col-md-9 col-sm-9 wh_border wh_borderleft"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/college-research.png')}}" alt=""></i> Start referring Indy John by giving them your Referral Code or Custom Indy John URL link. </div>
              </div>
              <div class="clearfix"></div>
              <div class="leftright_section">
                <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/folder.png')}}" alt=""></i> Begin earning your referral payouts, all referral action and payouts can be managed after you log in.</div>
                <div class="number_text left_icon hovicon animation-element slide-left">3</div>
              </div>
            </div>
            <div class="clearfix"></div>
            <p class="caption-helper margin-top-40"> Your Referral code is automatically generated and can be obtained in your Buyer Dashboard or Supplier CRM.  Contact the Support Team with any questions or issues regarding our referral program.</p>
            <p> </p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    
    <!--


                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12 padding-top paddin-bottom">
                            <h3>Start referring and earning with Indy John.</h3>
                            <p>
                                Can you use some extra income?  All Indy John users can earn residual income by taking advantage of Indy John's referral program.  
                                Simply tell your Industrial friends about us, if your referral selects one of our valued accounts we'll split your referral's first month payment 50/50 as a sign of appreciation.  You can expect your referral payout after 30 days hold period.
                            </p>
                            <div class="padding-top">&nbsp;</div>
                            <h4>Who can I refer to Indy John?</h4>
                            <ul>
                                <li>Your company</li>
                                <li>Fellow associates</li>
                                <li>Industrial Friends and family</li>
                                <li>Any Buyer or Supplier you feel would benefit from Indy John</li>
                            </ul>
                            <div class="padding-top">&nbsp;</div>
                            <h4>How does it work?</h4>
                            <ul>
                                <li>Sign Up or Log In to your Indy John account and provide us with some payment details for your referral payouts.</li>
                                <li>Begin referring Indy John to Industrial associates, family, and friends by giving them your custom Indy John URL link. ex: {{url('auth/register')}}?referral=your custome value</li>
                                <li>Start earning your referral payouts, all referral action and payouts can be monitored in your Indy John User Dashboard or Supplier CRM.</li>
                            </ul>
                            <div class="padding-top">&nbsp;</div>
                            <p>* Contact <a href="mailto:support@indyjohn">support@indyjohn</a> with any questions or issues regarding our referral program.  Please be sure to visit our Terms page for details.  </p>
                        </div>
                    </div>
                </div>
                --> 
  </div>
</div>
<script>
/* for show menu active */
$("#referrals-main-menu").addClass("active");
$('#referrals-main-menu' ).click();
$('#referrals-menu-arrow').addClass('open')
$('#referral-about-program-menu').addClass('active');
/* end menu active */

</script> 
@endsection 
