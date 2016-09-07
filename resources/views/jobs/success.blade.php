@extends('buyer.app')

@section('content')
<style>
.bootstrap-tagsinput {
  width: 100% !important;
}
.main-lab{font-size: 15px!important;font-weight: bold;}
.select2-container{display: block!important;}
.ms-container{width: 90%!important;}
@media (min-width: 992px){
.col-md-2n {
    width: 20%!important;
}    
}
.margin-top{margin-top: 5px!important;}
.form-group{border-bottom: 1px solid #eef1f5!important;}
.fileinput{margin-bottom: 0px!important;}
.form-horizontal .form-group{margin-left: 15px!important;margin-right: 15px!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/typeahead/typeahead.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('job')}}">Jobs</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Congratulations!</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> <i class="fa fa-check bold color-black"></i> Congratulations!
</h3>
</div>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="col-md-12">
            <div class="portlet-body" id="blockui_sample_1_portlet_body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
<h3>Your Job Listing is now Active.</h3>

                        <p>The web address (URL) for this job listing is: <a href="{{url('job/view')}}/{{$job->id}}">{{url('job/view')}}/{{$job->id}}</a></p>

 <div class=" margin-bottom-15"><a class="btn btn-cirlce yellow-crusta bold color-black" href="{{url('job/view')}}/{{$job->id}}">Click Here to View this Listing</a>.
  </div>



                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
</div>
<script>
/* for show menu active */
$("#jobs-main-menu").addClass("active");
$('#jobs-main-menu' ).click();
$('#jobs-menu-arrow').addClass('open')
$('#jobs-view-menu').addClass('active');
/* end menu active */

</script>

@endsection
