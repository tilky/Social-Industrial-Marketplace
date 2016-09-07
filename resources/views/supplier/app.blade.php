<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>QuoteTek Admin | Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600&subset=all' rel='stylesheet' type='text/css'>
    <link href="{{URL::asset('metronic/plugins/font-awesome/css/font-awesome.min.css')}}"" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/simple-line-icons/simple-line-icons.min.css')}}"" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/bootstrap/css/bootstrap.min.css')}}"" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/uniform/css/uniform.default.css')}}"" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}"" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}"" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/morris/morris.css')}}"" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/fullcalendar/fullcalendar.min.css')}}"" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/jqvmap/jqvmap/jqvmap.css')}}"" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{URL::asset('metronic/css/components-rounded.min.css')}}"" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{URL::asset('metronic/css/plugins.min.css')}}"" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/dropzone/basic.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{URL::asset('metronic/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{URL::asset('metronic/layouts/layout2/css/layout.min.css')}}"" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/layouts/layout4/css/themes/light.min.css')}}"" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{URL::asset('metronic/layouts/layout4/css/custom.min.css')}}"" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/jstree/dist/themes/default/style.min.css')}}"" rel="stylesheet" type="text/css" />

    <link href="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/jquery-file-upload/css/jquery.fileupload.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/jquery-file-upload/css/jquery.fileupload-ui.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <!-- Custome Style -->
    <link href="{{URL::asset('css/style.css')}}"" rel="stylesheet" type="text/css" />
    <!-- end Custome Style -->
    <link rel="shortcut icon" href="favicon.ico" />

    <script src="{{URL::asset('metronic/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{URL::asset('metronic/plugins/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jstree/dist/jstree.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{URL::asset('metronic/scripts/app.min.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{URL::asset('metronic/plugins/dropzone/dropzone.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{URL::asset('metronic/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>

    <script src="{{URL::asset('metronic/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery-multi-select/js/jquery.multi-select.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>

    <script src="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
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

    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
    
    <script src="{{URL::asset('metronic/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery-bootpag/jquery.bootpag.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/holder.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/pages/scripts/ui-general.min.js')}}" type="text/javascript"></script>

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">
<div id="deleteConfirmation" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to delete? </p>
                <input type="hidden" id="objectId"/>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-circle dark btn-outline">Cancel</button>
                <button id="confirmDelete" type="button" data-dismiss="modal" class="btn btn-circle green">Continue</button>
            </div>
        </div>
    </div>
</div>

<div id="imageViewer" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">View Image</h4>
            </div>
            <div class="modal-body">
                <img style="" alt="" src="" id="image"> </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-circle dark btn-outline">Close</button>
            </div>
        </div>
    </div>
</div>
@if(Session::get('user_type') == 'buyer')
@include('buyer.header')
@elseif(Session::get('user_type') == 'admin')
@include('admin.header')
@elseif(Session::get('user_type') == 'company')
@include('company.header')
@else
@include('supplier.header')
@endif

<!-- BEGIN CONTAINER -->
<div class="page-container">
@if(Session::get('user_type') == 'buyer')
@include('buyer.app-sidebar')
@elseif(Session::get('user_type') == 'admin')
@include('admin.app-sidebar')
@elseif(Session::get('user_type') == 'company')
@include('company.app-sidebar')
@else
@include('supplier.app-sidebar')
@endif
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<!-- BEGIN CONTENT BODY -->
<div class="page-content">
    @include('search.searchHead')
    @yield('content')
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<!-- END CONTENT BODY -->
</div>
<div class="clearfix"></div>
</div>
@include('supplier.footer')
<div class="clearfix"></div>
</body>

</html>
