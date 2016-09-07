@extends('admin.app')

@section('content')
<style>
.preview img{width: 150px!important;}
.text-danger{color: #fff!important;}
</style>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url()}}/marketplaceproducts">Marketplace Products</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <a href="{{url()}}/marketplaceproducts/gallery/{{$product->id}}">Gallery</a>
            <i class="fa fa-circle"></i>  
        </li>
        <li>
            <span>Add Image</span>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-server color-black"></i>  Add Photos to Your Listing
</h3>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">
            
            <div  class="portlet-body form">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                
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
                <div class="mt-element-step">
                    <div class="row step-line">
                        <div id="company-first" class="col-md-6 mt-step-col first done">
                            <div class="mt-step-number bg-white"><i class="fa fa-check"></i>  </div>
                            <div class="mt-step-title uppercase font-grey-cascade">Product Information</div>
                        </div>
                        <div id="company-third" class="col-md-6 mt-step-col last active">
                            <div class="mt-step-number bg-white">2</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Product Photos</div>
                        </div>
                    </div>
                </div>
                <div class="yellow-crusta-seprator"></div>
                <!-- BEGIN FORM-->
                <div class="row">
                        <div class="col-md-12">
                            <form id="fileupload1" action="{{url('marketplaceproducts/upload/gallery/file')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="image_type" value="base" />
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                               
   <div class="col-md-12 font-red-mint">
   <div class="row">
<h3 class="block align-left">Upload and manage photos for this listing.</h3></div>
</div>



 <div class="form-body padding-15 fileupload-buttonbar">
                                    <h3 class="block bold align-left"><span style="font-size: 19px!important;">Upload the main photo for this Listing:</span></h3>
                                    <div class="col-lg-7 paddin-npt">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn btn-circle  yellow-crusta color-black fileinput-button">
                                                <i class="fa fa-plus"></i>  
                                                <span> Select and Upload </span>
                                                <input type="file" name="files[]" multiple=""> </span>
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
                <div class="row">
                        <div class="col-md-12">
                            <form id="fileupload" action="{{url('marketplaceproducts/upload/gallery/file')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="image_type" value="additional" />
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="form-body padding-15 fileupload-buttonbar">
                                    <h3 class="block bold align-left"><span style="font-size: 19px!important;">Upload up to 8 Additional Photos for this Listing: </span></h3>
                                    <div class="col-lg-7 paddin-npt">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn btn-circle  yellow-crusta color-black fileinput-button">
                                                <i class="fa fa-plus"></i>  
                                                <span> Select and Upload </span>
                                                <input type="file" name="files[]" multiple=""> </span>
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
                            
    
                            <div id="sub-action-button" class="form-actions right padding-top align-right">
                                
                                <a href="{{url('marketplace/mylistings')}}" class="btn btn-circle  button-submit yellow-crusta color-black bold"><i class="fa fa-check"></i>  Finish</a>
                            </div>
                        </form>
                        </div>
                    </div>
                <!-- END FORM-->
            </div>
        </div>
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
                    
            }

        };

    }();

    jQuery(document).ready(function() {
        FormFileUpload.init();
    });
</script>
<script>
/* for show menu active */
$("#marketplace-main-menu").addClass("active");
$('#marketplace-main-menu' ).click();
$('#marketplace-menu-arrow').addClass('open')
$('#marketplace-create-product-menu').addClass('active');
/* end menu active */
/* end menu active */
$(document).on("click", ".viewImage", function () {
    var src = $(this).data('src');
    jQuery('#imageViewer .modal-body #image').attr( "src", src);
});
</script>
@endsection
