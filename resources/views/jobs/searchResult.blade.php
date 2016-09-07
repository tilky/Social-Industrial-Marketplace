@extends('buyer.app')



@section('content')

<link href="{{URL::asset('metronic/plugins/socicon/socicon.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />

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

            <span>Search Jobs</span>

        </li>

    </ul>

</div>



<div class="row">

    <div class="col-md-12">

                @if (Session::has('message'))

                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>

                @endif
                @if($search != '')

                <div class="row">

                    <div class="col-md-12">

                        <form method="post" action="{{url('jobs/search/list')}}" class="form-horizontal form-row-seperated searchbarresult" enctype="multipart/form-data">

                

                        <input type="hidden" name="user_id" value="{{$user->id}}" />

                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        

                        <div id="custom-search-input searchbar">

                            <div class="input-group col-md-12">

                                <input type="text" class="  search-query form-control" name="search" value="{{$search}}" placeholder="Search Product Names or Category Types" />

                                <span class="input-group-btn" style="float: left;">

                                    <button  class="btn btn-circle btn-default" type="submit">

                                        Search

                                    </button>

                                </span>

                            </div>

                        </div>

                        

                        </form>

                    <h4 class="col-md-12 paddin-npt control-label padding-top">Search results for: "{{$search}} - searched"</h4>

                        <div class="col-md-12 paddin-npt">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                                <tr>
                                    <th> Job Title </th>
                                    <th> Status </th>
                                    <th> Posted on </th>
                                    <th> Expires on </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($jobs as $job)
                            <tr class="odd gradeX">
                                <td>{{$job->title}}</td>
                                <td>
                                    @if($job->status == 1)
                                        Active
                                    @else
                                        Disabled 
                                    @endif
                                </td>
                                <td>
                                    {{date('M d, Y',strtotime($job->created_at))}}
                                </td>
                                <td>
                                    {{date('M d, Y',strtotime($job->expiry_date))}}
                                </td>
                                
        
                                <td>
                                    <a href="{{url('job/user/save')}}/{{$job->id}}/{{$user->id}}" class="btn btn-danger btn-sm"><i class="fa fa-check"></i> Save</a>
                                    <a href="{{url('job/user/apply')}}/{{$job->id}}/{{$user->id}}" class="btn btn-danger btn-sm"><i class="fa fa-check"></i> Apply</a>
                                    <a href="{{url('job/view')}}/{{$job->id}}" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-eye"></i> View</a>
                                </td>
        
                            </tr>
        
                            @endforeach
        
                            </tbody>
        
                        </table>
                        
                        </div>

                    </div>

                </div>

                @endif

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

</div>

<script>

    /* for show menu active */

    $("#marketplace-main-menu").addClass("active");

	$('#marketplace-main-menu' ).click();

	$('#marketplace-menu-arrow').addClass('open')

	$('#marketplace-product-search-menu').addClass('active');

    /* end menu active */

    $(document).ready(function() {

        $('#search-result-table').DataTable({

            columnDefs: [

              { targets: 'no-sort', orderable: false }

            ]

        });

    });

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

<script src="{{URL::asset('metronic/scripts/datatable.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>

@endsection

