<!-- BEGIN HEADER SEARCH BOX -->
<style>
.serach-head-btn{background: none!important;z-index: 1001!important;}
.header-search{position: absolute!important;}
.search-head-int{width: 475px!important;padding-left: 30px!important;}
@media(max-width:480px) {
.search-form .pulsate-eight-target{ width:100% !important;}
.search-head-int{width: 100%!important;}}
</style>
<div class="col-md-12 paddin-bottom">
<div class="col-md-4">&nbsp;</div>
<div class="col-md-5 paddin-npt">
    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
    <form class="search-form" action="{{url('general/search')}}"  method="GET" autocomplete="off">
        <div class="input-group pulsate-two-target pulsate-five-target pulsate-six-target pulsate-eight-target">
            @if(isset($_REQUEST['query']))
                <input type="text" class="form-control input-circle search-head-int" value="{{str_replace('+',' ',$_REQUEST['query'])}}" placeholder="Search People, Companies, Product-Categories, Service Providers and more." name="query">
            @else
                <input type="text" class="form-control input-circle search-head-int" placeholder="Search People, Companies, Product-Categories, Service Providers and more." name="query">
            @endif
            <span class="input-group-btn btn-circle header-search">
                <button type="submit" class="btn btn-circle submit serach-head-btn">
                    <i class="fa fa-search color-black"></i>  
                </button>
            </span>
        </div>
    </form>
</div>
<div class="col-md-3">&nbsp;</div>
<!-- END HEADER SEARCH BOX -->
</div>
