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
      <h3 class="page-title uppercase"> <i class="fa fa-group color-black"></i> Manage My Teams </h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet-body">
            @if (Session::has('message'))
            <div id="" class="custom-alerts alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                {{ Session::get('message') }}
            </div>
            @endif
            <div class="col-md-9 paddin-npt">
                <p class="caption-helper">Purchasing Teams that you're a part of: </p>
            </div>
            <div class="col-md-12 paddin-npt">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                             <th> Team Name </th>
                             <th> Your Role </th>
                             <th> Last Team Activity </th>
                             <th> Assigned Territory/Section </th>
                             <th> Team Manager </th>
                             <th> Team Creation Date </th>
                             <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($mySupplierTeam as $team)
                      <tr>
                          <td>{{ $team['teamName'] }}</td>
                          <td>{{ $team['role'] }}</td>
                          <td>{{ $team['lastTeamActivity'] }}</td>
                          <td>{{ $team['assignedTerritory'] }}</td>
                          <td>{{ $team['teamManager'] }}</td>
                          <td>{{ $team['teamCreationDate'] }}</td>
                          <td>
                              <div class="btn-group">
                                  <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                  <ul class="dropdown-menu pull-right">
                                      <li> <a href="{{url('viewBuyerTeamMembers/')}}/{{$team['teamId']}}" target="_blank"><i class="fa fa-eye"></i> View Members</a></li>
                                      <li><a href="{{url('/message-purchasing-team')}}?team_id={{$team['teamId']}}" target="_blank"><i class="fa fa-inbox"></i> Group Messages</a></li>
                                      <li><a href="{{url('/view-assigned-buy-requests')}}?team_id={{$team['teamId']}}" target="_blank" ><i class="fa fa-file-o"></i> View Assigned Buy Requests </a></li>
                                  </ul>
                              </div>
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
          </div>
          <ul class="pager">
             @if($previousPageUrl != '')
             <li class="previous">
                <a href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i> Prev </a>
             </li>
             @endif
             @if($nextPageUrl != '')
             <li class="next">
                <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i> </a>
             </li>
             @endif
          </ul>
       </div>
        <!-- end -->
        <!-- END EXAMPLE TABLE PORTLET-->
      </div>
    </div>
  </div>
</div>

<script>
    $("#team-purchasing").addClass("active");
    $('#team-purchasing-menu-arrow').addClass('open');
    $('#manage-my-purchasing-teams').addClass('active');
</script>

@endsection 
