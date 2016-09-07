@extends('supplier.app')

@section('content')

<style>
    .bootstrap-tagsinput {
        width: 100% !important;
    }
    .main-lab{font-size: 15px!important;font-weight: bold;}
    .select2-container{display: block!important;}
    .ms-container{width: 90%!important;}
    .blue_circle{ height:100px; width:100px; border-radius:50%; background:#0061FF;}
    @media (min-width: 992px){
        .col-md-2n {
            width: 20%!important;
        }
    }
    .margin-top{margin-top: 5px!important;}
    .form-group{border-bottom: 1px solid #eef1f5!important;}
    .fileinput{margin-bottom: 0px!important;}
    .form-horizontal .form-group{margin-left: 15px!important;margin-right: 15px!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/typeahead/typeahead.css')}}" rel="stylesheet" type="text/css" />

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
        <li> <span>Assign Lead Requests</span> </li>
    </ul>
</div>
<div class="col-md-12 main_box">

    {!! Form::open(['url'=>'saveLeadRequests','class'=>'horizontal-form form-horizontal','method'=>'POST','files' => true]) !!}

    <div class="row">
        <div class="col-md-12 border2x_bottom" id="form_wizard_1">
            <div class="col-md-9 col-sm-9">
                <div class="row">
                    <h3 class="page-title uppercase"> <i class="fa fa-exchange color-black"> </i> Assign Lead Requests </h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="row">
                    <div class="actions margin-top-15">
                        <select name="team_name" id="teamId" class="form-control" onchange="ApplyFilter();">
                            <option value="">Select Team </option>
                            @foreach($supplierTeam as $team)
                                @if($teamId == $team->id)
                                    <option selected value="{{ $team->id }}">{{$team->name}}</option>
                                @else
                                    <option value="{{ $team->id }}">{{$team->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('message'))
    <div id="" class="custom-alerts alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        {{ Session::get('message') }}
    </div>
    @endif

    <div class="col-md-9 paddin-npt">
        <p class="caption-helper">Select and Assign Lead Requests to your Team Member(s):</p>
    </div>

    <div class="form-group">
        <div class="col-md-6 paddin-npt padding-right">
            <label class="col-md-12 paddin-npt">Select Lead Request : </label>
                <div class="col-md-12 paddin-npt">
                    <select name="leadRequest" class="form-control selectMainRequest" id="main-request-dropdown" required="">
                        @foreach($quotes as $quote)
                            <option value="{{$quote['quote_id']}}">{{$quote['fieldLabel']}} - {{$quote['submittedDate']}}</option>
                        @endforeach
                    </select>
                    <span class="help-block margin-top">Select the Lead Request that you want to assign.</span>
                </div>
        </div>
        <div class="col-md-6 paddin-npt">
            <label class="col-md-12 paddin-npt">Select Team Member(s) : </label>
            <div class="col-md-12 paddin-npt">
                <select id="select2-button-addons-single-input-group-sm" name="recipients[]" class="form-control col-md-12 js-data-connection-ajax"  multiple>
                </select>
                <span class="help-block margin-top">Type and select the team members you want to assign this buy request to.</span>
            </div>
        </div>
    </div>
          
    <div class="col-md-6 paddin-npt right">
        <button type="submit" class="btn btn-circle yellow-crusta"> <i class="fa fa-check"></i>Assign Lead Request</button>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="portlet-body">
                <div class="col-md-9 paddin-npt">
                    <p class="caption-helper">Recently Assigned Lead Requests:</p>
                </div>
                <div class="col-md-12 paddin-npt">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr>
                                <th>Lead Request Name</th>
                                <th>Lead Request ID</th>
                                <th>Created On</th>
                                <th>Assigned On</th>
                                <th>Assigned To</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supplierRequestsArray as $leadRequest)
                            <tr>
                                <td>{{ $leadRequest['lead_request_name'] }}</td>
                                <td>{{ $leadRequest['lead_request_id'] }}</td>
                                <td>{{ $leadRequest['created_on'] }}</td>
                                <td><a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">{{ $leadRequest['assigned_on'] }}</a></td>
                                <td><a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">{{ $leadRequest['assigned_to'] }}</a></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li> <a href="{{url('supplier-leads')}}/{{$leadRequest['id']}}/edit" target="_blank"><i class="fa fa-eye"></i> View Lead Request</a></li>
                                            <li><a href="#" ><i class="fa fa-file-o"></i> Leads Received </a></li>
                                            <li> <a href="#contact_seller" id="{{$leadRequest['assigned_to_id']}}" onclick='setReceiver(id)' data-toggle="modal" data-target="#contact_seller" ><i class="fa fa-file-text-o"></i> Message Member(s)</a> </li>
                                            <li class="divider"> </li>
                                            <li> <a href="{{url('cancel-lead-request-assignment')}}/{{$leadRequest['assigned_id']}}" ><i class="fa fa-pencil-remove"></i> Cancel Assignment</a> </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-circle btn-danger"> <i class="fa fa-check"></i> View All Assigned Leads</button>
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
        </div>
    </div>
</div>
    {!! Form::close() !!}
</div>

<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>
<script>
    $("#team-manager-supplying").addClass("active");
    $('#team-manager-supplying-menu-arrow').addClass('open');
    $('#manager-assign-lead-requests').addClass('active');

    function ApplyFilter()
    {
        var team_id = $('#teamId').val();

        var redirect_url = '{{url("manager-assign-lead-requests")}}?team_id='+team_id;

        window.location.href = redirect_url;
    }

    function setReceiver(id){
        $('#message_receiver').val(id);
        $('#message_box_title').html('SEND MESSAGE TO TEAM MEMBER');
        $('#contactTeamMember').show();
        $('#contactSeller').hide();
    }

    function sendTeamMemberMessage(){
        var subject =  document.getElementById('subject').value;
        var body =  document.getElementById('message_body').value;
        var receiver =  document.getElementById('message_receiver').value;
        var baseurl = "{{url('member/message/send')}}";

        $.ajax({
            type : 'POST',
            url : baseurl,
            data:{
                '_token':'{{csrf_token()}}',
                subject : subject,
                body : body,
                receiver_id : receiver
                //reportType : reportType
            },
            success:function(data) {
                $('#contact_seller').modal('hide');
            },
            done: function() {
            },
            error: function() {
            }
        });
    }

    function formatRepo(repo) {
        if (repo.loading) return repo.text;

        var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" + repo.full_name +"</div>";

        markup += "</div></div>";

        return markup;
    }

    function formatRepoSelection(repo) {
        return repo.full_name || repo.text;
    }

    $(".js-data-connection-ajax").select2({
        width: "off",
        ajax: {
            url: "{{url()}}/search/supplierTeamUsers",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                var teamId = $( "#teamId option:selected" ).val();
                return {
                    q: params.term, // search term
                    page: params.page,
                    teamId: teamId
                };
            },

            processResults: function(data, page) {
                // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data
                return {
                    results: data.items
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    jQuery(document).ready(function() {

        var mainIndplaceholder = "Type and select one Lead Request With using Unique Number";
        $(".selectMainRequest").select2({
            placeholder: mainIndplaceholder,
            width: null
        });

    });

</script>

@endsection 
