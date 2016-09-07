@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/apps/css/todo.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/apps/css/style2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('request-product-quotes')}}">Job Application</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>View</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<div class="col-md-6 col-sm-6">
<div class="row">
<h3 class="page-title uppercase"> 
<i class="fa fa-server color-black"></i> View Applicant Details
</h3>
</div>
</div>
<div class="col-md-6 col-sm-6 text-right">

</div>
</div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <!-- responsive -->
        <div id="responsive" class="modal fade" tabindex="-1" data-width="760"></div>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            
            <div class="portlet-body form" id="blockui_sample_1_portlet_body">
                @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
            @endif
            <div class="padding-15" id="print_section">
                <link href="{{URL::asset('metronic/apps/css/todo.min.css')}}" rel="stylesheet" type="text/css" />
                <link href="{{URL::asset('metronic/apps/css/style2.css')}}" rel="stylesheet" type="text/css" />
                <div class="pull-left">
                    <h2><strong>{{$job->title}}</strong></h2> 
                    <h5><strong>Applicant Name:</strong> {{$application->user->userdetail->first_name}} {{$application->user->userdetail->last_name}}</h5>
                    <h5><strong>Submission Date:</strong> {{date('M d, Y',strtotime($application->created_at))}}</h5>
                </div>
                <div class="actions pull-right title_action" id="activen-view">
                    <div class="btn-group"> <a class="btn btn-circle action_bg btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{url('home/user/profile')}}/{{$application->user_id}}" target="_blank">
                                <i class="fa fa-user"></i> View Applicant Profile</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser({{$application->user_id}})" >
                                <i class="fa fa-envelope-o"></i> Message</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;" onclick="addNote({{$application->id}})">
                                <i class="fa fa-user"></i> Add Notes</a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <div class="clearfix"></div>
                <div class="portlet-title tabbable-line text-center ">
                    <ul class="nav nav-tabs center-nav">
                        <li class="active"> <a href="#portlet_comments_1" data-toggle="tab"><strong> Applicant Details</strong> </a> </li>
                        <li> <a href="#portlet_comments_2" data-toggle="tab"><strong> NOTES</strong> </a> </li>
                    </ul>
                </div>
                <button class="btn btn-circle btn-md yellow-light pull-right" onclick="addNote({{$application->id}})">Add a New Note</button>
            
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_comments_1"> 
                            <!-- BEGIN: Comments -->
                            <div class="col-md-12 margin-bottom-20"><div class="row"> <h5 class="text-left uppercase"><strong>Applicant Details</strong></h5></div></div>
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"><div class="row"><strong> Applicant Profile: </strong></div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                           <a href="{{url('home/user/profile')}}/{{$application->user->id}}" target="_blank">{{$application->user->userdetail->first_name}} {{$application->user->userdetail->last_name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"><div class="row"><strong> Brief Summary: </strong></div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                           {{$application->summary}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"><div class="row"><strong> Authorized to work in Location: </strong></div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                           {{$application->authorized_work}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"><div class="row"><strong> Cover Letter: </strong></div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            @if($application->cover_latter != '')
                                            <a href="{{url('/')}}/{{$application->cover_latter}}" download>Download Cover Letter</a>
                                            @else
                                            N/A
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"><div class="row"><strong> Resume: </strong></div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                           @if($application->resume != '')
                                            <a href="{{url('/')}}/{{$application->resume}}" download>Download Applicant Resume</a>
                                            @else
                                            N/A
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"><div class="row"><strong> certify that the information provided on this form and profile is accurate: </strong></div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                           {{$application->certify_information}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="clearfix"></div>
                            <!-- END: Comments --> 
                        </div>
                        
                        <div class="tab-pane" id="portlet_comments_2"> 
                            <div class="col-md-12 margin-bottom-20">
                                <div class="row"> 
                                    <h5 class="text-left pull-left"><strong>SAVED NOTES </strong></h5>
                                </div>
                            </div>
                            <div class="todo-container request_todo">
                                <div class="row">
                                    <div class="col-md-12">
                                    <ul class="todo-projects-container">
                                        @foreach($application->notes as $note)
                                            <li class="todo-projects-item">
                                                <p>{{$note->note}}</p>
                                                <div class="todo-project-item-foot">
                                                    <h5 class="pull-left"><strong>Added on Date:</strong> {{date('m/d/Y',strtotime($note->created_at))}} | <strong>Added By:</strong> {{$note->noteUser->userdetail->first_name}} {{$note->noteUser->userdetail->last_name}}</h5>
                                                </div>
                                                 <div class="clearfix"></div>
                                            </li>
                                            <div class="todo-projects-divider"></div>
                                        @endforeach
                                            
                                    </ul>
                                </div>
                                
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
        
            </div>
        <div class="clearfix"></div>  
            </div>
    </div>
</div>
</div>
<!-- Add note modal -->
<div class="modal fade" id="new_apply_job_notes" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add A New Note</h4>
            </div>
            <form action="{{url('applicant/note/save')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="job_apply_id" value="" id="apply-job-id" />
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
                <div class="modal-body">
                <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Note</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="6" placeholder="Enter Note Description" name="note" required=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger  btn-circle " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-circle yellow-crusta color-black  btn-circle ">Save</button>
                </div>
                <!-- END FORM-->
                </form>
            </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end -->
<script>
/* for show menu active */
$("#buyer-tool-main-menu").addClass("active");
$('#buyer-tool-main-menu' ).click();
$('#buyer-tool-menu-arrow').addClass('open')
$('#buy-request-view-menu').addClass('active');
/* end menu active */
function addNote(id)
{
    $('#apply-job-id').val(id);
    $('#new_apply_job_notes').modal('show');
}

</script>
<script src="{{URL::asset('metronic/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/apps/scripts/todo.min.js')}}" type="text/javascript"></script>
@endsection
