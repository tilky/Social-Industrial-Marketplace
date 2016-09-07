@extends('buyer.app')



@section('content')
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Saved Jobs</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom">
      <h3 class="page-title uppercase"> <i class="fa fa-server color-black"></i> Manage Saved Jobs </h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12"> 
      
      <!-- BEGIN EXAMPLE TABLE PORTLET-->
      
      <div class="portlet-body"> @if (Session::has('message'))
        <div id="" class="custom-alerts alert alert-success fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
          {{ Session::get('message') }}</div>
        @endif
        <div class="col-md-9 paddin-npt">
          <p class="caption-helper">Manage all your saved jobs here.</p>
        </div>
        <div class="col-md-12 paddin-npt">
          <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
            <thead>
              <tr>
                <th> Job Title </th>
                <th> Status </th>
                <th> Posted on </th>
                <th> Expires on </th>
                <th> Posted By </th>
                <th> Action </th>
              </tr>
            </thead>
            <tbody>
            
            @foreach ($jobs as $job)
            <tr class="odd gradeX">
              <td>{{$job->jobdetail->title}}</td>
              <td> @if($job->jobdetail->status == 1)
                
                Active
                
                @else
                
                Disabled 
                
                @endif </td>
              <td> {{date('M d, Y',strtotime($job->jobdetail->created_at))}} </td>
              <td> {{date('M d, Y',strtotime($job->jobdetail->expiry_date))}} </td>
              <td> {{$job->jobdetail->jobUser->userdetail->first_name}} {{$job->jobdetail->jobUser->userdetail->last_name}} </td>
              <td><a href="{{url('job/view')}}/{{$job->jobdetail->id}}" class="btn btn-danger" target="_blank"><i class="fa fa-eye"></i> View</a> <a href="#job_apply" data-toggle="modal" data-target="#job_apply" onclick="ApplyJobModal({{$job->jobdetail->id}})" class="btn btn-danger btn-sm"> <i class="fa fa-check"></i> Apply </a> 
                
                <!--<a href="{{url('job/user/apply')}}/{{$job->jobdetail->id}}/{{$user->id}}" class="btn btn-danger btn-sm"><i class="fa fa-check"></i> Apply</a>--></td>
            </tr>
            @endforeach
              </tbody>
            
          </table>
        </div>
        <ul class="pager">
          @if($previousPageUrl != '')
          <li class="previous"> <a class="btn btn-danger" href="{{$previousPageUrl}}"> ? Prev </a> </li>
          @endif
          
          @if($nextPageUrl != '')
          <li class="next"> <a class="btn btn-danger" href="{{$nextPageUrl}}"> Next ? </a> </li>
          @endif
        </ul>
      </div>
      
      <!-- END EXAMPLE TABLE PORTLET--> 
      
    </div>
  </div>
</div>

<!-- responsive -->

<div id="responsive" class="modal fade" tabindex="-1" data-width="760"></div>

<!-- BEGIN EXAMPLE TABLE PORTLET--> 

<script>



    /* for show menu active */



    $("#jobs-main-menu").addClass("active");



	$('#jobs-main-menu' ).click();



	$('#jobs-menu-arrow').addClass('open');



	$('#jobs-saved-menu').addClass('active');



    /* end menu active */



</script> 
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
@endsection 
