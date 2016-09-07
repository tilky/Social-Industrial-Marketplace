@extends('admin.app')

@section('content')
<link href="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-summernote/summernote.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/sa">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{$templateName}}</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-server"></i>{{$templateName}} </div>
            </div>
            <div class="portlet-body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <!-- BEGIN FORM-->
                {!! Form::open([
                'route' => 'emailtemplates.store',
                'class' => 'horizontal-form',
                ]) !!}
                    <input type="hidden" name="template_id" value="{{$template_id}}" />
                    <input type="hidden" name="template_name" value="{{$templateName}}" />
                    <input type="hidden" name="backlink" value="email/templates/{{$template_id}}" />
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <span class="required" aria-required="true"> * </span>
                                    <textarea name="content" id="summernote_1">{{$content}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <a href="{{ URL::to('sa') }}" class="btn btn-circle btn-sm">
                            Cancel </a>
                        <button type="submit" class="btn btn-circle blue">
                            <i class="fa fa-check"></i> Save</button>
                    </div>
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<script>
var tenplate_id = '{{$template_id}}';
/* for show menu active */
$("#email-template-main-menu").addClass("active");
$('#email-template-main-menu' ).click();
$('#email-template-arrow').addClass('open')
$('#new-template-menu-'+tenplate_id).addClass('active');
/* end menu active */
$(document).ready(function() {
  $('#summernote_1').summernote({
    height: 350,
  });
  
});
</script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-markdown/lib/markdown.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-summernote/summernote.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
@endsection
