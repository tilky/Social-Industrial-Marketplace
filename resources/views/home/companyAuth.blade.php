@extends('home.app')

@section('content')
<script src="{{URL::asset('metronic/plugins/jquery.min.js')}}" type="text/javascript"></script>

<div class="complany-signup-page">
    <div class="logo-header">
        <a href="{{url('')}}"><img src="{{URL::asset('frontend/images/Indy-John/Logo.png')}}" class="center-block" alt="logo" width="290"></a>
    </div>
    <div class="mask"></div>
    <div class="title text-center">
        <h2>Add your company </h2>
    </div>

    <div class="form">
        <div class="form-body">
            <div class="text-center">
                <h4>Are you authorized to be the Company Profile admin ?</h4>
                <ul class="list-inline text-center text-capitalize">
                    <li><a href="{{url('singup/company/auth/set')}}/1">Yes</a></li>
                    <li>/</li>
                    <li><a href="{{url('singup/company/auth/set')}}/0" class="show-admin-form">No</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center form-group">
            <p class="small">
                By selecting an Existing Company, you certify that you are associated with the selected company. Your Company profile will be activated once your company admin approves your association.
            </p>
            <a href="{{ redirect()->back()->getTargetUrl() }}">Back</a>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<script>
$( "#main-body" ).addClass( "simple-page" );
</script>
@include('home.footerlinks')
@endsection
