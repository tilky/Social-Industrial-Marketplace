@extends('home.app')

@section('content')
<div class="login-page">
<div class="homepage">

    <div class="logo-header">
        <a href="{{url('/')}}"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" class="center-block" alt="logo" width="290"></a>
    </div>

</div>
<div class="section ">
    <div class="container login-content">
        <h3 class=" text-left animated bounceInDown slower go nopadding font28">Reset my Password</h3>
        @if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif

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
        <div class="col-md-6  animated fadeIn loginform go forgot_password">
            <h3 class="font18 animated go header_18 text-bold">Forgot your password?</h3>
            
<p>Enter your e-mail address to request a password reset link. </p>
            <form role="form" method="POST" action="{{url('password/email')}}">
                <input type="text" name="email" value="{{ old('email') }}" placeholder="Enter Your E-mail Id">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="paddingtop20 row">
                    <div class="col-md-12">
                        <button type="submit" class="btn_red  hvr-bounce-to-right"> Request Reset </button>
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
                    <button type="submit" class="btn_red  hvr-bounce-to-right"> SIGN UP FOR A FREE ACCOUNT </button>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<div class="clearfix"></div>
@include('home.footerlinks')
@endsection
