@extends('admin.app')

@section('content')
<style>
    .preview img{width: 150px!important;}
    .text-danger{color: #fff!important;}
</style>
<div class="page-bar">
    <ul class="page-breadcrumb">
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
            <a href="{{url()}}/companies/{{$company->id}}">Companies</a>
            <i class="fa fa-circle"></i>
            @endif
        </li>
        <li>
            <span>Gallery</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">

    <div class="col-md-12 border2x_bottom">
        <h3 class="page-title uppercase">
            <i class="fa fa-plus color-black"></i>   Company Media Center
        </h3>

    </div>
</div>

<div class="row">


<div  class="portlet-body form">
@if (Session::has('message'))
<div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
@endif

<div class="mt-element-step">
    <div class="row step-line">
        <div id="company-first" class="col-md-3 mt-step-col first done">
            <div class="mt-step-number bg-white"><i class="fa fa-check"></i>  </div>
            <div class="mt-step-title uppercase font-grey-cascade">Contact Information</div>
        </div>
        <div id="company-forth" class="col-md-3 mt-step-col done">
            <div class="mt-step-number bg-white"><i class="fa fa-check"></i>  </div>
            <div class="mt-step-title uppercase font-grey-cascade">Company Administrator</div>
        </div>
        <div id="company-second" class="col-md-3 mt-step-col done">
            <div class="mt-step-number bg-white"><i class="fa fa-check"></i>  </div>
            <div class="mt-step-title uppercase font-grey-cascade">Company Information</div>
        </div>
        <div id="company-third" class="col-md-3 mt-step-col last active">
            <div class="mt-step-number bg-white">4</div>
            <div class="mt-step-title uppercase font-grey-cascade">Media Center</div>
        </div>
    </div>
</div>
@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@if (Session::has('message'))
<div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
@endif
@endif

<!-- BEGIN FORM-->

<div class="col-md-12">
    <form id="fileupload1" action="{{url('company/logo/upload')}}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="company_id" value="{{$company->id}}">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="form-body padding-15 fileupload-buttonbar">
            <h3 class="block bold align-left"><span style="font-size: 19px!important;">Upload a Company Logo</span></h3>
            <p class="caption-helper">This will serve as your company icon. For Best Results, upload a transparent background PNG file.</p>
            <div class="col-lg-7 paddin-npt">
                <!-- The fileinput-button span is used to style the file input field as button -->
                                    <span class="btn btn-circle  yellow-crusta color-black fileinput-button">
                                        <i class="fa fa-plus"></i>
                                        <span> Select and Upload </span>
                                        <input type="file" name="files[]" multiple> </span>
                <!--<button type="submit" class="btn btn-circle  blue start">
                    <i class="fa fa-upload"></i>
                    <span> Start upload </span>
                </button>
                <button type="reset" class="btn btn-circle  warning cancel">
                    <i class="fa fa-ban-circle"></i>
                    <span> Cancel upload </span>
                </button>-->

                <span style="padding: 0px 5px;">Select All</span>   <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"> </span>
            </div>

            <!-- The global progress information -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended"> &nbsp; </div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped clearfix">
            <tbody class="files"> </tbody>
        </table>

        <!-- The blueimp Gallery widget -->
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
            <div class="slides"> </div>
            <h3 class="title"></h3>
            <a class="prev"> ‹ </a>
            <a class="next"> › </a>
            <a class="close white"> </a>
            <a class="play-pause"> </a>
            <ol class="indicator"> </ol>
        </div>
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

    </form>
</div>

<!-- END FORM-->

<!-- BEGIN FORM-->
<div class="row" style="display: none">
    <div class="col-md-12">
        <form id="fileupload2" action="{{url('company/background/upload')}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="company_id" value="{{$company->id}}">
            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
            <div class="form-body padding-15 fileupload-buttonbar">
                <h3 class="block bold align-left"><span style="font-size: 19px!important;">Company Page Background Photo</span></h3>
                <p class="caption-helper">This will serve as your company background. </p>
                <div class="col-lg-7 paddin-npt">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-circle  yellow-crusta color-black fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span> Select and Upload </span>
                                            <input type="file" name="files[]" multiple> </span>
                    <!--<button type="submit" class="btn btn-circle  blue start">
                        <i class="fa fa-upload"></i>
                        <span> Start upload </span>
                    </button>
                    <button type="reset" class="btn btn-circle  warning cancel">
                        <i class="fa fa-ban-circle"></i>
                        <span> Cancel upload </span>
                    </button>-->

                    <span style="padding: 0px 5px;">Select All</span> <input type="checkbox" class="toggle">
                    <!-- The global file processing state -->
                    <span class="fileupload-process"> </span>
                </div>
                <!-- The global progress information -->
                <div class="col-lg-5 fileupload-progress fade">
                    <!-- The global progress bar -->
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                    </div>
                    <!-- The extended global progress information -->
                    <div class="progress-extended"> &nbsp; </div>
                </div>
            </div>
            <!-- The table listing the files available for upload/download -->
            <table role="presentation" class="table table-striped clearfix">
                <tbody class="files"> </tbody>
            </table>

            <!-- The blueimp Gallery widget -->
            <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                <div class="slides"> </div>
                <h3 class="title"></h3>
                <a class="prev"> ‹ </a>
                <a class="next"> › </a>
                <a class="close white"> </a>
                <a class="play-pause"> </a>
                <ol class="indicator"> </ol>
            </div>
            <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        </form>
    </div>
</div>
<!-- END FORM-->

<!-- BEGIN FORM-->

<div class="col-md-12">
    <form id="fileupload" action="{{url()}}/upload/gallery/file" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="company_id" value="{{$company->id}}">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="form-body padding-15 fileupload-buttonbar">
            <h3 class="block bold align-left"><span style="font-size: 19px!important;">Company Showcase Photos</span></h3>
            <p class="caption-helper">Upload up to nine horizontal Showcase Photos. These will appear on your Company Page.</p>
            <div class="col-lg-7 paddin-npt">
                <!-- The fileinput-button span is used to style the file input field as button -->
                                    <span class="btn btn-circle  yellow-crusta color-black fileinput-button">
                                        <i class="fa fa-plus"></i>
                                        <span> Select and Upload </span>
                                        <input type="file" name="files[]" multiple> </span>
                <!--<button type="submit" class="btn btn-circle  blue start">
                    <i class="fa fa-upload"></i>
                    <span> Start upload </span>
                </button>
                <button type="reset" class="btn btn-circle  warning cancel">
                    <i class="fa fa-ban-circle"></i>
                    <span> Cancel upload </span>
                </button>-->

                <span style="padding: 0px 5px;">Select All</span>  <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"> </span>
            </div>
            <!-- The global progress information -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended"> &nbsp; </div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped clearfix">
            <tbody class="files"> </tbody>
        </table>

        <!-- The blueimp Gallery widget -->
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
            <div class="slides"> </div>
            <h3 class="title"></h3>
            <a class="prev"> ‹ </a>
            <a class="next"> › </a>
            <a class="close white"> </a>
            <a class="play-pause"> </a>
            <ol class="indicator"> </ol>
        </div>
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->


        <div id="sub-action-button" class="form-actions right padding-top align-right">
            @if(isset($_REQUEST['setup']))
            <a href="{{url('company/additional')}}/{{$company->id}}?setup=profile" class="btn btn-circle  btn btn-circle -default red button-next"> <i class="fa fa-angle-left"></i>  Go Back</a>
            <button onclick="finishCompanyPage()" type="button" id="show-dashboad-select" class="btn btn-circle  button-submit yellow-crusta color-black bold"><i class="fa fa-check"></i>Complete Company Page</button>
            @else
            <a href="{{url('company/additional')}}/{{$company->id}}" class="btn btn-circle  btn btn-circle -default red button-next"> <i class="fa fa-angle-left"></i>  Go Back</a>
            @if($showCustomCongrates == 'yes')
            <a href="{{url('user-dashboard')}}?popup=completeCompanyProfile" class="btn btn-circle  button-submit yellow-crusta color-black bold"><i class="fa fa-check"></i>  Complete Company Page</a>
            @else
            <a href="{{url('user-dashboard')}}?popup=overview" class="btn btn-circle  button-submit yellow-crusta color-black bold"><i class="fa fa-check"></i>  Complete Company Page</a>
            @endif
            @endif
        </div>
    </form>
</div>

<!-- END FORM-->
</div>

</div>
</div>
<script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        </td>
        <td> {% if (!i && !o.options.autoUpload) { %}
            <button class="btn btn-circle  blue start" disabled>
                <i class="fa fa-upload"></i>
                <span>Start</span>
            </button> {% } %} {% if (!i) { %}
            <button class="btn btn-circle  red cancel">
                <i class="fa fa-ban"></i>
                <span>Cancel</span>
            </button> {% } %} </td>
    </tr> {% } %} </script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview"> {% if (file.thumbnailUrl) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                    <img src="{%=file.thumbnailUrl%}">
                </a> {% } %} </span>
        </td>
        <td>
            <p class="name"> {% if (file.url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
            <div>
                <span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td> {% if (file.deleteUrl) { %}
            <button class="btn btn-circle  red delete btn btn-circle -sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                <i class="fa fa-trash-o"></i>
                <span>Delete</span>
            </button>
            <input type="checkbox" name="delete" value="1" class="toggle"> {% } else { %}
            <button class="btn btn-circle  yellow cancel btn btn-circle -sm">
                <i class="fa fa-ban"></i>
                <span>Cancel</span>
            </button> {% } %} </td>
    </tr> {% } %}
</script>
<script>
    var FormFileUpload = function () {
        return {
            //main function to initiate the module
            init: function () {

                // Initialize the jQuery File Upload widget:
                $('#fileupload').fileupload({
                    disableImageResize: false,
                    autoUpload: true,
                    disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                    maxFileSize: 5000000,
                    maxNumberOfFiles : 8,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                });

                // Enable iframe cross-domain access via redirect option:
                $('#fileupload').fileupload(
                    'option',
                    'redirect',
                    window.location.href.replace(
                        /\/[^\/]*$/,
                        '/cors/result.html?%s'
                    )
                );

                // Upload server status check for browsers with CORS support:
                if ($.support.cors) {
                    $.ajax({
                        type: 'HEAD'
                    }).fail(function () {
                            $('<div class="alert alert-danger"/>')
                                .text('Upload server currently unavailable - ' +
                                    new Date())
                                .appendTo('#fileupload');
                        });
                }

                // Load & display existing files:
                $('#fileupload').addClass('fileupload-processing');
                $.ajax({
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                    url: $('#fileupload').attr("action"),
                    dataType: 'json',
                    context: $('#fileupload')[0]
                }).always(function () {
                        $(this).removeClass('fileupload-processing');
                    }).done(function (result) {

                        $(this).fileupload('option', 'done')
                            .call(this, $.Event('done'), {result: result});
                    });


                /// Logo

                // Initialize the jQuery File Upload widget:
                $('#fileupload1').fileupload({
                    disableImageResize: false,
                    autoUpload: true,
                    disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                    maxFileSize: 5000000,
                    maxNumberOfFiles : 1,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                });

                // Enable iframe cross-domain access via redirect option:
                $('#fileupload1').fileupload(
                    'option',
                    'redirect',
                    window.location.href.replace(
                        /\/[^\/]*$/,
                        '/cors/result.html?%s'
                    )
                );

                // Upload server status check for browsers with CORS support:
                if ($.support.cors) {
                    $.ajax({
                        type: 'HEAD'
                    }).fail(function () {
                            $('<div class="alert alert-danger"/>')
                                .text('Upload server currently unavailable - ' +
                                    new Date())
                                .appendTo('#fileupload1');
                        });
                }

                // Load & display existing files:
                $('#fileupload1').addClass('fileupload-processing');
                $.ajax({
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                    url: $('#fileupload1').attr("action"),
                    dataType: 'json',
                    context: $('#fileupload1')[0]
                }).always(function () {
                        $(this).removeClass('fileupload-processing');
                    }).done(function (result) {

                        $(this).fileupload('option', 'done')
                            .call(this, $.Event('done'), {result: result});
                    });


                /// Company Background

                // Initialize the jQuery File Upload widget:
                $('#fileupload2').fileupload({
                    disableImageResize: false,
                    autoUpload: true,
                    disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                    maxFileSize: 5000000,
                    maxNumberOfFiles : 1,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                });

                // Enable iframe cross-domain access via redirect option:
                $('#fileupload2').fileupload(
                    'option',
                    'redirect',
                    window.location.href.replace(
                        /\/[^\/]*$/,
                        '/cors/result.html?%s'
                    )
                );

                // Upload server status check for browsers with CORS support:
                if ($.support.cors) {
                    $.ajax({
                        type: 'HEAD'
                    }).fail(function () {
                            $('<div class="alert alert-danger"/>')
                                .text('Upload server currently unavailable - ' +
                                    new Date())
                                .appendTo('#fileupload1');
                        });
                }

                // Load & display existing files:
                $('#fileupload2').addClass('fileupload-processing');
                $.ajax({
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                    url: $('#fileupload2').attr("action"),
                    dataType: 'json',
                    context: $('#fileupload2')[0]
                }).always(function () {
                        $(this).removeClass('fileupload-processing');
                    }).done(function (result) {

                        $(this).fileupload('option', 'done')
                            .call(this, $.Event('done'), {result: result});
                    });
            }

        };

    }();

    jQuery(document).ready(function() {
        FormFileUpload.init();
    });
</script>
<script>
    /* for show menu active */
    $("#compnay-main-menu").addClass("active");
    $('#compnay-main-menu' ).click();
    $('#conpmay-menu-arrow').addClass('open');
    /* end menu active */
    $(document).on("click", ".viewImage", function () {
        var src = $(this).data('src');
        jQuery('#imageViewer .modal-body #image').attr( "src", src);
    });
    function finishCompanyPage(){
        $('#begin_tutorial').modal('show');
    }
</script>
@endsection
