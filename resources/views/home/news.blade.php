@extends('home.app')
@section('content')
@include('home.header')
<!--======================= layout ========================-->

<div class="small-layout animatedParent" style="background-image: url('{{URL::asset('livesite/images/banners/13.jpg')}}') ;">
    <div class="mask"></div>
    <h1 class="header_middle text-center animated bounceInDown slower go">Indy John News</h1>
</div>


<!--=======================================================-->



<!--======================= Navbar ========================-->
<div class="simple-navbar text-center relative">
    <ul class="list-inline">
        <li><a href="{{url('about-us')}}">About Us</a></li>
        <li><a href="{{url('faq')}}">FAQ</a></li>
        <li class="active"><a href="{{url('news')}}">Indy John News</a></li>
        <li><a href="{{url('investor-outreach')}}">Investor Outreach</a></li>
        <li><a href="{{url('contact-us')}}">Contact Us</a></li>
    </ul>
    <div class="vertical_lines"></div>
</div>

<!--=======================================================-->


<!--======================= Questions  ========================-->
<div class="section mincontainer_height animatedParent">
<section class="questions-answers container">
    <div class="section-content">
        <div class="question">


            <p>Welcome to our new Indy John news page, this is where you can find out about the latest happenings involving our company. Our hope is that you enjoy our news page, and it helps you stay current with what is going on here at Indy John. Some topics we'll cover in the news page -</p>

            <ul>
                <li>Company news</li>
                <li>
                    Messages to our users</li>
                <li>
                    New product/ service announcements</li>
                <li>
                    Platform tutorials</li>
                <li>
                    Changes to our platform</li>
                <li>
                    Job openings at Indy John</li>
                <li>
                    Event calendar</li>
                <li>
                    Surveys, Polls, Feedback</li>
                <li>
                    Industrial news and happenings

                </li>
            </ul>
            <p>Over the next few weeks we'll begin submitting entries and please be assured that our news cycle will pick up speed once staff if fully assembled. In the meantime, we are looking forward to any feedback or suggestions for our news page. You can send those to <a href="mailto:support@indyjohn.com">support@indyjohn.com</a></p>
            <p>Be sure to check back and have a great day !</p>
            <p>- The Indy John News team</p>
        </div>
    </div>
</section>
</div>
<!--=======================================================-->
@include('home.footerlinks')
@endsection
