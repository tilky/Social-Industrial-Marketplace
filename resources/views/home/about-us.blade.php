@extends('home.app')

@section('content')

@include('home.header') 

<!--======================= layout ========================-->

<div class="small-layout animatedParent" style="background-image: url('{{URL::asset('livesite/images/banners/1.jpg')}}') ;">
  <div class="mask"></div>
  <h1 class="header_middle text-center animated bounceInDown slower go">About Us</h1>
</div>

<!--=======================================================--> 

<!--======================= Navbar ========================-->

<div class="simple-navbar text-center relative">
  <ul class="list-inline">
    <li class="active"><a href="{{url('about-us')}}">About Us</a></li>
    <li><a href="{{url('faq')}}">FAQ</a></li>
    <li><a href="{{url('news')}}">Indy John News</a></li>
    <li><a href="{{url('investor-outreach')}}">Investor Outreach</a></li>
    <li><a href="{{url('contact-us')}}">Contact Us</a></li>
  </ul>
  <div class="vertical_lines"></div>
</div>

<!--=======================================================-->

<div class="section mincontainer_height animatedParent">
  <div class="container">
    <div class="col-md-12">
      <h3>About Indy John</h3>
      <p>Indy John is a Social Industrial Marketplace founded in 2014, formally known as QuoteTek.com.  We are the number one online marketplace for Buying and Selling your Industrial products and services, as well as the market leader in Industrial marketing technologies.</p>
      <p>We know connecting today’s professionals in social networks is not enough to ensure meaningful successful business interactions, so we’re introducing a new Quote-Lead System™ aiming to solve that problem.  Our Quote-Lead System™ is the first of its kind worldwide to focus exclusively on Industrial items and services.  We’ve also designed some additional features and tools to help our users work more efficiently and increase productivity.</p>
      <p> <a href="{{url('/')}}">Create your free account</a>, take a look for yourself and begin exploring.</p>
      <h3>The Indy John Team</h3>
      <p> Indy John is a growing startup company preparing for big expansion.  Our team is made up of experienced industrial, business, and technical professionals.  Since our launch in 2014, our company has gone through exciting necessary changes and we believe we are building something great to offer the Industrial world.  Our customer reach has recently expanded across multiple Industries and user feedback continues to pour in, so our platform will remain in growth mode focused on creating value for our users.</p>
      <p>Our mission is clear - We’re going to <b>Simplify the Buy-Sell experience and consolidate all processes of Industrial Buyers and Suppliers.</b></p>
      <p>Feel free to <a href="{{url('contact-us')}}">reach out to us</a>, we'd love to hear your thoughts or ideas.</p>
    </div>
    <!--<div class=" col-md-6">
      <h3>&nbsp;</h3>
      <img class="img-responsive" src="{{URL::asset('livesite/images/about-us-comparions.png')}}" /></div>-->
  </div>
</div>
<div class="clearfix"></div>
@include('home.footerlinks')

@endsection 
