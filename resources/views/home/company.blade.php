@extends('home.app')

@section('content')
<script src="{{URL::asset('metronic/plugins/jquery.min.js')}}" type="text/javascript"></script>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{URL::asset('metronic/scripts/app.min.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    
    <script src="{{URL::asset('metronic/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/jquery-multi-select/js/jquery.multi-select.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>

<style>
input, select, textarea {
    width: 100%;
    border: 1px solid #bababa;
    border-radius: 30px;
    padding: 10px;
    padding-left: 20px;
    outline: 0;
    margin-bottom: 30px;
}
.select2-results{color: #383333!important;}
.select2-container{display: block!important;}
.select2-container .select2-selection--single{height: 45px!important;line-height: 45px!important;color: #383333!important;}
.select2-search__field{color: #383333!important;}
.select2-container--default .select2-selection--single .select2-selection__rendered{color: #383333!important;font-size: 13px!important;text-align: left!important;}
.select2-selection__rendered{height: 45px!important;line-height: 45px!important;}
.select2-selection__arrow{top: 5px!important;}
</style>
<div class="signup-page-2">
    <div class="logo-header">
        <a href="{{url('')}}"><img src="{{URL::asset('frontend/images/Indy-John/Logo.png')}}" class="center-block" alt="logo" width="290"></a>
    </div>
    <div class="mask"></div>
    <div class="title text-center">
        <h2>Join your company </h2>
        <h3>Or create your company profile on Indy John</h3>
    </div>
    
    <div class="form">
        <form class="" role="form" method="POST" action="{{url('singup/company/save')}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="form-group">
            <div class="input-group company-name-input">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <select id="reg-industry" name="user_company" class="js-data-company-ajax form-control">
                            <option value="">Company Name</option>
                        </select>
                <span class="input-group-btn"><button class="btn btn-circle " type="submit">Select</button></span>
            </div>
        </div>
        </form>
        <!--<div class="form-group your-position-input">
            <div class="input-group">
                <input type="email" class="form-control" id="select-company-name" placeholder="Your Position">
                <span class="input-group-btn"><button class="btn btn-circle " type="submit">Next</button></span>
            </div>
        </div>-->
        <div class="text-center">
            <h5><a href="{{url('singup/add/company')}}">Not Listed? Add your Company</a></h5>
            <p class="small">By selecting an Existing Company, you certify that you are associated with the selected company. Your Company profile will be activated once your company admin approves your association.</p>
            <h5><a href="{{url('singup/user-picture')}}?skip=company">Skip this Step</a></h5>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<script>
$( "#main-body" ).addClass( "simple-page" );
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

$(".js-data-company-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/homepage/companySearch",
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
@include('home.footerlinks')
@endsection
