@extends('home.app')
@section('content')
<script src="{{URL::asset('metronic/plugins/jquery.min.js')}}" type="text/javascript"></script>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
    

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{URL::asset('metronic/scripts/app.min.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    
    <script src="{{URL::asset('metronic/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery-multi-select/js/jquery.multi-select.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<style>
.select2-results{color: #383333!important;}
.select2-container{display: block!important;}
.select2-container .select2-selection--single{height: 35px!important;line-height: 35px!important;color: #383333!important;}
.select2-search__field{color: #383333!important;}
.select2-container--default .select2-selection--single .select2-selection__rendered{color: #383333!important;font-size: 13px!important;}
.select2-selection__rendered{height: 35px!important;line-height: 35px!important;}
.select2-selection__arrow{top: 5px!important;}
</style>
<div class="modal fade steps-modals" id="tell-us" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content text-uppercase text-center">
            <h3>tell us about yourself</h3>
            <h5>so that we can prepare your account</h5>
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
            <h4>YOUR MAIN INDUSTRY</h4>
            <form class="" role="form" method="POST" action="{{url('singup/step-two/save')}}">
             <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <select name="main_industry" class="form-control selectIndustry" id="indutries-dropdown">
                    <option value="">Please Select Industry</option>
                    @foreach($industries as $industry)
                        @if(Request::old('main_industry') == $industry->id)
                            <option value="{{$industry->id}}" selected="">{{$industry->name}}</option>
                        @else
                            <option value="{{$industry->id}}">{{$industry->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <h4>SET YOUR PASSWORD</h4>
            <div class="form-inline ">
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" name="password" id="reg-password" placeholder="enter password" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" name="password_confirmation" id="reg-password-confirmation" placeholder="REPEAT PASSWORD" required>
                </div>
                <div class="clearfix"></div>
            </div>
            <button class="btn" type="submit">continue</button>
            </form>
        </div>
    </div>
</div>
<script>
var placeholder = "Select one or more Industries.";
    $(".selectIndustry").select2({
        placeholder: placeholder,
        width: null
    });
$(document).ready(function() {
	$('#tell-us').modal({backdrop: 'static', keyboard: false});
});

</script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
