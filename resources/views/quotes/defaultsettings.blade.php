@extends('buyer.app')

@section('content')
<style>
.bootstrap-tagsinput {
  width: 100% !important;
}
.select2-container{display: block!important;}
.ms-container{width: 100%!important;}
.select2-container--default .select2-results__option[aria-selected=true]{display: none!important;}
.form-group{border-bottom: 1px solid #eef1f5!important;}
.fileinput{margin-bottom: 0px!important;}
.form-horizontal .form-group{margin-left: 15px!important;margin-right: 15px!important;}
.mt-element-step .step-line .mt-step-title{font-size: 17px!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/typeahead/typeahead.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('user-dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url('request-product-quotes')}}">Marketplace Products</a>
            <i class="fa fa-cogs"></i>
        </li>
        <li>
            <span>Buy Request Default Settings</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">

<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-cogs color-black"></i> Buy Request Default Settings
</h3>
</div>
</div>
<div class="row">
    <div class="col-md-12">
            <div class="portlet-body form">
                
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
               <div class="col-md-12 margin-top-15">
<span class="caption-helper"><b>There is no need to repeatedly enter optional fields in your Buy Requests.  Set your Buy Request default settings in this section and they will appear on all your future Buy Request submissions. These fields contain optional information that can be sent with your Buy Request.</b></span></div>
<div class="clearfix"></div>
<div class="col-md-12 margin-top-15">
<div class="black_line"></div>
</div>
                <!-- BEGIN FORM-->
                <form method="post" action="{{url('quote/defaultsettings/save')}}" class="horizontal-form form-horizontal">
                    <div class="form-body">
                        <input type="hidden" name="user_id" class="form-control" value="{{$user_id}}" >
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">


 <h3 class="col-md-12 paddin-npt font-red-mint margin-top-15">Diversity Preferences:</h3>


                         
<p>Does your organization give priority to certain organization members? Select the organizations if so. You can also set these to apply to all your requests in the "Default Settings".</p><p>

   <label class="col-md-12 paddin-npt">Any Diversity Preference:</label>
                            <div class="col-md-12 paddin-npt">
                                <div class="pull-left text-center margin-bottom" style="width:45%"><div class="row"><b>All Available</b></div></div>
                                <div class="pull-right text-center margin-bottom" style="width:45%"><div class="row"><b>Selected Options</b></div></div>
                                <select multiple="multiple" class="multi-select" id="diversity_options" name="diversity_options[]">
                                    @if(!empty($default['default_diversity']))
                                    @foreach($default['default_diversity'] as $default_diversity)
                                        <option value="{{$default_diversity['id']}}" selected="">{{$default_diversity['name']}}</option>
                                    @endforeach
                                    @endif
                                    @foreach($default['all_diversity'] as $diversity)
                                        <option value="{{$diversity->id}}">{{$diversity->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block margin-top-10"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Add a Diversity Option:</label>
                            <div class="col-md-12 paddin-npt">
                                <input type="text" name="other_diversity" value="" data-role="tagsinput" placeholder="Unable to find an organization? You can add one here."  style="width: 100%!important;">
                               
                            </div>
                        </div>

<div class="col-md-12"><div class="black_line"></div></div>
 <div class="form-group">


 <h3 class="col-md-12 paddin-npt font-red-mint">Accreditation or Certification Preferences:</h3>


                         
<p>Set Accreditation and Certification requirements for your Buy Requests.</p><p>


                       
                              <label class="col-md-12 paddin-npt">Required Product Accreditations or Certifications:<span style="font-size: 12px;vertical-align: top;"> (optional)</span></label>
                            <div class="col-md-12 paddin-npt">
                                <select id="select2-button-addons-single-input-group-sm" name="accredations[]" class="form-control col-md-12 js-data-accrediton-ajax"  multiple>
                                    @if(!empty($default['default_acccreditations']))
                                    @foreach($default['default_acccreditations'] as $default_acccreditation)
                                        <option value="{{$default_acccreditation['id']}}" selected="">{{$default_acccreditation['name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                               <!-- <span class="help-block margin-top">Are you requesting any Product Accreditations or Certifications? </span> -->
                               <span class="help-block margin-top-10"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Add a Product Accreditation or Certification Requirement:</label>
                            <div class="col-md-12 paddin-npt">
                                <input type="text" name="other_accreditation" value="" data-role="tagsinput" style="width: 100%!important;" placeholder="Unable to find your required Accreditation? You can add your own with this setting.">
                            
                            </div>
                        </div>
                      <div class="col-md-12">  <div class="black_line"></div></div>
                        <div class="form-group">

 <h3 class="col-md-12 paddin-npt font-red-mint">Additional Preferences:</h3>


                         
<p>Set Additional Preferences for your Buy Requests.</p><p>

                            <label class="col-md-12 paddin-npt">Adjust the privacy setting of your Buy Request:</label>
                            <div class="col-md-12 paddin-npt">
                                <select name="privacy" class="form-control" placeholder="Privacy Setting">
                                    <option value="1" @if($default['privacy'] == 1) selected="selected" @endif>Open to the General Public</option>
                                    <option value="2" @if($default['privacy'] == 2 || $default['privacy'] == '') selected="selected" @endif>All Free and Valued Suppliers</option>
                                    <option value="3" @if($default['privacy'] == 3) selected="selected" @endif>Valued Suppliers Only</option>
                                </select>
<span class="help-block margin-top-10"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Limit your Supplier Reach:</label>
                            <div class="col-md-12 paddin-npt">
                                <select name="request_area" class="form-control" placeholder="Request Area">
                                    <option value="1" @if($default['request_area'] == 1) selected="selected" @endif>Local</option>
                                    <option value="2" @if($default['request_area'] == 2) selected="selected" @endif>State</option>
                                    <option value="3" @if($default['request_area'] == 3) selected="selected" @endif>Country</option>
                                    <option value="4" @if($default['request_area'] == 4 || $default['request_area'] == '') selected="selected" @endif>International</option>                                    
                                </select>
                               <span class="help-block margin-top-10"></span>
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label class="col-md-12 paddin-npt">Required Technical Specifications & Product Options:</label>
                            <div class="col-md-12 paddin-npt">
                                <textarea name="specifications" class="form-control" placeholder="Describe your Specific Requirements and Desired Technical Specifications">{{$default['specifications']}}</textarea>
              
                            </div>
                        </div>
                        -->

                        <div class="col-md-12">  <div class="black_line"></div></div>
                        <div class="form-group">
                            <h3 class="col-md-12 paddin-npt font-red-mint">Default Shipping Address:</h3>

                            <p>Enter a default shipping address for your Buy Requests.</p><p>

                            <label class="col-md-12 paddin-npt">Enter Your Address:</label>
                            <div class="col-md-12 paddin-npt" id="locationField" >
                                <input type="text" id="autocomplete" class="form-control" onFocus="geolocate()" @if($defaultSettings->address != '' && $defaultSettings->address2 != '') value="{{$defaultSettings->address}}, {{$defaultSettings->address2}}, {{$defaultSettings->city}}, {{$defaultSettings->state}}, {{$defaultSettings->zip}}, {{$defaultSettings->country}}" @elseif($defaultSettings->address == '') value="{{$defaultSettings->address2}}, {{$defaultSettings->city}}, {{$defaultSettings->state}}, {{$defaultSettings->zip}}, {{$defaultSettings->country}}" @elseif($defaultSettings->address2 == '') value="{{$defaultSettings->address}}, {{$defaultSettings->city}}, {{$defaultSettings->state}}, {{$defaultSettings->zip}}, {{$defaultSettings->country}}" @elseif($defaultSettings->address == '' && $defaultSettings->address2 == '') value="{{$defaultSettings->city}}, {{$defaultSettings->state}}, {{$defaultSettings->zip}}, {{$defaultSettings->country}}" @else value="" @endif  placeholder="Type to Search" >
                            </div>
                        </div>

                            <div id="multi-items">
                                <div class="form-group">
                                    <div class="col-md-6 paddin-npt padding-right-15">
                                        <label class="col-md-12 paddin-npt">Address Line 1:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <textarea data-required="1" id="street_number" name="address" class="form-control" placeholder="Enter your Company Address Line 1">{{$defaultSettings->address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 paddin-npt">
                                        <label class="col-md-12 paddin-npt">Address Line 2:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <textarea id="route" name="address2" class="form-control" placeholder="Company Address Line 2:">{{$defaultSettings->address2}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3 paddin-npt padding-right-15">
                                        <label class="col-md-12 paddin-npt">City:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <input data-required="1" id="locality" type="text" name="city" value="{{$defaultSettings->city}}" class="form-control" placeholder="Enter the City Name">
                                        </div>
                                    </div>
                                    <div class="col-md-3 paddin-npt padding-right-15">
                                        <label class="col-md-12 paddin-npt">State:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <input data-required="1" id="administrative_area_level_1"  type="text" name="state" value="{{$defaultSettings->state}}" class="form-control" placeholder="Enter the State Name">
                                        </div>
                                    </div>
                                    <div class="col-md-3 paddin-npt padding-right-15">
                                        <label class="col-md-12 paddin-npt">Zip Code:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <input data-required="1" id="postal_code" type="text" name="zip" value="{{$defaultSettings->zip}}" class="form-control" placeholder="Enter your Zip code">
                                        </div>
                                    </div>
                                    <div class="col-md-3 paddin-npt">
                                        <label class="col-md-12 paddin-npt">Country</label>
                                        <div class="col-md-12 paddin-npt">
                                            <select id="country" name="country" class="form-control selectCountry">
                                                <option></option>
                                                @foreach($countries as $country)
                                                @if($defaultSettings->country == $country->country_name)
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
                   </div>
                    <div class="form-actions right">
                        <a href="{{ URL::to('request-product-quotes') }}" class="btn btn-danger bold btn-sm">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle yellow-crusta color-black bold">
                            <i class="fa fa-check"></i> Save Settings</button>
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

                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;

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

                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;

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
$("#buyer-tool-main-menu").addClass("active");
$('#buyer-tool-main-menu' ).click();
$('#buyer-tool-menu-arrow').addClass('open');
$('#default-setting-quote-menu').addClass('active');
/* end menu active */

    $( document ).ready(function() {
        $('#diversity_options').multiSelect();

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

$(".js-data-accrediton-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url('getquote/accredationSearch')}}",
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

</script>
<script src="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
