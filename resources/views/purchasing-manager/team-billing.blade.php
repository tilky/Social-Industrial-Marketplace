@extends('buyer.app')

@section('content')
<style>
    .select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
        <li> <a href="{{url('referrals')}}">About Team Supplying</a> <i class="fa fa-circle"></i> </li>
        <li> <span>Team Billing</span> </li>
    </ul>
</div>
<div class="col-md-12 main_box">
    <div class="row">
        <div class="col-md-12 border2x_bottom" id="form_wizard_1">
            <div class="col-md-9 col-sm-9">
                <div class="row">
                    <h3 class="page-title uppercase"> <i class="fa fa-exchange color-black"> </i> TEAM BILLING </h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="row">
                    <div class="actions margin-top-15">
                        <select name="team_name" id="teamId" class="form-control" onchange="ApplyFilter();">
                            <option value="">Select Team </option>
                            @foreach($buyuerTeams as $team)
                            @if($team->id == $teamId)
                            <option selected value="{{$team->id}}">{{$team->name}}</option>
                            @else
                            <option value="{{$team->id}}">{{$team->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
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

                <div class="col-md-12">

                    <h3>Selected Team Current Subscriptions: </h3>

                    <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                        <thead>
                        <tr>
                            <th> Person Name</th>
                            <th> Account Type</th>
                            <th> Billed On</th>
                            <th> Period End</th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activeUserArray as $active)
                        <tr>
                            <td>{{$active['personName']}}</td>
                            <td>{{$active['accountType']}}</td>
                            <td>{{$active['billedOn']}}</td>
                            <td>{{$active['periodEnd']}}</td>
                            <td>Active</td>
                            <td>
                                <a href="{{url('user/payment-invoice')}}/{{$active['paymentId']}}" class="btn btn-circle btn-success btn-sm">
                                    View/Print Last Invoice</a>
                                @if($active['isCanceled'] == 0)
                                <a href="{{url('user/packages/unsubscribe')}}/{{$active['id']}}" class="btn btn-circle btn-success btn-sm">
                                    Cancel Subscription</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <h3>Create a New Subscription:</h3>
                    <p>Use this interface to create billing subscriptions and pay for your team members.</p>

                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                        <tr>
                            <th> Member Name </th>
                            <th> Account Status </th>
                            <th> Paid Account Expires on </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($inActiveUserArray as $no_subscription)
                        <tr>
                            <td>{{$no_subscription['personName']}}</td>
                            <td>{{$no_subscription['accountType']}}</td>
                            <td>N/A</td>
                            <td>
                                <button id="create_subscription_{{$no_subscription['user_id']}}" type="button" onclick="openBuyerAccountModalDialog(this)" href="#" class="btn btn-circle btn-success btn-sm">
                                    Create Subscription</button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <h3>View Recent Transactions:</h3>

                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                        <tr>
                            <th> Name </th>
                            <th> Account </th>
                            <th> Billed On</th>
                            <th> Period End</th>
                            <th> Completed </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($completedArray as $completed)
                        <tr>
                            <td>{{$completed['personName']}}</td>
                            <td>{{$completed['accountType']}}</td>
                            <td>{{$completed['billedOn']}}</td>
                            <td>{{$completed['periodEnd']}}</td>
                            <td>Completed</td>
                            <td>
                                <a href="{{url('user/payment-invoice')}}/{{$completed['paymentId']}}" class="btn btn-circle btn-success btn-sm">
                                    View/Print Invoice</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <p>
    </div>
</div>

<script>
    $("#team-manager-purchasing").addClass("active");
    $('#team-manager-purchasing-menu-arrow').addClass('open');
    $('#purchasing-team-billing').addClass('active');

    function ApplyFilter()
    {
        var team_id = $('#teamId').val();

        var redirect_url = '{{url("purchasing-team-billing")}}?team_id='+team_id;

        window.location.href = redirect_url;
    }

    function openBuyerAccountModalDialog(button){
        var user_id = button.id.replace('create_subscription_','');
        $('#team_member_id').val(user_id);
        jQuery('#create_buyer_subscription_team').modal({
            backdrop: 'static',
            keyboard: false
        });
        return false;
    }
</script>
@endsection
