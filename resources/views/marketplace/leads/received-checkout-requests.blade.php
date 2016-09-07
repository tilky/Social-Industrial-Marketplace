@extends('buyer.app')

@section('content')
<style>
.select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url()}}/user-dashboard">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{url()}}/">Review Left</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Send Review</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box yellow-crusta">
            <div class="portlet-title">
                <div class="caption color-black">
                    <i class="fa fa-envelope color-black"></i>Send Review</div>
            </div>

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
                'route' => 'review.store',
                'class' => 'horizontal-form',
                ]) !!}
                <input type="hidden" name="sender_id" value="{{$userData->user_id}}" />
                <input id="ratings-hidden" name="stars" type="hidden">
                <input type="hidden" name="status" value="1" />
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label">Select Contact:</label>
                                <select id="select2-button-addons-single-input-group-sm" name="receiver_id" class="form-control col-md-12 js-data-example-ajax" >
                                @if($receiver_id != '')
                                <option value="{{$receiver_id}}" selected="">{{$receiverData['first_name']}} {{$receiverData['last_name']}}</option>
                                @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Subject Form Input -->
                            <div class="form-group">
                                <label class="control-label">Title:</label>
                                <input type="text" name="title" class="form-control" value="{{Request::old('title')}}" placeholder="Review Title" maxlength="50" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Message Form Input -->
                            <div class="form-group">
                                <label class="control-label">Review Text:</label>
                                <textarea name="comment" class="form-control" placeholder="Review Text" maxlength="250">{{Request::old('comment')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Subject Form Input -->
                            <div class="form-group">
                                <label class="control-label">Stars:</label>
                                <div class="stars starrr" data-rating="0"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-actions right">
                            <a href="{{ URL::to('review-sent') }}" class="btn btn-danger bold btn-sm">
                                Cancel </a>
                            <button type="submit" class="btn btn-circle yellow-crusta color-black bold">
                                <i class="fa fa-check"></i> Send</button>
                        </div>
                    </div>
                
                {!! Form::close() !!}
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
<script>
    /* for show menu active */
    $("#review-main-menu").addClass("active");
	$('#review-main-menu' ).click();
    $('#review-menu-arrow').addClass('open');
    /* end menu active */
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
        url: "{{url()}}/review-usersearch",
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
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/starrr.js')}}" type="text/javascript"></script>
@endsection
