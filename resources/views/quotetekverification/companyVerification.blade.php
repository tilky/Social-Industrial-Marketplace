@extends('company.app')



@section('content')

<div class="page-bar">

    <ul class="page-breadcrumb">

        <li>

            <a href="{{url('user-dashboard')}}">Home</a>

            <i class="fa fa-circle"></i>  

        </li>

        <li>

            <a href="{{url('quotetekverification')}}">Quotetek Verification</a>

            <i class="fa fa-circle"></i>  

        </li>

        <li>

            <span>Add Company Verification</span>

        </li>

    </ul>

</div>

<div class="row">

    <div class="col-md-12">

        <div class="portlet box yellow-crusta" id="blockui_sample_1_portlet_body">

            <div class="portlet-title">

                <div class="caption color-black">

                    <i class="fa fa-plus color-black"></i>  Company Verification</div>

            </div>



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

                <!-- modal start -->

                <div id="responsive" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

                <!-- end -->

                <div class="col-md-12 padding-top">

                    <p class="caption-helper">Thank you for your interest in becoming an Indy John verified company.</p>

                    <p class="caption-helper">Please be advised there is a $100 Non-Refundable Application Processing fee. </p>

                </div>

                <form class="horizontal-form form-horizontal form-row-seperated" action="{{url('quotetek/company/vrification/save')}}" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="_token" value="{{csrf_token()}}" />

                    <input type="hidden" name="user_id" value="{{$user->id}}" />

                    <div class="form-body padding-15">

                        <p class="caption-helper">Before you begin, please ensure that your profile is completed to the best of your knowledge, as you won't be able to modify the following personal information until after we complete this account verification. </p>

                        <div class="form-group">

                            <div class="col-md-12 paddin-npt padding-right-15">

                                <label class="control-label">Company Name:</label>

                                <input type="text" name="name" value="{{$user->companydetail->name}}" class="form-control" placeholder="Enter your company name">

                            </div>

                        </div>

                        <label class="control-label">Search Address:</label>
                        <div class="form-group">
                            <div class="col-md-6 paddin-npt padding-right-15" id="locationField" >
                                <input type="text" id="autocomplete" class="form-control" onFocus="geolocate()" value=""  placeholder="Type to Search" >
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-6 paddin-npt padding-right-15">

                                <label class="col-md-12 paddin-npt">Company Address Line 1:</label>

                                <div class="col-md-12 paddin-npt">

                                    <input type="text" id="premise" name="address" class="form-control" value="{{$user->companydetail->address}}" placeholder="Enter your Company Address Line 1" />

                                </div>

                            </div>

                            <div class="col-md-6 paddin-npt">

                                <label class="col-md-12 paddin-npt">Company Address Line 2:</label> 

                                <div class="col-md-12 paddin-npt">

                                    <input  type="text" id="route" name="address2" class="form-control" value="{{$user->companydetail->address2}}" placeholder="Enter your Company Address Line 2" />

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-6 paddin-npt padding-right-15">

                                <label class="col-md-12 paddin-npt">City:</label>

                                <div class="col-md-12 paddin-npt">

                                    <input data-required="1" id="locality" type="text" name="city" value="{{$user->companydetail->city}}" class="form-control" placeholder="Enter the City Name" >

                                </div>

                            </div>

                            <div class="col-md-6 paddin-npt">

                                <label class="col-md-12 paddin-npt">State:</label>

                                <div class="col-md-12 paddin-npt">

                                    <input data-required="1" id="administrative_area_level_1" type="text" name="state" value="{{$user->companydetail->state}}" class="form-control" placeholder="Enter the State Name" >

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-6 paddin-npt padding-right-15">

                                <label class="col-md-12 paddin-npt">Zip Code:</label>

                                <div class="col-md-12 paddin-npt">

                                    <input data-required="1" id="postal_code" type="text" name="zip" value="{{$user->companydetail->zip}}" class="form-control" placeholder="Enter your Zip code" >

                                </div>

                            </div>

                            <div class="col-md-6 paddin-npt">

                                <label class="col-md-12 paddin-npt">Country</label>

                                <div class="col-md-12 paddin-npt">

                                    <select id="country" name="country" class="form-control selectCountry" >

                                        <option></option>

                                        @foreach($countries as $country)

                                            @if($user->companydetail->country == $country->country_name)

                                                <option value="{{$country->country_name}}" selected="">{{$country->country_name}}</option>

                                            @else

                                                <option value="{{$country->country_name}}">{{$country->country_name}}</option>

                                            @endif

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

        					<div class="col-md-12 paddin-npt">

        						<label class="control-label">Account E-mail Address:</label>

                                <input type="text" name="email" value="{{ $user->email }}" class="form-control" placeholder="Account E-mail Address" @if($user->quotetek_verify == 0) readonly @endif />

        					</div>

        				</div>

                        <div class="form-group">

                            <h3 class="block bold align-left"><span style="font-size: 19px!important;">Company verification is simple. Complete the following process</span></h3>

                            <div class="col-md-12 paddin-npt padding-right-15">

                                <label class="control-label">Upload a recent utility bill showing your name and  address:</label>

                                <div id="proof-file-1" class="col-md-12 paddin-npt fileinput fileinput-new" data-provides="fileinput">

                                    <div class="input-group input-large">

                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">

                                            <i class="fa fa-file fileinput-exists"></i>  &nbsp;

                                            <span class="fileinput-filename"><b>Upload a recent utility bill</b></span>

                                        </div>

                                        <span class="input-group-addon btn btn-circle default btn-file">

                                            <span class="fileinput-new"> Select file </span>

                                            <span class="fileinput-exists"> Change </span>

                                            <input type="file" data-required="1" name="utility_bill" > </span>

                                        <a href="javascript:;" class="input-group btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

        					<div class="col-md-12 paddin-npt">

        						<label class="control-label">Verify your website address:</label>

                                <input type="text" name="website" value="{{ $user->companydetail->website }}" class="form-control" placeholder="Verify your website address" />

        					</div>

        				</div>

                        <div class="form-group">

                            <h3 class="block bold align-left"><span style="font-size: 19px!important;">Submit two professional references</span></h3>

                            <p class="caption-helper">First Reference:</p>

                            <div id="first-referrence-div">

                                <div class="paddin-bottom">

                                    <input type="hidden" name="reference_1_name" value="{{$companyVerification->ref_1_name}}" />

                                    <input type="hidden" name="reference_1_phone" value="{{$companyVerification->ref_1_phone}}" />

                                    <input type="hidden" name="reference_1_email" value="{{$companyVerification->ref_1_email}}" />

                                    <input type="hidden" name="reference_1_relation" value="{{$companyVerification->ref_1_relation}}" />

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                                        <thead>

                                        <tr>

                                            <th> Name </th>

                                            <th>Phone</th>

                                            <th>Email</th>

                                            <th>Relation</th>

                                            <th> Action </th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                            @if($companyVerification->ref_1_name != '')

                                            <tr>

                                                <td>{{$companyVerification->ref_1_name}}</td>

                                                <td>{{$companyVerification->ref_1_phone}}</td>

                                                <td>{{$companyVerification->ref_1_email}}</td>

                                                <td>{{$companyVerification->ref_1_relation}}</td>

                                                <td>

                                                    <a href="javascript:void(0)" id="{{url('company/reference/edit')}}/{{$companyVerification->id}}/1" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                                        <i class="fa fa-edit"></i>  Edit </a>

                                                    <a href="javascript:void(0)" id="{{url('company/reference/delete')}}/{{$companyVerification->id}}/1" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                                        <i class="fa fa-remove"></i>  Delete </a>

                                                </td>

                                            </tr>

                                            @endif

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <button type="button" id="{{url('company/reference/add/1')}}" class="btn btn-circle yellow-crusta color-black reference-add-btn-1" onclick="showAddModal(id,'first')"  @if($companyVerification->ref_1_name != '') style="display:none" @endif><i class="fa fa-plus"></i>  Add First Reference </button>

                            

                        </div>

                        <div class="form-group">

                            <p class="caption-helper">Second Reference :</p>

                            <div id="second-referrence-div">

                                <div class="paddin-bottom">

                                    <input type="hidden" name="reference_2_name" value="{{$companyVerification->ref_2_name}}" />

                                    <input type="hidden" name="reference_2_phone" value="{{$companyVerification->ref_2_phone}}" />

                                    <input type="hidden" name="reference_2_email" value="{{$companyVerification->ref_2_email}}" />

                                    <input type="hidden" name="reference_2_relation" value="{{$companyVerification->ref_2_relation}}" />

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">

                                        <thead>

                                        <tr>

                                            <th> Name </th>

                                            <th>Phone</th>

                                            <th>Email</th>

                                            <th>Relation</th>

                                            <th> Action </th>

                                        </tr>

                                        </thead>

                                        <tbody>

                                            @if($companyVerification->ref_2_name != '')

                                            <tr>

                                                <td>{{$companyVerification->ref_2_name}}</td>

                                                <td>{{$companyVerification->ref_2_phone}}</td>

                                                <td>{{$companyVerification->ref_2_email}}</td>

                                                <td>{{$companyVerification->ref_2_relation}}</td>

                                                <td>

                                                    <a href="javascript:void(0)" id="{{url('company/reference/edit')}}/{{$companyVerification->id}}/2" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm">

                                                        <i class="fa fa-edit"></i>  Edit </a>

                                                    <a href="javascript:void(0)" id="{{url('company/reference/delete')}}/{{$companyVerification->id}}/2" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">

                                                        <i class="fa fa-remove"></i>  Delete </a>

                                                </td>

                                            </tr>

                                            @endif

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            

                            <button type="button" id="{{url('company/reference/add/2')}}" class="btn btn-circle yellow-crusta color-black reference-add-btn-2" onclick="showAddModal(id)" @if($companyVerification->ref_2_name != '') style="display:none" @endif><i class="fa fa-plus"></i>  Add Second Reference  </button>

                            

                        </div>

                    </div>

                    <div class="form-actions right padding-top align-right">

                        <button type="submit" class="btn btn-circle yellow-crusta color-black bold button-next"> Submit Your Application for verification and Proceed to Payment

                            <i class="fa fa-angle-right"></i>  

                        </button>

                    </div>

                </form>

                <!-- END FORM-->

                

            </div>

        </div>

    </div>

</div>
<!-- /.modal -->
<div class="modal fade footer-modal" id="user_verification_done" role="basic" aria-hidden="false" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body"> 
                <b>your profile has been verified by Indy John. If you change any of these details, your account will loose it's verified status and will need to reverify.</b>
            </div>
            <div class="modal-footer">
                <a href="{{url('change/verification')}}/{{Auth::user()->id}}" class="btn btn-circle yellow-crusta color-black btn-outline" >Yes</a>
                <a href="{{url('user-dashboard')}}" class="btn btn-danger btn-outline" >No</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
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

$("#verification-main-menu").addClass("active");

$('#verification-main-menu' ).click();

$('#verification-menu-arrow').addClass('open');

$('#quotetek-user-verification-menu').addClass('active');

/* end menu active */

$(document).ready(function(){

   var countryplaceholder = "Select Country";



    $(".selectCountry").select2({

        placeholder: countryplaceholder,

        width: null

    });

});



function showAddModal(id)

{

    App.blockUI({

        target: '#blockui_sample_1_portlet_body',

        animate: true

    });

      var url = id;

      $.ajax({

        url: url,

        type: 'get',

        success: function(data) {

            $('#responsive').html('');

            $('#responsive').html(data.html);

            $('#responsive').modal('show');

            

            App.unblockUI('#blockui_sample_1_portlet_body');

        },   

        done: function() {

            //console.log('error');

            App.unblockUI('#blockui_sample_1_portlet_body');

        },

        error: function() {

            //console.log('error');

            App.unblockUI('#blockui_sample_1_portlet_body');

        }

        

    });

}



function showEditModal(id)

{

    App.blockUI({

        target: '#blockui_sample_1_portlet_body',

        animate: true

    });

    

      var url = id;

      $.ajax({

        url: url,

        type: 'get',

        success: function(data) {

            $('#responsive').html('');

            $('#responsive').html(data.html);

            $('#responsive').modal('show');

            App.unblockUI('#blockui_sample_1_portlet_body');

        },   

        done: function() {

            //console.log('error');

            App.unblockUI('#blockui_sample_1_portlet_body');

        },

        error: function() {

            //console.log('error');

            App.unblockUI('#blockui_sample_1_portlet_body');

        }

        

    });

}



function showDeleteModal(id)

{

    App.blockUI({

        target: '#blockui_sample_1_portlet_body',

        animate: true

    });

      var url = id;

      $.ajax({

        url: url,

        type: 'get',

        success: function(data) {

            $('#responsive').html('');

            if(data.ref_type == 1)

            {

                $('.reference-add-btn-1').show();

                $('#first-referrence-div').html('');

                $('#first-referrence-div').html(data.html);

            }

            else

            {

                $('.reference-add-btn-2').show();

                $('#second-referrence-div').html('');

                $('#second-referrence-div').html(data.html);

            }

            App.unblockUI('#blockui_sample_1_portlet_body');

        },   

        done: function() {

            //console.log('error');

            App.unblockUI('#blockui_sample_1_portlet_body');

        },

        error: function() {

            //console.log('error');

            App.unblockUI('#blockui_sample_1_portlet_body');

        }

        

    });

}



function saveCompanyReference()

{

    var form= $("#company-reference-add");

    App.blockUI({

        target: '#blockui_sample_1_portlet_body',

        animate: true

    });

    $.ajax({

        url: "{{url('company/reference/save')}}",

        type: 'post',

        data:form.serialize(),

        success: function(data) {

            console.log(data);

            $('#responsive').html('');

            $('#responsive').modal('hide');

            if(data.ref_type == 1)

            {

                $('.reference-add-btn-1').hide();

                $('#first-referrence-div').html('');

                $('#first-referrence-div').html(data.html);

            }

            else

            {

                $('.reference-add-btn-2').hide();

                $('#second-referrence-div').html('');

                $('#second-referrence-div').html(data.html);

            }

            App.unblockUI('#blockui_sample_1_portlet_body');

        },   

        done: function() {

            //console.log('error');

            App.unblockUI('#blockui_sample_1_portlet_body');

        },

        error: function() {

            //console.log('error');

            App.unblockUI('#blockui_sample_1_portlet_body');

        }

        

    });

}
var user_verification = "{{Auth::user()->quotetek_verify}}";
if(user_verification == 1)
{
    jQuery('#user_verification_done').modal({
        backdrop: 'static',
        keyboard: false
    }); 
}
</script>

@endsection
