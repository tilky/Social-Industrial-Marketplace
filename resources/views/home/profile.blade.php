@extends('home.app')
@section('content')
@include('home.header')
<!-- ===================  How-it-works page  =================== -->
    <section class="How-it-works ">
        <ul class="list-inline text-center affix-top" data-spy="affix" data-offset-top="80">
            <li><a href="#section-1">PROJECTS</a></li>
            <li><a href="#section-2">HIRING</a></li>
            <li><a href="#section-3">PAYMENTS</a></li>
            <li><a href="#section-4">PROTECTION</a></li>
            <li><a href="#section-5">FAQ</a></li>
            <li class="btn"><a href="#section-6">Get started</a></li>
        </ul>
        <div class="container">
            <div class="row" id="section-1">
                <div class="col-md-6">
                    <h2 class="section-title"><b>What kind of work can I get done?</b></h2>
                    <div class="section-desc">
                        <p>
                            Anything that can be done on a computer � from web and mobile programming to graphic design � can be done on Upwork. Freelance experts can tackle a range of projects:
                        </p>
                        <ul>
                            <li>Big or small</li>
                            <li>Short or ongoing</li>
                            <li>Individual or team-based</li>
                        </ul>
                        <p>
                            Whether you need a writer to knock out a 500-word blog post or a full-fledged software development team to support your business, our tools and the expert freelancers in our marketplace can accommodate.
                        </p>
                    </div>
                </div>
                <div class="col-md-6"><img src="{{URL::asset('frontend/images/consultant.jpg')}}" class="center-block"></div>
            </div>
            <div class="row" id="section-2">
                <div class="col-md-6"><img src="{{URL::asset('frontend/images/consultant.jpg')}}" class="center-block"></div>
                <div class="col-md-6">
                    <h2 class="section-title"><b>How do I hire the right freelancer?</b></h2>
                    <div class="section-desc">
                        <p>
                            Start by writing a clear and concise job post. Each freelancer submits a cover letter and link to their Upwork profile covering:
                        </p>
                        <ul>
                            <li>Skills, experience and portfolios</li>
                            <li>Client feedback</li>
                            <li>Language and communication skills</li>
                        </ul>
                        <p>
                            You'll get applications from independent professionals and receive our personalized recommendations within minutes. From there, just interview your strongest candidates and hire your favorite.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row" id="section-3">
                <div class="col-md-6">
                    <h2 class="section-title"><b>How do payments work?</b></h2>
                    <div class="section-desc">
                        <p>
                            Pay your freelancer per hour or per project, whichever you choose. For hourly projects, the freelancer bills you once a week, and we'll send a secure payment to your freelancer. For fixed-price projects, we'll release funds to your freelancer after they meet pre-set milestones. In either case, you're covered by Upwork Payment Protection, assuring that you only pay for work you approve.
                        </p>
                        <p>All payments go through our secure system. Choose from the following billing methods:

                        </p>
                        <ul>
                            <li>Credit card</li>
                            <li>PayPal</li>
                            <li>Bank account</li>
                        </ul>
                        <p>
                            When we send your payments to the freelancer, we deduct a 10% fee from the rate they charge you. For example, if you pay your freelancer $20, they earn $18 and we receive $2.

                        </p>
                    </div>
                </div>
                <div class="col-md-6"><img src="{{URL::asset('frontend/images/consultant.jpg')}}" class="center-block"></div>

            </div>
            <div class="row" id="section-4">
                <div class="col-md-6"><img src="{{URL::asset('frontend/images/consultant.jpg')}}" class="center-block"></div>
                <div class="col-md-6">
                    <h2 class="section-title"><b>How do I know I'm protected?</b></h2>
                    <div class="section-desc">
                        <p>
                            Enjoy peace of mind with systems designed to provide a safe and trusted workplace, including:
                        </p>
                        <p>
                            <b>Work Diary</b> This tool captures snapshots of your freelancer's screen every 10 minutes, helping to verify that on hourly jobs, work has been completed as invoiced.

                        </p>
                        <p>
                            <b>Payment Protection.</b> Upwork Payment Protection assures you that you pay only for work you've approved.

                        </p>
                        <p>
                            <b>Dispute Resolution</b> If an issue ever should arise, we have programs to help fix the situation.
                        </p>

                    </div>
                </div>

            </div>
            <div class="row " id="section-5">
                <h1 class="text-center"><b>Top 5 Questions We Hear Customers Ask</b></h1>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title text-uppercase">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <b>WHAT PROJECTS CAN I DO ON UPWORK?       </b> <i class="fa fa-angle-up  pull-right"></i> </a>
      </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <p>
                                    <b>What kind of work can I get done?</b> Anything you can do on a computer can be done through Upwork. Freelancers in our marketplace can tackle a wide range of projects � big or small, one-off or repeat, individual or team-based. Whether you need a content writer for an SEO-friendly blog post, or your own 24/7 software development team to build a mobile app or create a web portal, you�ll find talent on Upwork ready to support your business.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title text-uppercase">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <b>HOW DO I FIND THE RIGHT FREELANCER?      </b> <i class="fa fa-angle-up  pull-right"></i>
        </a>
      </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <p>
                                    <b>How do I know my freelancer is going to get the job done?</b>It�s easy. First think about the skills you need, then describe your job and post it. Next wait for freelancers to submit their best proposals for your review. You can also invite freelancers to submit proposals from potential matches we highlight, or search our entire freelance community for that perfect fit.
                                </p>
                                <p><b>Does Upwork screen freelancers?</b>At Upwork we strive to provide a fair and trusted marketplace. This includes working diligently to verify that freelancers are representing themselves correctly. We begin by authenticating the email address of registered users. We then provide many forms of screening for clients to use, from online tests (where freelancers can demonstrate their expertise) to our Job Success score. Ultimately however, it is your responsibility to do the final screening to help ensure that the freelancer is a great match for you and your project. We do have features in place to help facilitate the screening process, from Upwork Messages for real-time communication with freelancers to custom screening questions to assist you in identifying the best matches.</p>
                                <p>
                                    <b>What is the Top Rated Program?</b>Our Top Rated Program is designed to showcase talent who consistently deliver at the top level of their field. Freelancers who achieve this level display a Top Rated badge on their Upwork profile, representing great work, excellent relationships with clients, and other critical factors in creating successful projects.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title text-uppercase">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <b>AM I SAFE WORKING HERE?</b> <i class="fa fa-angle-up  pull-right"></i>
        
        </a>
      </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                <p>
                                    <b>How do I know my freelancer is actually working on my project?</b>Upwork has several processes in place to enable you to confirm work completed on your projects. On hourly contracts, this includes the Work Diary. It�s a visual billable time system that records work completed. It also takes screenshots of the freelancer�s screen six times per hour to verify work, as well as counting keystrokes during sessions. We also include Upwork Messages which allows for simple, real-time communication with your freelancer.
                                </p>
                                <p>
                                    <b> What if I�m not happy with the results?</b> Most projects on Upwork get completed on-time and as expected. If there�s a disagreement between you and your freelancer, we�ll provide free dispute assistance and, if needed, connect you with arbitration.
                                </p>
                                <p>
                                    <b>How can I ensure that my IP is safe?</b> The Service Contract terms in our User Agreement set forth confidentiality obligations and your right to ownership of intellectual property. You can also add additional terms to your job, and you can have your freelancer sign an additional Non-Disclosure Agreement if needed.
                                </p>
                                <p>
                                    <b>Who owns the legal rights to work product developed by a freelancer engaged on Upwork? </b> Once a freelancer receives payment for work completed on a project, our Terms of Service specify that ownership of that work transfers to the client. If desired, freelancers and clients may also agree on different or additional terms regarding work product ownership. For details, see Section 8.6 of our <a href="#">User Agreement</a>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title text-uppercase">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <b>HOW DO PAYMENTS WORK?</b> <i class="fa fa-angle-up  pull-right"></i>
        
        </a>
      </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseFour">
                            <div class="panel-body">
                                <p>
                                    <b> How does Upwork make money?</b> Upwork charges your freelancer a 10% service fee on payments. For example, if you and your freelancer agree to a $1,000 price for a job, when you send $1,000 through our payment system, we deduct $100 (10%) and release the remaining $900 to your freelancer. We also make money by offering optional premium memberships and subscription services.
                                </p>
                                <p>
                                    <b>
                                    How often will I be charged? How are payments and invoices handled? When/where do I provide my CC info? </b>You have two options for working with your freelancer: hourly or fixed-price. With hourly projects, you must have a payment method on file before your freelancer begins work. Using our automated billing system, your freelancer will bill you each week. Once you review and approve each weekly invoice (you have one week to do so), Upwork charges your payment method and releases funds to your freelancer through our escrow service. Or, with fixed-price projects, you have the option of dividing a large project into agreed-upon milestones. Before each milestone begins, you must fund escrow for that portion of the project with a payment method on file. Once a milestone is completed by the freelancer, and you review and approve the work, your funds are released to your freelancer from escrow. For additional information, see our<a href="#">Terms of Service</a>, including the hourly escrow instructions and the fixed-price escrow instructions.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row center-block text-center text-uppercase" id="section-6">
                <button class="btn">get started</button>
            </div>

        </div>

    </section>
    <!-- ====================================== -->

    <div class="color_bg margintop80 feedback">
        <div class="container">
            <div class="col-md-10">
                <i class="pull-left testimonial_ico"><img src="{{URL::asset('frontend/images/testimonial.png')}}" alt=""/></i>
                <div class="col-md-9">
                    <h3 class="header_24">Client feedback</h3>
                    <p>Please leave some comments about your experience on QuoteTek.com</p>
                </div>
            </div>

            <div class="col-md-2"><a href="" class="btn btn-circle btn_wh">Feedback</a></div>

        </div>

    </div>
<div class="clearfix"></div>
@include('home.footerlinks')
@endsection
