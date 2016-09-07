@extends('admin.app')

@section('content')
<style>
.select2-container{display: block!important;}
</style>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('sa')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            @if(Auth::user()->access_level == 1)
            <a href="{{url('companies')}}">Companies</a>
            <i class="fa fa-circle"></i>
            @else
            <a href="{{url('companies')}}/{{$company->id}}">Companies</a>
            <i class="fa fa-circle"></i>
            @endif
        </li>
        <li>
            <a href="{{url('companies/info')}}/{{$company->id}}">Additional Information</a>
            <i class="fa fa-circle"></i>
        </li>
    </ul>
</div>
<div class="col-md-12 main_box">
<div class="row">

<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
 <i class="fa fa-exchange"></i> Change Your Company
</h3>
</div>
</div>
<div class="row">
    <div class="col-md-12">
            <div class="portlet-body form" id="blockui_sample_1_portlet_body">
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <div class="col-md-12 padding-top">
                    <p class="caption-helper bold strong font-red-mint "><b>Search and be assigned to another Company Page, or <a href="../companies/create"> Start a New Company Page</a>.</b></p>
                </div>
                
                <!-- responsive -->
            


            <div class="modal fade begin_tutorial" id="responsive-company"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="40" width="220" /></div>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body full_padding">
                            <div class=" text-uppercase text-center">
                                Thank you for your submission, your company selection is pending company administrator confirmation.
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                          <h5>&nbsp;</h5>
                       
                        </div>
                    </div>
                </div>
            </div>
 




            <!-- end -->    
                <form id="change-company-form" method="post" action="{{url('user/company-change/save')}}" class="form-horizontal form-row-seperated">
                    <div class="form-body">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label class="col-md-12">Search an Existing Company Page:</label>
                            <div class="col-md-12">
                                <select id="select2-button-addons-single-input-group-sm" name="company_id" class="form-control col-md-12 js-data-example-ajax" >
                                    <option value="{{$company->id}}" selected="">{{$company->name}}</option>
                                </select>
                            </div>
                        </div>
                        <div id="company-address" class="form-group" style="display: none;">
                        </div>

 

                    </div>


                    <div class="form-actions right">

                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('user/currentCompany')}}" class="btn btn-circle btn-danger">Cancel</a>
                                <button type="button" onclick="showModal();" class="btn btn-circle btn-circle yellow-crusta color-black bold ">
                                    <i class="fa fa-check"></i> Confirm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>





        <!-- END PORTLET-->
    </div>
</div>
</div>
<script>
/* for show menu active */
$("#compnay-main-menu").addClass("active");
$('#compnay-main-menu' ).click();
$('#conpmay-menu-arrow').addClass('open');
/* end menu active */
$( document ).ready(function() {
    $('#company_accreditations').multiSelect();
});

function showModal()
{
    $('#responsive-company').modal('show');
    $('#change-company-form').submit();
}
</script>
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

@endsection
