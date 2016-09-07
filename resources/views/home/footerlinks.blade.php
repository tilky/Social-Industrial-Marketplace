<!-- footer -->

    <div class="footer">
    <div class="container spacingfooter">
        <div class="footercol"></div>
        <div class="footercol">
            <h3 class="wh_hedaer">Our Offering</h3>
            <ul>
                <li><a href="{{url('buyer-features')}}">Buyers </a></li>
                <li><a href="{{url('supplier-network')}}">Suppliers</a></li>
                <li><a href="{{url('industrial-service-provider')}}">Service Providers</a></li>
<li><a href="{{url('students')}}">Students</a></li>
           
            </ul>

        </div>


        <div class="footercol">
            <h3 class="wh_hedaer">Web App</h3>
            <ul>
            
            
             @if(Auth::check())
                            @if(Auth::user()->access_level == 1)
                                <li><a href="{{url('sa')}}" >Login</a></li>
                            @else
                                <li><a href="{{url('user-dashboard')}}">Login</a></li>
                            @endif
                        @else
                            <li><a href="#login" data-toggle="modal" data-target="#login">Login</a></li>
                        @endif
                      
                        
                        
               
                <li><a href="{{url('/')}}">Sign Up</a></li>
 <li>
     <a href="{{url('password/email')}}">Reset Password</a>
 </li>
 <li class="hidden-xs"><a href="{{url('quick-demo')}}?setup=tutorial">Quick Demo</a></li>

                
            </ul>
        </div>


  <div class="footercol">
            <h3 class="wh_hedaer">Marketing</h3>
            <ul>
                <li><a href="{{url('marketing-solutions')}}">Marketing Solutions</a></li>
              
                <li><a href="{{url('advertise-with-us')}}">Advertise With Us</a></li>
    <li><a href="{{url('partner-with-us')}}">Partner With Us</a></li>
     <li><a href="{{url('referral-program')}}">Referral Program</a></li>
            </ul>
        </div>


  
        <div class="footercol">
            <h3 class="wh_hedaer">About Us</h3>
            <ul>
                <li><a href="{{url('about-us')}}">Company Information</a></li>
              
                <li><a href="{{url('news')}}">Indy John News</a></li>
    <li><a href="{{url('investor-outreach')}}">Investor Outreach</a></li>
     <li><a href="{{url('indy-grid')}}">Indy Grid™</a></li>
            </ul>
        </div>



 <div class="footercol">
            <h3 class="wh_hedaer">Support Center</h3>
            <ul>
<li><a  href="{{url('overview')}}">Indy John Overview</a></li>
    <li><a href="{{url('industries-list')}}">Industries We Serve </a></li>
    
                <li><a href="{{url('faq')}}">Frequently Asked Questions </a></li>
              
                <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                <!--
                <li><a href="#reset-password" data-toggle="modal" data-target="#reset-password">Reset Password</a></li>
                <li><a href="#coustom_congrats" data-toggle="modal" data-target="#coustom_congrats">Coustom Congrats</a></li>
                -->
                
            </ul>
        </div>

    </div>

    <div class="clearfix"></div>




    <div class="copyright">
        <div class="nopadding text-center">
            <div class="text-center">
                <ul class="scocialicon">
                    <li>
                        <h4 class="header_18">Stay Connected:</h4> </li>
                    <li class="hvr-bounce-to-right fb">
                        <a target="_blank" href="https://www.facebook.com/IndyJohnUS"> <i class="fa fa-facebook"></i>  </a>
                    </li>
    <li class="hvr-bounce-to-right tw">
                        <a target="_blank" href="https://www.twitter.com/IndyJohnUS"> <i class="fa fa-twitter"></i>  </a>
                    </li>
<!--
                    <li class="hvr-bounce-to-right lnk"><a href="linkedin.com"><i class="fa fa-linkedin"></i>  </a></li>-->
                </ul>

            </div>
            <hr/>

            <p>&copy; 2016 Indy John, Inc. All Rights Reserved. </p>
            <p>Indy John is a social marketplace and not an approved vendor or distributor of manufacturer products or services.</p>

            <ul class="trm_pp">
                <li><a href="{{url('terms')}}">Terms of Usage</a></li>
                <li><a href="{{url('privacy-policy')}}">Privacy Policy </a></li>
            </ul>


        </div>
    </div>
</div>

<!-- signup-model --->
        <div class="modal fade job_board_model" id="job_board" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
        
            <div class="modal-dialog" role="document">
            
                <div class="modal-content">
                <div class="modal-header">
            <h2>INDY JOHN <b>JOB BOARD</b></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i>  </span></button>
            
            </div>
                    <div class=" text-uppercase text-center">
                        <p>The first Job Board to focus on Everything Industrial.</p>
                        <div class="col-md-6 col-sm-6">
                        <div class="row">
                        <div class="side_line">
                        <h3>EMPLOYERS</h3>
                        <ul>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>  <p>Post your employment opportunity for a small fee</p></li>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>  <p>Recruit and Select Applicants</p></li>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>  <p>Use our CRM to Manage all job posting data</p></li>
                        </ul>
                        </div>
                        <a href="/qt/auth/login" class="btn_red  hvr-bounce-to-right">LOGIN TO CONTINUE</a>
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                        <div class="row">
                        <h3>JOB SEEKERS</h3>
                        <ul>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>  <p>Search jobs that match your specific skillset</p> </li>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>  <p>Discover and research companies</p></li>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>  <p>Apply directly with one quick online application</p></li>
                        </ul>
                        <a id="signup" href="/qt/index.php?signup=true" class="btn_red  hvr-bounce-to-right">SIGN UP FOR FREE</a>
                        </div>
                        </div>
                    </div>
                
                </div>
            </div>
        
        
        </div>
        <!-- signup-model --->
   <!-- Window Splash model --->
        <div class="modal fade window_splash" id="window_splash" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
        
            <div class="modal-dialog" role="document">
            
                <div class="modal-content">
                <div class="modal-header">
            <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="55" width="260" /></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i>  </span></button>
            
            </div>
            <div class="modal-body">
                    <div class=" text-uppercase text-center">
                        <h3>Thank you for signing up. Check your Email.</h3>
                        <img src="{{URL::asset('livesite/images/safty.png')}}" height="64px">
                        <h4>To ensure User Safety, we require e-mail verification:</h4>
                        <h3 style="color:#ef5350;">@if(isset($_REQUEST['email'])) {{$_REQUEST['email']}} @endif</h3>
                        <h4>Log In to your email and click on the verification link to Continue.</h4>
                        </div>
                        </div>
                        <div class="modal-footer text-center">
                          <h5>Didn't get the email? <a href="{{url('email/resend/link')}}?email=@if(isset($_REQUEST['email'])){{$_REQUEST['email']}}@endif">Resend it</a></h5>
                        <h5>Already have an account? <a href="{{url('auth/login')}}">Log In</a> Instead.</h5>
                        </div>
                    </div>
                
                </div>
            </div>
        
        
        </div>
        <!-- Window Splash model --->     
        
    <!-- /footer -->
