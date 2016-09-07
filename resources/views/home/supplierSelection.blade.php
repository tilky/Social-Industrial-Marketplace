@extends('home.app')

@section('content')
<style>
.hvr-rectangle-out:before{background: none!important;cursor: pointer;}
#fil_ups{cursor: pointer;}
</style>
<script src="{{URL::asset('metronic/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script>
$("#main-body").addClass("simple-page");
</script>
<div class="complany-signup-page">
    <div class="logo-header">
        <a href="{{url('')}}"><img src="{{URL::asset('frontend/images/Indy-John/Logo.png')}}" class="center-block" alt="logo" width="290"></a>
    </div>
    <div class="mask"></div>
    <div class="title text-center">
        <h2>Supplier After Create</h2>
    </div>
    
</div>
<div class="clearfix"></div>
<script>
$(function () {
    $("#fil_ups").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
});

function imageIsLoaded(e) {
    $('#myImg').attr('src', e.target.result);
};
</script>
@include('home.footerlinks')
@endsection
