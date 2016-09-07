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
.select2-container{display: block!important;}
.select2-container .select2-selection--single{height: 35px!important;line-height: 35px!important;color: #383333!important;}
.select2-search__field{color: #383333!important;}
.select2-container--default .select2-selection--single .select2-selection__rendered{color: #383333!important;font-size: 13px!important;text-align: left!important;}
.select2-selection__rendered{height: 35px!important;line-height: 35px!important;}
.select2-selection__arrow{top: 5px!important;}
</style>
<div class="complany-signup-page">
    <div class="logo-header">
        <a href="{{url('')}}"><img src="{{URL::asset('frontend/images/Indy-John/Logo.png')}}" class="center-block" alt="logo" width="290"></a>
    </div>
    <div class="mask"></div>
    <div class="title text-center">
        <h2>Add your company </h2>
    </div>
    <form class="" role="form" method="POST" action="{{url('company/new/save')}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="form">
        @if(count($errors) > 0)
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                &times;
            </button>
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
        @endif
        <div class="form-body">
            <div class="form-group">
                <input type="text" class="form-control" name="company_name" id="company-name" value="{{Request::old('company_name')}}" placeholder="Company Name" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address_1" id="Address-Line-1" value="{{Request::old('address_1')}}" placeholder="Address Line 1" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address_2" id="Address-Line-2" value="{{Request::old('address_2')}}" placeholder="Address Line 2" required>
            </div>

            <div class="form-group">
                <input type="text" class="form-control  col-md-4" name="city" id="City" value="{{Request::old('city')}}" placeholder="City" required>
                <input type="text" class="form-control col-md-4" name="state" id="State" value="{{Request::old('state')}}" placeholder="State" required>
                <input type="text" class="form-control col-md-4" name="zip" id="Zip" value="{{Request::old('zip')}}" placeholder="Zip" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="country" id="Country" value="{{Request::old('country')}}" placeholder="Country" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="phone" id="Phone-Number" value="{{Request::old('phone')}}" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="E-mail" value="{{$email}}" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <input type="url" class="form-control" name="website" id="Website" value="{{Request::old('website')}}" placeholder="Website">
            </div>
            <div class="form-group">
                <select id="reg-industry" name="company_industry" class="js-data-industry-ajax form-control">
                    <option value="">Select Your Main Industry</option>
                </select>
            </div>
            
            <div class="form-group">
                <select class="form-control" name="employees_count">
                    <option value="">Number of Employees</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">SUBMIT</button>
            </div>
            <div class="text-center">
                <p class="small">
                    By selecting an Existing Company, you certify that you are associated with the selected company. Your Company profile will be activated once your company admin approves your association.
                </p>
                <a href="{{ redirect()->back()->getTargetUrl() }}">Back</a>
            </div>
        </div>
    </div>
    </form>
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

$(".js-data-industry-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/homepage/industrySearch",
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
