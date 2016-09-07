@extends('home.app')
@section('content')
@include('home.header')
<div class="color_bg feedback animatedParent margintop40">
    <div class="container">
        <h3 class="head_railway padding75 text-center animated shake slower">Indy John Is Easy To Use.</h3>
    </div>

</div>

<div class="section fade">


    <div class="section fade">
        <div class="container  text-center">
            <h3 class="header_middle">Buyers Can Find New Suppliers</h3>

            <div class="col-md-4 iconsection">
                <i class="icon"><img src="{{URL::asset('livesite/images/multiple.png')}}"/></i>
                <h3 class="header_18">Sign Up</h3>
                <p>Sign up for a Free Account and Create your Profile</p>
            </div>

            <div class="col-md-4 iconsection">
                <i class="icon"><img src="{{URL::asset('livesite/images/cost.png')}}"/></i>
                <h3 class="header_18">Submit a Buy Request</h3>
                <p>Submit a Buy Request with your specific needs.</p>
            </div>


            <div class="col-md-4 iconsection">
                <i class="icon"><img src="{{URL::asset('livesite/images/safty.png')}}"/></i>
                <h3 class="header_18">Compare and Select</h3>
                <p>Compare and Accept Quotes received from Suppliers.</p>
            </div>

        </div>
    </div>

    <div class="color_bg feedback animatedParent">
        <div class="container">
            <h3 class="head_railway padding75 text-center animated shake slower">Looking to purchase or sell used equipment?</h3>
        </div>

    </div>



    <div class="section fade">
        <div class="container  text-center">
            <h3 class="header_middle">Find Products on Indy John Market</h3>

            <div class="col-md-4 iconsection">
                <i class="icon"><img src="{{URL::asset('livesite/images/multiple.png')}}"/></i>
                <h3 class="header_18">Sign Up</h3>
                <p>Sign up for a Free Account and Create your Profile</p>
            </div>

            <div class="col-md-4 iconsection">
                <i class="icon"><img src="{{URL::asset('livesite/images/cost.png')}}"/></i>
                <h3 class="header_18">Find Listed Products</h3>
                <p>Browse the Market and Search your Product Category.</p>
            </div>


            <div class="col-md-4 iconsection">
                <i class="icon"><img src="{{URL::asset('livesite/images/safty.png')}}"/></i>
                <h3 class="header_18">Compare and Select</h3>
                <p>Review Seller Profiles and Multiple Listings before Purchasing.</p>
            </div>

        </div>
    </div>

    
  
</div>
@include('home.footerlinks')
@endsection
