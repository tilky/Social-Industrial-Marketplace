@extends('home.app')

@section('content')
<div class="login-page">
<div class="homepage ">

    <div class="logo-header">
        <a href="{{url('/')}}"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" class="center-block" alt="logo" width="290"></a>
    </div>

</div>
<div class="section ">
    <div class="container login-content reset-content">
        <h3 class=" text-left animated bounceInDown slower go nopadding font28">Reset Your Account Password</h3>
        @if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
        <div class="col-md-12  animated fadeIn go">
            <h3 class="font18 animated go header_18 text-bold">Reset your Indy John account password.</h3>

            <form role="form" method="POST" action="{{url()}}/password/reset">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="token" value="{{ $token }}">
                
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Your E-mail Address">
                <input type="password" name="password" placeholder="Enter a New Password">
                <input type="password" name="password_confirmation" placeholder="Re-enter the New Password">
                <div class="paddingtop20 row">
                    <div class="col-md-12">
                        <button type="submit" class="btn_red  hvr-bounce-to-right"> Confirm New Password </button>
                    </div>

                </div>

            </form>

        </div>
<!--
        <div class="col-md-6 logininfo">
            <h3 class="font18 animated go header_18 text-bold">Welcome to Indy John.</h3>
            <p>You can use an Indy John account to:</p>
            <ul>
                <li>
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Get Product Quotes </p>
                </li>
                <li>
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Find New Suppliers </p>
                </li>
                <li>
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Explore Indy John Market </p>
                </li>
                <li>
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Search Service Providers </p>
                </li>
                <li>
                    <p><i class="fa fa-check-circle" aria-hidden="true"></i> Build your Network and Trust </p>
                </li>
            </ul>
            <div class="paddingtop20 row">
                <div class="col-md-12">
                    <a href="{{url('/')}}" class="btn_red  hvr-bounce-to-right" style="text-decoration: none!important;"> SIGN UP FOR A FREE ACCOUNT </a>
                </div>

            </div>
        </div>
-->
    </div>
</div>

</div>
<div class="clearfix"></div>
@include('home.footerlinks')
@endsection

