@extends('buyer.app')
@section('content')
<style>
    .pac-container {
        background-color: #FFF;
        z-index: 20;
        position: fixed;
        display: inline-block;
        float: left;
    }
    .modal{
        z-index: 20;
    }
    .modal-backdrop{
        z-index: 10;
    }​
</style>
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
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
<h3 class="page-title uppercase"> 
<i class="fa fa-plus color-black"></i> Additional Information
</h3>
</div>
</div>
<div class="row">
   <div class="col-md-12">
<div class="col-md-12">
            <div  class="portlet-body form" id="blockui_sample_1_portlet_body">
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
                    <p class="caption-helper">Fill in the following additional information that apply. </p>
                </div>
                <!-- responsive -->
                <div id="responsive" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="mt-element-step">
                    <div class="row step-line">
                        <div id="company-first" class="col-md-4 mt-step-col first done">
                            <div class="mt-step-number bg-white"><i class="fa fa-check"></i></div>
                            <div class="mt-step-title uppercase font-grey-cascade">REQUIRED INFORMATION</div>
                        </div>
                        <div id="company-second" class="col-md-4 mt-step-col active">
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
                <form id="wizard-profile" class="horizontal-form form-horizontal form-row-seperated" action="{{url('user/additional-info/save')}}" id="submit_form" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-body padding-15">
                    <div class="paddin-npt paddin-bottom">
                        <h3 class="block bold font-red-mint align-left"><span>Employment Details </span></h3>
                        <p class="caption-helper">Add Your Employment History.</p>
                        <div id="user-job-table-view" class="paddin-bottom">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th> Position Held </th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Company Location</th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->userJobs as $job)
                                    <tr>
                                        <td>{{$job->company_name}}</td>
                                        <td>{{$job->job_title}}</td>
                                        <td>
                                            @if(strtotime($job->date_from) > 0)
                                                {{date('m-d-Y',strtotime($job->date_from))}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        @if($job->current != '')
                                        <td>{{$job->current}}</td>
                                        @else
                                        <td>
                                            @if(strtotime($job->date_to) > 0)
                                                {{date('m-d-Y',strtotime($job->date_to))}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        @endif
                                        <td>{{$job->location}}</td>
                                        <td>
                                            <a href="javascript:void(0)" id="{{url('user/additionaldetails/edit')}}/job/{{$job->id}}" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm modal-trigger">
                                                <i class="fa fa-edit"></i> Edit </a>
                                            <a href="javascript:void(0)" id="{{url('user/additionaldetails/delete')}}/job/{{$job->id}}" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm modal-trigger">
                                                <i class="fa fa-remove"></i> Delete </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button id="{{url('user/additionaldetails/add')}}/job" type="button" class="btn btn-circle yellow-crusta color-black modal-trigger" onclick="showAddModal(id)"><i class="fa fa-plus"></i> Click to Add</button>
                    </div>
                    <div class="paddin-npt paddin-bottom">
<h3 class="block bold font-red-mint align-left"><span>Education History</span></h3>

                        <p class="caption-helper">Add your Education Details.</p>
                        
                        <div id="user-education-table-view" class="paddin-bottom">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Degree Received </th>
                                    <th>Institution Name</th>
                                    <th>Institution Location</th>
                                    <th>Date Received</th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->userEducationDetails as $education)
                                    <tr>
                                        <td>{{$education->degree}}</td>
                                        <td>{{$education->institute_name}}</td>
                                        <td>{{$education->location}}</td>
                                        @if($education->current != '')
                                        <td>{{$education->current}}</td>
                                        @else
                                        <td>
                                            @if(strtotime($education->date_received) > 0)
                                                {{date('m-d-Y',strtotime($education->date_received))}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        @endif
                                        <td>
                                            <a href="javascript:void(0)" id="{{url('user/additionaldetails/edit')}}/education/{{$education->id}}" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black btn-sm modal-trigger">
                                                <i class="fa fa-edit"></i> Edit </a>
                                            <a href="javascript:void(0)" id="{{url('user/additionaldetails/delete')}}/education/{{$education->id}}" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm modal-trigger">
                                                <i class="fa fa-remove"></i> Delete </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button id="{{url('user/additionaldetails/add')}}/education" type="button" class="btn btn-circle yellow-crusta color-black modal-trigger" onclick="showAddModal(id)"><i class="fa fa-plus"></i> Click to Add</button>
                    </div>
                    <div class="paddin-npt paddin-bottom">

<h3 class="block bold font-red-mint align-left"><span>Certifications & Licenses</span></h3>

                        <p class="caption-helper"> Have you obtained any Certifications or Licenses?</p>
                        <div id="user-certification-table-view" class="paddin-bottom">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Certification Name </th>
                                    <th>Certifying authority</th>
                                    <!--<th>Received Date</th>-->
                                    <th>Valid Till</th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->userCertifications as $certification)
                                    <tr>
                                        <td>{{$certification->certification_name}}</td>
                                        <td>{{$certification->certifying_authority}}</td>
                                        <!--<td>{{$certification->date_received}}</td>-->
                                        <td>
                                            @if(strtotime($certification->valid_till) > 0)
                                                {{date('m-d-Y',strtotime($certification->valid_till))}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" id="{{url('user/additionaldetails/edit')}}/certification/{{$certification->id}}" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black modal-trigger btn-sm">
                                                <i class="fa fa-edit"></i> Edit </a>
                                            <a href="javascript:void(0)" id="{{url('user/additionaldetails/delete')}}/certification/{{$certification->id}}" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm">
                                                <i class="fa fa-remove"></i> Delete </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button id="{{url('user/additionaldetails/add')}}/certification" type="button" class="btn btn-circle yellow-crusta color-black modal-trigger" onclick="showAddModal(id)"><i class="fa fa-plus"></i> Click to Add</button>
                    </div>
                    <div class="paddin-npt paddin-bottom">

<h3 class="block bold font-red-mint align-left"><span>Awards & Honors</span></h3>
                        <p class="caption-helper">Showcase any award or honor that you have received.</p>
                        <div id="user-award-table-view" class="paddin-bottom">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Award/ Honor Name</th>
                                    <th>Awarding Authority</th>
                                    <th>Date Received</th>
                                    <th>Location</th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->userAwards as $award)
                                    <tr>
                                        <td>{{$award->awards_name}}</td>
                                        <td>{{$award->awarding_authority}}</td>
                                        <td>
                                            @if(strtotime($award->date_received) > 0)
                                                {{date('m-d-Y',strtotime($award->date_received))}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{$award->location}}</td>
                                        <td>
                                            <a href="javascript:void(0)" id="{{url('user/additionaldetails/edit')}}/award/{{$award->id}}" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black modal-trigger btn-sm">
                                                <i class="fa fa-edit"></i> Edit </a>
                                            <a href="javascript:void(0)" id="{{url('user/additionaldetails/delete')}}/award/{{$award->id}}" onclick="showDeleteModal(id)" class="btn btn-circle modal-trigger btn-danger btn-sm">
                                                <i class="fa fa-remove"></i> Delete </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button id="{{url('user/additionaldetails/add')}}/award" type="button" class="btn btn-circle yellow-crusta color-black modal-trigger" onclick="showAddModal(id)"><i class="fa fa-plus"></i> Click to Add</button>
                    </div>
                    <div class="paddin-npt paddin-bottom">

<h3 class="block bold font-red-mint align-left"><span>Organization Memberships</span></h3>
                       
                        <p class="caption-helper">Are you a member of any organization?</p>
                        <div id="user-memberorganization-table-view" class="paddin-bottom">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> Position </th>
                                    <th>Membership Organization</th>
                                    <th>Member Since</th>
                                    <th>Expiration Date</th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->userMemberOrganizations as $member)
                                    <tr>
                                        <td>{{$member->postion}}</td>
                                        <td>{{$member->membership_organization}}</td>
                                        <td>
                                            @if(strtotime($member->member_since) > 0)
                                                {{date('m-d-Y',strtotime($member->member_since))}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if(strtotime($member->valid_till) > 0)
                                                {{date('m-d-Y',strtotime($member->valid_till))}}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" id="{{url('user/additionaldetails/edit')}}/member/{{$member->id}}" onclick="showEditModal(id)" class="btn btn-circle yellow-crusta color-black modal-trigger btn-sm">
                                                <i class="fa fa-edit"></i> Edit </a>
                                            <a href="javascript:void(0)" id="{{url('user/additionaldetails/delete')}}/member/{{$member->id}}" onclick="showDeleteModal(id)" class="btn btn-circle btn-danger btn-sm modal-trigger">
                                                <i class="fa fa-remove"></i> Delete </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button id="{{url('user/additionaldetails/add')}}/member" type="button" class="btn btn-circle yellow-crusta color-black modal-trigger" onclick="showAddModal(id)"><i class="fa fa-plus"></i> Click to Add</button>
                    </div>
                    <!-- Social Profile Links section -->

<h3 class="block bold font-red-mint align-left"><span>Social Media</span></h3>
                    <label class="control-label">Enter your Social Media links:<span style="font-size: 14px;vertical-align: top; red"> (optional)</span></label>
                    
                    
                    
                    
                    <div class="form-group">
                        <div class="col-md-6 paddin-npt padding-right-15">
                            <label class="control-label">Facebook Profile</label>
                            <input type="text" name="facebook_url" @if(Request::old('facebook_url')) value="{{Request::old('facebook_url')}}" @else value="{{$userData->facebook_url}}" @endif class="form-control" placeholder="Enter your Facebook profile link">
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">LinkedIn Profile</label>
                            <input type="text" name="linkedin" @if(Request::old('linkedin')) value="{{Request::old('linkedin')}}" @else value="{{$userData->linkedin}}" @endif class="form-control" placeholder="Enter your Linkedin profile link">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 paddin-npt padding-right-15">
                            <label class="control-label">Google+ Profile</label>
                            <input type="text" name="google_plus" @if(Request::old('google_plus')) value="{{Request::old('google_plus')}}" @else value="{{$userData->google_plus}}" @endif class="form-control" placeholder="Enter your Google+ profile link">
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Youtube Profile</label>
                            <input type="text" name="youtube_url" @if(Request::old('youtube_url')) value="{{Request::old('youtube_url')}}" @else value="{{$userData->youtube_url}}" @endif class="form-control" placeholder="Enter your Youtube profile link">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 paddin-npt padding-right-15">
                            <label class="control-label">Twitter Profile</label>
                            <input type="text" name="twitter_url" @if(Request::old('twitter_url')) value="{{Request::old('twitter_url')}}" @else value="{{$userData->twitter_url}}" @endif class="form-control" placeholder="Enter your Twitter profile link">
                        </div>
                    </div>

                </div>
                <div class="form-actions right padding-top align-right">
                    <a href="{{url('user-details')}}" class="btn btn-circle default bold button-previous">
                        <i class="fa fa-angle-left"></i> Back </a>
                    <button type="submit" class="btn btn-circle yellow-crusta color-black bold button-next"> Continue to Photo Center
                        <i class="fa fa-angle-right"></i>
                    </button>
                </div>
                </form>
            </div>
      </div>
      </div>  
</div>
</div>



<script>
    $('.modal-trigger').click(function(){
        var sw = $(window).height();
        var eh = $('#responsive').find('.modal-dialog').height();
        //console.log(sw+'-'+eh);
        $('#responsive').css('top',(sw-400)/2);

    });

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

    function initAutocomplete()
    {
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

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate()
    {
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
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });

            var script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAiDNVH3xsDq4YPf8dMkHBzXrH17wF_JZw&libraries=places&callback=initAutocomplete';
            script.setAttribute("type","text/javascript");
            document.body.appendChild(script);

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
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });

            var script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAiDNVH3xsDq4YPf8dMkHBzXrH17wF_JZw&libraries=places&callback=initAutocomplete';
            script.setAttribute("type","text/javascript");
            document.body.appendChild(script);

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
            $('#responsive').html(data.html);
            $('#responsive').modal('show');
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
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
function saveAdditionals(id)
{
    var ids = id.split('_');
    var form= $("#form-addition-"+ids[0]);
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    $.ajax({
        url: "{{url('user')}}/"+ids[0]+'/save',
        type: 'post',
        data:form.serialize(),
        success: function(data) {
            $('#user-'+ids[0]+'-table-view').html('');
            $('#user-'+ids[0]+'-table-view').html(data.html);
            $('#responsive').html('');
            $('#responsive').modal('hide');
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

function deleteAdditionals(id)
{
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    $.ajax({
        url: id,
        type: 'get',
        success: function(data) {
            $('#user-'+data.type+'-table-view').html('');
            $('#user-'+data.type+'-table-view').html(data.html);
            $('#responsive').html('');
            $('#responsive').modal('hide');
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
</script>

<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>

@endsection
