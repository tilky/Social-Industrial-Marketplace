@extends('home.app')
@section('content')
@include('home.header')

<!--======================= layout ========================-->

<div class="small-layout animatedParent margintop40" style="background-image: url('{{URL::asset('livesite/images/banners/10.jpg')}}') ;">
    <div class="mask"></div>
    <h1 class="header_middle text-center animated bounceInDown slower">Start Referring and Earning.</h1>
</div>


<!--=======================================================-->




<!--
<div class="simple-navbar text-center ">
<ul class="list-inline">
<li><a href="about-us.php">About Us</a></li>
<li><a href="faq.php">FAQ</a></li>
<li><a href="news.php">Indy John News</a></li>
<li class="active"><a href="investor-outreach.php">Investor Outreach</a></li>
<li><a href="contact-us.php">Contact Us</a></li>
</ul>
</div>-->



<div class="section mincontainer_height animatedParent">
    <div class="color_bg feedback acount_refer animatedParent">
        <div class="container">
            <h3 class="head_railway padding50 text-center animated shake slower">Earn up to <b>$100 </b>for each valued account that you refer!</h3>

        </div>
    </div>
    <div class="container">

        <div class="col-md-12">

  <h3 class="header_middle text-center  animated fadeIn nopadding">Start Referring and Earning with Indy John.</h3>


            <p>
                Can you use some extra income?  All Indy John users can earn residual income by taking advantage of Indy John’s referral program.  Simply tell your Industrial friends about us, if your referral candidate selects one of our valued accounts we’ll split your candidate’s first monthly payment 50/50 as a sign of appreciation.  Referral payouts will be made up to (4) weeks from the time your candidate’s first account payment.
            </p>


  <h3 class="header_middle text-center  animated fadeIn nopadding">Who can I refer to Indy John?</h3>
     

            <p>
                Indy John is open to all, but most profitable by referring suppliers and service providers. You can refer the following: </p>
            <ul>
                <li>Your company</li>
                <li>Fellow associates</li>
                <li>Industrial Friends and family</li>
                <li>Any Buyer or Supplier you feel would benefit from Indy John</li>
            </ul>


           
<div class="container animatedParent">
  <h3 class="header_middle text-center  animated fadeIn nopadding">How does the referral program work ?</h3>
  <div class="row redprocess section">
    <div class="leftright_section">
      <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/interface-1.png')}}" alt=""/></i>1)	Sign Up or Log In to your Indy John account and provide us with some payment details for your referral payouts. </div>
      <div class="number_text left_icon hovicon effect-1 animation-element slide-left">1</div>
    </div>
    <div class="clearfix"></div>
    <div class="leftright_section pull-right border_middle_ver">
      <div class="number_text right_icon hovicon animation-element slide-right">2</div>
      <div class="col-md-9 col-sm-9 wh_border wh_borderleft"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/college-research.png')}}"  alt=""/></i>2)	Start referring Indy John by giving them your Referral Code or Custom Indy John URL link.   </div>
    </div>
    <div class="clearfix"></div>
    <div class="leftright_section">
      <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/folder.png')}}" alt=""/></i>3)	Begin earning your referral payouts, all referral action and payouts can be managed after you log in.</div>
      <div class="number_text left_icon hovicon animation-element slide-left">3</div>
    </div>
  </div>



            <p> Your Referral code is automatically generated and can be obtained in your Buyer Dashboard or Supplier CRM.  Contact the Support Team with any questions or issues regarding our referral program.</p>


<p>

        </div>





    </div>
</div>

<div class="clearfix"></div>

@include('home.footerlinks')
@endsection
