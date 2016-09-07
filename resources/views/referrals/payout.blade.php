@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('sa')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Referral Payout</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-envelope"></i>  Referral Payout </div>
            </div>
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
                    <div class="col-md-12">
                        @if($total > 0)
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="search-result-table">
                            <thead>
                                <tr>
                                    <th>Referral By</th>
                                    <th>Email</th>
                                    <th>Referral To</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Period Ending Date</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($referralPayments as $referralPayment)
                                <tr>
                                    <td>{{$referralPayment->referral_user->UserDetail->first_name}} {{$referralPayment->referral_user->UserDetail->last_name}}</td>
                                    <td>{{$referralPayment->referral_user->email}}</td>
                                    <td>{{$referralPayment->referral_user_to->first_name}} {{$referralPayment->referral_user_to->last_name}}</td>
                                    <td>{{$referralPayment->sunscription->name}}</td>
                                    <td>${{number_format($referralPayment->amount,2,'.',',')}}</td>
                                    <td>{{$referralPayment->endPeriod}}</td>
                                    <td>@if($referralPayment->payment_clear == 1) Cleared @else Not Paid @endif</td>
                                    <td>
                                        @if($referralPayment->payment_clear != 1)
                                        <a href="{{url('referral-payout/send')}}/{{$referralPayment->id}}?pedingInvite=1" class="btn btn-circle btn-success btn-sm">
                                            <i class="fa fa-money"></i>  Pay</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <p>
                                No Referral Payout Available
                            </p>
                        @endif
                    </div>
                </div>
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
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
/* for show menu active */
$("#referral-payout-main-menu").addClass("active");
/* end menu active */
    
</script>
@endsection
