@extends('home.app')
@section('content')
@include('home.header')
<!-- maybe later - 
	  
      <div class="section fade">
          <div class="container  text-center">
              <h3 class="header_middle">Make Indy John the QuarterBack of your Sales Team!</h3>
              
              <div class="col-md-4 iconsection">
                  <i class="icon"><img src="{{URL::asset('livesite/images/multiple.png')}}"/></i>
                  <h3 class="header_18">Multiple Options</h3>
                  <p>Never overpay again. Complete One order form and have access to all our Suppliers.</p>
              </div>
              
            <div class="col-md-4 iconsection">
                  <i class="icon"><img src="{{URL::asset('livesite/images/cost.png')}}"/></i>
                  <h3 class="header_18">Multiple Options</h3>
                  <p>Never overpay again. Complete One order form and have access to all our Suppliers.</p>
              </div>
              
              
              <div class="col-md-4 iconsection">  
                  <i class="icon"><img src="{{URL::asset('livesite/images/safty.png')}}"/></i>
                  <h3 class="header_18">Multiple Options</h3>
                  <p>Never overpay again. Complete One order form and have access to all our Suppliers.</p>
              </div>
              
          </div>
      </div>
      
      -->

<div class=" padding100">
  <div class="helpsection fade margintop20">
    <div class="col-md-6 wow slideInLeft "> <img src="{{URL::asset('livesite/images/banners/buyer-quote-lead.jpg')}}" class="img_full" alt="" /> </div>
    <div class="col-md-6 wow slideInRight border_bottom">
      <div class="section  ">
        <h3 class="header_36">Quote-Lead System™</h3>
        <p class="font28"> Let us help you find the best quote.</p>
        <p>We  know shopping for Industrial products and services can be time consuming for  any Buyer or Procurement Department.   Submit one Buy Request and allow our system to match and connect you  with suppliers. <b>Quote-Lead Teams™ is now available for Team Purchasing</b>.
        <h3 class="header_24_red">Find new suppliers, save time, and never overpay.</h3>
        <p><a href="{{url('/')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="helpsection fade margintop20">
    <div class="col-md-6 wow slideInLeft hidden-sm hidden-xs">
      <div class="section ">
        <h3 class="header_36">Indy John Market</h3>
        <p class="font28"> Shopping for industrial items will never be the same.</p>
        <p>Other companies have expanded their offering into a wide range of products, making shopping for quality or specific industrial products more difficult. We want to help; we're unveiling a brand new market concentrated on industrial products and supplies.
        <h3 class="header_24_red">Sign up now to begin exploring.</h3>
        <p><a href="{{url('/')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="col-md-6 wow slideInRight "> <img src="{{URL::asset('livesite/images/banners/buyer-market.jpg')}}" class="img_full" alt="" />

</div>
    <div class="col-md-6 wow slideInLeft visible-sm visible-xs border_bottom">
      <div class="section ">
        <h3 class="header_36">Indy John Market</h3>
        <p class="font28"> Finally,  a market dedicated to Industrial items.</p>
        <p>Other  online markets consist of a wide range of products, which makes shopping for  quality or specific Industrial products more difficult.  We want to help, we&rsquo;re opening a brand new market  focused on only Industrial products and supplies.
        <h3 class="header_24_red">Sign up now to begin exploring.</h3>
        <p><a href="{{url('/')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="helpsection fade margintop20">
    <div class="col-md-6 wow slideInLeft "> <img src="{{URL::asset('livesite/images/banners/buyer-dashboard.jpg')}}" class="img_full" alt="" /> </div>
    <div class="col-md-6 wow slideInRight border_bottom">
      <div class="section ">
        <h3 class="header_36">Buyer Dashboard</h3>
        <p class="font28"> We can help you purchase more efficiently.</p>
        <p>All  Indy John users will receive a Buyer Dashboard designed to help you organize  your purchases and increase your productivity. All your vendors, quotes, purchases,  and activity inside one dashboard? <strong>Yes, we can help you do that.</strong>
        <h3 class="header_24_red">Purchasing should always be this simple.</h3>
        <p><a href="{{url('/')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="helpsection fade margintop20">
    <div class="col-md-6 wow slideInLeft hidden-sm hidden-xs">
      <div class="section ">
        <h3 class="header_36">Industrial Search Discovery</h3>
        <p class="font28">Searching Industrial is about to get easier.</p>
        <p>Make  Indy John the place for your Industrial search and discovery.  Whether you&rsquo;re looking for products, people  or service providers, we&rsquo;ve designed features and tools to make your search  experience more productive and social.
        <h3 class="header_24_red">Take  a look and begin discovering.</h3>
        <p><a href="{{url('/')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="col-md-6 wow slideInRight "> <img src="{{URL::asset('livesite/images/banners/buyer-service-locator.jpg')}}" class="img_full" alt="" /> </div>
    <div class="col-md-6 wow slideInLeft visible-sm visible-xs">
      <div class="section ">
        <h3 class="header_36">Industrial Search Discovery</h3>
        <p class="font28">Searching Industrial is about to get easier.</p>
        <p>Make  Indy John the place for your Industrial search and discovery.  Whether you&rsquo;re looking for products, people  or service providers, we&rsquo;ve designed features and tools to make your search  experience more productive and social.
        <h3 class="header_24_red">Take  a look and begin discovering.</h3>
        <p><a href="{{url('/')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="clearfix"></div>
    </div>



</div>



    <div class="color_bg feedback animatedParent padding60">

  <div class="container">
<h2>Make <b>Meaningful Industrial Connections</b> using <b>Indy John.</b></h2>
    

  </div>
  </div>

@include('home.footerlinks')
@endsection

