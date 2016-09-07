@extends('home.app')
@section('content')
<script src="{{URL::asset('metronic/plugins/jquery.min.js')}}" type="text/javascript"></script>
<div class="modal fade steps-modals" id="tell-us-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content text-uppercase text-center">
            <h3>TELL US ABOUT YOURSELF</h3>
            <h5>SELECT ALL THAT APPLY.</h5>
            <form class="" role="form" method="POST" action="{{url('singup/step-three/save')}}">
             <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-circle btn-primary active">
                    <input type="radio" name="user_type" value="2" autocomplete="off" checked> I'M A BUYER LOOKING TO FIND NEW SUPPLIERS
                </label>
                <label class="btn btn-circle btn-primary">
                    <input type="radio" name="user_type" value="3" autocomplete="off"> I'M A SUPPLIER LOOKING TO GET MORE LEADS
                </label>
                <label class="btn btn-circle btn-primary">
                    <input type="radio" name="user_type" value="3" autocomplete="off"> I'M LOOKING TO LIST PRODUCTS ON MARKETPLACE
                </label>
                <label class="btn btn-circle btn-primary">
                    <input type="radio" name="user_type" value="3" autocomplete="off"> I'M A STUDENT LOOKING TO NETWORK
                </label>
                <label class="btn btn-circle btn-primary">
                    <input type="radio" name="user_type" value="3" autocomplete="off"> I'M LOOKING TO EARN MONEY USING REFERRALS.
                </label>
                <label class="btn btn-circle btn-primary">
                    <input type="radio" name="user_type" value="3" autocomplete="off"> I'M A NOT SURE, LOOKING TO EXPLORE.
                </label>
            </div>
            <button class="btn" type="submit">Finish</button>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
	$('#tell-us-2').modal({backdrop: 'static', keyboard: false});
});

</script>
@endsection
