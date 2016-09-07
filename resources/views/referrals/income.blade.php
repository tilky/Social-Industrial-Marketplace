@extends('buyer.app')

@section('content')
<style>
.media-body{width: 180px!important;}
.invoice-content-2{padding: 40px 0px!important;}
</style>
<link href="{{URL::asset('metronic/pages/css/invoice-2.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('referrals')}}">Referrals</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>View Referral Payouts</span>
        </li>
    </ul>
</div>

<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-file-text-o"></i> View Referral Payouts
</h3>
</div>
</div>
<div class="row">
    <div class="col-md-12">
    <div class="col-md-12">
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="invoice-content-2 bordered margin-top-30">
            <div class="row invoice-body">
                @if(count($referralPayments) > 0)
                <div class="col-xs-12 table-responsive">
                    
                    <table class="table table-striped table-bordered text-center table-hover table-checkable order-column" id="sample_1">
                        <thead>
                        <tr>
                            <th style="text-align:center !important;">Period Ending Date</th>
                            <th class="text-center">Subscription Name</th>
                            <th class="text-center">Total Generated</th>
                            <th class="text-center">Payment Made on</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($referralPayments as $referralPayment)
                            <tr>
                                <td style="text-align:center !important;">{{date('m/d/Y',strtotime($referralPayment->endPeriod))}}</td>
                                <td>{{$referralPayment->sunscription->name}}</td>
                                <td>${{number_format($referralPayment->amount,'2','.',',')}}</td>
                                <td>
                                    @if($referralPayment->referralPayout)
                                        @if($referralPayment->referralPayout->status != 1)
                                            Not Paid
                                        @else
                                            {{date('m/d/Y',strtotime($referralPayment->referralPayout->created_at))}}
                                        @endif
                                    @else
                                        Not Paid
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
                <div class="invoice-cust-add">
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
                <div class="invoice-subtotal">
                    <div class="col-xs-4">
                        <h4 class="text-center">Total Referral Generated: <b> ${{number_format($referral_total,'2','.',',')}}</b></h4>
                    </div>
                    <div class="col-xs-4">
                        <h4 class="text-center">Total Referral Pay-out: <b> ${{number_format($total_payout,'2','.',',')}}</b></h4>
                    </div>
                    <div class="col-xs-4">
                        <h4 class="text-center">Total Referral Pending: <b> ${{number_format($total_pending,'2','.',',')}}</b></h4>
                    </div>
                    <!--<div class="col-xs-2">
                        <h2 class="invoice-title uppercase">Total Referral Generated</h2>
                        <p class="invoice-desc grand-total">Total Referral Generated: {{number_format($referral_total,'2','.',',')}}$</p>
                    </div>-->
                </div>
                @else
                <div class="col-xs-12"> <div class="col-xs-12">  No Referral Payouts have been paid yet. </div></div>
    @endif
  
            </div>
            
        </div>
        <!-- END PAGE BASE CONTENT -->
        <h4 class="margin-top-20">Please allow up to 45 days for your Referral Payout to post to your account.</h4>
        <p>If you are not receiving Referral Payouts, please check and ensure that your  <a href="{{url('referral/payment-info')}}">Payout Options</a> settings are up to date.</p>
        <div class="padding-top">
            <a href="{{url('supporttickets/create')}}" class="btn btn-circle btn-sm red font-wh text-upper margin-bottom-30"><i class="fa fa-support"></i> Contact Support</a>
        </div>
    </div>
</div>
</div>
</div>
<script>
/* for show menu active */
$("#referrals-main-menu").addClass("active");
$('#referrals-main-menu' ).click();
$('#referrals-menu-arrow').addClass('open');
$('#referral-generated-income-menu').addClass('active');
/* end menu active */
</script>
@endsection
