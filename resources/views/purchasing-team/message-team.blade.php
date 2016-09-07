@extends('buyer.app')

@section('content')
<style>
    .select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/jquery-file-upload/css/jquery.fileupload.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
       
        <li>
            <span>Team Message</span>
        </li>
    </ul>
</div>

<div class="col-md-12 main_box">
    <div class="row">
        <div class="col-md-12 border2x_bottom">
            <div class="col-md-9 col-sm-9">
                <div class="row">
                    <h3 class="page-title uppercase">Team Messaging</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 text-right">
                <div class="row">
                    <div class="actions margin-top-10">
                        <select class="form-control" id="received-team-filter" onchange="ApplyFilter();">
                            <option value="">Select Team</option>
                            @foreach($allBuyerTeam as $team)
                            <option value="{{ $team->id }}" @if($team_id == $team->id) selected="selected" @endif>{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="portlet-body form">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif

                         <!-- BEGIN FORM-->
                         {!! Form::open([
                         'route' => 'purchasingTeam.store',
                         'class' => 'inbox-compose form-horizontal',
                         'id' => 'fileupload',
                         'enctype' => 'multipart/form-data'
                         ]) !!}
                         <div class="form-body">
                             <div class="inbox-body">
                                 <div class="inbox-content">
                                     <div class="row">
                                         <div class="col-md-12">
                                             <div class="form-group">
                                                 <label for="inputEmail3" class="control-label">Send to:</label>
                                                 @if(count($buyerTeamUserArray) > 0)
                                                 <select id="" name="recipients[]" class="form-control col-md-12 js-data-example-ajax"  multiple>
                                                     @foreach($buyerTeamUserArray as $teamUser)
                                                     <option selected value="{{$teamUser['userId']}}" selected>{{$teamUser['userName']}}</option>
                                                     @endforeach
                                                 </select>
                                                 @else
                                                 <select id="select2-button-addons-single-input-group-sm" name="recipients[]" class="form-control col-md-12 js-data-example-ajax"  multiple>

                                                 </select>
                                                 @endif
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-md-12">
                                             <!-- Subject Form Input -->
                                             <div class="form-group">
                                                 <label class="control-label">Subject:</label>
                                                 <input type="text" name="subject" value="" class="form-control" placeholder="Message Subject" />
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-md-12">
                                             <!-- Message Form Input -->
                                             <div class="form-group">
                                                 <label class="control-label">Message:</label>
                                                 <textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12"></textarea>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row" id="blockui_sample_1_portlet_body">
                                         <div class="col-md-12">
                                             <!-- Message Form Input -->
                                             <div class="form-group">
                                                 <div class="inbox-compose-attachment">
                                                     <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                                        <span class="btn btn-circle btn-danger fileinput-button" id="attachment_1" onclick="AddNewAttachment(id);">
                                                            <i class="fa fa-plus"></i>
                                                            <span> Add files... </span>
                                                        </span>
                                                     <!-- The table listing the files available for upload/download -->
                                                     <div class="" id="fileattachments">

                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="form-actions right">
                             <a href="{{ URL::to('manage-my-purchasing-teams') }}" class="btn btn-danger btn-sm bold">
                                 Cancel </a>
                             <button type="submit" class="btn btn-circle yellow-crusta color-black bold">
                                 <i class="fa fa-check"></i> Send</button>
                         </div>
                         {!! Form::close() !!}
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            <!-- END PAGE BASE CONTENT -->
<script>
    $("#team-purchasing").addClass("active");
    $('#team-purchasing-menu-arrow').addClass('open');
    $('#message-purchasing-team').addClass('active');

    $( document ).ready(function() {
        $('#free_shipping_continents').multiSelect();
        $('#product_color').multiSelect();
        $('#product_usage').multiSelect();
        $('.inbox-wysihtml5').wysihtml5({
            toolbar: {

            }
        });
    });
    function AddNewAttachment(id){
        App.blockUI({
            target: '#blockui_sample_1_portlet_body',
            animate: true
        });
        var allIds = id.split('_');
        var orig_id = allIds[0];
        var divId = allIds[1];
        var baseurl = "{{url('message/atachment')}}"+'/'+divId;
        console.log(baseurl);

        jQuery.ajax({
            url: baseurl,
            type: 'get',
            success: function(data) {
                var element = document.getElementById("fileattachments");
                $( "#fileattachments" ).append(data.html);
                var newId = 'attachment_'+data.next_id;
                $('#'+id).attr("id",newId);
                App.unblockUI('#blockui_sample_1_portlet_body');
            },
            done: function() {
                //console.log('error');
            },
            error: function() {
                //console.log('error');
            }

        });
    }
</script>
<script>
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

    $(".js-data-example-ajax").select2({
        width: "off",
        ajax: {
            url: "{{url()}}/conatct/usersearch",
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

    function ApplyFilter()
    {
        var team_id = $('#received-team-filter').val();

        var redirect_url = '{{url("message-purchasing-team")}}?team_id='+team_id;

        window.location.href = redirect_url;
    }
</script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/vendor/tmpl.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/vendor/load-image.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.iframe-transport.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-process.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-image.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-audio.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-video.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-validate.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-file-upload/js/jquery.fileupload-ui.js')}}" type="text/javascript"></script>
@endsection
