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

<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-plus color-black"></i> Create Your Company Profile
</h3>
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
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="col-md-12 padding-top">
                    <p class="caption-helper">Create your company profile and start taking advantage of Indy John's buying features and tools.</p>
                </div>
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
                
                <!-- BEGIN FORM-->
                {!! Form::open([
                'route' => 'companies.store',
                'id' => 'submit_form',
                'class' => 'horizontal-form form-horizontal form-row-seperated'
                ]) !!}
                <input type="hidden" id="formtype" name="formtype" value="additional" />
                @if(isset($_REQUEST['setup']))
                <input type="hidden" name="profile_first_time" value="1" />
                @endif
                <div class="form-body padding-15">
                    <div id="main-company-details">
                        
                        <h3 class="block bold font-red-mint align-left"><span style="font-size: 19px!important;">Enter your Company Information</span></h3>
                        <div class="row">
                            <div class="col-md-6" style="display: none;">
                                <div class="form-group">
                                    <label class="control-label">Company Package</label>
                                    <span class="required" aria-required="true"> * </span>
                                    <select data-required="1" type="text" id="account_id" name="account_id" class="form-control" placeholder="Establishment Year">
                                        @foreach($packages as $index => $package)
                                            @if(Request::old('account_id') == $package->id)
                                            <option value="{{ $package->id }}" selected="">{{$package->name}}</option>
                                            @elseif($index == 0)
                                            <option value="{{ $package->id }}" selected="">{{$package->name}}</option>
                                            @else
                                            <option value="{{ $package->id }}">{{$package->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display: none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Active</label><br/>
                                    <input name="is_Active" value="1" type="checkbox" checked class="make-switch form-control" data-size="small">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Subscription Type</label>
                                    <select disabled data-required="1" type="text" id="subscription_type" name="subscription_type" class="form-control" placeholder="Establishment Year">
                                        <option value="">N/A</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="annually">Annually</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 bold paddin-npt">Company Name:</label>
                            <div class="col-md-12 paddin-npt">
                                <input data-required="1" type="text" id="name" name="name" value="{{Request::old('name')}}" class="form-control" placeholder="Enter your Company Name">
                            </div>
                        </div>
                        
                        <h3 class="block bold font-red-mint align-left"><span style="font-size: 19px!important;">Company Contact Information</span></h3>

                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right-15">
                                <label class="col-md-12 paddin-npt">Company E-mail Address:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input data-required="1" type="text" name="email" value="{{Request::old('email')}}" class="form-control" placeholder="Enter your Company E-mail Address">
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">Website:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input data-required="1" type="text" name="website" value="{{Request::old('website')}}" class="form-control" placeholder="Enter your Website Address">
                                </div>
                            </div>
                        </div>
                        <label class="control-label">Enter Your Address:</label>
                        <div class="form-group">
                            <div class="col-md-12 paddin-npt" id="locationField" >
                                <input type="text" id="autocomplete" class="form-control" onFocus="geolocate()" value=""  placeholder="Type to Search" >
                            </div>
                        </div>
                        <div id="multi-items" style="display: none">
                            <div class="form-group">
                                <div class="col-md-6 paddin-npt padding-right-15">
                                    <label class="col-md-12 paddin-npt">Address Line 1:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input type="text" id="route" name="address" class="form-control" value="{{Request::old('address')}}" placeholder="Enter your Company Address Line 1" />
                                    </div>
                                </div>
                                <div class="col-md-6 paddin-npt">
                                    <label class="col-md-12 paddin-npt">Address Line 2:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input  type="text" id="premise" name="address2" class="form-control" value="{{Request::old('address2')}}" placeholder="Enter your Company Address Line 2" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 paddin-npt padding-right-15">
                                    <label class="col-md-12 paddin-npt">City:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input data-required="1" type="text" id="locality" name="city" value="{{Request::old('city')}}" class="form-control" placeholder="Enter the City Name">
                                    </div>
                                </div>
                                <div class="col-md-3 paddin-npt padding-right-15">
                                    <label class="col-md-12 paddin-npt">State:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input data-required="1" type="text" id="administrative_area_level_1" name="state" value="{{Request::old('state')}}" class="form-control" placeholder="Enter the State Name">
                                    </div>
                                </div>
                                <div class="col-md-3 paddin-npt padding-right-15">
                                    <label class="col-md-12 paddin-npt">Zip Code:</label>
                                    <div class="col-md-12 paddin-npt">
                                        <input data-required="1" id="postal_code" type="text" name="zip" value="{{Request::old('zip')}}" class="form-control" placeholder="Enter your Zip code">
                                    </div>
                                </div>
                                <div class="col-md-3 paddin-npt">
                                    <label class="col-md-12 paddin-npt">Country</label>
                                    <div class="col-md-12 paddin-npt">
                                        <select id="country" name="country" class="form-control selectCountry">
                                            <option></option>
                                            @foreach($countries as $country)
                                            @if(Request::old('country') == $country->country_name)
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
                                    <input data-required="1" type="text" name="phone" value="{{Request::old('phone')}}" class="form-control" placeholder="Enter your company phone number. Use format +1 (213) 000-0000">
                                </div>
                            </div>
                            <div class="col-md-6 paddin-npt">
                                <label class="col-md-12 paddin-npt">Fax Number:</label>
                                <div class="col-md-12 paddin-npt">
                                    <input type="text" name="fax" value="{{Request::old('fax')}}" class="form-control" placeholder="Enter your company fax number. Use format +1 (213) 000-0000">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right-15">
                                <label class="control-label">Skype Username:</label>
                                <input type="text" name="skype_id" value="{{Request::old('skype_id')}}" class="form-control" placeholder="Enter your Skype Id">
                            </div>
                        </div>                    
                    </div>
                </div>
                <div id="sub-action-button" class="form-actions right padding-top align-right">
                    <!--<button type="button" onclick="formSubmite('additional')" class="btn btn-danger button-next"> View Optional Information
                        <i class="fa fa-angle-right"></i>
                    </button>-->
                    @if(isset($_REQUEST['setup']))
                    <a href="{{url('user-dashboard')}}" id="show-dashboad-select" class="btn btn-danger bold"> Skip Company Setup </a>
                    @endif
                    <button type="submit" class="btn btn-circle yellow-crusta color-black bold"> Continue <i class="fa fa fa-angle-right"></i></button>
                </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
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
        premise: 'long_name',
        route: 'long_name',
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
/* for show menu active */
$("#compnay-main-menu").addClass("active");
$('#compnay-main-menu' ).click();
$('#conpmay-menu-arrow').addClass('open');
$('#create-compnay-menu').addClass('active');
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
    
    
    
    
});


</script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
