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
                                    <input type="text" name="company_id" class="form-control bold col-md-12" value="{{$companyName}}">
                                </div>
                            </div>
                        </div>
                        <div id="select-company-btn">
                            <button id="{{$companyId}}" type="button" onclick="claimCompany(id);" class="btn btn-circle yellow-crusta color-black button-next text-upper bold"> Claim this Company</button>
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

    var placeholder = 'Type and Select your Company to verify details'

    $(".js-btn-set-scaling-classes").on("click", function() {
        $("#select2-multiple-input-sm, #select2-single-input-sm").next(".select2-container--bootstrap").addClass("input-sm");
        $("#select2-multiple-input-lg, #select2-single-input-lg").next(".select2-container--bootstrap").addClass("input-lg");
        $(this).removeClass("btn-primary btn-outline").prop("disabled", true);
    });

    function claimCompany(id){
        var companyId = id;
        var baseurl = '{{URL::to("/claim/companyOwner/")}};

            $.ajax({
            type : 'POST',
            url : baseurl,
            data:{
                '_token':'{{csrf_token()}}',
                'companyId':companyId
            },
            success:function(data) {
                var companyId = data.companyId;
                var redirectUrl = '{{URL::to("/companies/")}}/'+companyId+'/edit';
                window.location.href = redirectUrl;
            },
            done: function() {
            },
            error: function() {
            }
        });

    }
</script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endsection
