@extends('buyer.app')
@section('content')
<style>
    .bootstrap-tagsinput {  width: 100% !important;}
    .main-lab{font-size: 15px!important;font-weight: bold;}
    .select2-container{display: block!important;}
    .ms-container{width: 90%!important;}
    @media (min-width: 992px){
        .col-md-2n {    width: 20%!important;}
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
        <li> <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li> <a href="{{url('job')}}">Jobs</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Post a Job Listing</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
    <div class="row">
        <div class="col-md-12 border2x_bottom">
            <h3 class="page-title uppercase">
                <i class="fa fa-plus bold color-black"></i> Post a Job Listing
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="portlet-body form" id="blockui_sample_1_portlet_body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach </div>
                    @endif
                    <div class="mt-element-step">
                        <div class="row step-line">
                            <div id="company-first" class="col-md-4 mt-step-col first active">
                                <div class="mt-step-number bg-white">1</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Enter Listing Details</div>
                            </div>
                            <div id="company-second" class="col-md-4 mt-step-col ">
                                <div class="mt-step-number bg-white">2</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Job Listing Payment</div>
                            </div>
                            <div id="company-third" class="col-md-4 mt-step-col last">
                                <div class="mt-step-number bg-white">3</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Manage Applicants</div>
                            </div>
                        </div>
                    </div>
                    <div class="yellow-crusta-seprator"></div>
                    <div class="col-md-12 padding-top" id="first-step-quote">
                        <div class="row">
                            <h3 class="block font-red-mint  bold align-left">Enter your job listing details.</h3>
                        </div>
                    </div>
                    <div class="col-md-12 padding-top" id="second-step-quote" style="display: none;">
                        <div class="row">
                            <p class="caption-helper">Choose all Optional Selections that apply to you.</p>
                        </div>
                    </div>
                    <!-- BEGIN FORM-->
                    {!! Form::open([
                    'route' => 'job.store',
                    'class' => 'horizontal-form form-horizontal',
                    'files' => true,
                    'id' => 'job-form-submit'
                    ]) !!}
                    <input type="hidden" name="user_id" class="form-control" value="{{$user->id}}" >
                    <input type="hidden" name="account_member" value="{{$user->account_member}}" id="user_account_member" />
                    <input type="hidden" name="card_token" value="" id="job_card_token_pop" />
                    <input type="hidden" name="amount" value="30" />
                    <input type="hidden" name="card_last_4" value="" id="job_card_last_4_pop" />
                    <input type="hidden" name="card_type" id="job_card_type_pop" value="" />
                    <input type="hidden" name="cardNumber" id="job_cardNumber_pop" value="" />
                    <input type="hidden" name="cardExpiry" id="job_cardExpiry_pop" value="" />
                    <input type="hidden" name="cardCVC" id="job_cardCVC_pop" value="" />
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Listing Title:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input data-required="1" type="text" name="title" class="form-control" value="{{Request::old('title')}}" placeholder="Listing Title">
                                    <span class="help-block margin-top">Name your Listing.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Where do you want this listing to be linked to:</label>
                                <div class="col-md-12 paddin-npt">
                                    <select name="like_to_post_as" class="form-control">
                                        <option value="">-- Please Select --</option>
                                        <option value="Your Company Page" @if(Request::old('like_to_post_as') == 'Your Company Page') selected @endif>Your Company Page</option>
                                        <option value="Your Personal Profile" @if(Request::old('like_to_post_as') == 'Your Personal Profile') selected @endif>Your Personal Profile</option>
                                        <option value="Both Your Profile and Your Company Page" @if(Request::old('like_to_post_as') == 'Both Your Profile and Your Company Page') selected @endif>Your Company Page and Personal Profile</option>
                                    </select>
                                    <span class="help-block margin-top">Select the option that best applies.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label">Select all Industries applicable to your Job Listing:</label>
                                <select name="job_industries[]" class="form-control selectJobIndustry" id="job-industry-dropdown" multiple="">
                                    <option value="">Please Select Your Country</option>
                                    @if(Request::old('job_industries'))
                                    @foreach($indutries as $indutry)
                                    @if(in_array($indutry->id,Request::old('job_industries')))
                                    <option value="{{$indutry->id}}" selected="">{{$indutry->name}}</option>
                                    @else
                                    <option value="{{$indutry->id}}">{{$indutry->name}}</option>
                                    @endif
                                    @endforeach
                                    @else
                                    @foreach($indutries as $indutry)
                                    @if($indutry->id == $selectedUserIndustries)
                                    <option value="{{$indutry->id}}" selected="">{{$indutry->name}}</option>
                                    @else
                                    <option value="{{$indutry->id}}">{{$indutry->name}}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 paddin-npt">
                                    <label class="col-md-12 paddin-npt">Enter the Position Title:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="text" name="job_position_title" class="form-control" value="{{Request::old('job_position_title')}}" placeholder="Job Title">
                                        <span class="help-block margin-top"> </span>
                                    </div>
                                </div>
                                <div class="col-md-6 paddin-npt padding-left">
                                    <label class="col-md-12 paddin-npt">Select Job Classification:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select name="job_type_function" class="form-control selectJobFunction" id="job-function-dropdown">
                                            <option value=""></option>
                                            @foreach($job_functions as $job_function)
                                            @if(Request::old('job_type_function'))
                                            @if(Request::old('job_type_function') == $job_function->name)
                                            <option value="{{$job_function->name}}" selected="">{{$job_function->name}}</option>
                                            @else
                                            <option value="{{$job_function->name}}">{{$job_function->name}}</option>
                                            @endif
                                            @else
                                            <option value="{{$job_function->name}}">{{$job_function->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <span class="help-block margin-top">Select an applicable Job Function from the given options.</span>
                                    </div>
                                </div>
                            </div>
                            <label class="block padding-left col-md-6"> <span style="font-size: 19px!important;">Where is this Position located?:</span> </label>
                            <label class="block col-md-6 paddin-npt">
                                <input type="checkbox" id="does-not-apply" name="does_not_apply" value="1" @if(Request::old('does_not_apply') == 'on' || Request::old('does_not_apply') == 1 ) checked @endif />
                                <span style="font-size: 17px!important;font-weight: normal!important;">Location does not Apply</span>
                            </label>
                            <div id="does-not-apply-div" class="col-md-12 paddin-npt">
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
                                            @if($user->userdetail->UserCompany)
                                            <input type="text" id="locality" name="city" value="{{ $user->userdetail->UserCompany->city }}" class="form-control" placeholder="Enter your City name" />
                                            @else
                                            <input type="text" id="locality" name="city" value="{{ $user->userdetail->city }}" class="form-control" placeholder="Enter your City name" />
                                            @endif
                                        </div>
                                        <span class="help-block margin-top">Enter your City.</span>
                                    </div>
                                    <div class="col-md-6 paddin-npt">
                                        <label class="col-md-12 paddin-npt">State:</label>
                                        @if($user->userdetail->UserCompany)
                                        <input type="text" id="administrative_area_level_1" name="state" value="{{ $user->userdetail->UserCompany->state }}" class="form-control" placeholder="Enter your State name" />
                                        @else
                                        <input type="text" id="administrative_area_level_1" name="state" value="{{ $user->userdetail->state }}" class="form-control" placeholder="Enter your State name" />
                                        @endif
                                        <span class="help-block margin-top">Enter your State.</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 paddin-npt">Country:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select name="country" class="form-control selectCountry" id="country">
                                            <option value="">Please Select Country</option>
                                            @foreach($countries as $country)
                                            @if($user->userdetail->UserCompany)
                                            @if($user->userdetail->UserCompany->country == $country->country_name)
                                            <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                                            @else
                                            <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                            @endif
                                            @else
                                            @if($user->userdetail->country == $country->country_name)
                                            <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                                            @else
                                            <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                            @endif
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
                                        <option value="Full Time" @if(Request::old('job_type') == 'Full Time') selected @endif>Full Time</option>
                                        <option value="Part Time" @if(Request::old('job_type') == 'Part Time') selected @endif>Part Time</option>
                                        <option value="Contract" @if(Request::old('job_type') == 'Contract') selected @endif>Contract</option>
                                        <option value="Temporary" @if(Request::old('job_type') == 'Temporary') selected @endif>Temporary</option>
                                        <option value="Exempt" @if(Request::old('job_type') == 'Exempt') selected @endif>Exempt</option>
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
                                            <option value="Yes" @if(Request::old('travel_required') == 'Yes') selected @endif>Yes</option>
                                            <option value="No" @if(Request::old('travel_required') == 'No') selected @endif>No</option>
                                        </select>
                                    </div>
                                    <span class="help-block margin-top">Select your option:</span>
                                </div>
                                <div class="col-md-6 paddin-npt" id="travel_time" style="display: none;">
                                    <label class="col-md-12 paddin-npt">&nbsp;</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select class="form-control" name="how_often">
                                            <option value="">-- Please Select --</option>
                                            <option value="25% of the time" @if(Request::old('how_often') == '25% of the time') selected @endif>25% of the time</option>
                                            <option value="50% of time" @if(Request::old('how_often') == '50% of time') selected @endif>50% of time</option>
                                            <option value="75% of time" @if(Request::old('how_often') == '75% of time') selected @endif>75% of time</option>
                                            <option value="100% of the time" @if(Request::old('how_often') == '100% of the time') selected @endif>100% of the time</option>
                                        </select>
                                    </div>
                                    <span class="help-block margin-top">Select How Often:</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Add Job Summary and list Position Responsibilities:</label>
                                <div class="col-md-12 paddin-npt">
                                    <textarea class="inbox-editor inbox-wysihtml5 form-control" name="summary" placeholder="Enter Summary" rows="6">{{Request::old('summary')}}</textarea>
                                    <span class="help-block margin-top">Enter your Job Summary.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 paddin-npt padding-right-15">
                                    <label class="col-md-12 paddin-npt">Desired level of Experience:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select class="form-control" name="experience_required">
                                            <option value="">-- Please Select --</option>
                                            <option value="Entry Level" @if(Request::old('experience_required') == 'Entry Level') selected @endif>Entry Level</option>
                                            <option value="1 year" @if(Request::old('experience_required') == '1 year') selected @endif>1 year</option>
                                            <option value="2 to 5 years" @if(Request::old('experience_required') == '2 to 5 years') selected @endif>2 to 5 years</option>
                                            <option value="5 to 7 years" @if(Request::old('experience_required') == '5 to 7 years') selected @endif>5 to 7 years</option>
                                            <option value="7 to 10 years" @if(Request::old('experience_required') == '7 to 10 years') selected @endif>7 to 10 years</option>
                                            <option value="More than 10+ years" @if(Request::old('experience_required') == 'More than 10+ years') selected @endif>More than 10+ years</option>
                                        </select>
                                    </div>
                                    <span class="help-block margin-top">Select Experience Required.</span>
                                </div>
                                <div class="col-md-6 paddin-npt">
                                    <label class="col-md-12 paddin-npt">Required Education level: </label>
                                    <div class="col-md-12 paddin-npt">
                                        <select class="form-control" name="education_level">
                                            <option value="">-- Please Select --</option>
                                            <option value="High School" @if(Request::old('education_level') == 'High School') selected @endif>High School</option>
                                            <option value="Certification" @if(Request::old('education_level') == 'Certification') selected @endif>Certification</option>
                                            <option value="Associates" @if(Request::old('education_level') == 'Associates') selected @endif>Associates</option>
                                            <option value="Bachelors" @if(Request::old('education_level') == 'Bachelors') selected @endif>Bachelors</option>
                                            <option value="Advanced" @if(Request::old('education_level') == 'Advanced') selected @endif>Advanced</option>
                                        </select>
                                    </div>
                                    <span class="help-block margin-top">Select Education level.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Additional Qualifications & Requirements:</label>
                                <div class="col-md-12 paddin-npt">
                                    <textarea class="form-control" name="addition_qualification_requirement" placeholder="Enter Additional Qualifications & Requirements" rows="3">{{Request::old('addition_qualification_requirement')}}</textarea>
                                    <span class="help-block margin-top"> </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Select your desired skillsets and expertise for applicants:</label>
                                <input type="text" name="specification" value="{{Request::old('specification')}}" data-role="tagsinput" id="taginputinnew" placeholder="Start typing and selecting, add comma for next keyword." />
                                <span class="help-block margin-top"> Select skillsets and expertise keywords for your listing. </span>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 paddin-npt padding-right-15">
                                    <label class="col-md-12 paddin-npt">Select Compensation Type:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select class="form-control" name="compensation_type" id="compensation_type">
                                            <option value="">-- Please Select --</option>
                                            <option value="Hourly" @if(Request::old('compensation_type') == 'Hourly') selected @endif>Hourly</option>
                                            <option value="Salaried" @if(Request::old('compensation_type') == 'Salaried') selected @endif>Salaried</option>
                                        </select>
                                    </div>
                                    <span class="help-block margin-top">Select your option:</span>
                                </div>
                                <div class="col-md-6 paddin-npt" id="compensation_rang" style="display: none;">
                                    <label class="col-md-12 paddin-npt">Select Compensation Range:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select class="form-control" name="houryl_range" id="hourly_rang" style="display: none;">
                                            <option value="">-- Select Hourly --</option>
                                            <option value="Depending on Experience" @if(Request::old('houryl_range') == 'Depending on Experience') selected @endif>Depending on Experience</option>
                                            <option value="Up to $10/hour" @if(Request::old('houryl_range') == 'Up to $10/hour') selected @endif>Up to $10/hour</option>
                                            <option value="10.01 - 12.50/hour" @if(Request::old('houryl_range') == '10.01 - 12.50/hour') selected @endif>10.01 - 12.50/hour</option>
                                            <option value="12.51 - 15.00/hour" @if(Request::old('houryl_range') == '12.51 - 15.00/hour') selected @endif>12.51 - 15.00/hour</option>
                                            <option value="15.01 - 20/hour, 20.01 - 25/hour" @if(Request::old('houryl_range') == '15.01 - 20/hour, 20.01 - 25/hour') selected @endif>15.01 - 20/hour, 20.01 - 25/hour</option>
                                            <option value="25.01 - 35/hour" @if(Request::old('houryl_range') == '25.01 - 35/hour') selected @endif>25.01 -  35/hour</option>
                                            <option value="35 - 50/hour" @if(Request::old('houryl_range') == '35 - 50/hour') selected @endif>35 - 50/hour</option>
                                            <option value="51 - 75 /hour" @if(Request::old('houryl_range') == '51 - 75 /hour') selected @endif>51 - 75 /hour</option>
                                            <option value="76 - 100/hour" @if(Request::old('houryl_range') == '76 - 100/hour') selected @endif>76 - 100/hour</option>
                                            <option value="101 - 150/hour" @if(Request::old('houryl_range') == '101 - 150/hour') selected @endif>101 - 150/hour</option>
                                            <option value="151 - 200/hour" @if(Request::old('houryl_range') == '151 - 200/hour') selected @endif>151 - 200/hour</option>
                                            <option value="200/hour and Up" @if(Request::old('houryl_range') == '200/hour and Up') selected @endif>200/hour and Up</option>
                                        </select>
                                        <select class="form-control" name="salaried_range" id="salaried_rang" style="display: none;">
                                            <option value="">-- Select Salaried --</option>
                                            <option value="Depending on Experience" @if(Request::old('salaried_range') == 'Depending on Experience') selected @endif>Depending on Experience</option>
                                            <option value="Up to 25,000" @if(Request::old('salaried_range') == 'Up to 25,000') selected @endif>Up to 25,000</option>
                                            <option value="25001 - 50,000" @if(Request::old('salaried_range') == '25001 - 50,000') selected @endif>25001 - 50,000</option>
                                            <option value="50,001 to 75000, 75001 - 100,000" @if(Request::old('salaried_range') == '50,001 to 75000, 75001 - 100,000') selected @endif>50,001 to 75000, 75001 - 100,000</option>
                                            <option value="1,00,000 - 1,25,000" @if(Request::old('salaried_range') == '1,00,000 - 1,25,000') selected @endif>1,00,000 - 1,25,000</option>
                                            <option value="1,25,000 - 1,50,0000" @if(Request::old('salaried_range') == '1,25,000 - 1,50,0000') selected @endif>1,25,000 - 1,50,0000</option>
                                            <option value="1,50,000 - 2,00,000" @if(Request::old('salaried_range') == '1,50,000 - 2,00,000') selected @endif>1,50,000 - 2,00,000</option>
                                            <option value="2,00,000 and UP" @if(Request::old('salaried_range') == '2,00,000 and UP') selected @endif>2,00,000 and UP</option>
                                        </select>
                                    </div>
                                    <span class="help-block margin-top">Select Compensation Range.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Enter Additional Compensation and Benefits Details:</label>
                                <textarea class="form-control" name="additional_compensation" placeholder="Enter Additional Qualifications & Requirements" rows="2">{{Request::old('additional_compensation')}}</textarea>
                                <span class="help-block margin-top">Enter Additional Compensation and Benefits Details.</span>
                            </div>
                        </div>
                        <div class="form-actions right">
                            <div class="row">
                                <button type="button" id="job-post-sumbit" class="btn btn-circle yellow-crusta color-black bold"> <i class="fa fa-check"></i>Continue to Payment</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade footer-modal" id="job-post-modal" role="basic" aria-hidden="true" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h3 class="modal-title" style="text-transform: uppercase;">Listing Payment Details </h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12"> @if($user->account_member == 'gold')
                        <h4>Thank you for being a Gold Supplier.</h4>
                        @else
                        <h4>Thank you for being a Silver Supplier.</h4>
                        @endif
                        <p>You have {{$user->job_post}} job posting credits left this month.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                @if($user->job_post > 0)
                <button type="button" id="user-credit-btn" class="btn yellow-crusta color-black btn-circle">Use a Credit and List this Job </button>
                @else
                <button type="button" id="user-credit-btn-payment" class="btn yellow-crusta color-black btn-circle">Pay and Post Job</button>
                @endif
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
$('#jobs-menu-arrow').addClass('open');
$('#jobs-create-menu').addClass('active');
/* end menu active */
$("#does-not-apply").click(function(){
    var check=$(this).prop('checked');
    if(check==true) {
        $('#does-not-apply-div').hide();
    } else {
        $('#does-not-apply-div').show();
    }});

jQuery(document).ready(function() {
    $('.inbox-wysihtml5').wysihtml5({
        toolbar: {
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
    var travel_load = "{{Request::old('travel_required')}}";
    if(travel_load == 'Yes')
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
    var compensation_load = "{{Request::old('compensation_type')}}";
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
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    $('#job-post-sumbit').click(function(){
        var user_account = $('#user_account_member').val();
        if(user_account == 'gold' || user_account == 'silver')
        {
            $('#job-post-modal').modal('show');
        }
        else
        {
            var handler = StripeCheckout.configure({
                key: "{{env('STRIPE_PUBLIC_KEY', '')}}",
                image: "{{url('images/indy_john_crm_logo.png')}}",
                locale: 'auto'
                token: function(token) {
                    App.blockUI({
                        target: '#blockui_sample_1_portlet_body',
                        animate: true
                    });
                    $('#job_card_token_pop').val(token.id);
                    $('#job_card_last_4_pop').val(token.card.last4);
                    $('#job_cardNumber_pop').val('');
                    $('#job_cardExpiry_pop').val(token.card.exp_month+' / '+token.card.exp_year);
                    $('#job_cardCVC_pop').val('');
                    $('#job_card_type_pop').val(token.card.brand+' '+token.type);
                    $('#job-form-submit').submit();
                     // You can access the token ID with `token.id`.
                     // Get the token ID to your server-side code for use.
                     }
                });
                     // Open Checkout with further options:
                handler.open({
                    name: "{{url('/')}}",
                    description: 'Submit Your Payment For the Job Listing',
                    email:"{{Auth::user()->email}}",
                    amount: 3000
                });
        }
    });

    $('#user-credit-btn-payment').click(function(){
        var handler = StripeCheckout.configure({
            key: "{{env('STRIPE_PUBLIC_KEY', '')}}",
            image: "{{url('images/indy_john_crm_logo.png')}}",
            locale: 'auto'
            token: function(token) {
                App.blockUI({
                    target: '#blockui_sample_1_portlet_body',
                    animate: true
                });
                $('#job_card_token_pop').val(token.id);
                $('#job_card_last_4_pop').val(token.card.last4);
                $('#job_cardNumber_pop').val('');
                $('#job_cardExpiry_pop').val(token.card.exp_month+' / '+token.card.exp_year);
                $('#job_cardCVC_pop').val('');
                $('#job_card_type_pop').val(token.card.brand+' '+token.type);
                $('#job-form-submit').submit();
                  // You can access the token ID with `token.id`.
                  // Get the token ID to your server-side code for use.
            }
        });
         // Open Checkout with further options:
        handler.open({
            name: "{{url('/')}}",
            description: 'Payment For Job Post',
            email:"{{Auth::user()->email}}",
            amount: 3000
        });
    });

    $('#user-credit-btn').click(function(){
        App.blockUI({
            target: '#blockui_sample_1_portlet_body',
            animate: true
        });
        $('#job-form-submit').submit();
    });

    // Close Checkout on page navigation:
     $(window).on('popstate', function() {
         handler.close();
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
