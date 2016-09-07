@extends('admin.app')

@section('content')
<style>

.mt-element-step .step-line .mt-step-title{font-size: 17px!important;}
.checkbox input[type=checkbox], .checkbox-inline input[type=checkbox], .radio input[type=radio], .radio-inline input[type=radio]{margin-left: -10px!important;}
.form-horizontal .checkbox, .form-horizontal .radio{min-height: 36px;}
div.checker, div.radio{margin-left: 5px!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<!--<link href="{{URL::asset('metronic/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />-->
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url('sa')}}">Home</a>
            <i class="fa fa-circle"></i>
            @else
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
            @endif
        </li>
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url('companies')}}">Companies</a>
            <i class="fa fa-circle"></i>
            @endif
        </li>
        <li>
            <span>Add Company</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom hide_print">
          <h3 class="page-title uppercase"> <i class="fa fa-plus color-black"></i>Set a Company Administrator </h3>
    </div>
  </div>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            
            <div  class="portlet-body form">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif




              
                <div class="mt-element-step">
                <div class="row step-line">
                    <div id="company-first" class="col-md-3 mt-step-col first done">
                        <div class="mt-step-number bg-white"><i class="fa fa-check"></i></div>
                        <div class="mt-step-title uppercase font-grey-cascade">Contact Information</div>
                    </div>
                    <div id="company-forth" class="col-md-3 mt-step-col active">
                        <div class="mt-step-number bg-white">2</div>
                        <div class="mt-step-title uppercase font-grey-cascade">Company Administrator</div>
                    </div>
                    <div id="company-second" class="col-md-3 mt-step-col">
                        <div class="mt-step-number bg-white">3</div>
                        <div class="mt-step-title uppercase font-grey-cascade">Company Information</div>
                    </div>
                    <div id="company-third" class="col-md-3 mt-step-col last">
                        <div class="mt-step-number bg-white">4</div>
                        <div class="mt-step-title uppercase font-grey-cascade">Media Center</div>
                    </div>
                    
                </div>
                </div>
                <div class="yellow-crusta-seprator"></div>
                
                
                <!-- BEGIN FORM-->
                <form action="{{url('company/admin/save')}}" method="post" class="horizontal-form form-horizontal">
                <div class="form-body">
                    
                    <h3 class="font-red-mint margin-bottom-25" >A Company Profile Administrator can:</h3>
                    <ul>
                        <li class="h5"><span class="no-margin"><i style="color:#090" class="fa fa-check-circle"></i> Manage the Company Profile Page.</span></li>
                        <li class="h5"><span class="no-margin"><i style="color:#090"  class="fa fa-check-circle"></i> Approve or Disapprove new user profiles</span></li>

                        
                    </ul>
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" name="company_id" value="{{$company->id}}" />
                    <input type="hidden" name="is_owner" value="0" id="is_owner" />
                    @if(isset($_REQUEST['setup']))
                        <input type="hidden" name="profile_first_time" value="1" />
                    @endif
                    <div class="form-group">


                        <label class="font-red-mint col-md-12"><h3>Will you be the Company Administrator?</h3></label>
  <div class="col-md-12 padding-top">
                    <p class="caption-helper no-margin margin-bottom-25">Are you authorized to be the profile administrator for this company? </p>
                </div>
                        <div class="col-md-12">
                            <!--<input name="company_owner" id="company_owner" value="0"  type="checkbox" data-on-text="Yes" data-off-text="No" class="make-switch form-control" data-size="small">-->
                            <input type="radio" name="company_owner" @if(Request::old('company_owner') == "1") checked="" @endif  value="1" /><b>Yes, I am authorized to be the profile administrator for this company.</b>
                            <div class="col-md-12">
                            <div class="col-md-12">
                            <div class="col-md-12">
                            <div class="col-md-12">
                                <span class="no-margin" style="margin-left:4px !important;">I certify that I represent this company and the details that I have and will provide are accurate.</span>
                            </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <div class="col-md-12">
                            <input type="radio" name="company_owner" @if(Request::old('company_owner') == "0") checked="" @endif value="0" /><b>No, I am not authorized to be the profile administrator for this company.</b>
                      </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">
                        <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="col-md-12">
                         <label class="col-md-12">Enter the email of a potential company profile administrator:</label>
                            <div class="col-md-12">
                                <input type="text" name="admin_email" class="form-control" value="{{Request::old('admin_email')}}" placeholder="Enter the email address here" />
                            <p class="no-margin">*Please note: Your company selection will not appear until company administrator is set. </p>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        
                </div>
                <div id="sub-action-button" class="form-actions right padding-top align-right">
                    @if(isset($_REQUEST['setup']))
                    <a href="{{url('companies')}}/{{$company->id}}/edit?setup=profile" class="btn btn-danger button-next"> <i class="fa fa-angle-left"></i> Go Back</a>
                    @else
                    <a href="{{url('companies')}}/{{$company->id}}/edit" class="btn btn-danger button-next bold"> <i class="fa fa-angle-left"></i> Go Back</a>
                    @endif
                    
                    <button type="submit" class="btn btn-circle yellow-crusta color-black bold"> Continue <i class="fa fa-angle-right"></i></button>
                </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
</div>
<script>
/* for show menu active */
$("#compnay-main-menu").addClass("active");
$('#compnay-main-menu' ).click();
$('#conpmay-menu-arrow').addClass('open');
$("#admin-company-menu").addClass("active");
$('#admin-company-menu' ).click();
$('#transfer-admin-company-menu').addClass('active');
/* end menu active */

$('input[name="company_owner"]').on('switchChange.bootstrapSwitch', function(event, state) {
  //console.log(state); // true | false
  if(state === true)
  {
    $('#admin-yes').show();
    $('#admin-no').hide();
    $('#is_owner').val(1);
  }
  else
  {
    $('#admin-yes').hide();
    $('#admin-no').show();
    $('#is_owner').val(0);
  }
});
   
</script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<!--<script src="{{URL::asset('metronic/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/pages/scripts/ui-extended-modals.min.js')}}" type="text/javascript"></script>-->
@endsection
