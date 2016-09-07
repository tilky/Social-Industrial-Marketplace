@extends('buyer.app')



@section('content')
<style>

.slider {
	background-size: cover;
	background-repeat: no-repeat;
	height: 100%;
	min-height:100%;
	margin:0px !important;
	width:85%;
	position:fixed;
	bottom:33px;
	top:68px;
}
.search-form{ display:none !important;}
.slider_overlay {
	position: absolute;
	width: 100%;
	height: 100%;
	background: rgba(0, 0, 0, 0.5);
	color:#fff;
	text-align: center;
}

.banner_content {

position: absolute;

z-index: 9;

width: 100%;

text-align: center

}

.banner_header {

	font-size: 71px;

	font-weight: 100;
	color: #fff;
	display: block;

	padding-top:172px;

	margin: 0;

	text-transform: uppercase;

	font-family: 'Roboto', sans-serif;

}

.banner_header span {
	font-weight: 500;
	color: #2eca3b
}

.h3_head {

	font-size: 35px;

	font-weight: 300;

	color: #fff

}

.slider p {

	font-size: 16px

}

.formsearch {

	padding: 20px 70px

}

.formsearch input {

	width: 90%;

	padding: 15px 15px 15px 30px;

	border-radius: 30px 0px 0px 30px;

	border: 0;

	outline: 0;

	box-shadow: 1px 2px 10px #6B6B6B;

	font-size: 17px;

	color: #000;

	float: left;

}

.formsearch input:focus {

   

    outline: 0;

    box-shadow: 2px 4px 5px 0px rgba(0, 0, 0, 0.53) !important;



}

.formsearch .submit_search {

	width: 10%;

	padding: 17.5px;

	border: 0;

	border-radius: 0px 30px 30px 0px;

	background: #2eca3b;

	position: relative;

}

.formsearch .submit_search.hvr-bounce-to-right:before {

	background: #ccc;

	border-radius: 0px 30px 30px 0px;

}

/* Bounce To Right */
.inner_slide .btn, .inner_slide .btn-circle {
	background: #2eca3b;

	padding: 10px;
	color:#fff;
	border-radius: 50px !important;
	transition: all ease-in 0.3s;

	border: 0;

	display: inline-block;

	position: relative;

	text-transform: uppercase;

	font-family: 'Roboto', sans-serif;

	font-size: 16px;

	outline: 0;

	-webkit-transform: translateZ(0);

	transform: translateZ(0);

	box-shadow: 0 0 1px rgba(0, 0, 0, 0);

	-webkit-backface-visibility: hidden;

	backface-visibility: hidden;

	overflow: hidden;

	border: 2px solid transparent;
	width:300px;

}
.inner_slide .btn a, .inner_slide .btn_red a { width:100%; color:#fff; text-decoration:none;}
.learn_more a{ color:#FFF;}

.inner_slide .btn:hover, .inner_slide .btn:focus, .inner_slide .btn:active {
	color: #2eca3b;
	text-decoration: none;

	outline: 0;
	background: #fff;
}

.inner_slide .btn:hover:before, .inner_slide .btn:focus:before, .inner_slide .btn:active:before{

	-webkit-transform: scale(2);

	transform: scale(2);

}

.inner_slide .btn:hover a {
	color:#2eca3b;
}

.font18 {

	font-size: 18px

}

.font28 {

	font-size: 28px;

	font-weight: 400;

}

.inner_slide .bigbtn btn-circle {

	min-width: 375px;

	margin-top:80px;

}

.inner_slide .bigbtn btn-circle a {

	color: #fff;

	text-decoration: none

}

.inner_slide .bigbtn btn-circle a:hover {

	color: #2eca3b;

}

.inner_slide .bigbtn btn-circle span {

	margin: 0;

	display: block

}

.inner_slide .bigbtn btn-circle span.font18 {

	text-transform: capitalize

}

.inner_slide {

	height: 600px

}

.inner_slide .banner_header {

	padding-top: 80px;

	font-size: 60px;

	padding-bottom: 15px;

}

.no_padding{

	padding:0px !important

	}

 @media(max-width:991px) {
	  .slider {
	width:100%;
	position: relative;
    top: 0;
    bottom: 0;
	
}
.slider_overlay {
    position: relative;
    padding-bottom: 20px;
}

 .banner_header, .inner_slide .banner_header {

font-size: 31px;

padding-top: 25px;

}

 .h3_head {

font-size: 28px

}

.inner_slide .bigbtn btn-circle a {

padding: 20px!important;

padding: 10px!important;

display: inline-block;

}

}

@media (max-width: 767px) {

 .formsearch input {

 width: 80%;

}

.formsearch .submit_search {

 width: 20%;

}

}

@media (max-width: 640px) {

.formsearch {

 padding: 20px 0;

 width: 100%;

 float: left;

}

.inner_slide .bigbtn btn-circle {

 min-width: 240px;

}

.font18 {

font-size: 12px

}

.font28 {

font-size: 18px;

}

}



</style>
<link href="{{URL::asset('metronic/plugins/socicon/socicon.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li> <a href="{{url('user-dashboard')}}">Home</a> <i class="fa fa-circle"></i> </li>
    <li> <a href="{{url('job')}}">Jobs</a> <i class="fa fa-circle"></i> </li>
    <li> <span>Search Job</span> </li>
  </ul>
</div>
<div class="row">

  <div class="col-md-12 paddin-npt">
  
 <div class="slider inner_slide animatedParent" style="background-image: url({{url('images/industrial-jobs.jpg')}})">
      <div class="slider_overlay">
        <div class="col-xs-12">
          <h1 class="banner_header  animated bounceInDown slower">Welcome TO <span style="color:#2eca3b">JOB BOARD</span></h1>
          <h3 class="h3_head animated bounceInUp slower nomargin_top">Post or Search Industrial Jobs Now</h3>
          @if($errors->any())
          <div class="alert alert-danger"> @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach </div>
          @endif
          <div class="formsearch margin-top-30">
            <form method="post" action="{{url('jobs/search/list')}}" role="form" class="form-horizontal searchbar form-row-seperated" enctype="multipart/form-data">
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="text" name="search"  id="tags" placeholder="Search People, Jobs, Employers and more."/>
              <button type="submit" class="submit_search hvr-bounce-to-right"><i class="glyphicon glyphicon-search"></i></button>
              <div class="showresults"></div>
            </form>
          </div>
            <div class="btn btn-circle bigbtn btn-circle animated fadeIn slower margin-top-40"> 
                <a href="{{url('job/create')}}"> <h4 class="bold no-margin">Looking For Candidates ? </h4><h3 class="bold no-margin"> Post a Job </h3> </a> 
            </div>
          
          <div class="margin-top-10 learn_more"> <a href="#learn_more_job" data-toggle="modal" data-target="#learn_more_job"> <div class="font18">Learn More </div></a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>

    /* for show menu active */

    $("#jobs-main-menu").addClass("active");

	$('#jobs-main-menu' ).click();

	$('#jobs-menu-arrow').addClass('open')

	$('#jobs-search-menu').addClass('active');

    /* end menu active */

    $(document).ready(function() {

        $('#search-result-table').DataTable({

            columnDefs: [

              { targets: 'no-sort', orderable: false }

            ]

        });

    });

    $(document).on("click", "#deleteButton", function () {

        var id = $(this).data('id');

        jQuery('#deleteConfirmation .modal-body #objectId').val( id );

    });



    jQuery('#deleteConfirmation .modal-footer button').on('click', function (e) {

        var $target = $(e.target); // Clicked button element

        $(this).closest('.modal').on('hidden.bs.modal', function () {

            if($target[0].id == 'confirmDelete'){

                $( "#DELETE_FORM_" + jQuery('#deleteConfirmation .modal-body #objectId').val() ).submit();

            }

        });

    });

</script> 
<script src="{{URL::asset('metronic/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection 
