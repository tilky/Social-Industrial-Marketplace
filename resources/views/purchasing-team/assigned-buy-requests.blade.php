@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Team Purchasing</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom">
    <div class="col-md-9 col-sm-9">
        <div class="row">
      <h3 class="page-title uppercase"> <i class="fa fa-group color-black"></i> Manage My Teams </h3>
      </div>
      </div>
      <div class="col-md-3 col-sm-3">
        <div class="row">
            <div class="actions margin-top-15">
                <select name="team_name" id="teamId" class="form-control">
                    <option>Select Team </option>
                    @foreach($buyerTeam as $Team)
                    <option value="{{ $Team->id }}">{{$Team->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12"> 
        
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        
        <div class="portlet-body"> @if (Session::has('message'))
          <div id="" class="custom-alerts alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            {{ Session::get('message') }}</div>
          @endif
          <div class="col-md-12 ">
            <p class="caption-helper">Purchasing Teams that you're a part of: </p>
            <div class="col-md-2 col-sm-2 col-xs-12 pull-right" > <div class="row"><select id="received-quote-filter" onchange="ApplyFilterQuote();" class="form-control col-md-8" style="float: left;">
          <option value="">Sort By: (Recent / Oldest ) </option>
          

            
        </select> <a href="javascript:void(0)" onclick="ApplyFilter();"><i class="fa fa-long-arrow-down padding-top" style="float: left;padding-left: 5px;"></i></a></div>
            </div>
          </div>
          <div class="col-md-12 paddin-npt">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
              <thead>
                <tr>
                  <th> Team Name </th>
                  <th> Role </th>
                  <th> Last Activilty On</th>
                  <th> Assigned Territory </th>
                  <th>Team Manager</th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
              
              <tr>
              <td>Mayank
 </td>
              <td>Member</td>
              <td>10/25/2016</td>
              <td><a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">North</a></td>
              <td>Prakash</td>
              <td><div class="btn-group"> <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                    <ul class="dropdown-menu pull-right">
                      <li> <a href="" target="_blank"><i class="fa fa-eye"></i> View Members</a></li>
              
                     
                      <li><a href="" onclick=""><i class="fa fa-inbox"></i> Group Messages</a></li>
                     
            
                 
                     
                      <li><a href="" ><i class="fa fa-file-o"></i> View Assigned Buy Requests </a></li>
                 
                      <li> <a href="" ><i class="fa fa-file-text-o"></i> View Assigned Quotes</a> </li>
                               <li class="divider"> </li>   
                      <li> <a href="" ><i class="fa fa-pencil-remove"></i> Remove From Team</a> </li>
                     
                    </ul>
                  </div></td>
              </tr>
                </tbody>
              
            </table>
          </div>
            Hiren: View Team Members link from Actions menu should go to view-team-members.blade.php where we can see all team members of the team.  
           
         {{-- strike out until Hiren Enables Pagination. 
          <ul class="pager">
            @if($previous Page Url != '')
            <li class="previous"> <a class="btn btn-danger" href="{{$previousPageUrl}}"> ← Prev </a> </li>
            @endif
            
            @if($next Page Url != '')
            <li class="next"> <a class="btn btn-danger" href="{{$nextPageUrl}}"> Next → </a> </li>
            @endif
          </ul>
      --}}
                    
        </div>
  
        <!-- end --> 
        
        <!-- END EXAMPLE TABLE PORTLET--> 
        
      </div>
    </div>
  </div>
</div>


@endsection 
