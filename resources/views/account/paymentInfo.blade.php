@extends('buyer.app')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Payment Information</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-credit-card color-black"></i>  Payment Information
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
                                    <th>Card Type</th>
                                    <th>Card Last 4 digits</th>
                                    <th>Expiration Date</th>
                                    <th>Amount</th>
                                    <th>Payment At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentDetails as $paymentDetail)
                                <tr>
                                    <td>{{$paymentDetail->payment_type}}</td>
                                    <td>**** **** **** {{$paymentDetail->card_last_4}}</td>
                                    <td>{{$paymentDetail->expiry}}</td>
                                    <td>{{$paymentDetail->amount}}</td>
                                    <td>{{$paymentDetail->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <p>No Payment Information Available</p>
                        @endif
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
$('#account-payment-info-menu').addClass('active');
/* end menu active */
    
</script>
@endsection
