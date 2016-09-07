@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Supplier Leads</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 col-sm-12 border2x_bottom">
<div class="col-md-8 col-sm-8 ">
<div class="row">
<h3 class="page-title uppercase"> 
<i class="fa fa-server"></i>  Catalog Submission History
</h3>
</div>
</div>

<div class="col-md-4 col-sm-4 text-right">
<div class="row">
 @if($user_access_level == 3)
                <div class="actions margin-top-10">
                    <a href="{{ URL::to('supplier-leads/create') }}" class="btn btn-danger btn-sm">
                        <i class="fa fa-plus"></i>  Create a New Lead Request</a>
                </div>
                @endif
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="col-md-12 margin-top-10">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th> Submission Date</th>
                        <th>File Name </th>
                        <th> Selected Lead Types </th>
                        <th>Status</th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($supplierLeads as $index=>$lead)
                        <tr>
                            <td style="max-width: 200px;">
                                {{date('Y-m-d',strtotime($lead->created_at))}}
                            </td>
                            <td>
                                <a href="{{url('')}}/{{$lead->file_path}}" download>{{explode('/',$lead->file_path)[3]}}</a>
                            </td>
                            <td>
                                @if(count($lead->Equipments) > 0)
                                    @foreach($lead->Equipments as $index=>$equipment)
                                        @if($index == 0)
                                            {{$equipment->equipment->name}}
                                        @else
                                            ,{{$equipment->equipment->name}}
                                        @endif
                                    @endforeach
                                    <br />
                                @endif
                                
                                @if(count($lead->materialsToolings) > 0)
                                    @foreach($lead->materialsToolings as $index=>$materialstooling)
                                        @if($index == 0)
                                            {{$materialstooling->materialstooling->name}}
                                        @else
                                            ,{{$materialstooling->materialstooling->name}}
                                        @endif
                                    @endforeach
                                    <br />
                                @endif
                                @if(count($lead->services) > 0)
                                    @foreach($lead->services as $index=>$service)
                                        @if($index == 0)
                                            {{$service->service->name}}
                                        @else
                                            ,{{$service->service->name}}
                                        @endif
                                    @endforeach
                                    <br />
                                @endif
                                @if(count($lead->softwares) > 0)
                                    @foreach($lead->softwares as $index=>$software)
                                        @if($index == 0)
                                            {{$software->software->name}}
                                        @else
                                            ,{{$software->software->name}}
                                        @endif
                                    @endforeach
                                    <br />
                                @endif
                            </td>
                            
                            <td></td>
                            <td>
                                <!--<a href="{{ route('supplier-leads.show', $lead->id) }}" class="btn btn-success btn-sm">
                                <i class="fa fa-eye"></i>  View </a>-->
                               
                  
                    <div class="btn-group"> <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i>  </a>
                        <ul class="dropdown-menu pull-right">
                            <li> <a href="{{ route('supplier-leads.edit', $lead->id) }}">
                                    <i class="fa fa-edit"></i>  Edit </a> </li>
                            <li class="divider"> </li>
                            @if($lead->status == 0)
                            <li> <a href="{{url('supplierlead/status/update')}}/{{$lead->id}}/1">
                                <i class="fa fa-pause"></i>  Change Status </a> </li>
                                @else
                            <li> <a href="{{url('supplierlead/status/update')}}/{{$lead->id}}/0">
                                <i class="fa fa-play"></i>  Change Status </a> </li>
                                @endif
                            <li class="divider"> </li>
                            <li>
                                <a id="deleteButton" data-id="{{$lead->id}}" data-toggle="modal" href="#deleteConfirmation">
    
                                {!! Form::open([
                                'method' => 'DELETE',
                                'id' => 'DELETE_FORM_'.$lead->id,
                                'route' => ['supplier-leads.destroy', $lead->id]
                                ]) !!}
                                {!! Form::close() !!}
                                    <i class="fa fa-remove"></i>  Delete </a>
                            </li>
                           
                            
                            
                        </ul>
                    </div>
                    
                
                                
                               
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <ul class="pager">
                    @if($previousPageUrl != '')
                    <li class="previous">
                        <a href="{{$previousPageUrl}}"> <i class="fa fa-long-arrow-left"></i>  Prev </a>
                    </li>
                    @endif
                    @if($nextPageUrl != '')
                    <li class="next">
                        <a href="{{$nextPageUrl}}"> Next <i class="fa fa-long-arrow-right"></i>  </a>
                    </li>
                    @endif
                </ul>
            </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    </div>
</div>
</div>
<script>
    /* for show menu active */
    $("#quote-main-menu").addClass("active");
	$('#quote-main-menu' ).click();
	$('#quote-menu-arrow').addClass('open')
	$('#catalog-history-view-menu').addClass('active');
    /* end menu active */
    
    $(document).on("click", "#deleteButton", function () {
        var id = $(this).data('id');
        jQuery('#deleteConfirmation .modal-body #objectId').val( id );
    });

    jQuery('#deleteConfirmation .modal-footer button').on('click', function (e) {
        var $target = $(e.target); // Clicked button element
        $(this).closest('.modal').on('hidden.bs.modal', function () {
            if($target[0].id == 'confirmDelete'){
                $( "#DELETE_FORM_" + jQuery('#deleteConfirmation .modal-body #objectId').val() ).submit();
            }
        });
    });
</script>
@endsection
