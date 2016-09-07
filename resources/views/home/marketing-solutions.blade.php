@extends('home.app')
@section('content')
@include('home.header')
<!--======================= layout ========================-->

<div class="small-layout animatedParent" style="background-image: url('{{URL::asset('livesite/images/banners/10.jpg')}}') ;">
    <div class="mask"></div>
    <h1 class="header_middle text-center animated bounceInDown slower go">Marketing Solutions</h1>
</div>


<!--=======================================================-->



<!--======================= Navbar ========================-->
<div class="simple-navbar text-center relative">
    <ul class="list-inline">
        <li class="active"><a href="{{url('marketing-solutions')}}">Marketing Solutions:</a></li>
        <li><a href="{{url('advertise-with-us')}}">Advertise</a></li>
        <li><a href="{{url('partner-with-us')}}">Partner</a></li>
    </ul>
     <div class="vertical_lines"></div>
</div>
<!--=======================================================-->


<div class="section  animatedParent">
    <div class="color_bg feedback animatedParent">
        <div class="container">
            <h3 class="head_railway padding50 text-center animated shake slower text-center">Reach and Meet new customers with <br>Indy John Marketing Solutions.</h3>

        </div>
    </div>
</div>


<div class="section animatedParent">
    <div class="container">
        <div class="col-md-12">
            <h3>We can help you expand your brand awareness across the Industrial world.</h3>
<p>We can help you expand your brand awareness across the Industrial world by offering unparalleled creative flexibility within our platform.  You can target to our highly specific industrial market and change the messages in real time, or you can choose to increase your visibility by simply branding on one of our sponsored features.  We're looking to give companies an opportunity to engage directly with our growing industrial audience, send all inquiries to <a href="mailto:team@indyjohn.com">team@indyjohn.com</a>


           

            </p>

        </div>

        <div class="col-md-6 bounceInUp padding75 animated ">
            <div class="rounded-container text-center">
                <h4>Advertise your Company</h4>
                <a href="{{url('advertise-with-us')}}">Learn More</a>
            </div>
        </div>
        <div class="col-md-6 bounceInDown padding75 animated ">
            <div class="rounded-container text-center">
                <h4>Become our Partner</h4>
                <a href="{{url('partner-with-us')}}">Learn More</a>
            </div>
        </div>

<h4> Are you Interested in something other than advertising and partnerships? </h4>
            <h4>Please reach out to us:  <a href="mailto:team@indyjohn.com">team@indyjohn.com</a> </h4>
    </div>
</div>

<div class="clearfix"></div>
@include('home.footerlinks')
@endsection
