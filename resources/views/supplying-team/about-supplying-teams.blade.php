@extends('supplier.app')

@section('content')
<style>
.select2-container{display: block!important;}
.leftright_section .wh_border{
    font-size: 18px;
	display: table;
}
.leftright_section p{
	 display: table-cell;
  vertical-align: middle;
}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <a href="{{url('referrals')}}">About Supplying Teams</a> <i class="fa fa-circle"></i> </li>
    <li> <span>About Proram</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom">
      <h3 class="page-title uppercase"> <i class="fa fa-group color-black"></i> Quote-Lead Teams™ - Team Supplying</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="portlet-body form"> @if($errors->any())
        <div class="alert alert-danger"> @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
          @endforeach </div>
        @endif
        @if (Session::has('message'))
        <div id="" class="custom-alerts alert alert-success fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
          {{ Session::get('message') }}</div>
        @endif
        <div class="col-md-12">
<h3>Allow Indy John to be your Lead-Generation tool for team supplying.  </h3>
          <p class="caption-helper"> Our <strong>Quote-Lead Teams™</strong> feature is an extension of our Quote-Lead System; it works exactly the same way but allows for <b>Team Purchasing</b> and <b>Team Supplying</b>.  This feature is ideal for all users looking to put some structure to their large industrial selling process.  Below are some activities that will be available to you using this feature:</p>
                 <p class="caption-helper"><b> Team Manager: </b></p>
          <ul class="caption-helper">
            <li>Create Lead Requests and Assign them to team members</li>
            <li>Add or remove team members</li>
            <li>Manage and organize all team related details</li>
 
          </ul>
          

   <p class="caption-helper"><b> Team Member: </b></p>
          <ul class="caption-helper">
            <li>Be the point of contact for a specific Lead Request</li>
            <li>Quote new incoming Buy Requests</li>
            <li>Network and meet new sales prospects</li>
 
          </ul>
          


          <!--
<div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img width="20px" src="{{URL::asset('livesite/images/icons/interface-1.png')}}" alt=""/></i>
-->
          
          <div class="animatedParent">
            <h3 class="header_middle text-center  animated fadeIn nopadding go margin-bottom-40">Start a team in 3 simple steps:</h3>
            <div class="redprocess section">
              <div class="leftright_section">
                <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/interface-1.png')}}" alt=""></i><p>Set a Team Manager and provide a few details.</p></div>
                <div class="number_text left_icon hovicon effect-1 animation-element slide-left">1</div>
              </div>
              <div class="clearfix"></div>
              <div class="leftright_section pull-right border_middle_ver">
                <div class="number_text right_icon hovicon animation-element slide-right">2</div>
                <div class="col-md-9 col-sm-9 wh_border wh_borderleft"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/college-research.png')}}" alt=""></i><p>Invite Indy John users to join your team.</p></div>
              </div>
              <div class="clearfix"></div>
              <div class="leftright_section">
                <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('livesite/images/icons/folder.png')}}" alt=""></i><p>Create Lead Requests and Start assigning to team members.</p></div>
                <div class="number_text left_icon hovicon animation-element slide-left">3</div>
              </div>
            </div>
           
          <div class="clearfix"></div>

        </div>
        <div class="col-md-12 margin-top-30 margin-bottom-15 text-center"><a href="{{url('/start-supplying-team')}}" class="btn btn-circle btn-danger">Start a New Supplying Team</a></div>
      </div>
    </div>
    
   
  </div>
</div>
<script>

$("#team-supplying").addClass("active");
$('#team-supplying-menu-arrow').addClass('open');
$('#about-supplying-teams').addClass('active');

</script> 
@endsection 
