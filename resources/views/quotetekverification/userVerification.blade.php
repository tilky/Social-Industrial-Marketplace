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
    {{ Session::get('message') }}</div>
  @endif
  <div class="portlet light ">
    <div class="portlet-body">
      <div class="tabbable-line">
        <ul class="nav nav-tabs">
          <li class="active" id="first_tab"> <a class="color-black" href="#tab_1_1" data-toggle="tab" aria-expanded="false">
            <h4 class="bold uppercase"> About</h4>
            </a> </li>
         
          <li class="" id="third_tab"> <a class="color-black" href="#tab_1_3" data-toggle="tab" aria-expanded="true">
            <h4 class="bold uppercase"> Verification Application </h4>
            </a> </li>
 <li class="" id="second_tab"> <a class="color-black" href="#tab_1_2" data-toggle="tab" aria-expanded="true">
            <h4 class="bold uppercase"> Verification Status</h4>
            </a> </li>

        </ul>
        <div class="tab-content" style="padding:0px !important;"> 
          <!-- Current Users -->
          <div class="tab-pane fade active in" id="tab_1_1">
            <section class="about-content">
             
             
                
                  <div class="row">
                    <div class="col-md-8 col-sm-8">
                      <h3 class="block bold font-red-mint align-left"><span style="font-size: 22px!important;">Legitimize your account and gain trust from our users.</h3>
                      <p class="caption-helper">Working professionals work hard and value their time. <br>Our core marketplace is free. Becoming a verified user is completely optional.<br> However, we do encourage all of our users to establish their account and become verified in order to make full use of our services. <b>This is one way to ensure you're doing a trustworthy business deal</b>. <br /><br />Upon completion, a verified seal will be attached to your account and displayed when you connect with other users. <br>
                      </p>
                      <h3 class="block bold font-red-mint align-left"><span style="font-size: 22px!important;">Gain trust, leave worry behind.</h3>
                      
                      * Changing companies? Moving e-mail addresses? You will have to re-apply to receive verification status. 
                      <p>
                      <div class="form-actions right padding-top align-right"><p>
                <a type="submit" class="btn btn-circle danger color-black bold button-next" id="tab_1" href="#tab_1_2" data-toggle="tab" aria-expanded="true"> Check Status <i class="fa fa-angle-right"></i>  </a>
                <a type="submit" class="btn btn-circle yellow-crusta color-black bold button-next" id="tab_2" href="#tab_1_3" data-toggle="tab" aria-expanded="true"> Apply For Verification <i class="fa fa-angle-right"></i>  </a>
                
              </div>
              </div>
              
                    <div class="col-md-4 col-sm-4 hidden-xs"> <img src="{{url('livesite/images/9.jpg')}}" height="350" class="center-block img-responsive"> </div>
                  </div>
                
              
            </section>
           
          </div>
          <!-- Pending Connections -->
          
          <div class="tab-pane fade" id="tab_1_2">
            <h3 class="block bold font-red-mint align-left"><span style="font-size: 22px!important;">Account Verification Status: 
              @if(Auth::user()->quotetek_verify == 1)
              Verified
              @else
              Not Verified
            @endif </span></h3>
            <p class="caption-helper">Application Status: 
              @if($status == 1)
              Approved
              @elseif($status == 2)
              Rejected
              @elseif($status == 3)
              Pending
              @else
              Not Submitted
              @endif </p>
            <p class="caption-helper">Submission Date: 
              @if($subnitedDate != '')
              {{$subnitedDate}}
              @else
              Not Applicable
              @endif </p>
              
              <div class="form-actions right padding-top align-right">
                <a type="submit" class="btn btn-circle yellow-crusta color-black bold button-next" id="tab_3" href="#tab_1_3" data-toggle="tab" aria-expanded="true"> Apply for Verification <i class="fa fa-angle-right"></i>  </a>
              </div>
          </div>
          <div class="tab-pane fade" id="tab_1_3">
            <h3 class="block bold font-red-mint align-left"><span style="font-size: 22px!important;">Verification Application:</span></h3>
            <h3 class="block bold align-left"><span style="font-size: 22px!important;">Thank you for your interest in becoming an Indy John verified user.</span></h3>
            <p class="caption-helper">Please be advised there is a $50 Non-Refundable Application Processing fee. <br />
            <span style="font-size: 15px!important;"> * Verification is Free with a Valued Account purchase. Click on <strong>Upgrade </strong> to Learn More</span><br /> <br />
            
            Before you begin, please ensure that your profile is completed to the best of your knowledge, as you won't be able to modify the following personal information until after we complete this account verification. </p>

              {!! Form::open([
              'class' => 'horizontal-form form-horizontal form-row-seperated',
              'id' => 'userVerification',
              'enctype' => 'multipart/form-data',
              'method'=>'POST',
              'files' => true
              ]) !!}

              <input type="hidden" name="_token" value="{{csrf_token()}}" />
              <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}" />
              <div class="form-body padding-15">
                <p class="caption-helper">
                <div class="form-group">
                  <div class="col-md-6 paddin-npt padding-right-15">
                    <label class="control-label">First Name:</label>
                    <input type="text" name="first_name" id="first_name" value="{{$user->userdetail->first_name}}" class="form-control" placeholder="Enter your first name">
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">Last Name</label>
                    <input type="text" name="last_name" id="last_name"" value="{{$user->userdetail->last_name}}" class="form-control" placeholder="Enter your last name">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12 paddin-npt padding-right-15">
                    <label class="control-label">Alias Name:</label>
                    <input type="text" class="form-control" name="alias_name" id="alias_name" placeholder="Enter Any Aliases" value="{{$user->userdetail->alias_name}}"  >
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12 paddin-npt">
                    <label class="control-label">Account E-mail Address:</label>
                    <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control" placeholder="Account E-mail Address" @if($user->
                    quotetek_verify == 0) readonly @endif /> </div>
                </div>
                <div class="form-group">
                  <h3 class="block bold align-left">User verification is simple.<span style="font-red-mint"> Upload and Submit the following requirements:</span></h3>
                  <div class="col-md-12 paddin-npt padding-right-15">
                    <label class="control-label"><b>Upload a recent utility bill showing your name and address:</b></label>
                    <div id="proof-file-1" class="col-md-12 paddin-npt fileinput fileinput-new" data-provides="fileinput">
                      <div class="input-group input-large">
                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput"> <i class="fa fa-file fileinput-exists"></i>  &nbsp; <span class="fileinput-filename">Upload a recent utility bill </span> </div>
                        <span class="input-group-addon btn btn-danger btn-file"> <span class="fileinput-new"> Select file </span> <span class="fileinput-exists"> Change </span>
                        <input type="file" id="utility_bill" data-required="1" name="utility_bill" >
                        </span> <a href="javascript:;" class="input-group btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12 paddin-npt padding-right-15">
                    <label class="control-label"><b>Upload a State issued Photo ID:</b></label>
                    <div id="proof-file-1" class="col-md-12 paddin-npt fileinput fileinput-new" data-provides="fileinput">
                      <div class="input-group input-large">
                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput"> <i class="fa fa-file fileinput-exists"></i>  &nbsp; <span class="fileinput-filename"><b>Upload a State issued Photo ID</b> </span> </div>
                        <span class="input-group-addon btn btn-danger  btn-file"> <span class="fileinput-new"> Select file </span> <span class="fileinput-exists"> Change </span>
                        <input type="file" data-required="1" name="state_issued_photo_id" id="state_issued_photo_id">
                        </span> <a href="javascript:;" class="input-group btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a> </div>
                    </div>
                  </div>
                </div>
                <!--
                <div class="form-group">
                  <div class="col-md-12 paddin-npt">
                    <label class="control-label padding-right"><b>Option 3: Verify your Linkedin Profile:</b></label>
                    <p> @if($linkedin_verify == 0) <a href="https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id={{$client_id}}&redirect_uri={{$redirect_uri}}&state=ab234aatdssda" class="btn btn-danger"><i class="fa fa-check"> Click here to Verify your LinkedIn Profile</i>  </a> @else <b>LinkedIn Account Verified</b> @endif
                      <input type="hidden" value="{{$linkedin_verify}}" name="linkedin_verify" />
                  </div>
                </div>
              </div>
              -->
              <div class="form-actions right padding-top align-right">
                <button type="submit" class="btn btn-circle yellow-crusta color-black bold button-next"> Submit and Proceed to Payment <i class="fa fa-angle-right"></i>  </button>
              </div>
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
