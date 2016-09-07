@extends('home.app')

@section('content')
<div class="step-3">
    <div class="logo-header">
        <a href="{{url('')}}"><img src="{{URL::asset('frontend/images/Indy-John/Logo.png')}}" class="center-block" alt="logo" width="290"></a>
    </div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <form class="form-horizontal" role="form" method="POST" action="{{url('auth/register')}}" enctype="multipart/form-data">
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
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <input type="radio" name="user_type" value="2" checked="" style="width: 30px;" />
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    I'm Looking for Quotes and Suppliers.</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="col-md-12"> Text Here</div>
                    <!--<div class="col-md-12"><a  href="javascript:void(0);" id="user_2" onclick="setUserType(id);" style="color: #fff;">Click Here</a></div>--> 
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <input type="radio" name="user_type" value="2" style="width: 30px;" /> 
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    I'm looking to list and shop on the marketplace.</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <div class="col-md-12">Text Here</div>
                    <!--<div class="col-md-12"><a  href="javascript:void(0);" id="user_2" onclick="setUserType(id);" style="color: #fff;">Click Here</a></div>--> 
                </div>
            </div>
        </div>
    
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <input type="radio" name="user_type" value="3" style="width: 30px;" />
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    I'm a Supplier Looking to Get Leads.</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <div class="col-md-12"> Text Here</div>
                    <!--<div class="col-md-12"><a  href="javascript:void(0);" id="user_3" onclick="setUserType(id);" style="color: #fff;">Click Here</a></div>--> 
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingForth">
                <h4 class="panel-title">
                    <input type="radio" name="user_type" value="4" style="width: 30px;" />
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseForth" aria-expanded="false" aria-controls="collapseForth">
                    I'm a Company Representative looking to bring my team to IndyJohn</a>
                </h4>
            </div>
            <div id="collapseForth" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingForth">
                <div class="panel-body">
                    <div class="col-md-12"> Text Here</div>
                    <!--<div class="col-md-12"><a  href="javascript:void(0);" id="user_4" onclick="setUserType(id);" style="color: #fff;">Click Here</a></div>--> 
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading5">
                <h4 class="panel-title">
                    <input type="radio" name="user_type" value="2" style="width: 30px;" />
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                    I'm Here to Casually Shop / Not Sure yet.</a>
                </h4>
            </div>
            <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                <div class="panel-body">
                    <div class="col-md-12"> Text Here</div>
                    <!--<div class="col-md-12"><a  href="javascript:void(0);" id="user_2" onclick="setUserType(id);" style="color: #fff;">Click Here</a></div>--> 
                </div>
            </div>
        </div>
        <div class="text-left" style="padding-left: 40px;">
            <div class="form-group">
               <button class="btn btn-circle " type="submit">Finish</button>
            </div>
        </div>
    </form>
    </div>
</div>


<div class="clearfix"></div>
<script>
$( "#main-body" ).addClass( "simple-page" );
function setUserType(id){
    
    var allIds = id.split('_');
    var orig_id = allIds[0];
    var divId = allIds[1];
       
}
</script>
@include('home.footerlinks')
@endsection
