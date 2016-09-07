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
<div class="col-md-12 main_box">
<div class="row">
<div class="col-md-12 border2x_bottom">
<h3 class="page-title uppercase"> 
<i class="fa fa-check color-black"></i> START OR JOIN A COMPANY PAGE
</h3>
</div>
</div>
<div class="row">
<div class="col-md-12">
            <div  class="portlet-body form">
                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                @if (Session::has('message'))
                    <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                
                <div class="form-body padding-15" id="blockui_sample_1_portlet_body">
               

                    <h3 class="block bold font-red-mint align-left"><span style="font-size: 19px!important;">Claim or Join an existing company page now.</span></h3>
                    <form method="post" action="{{url('user/company-change/save')}}" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="profile_first_time" value="1" />
                        <div class="form-group">
                            <div class="col-md-12">
                               
                                <p class="caption-helper"><span class="font-red-mint">Option 1:</span> Search and Claim or Join an existing Company Page.</p><br>
                                <div class="col-md-12 paddin-npt">
                                    <select id="select2-button-addons-single-input-group-sm" name="company_id" class="form-control bold col-md-12 js-data-example-ajax" ></select>
                                </div>
                            </div>
                        </div>
                        <div id="company-address" class="form-group" style="display: none;">
                            
                        </div>
                        <div style="display: none;" id="select-company-btn">
                            <button type="submit" class="btn btn-circle yellow-crusta color-black button-next text-upper bold"> Join this company page</button>
                        </div>
                        <div id="select-claim-btn">

                        </div>
                    </form>
                    <p class="caption-helper"><span class="font-red-mint">Option 2: </span>Is your Company Not Listed? Create a New Company Page by adding a few details.</p>
                    <a href="{{url('companies/create')}}?setup=profile" class="btn btn-danger button-next text-upper bold"> Create A New Company Page </a>

                    <p />
                </div>
            </div>
            </div>

</div>
</div>
<script>
/* for show menu active */
$("#compnay-main-menu").addClass("active");
$('#compnay-main-menu' ).click();
$('#conpmay-menu-arrow').addClass('open');
$('#create-compnay-menu').addClass('active');
/* end menu active */
$(document).ready(function(){
    $('.show-dashboad-select').click(function(){
        $('#show-dashboad-select').trigger('click');
    })
})

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
    if(repo.id == '')
    {
        var cmp_id = 0;
    }
    else
    {
        var cmp_id = repo.id;
    }
    if(cmp_id != 0)
    {
        console.log(cmp_id);
        App.blockUI({
            target: '#blockui_sample_1_portlet_body',
            animate: true
        });

        var baseurl = "{{url('user/company/data')}}"+'/'+cmp_id;
        //console.log(baseurl); return false;
        jQuery.ajax({
            url: baseurl,
            type: 'get',
            success: function(data) {
                        //console.log(data.html);
                        $('#company-address').html('');
                        $('#company-address').html(data.html);
                        $('#company-address').show();
                        App.unblockUI('#blockui_sample_1_portlet_body');
                        if(data.claimCompany == 1){
                            $('#select-company-btn').hide();
                            var redirectUrl = '{{URL::to("/claim/companyOwner")}}?companyId='+data.companyId;
                                //'{{URL::to('/companies/')}}'+'/'+data.id+'/edit';
                            $("#select-claim-btn").html('<a href='+redirectUrl+' class="btn btn-circle yellow-crusta color-black button-next text-upper bold">Claim this Company</a>');
                        }else{
                            $('#select-company-btn').show();
                        }
                     },
            done: function() {
                //console.log('error');
            },
            error: function() {
                //console.log('error');
            }
            
        });
    }
}
var placeholder = 'Type and Select your Company to verify details'
$(".js-data-example-ajax").select2({
    placeholder:placeholder,
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
