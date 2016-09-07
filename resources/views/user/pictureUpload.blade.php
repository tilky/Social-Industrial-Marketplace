@extends('buyer.app')
@section('content')
<style>
.thumbnail{border: none!important;}
.thumbnail a>img, .thumbnail>img{border-radius: 50%!important;}
.fileinput .thumbnail > img{width: 142px!important;height: 142px!important;max-width: 100%!important;}
</style>
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Dashboard</a>
        </li>
        <li>
            <span>User Detail</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-plus color-black"></i> Upload Your Profile Photo
</h3>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="col-md-12">

                <div  class="portlet-body form">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="mt-element-step">
                    <div class="row step-line">
                        <div id="company-first" class="col-md-4 mt-step-col first done">
                            <div class="mt-step-number bg-white"><i class="fa fa-check"></i></div>
                            <div class="mt-step-title uppercase font-grey-cascade">REQUIRED INFORMATION</div>
                        </div>
                        <div id="company-second" class="col-md-4 mt-step-col done">
                            <div class="mt-step-number bg-white"><i class="fa fa-check"></i></div>
                            <div class="mt-step-title uppercase font-grey-cascade">ADDITIONAL INFORMATION</div>
                        </div>
                        <div id="company-third" class="col-md-4 mt-step-col last active">
                            <div class="mt-step-number bg-white">3</div>
                            <div class="mt-step-title uppercase font-grey-cascade">UPLOAD PHOTO</div>
                        </div>
                        <!--<div id="company-forth" class="col-md-3 mt-step-col last">
                            <div class="mt-step-number bg-white">4</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Success page</div>
                        </div>-->
                    </div>
                </div>
                <div class="yellow-crusta-seprator"></div>
                <form action="{{url('user/avtar/save')}}" method="POST" role="form" class="horizontal-form form-horizontal" enctype="multipart/form-data">
                    <div class="form-body padding-15">
                       
                        <p class="caption-helper">Upload a headshot photo. This will display on your Indy John Profile.</p>
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="first_time" value="1" />
                        <div class="form-group align-center">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                @if($userData->profile_picture != '')
                                <img src="{{url('')}}/{{$userData->profile_picture}}" id="profilr-picture" class="img-circle" alt="" /> 
                                @else
                                <img src="{{url('frontend/images/Indy-John/profile-pic.png')}}" id="profilr-picture" class="img-circle" alt="" />
                                @endif
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                            <div>
                                <span class="btn btn-circle default btn-file red">
                                    <span class="fileinput-new red"> Upload a Photo </span>
                                    <span class="fileinput-exists"> Update  </span>
                                    <input type="file" name="profile_picture"> 
                                </span>
                                <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                @if($userData->profile_picture != '')
                                    <a href="javascript:;" class="btn btn-circle  red fileinput-new" id="profile-div-pic" onclick="clearProfilePic({{Auth::user()->id}})"> Clear </a>
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>  
                    <div class="form-actions right padding-top align-right">
                        <a href="{{url('user-additional-details')}}" class="btn btn-circle default bold button-previous">
                            <i class="fa fa-angle-left"></i> Back </a>
                        <button type="submit" class="btn btn-circle yellow-crusta color-black bold"><i class="fa fa-check"></i>Complete Account Setup</button>
                    </div>
                </form>
            </div>
            </div>
            </div>
</div>
</div>
<script>
function clearProfilePic(id)
{
    var baseurl = "{{url('user/picture/remove')}}"+'/'+id;
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    jQuery.ajax({
        url: baseurl,
        type: 'get',
        success: function(data) {
                    $('#profilr-picture').attr('src',"{{url('frontend/images/Indy-John/profile-pic.png')}}");
                    $('#profile-div-pic').hide();
                    $('#profile-div-pic-1').hide();
                    App.unblockUI('#blockui_sample_1_portlet_body');
                 },
        done: function() {
            //console.log('error');
        },
        error: function() {
            //console.log('error');
        }
        
    });  
}

</script>

<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
@endsection
