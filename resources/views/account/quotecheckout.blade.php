@extends('buyer.app')
@section('content')

<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i>  </li>
    <li> <a href="{{url('quotetekverification')}}">Indy John User Verification</a> <i class="fa fa-circle"></i>  </li>
    <li> <span>Get your profile verified!</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
  <div class="col-md-12 border2x_bottom">
    <h3 class="page-title uppercase"> <i class="fa fa-plus color-black"></i>  Indy John User Verification </h3>
  </div>
</div>
<div class="row">
<div class="col-md-12"> @if($errors->any())
  <div class="alert alert-danger"> @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach </div>
  @endif
  
  @if (Session::has('message'))
  <div id="" class="custom-alerts alert alert-success fade in">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    </div>
  @endif
  <div class="portlet light ">
    <div class="portlet-body">
      <div class="tabbable-line">
        <ul class="nav nav-tabs">
          <li class="active" id="first_tab"> <a class="color-black" href="#tab_1_1" data-toggle="tab" aria-expanded="false">
            <h4 class="bold uppercase"> About</h4>
            </a> </li>
            
          <li class="" id="third_tab"> <a class="color-black" href="#tab_1_3" data-toggle="tab" aria-expanded="true">
            <h4 class="bold uppercase"> Quote Checkout Requirements </h4>
            </a> </li>
 <li class="" id="second_tab"> <a class="color-black" href="#tab_1_2" data-toggle="tab" aria-expanded="true">
            <h4 class="bold uppercase"> Status</h4>
            </a> </li>

        </ul>
        <div class="tab-content" style="padding:0px !important;"> 
          <!-- Current Users -->
          <div class="tab-pane fade active in" id="tab_1_1">
            <section class="about-content">
             
             
                
                  <div class="row">
                    <div class="col-md-8 col-sm-8">
                      <h3 class="block bold font-red-mint align-left"><span style="font-size: 22px!important;">Legitimize your account and gain trust from our users.</h3>
                      <p class="caption-helper">Working professionals work hard and value their time. <br>Our core marketplace is free. Becoming a verified user is completely optional.<br> However, we do encourage all of our users to establish their account and become verified in order to make full use of our services. <b>This is one way to ensure you're doing a trustworthy business deal</b>. <br /><br />You can allow buyers to complete transaction and pay for the quote you have sent on Indy John through Stripe.  <br>
                      </p>
                    <!--  <h3 class="block bold font-red-mint align-left"><span style="font-size: 22px!important;">Gain trust, leave worry behind.</h3>
                      
                      * Changing companies? Moving e-mail addresses? You will have to re-apply to receive verification status. 
                      <p>-->
                      <div class="form-actions right padding-top align-right"><p>
                <!-- <a type="submit" class="btn btn-circle danger color-black bold button-next" id="tab_1" href="#tab_1_2" data-toggle="tab" aria-expanded="true"> Check Status <i class="fa fa-angle-right"></i>  </a>
               <a type="submit" class="btn btn-circle yellow-crusta color-black bold button-next" id="tab_2" href="#tab_1_3" data-toggle="tab" aria-expanded="true"> Apply For Verification <i class="fa fa-angle-right"></i>  </a>-->
                
              </div>
              </div>
              
                    <div class="col-md-4 col-sm-4 hidden-xs"> <img src="{{url('livesite/images/9.jpg')}}" height="350" class="center-block img-responsive"> </div>
                  </div>
                
              
            </section>
           
          </div>
          <!-- Pending Connections -->
          
          <div class="tab-pane fade" id="tab_1_2">
         
              <div class="form-actions right padding-top align-right">
                <a type="submit" class="btn btn-circle yellow-crusta color-black bold button-next" id="tab_3" href="#tab_1_3" data-toggle="tab" aria-expanded="true"> Apply for Verification <i class="fa fa-angle-right"></i>  </a>
              </div>
          </div>
          <div class="tab-pane fade" id="tab_1_3">
         
            <h3 class="block bold font-red-mint align-left"><span style="font-size: 22px!important;">Quote Checkout Requirements:</span></h3>
             <!--<div class="form-actions right padding-top align-right">-->
               
             <!--<a href="/account/quotecheckout"><img src="{{URL::asset('images/stripe-blue-on-light.png')}}" height="40px" width="180px"/> </a>-->
             
            <!--<h3 class="block bold align-left"><span style="font-size: 22px!important;">Thank you for your interest in becoming an Indy John verified user.</span></h3>
            <p class="caption-helper">Please be advised there is a $50 Non-Refundable Application Processing fee. <br />
            <span style="font-size: 15px!important;"> * Verification is Free with a Valued Account purchase. Click on <strong>Upgrade </strong> to Learn More</span><br /> <br />
            
            Before you begin, please ensure that your profile is completed to the best of your knowledge, as you won't be able to modify the following personal information until after we complete this account verification. </p>-->

              {!! Form::open(array('url' => 'account/quotecheckout')) !!}

             
                <div class="form-group">
                  <h3 class="block bold align-left">User Payment is simple.<span style="font-red-mint"></span></h3>
                  
                </div>

<div class="form-group">
<table>
<tr>
<td><h3 class="block bold align-left"><span style="font-red-mint"> Enter your payment:</span></h3></td>

<td><input type="text" name="txt_payment"/></td>
</tr>
<tr>
<td><h3 class="block bold align-left"><span style="font-red-mint">Connect:</span></h3></td>
<td>
    
    <button type="submit" name="submit"><img src="{{URL::asset('images/stripe-blue-on-light.png')}}"" height="40px" width="200px" ></button>
  </td>
  <td>
    (@if(isset($message))
                    {{ $message}}
                    @endif
                  @if(isset($message1))
                  
                  {{$message1}}
                   @endif)
    
  </td>

</tr>
                
                </table>
                
                  
            {!! Form::close() !!}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
<div class="modal fade footer-modal" id="user_verification_done" role="basic" aria-hidden="false" data-width="760">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body"> <b>your profile has been verified by Indy John. If you change any of these details, your account will loose it's verified status and will need to reverify.</b> </div>
      <div class="modal-footer"> <a href="{{url('change/verification')}}/{{Auth::user()->id}}" class="btn btn-circle yellow-crusta color-black btn-outline" >Yes</a> <a href="{{url('user-dashboard')}}" class="btn btn-danger btn-outline" >No</a> </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 
<script>

/* for show menu active */

$("#account-main-menu").addClass("active");

$('#account-main-menu' ).click();

$('#account-menu-arrow').addClass('open');

$('#quotetek-user-verification-menu').addClass('active');

/* end menu active */

var user_verification = "{{Auth::user()->quotetek_verify}}";
if(user_verification == 1)
{
    jQuery('#user_verification_done').modal({
        backdrop: 'static',
        keyboard: false
    }); 
}

$("#tab_1").click(function(){
    $(".nav li#first_tab").removeClass("active");
    $(".nav li#second_tab").addClass("active");
});
$("#tab_2").click(function(){
    $(".nav li#first_tab").removeClass("active");
    $(".nav li#third_tab").addClass("active");
});
$("#tab_3").click(function(){
    $(".nav li#second_tab").removeClass("active");
    $(".nav li#third_tab").addClass("active");
});


$(function() {
    $("#userVerification").on("submit", function(event) {
        event.preventDefault();
        var formObj = $(this);
        var formURL =  "{{url('quotetek/user/vrification/save')}}";
        var formData = new FormData(this);

        $.ajax({
            url: formURL,
            type: "post",
            data: formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: function(d) {
                $('#payment_method').modal('show');
            }
        });
    });
});

function updatePlan(id,user_type)
{
    if(user_type == 'seller')
    {
        $('#modal-type').val('seller');
    }
    else
    {
        $('#modal-type').val('buyer');
    }

    $('#package_id').val(id);




}
</script> 
@endsection