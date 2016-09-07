@extends('home.app')

@section('content')

@include('home.header')
<div class="small-layout animatedParent margintop40" style="background-image: url('{{URL::asset('livesite/images/banners/4.jpg')}}') ;">
  <div class="mask"></div>
  <h1 class="header_middle text-center animated bounceInDown slower">Indy John Overview</h1>
</div>
<div class=" padding75">
  <div align="center">Thank you for your interest in learning more about Indy John. <br />
    We're a new company with a highly Technical User-Platform. <b>This diagram will help you understand what Indy John has to offer.</b>
    </p>
  </div>
  <div class="modal-body">
    <div  id="overview-select-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="row">
            <div class="col-md-12"> 
              
              <!--   <div class="align-center"><img src="{{URL::asset('images/indy_john_crm_logo.png')}}" /> -->
              
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
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
    <div class="signup-btn paddingtop20" align="center" ><a class="btn" href="{{url('/')}}" >Sign Up For Free</a>
      </li>
    </div>
    
    <!-- /.modal-dialog -->
    
    <div class="clearfix"></div>
  </div>
</div>
@include('home.footerlinks')

@endsection 
