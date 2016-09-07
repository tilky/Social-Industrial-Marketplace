@extends('buyer.app')

@section('content')
    <style>
	.profile_details {
   
    overflow-y: scroll;
    height: 100vh;
}
        .product_demo .owl-prev{top: 30%!important; left: -15px!important;}
        .product_demo .owl-next{top: 30%!important; right: -15px!important;}
        .content-img{width: 97%!important;}
        .owl-item{padding: 0px 10px!important;}
        .test_descri{font-size: 18px;}
        .thumbnail{position: relative;}
        .white_carasoul .owl-pagination{margin-top: 20px!important;}
        .section {padding: 0px !important;}
    </style>
    <link href="{{URL::asset('metronic/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('metronic/pages/css/invoice-2.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{URL::asset('css/style_custom.css')}}" rel="stylesheet">
    <link href="{{URL::asset('js/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('css/animations.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/prettyPhoto.css')}}">

    <link rel="stylesheet" href="{{URL::asset('css/owl.theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/ng_responsive_tables.css')}}">
    <style>
        .invoice-content-2 {
            border-radius: 5px;
            margin: 10px;
            padding: 0 !important;
        }
        .list-inline>li{padding: 0px!important;}
        .padding-right-20{padding-right: 20px!important;}
        .btn_org-silver {
            background: #c0c0c0 none repeat scroll 0 0;
            border: 2px solid transparent;
            border-radius: 10px;
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            display: inline-block;
            font-family: "Raleway",sans-serif;
            font-size: 20px;
            font-weight: 500;
            overflow: hidden;
            padding: 5px 30px;
            position: relative;
            text-transform: uppercase;
            transform: translateZ(0px);
            transition: all 0.3s ease-in 0s;
            width: 100%;
            margin-top: 5px;
            color: #000!important;
        }
    </style>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('user-dashboard')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>User</span>
            </li>
        </ul>
    </div>
    <div class="col-md-12 main_box" >
    <div class="row">
        <div class="col-md-12 paddin-npt">
            @if (Session::has('message'))
                <div id="" class="custom-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>{{ Session::get('message') }}</div>
                @endif
                <!-- BEGIN PROFILE CONTENT -->
                <div class="invoice-content-2 bordered">
                    <div class="section fade">
                        <div class="profile-inner-section">
                            <div class="col-md-3 text-center profile_info">

                                <div class="stopMenu">
                                    <div class="relative">
                                        @if($company->user != '')
                                            @if($company->user->quotetek_verify == 1)
                                            <span class="verified-text pull-left">
                                                <a class="btn btn-circle btn-icon-only light-green" href="javascript:;">
                                                    <i class="fa fa fa-check"></i>
                                                </a>
                                            Verified
                                            </span>
                                            @else
                                            <span class="verified-text pull-left">
                                                <a class="btn btn-circle btn-icon-only red" href="javascript:;">
                                                    <i class="fa fa fa-close"></i>
                                                </a>
                                                NOT VERIFIED
                                            </span>
                                            @endif
                                        @endif
                                        <a class="btn btn-circle btn-icon-only bordered pull-right" href="{{url('user/company/save')}}/{{$company->id}}">
                                            <i class="fa fa-save"></i>
                                        </a>
                                        <div class="profile" style="margin-top: 0px!important;">
                                            @if($company->logo != '')
                                            <img src="{{url('')}}/{{$company->logo}}" width="230" height="221" alt="{{$company->name}}" style="border-radius: 50%;">
                                            @else
                                            <img src="{{url('images/default-user.png')}}" width="80px">
                                            @endif
                                        </div>
                                        <div class="profile_name">{{$company->name}}</div>
                                        <div class="position">{{$company->city}}, {{$company->state}}, {{$company->country}}</div>
                                        <div class="company_name">{{$company->website}}</div>
                                        <div class="membership">
                                            @if($company->star == 'gold')
                                            <a class="btn yellow-crusta color-black btn-circle font-yellow-crusta" href="">GOLD SUPPLIER</a>
                                            @elseif($company->star == 'silver')
                                            <a href="" class="btn yellow-crusta color-black btn-circle font-yellow-crusta">SILVER SUPPLIER</a>
                                            @else
                                            <a href="" class="btn yellow-crusta color-black btn-circle font-yellow-crusta silver-member">FREE MEMBER</a>
                                            @endif
                                        </div>
                                    </div>
                                    @if($company->user_id != Auth::user()->id)
                                    <div class="todo-tasklist">
                                        <div class="todo-tasklist-item todo-tasklist-item-border-green">
                                            <a href="{{url('contactusers/contact/send')}}/{{Auth::user()->id}}/{{$company->user_id}}"><i class="fa fa-home pull-left"></i>
                                                <div class="todo-tasklist-item-title"> CONNECT </div></a>
                                        </div>

                                        <!--<div class="todo-tasklist-item todo-tasklist-item-border-green">
                                            <a href="#message_modal" data-toggle="modal" data-target="#message_modal"> <i class="fa fa-cog  pull-left"></i>
                                                <div class="todo-tasklist-item-title"> Message </div></a>
                                        </div>-->
                                        <div class="todo-tasklist-item todo-tasklist-item-border-green">
                                            <a href="#message_modal" data-toggle="modal" data-target="#message_modal" onclick="messageUser({{$company->user_id}})"> <i class="fa fa-cog  pull-left"></i>
                                            <div class="todo-tasklist-item-title"> Message </div></a>
                                        </div>

                                        <div class="todo-tasklist-item todo-tasklist-item-border-green">
                                            <a href="#share" data-toggle="modal" data-target="#share"> <i class="fa fa-info-circle pull-left"></i>
                                                <div class="todo-tasklist-item-title"> Share Profile </div></a>
                                        </div>

                                        <div class="todo-tasklist-item todo-tasklist-item-border-green">
                                            <a href="{{url('endorse-user')}}/{{Auth::user()->id}}/{{$company->user_id}}"> <i class="fa fa-info-circle pull-left"></i>
                                                <div class="todo-tasklist-item-title"> Endorse </div></a>
                                        </div>

                                        <div class="todo-tasklist-item todo-tasklist-item-border-green">
                                            <a href="#"><i class="fa fa-skype pull-left"></i>
                                                <div class="todo-tasklist-item-title"> Video Call </div></a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="profile_social_link">
                                        <div class="btn-group btn-group-solid">
                                            @if($facebookUrl != '')
                                            <a href="{{$facebookUrl}}" target="_blank"><button class="btn blue" type="button"><i class="fa fa-facebook"></i></button></a>
                                            @endif
                                            @if($twitterUrl != '')
                                            <a href="{{$twitterUrl}}" target="_blank"><button class="btn navy-blue" type="button"><i class="fa fa-twitter"></i></button></a>
                                            @endif
                                            @if($instaUrl != '')
                                            <a href="{{$instaUrl}}" target="_blank"><button class="btn light-grey" type="button"><i class="fa fa-linkedin "></i></button></a>
                                            @endif
                                            @if($youtubeUrl != '')
                                            <a href="{{$youtubeUrl}}" target="_blank"><button class="btn orange" type="button"><i class="fa fa-youtube"></i></button></a>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="#report_page" data-toggle="modal" data-target="#report_page" class="report_page text-center">REPORT</a><br>
                                    @if($claimCompany == 1)
                                    <a href="{{url('claimCompany/start')}}/{{$company->id}}">CLAIM THIS COMPANY PAGE</a>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-9 profile_details">
                                <div class="profile_details_inner">
                                    <!-- Nav tabs -->

                                    <div class="profile-details-block aboutme">
                                        
                                        <div class="col-md-12  hide_print paddin-bottom">
                                          <div class="col-md-9 col-sm-9">
                                            <div class="row">
                                              &nbsp;
                                            </div>
                                          </div>
<!--
                                          <div class="col-md-3 col-sm-3 text-right">
                                            <div class="row">
                                              <div class="actions margin-top-10">
                                                <div class="btn-group"> <a class="btn btn-circle action_bg btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                                                  <ul class="dropdown-menu pull-right">
                                                    <li> <a href="javascript:void(0)" id="{{url('view/company')}}/{{$company->external_url}}" onclick="showShare(id,'{{$company->name}}')">Share</a></li>
                                                  </ul>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
-->
                                        </div>
                                        
                                        <h3>About {{$company->name}}<span class="pull-right">User ID: {{$company->unique_number}}</span></h3>
                                        <div class="profile-block col-md-12">
                                            <p>{{$company->description}} </p>

                                            <div class="mt-element-list">

                                                <div class="mt-list-container list-simple">
                                                    <ul>
                                                        @if(count($company->industries) > 0)
                                                        <li class="mt-list-item">
                                                            @foreach($company->industries as $index=>$industry)
                                                            <a class="btn dark btn-red btn-circle btn-sm" href="javascript:;">
                                                                {{$industry->industry->name}}
                                                            </a>
                                                            @endforeach
                                                        </li>
                                                        @else
                                                        No industry found
                                                        @endif

                                                        @if(count($company->types) > 0)
                                                        <li class="mt-list-item">
                                                            <i class="fa fa-circle"></i>
                                                            <span class="list-content">
                                                                Industry Classification:
                                                                @foreach($company->types as $index=>$type)
                                                                    @if($index == 0)
                                                                    {{$type->type->name}}
                                                                    @else
                                                                    ,{{$type->type->name}}
                                                                    @endif
                                                                @endforeach
                                                            </span>
                                                        </li>
                                                        @endif

                                                        <li class="mt-list-item">
                                                            <i class="fa fa-circle"></i>
                                                            <span class="list-content">Established:{{$company->establishment_year}}. Joined Quotetek: @if(strtotime($company->created_at) == 0) N/A @else {{date('Y',strtotime($company->created_at))}} @endif</span>
                                                        </li>

                                                        @if(count($company->techServices) > 0)
                                                        <li class="mt-list-item">
                                                            <i class="fa fa-circle"></i>

                                                            <span class="list-content">
                                                                <strong> {{$company->name}} has Expertise in:</strong>
                                                            </span>
                                                            <!-- industries services -->
                                                            <div class="expertise">
                                                                @foreach($company->techServices as $techService)
                                                                <a class="btn dark btn-outline btn-circle btn-sm" href="javascript:;"><span class="badge badge-default">  </span> {{$techService->techService->name}}</a>
                                                                @endforeach
                                                            </div>
                                                            <!-- end -->
                                                        </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="btn-group btn-group btn-group-justified statistics-button">
                                                <a class="btn dark" href="#members"> {{count($companyMembers)}} Members </a>
                                                @if($company->user != '')
                                                <a class="btn dark" href="#reviews"> {{count($company->user->reviews)}} reviews </a>
                                                <a class="btn dark" href="#endorsements"> {{count($company->user->endorsements)}} Endorsements </a>
                                                @endif
                                            </div>
                                            {{--<div class="statistics-bar">
                                                <ul>
                                                    <li>445 Connections</li>
                                                    <li>45 reviews</li>
                                                    <li>44 Endorsements</li>
                                                </ul>
                                            </div>--}}
                                        </div>
                                    </div>

                                    <!-- showcase -->
                                    @if(count($company->gallery) > 0)
                                    <div class="profile-details-block photo-showcase">
                                        <h3>PHOTO SHOWCASE</h3>
                                        <div class="photo_gallery gallery">
                                            <div class="col-md-12 leftside_gal">
                                                <ul>
                                                    @foreach($company->gallery as $gallery)
                                                        <li>
                                                            <a href="{{url('uploads')}}/{{$gallery->path}}" class="hvr-rectangle-out" rel="prettyPhoto[gallery1]"><div class="viewmore"><h4>View Image</h4></div><img src="{{url('uploads')}}/{{$gallery->path}}"  alt="Photo Gallery"/></a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="pagination-block">
                                            <ul>
                                                <li> &lt; </li>
                                                <li>6 of 235</li>
                                                <li> &gt; </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- end -->

                                    <!-- category and products -->
                                    @if(count($company->Categories) > 0)
                                    <div class="profile-details-block products">
                                        <h3>PRODUCT-CATEGORY AFFILIATION(S)</h3>

                                        @foreach($company->Categories as $category)
                                        <div class="col-md-6 products-left">
                                            @if(strlen($category->category->name) > 27)
                                            {{substr($category->category->name,0,27)}}...
                                            @else
                                            {{$category->category->name}}
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    <!-- end -->

                                    <!-- certification -->
                                    @if(count($company->companyCertifications) > 0)
                                    <div class="profile-details-block employment-history">
                                        <h3>CERTIFICATION & AWARDS</h3>

                                        @foreach($company->companyCertifications as $certification)
                                        <div class="col-md-12 certification">
                                            <div class="single-employment first">
                                                <div class="employment-left"><span>{{$certification->certification_name}},
                                                        <strong>{{$certification->certifying_authority}}</strong></span></div>
                                                <div class="employment-left">@if(strtotime($certification->date_received) == 0) N/A @else {{$certification->date_received}}:@endif    @if(strtotime($certification->valid_till) == 0) N/A @else {{$certification->valid_till}}:@endif </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    <!-- end -->

                                    <!-- Company Co-workers -->
                                    @if(count($companyMembers) > 0)
                                    <div class="profile-details-block connection">

                                        <h3>{{$company->name}}'s’ Member</h3>

                                        <div class="col-md-12" id="members">
                                            <div class="portlet light portlet-fit">
                                                <div class="connection-body">
                                                    <div class="mt-element-card mt-card-round mt-element-overlay">
                                                        <div class="row">
                                                            <div class="owl-carousel product_demo">
                                                            @foreach($companyMembers as $user)
                                                                <div class="">
                                                                    <div class="mt-card-item">
                                                                        <div class="mt-card-avatar mt-overlay-1">
                                                                            @if($user->profile_picture != '')
                                                                            <img src="{{url('')}}/{{$user->profile_picture}}">
                                                                            @else
                                                                            <img src="{{url('images/default-user.png')}}" width="80px">
                                                                            @endif
                                                                        </div>
                                                                        <div class="mt-card-content">
                                                                            <h3 class="mt-card-name">{{$user->first_name}} {{$user->last_name}}</h3>
                                                                            @if($user->current_position != '')
                                                                            <span class="mt-card-desc font-grey-mint">{{$user->current_position}}</span>
                                                                            @endif
                                                                            @if($user->company)
                                                                            <span class="mt-card-desc company-title">{{$user->company->name}}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <!-- end -->

                                    <!-- Endorsements -->
                                    @if($endorsements != '')
                                        @if(count($endorsements) > 0)
                                        <div class="profile-details-block connection">

                                            <h3> Company Endorsements</h3>

                                            <div class="col-md-12" id="endorsements">
                                                <div class="portlet light portlet-fit">
                                                    <div class="connection-body">
                                                        <div class="mt-element-card mt-card-round mt-element-overlay">
                                                            <div class="row">
                                                                <div class="owl-carousel product_demo">
                                                                    @foreach($endorsements as $index=>$endorsement)
                                                                    <div class="">
                                                                        <div class="mt-card-item">
                                                                            <div class="mt-card-avatar mt-overlay-1">
                                                                                @if($endorsement->sender_avatar != '')
                                                                                <img src="{{url('')}}/{{$endorsement->sender_avatar}}" alt="sell" class="img-circle" width="60px">
                                                                                @else
                                                                                <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
                                                                                @endif
                                                                            </div>
                                                                            <div class="mt-card-content">
                                                                                <h3 class="mt-card-name">{{$endorsement->sendername}}</h3>
                                                                                @if($endorsement->current_position != '')
                                                                                <div style="font-size: 15px;">{{$endorsement->current_position}} </div>
                                                                                @endif
                                                                                @if($endorsement->companyname != '')
                                                                                <div style="font-size: 15px;"> <b>{{$endorsement->companyname}} </b></div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                                    <!-- end -->

                                    <!--- Reviews Section -->
                                    @if($reviews != '')
                                        @if(count($reviews) > 0)
                                        <div class="profile-details-block reviews">

                                            <h3>Company Reviews</h3>

                                            <div class="row">
                                                <div class="col-md-12" id="reviews">
                                                    @foreach($reviews as $index=>$review)
                                                    <div class="single-review">

                                                        <div class="col-md-3">
                                                            <div class="review-image">
                                                                @if($review->sender_avatar != '')
                                                                <img src="{{url('')}}/{{$review->sender_avatar}}">
                                                                @else
                                                                <img src="{{url('images/default-user.png')}}" alt="sell" class="img-circle" width="80px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <h3 class="mt-card-name">{{$review->sendername}}</h3>
                                                            <span class="mt-card-desc font-grey-mint">@if($review->user->userdetail->current_position != ''){{$review->user->userdetail->current_position}}  @if($review->companyname),{{$review->companyname}}@endif @endif</span>
                                                            <span class="mt-card-desc company-title">{{$review->comment}}<br/><br/>@if(strtotime($review->created_at) == 0) N/A @else{{date('F d, Y',strtotime($review->created_at))}}@endif</span>
                                                            <div class="col-md-6 paddin-npt">
                                                                <p>
                                                                    @for ($i=1; $i <= 5 ; $i++)
                                                                    <span class="stars glyphicon glyphicon-star{{ ($i <= $review->stars) ? '' : '-empty'}}"></span>
                                                                    @endfor
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                                    <!-- end -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
        </div>
    </div>
    </div>
    <script>
        $('#user-profile-view').addClass('active');
        /* for show menu active */
        $("#compnay-main-menu").addClass("active");
    	$('#compnay-main-menu' ).click();
    	$('#compnay-menu-arrow').addClass('open')
    	$('#current-company-menu').addClass('active');
        /* end menu active */
    </script>
    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


   

    <script type="text/javascript" src="{{URL::asset('js/owl-carousel/owl.carousel.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/animate.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/ng_responsive_tables.js')}}"></script>
    <script src="{{URL::asset('js/starrr.js')}}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                items : 3,
                navigation : false,
                slideSpeed : 300,
                paginationSpeed : 500,
                singleItem : true,
                autoPlay : true,
                pagination : false,
            });


            $("#testimonial").owlCarousel({
                navigation : true, // Show next and prev buttons
                pagination : false,
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem:true,
                navigationText : ["<img src='{{URL::asset('images/left_wh.png')}}' alt='' />", "<img src='{{URL::asset('images/rt_wh.png')}}' alt='' />"],

            });

            $(".product_demo").owlCarousel({
                navigation : true,
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem : false,
                pagination : false,
                items : 3,
                itemsDesktop : [1199, 4],
                itemsDesktopSmall : [991, 3],
                itemsTablet : [768, 2],
                itemsMobile : [479, 1],
                navigationText : ["<img src='{{URL::asset('images/left_arrow.png')}}' alt='' />", "<img src='{{URL::asset('images/right_arrow.png')}}' alt='' />"],

            });

            $(".profileslider").owlCarousel({
                navigation : false,
                pagination : true,
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem : false,
                items : 4,
                itemsDesktop : [1199, 4],
                itemsDesktopSmall : [991, 3],
                itemsTablet : [768, 2],
                itemsMobile : [479, 1],


            });


            $(".scrollar_btn").click(function(){
                $('html,body').animate({scrollTop: 630 }, 1000);
            });

            $('.scrolltotop').hide();

            $(".scrolltotop").click(function(){
                $('html,body').animate({scrollTop: 0 }, 1000);
            });



            $(window).scroll(function() {
                if ($(window).scrollTop() >= 500 ) {
                    $('.scrolltotop').show('2000');
                } else {
                    $('.scrolltotop').hide('2000');
                }
            });



            $(function loop_charch() {
                $(" .scrollar_btn btn-circle .circle").animate({height:50}, 1000)
                $(" .scrollar_btn btn-circle .circle").animate({height:40}, 1000,loop_charch);

            }); //loop_charch();


        });

        $(window).on("load",function() {
            function fade() {
                var animation_height = $(window).innerHeight() * 0.25;
                var ratio = Math.round( (1 / animation_height) * 10000 ) / 10000;

                $('.fade').each(function() {
                    var objectTop = $(this).offset().top;
                    var windowBottom = $(window).scrollTop() + $(window).innerHeight();

                    if ( objectTop < windowBottom ) {
                        if ( objectTop < windowBottom - animation_height ) {

                            $(this).css( {
                                transition: 'opacity 0.1s linear',
                                opacity: 1
                            } );

                        } else {

                            $(this).css( {
                                transition: 'opacity 0.25s linear',
                                opacity: (windowBottom - objectTop) * ratio
                            } );
                        }
                    }
                });

            }
            $('.fade').css( 'opacity', 0 );
            fade();
            $(window).scroll(function() {fade();});
        });



        $(window).load(function(){
            if($(window).width() < 1600){
                $('.custom_nav').css({"padding-left":"20px",  "padding-right":"20px"});
            }
        });

    </script>

    <script type="text/javascript">
        $(function(){
            $('table.responsive').ngResponsiveTables({
                smallPaddingCharNo: 13,
                mediumPaddingCharNo: 18,
                largePaddingCharNo: 30
            });
        });
    </script>


    <script>



        $(function(){

            var $quote = $(".profile_name");

            var $numWords = $quote.text().split("").length;

            if ($numWords > 15) {
                $quote.css("font-size", "25px");
            }


        });

        $(document).ready(function() {




            $('li.dropdown').hover(function() {
                $('ul.dropdown-menu', this).stop(true, true). fadeIn('fast', 'easeOutElastic');
                $(this).addClass('open');
                $(this).addClass('radius');
            }, function() {
                $('ul.dropdown-menu', this).stop(true, true).fadeOut('fast', 'easeInElastic');
                $(this).removeClass('open');
                $(this).removeClass('radius');
            });

            $('.dropdown-menu').hover(function() {
                $(this).parent('li').stop(true, true).addClass('selectli');

            },function() {
                $(this).parent('li').stop(true, true).removeClass('selectli');
            });
        });



    </script>

    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $("#industry").autocomplete({
            source: ["Industry", "Boy", "Cat"],
            minLength: 0,
        }).focus(function () {
            $(this).autocomplete("search");
        });

        $("#catagory").autocomplete({
            source: ["Catgory", "Boy", "Cat"],
            minLength: 0,
        }).focus(function () {
            $(this).autocomplete("search");
        });

        $('.infoeabout').click(function() {
            $('#autocomplete').trigger("focus"); //or "click", at least one should work
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(window).scroll(function(){
            if ( $(window).width() > 980 && $(window).scrollTop() > 0 ) {
                extraPadding = $(window).scrollTop() - 60;
                $('#stopMenu').css( "padding-top", extraPadding );
            } else {
                $('#stopMenu').css( "padding-top", "0" );
            }
        });
    </script>
    <script src="{{URL::asset('js/jquery.prettyPhoto.js')}}"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){


            $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal', social_tools: false});



        });
    </script>


    <script type="text/javascript">


        $('input').bind('copy paste', function (e) {
            e.preventDefault();
        });

    </script>
   <script>
// ------------------------------
// http://twitter.com/mattsince87
// ------------------------------

function scrollNav() {
  $('.statistics-bar a').click(function(){  
    //Toggle Class
    $(".active").removeClass("active");      
    $(this).closest('li').addClass("active");
    var theClass = $(this).attr("class");
    $('.'+theClass).parent('li').addClass('active');
    //Animate
    $('html, body').stop().animate({
        scrollTop: $( $(this).attr('href') ).offset().top - 160
    }, 400);
    return false;
  });
  $('.scrollTop a').scrollTop();
}
scrollNav();
</script> 

@endsection
