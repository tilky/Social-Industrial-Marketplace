@extends('supplier.app')



@section('content')
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Assign Leads</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom" id="form_wizard_1">
      <div class="col-md-9 col-sm-9">
        <div class="row">
          <h3 class="page-title uppercase"> <i class="fa fa-exchange color-black"> </i> Assign Leads</h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-3">
        <div class="row">
          <div class="actions margin-top-15"> <select class="form-control">
         <option>Select Team </option>
                  <option>Team 1</option>
                      <option>Team 2</option>
            </select> </div>
              
            </select> </div>
        </div>
      </div>
    </div>
    
    
    
      <div class="col-md-9 paddin-npt">
            <p class="caption-helper">Select and Assign Buy Requests to your Team Member(s):</p>
          </div>
          <p />
          
          	   <div class="form-group">
                                    <div class="col-md-6 paddin-npt padding-right">
                                        <label class="col-md-12 paddin-npt">Select Lead:
                                        <div class="col-md-12 paddin-npt">
                                            <input type="text" name="manufacturer" class="form-control" value="{{Request::old('manufacturer')}}" placeholder="Enter a Value" />
    										<span class="help-block margin-top">Select the Buy Requests that you want to assign.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 paddin-npt">
                                        <label class="col-md-12 paddin-npt">Select Team Member(s):
                                        <div class="col-md-12 paddin-npt">
                                            <input type="text" name="model_number" class="form-control" value="{{Request::old('model_number')}}" placeholder="Enter a Value" />
    										<span class="help-block margin-top">Type and select the team members you want to assign this buy request to.</span>
                                        </div>
                                    </div>
                                </div>
          
      <div class="col-md-6 paddin-npt right">
                                <button type="submit" class="btn btn-circle yellow-crusta"> <i class="fa fa-check"></i>Assign Lead</button>
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
          <div class="col-md-9 paddin-npt">
            <p class="caption-helper">Recently Assigned Leads:</p>
          </div>
          <div class="col-md-12 paddin-npt">
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
              <thead>
                <tr>
                  <th> Lead Name </th>
                  <th> Lead Request</th>
                  <th> Created On</th>
                  <th> Assigned On</th>
                  <th>Assigned To</th>
                  <th> Actions </th>
                </tr>
              </thead>
              <tbody>
              
              <tr>
              <td>Multimeteres
 </td>
              <td>IJL-124123</td>
              <td>10/25/2016</td>
              <td>10/22/2016</td>
              <td><a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">Prakash</a></td>
              <td><div class="btn-group"> <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                    <ul class="dropdown-menu pull-right">
                      <li> <a href="" target="_blank"><i class="fa fa-eye"></i> View Lead</a></li>
              <li> <a href="" target="_blank"><i class="fa fa-eye"></i> Send Quote</a></li>
                     
                      <li><a href="" onclick=""><i class="fa fa-edit"></i> Reassign</a></li>
                     
            
                 
                     
                      <li><a href="" ><i class="fa fa-file-o"></i>Message Supplier</a></li>
                 
                      <li> <a href="" ><i class="fa fa-file-text-o"></i> Message Team Members</a> </li>
                               <li class="divider"> </li>   
                      <li> <a href="" ><i class="fa fa-pencil-remove"></i> Dismiss Assignment</a> </li>
                     
                    </ul>
                  </div></td>
              </tr>
                </tbody>
              
            </table>
               <button type="submit" class="btn btn-circle btn-danger"> <i class="fa fa-check"></i> View All Assigned Leads</button>
               
          </div>
          
           
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
