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
            <span>POST A Job</span>
        </li>
    </ul>
</div>






<div class="row">
    <div class="col-md-12">
        <div class="portlet box red" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption bold color-black">
                    <i class="fa fa-plus bold color-black"></i>JOB Payment</div>
            </div>

            <div class="portlet-body form" id="blockui_sample_1_portlet_body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <div class="mt-element-step">
                    <div class="row step-line">
                        <div id="company-first" class="col-md-6 mt-step-col first done">
                            <div class="mt-step-number bg-white">1</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Listing Details</div>
                        </div>
                        <div id="company-second" class="col-md-6 mt-step-col last active">
                            <div class="mt-step-number bg-white">2</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Payment</div>
                        </div>
                    </div>
                </div>
                
                <!-- BEGIN FORM-->
                <form action="{{url('job/payment/save')}}" class="horizontal-form form-horizontal" method="post">
                    <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" name="job_id" value="{{$job->id}}" />
                    <div class="form-body">
                        <div class="form-group">
                            "You have 15 job posting credits left this month."
                        </div>
                        
                    </div>
                    <div class="form-actions right">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle btn-outline yellow-crusta color-black bold"> <i class="fa fa-check"></i>Submit Payment</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
/* for show menu active */
$("#jobs-main-menu").addClass("active");
$('#jobs-main-menu' ).click();
$('#jobs-menu-arrow').addClass('open')
$('#jobs-create-menu').addClass('active');
/* end menu active */

</script>

@endsection
