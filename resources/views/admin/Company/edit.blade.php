@extends('admin.app')

@section('content')
<style>
.select2-container{display: block!important;}
.mt-element-step .step-line .mt-step-title{font-size: 17px!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>
            @else
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
            @endif
        </li>
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url()}}/companies">Companies</a>
            <i class="fa fa-circle"></i>
            @elseif(Auth::user()->access_level == 4)
            <a href="{{url('company/view')}}">Company</a>
            <i class="fa fa-circle"></i>
            @else
                @if(!empty($company))
                <a href="{{url()}}/companies/{{$company->id}}">Companies</a>
                <i class="fa fa-circle"></i>
                @endif
            @endif
        </li>
        <li>
            <span>Edit Company</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">

<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
@if(!empty($company))
                        <i class="fa fa-gift"></i> Edit {{$company->name}} Company Profile
                    @else
                        <i class="fa fa-gift"></i> Edit Company
                    @endif
</h3>
</div>
</div>
<div class="row">     
<div class="col-md-12">  
<div class="col-md-12">     
            <div  class="portlet-body form">
                @if(!empty($company))       
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="mt-element-step">
                    <div class="row step-line">
                        <div id="company-first" class="col-md-3 mt-step-col first active">
                            <div class="mt-step-number bg-white">1</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Contact Information</div>
                        </div>
                        <div id="company-forth" class="col-md-3 mt-step-col">
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
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- BEGIN FORM-->
                {!! Form::model($company, [
                    'method' => 'PATCH',
                    'id' => 'submit_form',
                    'route' => ['companies.update', $company->id],
                    'class' => 'horizontal-form form-horizontal form-row-seperated'
                    ]) !!}
                <input type="hidden" id="formtype" name="formtype" value="savecompany" />
                @if(isset($_REQUEST['setup']))
                <input type="hidden" name="profile_first_time" value="1" />
                @endif
                <div class="form-body padding-15">
                    <div id="main-company-details">
                        <h3 class="block bold align-left"><span style="font-size: 19px!important;">Enter your Company Information</span></h3>
                        <div class="form-group">
                            <label class="col-md-12 bold paddin-npt">Company Name</label>
                            <div class="col-md-12 paddin-npt">
                                <input data-required="1" type="text" id="name" name="name" value="{{$company->name}}" class="form-control" placeholder="Enter your Company Name">
                            </div>
                        </div>
                        <h3 class="block bold align-left"><span style="font-size: 19px!important;">Company Contact Information</span></h3>

                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right-15">
                                <label class="col-md-12 paddin-npt">Company E-mail Address:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input data-required="1" type="text" name="email" value="{{$company->email}}" class="form-control" placeholder="Enter your Company E-mail Address">
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">Website</label>
                                <div class="col-md-12 paddin-npt">
                                    <input data-required="1" type="text" name="website" value="{{$company->website}}" class="form-control" placeholder="Enter your Website Address">
                                </div>
                            </div>
                        </div>

                        <label class="control-label">Enter Your Address:</label>
                        <div class="form-group">
                            <div class="col-md-12 paddin-npt" id="locationField" >
                                <input type="text" id="autocomplete" class="form-control" onFocus="geolocate()" @if($company->address != '' && $company->address2 != '') value="{{$company->address}}, {{$company->address2}}, {{$company->city}}, {{$company->state}}, {{$company->zip}}, {{$company->country}}" @elseif($company->address == '') value="{{$company->address2}}, {{$company->city}}, {{$company->state}}, {{$company->zip}}, {{$company->country}}" @elseif($company->address2 == '') value="{{$company->address}}, {{$company->city}}, {{$company->state}}, {{$company->zip}}, {{$company->country}}" @elseif($company->address == '' && $company->address2 == '') value="{{$company->city}}, {{$company->state}}, {{$company->zip}}, {{$company->country}}" @else value="" @endif  placeholder="Type to Search" >
                            </div>

                        </div>

                        <div id="multi-items">
                        <div class="form-group">
                                <div class="col-md-6 paddin-npt padding-right-15">
                                    <label class="col-md-12 paddin-npt">Address Line 1:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <textarea data-required="1" id="street_number" name="address" class="form-control" placeholder="Enter your Company Address Line 1">{{$company->address}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 paddin-npt">
                                    <label class="col-md-12 paddin-npt">Address Line 2:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <textarea id="route" name="address2" class="form-control" placeholder="Company Address Line 2:">{{$company->address2}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 paddin-npt padding-right-15">
                                    <label class="col-md-12 paddin-npt">City:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input data-required="1" id="locality" type="text" name="city" value="{{$company->city}}" class="form-control" placeholder="Enter the City Name">
                                    </div>
                                </div>
                                <div class="col-md-3 paddin-npt padding-right-15">
                                    <label class="col-md-12 paddin-npt">State:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input data-required="1" id="administrative_area_level_1"  type="text" name="state" value="{{$company->state}}" class="form-control" placeholder="Enter the State Name">
                                    </div>
                                </div>
                                <div class="col-md-3 paddin-npt padding-right-15">
                                    <label class="col-md-12 paddin-npt">Zip Code:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input data-required="1" id="postal_code" type="text" name="zip" value="{{$company->zip}}" class="form-control" placeholder="Enter your Zip code">
                                    </div>
                                </div>
                                <div class="col-md-3 paddin-npt">
                                    <label class="col-md-12 paddin-npt">Country:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select id="country" name="country" class="form-control selectCountry">
                                            <option></option>
                                            @foreach($countries as $country)
                                            @if($company->country == $country->country_name)
                                            <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>
                                            @else
                                            <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right-15">
                                <label class="col-md-12 paddin-npt">Company Phone Number:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input data-required="1" type="text" name="phone" value="{{$company->phone}}" class="form-control" placeholder="Enter your company phone number">
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">Fax Number:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="fax" value="{{$company->fax}}" class="form-control" placeholder="Enter your company fax number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right-15">
                                <label class="control-label">Skype Username:</label>
                                <input type="text" name="skype_id" value="{{$company->skype_id}}" class="form-control" placeholder="Enter your Skype Id">
                            </div>
                        </div>                 
                    </div>
                </div>
                <div id="sub-action-button" class="form-actions right padding-top align-right">
                    <button type="button" onclick="formSubmite('additional')" class="btn btn-danger button-next"> View Optional Information
                        <i class="fa fa-angle-right"></i>
                    </button>
                    <button type="button" onclick="formSubmite('savecompany')" class="btn btn-circle button-submit yellow-crusta color-black bold"> <i class="fa fa-check"></i> Save and Continue</button>
                </div>
                {!! Form::close() !!}
                <!-- END FORM-->
                @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12 padding-top">
                            <p>No Company assign yet.</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            </div>
            </div>
       </div>
<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6bkZqMRGyPwECqAnwqQapOX94md7Y9UY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        route: 'long_name',
        //premise: 'short_name',
        street_number: 'short_name',
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
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        //var premiseOrStreetNo = place.address_components[0].types[0];
        //user.setId;
        //$('textarea[name=address]').setAttribute("id","premise");

        for (var component in componentForm) {
            if(component == 'country'){
                $(".selectCountry").select2('val','')
            }
            else
            {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        var addressLine1 = '';
        var addressLine2 = '';
        var formattedAddressLine = false;

        for (var i = 0; i < place.address_components.length; i++) {

            var addressType = place.address_components[i].types[0];

            if(addressType == 'street_number' || addressType == 'premise'){
                addressLine1 = addressLine1 + place.address_components[i]['long_name'];
            }
            if(addressType == 'route'){
                addressLine1 = addressLine1+','+ place.address_components[i]['long_name'];
                formattedAddressLine = true;
            }

            if(addressType == 'sublocality_level_2'){
                addressLine2 = place.address_components[i]['long_name'];
            }

            if (componentForm[addressType]) {
                if(addressType == 'country'){
                    var val = place.address_components[i][componentForm[addressType]];
                    $(".selectCountry").select2('val',val)
                }
                else
                {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

        if(formattedAddressLine == true){
            document.getElementById('street_number').value = addressLine1;
            document.getElementById('route').value = addressLine2;
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
/* for show menu active */
$("#compnay-main-menu").addClass("active");
$('#compnay-main-menu' ).click();
$('#conpmay-menu-arrow').addClass('open');
$("#admin-company-menu").addClass("active");
$('#admin-company-menu' ).click();
$('#edit-company-menu').addClass('active');
/* end menu active */

function formSubmite(str)
{
    $('#formtype').val(str);
    $('#submit_form').submit();
}

$(document).on("keyup", "#name", function () {
    if($('#account_id').val() == 1){
        return;
    }
    var val = $('#name').val();
    val = val.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
    $('#unique_company_url').val(val);
});

$( "#account_id" ).change(function() {
    if($('#account_id').val() == 1){
        $('#unique_company_url').val("");
        $("#unique_company_url").prop("readonly", true);
        $("#subscription_type").prop("disabled", true);
    }else{
        $("#unique_company_url").prop("readonly", false);
        var val = $('#name').val();
        val = val.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
        $('#unique_company_url').val(val);
        $("#subscription_type").prop("disabled", false);
    }
});


jQuery(document).ready(function() {

    var placeholder = "Select a Language";

    $(".selectLanguage").select2({
        placeholder: placeholder,
        width: null
    });

    var countryplaceholder = "Select Country";

    $(".selectCountry").select2({
        placeholder: countryplaceholder,
        width: null
    });

    var companyTypeplaceholder = "Type and Select the Most Applicable";

    $(".selectCompanyType").select2({
        placeholder: companyTypeplaceholder,
        width: null
    });

    var companyTechplaceholder = "Type and Select the Most Applicable Services";

    $(".selectCompanyTechService").select2({
        placeholder: companyTechplaceholder,
        width: null
    });


});

function formatRepo(repo) {
    if (repo.loading) return repo.text;

    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.full_name +"</div>";

    markup += "</div></div>";

    return markup;
}

function formatRepoSelection(repo) {
    return repo.full_name || repo.text;
}
var categoryPlaceholder = "Type and select up to 12 items";
$(".js-data-category-ajax").select2({
    placeholder: categoryPlaceholder,
    width: "off",
    ajax: {
        url: "{{url()}}/marketplaceproducts/info/category/search",
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function(data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
                results: data.items
            };
        },
        cache: true
    },
    escapeMarkup: function(markup) {
        return markup;
    }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});
$(".js-data-industry-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/marketplaceproducts/info/industry/search",
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term, // search term
                page: params.page
            };
        },
        processResults: function(data, page) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
                results: data.items
            };
        },
        cache: true
    },
    escapeMarkup: function(markup) {
        return markup;
    }, // let our custom formatter work
    minimumInputLength: 1,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection
});
$(".select2, .select2-multiple, .select2-allow-clear, .js-data-example-ajax").on("select2:open", function() {
            if ($(this).parents("[class*='has-']").length) {
                var classNames = $(this).parents("[class*='has-']")[0].className.split(/\s+/);

                for (var i = 0; i < classNames.length; ++i) {
                    if (classNames[i].match("has-")) {
                        $("body > .select2-container").addClass(classNames[i]);
                    }
                }
            }
        });

        $(".js-btn-set-scaling-classes").on("click", function() {
            $("#select2-multiple-input-sm, #select2-single-input-sm").next(".select2-container--bootstrap").addClass("input-sm");
            $("#select2-multiple-input-lg, #select2-single-input-lg").next(".select2-container--bootstrap").addClass("input-lg");
            $(this).removeClass("btn-primary btn-outline").prop("disabled", true);
        });
jQuery(document).ready(function() {

   var placeholder = "Type and Select One or more industries";
    $(".selectIndustry").select2({
            placeholder: placeholder,
            width: null
        });
});
</script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
