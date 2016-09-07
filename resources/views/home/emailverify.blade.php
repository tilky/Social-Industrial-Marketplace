@extends('home.header')

@section('content')

<style>
input, select, textarea {
    width: 100%;
    border: 1px solid #bababa;
    border-radius: 30px;
    padding: 10px;
    padding-left: 20px;
    outline: 0;
    margin-bottom: 30px;
}
</style>
<link href="{{URL::asset('css/style_custom.css')}}" rel="stylesheet">
<!-- Custome Style -->
    <link href="{{URL::asset('css/style.css')}}"" rel="stylesheet" type="text/css" />
    <!-- end Custome Style -->
    
<div class="section fade">
    <div class="container animatedParent">
        <div class="text-center"> 
            <h3 class="header_middle  ">Email Verification</h3>
        </div>
        @if($success == 1)
            <h4>Your email verified successfully,please login now <a href="{{url('auth/login')}}">Login</a></h4>
        @elseif($success == 2)
            <h4>Your email verified wrong or expire. Please contact admin</h4>
        @else
            <h4>Please verify your email. check your mail inbox for verification link or contact admin for verify account.</h4>
        @endif 
    </div>
</div>
<div class="clearfix"></div>

@include('home.footerlinks')
@endsection
