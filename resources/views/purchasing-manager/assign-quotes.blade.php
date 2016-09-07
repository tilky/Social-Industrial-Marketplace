@extends('buyer.app')

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
    <li> <span>Assign Quotes</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
   <div class="row">
       <!-- BEGIN FORM-->
       {!! Form::open(['url'=>'saveQuotes','class'=>'horizontal-form form-horizontal','method'=>'POST','files' => true]) !!}
       <div class="col-md-12 border2x_bottom" id="form_wizard_1">
          <div class="col-md-9 col-sm-9">
            <div class="row">
                <h3 class="page-title uppercase"> <i class="fa fa-exchange color-black"> </i> Assign Quotes</h3>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
              <div class="row">
                  <div class="actions margin-top-15">
                      <select name="team_name" id="teamId" class="form-control" onchange="ApplyFilter();">
                          <option>Select Team </option>
                          @foreach($buyerTeam as $Team)
                          @if($teamId == $Team->id)
                          <option selected value="{{ $Team->id }}">{{$Team->name}}</option>
                          @else
                          <option value="{{ $Team->id }}">{{$Team->name}}</option>
                          @endif
                          @endforeach
                      </select>
                  </div>
              </div>
          </div>
       </div>
       <div class="col-md-9 paddin-npt">
            <p class="caption-helper">Select and Assign Quotes to your Team Member(s):</p>
       </div>
       <p />

       <div class="form-group">
            <div class="col-md-6 paddin-npt padding-right">
                <label class="col-md-12 paddin-npt">Select Quote:</label>
                <div class="col-md-12 paddin-npt">
                    <select name="quote" class="form-control selectMainRequest" id="main-request-dropdown" required="">
                        @foreach($quotes as $quote)
                        <option value="{{$quote->id}}">{{ $quote->supplierUser->first_name}} {{ $quote->supplierUser->last_name}} - ${{ $quote->price}}</option>
                        @endforeach
                    </select>
                    <span class="help-block margin-top">Select the Quote that you want to assign.</span>
                </div>
            </div>
            <div class="col-md-6 paddin-npt">
                <label class="col-md-12 paddin-npt">Select Team Member(s):</label>
                <div class="col-md-12 paddin-npt">
                    <select id="select2-button-addons-single-input-group-sm" name="recipients[]" class="form-control col-md-12 js-data-connection-ajax"  multiple>
                    </select>
                    <span class="help-block margin-top">Type and select the team members you want to assign this Quote to.</span>
                </div>
            </div>
       </div>

        <div class="col-md-6 paddin-npt right">
            <button type="submit" class="btn btn-circle yellow-crusta"> <i class="fa fa-check"></i>Assign Quote</button>
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
                            <p class="caption-helper">Recently Assigned Quote:</p>
                        </div>
                        <div class="col-md-12 paddin-npt">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                    <tr>
                                      <th> Quote Received From </th>
                                      <th> Buy Request Name</th>
                                      <th> Received On</th>
                                      <th> Assigned On</th>
                                      <th>Assigned To</th>
                                      <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($buyerQuotesArray as $buyerQuotes)
                                <tr>
                                    <td>{{$buyerQuotes['quote_received_from']}}</td>
                                    <td>{{$buyerQuotes['buy_request_name']}}</td>
                                    <td>{{date('d-m-Y',strtotime($buyerQuotes['created_on']))}}</td>
                                    <td><a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">{{date('d-m-Y',strtotime($buyerQuotes['assigned_on']))}}</a></td>
                                    <td><a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">{{$buyerQuotes['assigned_to']}}</a></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="{{url('supplier-quotes')}}/{{$buyerQuotes['quote_id']}}"><i class="fa fa-eye"></i> View Quote</a></li>
                                                <li class="divider"> </li>
                                                <li><a href="{{url('request-product-quotes')}}/{{$buyerQuotes['buy_request_id']}}"><i class="fa fa-eye"></i> View Buy Request</a></li>
                                                <li class="divider"> </li>
                                                <li><a href="#contact_seller" id="{{$buyerQuotes['supplier_id']}}" onclick='setSupplierReceiver(id)' data-toggle="modal" data-target="#contact_seller" ><i class="fa fa-file-o"></i>Message Supplier</a></li>
                                                <li class="divider"> </li>
                                                <li><a href="#contact_seller" id="{{$buyerQuotes['assigned_to_id']}}" onclick='setReceiver(id)' data-toggle="modal" data-target="#contact_seller"><i class="fa fa-file-text-o"></i> Message Team Member</a> </li>
                                                <li class="divider"> </li>
                                                <li> <a href="{{url('dismiss-quote-assignment')}}/{{$buyerQuotes['assigned_id']}}" ><i class="fa fa-pencil-remove"></i> Dismiss Assignment</a> </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a href="{{url('view-assigned-quotes')}}" class="btn btn-circle btn-danger"> <i class="fa fa-check"></i> View All Assigned Quotes</a>
                            <p />
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
       {!! Form::close() !!}
   </div>
</div>

<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>
<script>
    $("#team-manager-purchasing").addClass("active");
    $('#team-manager-purchasing-menu-arrow').addClass('open');
    $("#team-manager-supplying").addClass("active");
    $('#team-manager-supplying-menu-arrow').addClass('open');
    $('#manager-assign-quotes').addClass('active');


    function ApplyFilter()
    {
        var team_id = $('#teamId').val();

        var redirect_url = '{{url("manager-assign-quotes")}}?team_id='+team_id;

        window.location.href = redirect_url;
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
            url: "{{url()}}/teamUsers/search",
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

    function setReceiver(id){
        $('#message_receiver').val(id);
        $('#message_box_title').html('SEND MESSAGE TO TEAM MEMBER');
        $('#contactTeamMember').show();
        $('#contactSeller').hide();
    }

    function setSupplierReceiver(){
        $('#message_receiver').val(id);
        $('#message_box_title').html('SEND MESSAGE TO SUPPLIER');
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

</script>
@endsection 
