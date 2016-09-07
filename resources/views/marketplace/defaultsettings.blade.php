@extends('buyer.app')

@section('content')
<style>
.select2-container{display: block!important;}
.form-body{padding: 20px 10px!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('marketplaceproducts')}}">Marketplace Products</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Set Default Options</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-gift color-black"></i>Set Default Options</div>
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
                <div class="col-md-12 padding-top">
                    <p class="caption-helper">Set the default settings for all your following Product Listings.</p>
                    <p>Indy John does not handle order management and payments at this time. We're working on it... Meanwhile, you can add the following optional details to your listing.</p>
                </div>
                <!-- BEGIN FORM-->
                <form method="post" action="{{url('marketplaceproducts/product/defaultsettings/save')}}" class="horizontal-form form-horizontal">
                    <div class="form-body">
                        <input type="hidden" name="user_id" class="form-control" value="{{$user_id}}" >
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="block align-left" style="margin-top: 0px!important;"><span style="font-size: 19px!important;">Shipping & Returns</h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Return Policy</label>
                            <div class="col-md-12">
                                <textarea name="return_policy" placeholder="Enter your return policy" class="form-control" cols="3">{{$default->return_policy}}</textarea>
                                <!--<span class="help-block">Enter your return policy.</span>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Specific Payment Terms </label>
                            <div class="col-md-12">
                                <input type="text" name="payment_terms" value="{{$default->payment_terms}}" class="form-control" placeholder="Enter your Specific Payment Terms. For example 'Net 30, Due on Delivery'">
                                <!--<span class="help-block">Enter your Specific Payment Terms. For example "Net 30, Due on Delivery</span>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Payment forms accepted</label>
                            <div class="col-md-2">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('Credit Cards',$default->payment_accepted)) checked="checked" @endif class="form-control checkbox" value="Credit Cards" /> Credit Cards
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('Bank Transfer',$default->payment_accepted)) checked="checked" @endif class="form-control checkbox" value="Bank Transfer" /> Bank Transfer
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('Online Payments/Paypal',$default->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Online Payments/Paypal" /> Online Payments/Paypal
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('Cheque',$default->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Cheque" /> Cheque
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('COD',$default->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="COD" /> COD
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="payment_accepted[]" @if(in_array('Other',$default->payment_accepted)) checked="checked" @endif  class="form-control checkbox" value="Other" /> Other
                            </div>
                            <span class="help-block col-md-12">Select acceptable Payment options.</span>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Shipping terms</label>
                            <div class="col-md-12">
                                <textarea name="shipping_terms" class="form-control" placeholder="Enter any Shipping Information applicable">{{$default->shipping_terms}}</textarea>
                                <!--<span>Enter any Shipping Information applicable.</span>-->
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a href="{{ URL::to('marketplaceproducts') }}" class="btn btn-circle btn-sm">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle blue">
                            <i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
                <!-- END FORM-->
                
            </div>
        </div>
    </div>
</div>
<script>
    /* for show menu active */
    $("#marketplace-main-menu").addClass("active");
	$('#marketplace-main-menu' ).click();
	$('#marketplace-menu-arrow').addClass('open')
	$('#marketplace-default-settings-menu').addClass('active');
    /* end menu active */
    
    $( document ).ready(function() {
        $('#free_shipping_continents').multiSelect();
    });
</script>
@endsection
