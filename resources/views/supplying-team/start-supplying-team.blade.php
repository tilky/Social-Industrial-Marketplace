@extends('supplier.app')

@section('content')
<style>
.bootstrap-tagsinput {
  width: 100% !important;
}
.main-lab{font-size: 15px!important;font-weight: bold;}
.select2-container{display: block!important;}
.ms-container{width: 90%!important;}
.blue_circle{ height:100px; width:100px; border-radius:50%; background:#0061FF;}
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
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Team Supplying</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            @if(isset($supplierTeam->id))
            <span>Edit Supplying Team</span>
            @else
            <span>Start a New Supplying Team</span>
            @endif
        </li>
    </ul>
</div>
 <div class="col-md-12 main_box">

<div class="row">
    <div class="col-md-12 border2x_bottom" id="form_wizard_1">
        <h3 class="page-title uppercase">
            <i class="fa fa-group color-black"> </i>@if(isset($supplierTeam->id)) Edit Supplying Team @else Start a New Supplying Team @endif
        </h3>
    </div>
</div>
            
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="col-md-12 col-sm-12">
            <div class="portlet-body form" id="blockui_sample_1_portlet_body">
            @if (Session::has('message'))
            <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
            @endif
                <div class="col-md-12 col-sm-12">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                    <div class="mt-element-step">
                        <div class="row step-line">
                            <div id="company-first" class="col-md-offset-2 col-md-4 col-sm-6 mt-step-col first active">
                                <div class="mt-step-number bg-white">1</div>
                                <div class="mt-step-title uppercase font-grey-cascade">ADD TEAM DETAILS</div>
                            </div>
                            <div id="company-second" class="col-md-4 col-sm-6 mt-step-col last">
                                <div class="mt-step-number bg-white">2</div>
                                <div class="mt-step-title uppercase font-grey-cascade">INVITE MEMBERS</div>
                            </div>
                        </div>
                    </div>
                    <div class="yellow-crusta-seprator"></div>
                </div>
                
                <!-- BEGIN FORM-->
                {!! Form::open(['url'=>'saveSupplierTeam','class'=>'horizontal-form form-horizontal submitTeam','method'=>'POST','enctype'=> 'multipart/form-data','files'=>'true','id' => 'req-form-quote']) !!}
                    <input type="hidden" id="inviteNowOrLater" name="invite" value="">
                    <input type="hidden" name="id" value="{{$supplierTeam->id}}" />
                    <div class="form-wizard">
                        <div class="form-body">
                            <ul class="nav nav-pills nav-justified steps" style="display: none;">
                                <li>
                                    <a href="#tab1" data-toggle="tab" class="step">
                                        <span class="number"> 1 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Step 1: Required </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                        <span class="number"> 2 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Step 2: Optionals </span>
                                    </a>
                                </li>
                            </ul>
                            <div id="bar" class="progress progress-striped" role="progressbar" style="display: none;">
                                <div class="progress-bar progress-bar-success"> </div>
                            </div>

                            <div class="tab-content">
                                <div class="alert alert-danger display-none">
                                    <button class="close" data-dismiss="alert"></button> Something went wrong, please check your data and try again.
                                </div>
                                <div class="alert alert-success display-none">
                                    <button class="close" data-dismiss="alert"></button> Your team was successfully created.
                                </div>
                                @if($inviteUsers == 0)
                                <div class="tab-pane active" id="tab1">
                                @else
                                <div class="tab-pane" id="tab1">
                                @endif
                                    <div class="col-md-12 font-red-mint padding-top" id="first-step-quote">
                                        <h3 class="block  align-left"><span style="font-size: 20px!important;">Start a Supplying Team </span></h3>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 paddin-npt">As a Supplying Team Manager, you can -</label>
                                    </div>
                                    <!--<p class="select-all"><input type="checkbox" id="checkAll"  class="form-control"  /> select All</p>-->
                                    <div class="form-group paddin-bottom">
                                        <ul class="start_team">
                                            <li><i class="fa fa-check color-black"> </i>Create Lead Requests and Assign them to team members</li>
                                            <li><i class="fa fa-check color-black"> </i>Add or remove team members</li>
                                            <li><i class="fa fa-check color-black"> </i>Manage and Organize all team related details</li>
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 font-red-mint padding-top" id="first-step-quote">
                                            <div class="row">
                                                <h3 class="block  align-left"><span style="font-size: 20px!important;">Enter Team Details </span></h3>
                                            </div>
                                        </div>
                                        <div class="col-md-12 paddin-npt">
                                        <label class="col-md-12 paddin-npt">Team Name:</label>
                                           <input class="form-control" type="text" name="name" value="{{$supplierTeam->name}}" placeholder="Enter Team Name here Your Team" />
                                           
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 paddin-npt">Team Privacy Setting:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <select class="form-control" name="type" placeholder="Select Team Type">
                                                <option value="Private" {{($supplierTeam->type == "Private" ? 'selected="selected"' : '')}}>Private Team</option>
                                                <option value="Public Team" {{($supplierTeam->type == "Public" ? 'selected="selected"' : '')}}>Public</option>
                                            </select>
                                         
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 paddin-npt">Team Summary:</label>
                                        <div class="col-md-12 paddin-npt">
                                            <textarea rows="2" class="form-control" type="textarea" name="description" value="{{$supplierTeam->description}}" placeholder="Add a Team Summary." ></textarea>
                                              
                                    </div>       </div>
						     <div class="form-group">
                                        <label class="col-md-12 paddin-npt">Would you like to Assign Territories or Product-Category types to Team Members:</label>
                              
                                        <div class="col-md-12 paddin-npt">
                                            <select class="form-control" name="label" placeholder="Select Sorting Label">
                                            <option value="Region" {{($supplierTeam->label == "Region" ? 'selected="selected"' : '')}}>Region</option>
                                     
                                            <option value="Categories" {{($supplierTeam->label == "Categories" ? 'selected="selected"' : '')}}>Product-Categories</option>
                                            </select>
                                
                                        </div>
                                
                              
                                
                                
                                
                                    {{--
                                    <div class="form-group">
                                        <label class="col-md-12 paddin-npt">Enter those specific Territory or Section Types:</label>
                                        @if(isset($supplierTeam->id))
                                            <input type="text" name="tags" value="{{$supplierTeamTags}}" data-role="tagsinput" id="taginputin" placeholder="Type something and hit enter" />
                                        @else
                                            <input type="text" name="tags" value="" data-role="tagsinput" id="taginputin" placeholder="Type something and hit enter" />
                                        @endif
                                    
                                    --}}
                                        <span class="help-block margin-top"> </span>
                                    </div>

                                    <div class="form-actions right">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a href="javascript:;" class="btn btn-circle btn-danger button-next"> Cancel
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                               <!-- <a href="javascript:;" id="post-request" class="btn btn-circle btn_yellow hvr-bounce-to-right" onclick="setTitel();"> <i class="fa fa-check"></i> Submit Request</a> -->
                                                @if(isset($id))
                                                <button type="submit" class="btn btn-circle yellow-crusta bold"> <i class="fa fa-check"></i>Update Team and Invite Members</button>
                                                @else
                                                <button type="submit" class="btn btn-circle yellow-crusta bold"> <i class="fa fa-check"></i>Create Team and Invite Members</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($inviteUsers == 1)
                                <div class="tab-pane active" id="tab2">
                                @else
                                <div class="tab-pane" id="tab2">
                                @endif
                                    <div class="form-group">
                                        <div class="col-md-12 font-red-mint padding-top" id="first-step-quote">
                                            <div class="row">
                                                <h3 class="block  align-left"><span style="font-size: 20px!important;">Invite Users to Join this Team: </span></h3>
                                            </div>
                                        </div>
                                    <label class="col-md-12 paddin-npt">Invite By E-mail:</label>
                                        <div class="row" id="inviteUsersMapping" style="">
                                            <div class="col-md-9">
                                                <table class="table tableField" id="mappingTable">
                                                    <tr>
                                                        <th>
                                                            <input type="text" name="title[]" class="form-control"  placeholder="Full Name" />
                                                        </th>
                                                        <th>
                                                            <input type="email" name="email[]" class="form-control"  placeholder="E-mail" />
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <input type="text" name="title[]" class="form-control"  placeholder="Full Name" />
                                                        </th>
                                                        <th>
                                                            <input type="email" name="email[]" class="form-control"  placeholder="E-mail" />
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <input type="text" name="title[]" class="form-control"  placeholder="Full Name" />
                                                        </th>
                                                        <th>
                                                            <input type="email" name="email[]" class="form-control"  placeholder="E-mail" />
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div id="title" style="display: none">
                                            <input type="text"  name="title[]" class="form-control" id="" placeholder="Full Name" />
                                        </div>

                                        <div id="email" style="display: none">
                                            <input type="email"  name="email[]" class="form-control" id="" placeholder="E-mail" />
                                        </div>

                                        <div id="deleteButton" style="display: none">
                                            <button type="button" onclick="deleteMappingRow(this)" class="btn btn-circle red bold"><i class="fa fa-close"></i> Delete </button>
                                        </div>

                                        <div class="col-md-12 text-center margin-top-15 margin-bottom-15">
                                            <div class="col-sm-9">
                                                <button type="button" onclick="AddNewMember()" class="btn btn-circle red bold"><i class="fa fa-plue-circle"></i> Add More</button>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12 paddin-npt">
                                                <label>Invite your Indy John Connected Users:</label>
                                                @if(isset($supplierTeam->id))
                                                    @if(count($supplierTeamUserArray) > 0)
                                                    <select id="select2-button-addons-single-input-group-sm" name="indyJohnUsers[]" class="form-control col-md-12 js-data-connection-ajax" multiple >
                                                        @foreach($supplierTeamUserArray as $teamUser)
                                                        <option value="{{$teamUser['userId']}}" selected>{{$teamUser['userName']}}</option>
                                                        @endforeach
                                                    </select>
                                                    @else
                                                    <select id="select2-button-addons-single-input-group-sm" name="indyJohnUsers[]" class="form-control col-md-12 js-data-connection-ajax"  multiple>
                                                    </select>
                                                    @endif
                                                @else
                                                <select id="select2-button-addons-single-input-group-sm" name="indyJohnUsers[]" class="form-control col-md-12 js-data-connection-ajax"  multiple>
                                                </select>
                                                @endif
                                            </div>
                                        </div>
                                        
                                         {{--

                                        <div class="col-md-12 margin-bottom-15">
                                            <label class="col-md-12 paddin-npt">Invite users from your Contacts:</label>
                                            <p>
                                            <div class="col-md-2 col-sm-3 col-xs-6">
                                                <a href="{{Session::get('google_invite_url')}}" target="_blank">
                                                    <img src="{{URL::asset('images/Indy-John/gmail-icon.png')}}" width="100px">
                                                </a>
                                            </div>
                                            <div class="col-md-2 col-sm-3 col-xs-6">
                                                <a href="javascript:void(0)" onclick="GetYahooHeaderContact();">
                                                    <img src="{{URL::asset('images/Indy-John/yahoo-icon.png')}}" width="100px">
                                                </a>
                                            </div>
                                            <div class="col-md-2 col-sm-3 col-xs-6">
                                                <a href="{{Session::get('msn_invite_url')}}" target="_blank">
                                                    <img src="{{URL::asset('images/Indy-John/outlook-icon.png')}}" width="100px">
                                                </a>
                                            </div>
                                            <div class="col-md-2 col-sm-3 col-xs-6">
                                                <a href="{{url('invite/email')}}" target="_blank">
                                                    <img src="{{URL::asset('images/Indy-John/mail-icon.png')}}" width="100px">
                                                </a>
                                            </div>
                                         
                                        </div>
                                           --}}
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-actions right">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" onclick="inviteLater();" class="btn btn-circle red"> INVITE LATER
                                                        <i class="fa fa-angle-right"></i>
                                                    </button>
                                                   <!-- <a href="javascript:;" id="post-request" class="btn btn-circle btn_yellow hvr-bounce-to-right" onclick="setTitel();"> <i class="fa fa-check"></i> Submit Request</a> -->
                                                    <button type="submit" onclick="inviteNow();" class="btn btn-circle yellow-crusta"> <i class="fa fa-check"></i>Invite Members</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                <!--<div class="form-actions right">
                    <a href="{{ URL::to('request-product-quotes') }}" class="btn btn-circle btn-sm">
                        Cancel </a>
                    <button type="submit" class="btn btn-circle blue">
                        <i class="fa fa-check"></i> Start Request</button>
                </div>-->
            </div>
            {!! Form::close() !!}
            <!-- END FORM-->
        
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
<script>
    $("#team-supplying").addClass("active");
    $('#team-supplying-menu-arrow').addClass('open');
    $('#start-supplying-team').addClass('active');

    jQuery(document).ready(function(){
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

        $(".js-data-connection-ajax").select2({
            width: "off",
            ajax: {
                url: "{{url('conatct/usersearch')}}",
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
    });

    $('.button-next').click(function(){
        $('#post-request').hide();
        $('#first-step-quote').hide();
        $('#second-step-quote').show();
        $('#tab2').show();
        $('#tab1').hide();
        $('.button-next').hide();
        $('.button-previous').show();
        $('html, body').animate({scrollTop : 0},800);
    });
    $('.button-previous').click(function(){
        $('#post-request').show();
        $('#first-step-quote').show();
        $('#second-step-quote').hide();
        $('#tab2').hide();
        $('#tab1').show();
        $('.button-next').show();
        $('.button-previous').hide();
        $('html, body').animate({scrollTop : 0},800);
    });

    function AddNewMember(){
        $('#mappingTable tr:last').after('<tr><th>'+$('#title').clone().attr('id', '')[0].innerHTML+'</th><th>'+$('#email').clone().attr('id', '')[0].innerHTML+'</th><th>'+$('#deleteButton').clone().attr('id', '')[0].innerHTML+'</th></tr>');
    }

    function deleteMappingRow(button){
        $(button).parent().parent().remove();
    }

    function inviteNow()
    {
        document.getElementById('inviteNowOrLater').value = 'inviteNow';
        $("form.submitTeam").submit();
    }

    function inviteLater()
    {
        document.getElementById('inviteNowOrLater').value = 'inviteLater';
        $("form.submitTeam").submit();
    }

    function GetYahooHeaderContact()
    {
        App.blockUI({
            target: '#basic-invite',
            animate: true
        });

        jQuery.ajax({
            url: '{{url("invite/yahoo/url")}}',
            type: 'get',
            success: function(data) {
                //window.location.href = data.url;
                window.open(data.url,'_blank');
                App.unblockUI('#basic-invite');
            },
            done: function() {
                App.unblockUI('#basic-invite');
                //console.log('error');
            },
            error: function() {
                //console.log('error');
            }

        });
    }
</script>

<script src="{{URL::asset('metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/typeahead/typeahead.bundle.min.js')}}" type="text/javascript"></script>
@endsection
