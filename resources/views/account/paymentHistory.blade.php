@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Payment History</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-money color-black"></i>  Payment History
</h3>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet-body">
                @if (Session::has('error_message'))
                    <div class="alert alert-danger" role="alert">
                        {!! Session::get('error_message') !!}
                    </div>
                @endif
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                
                <div class="row">
                    <div class="col-md-12 margin-top-10">
                        @if($total > 0)
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="search-result-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Transaction Details</th>
                                    <th>Amount</th>
                                  
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentDetails as $paymentDetail)
                                <tr>
                                    <td><b>{{$paymentDetail->created_at}}</b></td>
                                    <td><b>{{$paymentDetail->detail}} ( For {{$paymentDetail->user->userdetail->first_name}} {{$paymentDetail->user->userdetail->last_name}} [ {{$paymentDetail->user->unique_number}} ] )</b><br> Paid by: {{$paymentDetail->payment_type}}, Last 4 digits: {{$paymentDetail->card_last_4}} , Card Expiring on: {{$paymentDetail->expiry}}</td>
                                    <td><b>{{number_format($paymentDetail->amount,2)}}</b></td>
                                   
                                    <td><a href="{{url('user/payment-invoice')}}/{{$paymentDetail->id}}" class="btn btn-danger"><i class="fa fa-view">View</i>  </a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <p>No Payment History Available</p>
                        @endif
                    </div>
                </div>
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
$('#account-payment-history-menu').addClass('active');
/* end menu active */
    
</script>
@endsection
