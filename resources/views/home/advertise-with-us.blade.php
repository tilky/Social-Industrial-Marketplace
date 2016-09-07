@extends('home.app')
@section('content')
@include('home.header')
<!--======================= layout ========================-->

<div class="small-layout animatedParent" style="background-image: url('{{URL::asset('livesite/images/banners/12.jpg')}}') ;">
    <div class="mask"></div>
    <h1 class="header_middle text-center animated bounceInDown slower go">Advertise With Us</h1>
</div>


<!--=======================================================-->



<!--======================= Navbar ========================-->
<div class="simple-navbar text-center relative">
    <ul class="list-inline">
        <li><a href="{{url('marketing-solutions')}}">Marketing Solutions:</a></li>
        <li class="active"><a href="{{url('advertise-with-us')}}">Advertise</a></li>
        <li><a href="{{url('partner-with-us')}}">Partner</a></li>
    </ul>
    <div class="vertical_lines"></div>
</div>
<!--=======================================================-->


<div class="section animatedParent">

    <div class="container">

        <div class="col-md-12">


            <h3>Advertise with us</h3>
            <p>
                Indy John is a growing social marketplace built for the Industrial community.  Advertise with us and make Meaningful Industrial Connections with the sizable industrial world.</p>
            <p>
              We can help place your business messages in front of our ever-growing network of consumers looking to be informed and spend money accordingly.  Whether you’re looking to attract new business, get the phones ringing or keep customers coming back for more, Indy John can help. </p>
            <p>
               Start advertising on Indy John today, display and sponsored advertising opportunities are now available.  Please contact our marketing solutions team for details: <a href="mailto:advertise@indyjohn.com">advertise@indyjohn.com</a></p>

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
