@extends('buyer.app')



@section('content')

<style>

.select2-container{display: block!important;}

</style>

<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<div class="page-bar">

    <ul class="page-breadcrumb">

        <li>

            <a href="{{url()}}/user-dashboard">Home</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            <a href="{{url('referrals')}}">Referrals</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            <span>Your Referral Tools</span>

        </li>

    </ul>

</div>

<div class="col-md-12 main_box">

<div class="row">

<div class="col-md-12 border2x_bottom">

<div class="col-md-9 col-sm-9">

<div class="row">

<h3 class="page-title uppercase"> 

<i class="fa fa-link"></i> Your Referral Tools 

</h3>

</div>

</div>

<div class="col-md-3 col-sm-3 text-right">

<div class="row">

 @if($link_count == 0)

                <div class="actions margin-top-10">

                    <a href="{{ URL::to('add/referral-link')}}/{{$user_id}}" class="btn btn-circle btn-sm">

                        <i class="fa fa-plus"></i> Generate Link </a>

                </div>

                @endif

</div>

</div>

</div>

</div>

<div class="row">

    <div class="col-md-12">

    

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

                <div class="row">

                    <div class="col-md-12">

                        <div class="col-md-12 padding-top paddin-bottom">

                        @if($link_count == 0)

                            No Referral Link available. Please Generate it using above button.

                        @else

                            <h3 class="block bold font-red-mint align-left">Start referring users to Indy John.</h3>

                            <h4 class="block bold align-left">You can refer them by word of mouth, sharing your Referral URL, or invite them via e-mail</span></h3>

                            <h3 class="font-red-mint align-left">Your Referral Code is: <b>{{$referralLink->referral_code}}</b></h3>

                             <h4 class="block bold align-left">Tell your friends and colleagues to use this code during sign-up. </h4>

                            <h3 class="font-red-mint align-left">Your Referral URL is: <b>{{url('')}}?referral={{$referralLink->referral_code}}</b></h3>

                             <h4 class="block bold align-left">Invite your contacts in G-Mail, Yahoo Mail or Hotmail. <a href="javascript:;" id="invite-user-referrel">Visit the Invite Center.</a></h4>



                            <p>Unhappy with your Referral code? You can request a custom referral code one time only.</p>

                            <p><b>Reminder:</b> Your existing referral code will become invalid. </p>

                            <p>Your Current Referral Code:  <b>{{$referralLink->referral_code}}</b> 

                                <a href="javascript:void(0);" id="edit-ref-link" class="btn-icon-only red">

                                    <i class="fa fa-edit"></i> Edit my Referral Code

                                </a> </p>

                            

                

                            

                            <div id="edit-link" style="display: none;">

                                <!-- BEGIN FORM-->

                                <form method="post" action="{{url('edit/referral-link/save')}}" class="horizontal-form form-horizontal">

                                    <div class="form-body">

                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
<div class="col-md-12">
                                        <div class="form-group">

                                            {{url('')}}?referral=<input class="form-controle" type="text" value="{{$referralLink->referral_code}}" name="referral_link" />

                                            <button type="submit" class="btn btn-circle yellow-crusta color-black bold btn-sm">

                                                <i class="fa fa-check"></i> Save</button>

                                            <a href="javascript:void(0);" id="close-link-edit" class="btn btn-danger bold btn-sm">Close </a>

                                        </div>
                                        </div>

                                    </div>

                                </form>

                            </div>

                            

                        @endif

                        </div>

                    </div>

                </div>

                

            </div>

    </div>

</div>

<script>

/* for show menu active */

$("#referrals-main-menu").addClass("active");

$('#referrals-main-menu' ).click();

$('#referrals-menu-arrow').addClass('open')

$('#referral-link-menu').addClass('active');

/* end menu active */

$('#edit-ref-link').click(function () {

   $('#edit-link').show(); 

});

$('#close-link-edit').click(function () {

   $('#edit-link').hide(); 

});

$('#invite-user-referrel').click(function(){

    jQuery('#basic').modal('show');    

});

</script>



@endsection

