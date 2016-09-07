@extends('supplier.app')

@section('content')
<style>
.select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <a href="{{url('referrals')}}">About Supplying Teams</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Team Billing</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom" id="form_wizard_1">
      <div class="col-md-9 col-sm-9">
        <div class="row">
          <h3 class="page-title uppercase"> <i class="fa fa-exchange color-black"> </i> TEAM BILLING </h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-3">
        <div class="row">
          <div class="actions margin-top-15"> <select class="form-control">
         <option>Select Team to View Details</option>
                  <option>Team 1</option>
                      <option>Team 2</option>
            </select> </div>

            </select> </div>
        </div>
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
<h3>Create a New Subscription for your Team Members:</h3>
<p>Select the team members that you would like to upgrade: </p>


      <table class="table table-striped table-bordered table-hover table-checkable order-column" >
            <thead>
              <tr>
                <th>Member Name</th>
                   <th>IJ User ID</th>
                <th>Account Package</th>

                <th class="no-sort" data-orderable="false"> Select to Upgrade </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Mayank</td>
                <td>INJ-125325</td>
                <td>Free Account</td>


                <td class="no-sort"><div class="page-actions">
                    <div class="btn-group">

                     CheckBox

                    </div>
                  </div></td>
              </tr>
            </tbody>
          </table>






                                <button type="submit" class="btn btn-circle yellow-crusta"> <i class="fa fa-check"></i> Upgrade Selected Team Members</button>




         <h3>Current Team Member Subscriptions:</h3>
         
         <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
              <thead>
                <tr>
                  <th> Team Member Name </th>
                      <th> Subscription ID</th>
                        <th>Package Name</th>
                  <th> Created on</th>
                   <th>Last Charged on:</th>
                       <th>Renews on: </th>
                  <th> Status</th>
                  <th> Actions</th>
                 
                </tr>
              </thead>
              <tbody>
              
              <tr>
              <td>Raj Patel
 </td>
              <td>T13252235235</td>
              <td>Gold Supplier</td>
               <td>11/12/2016
 </td>
             
              <td>12/12/2016</td>
               <td>1/12/2017</td>
              <td>Active</td>
              
 
             
              <td><div class="btn-group"> <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                    <ul class="dropdown-menu pull-right">
                      <li> <a href="" target="_blank"><i class="fa fa-eye"></i>View Last Invoice</a></li>
              <li> <a href="" target="_blank"><i class="fa fa-eye"></i> Cancel Subscription</a></li>
                     
                     
                  
                     
                    </ul>
                  </div></td>
              </tr>
                </tbody>
              
            </table>
            
            
         
         
         
           
         </div>
      </div>
    </div>
     <div class="clearfix"></div>
   <p>
  </div>
</div>

<script>
    $("#team-manager-supplying").addClass("active");
    $('#team-manager-supplying-menu-arrow').addClass('open');
    $('#supplying-team-billing').addClass('active');
</script> 
@endsection 
