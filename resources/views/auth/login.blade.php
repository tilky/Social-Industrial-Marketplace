@extends('home.app')

@section('content')
<div class="login-page">
<div class="homepage ">

    <div class="logo-header">
        <a href="{{url('/')}}"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" class="center-block" alt="logo" width="290"></a>
    </div>

</div>
<div class="section ">
    <div class="container login-content">
        <h3 class=" text-left animated bounceInDown slower go nopadding font28">Please Login</h3>
        @if(count($errors) > 0)
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                &times;
            </button>

            @if (Session::has('message'))
            <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
            @endif

            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
        @endif
        <div class="col-md-6  animated fadeIn loginform go">
            <h3 class="font18 animated go header_18 text-bold">Login to Indy John</h3>

            <form action="{{url('auth/login')}}" method="post">
                
                <input type="text" name="email" placeholder="Enter Your E-mail Id">
                <input type="password" name="password" placeholder="Enter Your Password">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <p class=""><a href="{{url('password/email')}}">Forgot Password? </a></p>

                <div class="paddingtop20 row">
                    <div class="col-md-12">
                        <button type="submit" class="btn_red  hvr-bounce-to-right"> Login </button>
                    </div>

                </div>

            </form>

        </div>

        <div class="col-md-6 logininfo">
            <h3 class="font18 animated go header_18 text-bold">Welcome to Indy John.</h3>
            <p>You can use an Indy John account to:</p>
            <ul>
                <li>
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Get Product and Service Quotes. </p>
                </li>
                <li>
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Sell your Products and Services. </p>
                </li>
                <li>
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Explore Market Listings. </p>
                </li>
                <li>
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Be Discovered.</p>
                </li>
             
 <li>
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i>Post and Search Jobs.</p>
                </li>
            </ul>
            <div class="paddingtop20 row">
                <div class="col-md-12">
                    <a href="{{url('/')}}" class="btn_red  hvr-bounce-to-right" style="text-decoration: none!important;"> SIGN UP FOR A FREE ACCOUNT </a>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        <h6 class="text-center margin-top-40">By Logging in, you Agree to our <a href="terms" target="_blank">Terms & Conditions</a> & <a href="privacy-policy" target="_blank">Privacy Policy</a>.</h6>
    </div>
</div>

</div>
<div class="clearfix"></div>
@include('home.footerlinks')
@endsection
