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
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('request-product-quotes')}}">Quotes</a>
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
<i class="fa fa-server color-black"></i> View Buy Request</h3>
</div>
</div>
<div class="col-md-6 col-sm-6 text-right">
<div class="row">
                  <h3 class="page-title uppercase">Buy Request#: {{$quote->unique_number}}</h3>
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
    <div class="col-md-12 col-sm-12">
        <!-- responsive -->
        <div id="responsive" class="modal fade" tabindex="-1" data-width="760"></div>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            
            <div class="portlet-body form" id="blockui_sample_1_portlet_body">
                @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
            @endif
            @if(Auth::user()->id == $quote->created_by)
            <div class="mt-element-step">
                <div class="row step-line">
                    <div id="company-first" class="col-md-4 mt-step-col first done">
                        <div class="mt-step-number bg-white">1</div>
                        <div class="mt-step-title uppercase font-grey-cascade">Create a Buy Request</div>
                    </div>
                    <div id="company-second" class="col-md-4 mt-step-col active">
                        <div class="mt-step-number bg-white">2</div>
                        <div class="mt-step-title uppercase font-grey-cascade">Manage & Receive Quotes</div>
                    </div>
                    <div id="company-third" class="col-md-4 mt-step-col last">
                        <div class="mt-step-number bg-white">3</div>
                        <div class="mt-step-title uppercase font-grey-cascade">Actions Taken</div>
                    </div>
                </div>
            </div>
            <div class="yellow-crusta-seprator"></div>
            @endif
            <div class="padding-15" id="print_section">
                <link href="{{URL::asset('metronic/apps/css/todo.min.css')}}" rel="stylesheet" type="text/css" />
                <link href="{{URL::asset('metronic/apps/css/style2.css')}}" rel="stylesheet" type="text/css" />
                <div class="pull-left">
                    <h2><strong>{{$quote->title}}</strong></h2> 
                    <h5><strong>Quantity Requested:</strong> {{$quote->qty_request}} </h5>
                    <h5><strong>Product-Categories Selection:</strong> 
                        @foreach($quote->categories as $index=>$category)
                            @if($index < 3)
                            @if($index == 0)
                            {{$category->category->name}}
                            @else
                            ,{{$category->category->name}}
                            @endif
                            @endif
                        @endforeach
                    </h5>
                    <h5><strong>Submission Date:</strong> {{date('M d, Y',strtotime($quote->created_at))}} | <strong>Expiration Date:</strong> @if(strtotime($quote->expiry_date) > 0){{date('M d, Y',strtotime($quote->expiry_date))}} @else N/A @endif</h5>
                    <h5><strong>Status:</strong> @if($quote->status == 1)Active @else Inactive @endif</h5>
                </div>
                <p />
                
                <div class="clearfix"></div>
                <div class="portlet-title tabbable-line text-center ">
                    <ul class="nav nav-tabs center-nav pull-left text_left">
                        <li class="active"> <a href="#portlet_comments_1" data-toggle="tab"><h4> BUY REQUEST DETAILS</h4> </a> </li>
                        @if(Auth::user()->id == $quote->created_by) <li> <a href="#portlet_comments_2" data-toggle="tab"><h4> QUOTES RECEIVED</h4> </a> </li> @endif
                        <li> <a href="#portlet_comments_3" data-toggle="tab"><h4> VIEW NOTES</h4> </a> </li>
                    </ul>
                </div>
                
                <button style="margin-left:10px;" class="btn btn-danger pull-right" onclick="printDiv('print_section')" ><i class="glyphicon glyphicon-print"></i> Print</button>
                <button style="margin-left:10px;"  class="btn btn-circle btn-md yellow-light pull-right" data-toggle="modal" href="#new_notes">Add a New Note</button>
            <div class="actions pull-right" id="activen-view">
                    @if(Auth::user()->id == $quote->created_by)
                    <div class="btn-group"> <a class="btn btn-circle btn-md yellow-light color-black" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                        <ul class="dropdown-menu pull-right">
                            <li> <a href="{{url('supplier-quotes')}}?quote_id={{$quote->id}}">View Quotes Received</a> </li>
                            <li class="divider"> </li>
                            <li> <a data-toggle="modal" href="#new_notes">Add a New Note</a> </li>
                            <li> <a href="javascript:;" onclick="printDiv('print_section2')">Print Details</a> </li>
                            @if($quote->status == 1)
                            <li>
                                <a href="{{url('quote/buy-request/status')}}/{{$quote->id}}?from=view" id="quotepause_{{$quote->id}}" onclick="PauseQuote(id);">Pause Request </a>
                            </li>
                            @else
                            <li>
                                <a href="{{url('quote/buy-request/status')}}/{{$quote->id}}?from=view" id="quotepause_{{$quote->id}}" onclick="ActiveQuote(id);">Active Request </a>
                            </li>
                            @endif
                            <li> <a id="{{ route('request-product-quotes.edit', $quote->id) }}" onclick="showModal(id)">Extend Request</a> </li>
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_comments_1"> 
                            <!-- BEGIN: Comments 
                            <div class="col-md-12 margin-bottom-20"><div class="row"> <h5 class="text-left"><strong></strong></h5></div></div> -->
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"><div class="row"><strong> Quote Type: </strong></div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            @if(count($quote->Equipments) > 0)
                                            Equipment (
                                                @foreach($quote->Equipments as $index=>$Equipments)
                                                    @if($index == 0)
                                                    {{$Equipments->equipment->name}}
                                                    @else
                                                    ,{{$Equipments->equipment->name}}
                                                    @endif
                                                @endforeach
                                            ): 
                                            @endif
                                            @if(count($quote->materialsToolings) > 0)
                                                Instrumentation (
                                                    @foreach($quote->materialsToolings as $index=>$materialsTooling)
                                                        @if($index == 0)
                                                        {{$materialsTooling->materialsTooling->name}}
                                                        @else
                                                        ,{{$materialsTooling->materialsTooling->name}}
                                                        @endif
                                                    @endforeach
                                                ): 
                                            @endif 
                                            @if(count($quote->services) > 0)
                                                Services (
                                                    @foreach($quote->services as $index=>$service)
                                                        @if($index == 0)
                                                        @if($service->service->name == 'Repairs') Repair @else {{$service->service->name}} @endif
                                                        @else
                                                        ,@if($service->service->name == 'Repairs') Repair @else {{$service->service->name}} @endif
                                                        @endif
                                                    @endforeach
                                                ): 
                                            @endif
                                            @if(count($quote->softwares) > 0)
                                            Software (
                                                @foreach($quote->softwares as $index=>$software)
                                                    @if($index == 0)
                                                    {{$software->software->name}}
                                                    @else
                                                    ,{{$software->software->name}}
                                                    @endif
                                                @endforeach
                                            ): 
                                            @endif
                                            @if(count($quote->consumables) > 0)
                                            Consumables/ Meterials (
                                                @foreach($quote->consumables as $index=>$consumable)
                                                    @if($index == 0)
                                                    @if($consumable->consumable->name == 'Suppliers') Supplies @else {{$consumable->consumable->name}} @endif
                                                    @else
                                                    ,@if($consumable->consumable->name == 'Suppliers') Supplies @else {{$consumable->consumable->name}} @endif
                                                    @endif
                                                @endforeach
                                            )
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if(count($quote->categories) > 0)
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"><div class="row"><strong> Product-Categories Selection:</strong></div> </div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            @foreach($quote->categories as $index=>$category)
                                                @if($index == 0)
                                                {{$category->category->name}}
                                                @else
                                                ,{{$category->category->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @if(count($quote->industries) > 0)
                            <div class="col-md-12 request"><div class="row">
                                <div class="col-md-3 col-sm-3"><div class="row"><strong> Industry Reach Selection: </strong></div></div>
                                <div class="col-md-9 col-sm-9">
                                    <div class="row">
                                        @foreach($quote->industries as $index=>$industry)
                                            @if($index == 0)
                                            {{$industry->industry->name}}
                                            @else
                                            ,{{$industry->industry->name}}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endif
                            
                            @if($quote->techSpecification != '')
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"> <div class="row"><strong>Technical Specifications: </strong></div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                        @foreach($quote->techSpecification as $index=>$opt)
                                            @if($index == 0)
                                            {{$opt['keyword']}}
                                            @else
                                            , {{$opt['keyword']}}
                                            @endif
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @if($quote->request_area != '')
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                    <div class="row"><strong>Supplier Reach:</strong></div> </div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            {{$quote->request_area}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @if($quote->privacy != '')
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"> <div class="row"><strong>Privacy Setting:</strong> </div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            {{$quote->privacy}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($quote->address != '')
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"> <div class="row"><strong>Shipping Address:</strong> </div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            @if($quote->address != '' && $quote->address2 != '')
                                            {{$quote->address}}, {{$quote->address2}}, {{$quote->city}}, {{$quote->state}} - {{$quote->zip}}, {{$quote->country}}
                                            @elseif($quote->address == '')
                                            {{$quote->address2}}, {{$quote->city}}, {{$quote->state}} - {{$quote->zip}}, {{$quote->country}}
                                            @elseif($quote->address2 == '')
                                            {{$quote->address}}, {{$quote->city}}, {{$quote->state}} - {{$quote->zip}}, {{$quote->country}}
                                            @elseif($quote->address == '' && $quote->address2 == '')
                                            {{$quote->city}}, {{$quote->state}} - {{$quote->zip}}, {{$quote->country}}
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @if($quote->additional_file != '')
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"> <div class="row"><strong>Additional File:</strong> </div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            @if($quote->additional_file != '')<a href="{{url()}}/{{$quote->additional_file}}" download>Download File</a>@endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @if(count($quote->accreditations) > 0)
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"> <div class="row"><strong>Accreditations:</strong> </div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            @foreach($quote->accreditations as $index=>$accreditation)
                                                @if($index == 0)
                                                {{$accreditation->accreditation->name}}
                                                @else
                                                ,{{$accreditation->accreditation->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            @if(count($quote->devirsities) > 0)
                            <div class="col-md-12 request">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3"> <div class="row"><strong>Diversity Options:</strong> </div></div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="row">
                                            @foreach($quote->devirsities as $index=>$devirsitie)
                                                @if($index == 0)
                                                {{$devirsitie->diversity->name}}
                                                @else
                                                ,{{$devirsitie->diversity->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="clearfix"></div>
                            <!-- END: Comments --> 
                        </div>
                        @if(Auth::user()->id == $quote->created_by)
                        <div class="tab-pane" id="portlet_comments_2"> 
                            <div class="mt-comments col-md-12">
                                <div class="row">
                                    
                                    <div class="clearfix"></div>
                                    @if(count($SupplierQuotes) > 0)
                                        @foreach ($SupplierQuotes as $index=>$supllierquote)
                                            <div class="mt-comment request request_border">
                                                <div class="col-md-2 col-sm-3 text-center user_info">
                                                    <div class="row">
                                                        <div class="mt-comment-img"> 
                                                            @if($supllierquote->supplierUser->profile_picture != '')
                                                            <img src="{{url('')}}/{{$supllierquote->supplierUser->profile_picture}}" />
                                                            @else
                                                            <img src="{{url('images/default-user.png')}}" width="80px"/>
                                                            @endif
                                                        </div>
                                                        <span class="mt-comment-status">{{$supllierquote->supplierUser->first_name}} {{$supllierquote->supplierUser->last_name}}</span>
                                                        <div class="mt-comment-text"> @if($supllierquote->supplier->quotetek_verify == 1) Verified Member @else Not Verified @endif</div>
                                                        
                                                        @if($supllierquote->star == 'gold')
                                                        <span class="label label-sm  label-gold">Gold Supplier</span>
                                                        @elseif($supllierquote->star == 'silver')
                                                        <span class="label label-sm label-default "> Silver Supplier </span>
                                                        @else
                                                        <span class="label label-sm label-free "> Free Member </span>
                                                        @endif  
                                                        <ul>
                                                            <li><i class="fa fa-comment-o"></i> {{count($supllierquote->supplier->messages)}}</li>
                                                            <li><i class="glyphicon glyphicon-heart-empty"></i> {{count($supllierquote->supplier->endorsements)}}</li>
                                                            <li><i class="glyphicon glyphicon-star-empty"></i> {{count($supllierquote->supplier->reviews)}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-10 col-sm-9 margin-top-15">
                                                    <div class="row">
                                                        <div class="mt-comment-body">
                                                            @if($supllierquote->companyuser != '')
                                                            <div class="mt-comment-info"> 
                                                                
                                                                <span class="mt-comment-author company_name">{{$supllierquote->companyuser->companydetail->name}}</span>  
                                                                <span class="label label-sm label-default "> 
                                                                    @if($supllierquote->companyuser->quotetek_verify == 1)
                                                                        VERIFIED
                                                                    @else
                                                                        NOT VERIFIED
                                                                    @endif
                                                                 </span>
                                                                
                                                            </div>
                                                            <span class="mt-comment-status">{{$supllierquote->companyuser->companydetail->city}}, {{$supllierquote->companyuser->companydetail->state}}, {{$supllierquote->companyuser->companydetail->country}}</span>
                                                            @endif
                                                            <div class="clearfix"></div>
                                                            <span class="mt-comment-author">Quote Submission Date: {{date('m/d/Y',strtotime($supllierquote->created_at))}} | Quote Valid Till: N/A</span>
                                                            <div class="clearfix"></div>
                                                            <div class="mt-comment-text"> {{$supllierquote->supplierUser->about}}</div>
                                                        </div>
                                                        <div class="action_btn btn-circle  pull-right">
                                                            <button class="btn btn-circle pull-right  btn-circle "> 
                                                                @if($supllierquote->price == 0)
                                                                N/A
                                                                @else
                                                                ${{$supllierquote->price}}
                                                                @endif
                                                            </button>
                                                            <br>
                                                            @if(Auth::user()->id == $quote->created_by)
                                                            <div class="actions pull-right">
                                                                <div class="btn-group"> <a class="btn btn-circle action_bg btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                                    <ul class="dropdown-menu pull-right">
                                                                        <li>
                                                                            <a href="{{ route('supplier-quotes.show', $supllierquote->id) }}">View Quote</a>
                                                                        </li>
                                                                        <li class="divider"> </li>
                                                                        @if($supllierquote->status == 0)
                                                                        <li>
                                                                            <a href="{{url('supplierquote/accept')}}/{{$supllierquote->id}}">
                                                                            <i class="fa fa-thumbs-o-up"></i> Accept Quote </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ URL::to('buyer/quote/ignore') }}/{{$current_user_id}}/{{$supllierquote->id}}">
                                                                            <i class="fa fa-ban"></i> Ignore </a>
                                                                        </li>
                                                                        @endif
                                                                        <li>
                                                                            <a href="{{url('messages/create')}}?buyer={{$supllierquote->supplier_id}}">Message Supplier</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{url('feedback/create')}}?receiver_id={{$supllierquote->supplierData->id}}">Feedback</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        @endforeach
                                    @else
                                 
                                  
                <h4>This Buy Request has not received any Quotes yet. </h4>
            
            
                                
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        @endif
                        <div class="tab-pane" id="portlet_comments_3"> 
                            <div class="col-md-12 margin-bottom-20">
                               
                               
                            </div>
                            <div class="todo-container request_todo">
                                <div class="row">
                                    <div class="col-md-12">
                                    <ul class="todo-projects-container">
                                        @foreach($quote->notes as $note)
                                            <li class="todo-projects-item">
                                                <h3>{{$note->subject}}</h3>
                                                <p>{{$note->description}}</p>
                                                <div class="todo-project-item-foot">
                                                    <h5 class="pull-left"><strong>Files Attached:  @if($note->attachment != '')<a href="{{url()}}/{{$note->attachment}}" download>Download File</a>@endif</strong></h5> <div class="clearfix"></div>
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
</div>
<div class="modal fade" id="new_notes" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add A New Private Note</h4>
            </div>
            <form action="{{url('quote/note/save')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="quote_id" value="{{$quote->id}}" />
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
                <div class="modal-body">
                <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Subject</label>
                            <div class="col-md-9">
                                <input type="text" name="subject" class="form-control" placeholder="Enter a Subject" required>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Add Description</label>
                            <div class="col-md-9">
                            <textarea class="form-control" rows="6" placeholder="Enter Note Description" name="description" required></textarea>
                                     </div>
                        </div>
                        <div class="form-group last">
                             <label class="col-md-3 control-label">Upload a File</label>
                             <div class="col-md-9">
                              <div id="proof-file-1" class="col-md-12 paddin-npt fileinput fileinput-new" data-provides="fileinput">
                                    <div class="input-group input-large">
                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                            <span class="fileinput-filename">Add an Attachment</span>
                                        </div>
                                        <span class="input-group-addon btn btn-circle yellow-crusta btn-file">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" data-required="1" name="attachment"> </span>
                                        <a href="javascript:;" class="input-group btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END FORM-->
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger  btn-circle " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-circle yellow-crusta color-black  btn-circle ">Save</button>
                </div>
                </form>
            </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- responsive -->
<div id="responsive" class="modal fade" tabindex="-1" data-width="760"></div>
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<script>
/* for show menu active */
$("#buyer-tool-main-menu").addClass("active");
$('#buyer-tool-main-menu' ).click();
$('#buyer-tool-menu-arrow').addClass('open')
$('#buy-request-view-menu').addClass('active');
/* end menu active */
function showModal(id)
{
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
      var url = id;
      $.ajax({
        url: url,
        type: 'get',
        success: function(data) {
            $('#responsive').html('');
            $('#responsive').html(data.html);
            $('#responsive').modal('show');
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
            App.unblockUI('#blockui_sample_1_portlet_body');
        },   
        done: function() {
            //console.log('error');
            App.unblockUI('#blockui_sample_1_portlet_body');
        },
        error: function() {
            //console.log('error');
            App.unblockUI('#blockui_sample_1_portlet_body');
        }
        
    });
}


function doneyet() { 
  document.body.onmousemove  = ""; 
  location.reload();
} 

</script>
<script src="{{URL::asset('metronic/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/apps/scripts/todo.min.js')}}" type="text/javascript"></script>
@endsection
