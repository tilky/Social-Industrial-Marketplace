@extends('home.app')
@section('content')
<script src="{{URL::asset('metronic/plugins/jquery.min.js')}}" type="text/javascript"></script>
<div class="modal fade steps-modals" id="tell-us-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content  text-center">
            <h3>Thanks for signing up with IndyJohn.</h3>
            @if(count($errors) > 0)
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;
                </button>
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
            <h5>Based on your previous selection, you have access to:</h5>
            <form id="registration-form" class="form-horizontal" role="form" method="POST" action="{{url('auth/register')}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="dasboard_type" id="dasboard_type" value="buyer" />
            <input type="hidden" name="user_type"  />
            <div class="content">
                <div class="col-md-6">
                    <a href="javascript:void(0)" onclick="selectDasboadType('buyer')"><img src="{{URL::asset('website/images/Indy-John/buyer-dashboard.png')}}" alt="" class="center-block"></a>
                    <h3 class="text-uppercase">BUYER DASHBOARD</h3>
                    <p>Recieve Supplier Quotes,List products on the Marketplace Refer and Earn Money.</p>
                </div>
                <div class="col-md-6">
                    <a href="javascript:void(0)" onclick="selectDasboadType('supplier')"><img src="{{URL::asset('website/images/Indy-John/supplier-crm.png')}}" alt="" class="center-block"></a>
                    <h3 class="text-uppercase">SUPPLIER CRM</h3>
                    <p>Recieve Buyer Leads, List products on Marketplace & Many More</p>
                </div>
                <div class="clearfix"></div>
            </div>

            <button class="btn btn-circle text-uppercase" type="button" onclick="selectDasboadType('wizard');">CREATE YOUR PROFILE</button>
            <button class="btn btn-circle text-uppercase" type="button" onclick="selectDasboadType('postrequest');" >Post a BUY REQUEST</button>
            <a href="javascript:void(0);" onclick="selectDasboadType('skip')" class=" text-uppercase">SKIP</a>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
	$('#tell-us-3').modal({backdrop: 'static', keyboard: false});
});
function selectDasboadType(stringval)
{
    $('#dasboard_type').val(stringval);
    $('#registration-form').submit();
}
</script>
@endsection
