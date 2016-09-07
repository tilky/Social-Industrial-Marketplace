@extends('buyer.app')
@section('content')
<style>
.select2-container{display: block!important;}

</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Vendor libraries -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>

<!-- If you're using Stripe for payments -->
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Dashboard</a>
        </li>
        
    </ul>
</div>
<div class="row">
    <div class="portlet light bordered" id="form_wizard_1">
        <div  class="portlet-body form">
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
            <div class="form-wizard">
                
                    
                    
                    <form method="post" action="{{url('user/testmail/send')}}" role="form" id="payment-form"  class="form-horizontal form-row-seperated">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-body">
                            <div class="form-group">
                               <div class="col-md-6">
                                    <label class="control-label">E-Mail</label>
                                    <input type="email" class="form-control" name="email" >
                               </div> 
                            </div>
                        </div>
                        <div class="form-actions right padding-top align-right">
                            
                            
                            <button type="submit" class="subscribe btn btn-circle blue"> Submit
                                <i class="fa fa-angle-right"></i>
                            </button>
                            
                        </div>
                    </form>
                
            </div>
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

</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
