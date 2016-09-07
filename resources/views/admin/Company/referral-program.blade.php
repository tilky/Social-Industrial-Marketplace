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


            <h3>Can You Use Some Extra Income? </h3>
            <p>
                All Indy John users can earn residual income by taking advantage of Indy John's referral program. Simply tell your Industrial friends about us, if your referral selects one of our valued accounts we'll split your referral's first month payment 50/50 as a sign of appreciation. You can expect your referral payout after 30 days hold period.
            </p>



            <h3>Who can you refer to Indy John?   </h3>

            <p>
                Indy John is open to all, but most profitable by referring suppliers and service providers. You can refer the following: </p>
            <ul>
                <li>Your company</li>
                <li>Fellow associates</li>
                <li>Industrial Friends and family</li>
                <li>Any Buyer or Supplier you feel would benefit from Indy John</li>
            </ul>



            <h3>How does it work ?  </h3>
            <p>
                Sign Up or Log In to your Indy John account and provide us with some payment details for your referral payouts. Begin referring Indy John to Industrial associates, family, and friends by giving them your custom Indy John URL link. Start earning your referral payouts, all referral action and payouts can be monitored in your Indy John User Dashboard or Supplier CRM. </p>
            <p> * Contact <a href="mailto:support@indyjohn.com">Indy John Support</a> with any questions or issues regarding our referral program. Please be sure to visit our Terms page for details.</p>




        </div>





    </div>
</div>

<div class="clearfix"></div>

@include('home.footerlinks')
@endsection
