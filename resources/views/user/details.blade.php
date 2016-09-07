@extends('buyer.app')

@section('content')

<style>
    .bootstrap-tagsinput {  width: 100% !important;}
    .select2-container{display: block!important;}
</style>
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/typeahead/typeahead.css')}}" rel="stylesheet" type="text/css" />
<style>
    #map {
        height: 100%;
    }
</style>
<style>
    #locationField, #controls {
        position: relative;
        width: 560px;
    }
    #autocomplete {

        top: 0px;
        left: 0px;
        width: 200%;
    }
</style>
</head>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Dashboard</a>
        </li>
        <li>
            <span>User Detail</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
    <div class="row">
        <div class="col-md-12 border2x_bottom">
            <h3 class="page-title uppercase"> <i class="fa fa-plus color-black"></i>Indy John Profile Details </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div  class="portlet-body form">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                    @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {{ Session::get('message') }}
                    </div>
                    @endif
                    <div class="col-md-12 padding-top">
                        <p class="caption-helper">
                            Create or edit your Indy John profile and start taking advantage of Indy John's buying features and tools.</p>
                    </div>
                    <div class="mt-element-step">
                        <div class="row step-line">
                            <div id="company-first" class="col-md-4 mt-step-col first active">
                                <div class="mt-step-number bg-white">1</div>
                                <div class="mt-step-title uppercase font-grey-cascade">PERSONAL INFORMATION</div>
                            </div>
                            <div id="company-second" class="col-md-4 mt-step-col">
                                <div class="mt-step-number bg-white">2</div>
                                <div class="mt-step-title uppercase font-grey-cascade">ADDITIONAL INFORMATION</div>
                            </div>
                            <div id="company-third" class="col-md-4 mt-step-col last">
                                <div class="mt-step-number bg-white">3</div>
                                <div class="mt-step-title uppercase font-grey-cascade">UPLOAD PHOTO</div>
                            </div>
                            <!--<div id="company-forth" class="col-md-3 mt-step-col last">
                                  <div class="mt-step-number bg-white">4</div>
                                         <div class="mt-step-title uppercase font-grey-cascade">CONNECT / INVITE USERS</div>
                                 </div>-->
                        </div>
                    </div>
                    <div class="yellow-crusta-seprator"></div>
                    <form id="wizard-profile" class="horizontal-form form-horizontal form-row-seperated" action="{{url('user/basicinfo/save')}}" id="submit_form" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="next_step" value="continue" id="next-after-profile" />
                        <div class="form-body padding-15">                        <!-- Basic Info Section -->
                            <h3 class="block bold font-red-mint align-left"><span>Personal Information</span></h3>
                            <div class="form-group">
                                <div class="col-md-6 paddin-npt padding-right-15">
                                    <label class="control-label">First Name:</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="Enter your First name" @if(Request::old('firstname')) value="{{Request::old('firstname')}}" @else  value="{{Auth::user()->userdetail->first_name}}" @endif>                            </div>                            <div class="col-md-6 paddin-npt">                                <label class="control-label">Last Name:</label>                                <input type="text" class="form-control" name="lastname" placeholder="Enter your Last name" @if(Request::old('lastname')) value="{{Request::old('lastname')}}" @else value="{{Auth::user()->userdetail->last_name}}" @endif>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 paddin-npt padding-right-15">
                                    <label class="control-label">Alias Name:<span style="font-size: 14px;vertical-align: top; red"> (optional)</span></label>
                                    <input type="text" class="form-control" name="alias_name" placeholder="Enter Your Alias" @if(Request::old('alias_name')) value="{{Request::old('alias_name')}}" @else value="{{Auth::user()->userdetail->alias_name}}" @endif>                            </div><div class="col-md-6 paddin-npt padding-right-15">    						<label class="control-label">Languages Spoken:</label>
                                    <select name="language[]" class="form-control selectLanguage" multiple="">
                                        <option value="">Please Select Country</option>
                                        @if(Request::old('language'))
                                            @foreach($languages as $language)
                                            @if(in_array($language->name,Request::old('language')))
                                            <option value="{{$language->name}}" selected="">{{$language->name}}</option>
                                            @else
                                            <option value="{{$language->name}}">{{$language->name}}
                                            </option>
                                            @endif
                                            @endforeach
                                        @else
                                        @foreach($languages as $language)
                                        @if(in_array($language->name,$selecteLanguageArray))
                                            <option value="{{$language->name}}" selected="">{{$language->name}}</option>
                                        @else
                                            <option value="{{$language->name}}">{{$language->name}}</option>
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <!--<div class="form-group">
                                <div class="col-md-6 paddin-npt padding-right-15">
                                        <label class="control-label">Address line 1:</label>
                                         <input type="text" name="address1" value="{{ $userData->address1 }}" class="form-control" placeholder="Enter your Address Line 1" />
                                    </div>
                                <div class="col-md-6 paddin-npt">
                                    <label class="control-label">Address line 2:</label>
                                    <input type="text" name="address2" value="{{ $userData->address2 }}" class="form-control" placeholder="Enter your Address Line 2" />
                                </div>
                                </div>-->

                            <div class="form-group col-md-12">
                                <div class="col-md-12 paddin-npt" id="locationField">
                                    <label class="control-label">Type and select your City:</label>
                                    <input type="text" id="autocomplete" name="multi_select_items" onFocus="geolocate()" value="{{$userAddress}}"  placeholder="Enter address" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-4 paddin-npt padding-right-15 wideField">
                                <label class="control-label">City Name:</label>
                                <input type="text" name="city" id="locality"  class="form-control field" @if(Request::old('city')) value="{{Request::old('city')}}" @else value="{{ $userData->city }}" @endif placeholder="Enter your City name" />
                            </div>

                            <div id="multi-items">
                                <div class="form-group">
                                    <div class="col-md-4 paddin-npt padding-right-15 wideField wideField">
                                        <label class="control-label">State:</label>
                                        <input type="text" name="state" id="administrative_area_level_1" class="form-control field" @if(Request::old('state')) value="{{Request::old('state')}}" @else value="{{ $userData->state }}" @endif placeholder="Enter your State name" />
                                    </div>
                                    <div class="col-md-4 paddin-npt padding-right-15 wideField">
                                        <label class="control-label"><b>Zip Code:</b></label>
                                        <input type="text" name="zip" id="postal_code" @if(Request::old('zip')) value="{{Request::old('zip')}}" @else value="{{ $userData->zip }}" @endif class="form-control field" placeholder="Enter your Zip Code" />
                                    </div>
                                    <div class="col-md-4 paddin-npt wideField">
                                        <label class="control-label">Country:</label>
                                        <select name="country" class="form-control selectCountry field" id="country" >
                                            <option value="">Please Select Country</option>
                                            @if(Request::old('country'))
                                            @foreach($countries as $country)
                                            @if($country->country_name == Request::old('country'))
                                            <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                                            @else
                                            <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                            @endif
                                            @endforeach
                                            @else
                                            @foreach($countries as $country)
                                            @if($userData->country == $country->country_name)
                                            <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                                            @else
                                            <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                            @endif
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 paddin-npt padding-right-15">
                                    <label class="control-label">Phone Number:</label>
                                    <input type="text" name="phone" id="mask_phone" @if(Request::old('phone')) value="{{Request::old('phone')}}" @else value="{{ $userData->phone }}" @endif class="form-control" placeholder="Enter your Phone Number" />
                                </div>
                                <div class="col-md-6 paddin-npt padding-right-15">

                                    <label class="control-label">Fax Number:<span style="font-size: 14px;vertical-align: top; red"> (optional)</span></label>

                                    <input type="text" name="fax" @if(Request::old('fax')) value="{{Request::old('fax')}}" @else value="{{$userData->fax}}" @endif class="form-control" placeholder="Enter your Fax">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 paddin-npt padding-right-15">
                                    <label class="control-label">Skype Username:<span style="font-size: 14px;vertical-align: top; red"> (optional)</span></label>
                                    <input type="text" name="skype_id" @if(Request::old('skype_id')) value="{{Request::old('skype_id')}}" @else value="{{$userData->skype_id}}" @endif class="form-control" placeholder="Enter your Skype Id">
                                </div>
                                <div class="col-md-6 paddin-npt">
                                    <label class="control-label">E-mail Address:</label>
                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" readonly />
                                </div>
                                <p>
                                <!-- Carrer Section -->
                            </div>
                        </div>
                        <div class="form-body padding-15">
                            <h3 class="block bold font-red-mint align-left"><span>Professional Information</span></h3>
                            <div class="form-group">
                                <div class="col-md-12 paddin-npt">
                                    <label class="control-label">Your Current Position:</label>
                                    <input type="text" name="current_position" @if(Request::old('current_position')) value="{{Request::old('current_position')}}" @else value="{{ $userData->current_position }}" @endif class="form-control" placeholder="Enter your current Position at your workplace" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 paddin-npt padding-right-15">
                                    <label for="inputEmail3" class="control-label">Select Your Main Industry:</label>
                                    <select name="user_industry" class="form-control selectMainIndustry" id="main-industry-dropdown">
                                        <option value="">Please Select Country</option>
                                        @if(Request::old('user_industry'))
                                        @foreach($indutries as $indutry)
                                        @if($indutry->id == Request::old('user_industry'))
                                        <option value="{{$indutry->id}}" selected="">{{$indutry->name}}</option>
                                        @else
                                        <option value="{{$indutry->id}}">{{$indutry->name}}</option>
                                        @endif
                                        @endforeach
                                        @else
                                        @foreach($indutries as $indutry)
                                        @if($userData->industry_id == $indutry->id)
                                        <option value="{{$indutry->id}}" selected="">{{$indutry->name}}</option>
                                        @else
                                        <option value="{{$indutry->id}}">{{$indutry->name}}</option>
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 paddin-npt">
                                    <label for="inputEmail3" class="control-label">Select Additional Industries applicable to your Profile:</label>
                                    <select name="user_additional_industries[]" class="form-control selectAdditionalIndustry" id="additional-industry-dropdown" multiple="">
                                        <option value="">Please Select Your Country</option>
                                        @if(Request::old('user_additional_industries'))
                                        @foreach($indutries as $indutry)
                                        @if(in_array($indutry->id,Request::old('user_additional_industries')))
                                        <option value="{{$indutry->id}}" selected="">{{$indutry->name}}</option>
                                        @else
                                        <option value="{{$indutry->id}}">{{$indutry->name}}</option>
                                        @endif
                                        @endforeach
                                        @else
                                        @foreach($indutries as $indutry)
                                        @if(in_array($indutry->id,$selectedAdditionlIndustries))
                                        <option value="{{$indutry->id}}" selected="">{{$indutry->name}}</option>
                                        @else
                                        <option value="{{$indutry->id}}">{{$indutry->name}}</option>
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 paddin-npt">
                                    <label class="control-label">Add a headline to your User Profile:</label>
                                    <input type="text" name="slogan" maxlength="100" class="form-control" @if(Request::old('slogan')) value="{{Request::old('slogan')}}" @else value="{{ $userData->profile_slogan }}" @endif  placeholder="Write 15-30 words headline for your profile" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 paddin-npt">
                                    <label class="control-label">Give a Brief Introduction about yourself:</label>
                                    <textarea name="about" rows="3" maxlength="300" placeholder="Enter 3-5 lines about yourself, your career, industry and product offerings" class="form-control">
                                        @if(Request::old('about')) {{Request::old('about')}} @else {{$userData->about}} @endif</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Add your Skills and Expertise to your Profile:</label>
                                <input type="text" name="specification" @if(Request::old('specification')) value="{{Request::old('specification')}}" @else value="{{$userData->specification}}" @endif data-role="tagsinput" id="taginputinnew" placeholder="Type and select or add new keywords." />
                            </div>
                            <!--<div class="col-md-6">
                                <label class="control-label">Languages Spoken:</label>
                                     <select name="language[]" class="form-control selectLanguage" multiple="">
                                   <option value="">Please Select Country</option>
                                    @foreach($languages as $language)
                                       @if(in_array($language->name,$selecteLanguageArray))
                                    <option value="{{$language->name}}" selected="">{{$language->name}}</option>
                                     @else
                                    <option value="{{$language->name}}">{{$language->name}}</option>
                                    @endif
                                 @endforeach
                                </select>
                            </div>-->
                            <div class="form-group">
                                <div class="col-md-12 paddin-npt">
                                    <label for="inputEmail3" class="control-label">Which Products and Categories are you most interested in Purchasing or Supplying?</label>
                                    <select id="select2-button-addons-single-input-group-sm" name="user_categories[]" class="form-control col-md-12 js-data-usercategories-ajax" multiple>
                                        @foreach(Auth::user()->userCategories as $category)
                                        <option selected="" value="{{$category->category_id}}">{{$category->CategoryData->name}}</option>
                                        @endforeach
                                    </select>
                                     <span class="help-block margin-top">These products and categories will be showcased on your User Profile.</span>
                                     
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 paddin-npt">Do you offer any Industrial Services? Search and Add them here:</label>
                                <div class="col-md-12 paddin-npt">
                                    <select id="user_techservice" name="user_techservice[]" class="form-control selectUserTechService" multiple>
                                        <option></option>
                                        @if(Request::old('user_techservice'))
                                        @foreach($techServices as $techService)
                                        @if(in_array($techService->id,Request::old('user_techservice')))
                                        <option value="{{$techService->id}}" selected="">{{$techService->name}}</option>
                                        @else
                                        <option value="{{$techService->id}}">{{$techService->name}}</option>
                                        @endif
                                        @endforeach
                                        @else
                                        @foreach($techServices as $techService)
                                        @if(in_array($techService->id,$selectedUserTech))
                                        <option value="{{$techService->id}}" selected="">{{$techService->name}}</option>
                                        @else
                                        <option value="{{$techService->id}}">{{$techService->name}}</option>
                                        @endif
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <p>
                            <div class="form-actions right padding-top align-right">
                                <!--<button type="submit" class="btn btn-circle blue">
                                      <i class="fa fa-check"></i> Save</button>-->
                                <!--<button type="button" onclick="SaveProfile('company')" class="btn btn-danger"> Save And Setup Your Company Profile</button>
                                    <button type="button" onclick="SaveProfile('finish')" class="btn btn-circle yellow-crusta color-black"> Save and Finish Later</button>-->
                                <button type="submit" class="btn btn-circle yellow-crusta color-black button-next"> Continue to Additional Information
                                    <i class="fa fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </p>
        </p>
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
        country: 'long_name',
        postal_code: 'short_name'
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

        $('#multi-items').show();
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
    function SaveProfile(next){
        $('#next-after-profile').val(next);
        $('#wizard-profile').submit();
    }

    jQuery(document).ready(function() {
        var placeholder = "Select your Country";
        $(".selectCountry").select2({
            placeholder: placeholder,
            width: null
        });
        var mainIndplaceholder = "Type and select one industry";
        $(".selectMainIndustry").select2({
            placeholder: mainIndplaceholder,
            width: null
        });
        var additionaIndplaceholder = "Type and select one or more industries";
        $(".selectAdditionalIndustry").select2({
            placeholder: additionaIndplaceholder,
            width: null
        });
        var languagePlaceholder = "Select a Langauges";
        $(".selectLanguage").select2({
            placeholder: languagePlaceholder,
            width: null
        });
        var userTechplaceholder = "Type and Select the Most Applicable Services";
        $(".selectUserTechService").select2({
            placeholder: userTechplaceholder,
            width: null
        });
        var citynames = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),      queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: "{{url('skills-expertise/options')}}",
                filter: function(list) {
                    return $.map(list, function(cityname) {
                        return { name: cityname
                        };
                    });
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
    });

    function formatRepo(repo) {
        if (repo.loading) return repo.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" + repo.full_name +"</div>";
        markup += "</div></div>";
        return markup;}
    function formatRepoSelection(repo) {
        return repo.full_name || repo.text;
    }
    var categoryPlaceholder = "Type and select up to thirty items";

    $(".js-data-usercategories-ajax").select2({
        placeholder: categoryPlaceholder,
        width: "off",
        ajax : {
            url: "{{url('user/category/search')}}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                    // search term
                    //  page: params.page
                    //    };
                    //   },
                    //      processResults: function(data, page) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data            return {
                    //            results: data.items
                    // };
                    // },
                    // cache: true    },    escapeMarkup: function(markup) {
                    //    return markup;
                    // }, // let our custom formatter work    minimumInputLength: 1,    templateResult: formatRepo,    templateSelection: formatRepoSelection}).change(function() {        if ($("#select2-button-addons-single-input-group-sm option:selected").length > 11) {            alert("You have already listed 12 items, the maximum selection amount allowed.");            $(this).removeAttr("selected");        }    });$(".select2, .select2-multiple, .select2-allow-clear, .js-data-example-ajax").on("select2:open", function() {    if ($(this).parents("[class*='has-']").length) {        var classNames = $(this).parents("[class*='has-']")[0].className.split(/\s+/);        for (var i = 0; i < classNames.length; ++i) {            if (classNames[i].match("has-")) {                $("body > .select2-container").addClass(classNames[i]);            }        }    }});$(".js-btn-set-scaling-classes").on("click", function() {    $("#select2-multiple-input-sm, #select2-single-input-sm").next(".select2-container--bootstrap").addClass("input-sm");    $("#select2-multiple-input-lg, #select2-single-input-lg").next(".select2-container--bootstrap").addClass("input-lg");    $(this).removeClass("btn-primary btn-outline").prop("disabled", true);});
                }
            }
        }
    });

</script>

<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}" type="text/javascript">
</script><script src="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>
<!--<script src="{{URL::asset('metronic/pages/scripts/form-wizard.min.js')}}" type="text/javascript"></script>-->

@endsection






