@extends('buyer.app')
@section('content')

<style>
.profile .btn.active, .profile .btn:hover {
    background-color: #FFF000 !important;
    color: #000 !important;
    border-color: transparent;
    border: 0px;
    box-shadow: none;
    border-radius: 0px;
    padding: 20px 7px;
}
.profile .btn btn-circle {
    margin: 10px 10px;
    float: none;
    background-color: #eee !important;
    font-size: 12px;
    word-break: break-word;
    min-height: 100px;
    width: 45%;
    word-wrap: break-word;
    color: #525252 !important;
    padding: 20px 7px;
    white-space: inherit;
    border: 0px;
    display: inline-block;
}

.profile div.radio, .profile div.radio span, .profile div.radio input{width: 0px!important;}
</style>
<div class="row">
    <div class="col-md-12">
        <h3 class="align-center">HOW DO YOU WANT TO START USING INDY JOHN?</h3>
        
        <div class="col-md-12 align-center">
        <form class="" role="form" method="POST" action="{{url('profile/select-dashboard/save')}}">
             <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="btn-group profile" data-toggle="buttons">
                <label class="btn btn-circle btn-primary btn-group invite-contact-sec-div active" id="pulsate-one">
                    <input type="radio" name="user_type" value="2" autocomplete="off" checked=""> I'M A BUYER LOOKING TO FIND NEW SUPPLIERS
                </label>
                <label class="btn btn-circle btn-primary" id="pulsate-two">
                    <input type="radio" name="user_type" value="2" autocomplete="off"> I'M LOOKING FOR A SERVICE PROVIDER
                </label>
                <label class="btn btn-circle btn-primary" id="pulsate-three">
                    <input type="radio" name="user_type" value="3" autocomplete="off"> I'M LOOKING TO LIST PRODUCTS ON THE MARKET
                </label>
                <label class="btn btn-circle btn-primary" id="pulsate-four">
                    <input type="radio" name="user_type" value="3" autocomplete="off"> I'M A SUPPLIER LOOKING TO GET MORE LEADS
                </label>
                <label class="btn btn-circle btn-primary" id="pulsate-five">
                    <input type="radio" name="user_type" value="3" autocomplete="off"> I'M A SERVICE PROVIDER LOOKING FOR CUSTOMERS
                </label>
                <label class="btn btn-circle btn-primary" id="pulsate-six">
                    <input type="radio" name="user_type" value="2" autocomplete="off"> I'M A STUDENT LOOKING TO NETWORK
                </label>
                <label class="btn btn-circle btn-primary" id="pulsate-seven">
                    <input type="radio" name="user_type" value="2" autocomplete="off"> I'M LOOKING TO EARN MONEY USING REFERRALS
                </label>
                <label class="btn btn-circle btn-primary" id="pulsate-eight">
                    <input type="radio" name="user_type" value="2" autocomplete="off"> I'M A NOT SURE, LOOKING TO EXPLORE
                </label>
            </div>
            <button class="btn btn-circle yellow-crusta color-black bold" type="submit"> Finish </button>
            </form>
        </div>
        
    </div>
</div>
<script>

$(document).ready(function() {

    $("#pulsate-one").click(function(){
       $(".pulsate-one-target").pulsate({
          color: '#1BBC9B', // set the color of the pulse
          reach: 20,                              // how far the pulse goes in px
          speed: 1000,                            // how long one pulse takes in ms
          pause: 0,                               // how long the pause between pulses is in ms
          glow: true,                             // if the glow should be shown too
          repeat: 5,                           // will repeat forever if true, if given a number will repeat for that many times
          onHover: false                          // if true only pulsate if user hovers over the element
        });
    });
    
    $("#pulsate-two").click(function(){
       $(".pulsate-two-target").pulsate({
          color: '#1BBC9B', // set the color of the pulse
          reach: 20,                              // how far the pulse goes in px
          speed: 1000,                            // how long one pulse takes in ms
          pause: 0,                               // how long the pause between pulses is in ms
          glow: true,                             // if the glow should be shown too
          repeat: 5,                           // will repeat forever if true, if given a number will repeat for that many times
          onHover: false                          // if true only pulsate if user hovers over the element
        });
    });
    
    
    $("#pulsate-three").click(function(){
       $(".pulsate-three-target").pulsate({
          color: '#1BBC9B', // set the color of the pulse
          reach: 20,                              // how far the pulse goes in px
          speed: 1000,                            // how long one pulse takes in ms
          pause: 0,                               // how long the pause between pulses is in ms
          glow: true,                             // if the glow should be shown too
          repeat: 5,                           // will repeat forever if true, if given a number will repeat for that many times
          onHover: false                          // if true only pulsate if user hovers over the element
        });
    });
    
    $("#pulsate-four").click(function(){
       $(".pulsate-four-target").pulsate({
          color: '#1BBC9B', // set the color of the pulse
          reach: 20,                              // how far the pulse goes in px
          speed: 1000,                            // how long one pulse takes in ms
          pause: 0,                               // how long the pause between pulses is in ms
          glow: true,                             // if the glow should be shown too
          repeat: 5,                           // will repeat forever if true, if given a number will repeat for that many times
          onHover: false                          // if true only pulsate if user hovers over the element
        });
    });
    
    $("#pulsate-five").click(function(){
       $(".pulsate-five-target").pulsate({
          color: '#1BBC9B', // set the color of the pulse
          reach: 20,                              // how far the pulse goes in px
          speed: 1000,                            // how long one pulse takes in ms
          pause: 0,                               // how long the pause between pulses is in ms
          glow: true,                             // if the glow should be shown too
          repeat: 5,                           // will repeat forever if true, if given a number will repeat for that many times
          onHover: false                          // if true only pulsate if user hovers over the element
        });
    });
    
    $("#pulsate-six").click(function(){
       $(".pulsate-six-target").pulsate({
          color: '#1BBC9B', // set the color of the pulse
          reach: 20,                              // how far the pulse goes in px
          speed: 1000,                            // how long one pulse takes in ms
          pause: 0,                               // how long the pause between pulses is in ms
          glow: true,                             // if the glow should be shown too
          repeat: 5,                           // will repeat forever if true, if given a number will repeat for that many times
          onHover: false                          // if true only pulsate if user hovers over the element
        });
    });
    
    $("#pulsate-seven").click(function(){
       $(".pulsate-seven-target").pulsate({
          color: '#1BBC9B', // set the color of the pulse
          reach: 20,                              // how far the pulse goes in px
          speed: 1000,                            // how long one pulse takes in ms
          pause: 0,                               // how long the pause between pulses is in ms
          glow: true,                             // if the glow should be shown too
          repeat: 5,                           // will repeat forever if true, if given a number will repeat for that many times
          onHover: false                          // if true only pulsate if user hovers over the element
        });
    });
    
    $("#pulsate-eight").click(function(){
       $(".pulsate-eight-target").pulsate({
          color: '#1BBC9B', // set the color of the pulse
          reach: 20,                              // how far the pulse goes in px
          speed: 1000,                            // how long one pulse takes in ms
          pause: 0,                               // how long the pause between pulses is in ms
          glow: true,                             // if the glow should be shown too
          repeat: 5,                           // will repeat forever if true, if given a number will repeat for that many times
          onHover: false                          // if true only pulsate if user hovers over the element
        });
    });
		
 });


</script>
<script src="{{URL::asset('metronic/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-bootpag/jquery.bootpag.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/holder.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/pages/scripts/ui-general.min.js')}}" type="text/javascript"></script>
@endsection
