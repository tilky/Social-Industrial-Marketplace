@extends('buyer.app')

@section('content')
<style>
.bootstrap-tagsinput {
  width: 100% !important;
}
.main-lab{font-size: 15px!important;font-weight: bold;}
.select2-container{display: block!important;}
.ms-container{width: 90%!important;}
@media (min-width: 992px){
.col-md-2n {
    width: 20%!important;
}    
}
.margin-top{margin-top: 5px!important;}
.form-group{border-bottom: 1px solid #eef1f5!important;}
.fileinput{margin-bottom: 0px!important;}
.form-horizontal .form-group{margin-left: 15px!important;margin-right: 15px!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/typeahead/typeahead.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('job')}}">Jobs</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>POST A Job</span>
        </li>
    </ul>
</div>




<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> <i class="fa fa-edit bold color-black"></i>EDIT JOB DETAILS
</h3>
</div>
</div>
<div class="row">
    <div class="col-md-12">
            <div class="portlet-body form" id="blockui_sample_1_portlet_body">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                

                <!-- BEGIN FORM-->
                {!! Form::model($job, [

                'method' => 'PATCH',

                'id' => 'submit-form',

                'route' => ['job.update', $job->id],

                'class' => 'horizontal-form form-horizontal',

                'files' => true,

                'id' => 'req-form-job'

                ]) !!}
                
                
                    <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}" >
                    
                    <div class="form-body">
                        <h3 class="block font-red-mint align-left">Listing Details:</h3>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Listing Title:</label>
                            <div class="col-md-12 paddin-npt">
                                <input data-required="1" type="text" name="title" class="form-control" value="{{$job->title}}" placeholder="Listing Title">
                                <span class="help-block margin-top">Name your Listing.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Who would you like to post as ?:</label>
                            <div class="col-md-12 paddin-npt">
                                <select name="like_to_post_as" class="form-control">
                                    <option value="">-- Please Select --</option>
                                    <option value="Your Personal Profile" @if($job->like_to_post_as == 'Your Personal Profile') selected @endif>Your Personal Profile</option>
                                    <option value="Your Company Page" @if($job->like_to_post_as == 'Your Company Page') selected @endif>Your Company Page</option>
                                    <option value="Both Your Profile and Your Company Page" @if($job->like_to_post_as == 'Both Your Profile and Your Company Page') selected @endif>Both Your Profile and Your Company Page</option>
                                </select>
                                <span class="help-block margin-top">Select likr to post as.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label">Select All Applicable Industry:</label>
                            <select name="job_industries[]" class="form-control selectJobIndustry" id="job-industry-dropdown" multiple="">
                                <option value="">Please Select Your Country</option>
                                @foreach($indutries as $indutry)
                                    @if(in_array($indutry->id,$selectedIndustries))
                                        <option value="{{$indutry->id}}" selected="">{{$indutry->name}}</option>
                                    @else
                                        <option value="{{$indutry->id}}">{{$indutry->name}}</option>
                                    @endif
                                @endforeach
                            </select>
        				</div>
                        <h3 font-red-mint class="block font-red-mint  align-left">Add Job Details</h3>
                        <div class="form-group">
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">What is the Job Title  of the position being posted?:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="job_position_title" class="form-control" value="{{$job->job_position_title}}" placeholder="Job Title">
                                    <span class="help-block margin-top">Enter your Job Title.</span>
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt padding-left">
                                <label class="col-md-12 paddin-npt">Select Job Type (Function):</label>
                                <div class="col-md-12 paddin-npt">
                                    <select name="job_type_function" class="form-control selectJobFunction" id="job-function-dropdown">
                                        <option value=""></option>
                                        @foreach($job_functions as $job_function)
                                            @if($job->job_type_function == $job_function->name)
                                                <option value="{{$job_function->name}}" selected="">{{$job_function->name}}</option>
                                            @else
                                                <option value="{{$job_function->name}}">{{$job_function->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="help-block margin-top">Select Job Type.</span>
                                </div>
                            </div>
                        </div>
                         <label class="block col-md-6 paddin-npt">
                            <span style="font-size: 19px!important;">Where is this Position located?:</span>
                         </label>
                         <label class="block col-md-6 paddin-npt"><input type="checkbox" id="does-not-apply" name="does_not_apply" value="1" @if($job->does_not_apply == 1 ) checked @endif /><span style="font-size: 15px!important;font-weight: normal!important;">Does not Apply</span></label>
                         <div id="does-not-apply-div" class="col-md-12 paddin-npt" @if($job->does_not_apply == 1 ) style="display:none" @endif>
                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right-15">
                                <label class="control-label">Search Address:</label>

                                <div class="col-md-12 paddin-npt">
                                    <input type="text" id="autocomplete" class="form-control" onFocus="geolocate()" value=""  placeholder="Type to Search" >
                                </div>
                            </div>

                        </div>
                            <div class="form-group">
            					<div class="col-md-6 paddin-npt padding-right-15">
            						<label class="col-md-12 paddin-npt">City:</label>
                                    <div class="col-md-12 paddin-npt">
                                    <input type="text" name="city" id="locality" value="{{ $job->city }}" class="form-control" placeholder="Enter your City name" />
                                    </div>
                                    <span class="help-block margin-top">Enter your City.</span>
            					</div>
                                <div class="col-md-6 paddin-npt">
            						<label class="col-md-12 paddin-npt">State:</label>
                                    <input type="text" id="administrative_area_level_1"name="state" value="{{ $job->state }}" class="form-control" placeholder="Enter your State name" />
            					   <span class="help-block margin-top">Enter your State.</span>
                                </div>
            				</div>
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Country:</label>
                                <div class="col-md-12 paddin-npt">
                                    <select name="country" class="form-control selectCountry" id="country">
                                        <option value="">Please Select Country</option>
                                        @foreach($countries as $country)
                                            @if($job->country == $country->country_name)
                                                <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                                            @else
                                                <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="help-block margin-top">Select your Country.</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">What is this Job Type?:</label>
                            <div class="col-md-12 paddin-npt">
                                <select name="job_type" class="form-control">
                                    <option value="">-- Please Select --</option>
                                    <option value="Full Time" @if($job->job_type == 'Full Time') selected @endif>Full Time</option>
                                    <option value="Part Time" @if($job->job_type == 'Part Time') selected @endif>Part Time</option>
                                    <option value="Contract" @if($job->job_type == 'Contract') selected @endif>Contract</option>
                                    <option value="Temporary" @if($job->job_type == 'Temporary') selected @endif>Temporary</option>
                                    <option value="Exempt" @if($job->job_type == 'Exempt') selected @endif>Exempt</option>
                                </select>
                                <span class="help-block margin-top">Select your Job Type.</span>
                            </div>
                        </div>
                        <div class="form-group">
        					<div class="col-md-6 paddin-npt padding-right-15">
        						<label class="col-md-12 paddin-npt">Is there any Travel Required?:</label>
                                <div class="col-md-12 paddin-npt">
                                    <select class="form-control" id="travel_required" name="travel_required">
                                        <option value="">-- Please Select --</option>
                                        <option value="Yes" @if($job->travel_required == 1) selected @endif>Yes</option>
                                        <option value="No" @if($job->travel_required == 0) selected @endif>No</option>
                                    </select>
                                </div>
                                <span class="help-block margin-top">Select your option:</span>
        					</div>
                            <div class="col-md-6 paddin-npt" id="travel_time" style="display: none;">
        						<label class="col-md-12 paddin-npt">&nbsp;</label>
                                <div class="col-md-12 paddin-npt">
                                    <select class="form-control" name="how_often">
                                        <option value="">-- Please Select --</option>
                                        <option value="25% of the time" @if($job->how_often == '25% of the time') selected @endif>25% of the time</option>
                                        <option value="50% of time" @if($job->how_often == '50% of time') selected @endif>50% of time</option>
                                        <option value="75% of time" @if($job->how_often) == '75% of time') selected @endif>75% of time</option>
                                        <option value="100% of the time" @if($job->how_often == '100% of the time') selected @endif>100% of the time</option>
                                    </select>
                                </div>
        					   <span class="help-block margin-top">Select How Often:</span>
                            </div>
        				</div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Add Position Responsibilities and Summary for the applicant:</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea class="inbox-editor inbox-wysihtml5 form-control" name="summary" placeholder="Enter Summary" rows="6">{{$job->summary}}</textarea>
                                <span class="help-block margin-top">Enter your Job Summary.</span>
                            </div>
                        </div>
                        <div class="form-group">
        					<div class="col-md-6 paddin-npt padding-right-15">
        						<label class="col-md-12 paddin-npt">What level of Experience is Required?:</label>
                                <div class="col-md-12 paddin-npt">
                                    <select class="form-control" name="experience_required">
                                        <option value="">-- Please Select --</option>
                                        <option value="Entry Level" @if($job->experience_required == 'Entry Level') selected @endif>Entry Level</option>
                                        <option value="1 year" @if($job->experience_required == '1 year') selected @endif>1 year</option>
                                        <option value="2 to 5 years" @if($job->experience_required == '2 to 5 years') selected @endif>2 to 5 years</option>
                                        <option value="5 to 7 years" @if($job->experience_required == '5 to 7 years') selected @endif>5 to 7 years</option>
                                        <option value="7 to 10 years" @if($job->experience_required == '7 to 10 years') selected @endif>7 to 10 years</option>
                                        <option value="More than 10+ years" @if($job->experience_required == 'More than 10+ years') selected @endif>More than 10+ years</option>
                                    </select>
                                </div>
                                <span class="help-block margin-top">Select Experience Required.</span>
        					</div>
                            <div class="col-md-6 paddin-npt">
        						<label class="col-md-12 paddin-npt">What is the Required Education level? </label>
                                <div class="col-md-12 paddin-npt">
                                    <select class="form-control" name="education_level">
                                        <option value="">-- Please Select --</option>
                                        <option value="High School" @if($job->education_level == 'High School') selected @endif>High School</option>
                                        <option value="Certification" @if($job->education_level == 'Certification') selected @endif>Certification</option>
                                        <option value="Associates" @if($job->education_level == 'Associates') selected @endif>Associates</option>
                                        <option value="Bachelors" @if($job->education_level == 'Bachelors') selected @endif>Bachelors</option>
                                        <option value="Advanced" @if($job->education_level == 'Advanced') selected @endif>Advanced</option>
                                    </select>
                                </div>
        					   <span class="help-block margin-top">Select Education level.</span>
                            </div>
        				</div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Additional Qualifications & Requirements:</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea class="form-control" name="addition_qualification_requirement" placeholder="Enter Additional Qualifications & Requirements" rows="3">{{$job->addition_qualification_requirement}}</textarea>
                                <span class="help-block margin-top">Enter your Additional Qualifications & Requirements.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Enter and Select the desired skills and expertise :</label>
                            <input type="text" name="specification" value="{{$job->specification}}" data-role="tagsinput" id="taginputinnew" placeholder="Type something and hit enter" />
                            <span class="help-block margin-top">Enter your Skills and Expertise.</span>
                        </div>
                        <div class="form-group">
        					<div class="col-md-6 paddin-npt padding-right-15">
        						<label class="col-md-12 paddin-npt">Select Compensation Type:</label>
                                <div class="col-md-12 paddin-npt">
                                    <select class="form-control" name="compensation_type" id="compensation_type">
                                        <option value="">-- Please Select --</option>
                                        <option value="Hourly" @if($job->compensation_type == 'Hourly') selected @endif>Hourly</option>
                                        <option value="Salaried" @if($job->compensation_type == 'Salaried') selected @endif>Salaried</option>
                                    </select>
                                </div>
                                <span class="help-block margin-top">Select your option:</span>
        					</div>
                            <div class="col-md-6 paddin-npt" id="compensation_rang" style="display: none;">
        						<label class="col-md-12 paddin-npt">Select Compensation Range:</label>
                                <div class="col-md-12 paddin-npt">
                                    <select class="form-control" name="houryl_range" id="hourly_rang" style="display: none;">
                                        <option value="">-- Select Hourly --</option>
                                        <option value="Depending on Experience" @if($job->compensation_range == 'Depending on Experience') selected @endif>Depending on Experience</option>
                                        <option value="Up to $10/hour" @if($job->compensation_range == 'Up to $10/hour') selected @endif>Up to $10/hour</option>
                                        <option value="10.01 - 12.50/hour" @if($job->compensation_range == '10.01 - 12.50/hour') selected @endif>10.01 - 12.50/hour</option>
                                        <option value="12.51 - 15.00/hour" @if($job->compensation_range == '12.51 - 15.00/hour') selected @endif>12.51 - 15.00/hour</option>
                                        <option value="15.01 - 20/hour, 20.01 - 25/hour" @if($job->compensation_range == '15.01 - 20/hour, 20.01 - 25/hour') selected @endif>15.01 - 20/hour, 20.01 - 25/hour</option>
                                        <option value="25.01 - 35/hour" @if($job->compensation_range == '25.01 - 35/hour') selected @endif>25.01 -  35/hour</option>
                                        <option value="35 - 50/hour" @if($job->compensation_range == '35 - 50/hour') selected @endif>35 - 50/hour</option>
                                        <option value="51 - 75 /hour" @if($job->compensation_range == '51 - 75 /hour') selected @endif>51 - 75 /hour</option>
                                        <option value="76 - 100/hour" @if($job->compensation_range == '76 - 100/hour') selected @endif>76 - 100/hour</option>
                                        <option value="101 - 150/hour" @if($job->compensation_range == '101 - 150/hour') selected @endif>101 - 150/hour</option>
                                        <option value="151 - 200/hour" @if($job->compensation_range == '151 - 200/hour') selected @endif>151 - 200/hour</option>
                                        <option value="200/hour and Up" @if($job->compensation_range == '200/hour and Up') selected @endif>200/hour and Up</option>
                                    </select>
                                    <select class="form-control" name="salaried_range" id="salaried_rang" style="display: none;">
                                        <option value="">-- Select Salaried --</option>
                                        <option value="Depending on Experience" @if($job->compensation_range == 'Depending on Experience') selected @endif>Depending on Experience</option>
                                        <option value="Up to 25,000" @if($job->compensation_range == 'Up to 25,000') selected @endif>Up to 25,000</option>
                                        <option value="25001 - 50,000" @if($job->compensation_range == '25001 - 50,000') selected @endif>25001 - 50,000</option>
                                        <option value="50,001 to 75000, 75001 - 100,000" @if($job->compensation_range == '50,001 to 75000, 75001 - 100,000') selected @endif>50,001 to 75000, 75001 - 100,000</option>
                                        <option value="1,00,000 - 1,25,000" @if($job->compensation_range == '1,00,000 - 1,25,000') selected @endif>1,00,000 - 1,25,000</option>
                                        <option value="1,25,000 - 1,50,0000" @if($job->compensation_range == '1,25,000 - 1,50,0000') selected @endif>1,25,000 - 1,50,0000</option>
                                        <option value="1,50,000 - 2,00,000" @if($job->compensation_range == '1,50,000 - 2,00,000') selected @endif>1,50,000 - 2,00,000</option>
                                        <option value="2,00,000 and UP" @if($job->compensation_range == '2,00,000 and UP') selected @endif>2,00,000 and UP</option>
                                    </select>
                                </div>
        					   <span class="help-block margin-top">Select Compensation Range.</span>
                            </div>
        				</div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Enter Additional Compensation and Benefits Details:</label>
                            <textarea class="form-control" name="additional_compensation" placeholder="Enter Additional Qualifications & Requirements" rows="2">{{$job->additional_compensation}}</textarea>
                            <span class="help-block margin-top">Enter Additional Compensation and Benefits Details.</span>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-circle yellow-crusta color-black bold"> <i class="fa fa-check"></i>Submit Job</button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
    </div>
</div>
</div>
<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6bkZqMRGyPwECqAnwqQapOX94md7Y9UY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name'
    };

    $('#autocomplete').keypress(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});
        //console.log("aaa");
        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        for (var component in componentForm) {
            if(component == 'country'){
                $(".selectCountry").select2('val','')
            }else{
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                if(addressType == 'country'){
                    var val = place.address_components[i][componentForm[addressType]];
                    $(".selectCountry").select2('val',val)
                }else{
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.

    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }else{
            console.log('not defined.');
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiDNVH3xsDq4YPf8dMkHBzXrH17wF_JZw&libraries=places&callback=initAutocomplete"async defer></script>
<script>
/* for show menu active */
$("#jobs-main-menu").addClass("active");
$('#jobs-main-menu' ).click();
$('#jobs-menu-arrow').addClass('open')
$('#jobs-create-menu').addClass('active');
/* end menu active */
jQuery(document).ready(function() {
    
    $('.inbox-wysihtml5').wysihtml5({
      toolbar: {
        
      }
    });
    
    $("#does-not-apply").click(function(){    
       var check=$(this).prop('checked');
       if(check==true) {
         $('#does-not-apply-div').hide();
       } else {
         $('#does-not-apply-div').show();
       }
    });
    
    var jobTypePlaceholder = "Select a Job Type";
    $(".selectJobFunction").select2({
        placeholder: jobTypePlaceholder,
        width: null
    });
    
    var countryPlaceholder = "Select your Country";
    $(".selectCountry").select2({
        placeholder: countryPlaceholder,
        width: null
    });
    
    var jobIndplaceholder = "Type and select one or more industries";
    $(".selectJobIndustry").select2({
        placeholder: jobIndplaceholder,
        width: null
    });
    
     var citynames = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: {
        url: "{{url('skills-expertise/options')}}",
        filter: function(list) {
          return $.map(list, function(cityname) {
            return { name: cityname }; });
        }
      }
    });
    citynames.initialize();
    
    $('#taginputinnew').tagsinput({
      typeaheadjs: {
        name: 'citynames',
        displayKey: 'name',
        valueKey: 'name',
        source: citynames.ttAdapter()
      }
    }); 
    
    var travel_load = "{{$job->travel_required}}";
    if(travel_load == 1)
    {
        $('#travel_time').show();
    }
    
    $('#travel_required').on('change',function(){
       var travel = $(this).val();
       if(travel == 'Yes')
       {
            $('#travel_time').show();
       }
       else
       {
            $('#travel_time').hide();
       }
    });
    
    var compensation_load = "{{$job->compensation_type}}";
   if(compensation_load == 'Hourly')
   {
        $('#compensation_rang').show();
        $('#hourly_rang').show();
        $('#salaried_rang').hide();
   }
   else if(compensation_load == 'Salaried')
   {
        $('#compensation_rang').show();
        $('#hourly_rang').hide();
        $('#salaried_rang').show();
   }
   else
   {
        $('#compensation_rang').hide();
        $('#hourly_rang').hide();
        $('#salaried_rang').hide();
   } 
    
    $('#compensation_type').on('change',function(){
       var compensation = $(this).val();
       if(compensation == 'Hourly')
       {
            $('#compensation_rang').show();
            $('#hourly_rang').show();
            $('#salaried_rang').hide();
       }
       else if(compensation == 'Salaried')
       {
            $('#compensation_rang').show();
            $('#hourly_rang').hide();
            $('#salaried_rang').show();
       }
       else
       {
            $('#compensation_rang').hide();
            $('#hourly_rang').hide();
            $('#salaried_rang').hide();
       } 
    });
    
});
</script>
<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
@endsection
