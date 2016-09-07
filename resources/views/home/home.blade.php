@extends('home.app')

@section('content')

@include('home.header')

<div class="banner_content animatedParent ">

    @if (Session::has('message'))
    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
    @endif

  <div class="container">

    <h1 class="banner_header animated bounceInDown slower">Welcome TO <span>Indy John</span></h1>

    <h3 class="h5_head  animated bounceInUp slower">A Social Marketplace Connecting the Industrial World.</h3>

    <h3 class="h3_head  animated bounceInUp slower text-uppercase nomargin-bottom margintop60"><b>As a Buyer, you can : </b></h3>

    <div class="button_section">

      <ul class="clearfix animated bounceInUp findMe">

        <li><a href="#" class="btn btn-circle " data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Recieve More Pricing options using our Quote Lead System™.">Receive More Quotes</a></li>

        <li><a href="#" class="btn" data-toggle="popover"  data-placement="top" data-trigger="focus" data-content="Meet new companies and leave your worries behind.">Find Trusted Suppliers</a></li>

        <li><a href="#" class="btn" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Finally, a market focused on Industrial products and supplies.">Explore Market Listings</a></li>

        <li><a href="#" class="btn" data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Be Discovered by Claiming your free Company Page Listing.">Claim Company Page</a></li>

      </ul>

      <div class="clearfix"></div>

      <!-- signup- form -->

      <div class="signup-form">

        <h3 class="h3_head  animated bounceInUp slower nomargin-bottom"><b> SIGN UP FOR FREE </b></h3>

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

                    <input type="hidden" name="user_type" id="home-user-type" value="2" />

                    <input type="email" class="form-control" id="home-email" name="email" placeholder="ENTER YOUR E-MAIL" value="{{Request::old('email')}}"required>
                    <select name="industry" class="form-control" id="home-industry" required>
                        <option value="">SELECT YOUR INDUSTRY</option>
                        @foreach($industries as $industry)
                            <option value="{{$industry->id}}">{{$industry->name}}</option>
                        @endforeach
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

      <div class="clearfix"></div>

      <div class="text-center clearfix margintop20 service_provider animated growIn slowest"> 

        <a href="{{url('supplier-home')}}@if(isset($_GET['referral']))?referral={{$_GET['referral']}} @endif" class="btn_blue">I'm a Supplier/ Service Provider</a> 

      </div>

    </div>

    <div class="text-center mobile_margin">

      <div class="scrollar_btn"><span class="circle"><span class="dot"></span></span>

        <p>Learn More</p>

      </div>

    </div>

    <div class="clearfix"></div>

  </div>

</div>



<div id="owl-demo" class="owl-carousel paddingTop150">

  <div class="item">

    <div class="slider" style="background-image: url({{URL::asset('livesite/images/banner_1.jpg')}})">

      <div class="slider_overlay"> </div>

      <div class="line_image"></div>

      <div class="line_image right"></div>

    </div>

  </div>

  <!--

  <div class="item">

    <div class="slider" style="background-image: url({{URL::asset('livesite/images/banner_2.jpg')}})">

      <div class="slider_overlay"> </div>

      <div class="line_image"></div>

      <div class="line_image right"></div>

    </div>

  </div>

  -->

</div>

<div class="section fade animatedParent">

  <div class="container  text-center">

    <h1 class="header_middle">Indy John Is The Industrial Purchasing Tool You’ve Been Missing.</h1>

    <div class="col-md-4 iconsection  animated bounceInDown "> <i class="icon"><img src="{{URL::asset('livesite/images/icons/fast.png')}}" height="128px"/></i>

      <h3 class="header_18">QUOTE-LEAD SYSTEM™</h3>

      <p>Submit one <strong>Buy Request</strong> and have access to the right suppliers.</p>

    </div>

    <div class="col-md-4 iconsection animated bounceInUp "> <i class="icon"><img src="{{URL::asset('livesite/images/icons/market-equipment.png')}}" height="128px"/></i>

      <h3 class="header_18">INDY JOHN MARKET</h3>
   <p>List or shop for new and used industrial products and supplies.</p>
     

    </div>

    <div class="col-md-4 iconsection animated bounceInDown "> <i class="icon"><img src="{{URL::asset('livesite/images/safty.png')}}" height="128px"/></i>

      <h3 class="header_18">BUYER DASHBOARD</h3>

      <p>Organize your Quotes and track all Purchasing Activity.</p>

    </div>



  </div>

</div>



<div class="color_bg feedback animatedParent paddingTop50"> </div>

<div class="container animatedParent">

  <h3 class="header_middle text-center  animated fadeIn nopadding">How does the Quote-Lead System™ work?</h3>

  <div class="row redprocess section">

    <div class="leftright_section">

      <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/interface-1.png')}}" alt=""/></i>Make Indy John your go-to place for purchasing Industrial products and services.</div>

      <div class="number_text left_icon hovicon effect-1 animation-element slide-left">1</div>

    </div>

    <div class="clearfix"></div>

    <div class="leftright_section pull-right border_middle_ver">

      <div class="number_text right_icon hovicon animation-element slide-right">2</div>

      <div class="col-md-9 col-sm-9 wh_border wh_borderleft"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/college-research.png')}}"  alt=""/></i> Start by searching your desired products or services and submit a Buy Request.</div>

    </div>

    <div class="clearfix"></div>

    <div class="leftright_section">

      <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/folder.png')}}" alt=""/></i>Sit back and allow Indy John suppliers to contact you with quotes.</div>

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

