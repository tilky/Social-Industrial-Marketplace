<script src="{{URL::asset('metronic/plugins/jquery.min.js')}}" type="text/javascript"></script>
<link href="{{URL::asset('metronic/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('metronic/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="{{URL::asset('livesite/css/component.css')}}" />
<script src="{{URL::asset('livesite/js/modernizr.custom.js')}}"></script>



<style>
    .select2-results{color: #383333!important;}
    .select2-dropdown {}
    .select2-container{display: block!important;}
    .select2-container .select2-selection--single{width:100%!important;height: 40px!important;line-height: 40px!important;color: #383333!important;text-align: left!important;border-radius: 22px;}
    .select2-search__field{color: #383333!important;}
    .select2-container--default .select2-selection--single .select2-selection__rendered{color: #383333!important;font-size: 13px!important;}
    .select2-selection__rendered{height: 35px!important;line-height: 35px!important;}
    .select2-selection__arrow{top: 5px!important;}
    .select2-container--default .select2-selection--single .select2-selection__arrow{right: 30px!important;}
    .modal-backdrop.fade.in {
        opacity: 0.5!important;
        filter: alpha(opacity=50);
    }
</style>

<div class="modal fade" id="company_import_model" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                <h3>Your Company Data Imported Successfully.</h3>
            </div>
        </div>
    </div>
</div>

<div class="homepage">


<nav id="mp-menu" class="mp-menu">
    <div class="mp-level">
        <h2>

            <a href="{{url('/')}}"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" alt=""  width="200px;"/></a>


            <div class="clearfix"></div>
        </h2>
        <ul class="text-center">
            <li><a href="{{url('buyer-features')}}">Buyer Features</a></li>
            <li><a href="{{url('supplier-network')}}">Supplier Network</a> </li>
            <li><a href="{{url('referral-program')}}">Referral Program</a></li>
            <li><a href="{{url('faq')}}">FAQ's</a></li>
            <li>
                <a href="#"> About Us <i class="pull-right fa fa-caret-right" aria-hidden="true"></i></a>
                <div class="mp-level">
                    <h2>About Us</h2>
                    <a class="mp-back" href="#"><i class="pull-left fa fa-caret-left" aria-hidden="true"></i> back </a>
                    <ul>
                        <li><a href="{{url('about-us')}}">About Us</a></li>
                        <li><a href="{{url('faq')}}">FAQs </a></li>
                        <li><a href="{{url('news')}}">Indy John News</a></li>
                        <li><a href="{{url('investor-outreach')}}">Investor Outreach </a></li>
                        <li><a href="{{url('contact-us')}}"> Contact Us</a></li>
                    </ul>
                </div>
            </li>

            @if(Auth::check())
            @if(Auth::user()->access_level == 1)
            <li><a href="{{url('sa')}}" ><i class="lock"> </i> Login</a></li>
            @else
            <li><a href="{{url('user-dashboard')}}"><i class="lock"> </i> Login</a></li>
            @endif
            @else
            <li><a href="{{url('sa')}}" data-toggle="modal" data-target="#login"><i class="lock"></i> Login</a></li>
            @endif

            @if(Auth::check())
            @if(Auth::user()->access_level == 1)
            <li class="signup-btn"><a class="btn" href="{{url('sa')}}" > <i class="fa fa-arrow-circle-up"></i>Sign Up</a></li>
            @else
            <li class="signup-btn"><a class="btn" href="{{url('user-dashboard')}}"><i class="fa fa-arrow-circle-up"></i>Sign Up</a></li>
            @endif
            @else
            <li class="signup-btn"><a href="{{url()}}/?do=signup" class="btn"><i class="fa fa-arrow-circle-up"></i>Sign Up</a></li>
            @endif

        </ul>


    </div>
</nav>

<nav class="navbar custom_nav " id="nav">
    <div class="container-fluid">


        <div class="navbar-header">
            <div class="logo">
                <a href="{{url('/')}}"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" alt="" /></a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="dropdown dropdown-extended quick-sidebar-toggler">
                <a href="#" id="trigger" class="menu-trigger"><i class="fa fa-navicon"></i></a>


            </div>
            <div class="dropdown dropdown-extended quick-sidebar-toggler toggle_close">
                <a href="#" id="" class="menu-trigger"><i class="fa fa-navicon"></i></a>


            </div>

        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="{{url('buyer-features')}}">Buyer Features</a></li>
                <li><a href="{{url('supplier-network')}}">Supplier Network</a> </li>
                <li><a href="{{url('referral-program')}}">Referral Program</a></li>
                <li><a href="{{url('faq')}}">FAQ's</a></li>
                <li class="dropdown">
                    <a href="about-us.php" class="dropdown-toggle" data-toggle="dropdown" role="button">About Us <i class="glyphicon glyphicon-menu-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('about-us')}}">About Us</a></li>
                        <li><a href="{{url('faq')}}">FAQs </a></li>
                        <li><a href="{{url('news')}}">Indy John News</a></li>
                        <li><a href="{{url('investor-outreach')}}">Investor Outreach </a></li>
                        <li><a href="{{url('contact-us')}}"> Contact Us</a></li>
                    </ul>
                </li>
                @if(Auth::check())
                @if(Auth::user()->access_level == 1)
                <li><a href="{{url('sa')}}" ><i class="lock"> </i> Login</a></li>
                @else
                <li><a href="{{url('user-dashboard')}}"><i class="lock"> </i> Login</a></li>
                @endif
                @else
                <li><a href="#login" data-toggle="modal" data-target="#login"><i class="lock"></i> Login</a></li>
                @endif
                <li class="hidden-xs"><a href="#searchModal" data-toggle="modal" data-target="#searchModal"><i class="search"> </i></a></li>
                @if(Auth::check())
                @if(Auth::user()->access_level == 1)
                <li class="signup-btn"><a class="btn" href="{{url('sa')}}" > <i class="fa fa-arrow-circle-up"></i>Sign Up</a></li>
                @else
                <li class="signup-btn"><a class="btn" href="{{url('user-dashboard')}}"><i class="fa fa-arrow-circle-up"></i>Sign Up</a></li>
                @endif
                @else
                <li class="signup-btn"><a href="{{url()}}/?do=signup" class="btn"><i class="fa fa-arrow-circle-up"></i>Sign Up</a></li>
                @endif

            </ul>


        </div>
        <!--/.nav-collapse -->
    </div>
</nav>
<div class="clearfix"></div>
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
    Indy John Mobile App coming soon.<br /> Use Desktop version for best user experience
</div>
<!--===================  Models ===================-->
<!--Search Modal -->
<div class="modal fade searchModal" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>

            </div>
            <div class="modal-body vericle_table">
                <div class="verticle_mddle">
                    <div class="">
                        <div class="searcform">
                            <input type="search" placeholder="Search Products, People, Companies, Service Providers and more">
                            <button type="submit" class="searchweb"><i class="fa fa-search"></i></button>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- login-model --->
<div class="modal fade login-model" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content login-content">

            <div class="modal-body vericle_table">
                <div class="verticle_mddle">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h3 class=" text-left animated bounceInDown slower go nopadding font28">Please Login</h3>

                    <div class="col-md-6  animated fadeIn loginform go">
                        <h3 class="font18 animated go header_18 text-bold">Login to Indy John</h3>

                        <form action="{{url('auth/login')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="email" name="email" placeholder="Enter Your E-mail Id">
                            <input type="password" name="password" placeholder="Enter Your Password">
                            <p class=""><a href="{{url('password/email')}}">Forgot Password? </a></p>

                            <div class="paddingtop20 row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn_red  hvr-bounce-to-right"> Login </button>
                                </div>

                            </div>

                        </form>

                    </div>

                    <div class="col-md-6 logininfo">
                        <h3 class="font18 animated go header_18 text-bold">Welcome to Indy John.</h3>
                        <p>You can use an Indy John account to:</p>
                        <ul>
                            <li>
                                <p><i class="fa fa-check-circle" aria-hidden="true"></i> Get Product and Service Quotes </p>
                            </li>
                            <li>
                                <p><i class="fa fa-check-circle" aria-hidden="true"></i> Sell your Products and Services. </p>
                            </li>
                            <li>
                                <p><i class="fa fa-check-circle" aria-hidden="true"></i> Explore Market Listings. </p>
                            </li>
                            <li>
                                <p><i class="fa fa-check-circle" aria-hidden="true"></i> Be Discovered. </p>
                            </li>
                            <li>
                                <p><i class="fa fa-check-circle" aria-hidden="true"></i> Post and Search Jobs. </p>
                            </li>
                        </ul>
                        <div class="paddingtop20 row">
                            <div class="col-md-12">
                                <a href="{{url('/')}}" class="btn_red  hvr-bounce-to-right"> SIGN UP FOR A FREE ACCOUNT </a>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <h6 class="text-center margin-top-30">By Logging in, you Agree to our <a href="terms" target="_blank">Terms & Conditions</a> & <a href="privacy-policy" target="_blank">Privacy Policy</a>.</h6>

                </div>
            </div>
        </div>

    </div>
</div>


<!-- signup-model --->
<div class="modal fade signup-model" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class=" text-uppercase text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                <h3>Welcome to Indy John</h3>
                <!--                        <h5>so that we can prepare your account</h5>-->
                <form role="form" method="POST" action="{{url('auth/register')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="email" value="" id="register-email" />
                    <input type="hidden" name="user_type" value="" id="register-user-type" />
                    <input type="hidden" name="industry" value="" id="register-industry" />
                    <div class="form-inline ">
                        <h4>TELL US YOUR NAME</h4>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <input type="text" class="form-control" name="firstname" id="first-name" value="{{Request::old('firstname')}}" placeholder="FIRST NAME" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <input type="text" class="form-control" id="last-name" name="lastname" value="{{Request::old('lastname')}}" placeholder="LAST NAME" required>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @if(!isset($_REQUEST['industry']))
                    <div class="form-inline ">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <h4>YOUR MAIN INDUSTRY</h4>
                            </div>
                            <select name="main_industry" class="form-control selectIndustry" id="indutries-dropdown">
                                <option value="">Please Select Industry</option>
                                @if(isset($industries))
                                @foreach($industries as $industry)
                                @if(Request::old('main_industry') == $industry->id)
                                <option value="{{$industry->id}}" selected="">{{$industry->name}}</option>
                                @else
                                <option value="{{$industry->id}}">{{$industry->name}}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endif
                    <div class="form-inline ">
                        <h4>SET YOUR ACCOUNT PASSWORD</h4>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <input type="password" class="form-control" id="password" name="password" placeholder="ENTER PASSWORD" required></div>
                        </div>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <input type="password" class="form-control" id="repeat-password" name="password_confirmation" placeholder="REPEAT PASSWORD" required></div>
                        </div>
                        <div class="clearfix"></div>
                        <h4>Enter Your Referral Code (Optional)</h4>
                        <div align="center" class="form-group col-md-12 col-sm-12 col-xs-12">

                            @if(isset($isReferral))
                            @if($isReferral == 1)
                            <input type="text" class="form-control referral_code" disabled="true" name="referral_code" value="{{$referralCode}}" placeholder="ENTER REFERRAL CODE" />
                            @else
                            <input type="text" class="form-control referral_code" name="referral_code"  placeholder="ENTER YOUR REFERRAL CODE HERE" />
                            @endif
                            @else
                            <input type="text" class="form-control referral_code" name="referral_code"  placeholder="ENTER YOUR REFERRAL CODE HERE" />
                            @endif

                        </div>
                        <div class="clearfix"></div>
                        <h4 style="padding:0px !important">&nbsp;</h4>
                        <div align="center" class="form-group col-md-12 col-sm-12 col-xs-12">
                            <button class="btn_red  hvr-bounce-to-right" type="submit" >Sign Up</button>
                            <h6>By Signing Up, You Agree To Our <a href="terms" target="_blank">Terms & Conditions</a> & <a href="privacy-policy" target="_blank">Privacy Policy</a>.</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>


</div>
<!-- password-model --->
<div class="modal fade reset-password" id="reset-password" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class=" text-uppercase text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                <h3>Welcome to Indy John</h3>
                <!--                        <h5>so that we can prepare your account</h5>-->
                <form role="form" method="POST" action="{{url('auth/register')}}" enctype="multipart/form-data">
                    <div class="form-inline">
                        <h4>Please set your password: </h4>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <input type="password" class="form-control"  value="" placeholder="PASSWORD" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <input type="password" class="form-control"  value="" placeholder="REPEAT PASSWORD" required>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-inline ">


                        <h4 style="padding:0px !important">&nbsp;</h4>
                        <div align="center" class="form-group col-md-12 col-sm-12 col-xs-12">
                            <button class="btn_red  hvr-bounce-to-right" type="submit" >SET PASSWORD </button>
                            <h6>You Agree To Our <a href="terms" target="_blank">Terms & Conditions</a> & <a href="privacy-policy" target="_blank">Privacy Policy</a>.</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>


</div>
<!-- /coustom congrats -->
<div class="modal fade begin_tutorial" id="coustom_congrats"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="40" width="170" /></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
            </div>
            <div class="modal-body">
                <div class=" text-uppercase text-center">
                    <h3><B>Congratulations!</B><br />
                        <span>You have completed your Indy John user profile.</span></h3>
                    <div class="text-center"><img src="{{URL::asset('livesite/images/icons/interface-1.png')}}" height="64" width="64" /></div>
                    <h4>Your Current Company Page is:</h4>
                    <h4 style="color:#ef5350;">COMPANY NAME</h4>
                    <h4>Edit Your Company Page Details and Set up an Administrator. </h4>
                    <a class="btn_red  hvr-bounce-to-right" href="#">EDIT COMPANY DETAILS</a>

                </div>
            </div>

        </div>

    </div>
</div>

<!-- /.modal -->
<div class="modal fade " id="overview-select-modal" tabindex="-1" role="basic" aria-hidden="true" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="align-center"><img src="{{URL::asset('images/indy_john_crm_logo.png')}}" />
                            <p>We're a new company with a highly Technical User-Platform.  This diagram will help you understand what Indy John has to offer. </p>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>

                        <div class="col-md-12 align-center">
                            <div class="btn-group overview" data-toggle="buttons">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="clearfix"></div>
                                        <label class="btn btn-primary btn-group invite-contact-sec-div overview_quote" id="pulsate-one">
                                            <input type="radio" name="user_type" value="2_1" autocomplete="off">
                                            quote-lead<br />
                                            system </label>
                                        <label class="btn btn-primary row-one" id="pulsate-four">
                                            <input type="radio" name="user_type" value="3_4" autocomplete="off">
                                            <h4>buyers</h4>
                                            <p>submit Buy Requests<br />
                                                receive quotes<br />
                                                compare & select</p>
                                        </label>
                                        <label class="btn btn-primary row-one" id="pulsate-nine">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">
                                            <h4> suppliers</h4>
                                            <p>post Lead Requests<br />
                                                receive leads<br />
                                                quote new buyers</p>
                                        </label>
                                        <label class="btn btn-primary row-one" id="pulsate-nine">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">
                                            <h4>service providers</h4>
                                            <p>post Lead Requests<br />
                                                receive service leads<br />
                                                send quotes</p>
                                        </label>
                                        <label class="btn btn-primary row-one vert_center" id="pulsate-nine">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">

                                            <p>TEAM PURCHASING</p> </label>
                                        <label class="btn btn-primary row-one vert_center" id="pulsate-nine">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">

                                            <p>TEAM SUPPLYING</p> </label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <label class="btn btn-primary overview_market" id="pulsate-two">
                                            <input type="radio" name="user_type" value="2_2" autocomplete="off">
                                            indy john <br />
                                            market </label>
                                        <label class="btn btn-primary row-two" id="pulsate-eight">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">
                                            <h4> buyers</h4>
                                            <p>shop industrial<br />
                                                explore listings<br />
                                                find new suppliers</p>
                                        </label>
                                        <label class="btn btn-primary row-two" id="pulsate-five">
                                            <input type="radio" name="user_type" value="3_5" autocomplete="off">
                                            <h4> sellers</h4>
                                            <p>post products<br />
                                                promote listings<br />
                                                reach new buyers</p>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <label class="btn btn-primary overview_job_board" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            indy john <br />
                                            job board</label>
                                        <label class="btn btn-primary row-three" id="pulsate-eight">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">
                                            <h4> job seekers</h4>
                                            <p>search jobs<br />
                                                research companies<br />
                                                apply online</p>
                                        </label>
                                        <label class="btn btn-primary row-three" id="pulsate-nine">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">
                                            <h4> employers</h4>
                                            <p>list jobs<br />
                                                find qualified talent<br />
                                                manage applicants</p>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <label class="btn btn-primary overview_search" id="pulsate-three">
                                            <input type="radio" name="user_type" value="3_3" autocomplete="off">
                                            search<br />
                                            discovery </label>
                                        <label class="btn btn-primary row-four" id="pulsate-seven">
                                            <input type="radio" name="user_type" value="2_7" autocomplete="off">
                                            <p>discover

                                                companies</p>
                                        </label>
                                        <label class="btn btn-primary row-four" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>find people</p>
                                        </label>
                                        <label class="btn btn-primary row-four" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>explore <br />
                                                job listings</p>
                                        </label>
                                        <label class="btn btn-primary row-four" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>locate <br />
                                                service providers</p>
                                        </label>
                                        <label class="btn btn-primary row-four" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>seek products</p>
                                        </label>
                                        <label class="btn btn-primary row-four" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>find product<br />
                                                services</p>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <label class="btn btn-primary overview_social" id="pulsate-three">
                                            <input type="radio" name="user_type" value="3_3" autocomplete="off">
                                            social<br />
                                            marketplace </label>
                                        <label class="btn btn-primary row-five" id="pulsate-seven">
                                            <input type="radio" name="user_type" value="2_7" autocomplete="off">
                                            <p>endorse</p>
                                        </label>
                                        <label class="btn btn-primary row-five" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>earn referrals</p>
                                        </label>
                                        <label class="btn btn-primary row-five" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>company pages</p>
                                        </label>
                                        <label class="btn btn-primary row-five" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>connect</p>
                                        </label>
                                        <label class="btn btn-primary row-five" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>direct message</p>
                                        </label>
                                        <label class="btn btn-primary row-five" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>invite associates</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- /.modal-content -->
        <div class="clearfix"></div>
    </div>
    <!-- /.modal-dialog -->
    <div class="clearfix"></div>
</div>
<!-- /.modal -->

<!-- =================== End  Models =================== -->

</div>


<div class="clearfix"></div>





<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{URL::asset('metronic/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<script src="{{URL::asset('metronic/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/jquery-multi-select/js/jquery.multi-select.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('metronic/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('livesite/js/classie.js')}}"></script>
<script src="{{URL::asset('livesite/js/mlpushmenu.js')}}"></script>
<script>
    new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {
        type : 'cover'
    } );

</script>

<script>
    var placeholder = "Select an Industry";
    $(".selectIndustry").select2({
        placeholder: placeholder,
        width: null
    });
</script>


