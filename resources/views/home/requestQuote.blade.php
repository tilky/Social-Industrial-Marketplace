@extends('home.header')

@section('content')
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
</style>
</style>
<link href="{{URL::asset('css/style_custom.css')}}" rel="stylesheet">
<!-- Custome Style -->
    <link href="{{URL::asset('css/style.css')}}"" rel="stylesheet" type="text/css" />
    <!-- end Custome Style -->
    

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
.select2-container{display: block!important;width: 80%;float: right;}
.select2-container .select2-selection--single{height: 45px!important;}
.about-header{height: 100%!important;float: left!important;}
.requestquote{width: 33%!important;right: 8%!important;}
.select2-selection__rendered{height: 45px!important;line-height: 40px!important;}
.select2-selection__arrow{top: 10px!important;}
</style>

<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />

<div class="slider inner_slide banner_form" style="background-image: url({{URL::asset('images/banner_3.jpg')}})">
    <div class="slider_overlay">
        <div class="container vericle_table animatedParent"> 
            <div class="col-md-8 verticle_row">
                <h1 class="banner_header  animated bounceInDown slower">Never overpay  <span>again</span></h1>
                <p>Complete a simple Order from and have unlimated access  to all Our Suppliers</p> 
                <h3 class="h3_head   animated fadeIn slower">START GETTING QUOTES FOR  <br />  YOUR SPECIFIC NEEDS</h3>
            </div> 
        </div> 
    </div>
</div>
         
<div class="requestquote register clearfix animatedParent">
    <div class="row animated fadeIn slower">
        <form class="form-horizontal" role="form" method="POST" action="{{url('requestquote/save')}}">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-6 paddin_rt5"><input type="text" name="firstname" placeholder="First Name" value="{{ old('name') }}"/></div>
            <div class="col-md-6 paddin_lt5"><input type="text" name="lastname" placeholder="Last Name"/></div>
            <div class="col-md-12"><input type="email" name="email" placeholder="E-Mail" value="{{ old('email') }}"/></div>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <div class="auto-widget">
                    <label style="width: 20%;">Product </label>
                    <select id="select2-button-addons-single-input-group-sm" name="product" class="form-control col-md-12 js-data-products-ajax" style="80%"></select>
                </div>
            </div>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <div class="auto-widget">
                    <label style="width: 20%;">Category </label>
                    <select id="select2-button-addons-single-input-group-sm" name="category" class="form-control col-md-12 js-data-category-ajax" style="80%"></select>
                </div>
            </div>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <div class="auto-widget">
                    <label style="width: 20%;">Industry </label>
                    <select id="select2-button-addons-single-input-group-sm" name="industry" class="form-control col-md-12 js-data-industries-ajax" style="80%"></select>
                </div>
            </div>
            <div class="col-md-12"><button type="submit" class="btn_red hvr-bounce-to-right col-md-12">Submit</button> </div> 
        </form>
    </div>
</div>     
<div class="color_bg feedback animatedParent">
    <div class="container"> 
          <h3 class="head_railway padding100 text-center animated shake slower">&rdquor; Let Us Help You Find The Best Quote. &rdquor;</h3> 
    </div>
</div>
<div class="section fade">
  <div class="container animatedParent">
      <h3 class="header_middle text-center  animated fadeIn">How Does QuoteTek Work?</h3>
      
      
      
         
           <div class="row redprocess section">
               <div class="leftright_section">
                   <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('images/user2.png')}}" alt=""/></i>Buyers search and submit online Quote
Requests by selecting specific technical 
Product-Categories.</div> 
                
               <div class="number_text left_icon hovicon effect-1 animation-element slide-left">1</div> 
           </div>
               
               <div class="clearfix"></div>
               
               
               <div class="leftright_section pull-right border_middle_ver">
                    <div class="number_text right_icon hovicon animation-element slide-right">2</div>
               <div class="col-md-9 col-sm-9 wh_border wh_borderleft"><i class="lefticon"><img src="{{URL::asset('images/share2.png')}}"  alt=""/></i> QuoteTek matches and connects the
Buyer with Suppliers who can provide 
these product services.</div> 
           </div>
               
               <div class="clearfix"></div> 
               
                    <div class="leftright_section">
               <div class="col-md-9 col-sm-9 wh_border wh_borderright"><i class="lefticon"><img src="{{URL::asset('images/listen2.png')}}" alt=""/></i>This is where we step away and allow
Suppliers to contact the Buyer directly
with quotes.</div> 
               <div class="number_text left_icon hovicon animation-element slide-left">3</div> 
           </div>
                  
           
           
          </div>
      
      
  </div>
</div>
<div class="clearfix"></div>
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

$(".js-data-products-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/homepage/productSearch",
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
$(".js-data-category-ajax").select2({
    width: "off",
    ajax: {
        url: "{{url()}}/homepage/categorySearch",
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
$(".js-data-industries-ajax").select2({
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
