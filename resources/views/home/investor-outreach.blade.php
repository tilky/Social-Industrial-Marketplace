@extends('home.app')
@section('content')
@include('home.header')
<!--======================= layout ========================-->

<div class="small-layout animatedParent" style="background-image: url('{{URL::asset('livesite/images/banners/4.jpg')}}') ;">
    <div class="mask"></div>
    <h1 class=" header_middle text-center animated bounceInDown slower go">Investor Outreach</h1>
</div>


<!--=======================================================-->




<!--======================= Navbar ========================-->
<div class="simple-navbar text-center relative">
    <ul class="list-inline">
        <li><a href="{{url('about-us')}}">About Us</a></li>
        <li><a href="{{url('faq')}}">FAQ</a></li>
        <li><a href="{{url('news')}}">Indy John News</a></li>
        <li class="active"><a href="{{url('investor-outreach')}}">Investor Outreach</a></li>
        <li><a href="{{url('contact-us')}}">Contact Us</a></li>
    </ul>
    <div class="vertical_lines"></div>
</div>

<!--=======================================================-->

<!--======================= Questions  ========================-->
<div class="section mincontainer_height animatedParent">
<section class="container">
    <div class="section-content">
        <div class="question">


            <p>Today many startup companies aim to solve many of the same problems and please many of the same communities. We’ve decided to focus on the Industrial marketplace in hopes of bringing it to modernization and less reliant on multiple third party services.  We don’t have to tell you how big the Industrial world is because we all inherently live in an industrial landscape.  From the cranes raised above our cities to the solar panels being installed across the world, this is a marketplace made of hard working people who spend on required equipment, tools, and services and a network of suppliers who aim to satisfy these same people.

<p> We’re currently focused on a product-market fit, primarily building a large user base with quality contributors. We have fresh ideas set to be released in phases and built-in revenue streams, some hitting the market now, some being carefully constructed and released at a later date. Most importantly, we have a strong vision supported by confident projections and a clear understanding that execution and adaptation will be keys to our success.  We have no doubt, we will fulfill our mission.

                <p>Indy John is in expansion mode, and now is the ideal time to look for strategic partners to help us realize a market opportunity.  If you’re interested in assisting or playing a role in our growth as a company? 

               
                        <p>Please contact us at <a href="mailto:partner@indyjohn.com">partner@indyjohn.com</a>

                            <p>Matters unrelated to partnerships should refer to <a href="mailto:support@indyjohn.com">support@indyjohn.com</a> in order to reach the appropriate department and to insure a faster response.</p>




        </div>

    </div>

</section>
</div>
<!--=======================================================-->
@include('home.footerlinks')
@endsection
