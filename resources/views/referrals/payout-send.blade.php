@extends('buyer.app')

@section('content')

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('sa')}}">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url('referral-payout')}}">Referral Payout</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Send Payment</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-plus color-black"></i>  Send Payment</div>
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
                <!-- BEGIN FORM-->
                <form method="post" action="{{url('referral-payout/save')}}" class="horizontal-form form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="payment_id" value="{{$referralPayment->id}}" />
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-12">Pay to: {{$referralPayment->referral_user->UserDetail->first_name}} {{$referralPayment->referral_user->UserDetail->last_name}}</label>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Amount Pay:</label>
                            <div class="col-md-12">
                                <input type="text" name="amount" class="form-control" value="{{$referralPayment->amount}}" placeholder="Amount Pay">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right padding-top align-right" >
                        <a href="{{url('referral-payout')}}" class="btn btn-circle default button-previous">
                            <i class="fa fa-angle-left"></i>  Back </a>
                        <button type="submit" class="btn btn-circle blue button-next"> Pay
                            <i class="fa fa-check"></i>  
                        </button>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
/* for show menu active */
$("#referral-payout-main-menu").addClass("active");
/* end menu active */
    
</script>
@endsection
