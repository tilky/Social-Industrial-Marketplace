@extends('buyer.app')

@section('content')
<style>
    .select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url()}}/request-product-quotes">RECEIVED LEADS</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            Lead Request
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">
    <div class="col-md-12 border2x_bottom">
        <h3 class="page-title uppercase">
            <i class="fa fa-money color-black"></i> Share Lead Request
        </h3>
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
                {!! Form::open(['url'=>'leadRequest/sent','class'=>'form-horizontal','method'=>'POST']) !!}
                <input type="hidden" name="createdBy" value="{{$sender}}">
                <input type="hidden" name="quoteId" value="{{$quoteId}}">
                <div class="form-body">
                    <div class="inbox-body">
                        <div class="inbox-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Share With Your Connections:</label>
                                        <select data-placeholder="Search Your Connection" id="select2-button-addons-single-input-group-sm" name="recipients[]" class="form-control col-md-12 js-data-example-ajax"  multiple>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Subject Form Input -->
                                    <div class="form-group">
                                        <label class="control-label">OR</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Subject Form Input -->
                                    <div class="form-group">
                                        <label class="control-label">Share by Email : (Enter Multiple Email Separated With Comma)</label>
                                        <input type="text" name="emails" value="" class="form-control" placeholder="Enter E-Mail" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions right">
                    <a href="{{ URL::to('request-product-quotes') }}" class="btn btn-danger btn-sm bold">
                        Cancel </a>
                    <button type="submit" class="btn btn-circle yellow-crusta color-black bold">
                        <i class="fa fa-check"></i> Send</button>
                </div>
                {!! Form::close() !!}
                <!-- END FORM-->

            </div>
        </div>
        <div>
        </div>
    </div>
</div>
<script>
    /* for show menu active */
    $("#messenger-main-menu").addClass("active");
    $('#messenger-main-menu' ).click();
    /* end menu active */

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

</script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/fancybox/source/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>
@endsection
