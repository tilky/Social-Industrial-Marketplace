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
        <div class="col-md-6 wow slideInLeft">
            <img src="{{URL::asset('livesite/images/banners/students-network.jpg')}}" class="img_full" alt="" />

        </div>

        <div class="col-md-6 wow slideInRight border_bottom">
            <div class="section  ">
                <h3 class="header_36">Network and Connect</h3>
                  <p class="font28"> Increase networking opportunities with our platform.
                    <p>Make Indy John the place for your Industrial Search and Discovery.  Networking and connecting can open up opportunities and present jobs you didn’t know were available.  Allow us to introduce you to the Industrial world.


                        <h3 class="header_24_red">Let us grow your Industrial network.</h3>

                        <p><a href="{{url('')}}" class="btn btn-circle btn_new">Sign up Now</a></p>

            </div>
        </div>
        <div class="clearfix"></div>

    </div>



    <div class="helpsection fade margintop20">



        <div class="col-md-6 wow slideInLeft hidden-sm hidden-xs">
            <div class="section ">
                <h3 class="header_36">Industrial Job Search</h3>
                <p class="font28">Let us help you find your Industrial job.

                    <p>Graduation is around the corner and finding employment can be time consuming and stressful.  Whether you’re looking for employers or specific industrial positions, we’ll match you with employers looking for your specific skill set or expertise.  


                        <h3 class="header_24_red">Manage all job hunting in our Job Board.</h3>

                        <p><a href="{{url('')}}" class="btn btn-circle btn_new">Sign up Now</a></p>

            </div>
        </div>


        <div class="col-md-6 wow slideInRight ">
            <img src="{{URL::asset('livesite/images/banners/students-job-search.jpg')}}" class="img_full" alt="" />

        </div>
        
        <div class="col-md-6 wow slideInLeft visible-sm visible-xs border_bottom">
            <div class="section ">
                <h3 class="header_36">Industrial Job Search</h3>
                <p class="font28">Let us help you find your Industrial job.

                    <p>Graduation is around the corner and finding employment can be time consuming and stressful.  Whether you're looking for employers or specific industrial positions, we'll match you with employers looking for your specific skill set or expertise.  


                        <h3 class="header_24_red">Manage all job hunting in our Job Board.</h3>

                        <p><a href="{{url('')}}" class="btn btn-circle btn_new">Sign up Now</a></p>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>



    <div class="helpsection fade margintop20">
        <div class="col-md-6 wow slideInLeft ">
            <img src="{{URL::asset('livesite/images/banners/students-purchase.jpg')}}" class="img_full" alt="" />

        </div>

        <div class="col-md-6 wow slideInRight border_bottom">
            <div class="section ">
                <h3 class="header_36">Purchase Products</h3>
                 <p class="font28">A smarter way to purchase products and services.
                    <p>Do you need to purchase equipment or tools for your new job? Allow Indy John to help you find the lowest price possible for your items. Use our Quote-Lead System™ to help you receive comparable pricing options OR feel free to visit the Indy John Market and browse item listings.
                        <h3 class="header_24_red">We're dedicated to your success.</h3>

                        <p><a href="index.html" class="btn btn-circle btn_new">Sign up now to begin exploring.</a></p>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>



<div class="helpsection fade margintop20">



        <div class="col-md-6 wow slideInLeft hidden-sm hidden-xs">
            <div class="section ">
                <h3 class="header_36">Sell and Trade.</h3>
                 <p class="font28"> Upgrade your equipment and tools using Indy John.

                    <p>Did you purchase any items during schooling or training and maybe now is the time to upgrade your items? We can help by allowing you to sell your items in our Indy John Market, there is no charge to list and currently we don’t manage payments.  


                        <h3 class="header_24_red">Take a look and start discovering.</h3>

                        <p><a href="{{url('')}}" class="btn btn-circle btn_new">Sign up Now</a></p>

            </div>
        </div>


        <div class="col-md-6 wow slideInRight ">
            <img src="{{URL::asset('livesite/images/banners/students-sell.jpg')}}" class="img_full" alt="" />
        </div>
        
        <div class="col-md-6 wow slideInLeft visible-sm visible-xs ">
            <div class="section ">
                <h3 class="header_36">Sell and Trade.</h3>
                 <p class="font28"> Upgrade your equipment and tools using Indy John.

                    <p>Did you purchase any items during schooling or training and maybe now is the time to upgrade your items? We can help by allowing you to sell your items in our Indy John Market, there is no charge to list and currently we don't manage payments.  


                        <h3 class="header_24_red">Take a look and start discovering.</h3>

                        <p><a href="{{url('')}}" class="btn btn-circle btn_new">Sign up Now</a></p>

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
