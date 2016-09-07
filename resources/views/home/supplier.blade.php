@extends('home.app')

@section('content')

@include('home.header')

<div class="banner_content animatedParent ">

  <div class="container">

    <h1 class="banner_header animated bounceInDown slower">Welcome TO <span>Indy John</span></h1>

<h3 class="h5_head  animated bounceInUp slower">A Social Marketplace Connecting the Industrial World.</h3>



    <h3 class="h3_head  animated bounceInUp slower text-uppercase nomargin-bottom"><b>As a Supplier, you can : </b></h3>

    <div class="button_section">

      <ul class="clearfix animated bounceInUp findMe">

        <li><a href="" class="btn btn-circle " data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Increase selling opportunities using our Quote Lead System™.">Receive More Leads</a></li>

        <li><a href="" class="btn" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="We can help you meet and quote new buyers, sign up to learn more.">Meet New Buyers</a></li>

        <li><a href="" class="btn" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Indy John Market was built for Industrial products and supplies, start showcasing now.">List Your Products</a></li>

        <li><a href="" class="btn" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Be Discovered by Claiming your free Company Page Listing.">Claim Company Page</a></li>

      </ul>

      <div class="clearfix"></div>

      <!-- signup- form -->

      <div class="signup-form">

        <h3 class="h3_head  animated bounceInUp slower nomargin-bottom margintop60"><b> SIGN UP FOR FREE </b></h3>

        @if(count($errors) > 0)

        <div class="alert alert-danger alert-dismissable">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">

                &times;

            </button>

            @foreach ($errors->all() as $error)

            {{ $error }}

            @endforeach

        </div>

        @endif

        <div class="form_div">

        <form method="post" action="{{url('signup/email/verification')}}">

            <input type="hidden" name="_token" value="{{csrf_token()}}" />

            @if(isset($_GET['referral']))

            <input type="hidden" name="referral_singup" value="{{$_GET['referral']}}" />

            @endif

          <div class="form">

            <div class="form-inline ">

              <div class="form-group col-md-12 col-sm-12 col-xs-12">

              <div class="row">

                    <input type="hidden" name="user_type" id="home-user-type" value="3" />

                    <input type="email" class="form-control" id="home-email" name="email"  placeholder="ENTER YOUR E-MAIL" value="{{Request::old('email')}}" required>
                    <select name="main_industry" class="form-control selectIndustry" id="indutries-dropdown">
                                        <option value="">SELECT YOUR INDUSTRY</option>
                                      
                                    </select>


                @if(Auth::check())

                    @if(Auth::user()->access_level == 1)

                        <a href="{{url('sa')}}" class="btn form-control">Sign Up</a>

                    @else

                        <a href="{{url('user-dashboard')}}" class="btn form-control">Sign Up</a>

                    @endif

                @else

                    <!--<button type="button" onclick="ShowRegisterModal()" data-toggle="modal" data-target="#signup" class="btn">Sign Up</button>-->

                    <button type="submit"  class="btn form-control">Sign Up</button>

                @endif

                

              
                </div>

              </div>

              

            </div>

           

          </div>

        </form>

        </div>

        <h6>By Signing Up, You Agree To Our <a href="terms">Terms & Conditions</a> & <a href="privacy-policy">Privacy Policy</a>.</h6>

      </div>

      <div class="text-center clearfix margintop20 service_provider  animated growIn slowest"> <a href="{{url('/')}}@if(isset($_GET['referral']))?referral={{$_GET['referral']}}@endif" class="btn_blue">I'm a Buyer</a> </div>

    </div>

    <div class="text-center mobile_margin">

      <div class="scrollar_btn"><span class="circle"><span class="dot"></span></span>

        <p>Learn More</p>

      </div>

    </div>

  </div>

</div>

<div id="owl-demo" class="owl-carousel paddingTop150">

  <div class="item">

    <div class="slider" style="background-image: url({{URL::asset('livesite/images/banner_5.jpg')}})">

      <div class="slider_overlay"> </div>

      <div class="line_image"></div>

      <div class="line_image right"></div>

    </div>

  </div>

  <!--

  <div class="item">

    <div class="slider" style="background-image: url({{URL::asset('livesite/images/banner_4.jpg')}})">

      <div class="slider_overlay"> </div>

      <div class="line_image"></div>

      <div class="line_image right"></div>

    </div>

  </div>

  -->

</div>

<div class="section fade animatedParent">

  <div class="container  text-center">

    <h1 class="header_middle">Make Indy John the quarterback of your Sales team.</h1>

    <div class="col-md-4 iconsection  animated bounceInDown "> <i class="icon"><img src="{{URL::asset('livesite/images/icons/hand-shake.png')}}" height="128px;"/></i>

      <h3 class="header_18">QUOTE-LEAD SYSTEM™</h3>

      <p>Create <strong>Lead Requests</strong> and we'll bring the leads to you.</p>

    </div>

    <div class="col-md-4 iconsection animated bounceInUp "> <i class="icon"><img src="{{URL::asset('livesite/images/icons/market-equipment.png')}}" height="128px;"/></i>

      <h3 class="header_18">INDY JOHN MARKET</h3>

    <p>Promote and Advertise your Industrial products, and supplies.</p>

    </div>

    <div class="col-md-4 iconsection animated bounceInDown "> <i class="icon"><img src="{{URL::asset('livesite/images/safty.png')}}" height="128px;"/></i>

      <h3 class="header_18">SUPPLIER CRM</h3>

      <p>Organize your leads and manage all sales activity in one CRM.</p>

    </div>

 

  </div>

</div>





<div class="color_bg feedback animatedParent paddingTop50"> </div>

<div class="container animatedParent">

  <h3 class="header_middle text-center  animated fadeIn nopadding">How does the Quote-Lead System™ work?</h3>

  <div class="row redprocess section">

    <div class="leftright_section">

      <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/promotion.png')}}" alt=""/></i>Allow Indy John to help you sell, promote, and advertise your products and services.</div>

      <div class="number_text left_icon hovicon effect-1 animation-element slide-left">1</div>

    </div>

    <div class="clearfix"></div>

    <div class="leftright_section pull-right border_middle_ver">

      <div class="number_text right_icon hovicon animation-element slide-right">2</div>

      <div class="col-md-9 col-sm-9 wh_border wh_borderleft"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/magnifying-glass.png')}}"  alt=""/></i> Begin by searching your product offering and creating Lead Requests.</div>

    </div>

    <div class="clearfix"></div>

    <div class="leftright_section">

      <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/handshake.png')}}" alt=""/></i>We'll match and introduce you to new industrial buyers and procurement departments.</div>

      <div class="number_text left_icon hovicon animation-element slide-left">3</div>

    </div>

  </div>

</div>

<div class="clearfix"></div>

<div class="color_bg feedback animatedParent padding60">

  <div class="container">
<h2>Make <b>Meaningful Industrial Connections</b> using <b>Indy John.</b></h2>
    

  </div>

</div>
<a href="#overview-select-modal" data-toggle="modal" data-target="#overview-select-modal" class="over_view">Overview</a>

<a href="#job_board" data-toggle="modal" data-target="#job_board" class="job_board">JOB BOARD</a>

<a href="{{url('quick-demo')}}?setup=tutorial" class="quick_demo">QUICK DEMO</a>

@include('home.footerlinks')

@endsection

