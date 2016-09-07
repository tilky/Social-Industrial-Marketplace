@extends('home.app')
@section('content')
@include('home.header')
<!-- maybe later - 
	  
      <div class="section fade">
          <div class="container  text-center">
              <h3 class="header_middle">Make Indy John the QuarterBack of your Sales Team!</h3>
              
              <div class="col-md-4 iconsection">
                  <i class="icon"><img src="{{URL::asset('livesite/images/multiple.png')}}"/></i>
                  <h3 class="header_18">Quote-Lead System™</h3>
                  <p>Create Lead Request and we’ll bring the leads to you.</p>
              </div>
              
            <div class="col-md-4 iconsection">
                  <i class="icon"><img src="{{URL::asset('livesite/images/cost.png')}}"/></i>
                  <h3 class="header_18">Indy John Market</h3>
                  <p>List or shop for new and used industrial products and supplies.</p>
              </div>
              
              
              <div class="col-md-4 iconsection">  
                  <i class="icon"><img src="{{URL::asset('livesite/images/safty.png')}}"/></i>
                  <h3 class="header_18">Supplier CRM</h3>
                  <p>Organize your leads and manage all sales activity.</p>
              </div>
              
          </div>
      </div>
      
      -->

<div class=" padding100">
  <div class="helpsection fade margintop20">
    <div class="col-md-6 wow slideInLeft"> <img src="{{URL::asset('livesite/images/banners/supplier-quote-lead.jpg')}}" class="img_full" alt="" /> </div>
    <div class="col-md-6 wow slideInRight border_bottom">
      <div class="section  ">
        <h3 class="header_36">Quote-Lead System™</h3>
        <p class="font28">Increase  selling opportunities with one platform.</p>
        <p>We  know requesting network invitations and cold calling doesn&rsquo;t always result in a  sale.  Our system will help you meet new  buyers and procurement departments by matching you with new Buy Requests; you  then contact the buyer directly and begin your pitch. <b>Quote-Lead Teams™ is now available for Team Supplying</b>.
        <h3 class="header_24_red">Let  us bring the leads to you.</h3>
        <p><a href="{{url('supplier-home')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="helpsection fade margintop20">
    <div class="col-md-6 wow slideInLeft hidden-sm hidden-xs">
      <div class="section ">
        <h3 class="header_36">Indy John Market</h3>
        <p class="font28">Promote  and Advertise to Industrial buyers.</p>
        <p>Is your  customer reach limited to existing customers or an outdated emailing list?  Let us help you grow your customer list.  We&rsquo;re opening a brand new Industrial only market designed to help you attract  new business and grow your sales.
        <h3 class="header_24_red">Post  products, reach new buyers, increase sales.</h3>
        <p><a href="{{url('supplier-home')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="col-md-6 wow slideInRight "> <img src="{{URL::asset('livesite/images/banners/supplier-market.jpg')}}" class="img_full" alt="" /> </div>
    <div class="col-md-6 wow slideInLeft visible-sm visible-xs border_bottom">
      <div class="section ">
        <h3 class="header_36">Indy John Market</h3>
        <p class="font28">Promote  and Advertise to Industrial buyers.</p>
        <p>Is your  customer reach limited to existing customers or an outdated emailing list?  Let us help you grow your customer list.  We&rsquo;re opening a brand new Industrial only market designed to help you attract  new business and grow your sales.
        <h3 class="header_24_red">Post  products, reach new buyers, increase sales.</h3>
        <p><a href="{{url('supplier-home')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="helpsection fade margintop20">
    <div class="col-md-6 wow slideInLeft "> <img src="{{URL::asset('livesite/images/banners/supplier-crm.jpg')}}" class="img_full" alt="" /> </div>
    <div class="col-md-6 wow slideInRight border_bottom">
      <div class="section ">
        <h3 class="header_36">Supplier CRM</h3>
        <p class="font28">The  smarter way to manage and organize your data.</p>
        <p>Stop  depending on expensive CRM&rsquo;s and let us bring some clarity to your sales  process.  We expect Indy John&rsquo;s features  and tools to increase your sales and outreach, so we designed a CRM to assist  you in organizing and managing this new data.
        <h3 class="header_24_red">Organize better, network smarter, one CRM.</h3>
        <p><a href="{{url('supplier-home')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="helpsection fade margintop20">
    <div class="col-md-6 wow slideInLeft hidden-sm hidden-xs">
      <div class="section ">
        <h3 class="header_36">Industrial Search Discovery</h3>
        <p class="font28"> Searching  Industrial is about to get easier.</p>
        <p>Make  Indy John the place for your Industrial search and discovery.  Whether you&rsquo;re looking for products, people  or service providers, we&rsquo;ve designed features and tools to make your search  experience more productive and social.
        <h3 class="header_24_red">Take  a look and begin discovering.</h3>
        <p><a href="{{url('supplier-home')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
      </div>
    </div>
    <div class="col-md-6 wow slideInRight "> <img src="{{URL::asset('livesite/images/banners/supplier-service.jpg')}}" class="img_full" alt="" /> </div>
    <div class="col-md-6 wow slideInLeft visible-sm visible-xs">
      <div class="section ">
        <h3 class="header_36">Industrial Search Discovery</h3>
        <p class="font28">Searching  Industrial is about to get easier.</p>
        <p>Make  Indy John the place for your Industrial search and discovery.  Whether you&rsquo;re looking for products, people  or service providers, we&rsquo;ve designed features and tools to make your search  experience more productive and social.
        <h3 class="header_24_red">Take  a look and begin discovering.</h3>
        <p><a href="{{url('supplier-home')}}" class="btn btn-circle btn_new">Sign up Now</a></p>
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

