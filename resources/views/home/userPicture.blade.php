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
        <h2>Add your Profile Photo </h2>
        <h4>Profiles with photo get 2x endorsements on Indy John.</h4>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{url('auth/register')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    
    <div class="form">
        <div class="profile-img">
            <img src="{{URL::asset('frontend/images/Indy-John/profile-pic.png')}}" alt="..." class="img-circle" id="myImg">
            <div class="upload_div hvr-rectangle-out">   
                    <input type="file" name="profile_picture" id="fil_ups">
                        <div> 
                       <a href="#"> 
                      
                      <span>Upload Image</span>
                       </a>
                      
                    </div>
                  </div>
        </div>
        <div class="text-center">
            <div class="form-group">
               <button class="btn btn-circle " type="submit">Finish</button>
            </div>
        </div>
    </div>
    </form>
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
