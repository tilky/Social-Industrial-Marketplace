@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Package Details</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
    <div class="row">
        <div class="col-md-12 border2x_bottom">
            <h3 class="page-title uppercase">
                <i class="fa fa-server color-black"></i>  My Subscriptions
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 margin-top-10">
            <!-- responsive -->
            <div id="responsivedelete" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-content">
                    <div class="modal-body" id="modal-body"> Modal body goes here </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-circle dark btn-outline" data-dismiss="modal">Close</button>
                        <a href="" id="modal-link" class="btn btn-circle green">Confirm</a>
                    </div>
                </div>
            </div>
            <!-- responsive -->
            <div id="responsive" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            </div>
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet-body" id="blockui_sample_1_portlet_body">
                @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="tabbable-line">
                    <ul class="nav nav-tabs">
                        <li>
                            <a class="color-black" href="{{url('user/packages')}}"><h4 class="bold uppercase"> Buyer Dashboard</h4></a>
                        </li>
                        <li class="active">
                            <a class="color-black" href="{{url('user/packages/supplier')}}"><h4 class="bold uppercase"> Supplier CRM</h4></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab_1_1">
                        </div>
                        <div class="tab-pane fade active in" id="tab_1_2">
                            @if(!empty($activeSupplierPackage))
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Package Name</th>
                                    <th> Billed On</th>
                                    <th> Period End</th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$activeSupplierPackage->name}}</td>
                                    <td>{{$activeSupplierPackage->subscription_start}}</td>
                                    <td>{{$activeSupplierPackage->subscription_end}}</td>
                                    <td>{{$activeSupplierPackage->status}}</td>
                                    <td>
                                        <a href="{{url('user/payment-invoice')}}/{{$activeSupplierPackage->payment_id}}" class="btn btn-circle btn-success btn-sm">
                                            View/Print Invoice</a>
                                        @if($activeSupplierPackage->is_canceled == 0)
                                        <a href="{{url('user/packages/unsubscribe')}}/{{$activeSupplierPackage->id}}" class="btn btn-circle btn-success btn-sm">
                                            Cancel </a>
                                        @endif
                                    </td>
                                </tr>
                                @if($total > 0)
                                @foreach($packages as $package)
                                <tr>
                                    <td>{{$package->name}}</td>
                                    <td>{{$package->subscription_start}}</td>
                                    <td>{{$package->subscription_end}}</td>
                                    <td>{{$package->status}}</td>
                                    <td>
                                        <a href="{{url('user/payment-invoice')}}/{{$package->payment_id}}" class="btn btn-circle btn-success btn-sm">
                                            View/Print Invoice</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                            <ul class="pager">
                                @if($previousPageUrl != '')
                                <li class="previous">
                                    <a href="{{$previousPageUrl}}"> <i class="fa fa-arrow-left"></i>  Prev </a>
                                </li>
                                @endif
                                @if($nextPageUrl != '')
                                <li class="next">
                                    <a href="{{$nextPageUrl}}"> Next <i class="fa fa-arrow-right"></i>  </a>
                                </li>
                                @endif
                            </ul>
                            @else
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Package Name</th>
                                    <th> Billed On</th>
                                    <th> Period End</th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($packages as $package)
                                <tr>
                                    <td>{{$package->name}}</td>
                                    <td>{{$package->subscription_start}}</td>
                                    <td>{{$package->subscription_end}}</td>
                                    <td>{{$package->status}}</td>
                                    <td>
                                        <a href="{{url('user/payment-invoice')}}/{{$package->payment_id}}" class="btn btn-circle btn-success btn-sm">
                                            View/Print Invoice</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <ul class="pager">
                                @if($previousPageUrl != '')
                                <li class="previous">
                                    <a href="{{$previousPageUrl}}"> <i class="fa fa-arrow-left"></i>  Prev </a>
                                </li>
                                @endif
                                @if($nextPageUrl != '')
                                <li class="next">
                                    <a href="{{$nextPageUrl}}"> Next <i class="fa fa-arrow-right"></i>  </a>
                                </li>
                                @endif
                            </ul>
                            @endif
                            @if(empty($activeSupplierPackage))
                            <p>You have not subscribed to any Valued Accounts yet. Click on the Upgrade button in the top to learn more about our account upgrades. </p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
<script>
    /* for show menu active */
    $("#account-main-menu").addClass("active");
    $('#account-main-menu' ).click();
    $('#account-menu-arrow').addClass('open');
    $('#account-package-menu').addClass('active');
    /* end menu active */
    function showPackageDetail(id)
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
    function deleteSubcription(id)
    {
        $('#modal-body').html('Are you sure you want to cancel subscription?');
        $("#modal-link").attr("href", id)
        $('#responsivedelete').modal('show');
    }
</script>
@endsection
