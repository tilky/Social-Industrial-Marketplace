@extends('home.app')
@section('content')
@include('home.header')
<!--======================= layout ========================-->

<div class="small-layout animatedParent" style="background-image: url('{{URL::asset('livesite/images/banners/11.jpg')}}') ;">
    <div class="mask"></div>
    <h1 class="header_middle text-center animated bounceInDown slower go">Partner With Us</h1>
</div>


<!--=======================================================-->



<!--======================= Navbar ========================-->
<div class="simple-navbar text-center relative">
    <ul class="list-inline">
        <li><a href="{{url('marketing-solutions')}}">Marketing Solutions:</a></li>
        <li><a href="{{url('advertise-with-us')}}">Advertise</a></li>
        <li class="active"><a href="{{url('partner-with-us')}}">Partner</a></li>
    </ul>
    <div class="vertical_lines"></div>
</div>
<!--=======================================================-->


<div class="section  animatedParent">

    <div class="container">

        <div class="col-md-12">


            <h3>Partner with us</h3>
            <p>
               Indy John is a social marketplace for Industrial buyers and suppliers with a strategic plan to grow our user base.  Partner with us and we’ll introduce you to the large industrial workforce.</p>
            <p>
                We can offer unparalleled creative content and data campaigns focused on helping your company capture new customers and access additional revenue streams.  We’re working on comprehensive targeting options designed to help brands reach even larger audiences.</p>
            <p>
                Let’s talk.  Partnership opportunities are limited and now available.  Please contact our marketing solutions team for details: <a href="mailto:partner@indyjohn.com">partner@indyjohn.com</a>.</p>

            <p>&nbsp;</p>
            <p></p>

            <p>&nbsp;</p>
            <p></p>
        </div>

    </div>
</div>


<div class="clearfix"></div>
@include('home.footerlinks')
@endsection
