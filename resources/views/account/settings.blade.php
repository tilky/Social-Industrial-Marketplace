@extends('buyer.app')



@section('content')
<style>

.bootstrap-tagsinput {

  width: 100% !important;

}

.select2-container{display: block!important;}

.ms-container{width: 90%!important;}

.select2-container--default .select2-results__option[aria-selected=true]{display: none!important;}

.form-group{border-bottom: 1px solid #eef1f5!important;}

.fileinput{margin-bottom: 0px!important;}

.form-horizontal .form-group{margin-left: 15px!important;margin-right: 15px!important;}

.checkbox input[type=checkbox], .checkbox-inline input[type=checkbox], .radio input[type=radio], .radio-inline input[type=radio]{margin-left: -10px!important;}

.form-horizontal .checkbox, .form-horizontal .radio{min-height: 36px;}

div.checker, div.radio{margin-left: 5px!important;}
.form-group:nth-of-type(odd) {
    background-color: #fbfcfd;
}
.form-group label { margin:0px !important; text-indent:5px;}
.padding-top-10{ padding-top:10px;}
.padding-bottom-10{ padding-bottom:10px; margin-bottom:0px !important;}
.text_indent{ text-indent:20px !important; font-size: 16px!important; position:relative; top:3px;}
.text_vertical_indent{ position:relative; top:4px;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Account Settings</span> </li>
  </ul>
</div>
<div class="col-md-12 main_box">
  <div class="row">
    <div class="col-md-12 border2x_bottom">
      <h3 class="page-title uppercase"> <i class="fa fa-cogs color-black"></i> Account Settings </h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="portlet-body form"> @if($errors->any())
        <div class="alert alert-danger"> @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
          @endforeach </div>
        @endif
        
        @if (Session::has('message'))
        <div id="" class="custom-alerts alert alert-success fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
          {{ Session::get('message') }}</div>
        @endif
       
          
          <div id="change-password-div" style="display: none;">
            <form action="{{url('reset/password')}}" method="post" class="horizontal-form form-horizontal">
              <div class="form-body">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="user_id" value="{{$user->id}}" />
                <div class="form-group">
                  <div class="col-md-6 paddin-npt padding-right">
                    <label class="col-md-12 paddin-npt">Password:</label>
                    <div class="col-md-12 paddin-npt">
                      <input type="password" required name="password" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6 paddin-npt">
                    <label class="col-md-12 paddin-npt">Confirm Password:</label>
                    <div class="col-md-12 paddin-npt">
                      <input type="password" required name="password_confirmation" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-actions right">
                <button type="submit" class="btn btn-circle yellow-crusta color-black bold"> <i class="fa fa-check"></i> Change Password</button>
              </div>
            </form>
          </div>
        </div>
        
        <!-- BEGIN FORM-->
        
        <form method="post" action="{{url('account/defaultsettings/save')}}" class="horizontal-form form-horizontal">
          <div class="form-body">
            <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}" >
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group padding-top-10 padding-bottom-10 margin-top-10">
          <label  class="col-md-12 paddin-npt"><a href="{{url('user-details')}}"  class="color-black">Edit my Personal Profile</a></label>
          <div class="clearfix"></div>
          </div>
          <div class="form-group padding-top-10 padding-bottom-10">
          <label  class="col-md-12 paddin-npt"><a href="javascript:void(0)" id="change-password-link" class="color-black">Change my Password</a></label>
          <div class="clearfix"></div>
          </div>
            <div class="form-group padding-top-10 padding-bottom-10">
              <label class=" paddin-npt">E-mail Notification Settings</label>
              <div class="clearfix"></div>
            </div>
            
            <div class="form-group padding-top-10 padding-bottom-10">
              <label class="col-md-6 col-sm-6  paddin-npt text_indent">Important Messages from Indy John Team</label>
              <div class="col-md-6 col-sm-6 paddin-npt ">
                <input name="import_message" value="1" type="checkbox" @if($accountsettings->
                import_message == 1) checked @endif class="make-switch form-control" data-size="small" data-on-text="Yes" data-off-text="No"> </div>
            </div>
            <div class="form-group padding-top-10 padding-bottom-10">
              <label class="col-md-6 col-sm-6  paddin-npt text_indent">New Messages</label>
              <div class="col-md-6 col-sm-6  paddin-npt">
                <input name="new_message" value="1" type="checkbox" @if($accountsettings->
                new_message == 1) checked @endif class="make-switch form-control" data-size="small" data-on-text="Yes" data-off-text="No"> </div>
            </div>
            <div class="form-group padding-top-10 padding-bottom-10">
              <label class="col-md-6 col-sm-6  paddin-npt text_indent">New Quote-Lead System Activity</label>
              <div class="col-md-6 col-sm-6  paddin-npt">
                <input name="new_quote_lead_syatem" value="1" type="checkbox" @if($accountsettings->
                new_quote_lead_syatem == 1) checked @endif class="make-switch form-control" data-size="small" data-on-text="Yes" data-off-text="No"> </div>
            </div>
            <div class="form-group padding-top-10 padding-bottom-10">
              <label class="col-md-6 col-sm-6  paddin-npt text_indent">New Job Board Activity</label>
              <div class="col-md-6 col-sm-6  paddin-npt">
                <input name="new_job" value="1" type="checkbox" @if($accountsettings->
                new_job == 1) checked @endif class="make-switch form-control" data-size="small" data-on-text="Yes" data-off-text="No"> </div>
            </div>
            <div class="form-group padding-top-10 padding-bottom-10">
              <label class="col-md-6 col-sm-6  paddin-npt text_indent">New Market Activity</label>
              <div class="col-md-6 col-sm-6  paddin-npt">
                <input name="new_market" value="1" type="checkbox" @if($accountsettings->
                new_market == 1) checked @endif class="make-switch form-control" data-size="small" data-on-text="Yes" data-off-text="No"> </div>
            </div>
           <div class="form-group padding-top-10 padding-bottom-10">
              <label class="col-md-5 col-sm-5  paddin-npt text_vertical_indent">Default Account Mode</label>
            
            <div class="col-md-5 col-sm-5 padding-top-10 padding-bottom-10 paddin-npt">
            <input type="radio" style="min-height:22px !important; padding-top:0px !important;" name="default_account_mode" value="0" @if($accountsettings->
            default_account_mode == 0) checked @endif /> Buyer Dashboard
            <input type="radio" style="min-height:22px !important; padding-top:0px !important;" name="default_account_mode" value="1" @if($accountsettings->
            default_account_mode == 1) checked @endif /> Supplier CRM
            </div>
            </div>
            <div class="form-group padding-top-10 padding-bottom-10">
            
              <label class="col-md-4 col-sm-4 paddin-npt text_vertical_indent">Select Time Zone:</label>
              
                <div class="col-md-5 col-sm-5  paddin-npt">
                  <select id="single" name="time_zone" class="form-control selectCountry">
                    <option></option>
                    

                    @foreach($timezonelist as $timezone)

                        @if($accountsettings->time_zone != '')

                            @if($accountsettings->time_zone == $timezone)

                                                    
                            <option value="{{$timezone}}" selected="">{{$timezone}}</option>
                    

                            @else

                                                    
                            <option value="{{$timezone}}">{{$timezone}}</option>
                    

                            @endif

                        @else

                            @if($timezone == 'America/Los_Angeles')

                                                    
                            <option value="{{$timezone}}" selected="">{{$timezone}}</option>
                    

                            @else

                                                    
                            <option value="{{$timezone}}">{{$timezone}}</option>
                    

                            @endif

                        @endif

                    @endforeach

                  </select>
                </div>
              </div>
            <div class="form-group padding-top-10 padding-bottom-10">
            <label class="col-md-6 col-sm-6  paddin-npt text_indent">Show Profile in IJ Results</label>
            
              <div class="col-md-6 col-sm-6  padding-bottom-10 paddin-npt">
                <input name="profile_in_ij" value="1" type="checkbox" @if($accountsettings->
                profile_in_ij == 1) checked @endif class="make-switch form-control" data-size="small" data-on-text="Yes" data-off-text="No"> </div>
          
            </div>
            <div class="form-group padding-top-10 padding-bottom-10">
            <label class="col-md-6 col-sm-6  paddin-npt text_indent">Show Profile in Google and other Search Engine Results</label>
           
              <div class="col-md-6 col-sm-6  paddin-npt">
                <input name="profile_in_others" value="1" type="checkbox" @if($accountsettings->
                profile_in_others == 1) checked @endif class="make-switch form-control" data-size="small" data-on-text="Yes" data-off-text="No"> </div>
            
         </div>
          <div class="padding-top-10 padding-bottom-10 text-right"> <a href="{{ URL::to('request-product-quotes') }}" class="btn btn-danger bold btn-sm"> Cancel </a>
            <button type="submit" class="btn btn-circle yellow-crusta color-black bold"> <i class="fa fa-check"></i> Save</button>
          </div>
          </div>
        </form>
        
        <!-- END FORM--> 
        
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<script>

/* for show menu active */

$("#account-main-menu").addClass("active");

$('#account-main-menu' ).click();

$('#account-menu-arrow').addClass('open');

$('#user-caccount-settings-view-menu').addClass('active');

/* end menu active */



$('#change-password-link').click(function(){

  $('#change-password-div').toggle(500);  

});

jQuery(document).ready(function() {

    

    var countryplaceholder = "Select Time Zone";



    $(".selectCountry").select2({

        placeholder: countryplaceholder,

        width: null

    }); 

});

</script> 
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection 
