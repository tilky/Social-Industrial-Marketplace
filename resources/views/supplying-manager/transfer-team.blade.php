@extends('supplier.app')

@section('content')
<style>
.select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <a href="{{url('referrals')}}">About Supplying Teams</a> <i class="fa fa-circle"></i> </li>
    <li> <span>About Team Transfer</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
    <div class="row">
        <div class="col-md-12 border2x_bottom">
            <h3 class="page-title uppercase"> <i class="fa fa-group color-black"></i> Transfer Team</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet-body form">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  {{ Session::get('message') }}
                </div>
                @endif

                <!-- BEGIN FORM-->
                {!! Form::open(['url'=>'transferManagerForSupplier','class'=>'horizontal-form form-horizontal','method'=>'POST']) !!}
                <div class="col-md-12">
                    <h3>Transfer Team Management to another Indy John user account.</h3>
                    <p>Please note, this step is not reversible, please ensure your details are accurate. </p>
                    <div class="form-group">
                        <label class="col-md-12 paddin-npt">Select Your Team:</label>
                        <div class="col-md-12 paddin-npt">
                            <select name="team_id" class="form-control">
                                <option value="">Select Team</option>
                                @foreach($supplierTeam as $team)
                                <option value="{{ $team->id }}" >{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12 paddin-npt">Appoint New Manager:</label>
                        <div class="col-md-12 paddin-npt">
                            <select id="select2-button-addons-single-input-group-sm" name="manager_id" class="form-control col-md-12 js-data-connection-ajax" >
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-circle yellow-crusta margin-top-10"> <i class="fa fa-check"></i> Initiate Transfer</button>
                    <h3>Team Transfer Status:</h3>

                     <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                          <thead>
                          <tr>
                              <th> Team Name </th>
                              <th> Date Initiated</th>
                              <th> Status</th>
                              <th> Actions</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($supplierTeamTransfer as $transfer)
                          <tr>
                              <td>{{$transfer->team_name}}</td>
                              <td>{{$transfer->initiated_date}}</td>
                              <td>@if($transfer->status == 0)Pending Authorization from New Manager @else Accepted @endif</td>
                              <td>
                                  <div class="btn-group"> <a class="btn btn-circle yellow-crusta" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                      <ul class="dropdown-menu pull-right">
                                         <li><a href="#" target="_blank"><i class="fa fa-eye"></i> Resend Transfer Verification E-mail</a></li>
                                         <li><a href="#" onclick=""><i class="fa fa-edit"></i> Cancel Transfer</a></li>
                                      </ul>
                                  </div>
                              </td>
                          </tr>
                          @endforeach
                          </tbody>
                     </table>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script>
    $("#team-manager-supplying").addClass("active");
    $('#team-manager-supplying-menu-arrow').addClass('open');
    $('#transfer-supplying-team').addClass('active');

    jQuery(document).ready(function(){
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
                url: "{{url('conatct/usersearch')}}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
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
    });
</script> 
@endsection 
