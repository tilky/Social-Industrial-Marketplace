<!-- BEGIN HEADER SEARCH BOX -->
<style>
.serach-head-btn {
	background: none!important;
	z-index: 1001!important;
}
.header-search {
	position: absolute!important;
}
</style>

<div class="col-md-12 paddin-bottom"> 
  
  <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
  
  <form class="search-form" action="{{url('general/search')}}"  method="GET" autocomplete="off">
    <div class="input-group pulsate-two-target pulsate-five-target pulsate-six-target pulsate-eight-target search_div"> @if(isset($_REQUEST['query']))
      <input type="text" class="form-control input-circle search-head-int" value="{{str_replace('+',' ',$_REQUEST['query'])}}" placeholder="Search People, Companies, Product-Categories, Service Providers and more." name="query">
      @else
      <input type="text" class="form-control input-circle search-head-int" placeholder="Search People, Companies, Product-Categories, Service Providers and more." name="query">
      @endif <span class="input-group-btn btn-circle header-search">
      <button type="submit" class="btn btn-circle submit serach-head-btn"> <i class="fa fa-search color-black"></i> </button>
      </span> </div>
  </form>
  <form class="new_search_form">
    <div class="new_search_bar">
      <ul>
        <li class="show_result"><a href="#">PEOPLE</a></li>
        <li class="show_result">|</li>
        <li class="show_result"><a href="#">COMPANIES</a></li>
        <li class="show_result">|</li>
        <li class="show_result"><a href="#">PRODUCTS</a></li>
        <li class="show_result">|</li>
        <li class="show_result"><a href="#">SERVICE PROVIDERS</a></li>
        <li class="show_result">|</li>
        <li class="show_result"><a href="#">JOBS</a></li>
        <li class="hide_result">
          <div class="form-group">
            <div class="input-icon right"> <a href="#" class="fa fa-times" aria-hidden="true"></a>
              <input type="text" class="form-control" placeholder="SEARCH FOR PEOPLE">
            </div>
          </div>
        </li>
        <li class="hide_result">
          <div class="input-icon"> <i class="glyphicon glyphicon-map-marker"></i>
            <input type="text" class="form-control" placeholder="UNITED STATES">
          </div>
        </li>
        <li>
          <button type="submit" class="btn btn-circle submit_btn"> <i class="fa fa-search"></i> SEARCH </button>
        </li>
      </ul>
    </div>
  </form>
</div>
<script>$(".show_result a").click(function(){
	$(".show_result").hide();
    $(".hide_result").show();
	
});

$(".hide_result a").click(function(){
    $(".hide_result").hide();
	$(".show_result").show();
});</script>
<!-- END HEADER SEARCH BOX --> 

