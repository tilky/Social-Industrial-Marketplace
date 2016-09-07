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
            <a href="{{url('user-dashboard')}}">Dashboard</a>
        </li>
        <li>
            <span>User Detail</span>
        </li>
    </ul>
</div>
<h3 class="page-title"> 
Welcome, {{Auth::user()->userdetail->first_name}} {{Auth::user()->userdetail->last_name}}
</h3>
<div class="row">
    <div class="portlet light bordered" id="form_wizard_1">
        <div  class="portlet-body form">
            @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
            @endif
            <div class="form-wizard">
                <div class="form-body">
                    <ul class="nav nav-pills nav-justified steps">
                        <li class="active">
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="number"> 1 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Company Setup </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Billing & Plans </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);return false;" data-toggle="tab" class="step">
                                <span class="number"> 3 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i> Invite & Earn </span>
                            </a>
                        </li>
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success" style="width: 33.33%!important;"> </div>
                    </div>
                    <h3>Select your Company:</h3>
                    <div id="blockui_sample_1_portlet_body">
                    <form method="post" action="{{url('user/company-change/save')}}" class="form-horizontal form-row-seperated">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="first_time" value="1" />
                        <div class="form-group">
                            <div class="col-md-6">
                                <!--<label for="inputEmail3" class="control-label">Select Company:</label>-->
                                <select id="select2-button-addons-single-input-group-sm" name="company_id" class="form-control col-md-12 js-data-example-ajax" >
                                    @if($userData->company_id != '')<option value="{{$userData->company_id}}" selected="">{{$userData->company_name}}</option>@endif
                                </select>
                            </div>
                        </div>
                        <div id="company-address" class="form-group" style="display: none;">
                            
                        </div>
                        <div>
                        <h4><b><a href="{{url('user/company/create')}}">Not Listed? Add your Company</a></b></h4>
                        </div>
                        <div class="form-actions right padding-top align-right">
                            <!--<a href="{{url('user-details')}}" class="btn btn-circle default button-previous">
                                <i class="fa fa-angle-left"></i> Back </a>-->
                            <a href="{{url('user/billing/plans')}}" class="btn btn-danger">Skip </a>
                            <button type="submit" class="btn btn-circle yellow-crusta color-black button-next"> Continue
                                <i class="fa fa-angle-right"></i>
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var cnt = 0;
function formatRepo(repo) {
    if (repo.loading) return repo.text;
    
    var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + repo.full_name +"</div>";
    
    markup += "</div></div>";

    return markup;
}

function formatRepoSelection(repo) {
    cnt++
    if(cnt%2)
    {
        showaddress(repo);    
    }
    
    return repo.full_name || repo.text;
}

function showaddress(repo)
{
    App.blockUI({
        target: '#blockui_sample_1_portlet_body',
        animate: true
    });
    
    if(repo.id == '')
    {
        var cmp_id = 0;
    }
    else
    {
        var cmp_id = repo.id;
    }
    var baseurl = "{{url('user/company/data')}}"+'/'+cmp_id;
    
    jQuery.ajax({
        url: baseurl,
        type: 'get',
        success: function(data) {
                    //console.log(data.html);
                    $('#company-address').html('');
                    $('#company-address').html(data.html);
                    $('#company-address').show();
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

$(".js-data-example-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/user-companysearch",
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
<script src="{{URL::asset('metronic/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}" type="text/javascript"></script>
<!--<script src="{{URL::asset('metronic/pages/scripts/form-wizard.min.js')}}" type="text/javascript"></script>-->
@endsection
