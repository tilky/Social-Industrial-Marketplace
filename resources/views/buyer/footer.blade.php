<!-- BEGIN FOOTER -->
<!-- /.modal -->
<div class="modal fade footer-modal" id="request_quote" tabindex="-1" role="basic" aria-hidden="true" data-width="760" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="btn btn-circle btn-outline" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel">
                    <b>REQUEST CHECKOUT</b> FOR PRODUCT TITLE HERE
                </h4>
            </div>
            <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                <h4>Enter Your Shipping Address:</h4>
                                    <div class="input-icon">
                                        <input type="text" class="form-control" id="subject"  value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                <h4>Add Additional Notes to your Checkout Request:</h4>
                                    <div class="input-icon">
                                        <textarea class="form-control" id="message_body" rows="8"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions noborder text-right">
                        <button  class="btn btn-circle  btn_yellow hvr-bounce-to-right bold">REQUEST CHECKOUT</button>
                        
                    </div>
                </div>
            <div class="modal-footer">

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.modal -->
<div style="z-index: 11000" class="modal fade begin_tutorial" id="payment_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="55" width="260" /></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body full_padding">
                <div class=" text-uppercase text-center">
                    <h3>UPGRADE YOUR PLAN TO: <span style="color:#e7505a;" id="upgradeModalPlanName">SUPPLIER GOLD</span></h3>
                    <h3><b>SELECT PRICING TERM:</b></h3>
                    <ul class="nav nav-tabs">
                        <li class="active"> <a data-toggle="tab" href="#monthly" aria-expanded="true" > MONTHLY <span id="upgradeModalPlanMonthlyValue">$199.00/mo</span> </a> </li>
                        <li > <a data-toggle="tab" href="#annually" aria-expanded="false"> ANNUALLY <span id="upgradeModalPlanAnnualValue">$180.00/mo</span> </a> </li>
                    </ul>
                    <div class="tab-content">

                        <div id="monthly" class="tab-pane active in">
                            <h3 id="upgradeModalPlanMonthlyTotalValue">TOTAL: $199.00</h3>
                            <p>PAY USING:</p>
                            <ul class="nav nav-tabs">
                                <li class="">
                                    <a href="#" onclick="payWithStripe()" data-toggle="tab" aria-expanded="true"><img src="{{URL::asset('images/pay-with-credit-card.png')}}" /></a></li>
                                <li> <a href="#" onclick="payWithPaypal()" data-toggle="tab" aria-expanded="false"><img src="{{URL::asset('images/paypal.png')}}" /></a></li>
                            </ul>
                        </div>
                        <div id="annually" class="tab-pane ">
                            <h3 id="upgradeModalPlanAnnualTotalValue">TOTAL: $180.00</h3>
                            <p>PAY USING:</p>
                            <ul class="nav nav-tabs">
                                <li class="">
                                    <a href="#" onclick="payWithStripe()" data-toggle="tab" aria-expanded="true"><img src="{{URL::asset('images/pay-with-credit-card.png')}}" /></a></li>
                                <li> <a href="#" onclick="payWithPaypal()" data-toggle="tab" aria-expanded="false"><img src="{{URL::asset('images/paypal.png')}}" /></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.modal -->
<!-- /.modal -->
<div style="z-index: 11000" class="modal fade begin_tutorial" id="payment_method"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="55" width="260" /></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body full_padding">
                <div class=" text-uppercase text-center">
                    <h3>Choose your Payment Method</h3>
                    <div class="col-md-6 col-sm-6 payment_type"><a href="#" onclick="payWithStripe()"><img src="{{URL::asset('images/pay-with-credit-card.png')}}" /></a></div>
                    <div class="col-md-6 col-sm-6 payment_type"><a href="#" onclick="payWithPaypal()"><img src="{{URL::asset('images/pay-with-paypal.png')}}" /></a></div>

                    <div class="clearfix"></div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade begin_tutorial" id="report_page"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="40" width="170" /></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body full_padding">
                <div class=" text-uppercase text-center">
                    <h3>REPORT THIS PAGE</h3>
                    <p>SELECT A REASON:</p>
                    <select name="reason" id="reason" class="form-control">

                    </select>
                    <p>ADD YOUR CONCERN DETAILS:</p>
                    <textarea name="comment" class="form-control" id="comment" rows="4"></textarea>
                    <button type="button" onclick="saveReport()" class="btn btn-danger" >REPORT</button>
                </div>
            </div>
            <div class="modal-footer text-center">
                <h5>&nbsp;</h5>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade begin_tutorial" id="claim_page"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="40" width="170" /></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body full_padding">
                <div class=" text-uppercase text-center">
                    <h3>Claim Your Company Page</h3>
                    <p><b>Claim your free Company Page and Grow your Outreach.</b></p>


                    <h5 class="margin-top-20"><i style="color:#090" class="fa fa-check-circle"></i> Gain Presence and be Discovered.</h5>
                    <h5><i style="color:#090" class="fa fa-check-circle"></i> Have full control of your Company details.</h5>
                    <h5><i style="color:#090" class="fa fa-check-circle"></i> Grow Your Industrial Network.</h5>


                    <a class="btn btn-danger" href="#">CLAIM COMPANY PAGE</a>
                    <a class="skip">SIGN UP OR LOGIN TO GET STARTED</a>
                </div>
            </div>
            <div class="modal-footer text-center">
                <h5>&nbsp;</h5>

            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade begin_tutorial" id="upgrade_plan_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="40" width="170" /></div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body full_padding">
                <div class=" text-uppercase text-center">
                    <h3>YOU HAVE SUBSCRIBED TO SUPPLIER GOLD.</h3>
                    <p>Thank you for choosing to become an Indy John valued member.<p> You'll now be able to benifit from great advantages such as:

                    <h5 class="margin-top-20"><i style="color:#090" class="fa fa-check-circle"></i> Be one of the First to Receive Buy Requests.</h5>
                    <h5><i style="color:#090" class="fa fa-check-circle"></i> Build Trust Online by our Gold Profile Seal.</h5>
                    <h5><i style="color:#090" class="fa fa-check-circle"></i> Expand your market reach.</h5>
                    <h5><i style="color:#090" class="fa fa-check-circle"></i> Upgraded experience at Market and Job Board.</h5>
                    <a class="btn btn-danger" href="#">Continue to Dashboard</a>
                    <a class="view_invioce" href="#">VIEW INVIOCE AND PAYMENT DETAILS</a>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- /.modal -->


<!-- /.modal -->
<div class="modal fade begin_tutorial" id="begin_tutorial"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="40" width="170" /></div>
            </div>
            <div class="modal-body">
                <div class=" text-uppercase text-center">
                    <h3><B>Congratulations!</B><br /><span>You have completed your Indy John user profile.</span></h3>

                    <div class="text-center"><img src="{{URL::asset('livesite/images/icons/interface-1.png')}}" height="64" width="64" /></div>

                    <h4 style="color: red">
                        Your profile URL is :
                        <a id="copyUrl" style="color: red" href="{{url('home/user/profile/')}}/{{Auth::user()->id}}"><b>indyjohn.com/u/{{Auth::user()->userdetail->first_name}}{{Auth::user()->userdetail->last_name}}</b>.</a>
                        <button id="copy" class="btn-sm relative" type="button">COPY</button>
                    </h4>
                    <p id="msg"></p>
                    <a href="#" class="btn btn-danger" onclick='inviteUser()'>  Share</a>

                    <h4>Our platform has a lot to offer.</h4>
                    <h4>Please take a few minutes to go through our tutorial.</h4>
                    <a class="btn btn-danger" href="{{url('user-dashboard')}}?setup=tutorial">BEGIN TUTORIAL</a>
                    <a class="skip" href="{{url('user-dashboard')}}?popup=overview">SKIP</a>
                </div>
            </div>
            <div class="modal-footer text-center">
                <h5>&nbsp;</h5>

            </div>
        </div>

    </div>
</div>
<!-- /.modal -->
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
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <div class="col-md-12 align-center">
                            <div class="btn-group overview" data-toggle="buttons">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="clearfix"></div>
                                        <label class="btn btn-primary btn-group invite-contact-sec-div overview_quote" id="pulsate-one">
                                            <input type="radio" name="user_type" value="2_1" autocomplete="off">
                                            Quote-Lead<br />System™

                                        </label>
                                        <label class="btn btn-primary row-one" id="pulsate-four">
                                            <input type="radio" name="user_type" value="3_4" autocomplete="off">
                                            <h4>buyers</h4>
                                            <p>submit buy requests</br>
                                                receive quotes</br>
                                                compare & select</p> </label>
                                        <label class="btn btn-primary row-one" id="pulsate-nine">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">
                                            <h4> suppliers</h4>
                                            <p>post lead requests</br>
                                                receive leads</br>
                                                quote new buyers</p></label>
                                        <label class="btn btn-primary row-one" id="pulsate-nine">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">
                                            <h4>service providers</h4>
                                            <p>post lead requests</br>
                                                receive service leads</br>
                                                send quotes</p> </label>
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
                                            indy john <br />market </label>
                                        <label class="btn btn-primary row-two" id="pulsate-eight">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">
                                            <h4> buyers</h4>
                                            <p>shop industrial</br>
                                                explore listings</br>
                                                find new suppliers</p></label>
                                        <label class="btn btn-primary row-two" id="pulsate-five">
                                            <input type="radio" name="user_type" value="3_5" autocomplete="off">
                                            <h4> sellers</h4>
                                            <p>post products</br>
                                                promote listings</br>
                                                reach new buyers</p> </label>
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
                                            <p>search jobs</br>
                                                research companies</br>
                                                apply online</p> </label>
                                        <label class="btn btn-primary row-three" id="pulsate-nine">
                                            <input type="radio" name="user_type" value="2_8" autocomplete="off">
                                            <h4> employers</h4>
                                            <p>list jobs
                                                find <br />qualified talent<br />
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
                                                companies</p> </label>
                                        <label class="btn btn-primary row-four" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>find people</p></label>
                                        <label class="btn btn-primary row-four" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>explore <br />
                                                job listings</p> </label>
                                        <label class="btn btn-primary row-four" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>locate <br />
                                                service providers</p></label>
                                        <label class="btn btn-primary row-four" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>seek products</p> </label>
                                        <label class="btn btn-primary row-four" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>find product<br />
                                                services</p> </label>
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
                                            <p>endorse users</p> </label>
                                        <label class="btn btn-primary row-five" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>earn referrals</p> </label>
                                        <label class="btn btn-primary row-five" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>company pages</p> </label>
                                        <label class="btn btn-primary row-five" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>connect</p></label>
                                        <label class="btn btn-primary row-five" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>direct message</p> </label>
                                        <label class="btn btn-primary row-five" id="pulsate-six">
                                            <input type="radio" name="user_type" value="2_6" autocomplete="off">
                                            <p>invite associates</p></label>
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
<!-- /.modal -->
<div class="modal fade footer-modal" id="message_modal" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title pull-left" style="text-transform: uppercase;">Send Message </h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            {!! Form::open([
            'route' => 'messages.store',
            'class' => 'inbox-compose form-horizontal',
            'id' => 'fileupload',
            'enctype' => 'multipart/form-data'
            ]) !!}
            <input type="hidden" name="popup_message" value="1" />
            <input type="hidden" name="recipients[]" value="" id="message-user-id" />
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-md-line-input">
                                <div class="input-icon">
                                    <textarea class="form-control" name="message" placeholder="Add Message Details here." rows="8" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions noborder text-right">
                    <button type="submit" class="btn btn-circle  btn_yellow hvr-bounce-to-right">SEND MESSAGE</button>
                </div>
            </div>
            <div class="modal-footer"> &nbsp; </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    function messageUser(user_id)
    {
        $('#message-user-id').val(user_id);
    }
</script>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade learn_job_modal" id="learn_more_job" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>LEARN ABOUT THE <b>JOB BOARD</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
            </div>
            <p>Creating value is a constant focus for our users, so were introducing a Job Board focused on Industrial
                employment opportunities.  All Indy John users can Post, Recruit, and Search our job board. </p>
            <div class="col-md-6 col-sm-6">
                <div class="row">
                    <h3>JOB SEEKERS</h3>
                    <div class="job_text">
                        <p>Other job listing sites use generic titles and are cluttered with openings that don't apply to your skillset.</p>
                        <p>We'll match you with companies looking for people with your skills and expertise. </p>
                    </div>
                    <ul>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>
                            <p>Search jobs that match your specific skillset </p>
                        </li>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>
                            <p>Discover and research companies</p>
                        </li>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>
                            <p>Apply directly with one quick online application</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 ">
                <div class="row">
                    <h3>EMPLOYERS</h3>
                    <div class="side_line">
                        <div class="job_text">
                            <p>Many job listing sites charge enormous fee's to post
                                your job openings.  Not us, we charge 30.00 USD for
                                each 30 day listing.</p>
                            <p>Looking to post multiple jobs, check out our valued
                                accounts to learn more. </p>
                        </div>
                        <ul>
                            <li><i class="glyphicon glyphicon-ok-sign"></i>
                                <p>Post your employment opportunity for small fee</p>
                            </li>
                            <li><i class="glyphicon glyphicon-ok-sign"></i>
                                <p>Recruit and Select Applicants</p>
                            </li>
                            <li><i class="glyphicon glyphicon-ok-sign"></i>
                                <p>Use our CRM to Manage all job posting data</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <a href="#" data-dismiss="modal" aria-label="Close" class="btn_red  btn_yellow hvr-bounce-to-right">BEGIN EXPLORING NOW</a> </div>
    </div>
</div>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade learn_market_modal" id="learn_more_market" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>LEARN ABOUT THE <b>INDY JOHN MARKET</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
            </div>
            <p>In addition to our Quote-Lead System™, Indy John is looking to streamline the industrial Buy-Sell process
                by opening a new online market dedicated to industrial only - products and supplies. </p>
            <p>Yes, there are multiple online sites that source products but none use the marketing and connecting
                technologies that were creating.</p>
            <p>Whether you're casually shopping, purchasing, or looking to sell items, Indy John Market
                is free to use for all users. </p>
            <div class="col-md-6 col-sm-6">
                <div class="row">
                    <h3>BUYERS</h3>
                    <ul>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>
                            <p>Search items for free</p>
                        </li>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>
                            <p>Sell used items for free</p>
                        </li>
                        <li><i class="glyphicon glyphicon-ok-sign"></i>
                            <p>Contact suppliers directly for listing quotes</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="row">
                    <h3>SUPPLIERS</h3>
                    <div class="side_line">
                        <ul>
                            <li><i class="glyphicon glyphicon-ok-sign"></i>
                                <p>Post items for free</p>
                            </li>
                            <li><i class="glyphicon glyphicon-ok-sign"></i>
                                <p>Post up to 30 items per month with a free account</p>
                            </li>
                            <li><i class="glyphicon glyphicon-ok-sign"></i>
                                <p>No transaction fee for your sales, we don't manage payments at this time</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <a href="#" data-dismiss="modal" aria-label="Close" class="btn_red  btn_yellow hvr-bounce-to-right">BEGIN EXPLORING NOW</a> </div>
    </div>
</div>
<!-- /.modal -->
<!-- /.modal -->

<div class="modal fade footer-modal" id="job_apply" tabindex="-1" role="basic" aria-hidden="true" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content" id="job_apply_main">
            <div class="modal-header">
                <h3 class="modal-title pull-left" style="text-transform: uppercase;">APPLY FOR JOB <span id="apply-job-title"></span> </h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form  method="post" class="horizontal-form form-horizontal" enctype="multipart/form-data" action="{{url('job/apply/save')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="job_id" value="" id="apply-job-id" />
                <input type="hidden" name="apply_job_user" id="apply-user-id" />
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <textarea class="form-control" name="summary" placeholder="Add a Brief summary to your application." rows="6" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="white_bg">
                                    <span class="pull-left text_note"> Upload and Attach your Resume.</span>
                                    <div class="pull-right">
                                        <span id="resume-file-name" class="pull-left font-dark padding-right text_note"></span>
                        <span class="btn btn-default btn-circle fileinput-button pull-right">
                            <span id="resume-upload-name"> UPLOAD FILE </span>
                            <input type="file" id="resume-doc" name="resume"  required="" class="form-control">
                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="color_bg">
                                    <span class="pull-left text_note" style="color: #333!important;"> Add an Optional Cover Letter for your application.</span>
                                    <div class="pull-right">
                                        <span id="cover-letter-file-name" class="pull-left font-dark padding-right text_note"></span>
                        <span class="btn btn-default btn-circle fileinput-button pull-right">
                            <span id="cover-letter-upload-name"> UPLOAD FILE </span>
                            <input type="file" id="cover-letter-doc" name="cover_latter" multiple>
                        </span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="white_bg">
                                    <span class="pull-left text_note text_note"> Are you authorized to work in <span id="apply-job-country"></span>.</span>
                                    <div class="pull-right">
                                        <select class="bs-select form-control btn-default btn-circle" name="authorized_work">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="color_bg">
                                    <span class="pull-left text_note" style="color: #333!important;"> You certify that the information you provided on this form and your profile is accurate.</span>
                                    <div class="pull-right">
                                        <select class="bs-select form-control btn-default btn-circle" name="certify_information">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions noborder margin-top-15"> <span class="pull-left text_note">Please note, your complete User Profile will be sent with your application.
            . </span>
                        <button type="submit" class="btn yellow btn-circle pull-right">SUBMIT APPLICATION</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer"> &nbsp; </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade footer-modal" id="contact_seller" tabindex="-1" role="basic" aria-hidden="true" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="message_box_title" class="modal-title pull-left" style="text-transform: uppercase;">Contact The Seller </h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form  method="post" class="horizontal-form">
                <input type="hidden" name="message_receiver" id="message_receiver">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" id="subject" placeholder="Add Subject" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <textarea class="form-control" id="message_body" placeholder="Add Message Details here." rows="8"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions noborder text-right">
                        <button id="contactSeller" type="button" onclick="sendMessage()" class="btn btn-circle  btn_yellow hvr-bounce-to-right">SEND MESSAGE</button>
                        <button id="contactTeamMember" style="display: none" type="button" onclick="sendTeamMemberMessage()" class="btn btn-circle  btn_yellow hvr-bounce-to-right">SEND MESSAGE</button>
                    </div>
                </div>
                <div class="modal-footer"> &nbsp; </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade footer-modal" id="request_quote" tabindex="-1" role="basic" aria-hidden="true" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="message_box_title" class="modal-title pull-left" style="text-transform: uppercase;">REQUEST A QUOTE</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form  action="{{url('marketplaceproduct/request_quote')}}" method="post" class="horizontal-form">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="product_id" id="product_id" value="{{csrf_token()}}" />

                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span style="margin-left:15px">NAME : {{Auth::user()->userdetail->first_name}} {{Auth::user()->userdetail->last_name}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <textarea class="form-control" id="additional_notes" name="additional_notes" placeholder="Add Additional Notes To Your Quote Request" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Enter Your Address:</label>
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <input type="text" id="marketPlaceRequestQuoteAddressAutoComplete" name="multi_select_items" onFocus="geolocate_m()" value=""  placeholder="Enter address" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <textarea data-required="1" id="street_number" name="address" class="form-control" placeholder="Enter Address Line 1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <textarea id="route" name="address2" class="form-control" placeholder="Enter Address Line 2:"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <input data-required="1" id="locality" type="text" name="city" value="" class="form-control" placeholder="Enter the City Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <input data-required="1" id="administrative_area_level_1"  type="text" name="state" value="" class="form-control" placeholder="Enter the State Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <input data-required="1" id="postal_code" type="text" name="zip" value="" class="form-control" placeholder="Enter your Zip code">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        <input data-required="1" id="country" type="text" name="country" value="" class="form-control" placeholder="Enter your Zip code">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions noborder text-right">
                        <button id="contactSeller" type="submit" class="btn btn-circle  btn_yellow hvr-bounce-to-right">REQUEST QUOTE</button>
                    </div>
                </div>
                <div class="modal-footer"> &nbsp; </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade footer-modal" id="share" tabindex="-1" role="basic" aria-hidden="true" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="portlet">
                <div class="portlet-body">
                    <div class="modal-header">
                        <h3 class="modal-title pull-left" style="text-transform: uppercase;">Share BY </h3>
                        <ul class="nav pull-left share_icon">
                            <li><a class="green" href="#tab_2_1" data-toggle="tab"><i class="fa fa-link"></i></a></li>
                            <li><a class="yellow" href="#tab_2_2" data-toggle="tab"><i class="fa fa-envelope-o"></i></a></li>
                            <li><a class="blue1" href="#" id="share-linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a class="blue2" href="#" id="share-facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="blue3" href="#" id="share-twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="red" href="#" id="share-google" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_2_1">
                            <form  method="post" class="horizontal-form">
                                <div class="modal-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12 margin_input">
                                                <div class="form-group form-md-line-input">
                                                    <div class="col-md-12">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-control">
                                                                <input id="copyTarget" type="text" class="form-control input-sm" placeholder="" value="#" >
                                                            </div>
                              <span class="input-group-btn btn-right">
                              <button id="copyButton" class="btn default relative" type="button">COPY <i class="fa fa-link green"></i></button>
                              </span> </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <p id="msg"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer"> &nbsp; </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab_2_2">
                            <form action="{{url('mail/share/link')}}" method="post" class="horizontal-form">
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                <input type="hidden" name="share_link" id="share-mail" value="" />
                                <div class="modal-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="email" name="recipient_email" required class="form-control" placeholder="RECIPIENT'S E-MAIL">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="email" name="user_email" readonly required value="{{Auth::user()->email}}" class="form-control" placeholder="YOUR E-MAIL">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="text" name="message" class="form-control" placeholder="OPTIONAL MESSAGE">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions noborder text-right">
                                        <button type="submit" class="btn blue">SEND</button>
                                    </div>
                                </div>
                                <div class="modal-footer"> &nbsp; </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade footer-modal" id="footer-feedback" tabindex="-1" role="basic" aria-hidden="true" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h3 class="modal-title" style="text-transform: uppercase;">Help us Improve</h3>
                <p class="caption-helper" style="margin: 5px 0px!important;">Your feedback helps us understand what we do well and where we can improve.</p>
            </div>
            <form action="{{url('feedback/message')}}" method="post" class="horizontal-form">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Subject:</label>
                            <div class="">
                                <input type="text" name="subject" class="form-control" placeholder="Add a subject line for your feedback" />
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="control-label">Summary:</label>
                            <div class="">
                                <textarea name="message" class="form-control" rows="4" placeholder="Please provide any details related to your subject."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn yellow-crusta">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade footer-modal" id="basic" tabindex="-1" role="basic" aria-hidden="true" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="btn btn-circle btn-outline" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title align-center" id="myModalLabel">
                    Tell your Professional Network about us!
                </h4>
            </div>
            <div class="modal-body" id="basic-invite">
                <div class="title align-center">
                    <h2>Invite new users or connect with existing associates. </h2>
                    <p>Earn referral payouts on users that choose valued accounts. <a href="{{url('referral-link/about-the-program')}}">Learn More</a>
                    </p>
                </div>
                <div class="form align-center paddin-bottom" style="width: 70%;margin: 0 auto;">
                    <!--  form-body  -->

                    <div class="align-center" >
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 ">
                                <a href="{{Session::get('google_invite_url')}}" target="_blank"><img src="{{url('images/Indy-John/gmail-icon.png')}}" class="img-circle center-block modal-invite-img"></a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="javascript:void(0)" onclick="GetYahooHeaderContact();"><img src="{{url('images/Indy-John/yahoo-icon.png')}}" class="img-circle modal-invite-img center-block"></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="{{Session::get('msn_invite_url')}}" target="_blank"><img src="{{url('images/Indy-John/outlook-icon.png')}}" class="img-circle modal-invite-img center-block"></a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="{{url('invite/email')}}" target="_blank"><img src="{{url('images/Indy-John/mail-icon.png')}}" class="img-circle modal-invite-img center-block"></a>
                            </div>
                        </div>
                    </div>
                    <!--  /form-body  -->

                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade footer-modal" id="share" tabindex="-1" role="basic" aria-hidden="true" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="portlet">
                <div class="portlet-body">
                    <div class="modal-header">
                        <h3 class="modal-title pull-left" style="text-transform: uppercase;">Share BY </h3>
                        <ul class="nav pull-left share_icon">
                            <li><a class="green" href="#tab_2_1" data-toggle="tab"><i class="fa fa-link"></i></a></li>
                            <li><a class="yellow" href="#tab_2_2" data-toggle="tab"><i class="fa fa-envelope-o"></i></a></li>
                            <li><a class="blue1" href="#" id="share-linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a class="blue2" href="#" id="share-facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="blue3" href="#" id="share-twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="red" href="#" id="share-google" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_2_1">
                            <form  method="post" class="horizontal-form">
                                <div class="modal-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12 margin_input">
                                                <div class="form-group form-md-line-input">
                                                    <div class="col-md-12">
                                                        <div class="input-group input-group-sm">
                                                            <div class="input-group-control">
                                                                <input id="copyTarget" type="text" class="form-control input-sm" placeholder="" value="#" >
                                                            </div>
                              <span class="input-group-btn btn-right">
                              <button id="copyButton" class="btn default relative" type="button">COPY <i class="fa fa-link green"></i></button>
                              </span> </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <p id="msg"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer"> &nbsp; </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab_2_2">
                            <form action="{{url('mail/share/link')}}" method="post" class="horizontal-form">
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                <input type="hidden" name="share_link" id="share-mail" value="" />
                                <div class="modal-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="email" name="recipient_email" required class="form-control" placeholder="RECIPIENT'S E-MAIL">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="email" name="user_email" readonly required value="{{Auth::user()->email}}" class="form-control" placeholder="YOUR E-MAIL">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group form-md-line-input">
                                                    <div class="input-icon">
                                                        <input type="text" name="message" class="form-control" placeholder="OPTIONAL MESSAGE">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions noborder text-right">
                                        <button type="submit" class="btn blue">SEND</button>
                                    </div>
                                </div>
                                <div class="modal-footer"> &nbsp; </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Upgrade account modal -->






<div class="modal fade general-pricing" id="upgrade-supplier-acount-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<ul class="nav nav-tabs">
    <li> <a data-toggle="tab" href="#tab_buyer" aria-expanded="true">Upgrade Your Buyer Dashboard </a> </li>
    <li class="active"> <a data-toggle="tab" href="#tab_supplier" aria-expanded="false">Upgrade Your Supplier Crm </a> <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> </button></li>
</ul>
<div style="opacity: 1; transition: opacity 0.1s linear 0s;" class="tab-content">
<form method="post" action="{{url('user/packages/save')}}" role="form" id="payment-form-pop"  class="form-horizontal form-row-seperated">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="card_token" value="" id="card_token_pop" />
    <input type="hidden" name="card_last_4" value="" id="card_last_4_pop" />
    <input type="hidden" name="card_type" id="card_type_pop" value="" />
    <input type="hidden" name="cardNumber" id="cardNumber_pop" value="" />
    <input type="hidden" name="cardExpiry" id="cardExpiry_pop" value="" />
    <input type="hidden" name="cardCVC" id="cardCVC_pop" value="" />
    <input type="hidden" name="billing_plan" id="billing_plan_pop" />
    <input type="hidden" id="modal-type" />
    <input type="hidden" id="package_id" />
    <input type="hidden" name="team_member_id" id="team_member_id" />
</form>
<div id="tab_buyer" class="tab-pane">

    <div class="buyer_content">
        <div class="col-md-12 buyer_content_inner">
            <h5>Gain more pricing options by becoming a Buyer+</h5>
            <p>Being a consumer in today's industrial marketplace is difficult and time consuming. Upgrade to our Buyer+ account to gain advantages and simplify your purchasing process. </p>
        </div>
        <br>
        <br>
        <div class="clearfix"></div>
        <div class="col-md-4">
            <div class="thumbnail">
                <div class="caption">
                    <h1 class="box-title"> FREE </h1>
                    <h6>ACCOUNT</h6>
                    <h1><span>$</span>0</h1>
                    <h6>PER MONTH</h6>
                    <hr>
                    <ul class="free-list">
                        <li>BUY REQUESTS LIMITED TO<strong> 30/ MONTH</strong></li>
                        <li>QUOTES DELAYED UP TO<strong> 1 DAY</strong></li>
                        <li><strong>30 </strong>DIRECT MESSAGES</li>
                        <li>LIMITED TO <strong>10</strong> INDUSTRIAL MARKETS</li>
                        <li>POST UP TO<strong> 30 </strong>MARKET LISTINGS</li>
                        <li>MARKET LISTINGS EXPIRE MONTHLY</li>
                        <li><strong>NO</strong> JOB BOARD CREDITS</li>
                        <li><span>VERIFICATION NOT INCLUDED</span></li>
                    </ul>
                    @if(Auth::user()->account_plan == 'buyerstandard' || Auth::user()->account_plan == null)
                    <button id="plan_FREE_2_0">CURRENT</button>
                    @elseif(Auth::user()->account_plan == 'buyerplus')
                    <a id="plan_FREE_2_0_0" class="downgrade-class" href="{{url('user/packages')}}" >DOWNGRADE</a>
                    @else
                    <button id="plan_FREE_2_0_0" class="upgrade" onclick="updatePlan(id,'buyer');">UPGRADE</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail gray_color">
                <div class="caption">
                    <h1 class="box-title"> BUYER+ </h1>
                    <h6>ACCOUNT</h6>
                    <h1><span>$</span>199</h1>
                    <h6>PER MONTH</h6>
                    <hr>
                    <ul class="free-list">
                        <li><span>UNLIMITED</span> BUY REQUESTS</li>
                        <li>QUOTES DELIVERED <span>INSTANTLY</span></li>
                        <li><strong>UNLIMITED </strong>DIRECT MESSAGES</li>
                        <li><span>UNLIMITED</span> INDUSTRIAL MARKETS</li>
                        <li><span>UNLIMITED</span> MARKET LISTINGS</li>
                        <li>MARKET LISTINGS <span>DO NOT EXPIRE</span></li>
                        <li><span>15</span> JOB BOARD CREDITS</li>


                        <li><span>VERIFICATION INCLUDED</span></li>
                    </ul>
                    @if(Auth::user()->account_plan == 'buyerplus')
                    <button id="plan_BUYERPLUS_1_19900_18000">CURRENT</button>
                    @else
                    <button class="upgrade" id="plan_BUYERPLUS_1_19900_18000" onclick="updatePlan(id,'buyer');">UPGRADE</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <div class="caption">
                    <h1 class="box-title"> ADVANCED </h1>
                    <h6>ACCOUNT</h6>
                    <h2>COMING<br/>
                        SOON</h2>
                    <div class="current-plan">
                        <p><span>EXPANDED PURCHASING</span><br/>
                            FEATURES AND TOOLS</p>
                    </div>
                    <button class="upgrade">COMING SOON</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="footer-pricing">
            <h4>Industrial Purchasing made Easy, Upgrade Now.</h4>
            <h5><b>*Upgrade before September 31, 2016 and Lock in your Buyer+ account price <u>Forever</u>!</b></h5>
        </div>
    </div>
</div>
<div id="tab_supplier" class="tab-pane active in">

    <div class="supplier_content">
        <div class="col-md-12 supplier_content_inner">
            <h5>Increase selling opportunities for the price of a cell phone bill.</h5>
            <p> We know sales environments can be very competitive, and prospecting for serious buyers can be very time
                consuming.  Gain advantages now by upgrading
                to one of our valued accounts. </p>
        </div>

        <br>
        <br>
        <div class="clearfix"></div>
        <div class="col-md-4">
            <div class="thumbnail">
                <div class="caption">
                    <h1 class="box-title"> FREE </h1>
                    <h6>ACCOUNT</h6>
                    <h1><span>$</span>0</h1>
                    <h6>PER MONTH</h6>
                    <ul class="free-list">
                        <li>LEADS LIMITED UP TO <strong>10/ MONTH</strong></li>
                        <li>LEADS DELAYED UP TO <strong>1 DAY</strong></li>
                        <li><strong>30 </strong>DIRECT MESSAGES</li>
                        <li>LIMITED TO<strong> 1</strong> INDUSTRIAL MARKET</li>
                        <li>POST UP TO <strong>30</strong> MARKET LISTINGS</li>
                        <li>MARKET LISTINGS EXPIRE MONTHLY</li>
                        <li><strong>NO</strong> JOB BOARD CREDITS</li>
                        <li><span>VERIFICATION NOT INCLUDED</span></li>
                    </ul>
                    @if(Auth::user()->account_member == null)
                    <button id="plan_FREE_5_0" >CURRENT</button>
                    @elseif(Auth::user()->account_member == 'silver' || Auth::user()->account_plan == 'gold')
                    <a id="plan_FREE_5_0_0" class="downgrade-class" href="{{url('user/packages')}}" >DOWNGRADE</a>
                    @else
                    <button id="plan_FREE_5_0_0" class="upgrade" onclick="updatePlan(id,'seller');">UPGRADE</button>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail">
                <div class="caption">
                    <h1 class="box-title"> SILVER </h1>
                    <h6>ACCOUNT</h6>
                    <h1><span>$</span>149</h1>
                    <h6>PER MONTH</h6>
                    <ul class="free-list">
                        <li>LEADS LIMITED UP TO <strong>30/ MONTH</strong></li>
                        <li>LEADS DELAYED UP TO <strong>12 HOURS</strong></li>
                        <li><strong>UNLIMITED </strong>DIRECT MESSAGES</li>
                        <li>LIMITED TO <strong>10 </strong>INDUSTRIAL MARKETS</li>
                        <li>POST UP TO<strong> 100</strong> MARKET LISTINGS</li>
                        <li>MARKET LISTINGS DO NOT EXPIRE</li>
                        <li><strong>5 </strong>JOB BOARD CREDITS</li>
                        <li><span>VERIFICATION INCLUDED</span></li>
                    </ul>
                    @if(Auth::user()->account_member == 'silver')
                    <button id="plan_SILVER_4_14900_13000" >CURRENT</button>
                    @elseif(Auth::user()->account_member == 'gold')
                    <a id="plan_SILVER_4_14900_13000" class="downgrade-class" href="{{url('user/packages')}}" >DOWNGRADE</a>
                    @else
                    <button class="upgrade"  id="plan_SILVER_4_14900" onclick="updatePlan(id,'seller');">UPGRADE</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail gray_color">
                <div class="most-popular"> BEST VALUE - MOST POPULAR<br/>
                    UNLIMITED ACCESS </div>
                <div class="caption">
                    <h1 class="box-title"> GOLD </h1>
                    <h6>ACCOUNT</h6>
                    <h1><span>$</span>199</h1>
                    <h6>PER MONTH</h6>
                    <ul class="free-list">
                        <li><span>UNLIMITED</span> LEADS</li>
                        <li>LEADS DELIVERED <span> INSTANTLY</span></li>
                        <li><strong>UNLIMITED </strong>DIRECT MESSAGES</li>
                        <li><span>UNLIMITED</span> INDUSTRIAL MARKETS</li>
                        <li><span>UNLIMITED</span> MARKET LISTINGS</li>
                        <li>MARKET LISTINGS <span>DO NOT EXPIRE</span></li>
                        <li><span>15</span> JOB BOARD CREDITS</li>
                        <li><span>VERIFICATION INCLUDED</span></li>
                    </ul>
                    @if(Auth::user()->account_member == 'gold')
                    <button id="plan_GOLD_3_19900_18000" >CURRENT</button>
                    @else
                    <button class="upgrade" id="plan_GOLD_3_19900_18000" onclick="updatePlan(id,'seller');">UPGRADE</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="footer-pricing">
            <h4>Don't Limit Your Opportunities, Upgrade Now. </h4>
            <h5><b>*Upgrade before September 31, 2016 and Lock in your Silver or Gold account price <u>Forever</u>!</b></h5>
        </div>
    </div>
</div>
</div>
</div>


<!--team create subscription modal-->
<div class="modal fade general-pricing" id="create_buyer_subscription_team" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <ul class="nav nav-tabs">
        <li> <a data-toggle="tab" href="#tab_buyer" aria-expanded="true">Upgrade Buyer Dashboard For Team Member</a> <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> </button></li>
    </ul>
    <div style="opacity: 1; transition: opacity 0.1s linear 0s;" class="tab-content">
        <div id="tab_buyer" class="tab-pane active in">

            <div class="buyer_content">
                <div class="col-md-12 buyer_content_inner">
                    <h5>Gain more pricing options by becoming a Buyer+</h5>
                    <p>Being a consumer in today's industrial marketplace is difficult and time consuming. Upgrade to our Buyer+ account to gain advantages and simplify your purchasing process. </p>
                </div>
                <br>
                <br>
                <div class="clearfix"></div>

                <div class="col-md-6">
                    <div class="thumbnail gray_color">
                        <div class="caption">
                            <h1 class="box-title"> BUYER+ </h1>
                            <h6>ACCOUNT</h6>
                            <h1><span>$</span>199</h1>
                            <h6>PER MONTH</h6>
                            <hr>
                            <ul class="free-list">
                                <li><span>UNLIMITED</span> BUY REQUESTS</li>
                                <li>QUOTES DELIVERED <span>INSTANTLY</span></li>
                                <li><strong>UNLIMITED </strong>DIRECT MESSAGES</li>
                                <li><span>UNLIMITED</span> INDUSTRIAL MARKETS</li>
                                <li><span>UNLIMITED</span> MARKET LISTINGS</li>
                                <li>MARKET LISTINGS <span>DO NOT EXPIRE</span></li>
                                <li><span>15</span> JOB BOARD CREDITS</li>


                                <li><span>VERIFICATION INCLUDED</span></li>
                            </ul>

                            <button class="upgrade" id="plan_BUYERPLUS_1_19900_18000_team" onclick="updatePlan(id,'buyer');">UPGRADE</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="thumbnail">
                        <div class="caption">
                            <h1 class="box-title"> ADVANCED </h1>
                            <h6>ACCOUNT</h6>
                            <h2>COMING<br/>
                                SOON</h2>
                            <div class="current-plan">
                                <p><span>EXPANDED PURCHASING</span><br/>
                                    FEATURES AND TOOLS</p>
                            </div>
                            <button class="upgrade">COMING SOON</button>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="footer-pricing">
                    <h4>Industrial Purchasing made Easy, Upgrade Now.</h4>
                    <h5><b>*Upgrade before September 31, 2016 and Lock in your Buyer+ account price <u>Forever</u>!</b></h5>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- end team create subscription modal-->










<!-- /.modal -->
<!-- dashboar select modal -->
<!-- /.modal -->
<div class="modal fade" id="dashboard-select-modal" tabindex="-1" role="basic" aria-hidden="true" data-width="760">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="btn btn-circle btn-outline" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h3 class="modal-title">WHAT WOULD YOU LIKE TO DO TODAY?</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="align-center">Select the option that best applies:</h4>
                        <div class="col-md-12 align-center">
                            <input type="hidden" id="pulsate-val" value="@if(Session::has('pulsate')) {{Session::get('pulsate')}} @endif" />
                            <div class="btn-group quickstart" data-toggle="buttons">
                                <div class="col-md-2 col-sm-2">
                                    <div class="row"> <span class="quickstart_heading buyers">Buyers</span>
                                        <div class="clearfix"></div>
                                        <label class="btn btn-primary btn-group invite-contact-sec-div row-one" id="pulsate-one">
                                            <input type="radio" name="user_type" value="2_1" autocomplete="off">
                                            Get<br />
                                            <b>Product Quotes</b> </label>
                                        <label class="btn btn-primary row-one" id="pulsate-four">
                                            <input type="radio" name="user_type" value="2_2" autocomplete="off">
                                            Find <b>Product Service</b> </label>
                                        <label class="btn btn-primary row-one" id="pulsate-nine">
                                            <input type="radio" name="user_type" value="2_3" autocomplete="off">

                                            <b>Team<br />Purchasing </b> </label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <div class="row"> <span class="quickstart_heading suppliers">Suppliers</span>
                                        <div class="clearfix"></div>
                                        <label class="btn btn-primary row-two" id="pulsate-two">
                                            <input type="radio" name="user_type" value="3_1" autocomplete="off">
                                            Receive <b>Product <br/>& Service Leads</b> </label>
                                        <label class="btn btn-primary row-two" id="pulsate-eight">
                                            <input type="radio" name="user_type" value="3_2" autocomplete="off">
                                            <b>Upload</b> <br/>
                                            Product Catalog </label>
                                        <label class="btn btn-primary row-two" id="pulsate-five">
                                            <input type="radio" name="user_type" value="3_3" autocomplete="off">

                                            <b>Team<br />Supplying </b> </label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <div class="row"> <span class="quickstart_heading multi-user">Multi-User</span>
                                        <div class="clearfix"></div>
                                        <label class="btn btn-primary row-three" id="pulsate-six">
                                            <input type="radio" name="user_type" value="4_1" autocomplete="off">
                                            <b>Upgrade</b><br />
                                            Account </label>
                                        <label class="btn btn-primary row-three" id="pulsate-eight">
                                            <input type="radio" name="user_type" value="4_2" autocomplete="off">
                                            <b>Verify</b><br/>
                                            Account </label>
                                        <label class="btn btn-primary row-three" id="pulsate-nine">
                                            <input type="radio" name="user_type" value="4_3" autocomplete="off">
                                            Claim or Create<br />
                                            <b>Company Page</b></label>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row"> <span class="quickstart_heading more-options">More Options</span>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="row">
                                                <label class="btn btn-primary row-four" id="pulsate-three">
                                                    <input type="radio" name="user_type" value="5_1" autocomplete="off">
                                                    Explore<br />
                                                    <b>Indy John Market</b> </label>
                                                <label class="btn btn-primary row-four" id="pulsate-seven">
                                                    <input type="radio" name="user_type" value="5_2" autocomplete="off">
                                                    Visit the<br />
                                                    <b>Job Board</b> </label>
                                                <label class="btn btn-primary row-four" id="pulsate-six">
                                                    <input type="radio" name="user_type" value="5_3" autocomplete="off">
                                                    <b>  Refer  <br />
                                                        &  Earn  </b></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="row">
                                                <label class="btn btn-primary row-four" id="pulsate-three">
                                                    <input type="radio" name="user_type" value="5_4" autocomplete="off">
                                                    Locate Industrial <br />
                                                    <b>Service Providers</b> </label>
                                                <label class="btn btn-primary row-four" id="pulsate-seven">
                                                    <input type="radio" name="user_type" value="5_5" autocomplete="off">
                                                    Search & <br />
                                                    <b>Discover</b> </label>
                                                <label class="btn btn-primary row-four" id="pulsate-six">
                                                    <input type="radio" name="user_type" value="5_6" autocomplete="off">
                                                    Read   <br />
                                                    <b> FAQs</b>  </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <a onclick="goToDashboard(this)" href="{{url('user-dashboard')}}" data-dismiss="modal"><b>Not Sure yet, but want to Explore.</b></a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Welcome modal -->
<!-- /.modal -->
<!--<div class="modal fade footer-modal" id="user-welcome-modal" tabindex="-1" role="basic" aria-hidden="true" data-width="400">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="pull-left">&nbsp;</h4>
        <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 margin-top-40 margin-bottom-40">
            <input type="hidden" id="user-reg-first" value="@if(Session::has('new_user_first')) 1 @endif" />
            <h1 class="align-center">Welcome To <img src="{{URL::asset('images/indy_john_crm_logo.png')}}" /></h1>
            <br />
            <div class="col-md-12 align-center">
              <h3 class="modal-title">Please take a few minutes to Complete Your <b>User Profile</b> <br />
                before Exploring Indy John.</h3>
              <br />
              <div id="timer"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <h3>&nbsp;</h3>
      </div>
    </div>

  </div>

</div>-->
<div class="modal fade user-welcome-modal" id="user-welcome-modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="55" width="260" /></div>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <input type="hidden" id="user-reg-first" value="@if(Session::has('new_user_first')) 1 @endif" />
                    @if(Auth::user()->is_using_temporary_password == 0)
                    <h3>Welcome, {{Auth::user()->userdetail->first_name}}</h3>
                    @endif

                    <p style="font-family: 'Open Sans', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 25px; line-height: 1.5em; font-weight: normal; margin: 0 auto 10px; padding: 0;">Our Profile Setup might take a few extra minutes,<br/>but this will ensure that you’re making... <br><span style="color:#ef5350;"><b>MEANINGFUL INDUSTRIAL CONNECTIONS.</b></span></p>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">BEGIN PROFILE SETUP</button>
                </div>
            </div>
            <div class="modal-footer text-center">
                <h5>&nbsp;</h5>

            </div>
        </div>

    </div>
</div>


<div class="modal fade new-user-welcome-modal" id="new-user-welcome-modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="55" width="260" /></div>
            </div>
            <div class="modal-body">
                <div class=" text-uppercase text-center">
                    <input type="hidden" id="user-reg-first" value="@if(Session::has('new_user_first')) 1 @endif" />
                    @if(Auth::user()->is_using_temporary_password == 0)
                    <h3>Welcome, {{Auth::user()->userdetail->first_name}} {{Auth::user()->userdetail->last_name}}</h3>
                    @endif

                    <h4>Let's begin by creating a User Profile. </br> Our Profile Setup might take a few extra minutes, but this will ensure that you're making</h4>
                    <h4 style="color:#ef5350;">Meaningful Industrial Connections.</h4>
                    <a class="btn btn-danger" href="{{url('user-details')}}?customCongrates=yes">BEGIN PROFILE SETUP</a>
                </div>
            </div>
            <div class="modal-footer text-center">
                <h5>&nbsp;</h5>

            </div>
        </div>

    </div>
</div>

@if(Auth::user()->userdetail->company_id != null)
<div class="modal fade begin_tutorial" id="showCustomCongrates-modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <h4 style="color:#ef5350;">{{Auth::user()->userdetail->UserCompany->name}}</h4>
                    <h4>Edit Your Company Page Details and Set up an Administrator. </h4>
                    <a class="btn_red  hvr-bounce-to-right" href="{{url('companies')}}/{{Auth::user()->userdetail->company_id}}/edit">EDIT COMPANY DETAILS</a>

                </div>
            </div>

        </div>

    </div>
</div>
@endif

@if(Auth::user()->userdetail->company_id != null)
<div class="modal fade begin_tutorial" id="completeCompanyProfile"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center"><img src="{{URL::asset('livesite/images/indy-john/Logo.png')}}" height="40" width="170" /></div>
            </div>
            <div class="modal-body">
                <div class=" text-uppercase text-center">
                    <h3><B>Congratulations!</B><br /><span>You have completed your Indy John company Page.</span></h3>

                    <div class="text-center"><img src="{{URL::asset('livesite/images/icons/interface-1.png')}}" height="64" width="64" /></div>

                    <h4 style="color: red">
                        Your Company Page URL is :
                        <a id="copyCompanyUrl" style="color: red" href="{{url('company/profile/')}}/{{Auth::user()->userdetail->company_id}}"><b>indyjohn.com/company/{{Auth::user()->userdetail->UserCompany->name}}</b>.</a>
                        <button id="copyCompany" class="btn-sm relative" type="button">COPY</button>
                    </h4>
                    <p id="message"></p>

                    <h4>Our platform has a lot to offer.</h4>
                    <h4>Please take a few minutes to go through our tutorial.</h4>
                    <a class="btn btn-danger" href="{{url('user-dashboard')}}?setup=tutorial">BEGIN TUTORIAL</a>
                    <a class="skip" href="{{url('user-dashboard')}}?popup=overview">SKIP</a>
                </div>
            </div>
            <div class="modal-footer text-center">
                <h5>&nbsp;</h5>

            </div>
        </div>

    </div>
</div>
@endif
<!-- /.modal -->
<!-- success payment modal -->
<!-- /.modal -->
<div class="modal fade footer-modal" id="payment-success-modal" tabindex="-1" role="basic" aria-hidden="true" data-width="400">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Thank you for your Payment</h3>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 margin-top-40 margin-bottom-40">
                        <div class="col-md-12 align-center">
                            <p class="modal-title">Thank you for your Payment. Your subscription has been created and payment has been applied to your account.</p>
                            <br />
                            <p class="modal-title">You Can Manage your Subscription from your Your Indy John Account sub-menu.</p>
                            <br />
                            <br />
                            <div id="timer-payment"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <h3>&nbsp;</h3>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- password-model --->
<div class="modal fade reset-password" id="reset-password" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class=" text-uppercase text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                <h3>Welcome to Indy John</h3>
                <!--                        <h5>so that we can prepare your account</h5>-->
                <form role="form" method="POST" action="{{url('saveResetPassword')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-inline">
                        <h4>Please set your password: </h4>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <input type="password" name="password" id="password" class="form-control"  value="" placeholder="PASSWORD" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-12 col-xs-12">
                            <div class="row">
                                <input type="password" name="rpassword" id="rpassword" class="form-control"  value="" placeholder="REPEAT PASSWORD" required>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-inline ">

                        <h4 style="padding:0px !important">&nbsp;</h4>
                        <div align="center" class="form-group col-md-12 col-sm-12 col-xs-12">
                            <button class="btn_red  hvr-bounce-to-right" type="submit" onclick="return checkPassword();">SET PASSWORD </button>
                            <h6>You Agree To Our <a href="terms" target="_blank">Terms & Conditions</a> & <a href="privacy-policy" target="_blank">Privacy Policy</a>.</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>


</div>

<!-- end -->
<div class="page-footer">

    <div class="page-footer-inner"> © Indy John Inc. All Rights Reserved. <a href="#footer-feedback" data-toggle="modal" data-target="#footer-feedback" ><b>Feedback</b></a>

    </div>
    <img class="footer_logo" src="{{URL::asset('livesite/images/powered-by-indy-john.png')}}" height="25px" width="200px">
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>

$(document).ready(function(){
    if($(window).width() < 769){
        console.log($(window).width());
        $('.page-header-inner').find('.buttons-toggle').addClass('navbar-collapse collapse').css('overflow','hidden');
        $('.page-top').addClass('navbar-collapse collapse').css('overflow','hidden').css('height','1px');
    }


});

$(document).ready(function() {

    var first = $('#user-reg-first').val();

    if(first == 1)
    {
        $('#user-welcome-modal').modal('show');
        clock();
    }



});

function showShare(id,title)
{
    var mainUrl = id;
    var linkedIn = 'https://www.linkedin.com/shareArticle?mini=true&url='+id;
    var facebook = 'https://www.facebook.com/sharer/sharer.php?u='+id;
    var twitter = 'https://twitter.com/home?status='+title+','+id;
    var google_plus = 'https://plus.google.com/share?url='+id;
    $('#copyTarget').val(mainUrl);
    $('#share-mail').val(id);
    $('#share-linkedin').attr('href',linkedIn);
    $('#share-facebook').attr('href',facebook);
    $('#share-twitter').attr('href',twitter);
    $('#share-google').attr('href',google_plus);
    $('#share').modal('show');
}

function payWithStripe(){
    jQuery('#payment_modal').modal('hide');
    initStripePayment();
}

function payWithPaypal(){
    var type = '';
    if($('#annually').hasClass('active')){
        type = 'annual';
    }else{
        type = 'month';
    }
    var id = $('#package_id').val();
    var values = id.split('_');
    var paymentValue = ''
    if(type == 'month'){
        paymentValue = values[3];
    }else{
        paymentValue = values[4]*12;
    }
    window.location.href = "{{url('init-paypal-payment/?payment=')}}"+paymentValue+'&plan='+values[1]+'&type='+type+'&team_member_id='+$('#team_member_id').val();
}

function initStripePayment(){
    var id = $('#package_id').val();
    var values = id.split('_');
    if($('#annually').hasClass('active')){
        type = 'annual';
    }else{
        type = 'month';
    }

    if(type == 'month'){
        $('#billing_plan_pop').val(values[2]);
    }else{
        if(values[2] == '3'){
            $('#billing_plan_pop').val('7');
        }
        else if(values[2] == '4'){
            $('#billing_plan_pop').val('8');
        }
        else if(values[2] == '1'){
            $('#billing_plan_pop').val('6');
        }
    }


    var handler = StripeCheckout.configure({
        key: "{{env('STRIPE_PUBLIC_KEY', '')}}",
        image: "{{url('images/indy-john-acronym-small-stripe.png')}}",
        locale: 'auto',
        token: function(token) {

            App.blockUI({
                target: '#upgrade-supplier-acount-modal',
                animate: true
            });
            $('#card_token_pop').val(token.id);
            $('#card_last_4_pop').val(token.card.last4);
            $('#cardNumber_pop').val('');
            $('#cardExpiry_pop').val(token.card.exp_month+' / '+token.card.exp_year);
            $('#cardCVC_pop').val('');
            $('#card_type_pop').val(token.card.brand+' '+token.type);

            //$('#payment-form-pop').submit();

            var type = '';
            if($('#annually').hasClass('active')){
                type = 'annual';
            }else{
                type = 'month';
            }
            var id = $('#package_id').val();
            var values = id.split('_');
            var paymentValue = ''
            if(type == 'month'){
                paymentValue = values[3];
            }else{
                paymentValue = values[4]*12;
            }

            $.ajax({
                url: "{{url('user/packages/save?payment=')}}"+paymentValue+'&plan='+values[1]+'&type='+type,
                type: 'post',
                data:$("#payment-form-pop").serialize(),
                success: function(data) {
                    $('#payment-success-modal').modal('show');
                    clockPayment();
                    App.unblockUI('#upgrade-supplier-acount-modal');
                },
                done: function() {
                    //console.log('error');
                    App.unblockUI('#upgrade-supplier-acount-modal');
                },
                error: function() {
                    //console.log('error');
                    App.unblockUI('#upgrade-supplier-acount-modal');
                }

            });
            // You can access the token ID with `token.id`.
            // Get the token ID to your server-side code for use.
        }
    });

    var type = '';
    if($('#annually').hasClass('active')){
        type = 'annual';
    }else{
        type = 'month';
    }
    handler.open({
        name: "{{url('/')}}",
        description: values[1]+' ACCOUNT',
        email:"{{Auth::user()->email}}",
        billingAddress: true,
        amount: (type == 'month') ? values[3] : values[4]*12
    });
}

function updatePlan(id,user_type)
{
    if(user_type == 'seller')
    {
        $('#modal-type').val('seller');
    }
    else
    {
        $('#modal-type').val('buyer');
    }

    $('#package_id').val(id);

    var values = id.split('_');

    jQuery('#payment_modal').modal({
        backdrop: 'static',
        keyboard: false
    });


    setTimeout(function(){
        switch(values[2]){
            case "4": document.getElementById('upgradeModalPlanName').innerHTML = 'SUPPLIER SILVER';

                break;
            case "3": document.getElementById('upgradeModalPlanName').innerHTML = 'SUPPLIER GOLD';break;
        }
        document.getElementById('upgradeModalPlanMonthlyValue').innerHTML = '$' + (values[3] / 100).toFixed(2) + '/mo';
        document.getElementById('upgradeModalPlanAnnualValue').innerHTML = '$' + (values[4] / 100).toFixed(2)+ '/mo';
        document.getElementById('upgradeModalPlanMonthlyTotalValue').innerHTML = 'TOTAL $' + (values[3] / 100).toFixed(2);
        document.getElementById('upgradeModalPlanAnnualTotalValue').innerHTML = 'TOTAL $' + ((values[4]*12) / 100).toFixed(2);
    },500);

}

// Close Checkout on page navigation:
$(window).on('popstate', function(a,b) {
    if(typeof handler != "undefined"){
        handler.close();
    }
});
</script>
<script>

    function inviteUser(){
        jQuery('#begin_tutorial').modal('hide');
        jQuery('#basic').modal('show');
    }

    $('#footer-feedback').click(function(){
        jQuery('#basic1').modal('show');
    });
    $('#invite-user-header').click(function(){
        jQuery('#basic').modal('show');
    });
    $('#upgrade-buyer-modal').click(function(){
        jQuery('#upgrade-buyer-acount-modal').modal('show');
    });
    $('#upgrade-buyer-modal-notification').click(function(){
        jQuery('#upgrade-buyer-acount-modal').modal('show');
    });
    $('#sidebar-upgrade-buyer').click(function(){
        jQuery('#upgrade-buyer-acount-modal').modal('show');
    });
    $('#upgrade-supplier-modal').click(function(){
        jQuery('#upgrade-supplier-acount-modal').modal('show');
    });
    $('#upgrade-supplier-modal-notification').click(function(){
        jQuery('#upgrade-supplier-acount-modal').modal('show');
    });
    $('#sidebar-upgrade-supplier').click(function(){
        jQuery('#upgrade-supplier-acount-modal').modal('show');
    });
    $('#show-dashboad-select').click(function(){
        jQuery('#dashboard-select-modal').modal({
            /* backdrop: 'static',
             keyboard: false*/
        });

    });
    $('#show-overview-info').click(function(){
        jQuery('#overview-select-modal').modal({
            /* backdrop: 'static',
             keyboard: false*/
        });
    });
    function getQueryStringValue (key) {
        return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
    }
</script>
@if(Auth::user()->is_using_temporary_password == 1)
<script>
    $(document).ready(function() {
        if(getQueryStringValue("popup") == 'upgrade')
        {
            $('#reset-password').modal('show');
        }
        if(getQueryStringValue("popup") == 'overview')
        {
            $('#reset-password').modal('show');
        }
    });
</script>
@endif

<script>
    $(document).ready(function() {
        if(getQueryStringValue("popup") == 'welcome')
        {
            $('#new-user-welcome-modal').modal('show');
        }
        if(getQueryStringValue("popup") == 'showCustomCongrates')
        {
            $('#showCustomCongrates-modal').modal('show');
        }
    });
</script>


<script>
    function checkPassword(){
        if(document.getElementById('password').value != document.getElementById('rpassword').value){
            alert("Whoops, password don't match");
            return false;
        }else if(document.getElementById('password').value == "" || document.getElementById('rpassword').value == ""){
            alert("Please Enter a password");
            return false;
        }
    }

    function editProfile(){
        var user_url = "{{url('user-details')}}";
        window.location.href = user_url;
    }
</script>


<script>
    function GetYahooHeaderContact()
    {
        App.blockUI({
            target: '#basic-invite',
            animate: true
        });

        jQuery.ajax({
            url: '{{url("invite/yahoo/url")}}',
            type: 'get',
            success: function(data) {
                //window.location.href = data.url;
                window.open(data.url,'_blank');
                App.unblockUI('#basic-invite');
            },
            done: function() {
                App.unblockUI('#basic-invite');
                //console.log('error');
            },
            error: function() {
                //console.log('error');
            }

        });
    }
</script>
<script>
    function printDiv(print_section) {
        var printContents = document.getElementById(print_section).innerHTML;

        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

    function ApplyJobModal(job_id)
    {
        App.blockUI({
            target: '#job_apply_main',
            animate: true
        });
        $.ajax({
            url: "{{url('ajax/job/detail')}}/"+job_id,
            type: 'get',
            success: function(data) {
                $('#apply-job-id').val(job_id);
                $('#apply-user-id').val(data.user_id);
                $('#apply-job-country').html(data.country);
                var title = '';
                if(data.company_name != ''){
                    title = data.title+' at '+data.company_name;
                }
                else
                {
                    title = data.title;
                }
                $('#apply-job-title').html(title);

                App.unblockUI('#job_apply_main');
            },
            done: function() {
                App.unblockUI('#job_apply_main');
            },
            error: function() {
                App.unblockUI('#job_apply_main');
            }

        });

    }
    $('#resume-doc').change(function(e){
        $in=$(this);
        var file_name = $in.val();
        var values = file_name.split("fakepath");
        $('#resume-file-name').html(values[1].replace(/\\/g,''));
        $('#resume-upload-name').text('Change');
    });
    $('#cover-letter-doc').change(function(e){
        $in=$(this);
        var file_name = $in.val();
        var values = file_name.split("fakepath");
        $('#cover-letter-file-name').html(values[1].replace(/\\/g,''));
        $('#cover-letter-upload-name').text('Change');
    });
</script>
<script>

$("#copyCompany").on("click", function() {
    copyToClipboardMsg($("#copyCompanyUrl"), "message");
});

$("#copy").on("click", function() {
    copyToClipboardMsg($("#copyUrl"), "msg");
});

$("#copyButton").on("click", function() {
    copyToClipboardMsg($("#copyTarget"), "msg");
});

function copyToClipboardMsg(elem, msgElem) {
    var succeed = copyToClipboard(elem);
    var msg;
    if (!succeed) {
        msg = "Copy not supported or blocked.  Press Ctrl+c to copy."
    } else {
        msg = "Link copied to the clipboard."
    }
    if (typeof msgElem === "string") {
        msgElem = document.getElementById(msgElem);
    }
    msgElem.innerHTML = msg;
    setTimeout(function() {
        msgElem.innerHTML = "";
    }, 5000);
}

function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

$(document).ready(function() {

    $('input[name="user_type"]').on('click change', function(e) {
        //console.log($('[name="user_type"]:checked').val());
        var vals = $('[name="user_type"]:checked').val();
        //console.log(vals);
        if(vals == "2_1")
        {
            window.location.href = "{{url('request-product-quotes/create')}}";
        }
        else if(vals == "2_2")
        {
            window.location.href = "{{url('request-product-quotes/create')}}";
        }
        else if(vals == "2_3")
        {
            window.location.href = "{{url('manage-my-purchasing-teams')}}";
        }
        else if(vals == "3_1")
        {
            window.location.href = "{{url('supplier-leads/create')}}";
        }
        else if(vals == "3_2")
        {
            window.location.href = "{{url('supplier-lead/upload-catalog')}}";
        }
        else if(vals == "3_3")
        {
            window.location.href = "{{url('manage-my-supplying-teams')}}";
        }
        else if(vals == "4_1")
        {
            $('#dashboard-select-modal').modal('hide');
            $('#upgrade-supplier-acount-modal').modal('show');
        }
        else if(vals == "4_2")
        {
            window.location.href = "{{url('quotetek/user/verification')}}";
        }
        else if(vals == "4_3")
        {
            window.location.href = "{{url('start-or-join-company')}}";
        }
        else if(vals == "5_1")
        {
            window.location.href = "{{url('marketplaceproduct/search')}}";
        }
        else if(vals == "5_2")
        {
            window.location.href = "{{url('jobs/search')}}";
        }
        else if(vals == "5_3")
        {
            window.location.href = "{{url('referral-link/about-the-program')}}";
        }
        else if(vals == "5_4")
        {
            window.location.href = "{{url('user-dashboard')}}";
        }
        else if(vals == "5_5")
        {
            window.location.href = "{{url('user-dashboard')}}";
        }
        else if(vals == "5_6")
        {
            window.location.href = "{{url('supportticket/faq')}}";
        }

    });

    var pulsate_val = $('#pulsate-val').val();
    if(pulsate_val == 1)
    {
        $(".pulsate-one-target").pulsate({
            color: '#1BBC9B', // set the color of the pulse
            reach: 20,                              // how far the pulse goes in px
            speed: 1000,                            // how long one pulse takes in ms
            pause: 0,                               // how long the pause between pulses is in ms
            glow: true,                             // if the glow should be shown too
            repeat: 100,                           // will repeat forever if true, if given a number will repeat for that many times
            onHover: false                          // if true only pulsate if user hovers over the element
        });
    }
    else if(pulsate_val == 2)
    {
        $(".pulsate-two-target").pulsate({
            color: '#1BBC9B', // set the color of the pulse
            reach: 20,                              // how far the pulse goes in px
            speed: 1000,                            // how long one pulse takes in ms
            pause: 0,                               // how long the pause between pulses is in ms
            glow: true,                             // if the glow should be shown too
            repeat: 100,                           // will repeat forever if true, if given a number will repeat for that many times
            onHover: false                          // if true only pulsate if user hovers over the element
        });
    }
    else if(pulsate_val == 3)
    {
        $(".pulsate-three-target").pulsate({
            color: '#1BBC9B', // set the color of the pulse
            reach: 20,                              // how far the pulse goes in px
            speed: 1000,                            // how long one pulse takes in ms
            pause: 0,                               // how long the pause between pulses is in ms
            glow: true,                             // if the glow should be shown too
            repeat: 100,                           // will repeat forever if true, if given a number will repeat for that many times
            onHover: false                          // if true only pulsate if user hovers over the element
        });
    }
    else if(pulsate_val == 4)
    {

        $(".pulsate-four-target").pulsate({
            color: '#1BBC9B', // set the color of the pulse
            reach: 20,                              // how far the pulse goes in px
            speed: 1000,                            // how long one pulse takes in ms
            pause: 0,                               // how long the pause between pulses is in ms
            glow: true,                             // if the glow should be shown too
            repeat: 100,                           // will repeat forever if true, if given a number will repeat for that many times
            onHover: false                          // if true only pulsate if user hovers over the element
        });
    }
    else if(pulsate_val == 5)
    {
        $(".pulsate-five-target").pulsate({
            color: '#1BBC9B', // set the color of the pulse
            reach: 20,                              // how far the pulse goes in px
            speed: 1000,                            // how long one pulse takes in ms
            pause: 0,                               // how long the pause between pulses is in ms
            glow: true,                             // if the glow should be shown too
            repeat: 100,                           // will repeat forever if true, if given a number will repeat for that many times
            onHover: false                          // if true only pulsate if user hovers over the element
        });
    }
    else if(pulsate_val == 6)
    {
        $(".pulsate-six-target").pulsate({
            color: '#1BBC9B', // set the color of the pulse
            reach: 20,                              // how far the pulse goes in px
            speed: 1000,                            // how long one pulse takes in ms
            pause: 0,                               // how long the pause between pulses is in ms
            glow: true,                             // if the glow should be shown too
            repeat: 100,                           // will repeat forever if true, if given a number will repeat for that many times
            onHover: false                          // if true only pulsate if user hovers over the element
        });
    }
    else if(pulsate_val == 7)
    {
        $(".pulsate-seven-target").pulsate({
            color: '#1BBC9B', // set the color of the pulse
            reach: 20,                              // how far the pulse goes in px
            speed: 1000,                            // how long one pulse takes in ms
            pause: 0,                               // how long the pause between pulses is in ms
            glow: true,                             // if the glow should be shown too
            repeat: 100,                           // will repeat forever if true, if given a number will repeat for that many times
            onHover: false                          // if true only pulsate if user hovers over the element
        });
    }
    else if(pulsate_val == 8)
    {
        $(".pulsate-eight-target").pulsate({
            color: '#1BBC9B', // set the color of the pulse
            reach: 20,                              // how far the pulse goes in px
            speed: 1000,                            // how long one pulse takes in ms
            pause: 0,                               // how long the pause between pulses is in ms
            glow: true,                             // if the glow should be shown too
            repeat: 100,                           // will repeat forever if true, if given a number will repeat for that many times
            onHover: false                          // if true only pulsate if user hovers over the element
        });
    }
    if(pulsate_val > 0)
    {
        $.getJSON("{{url('clear/pulsate/session')}}",
            function(data) {
                //doSomethingWith(data);
            });
    }

});


</script>

<script>
function clockPayment()
{
    var totalSeconds = 10;
    $('#timer-payment').html();
    $('#timer-payment').html('<a href="{{url("user/payment-history")}}" class="btn btn-circle yellow-crusta color-black " id="clock-payment" > Continue (<label id="seconds-payment">0'+totalSeconds+'</label>)</a><div ></div>');

    setInterval(setTime, 1000);
    function setTime()
    {
        --totalSeconds;
        if(totalSeconds != 0){
            $('#clock-payment > #seconds-payment').html(pad(totalSeconds%60));
        }
        else
        {
            window.location.href = "{{url('user/payment-history')}}";
        }
    }
    function pad(val)
    {
        var valString = val + "";
        if(valString.length < 2)
        {
            return "0" + valString;
        }
        else
        {
            return valString;
        }
    }
}
function clock(){

    var totalSeconds = 10;
    $('#timer').html();
    $('#timer').html('<button class="btn btn-circle yellow-crusta color-black bold" id="clock" type="button" data-dismiss="modal"> Continue (<label id="seconds">0'+totalSeconds+'</label>)</button><div ></div>');

    setInterval(setTime, 1000);
    function setTime()
    {
        --totalSeconds;
        if(totalSeconds != 0){
            $('#clock > #seconds').html(pad(totalSeconds%60));
            $('#clock > #minutes').html(pad(parseInt(totalSeconds/60)));
        }
        else
        {
            $.getJSON("{{url('clear/session/new_user_first')}}",
                function(data) {
                    //doSomethingWith(data);
                });
            $('#user-welcome-modal').modal('hide');

        }
    }
    function pad(val)
    {
        var valString = val + "";
        if(valString.length < 2)
        {
            return "0" + valString;
        }
        else
        {
            return valString;
        }
    }
}

// for tutorial
$(document).ready(function(){
    var _slides = [
        {
            content: '<b>Buyers: Get Pricing Options </b><br/><span>Get Product and Service Pricing Options using our Quote-Lead System™.<span><br/><br/><b>Suppliers: Receive New Leads</b><br/><span>Receive more Product and Service Sales Leads using our Quote-Lead System™.</span>',
            selector: '#buyer-tool-main-menu a',
            position: 'right-top',
            title: '<b>QUOTE-LEAD SYSTEM™: PURCHASE, LEASE OR SERVICE ITEMS!</b>',
            onSlide: function(){
                $("#buyer-tool-main-menu").addClass("active");
                $('#buyer-tool-menu-arrow').addClass('open');
            },
            onNext: function(){
                $("#buyer-tool-main-menu").removeClass("active");
                $('#buyer-tool-menu-arrow').removeClass('open');
                $("#team-purchasing").addClass("active");
                $('#team-purchasing-menu-arrow').addClass('open');
                $.tutorialize.next();
            }
        },
        {
            content: '<b>Team Purchasing</b><br/><span>Purchase and Shop as a Team.<span><br/><br/><b>Team Supplying</b><br/><span>Promote and Sell as a Team in your Supplier CRM.</span>',
            selector: '#team-purchasing a',
            position: 'right-top',
            title: '<b>QUOTE-LEAD TEAMS™</b>',
            onNext: function(){
                $("#buyer-tool-main-menu").removeClass("active");
                $('#buyer-tool-menu-arrow').removeClass('open');
                $("#team-purchasing").removeClass("active");
                $('#team-purchasing-menu-arrow').removeClass('open');
                $.tutorialize.next();
            },
            onPrev: function(){
                $("#team-purchasing").removeClass("active");
                $('#team-purchasing-menu-arrow').removeClass('open');
                $("#buyer-tool-main-menu").addClass("active");
                $('#buyer-tool-menu-arrow').addClass('open');
                $.tutorialize.prev();
            }
        },
        {
            content: 'Feel free to jump Back-and-Forth between buying and selling features.',
            selector: '#switch-crm-menu',
            position: 'bottom-left',
            title: 'Toggle between SUPPLIER and BUYER MODE',
            onNext: function(){
                $("#marketplace-main-menu").addClass("active");
                $('#marketplace-menu-arrow').addClass('open');
                $.tutorialize.next();
            },
            onPrev: function(){
                $("#team-purchasing").addClass("active");
                $('#team-purchasing-menu-arrow').addClass('open');
                $.tutorialize.prev();
            }
        },
        {
            content: 'Post and Search Items in a New Industrial-Only Market.',
            selector: '#marketplace-main-menu',
            position: 'right-top',
            title: 'INDY JOHN MARKET',
            onNext: function(){
                $("#marketplace-main-menu").removeClass("active");
                $('#marketplace-menu-arrow').removeClass('open');
                $("#jobs-main-menu").addClass("active");
                $('#jobs-menu-arrow').addClass('open');
                $('#jobs-search-menu').addClass('active');
                $.tutorialize.next();
            },
            onPrev: function(){
                $("#marketplace-main-menu").removeClass("active");
                $('#marketplace-menu-arrow').removeClass('open');
                $.tutorialize.prev();
            }
        },
        {
            content: 'Post and Search for Industrial Jobs on our Job Board.',
            selector: '#jobs-main-menu',
            position: 'right-bottom',
            title: 'JOB BOARD',
            onNext: function(){
                $("#jobs-main-menu").removeClass("active");
                $('#jobs-menu-arrow').removeClass('open');
                $('#jobs-search-menu').removeClass('active');
                $("#compnay-main-menu").addClass("active");
                $('#compnay-menu-arrow').addClass('open');
                $.tutorialize.next();
            },
            onPrev: function(){
                $("#marketplace-main-menu").addClass("active");
                $('#marketplace-menu-arrow').addClass('open');
                $("#jobs-main-menu").removeClass("active");
                $('#jobs-menu-arrow').removeClass('open');
                $('#jobs-search-menu').removeClass('active');
                $.tutorialize.prev();
            }
        },
        {
            content: '<b>Join a Company Page</b><br/><span>Search and join an existing company page.</span><br/><br/><b>Claim & Start a new Page</b><br/><span>Administer your company details.</span>',
            selector: '#compnay-main-menu',
            position: 'right-top',
            title: 'MY COMPANY CENTER',
            onNext: function(){
                $("#compnay-main-menu").removeClass("active");
                $('#compnay-menu-arrow').removeClass('open');
                $("#referrals-main-menu").addClass("active");
                $('#referrals-main-menu-arrow').addClass('open');
                $.tutorialize.next();
            },
            onPrev: function(){
                $("#jobs-main-menu").addClass("active");
                $('#jobs-menu-arrow').addClass('open');
                $("#jobs-search-menu").addClass("active");
                $("#compnay-main-menu").removeClass("active");
                $('#compnay-menu-arrow').removeClass('open');
                $.tutorialize.prev();
            }
        },
        {
            content: 'Start Referring and Earning now.',
            selector: '#referrals-main-menu',
            position: 'right-top',
            title: 'REFER USERS',
            onNext: function(){
                $("#referrals-main-menu").removeClass("active");
                $('#referrals-main-menu-arrow').removeClass('open');
                $.tutorialize.next();
            },
            onPrev: function(){
                $("#referrals-main-menu").removeClass("active");
                $('#referrals-main-menu-arrow').removeClass('open');
                $("#compnay-main-menu").addClass("active");
                $('#compnay-menu-arrow').addClass('open');
                $.tutorialize.prev();
            }
        },
        {
            content: 'Gain an edge by upgrading your account.',
            selector: '#upgrade-supplier-modal',
            position: 'bottom-right',
            title: 'UPGRADE YOUR ACCOUNT',
            onNext: function(){
                $("#account-main-menu").addClass("active");
                $('#account-menu-arrow').addClass('open');
                $.tutorialize.next();
            },
            onPrev: function(){
                $("#referrals-main-menu").addClass("active");
                $('#referrals-main-menu-arrow').addClass('open');
                $.tutorialize.prev();
            }
        },
        {
            content: 'Get verified and gain trust Online.',
            selector: '#quotetek-user-verification-menu',
            position: 'right-top',
            title: 'VERIFY YOUR ACCOUNT',
            onNext: function(){
                $("#account-main-menu").removeClass("active");
                $('#account-menu-arrow').removeClass('open');
                $.tutorialize.next();
            },
            onPrev: function(){
                $("#account-main-menu").removeClass("active");
                $('#account-menu-arrow').removeClass('open');
                $.tutorialize.prev();
            }

        },
        {
            content: 'Grow your network by inviting friends and associates.',
            selector: '#invite-user-header',
            position: 'bottom-right',
            title: 'INVITE USERS',
            onPrev: function(){
                $("#account-main-menu").addClass("active");
                $('#account-menu-arrow').addClass('open');
                $.tutorialize.prev();
            },
            onNext: function(){
                $("#profile-submenu-header").show();
                $.tutorialize.next();
            }
        },
        {
            content: 'Manage your profile, company and account details. ',
            selector: '#profile-submenu-header',
            position: 'left-top',
            title: 'QUICKLY MANAGE YOUR ACCOUNT',
            onNext: function(){
                $("#profile-submenu-header").hide();
                $.tutorialize.next();
            },
            onPrev: function(){
                $("#profile-submenu-header").hide();
                $.tutorialize.prev();
            }
        },
        {
            content: 'Streamline your Indy John workflow.',
            selector: '#header-quick-start',
            position: 'bottom-left',
            title: 'QUICK START',
            onPrev: function(){
                $("#profile-submenu-header").show();
                $.tutorialize.prev();
            }
        }
    ];



    //$.tutorialize.start();
    if(getQueryStringValue("setup") == 'tutorial')
    {
        $.tutorialize({
            slides: _slides,
            arrowPath: "{{url('tutorialize/arrows/arrow-red.png')}}",
            bgColor: '#ea6f5d',
            buttonBgColor: '#ea6f5d',
            buttonFontColor: '#fff',
            fontColor: '#666',
            padding:'0px',
            overlayMode: 'focus',
            showClose: true,
            theme: 'lined',
            width: 350,
            onStop: function(){
                jQuery('#dashboard-select-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        });
        $.tutorialize.start();
    }

    if(getQueryStringValue("setup") == 'company_admin')
    {
        $.tutorialize({
            slides: _slides,
            arrowPath: "{{url('tutorialize/arrows/arrow-red.png')}}",
            bgColor: '#ea6f5d',
            buttonBgColor: '#ea6f5d',
            buttonFontColor: '#fff',
            fontColor: '#666',
            padding:'0px',
            overlayMode: 'focus',
            showClose: true,
            theme: 'lined',
            width: 350,
            onStop: function(){
                jQuery('#dashboard-select-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        });
        $.tutorialize.start();
    }

    //setTimeout(function(){ $.tutorialize.start(); }, 2000);
});


if ($(window).width() <= 894){
    $(".responsive-toggler").click(function() {
        // assumes element with id='button'
        $(".buttons-toggle").toggle();
        $(".page-top").toggle();
    });
}
</script>
@if(Auth::user()->is_using_temporary_password != 1)
<script>
    $(document).ready(function() {

        if(getQueryStringValue("popup") == 'overview')
        {
            $('#dashboard-select-modal').modal('show');
        }
        if(getQueryStringValue("popup") == 'upgrade')
        {
            $('#upgrade-supplier-acount-modal').modal('show');
        }
        if(getQueryStringValue("profile") == 'completed')
        {
            $('#begin_tutorial').modal('show');
        }
    });
</script>
@endif
<script>

    if(getQueryStringValue("popup") == 'completeCompanyProfile')
    {
        $('#completeCompanyProfile').modal('show');
    }

    function saveReport(){
        var reason =  document.getElementById('reason').value;
        var comment =  document.getElementById('comment').value;
        //var reportType = id;
        var baseurl = "{{url('report/save')}}";

        $.ajax({
            type : 'POST',
            url : baseurl,
            data:{
                '_token':'{{csrf_token()}}',
                reason : reason,
                comment : comment
                //reportType : reportType
            },
            success:function(data) {
                $('#report_page').modal('hide');
            },
            done: function() {
            },
            error: function() {
            }
        });
    }

    function sendMessage(){
        var subject =  document.getElementById('subject').value;
        var body =  document.getElementById('message_body').value;
        var receiver =  document.getElementById('message_receiver').value;
        var baseurl = "{{url('message/send')}}";

        $.ajax({
            type : 'POST',
            url : baseurl,
            data:{
                '_token':'{{csrf_token()}}',
                subject : subject,
                body : body,
                receiver_id : receiver
                //reportType : reportType
            },
            success:function(data) {
                $('#contact_seller').modal('hide');
            },
            done: function() {
            },
            error: function() {
            }
        });
    }

    function goToDashboard(anchor){
        window.location.href = anchor.href;
    }

    function setProductId(id){
        $('#product_id').val(id);
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('marketPlaceRequestQuoteAddressAutoComplete')),
            {types: ['geocode']});
        //console.log("aaa");
        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress_m);
    }

    var placeSearch, autocomplete;
    var componentForm = {
        route: 'long_name',
        //premise: 'short_name',
        street_number: 'short_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    $('#autocomplete').keypress(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });

    function fillInAddress_m() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        //var premiseOrStreetNo = place.address_components[0].types[0];
        //user.setId;
        //$('textarea[name=address]').setAttribute("id","premise");

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        var addressLine1 = '';
        var addressLine2 = '';
        var formattedAddressLine = false;

        for (var i = 0; i < place.address_components.length; i++) {

            var addressType = place.address_components[i].types[0];

            if(addressType == 'street_number' || addressType == 'premise'){
                addressLine1 = addressLine1 + place.address_components[i]['long_name'];
            }
            if(addressType == 'route'){
                addressLine1 = addressLine1+','+ place.address_components[i]['long_name'];
                formattedAddressLine = true;
            }

            if(addressType == 'sublocality_level_2'){
                addressLine2 = place.address_components[i]['long_name'];
            }

            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }

        if(formattedAddressLine == true){
            document.getElementById('street_number').value = addressLine1;
            document.getElementById('route').value = addressLine2;
        }

        $('#multi-items').show();
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate_m() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }else{
            console.log('not defined.');
        }
    }

</script>

<!-- END FOOTER -->



