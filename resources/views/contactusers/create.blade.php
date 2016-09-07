@extends('buyer.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/socicon/socicon.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url()}}/contactusers">Contact List</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add Contact</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-plus color-black"></i>Add Contact</div>
                <div class="actions">
                    <a href="{{ URL::to('contact/add') }}" class="btn btn-circle btn-danger btn-sm">
                        <i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>

            <div class="portlet-body form">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="col-md-12 padding-top"><p class="caption-helper">Add new Contacts to your Indy John account.</p></div>
                <!-- BEGIN FORM-->
                <form method="post" action="{{url('contactusers/search/contact')}}" class="form-horizontal form-row-seperated" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="{{$userData->user_id}}" />
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <input data-required="1" type="text" name="search" value="{{$search}}" class="form-control" placeholder="Search Contact">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-circle blue">
                                        <i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
                
                @if($search != '')
                <div class="row">
                    <div class="col-md-12">
                    <h3 class="col-md-12 control-label">Result for Search: "{{$search}}"</h3>
                @if(!empty($searchContac))
                
                    <div class="col-md-12 border-bottom">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="search-result-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($searchContac as $contact)
                                <tr>
                                    <td>{{$contact['req_user_name']}}</td>
                                    <td>{{$contact['req_user_company_name']}}</td>
                                    <td>{{$contact['req_user_city']}}</td>
                                    <td>{{$contact['req_user_country']}}</td>
                                    <td class="no-sort">
                                        @if($contact['common_req'] == 1)
                                            <a href="{{url('contactusers/contact/approve')}}/{{$contact['id']}}" class="btn btn-circle blue ">
                                                <i class="fa fa-thumbs-o-up"></i> Approve Request </a>
                                            <a id="deleteButton" data-id="{{$contact['id']}}" data-toggle="modal" href="#deleteConfirmation" class="btn btn-circle btn-danger btn-sm">

                                                {!! Form::open([
                                                'method' => 'DELETE',
                                                'id' => 'DELETE_FORM_'.$contact['id'],
                                                'route' => ['contactusers.destroy', $contact['id']]
                                                ]) !!}
                                                {!! Form::close() !!}
                                                    <i class="fa fa-remove"></i> Delete </a>
                                        @else
                                        <a href="{{url('contactusers/contact/send')}}/{{$userData->user_id}}/{{$contact['req_user_id']}}" class="btn btn-circle btn-success btn-sm">
                                            <i class="fa fa-paper-plane"></i> Send Request </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="col-md-12">No result found</p>
                @endif
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h3>Import Social Contact</h3>
                        </div>
                        <div class="col-md-12 border-bottom">
                            <div class="socicons">
                                <a href="{{$googleImportUrl}}" class="socicon-btn btn-circle socicon- btn-circle  socicon-lg socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white socicon-google tooltips" data-original-title="Google" aria-describedby="tooltip244795"></a>
                                <a href="{{$msnImportUrl}}" class="socicon-btn btn-circle socicon- btn-circle  socicon-lg socicon-solid bg-blue bg-hover-grey-salsa font-white bg-hover-white socicon-windows tooltips" data-original-title="Windows" aria-describedby="tooltip994463"></a>
                                <a href="{{$yahooImportUrl}}" class="socicon-btn btn-circle socicon- btn-circle  socicon-lg socicon-solid bg-green bg-hover-grey-salsa font-white bg-hover-white socicon-yahoo tooltips" data-original-title="Yahoo" aria-describedby="tooltip146269"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h3>Add New Coctact</h3>
                        </div>
                        <form method="post" action="{{url('contact/add/save')}}" class="horizontal-form form-horizontal">
                            <input type="hidden" name="user_id" value="{{$userData->user_id}}" />
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-12">Name:</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name" class="form-control" value="{{Request::old('name')}}" placeholder="Invite Name"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Email:</label>
                                    <div class="col-md-12">
                                        <input type="email" name="email" class="form-control" value="{{Request::old('email')}}" placeholder="Invite email"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Phone:</label>
                                    <div class="col-md-12">
                                        <input type="text" name="phone" class="form-control" value="{{Request::old('phone')}}" placeholder="Phone"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Company:</label>
                                    <div class="col-md-12">
                                        <input type="text" name="company" class="form-control" value="{{Request::old('company')}}" placeholder="Company Name"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <a href="{{ URL::to('contactusers') }}" class="btn btn-circle btn-sm">
                                    Cancel </a>
                                <button type="submit" class="btn btn-circle blue">
                                    <i class="fa fa-check"></i> Send</button>
                            </div>
                            
                            </form>
                            <!-- END FORM-->  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    /* for show menu active */
    $("#contact-list-main-menu").addClass("active");
	$('#contact-list-main-menu' ).click();
	$('#contact-list-menu-arrow').addClass('open')
	$('#contact-list-create-menu').addClass('active');
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
