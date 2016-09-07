@extends('home.app')
@section('content')
@include('home.header') 

<!--======================= layout ========================-->

<div class="small-layout animatedParent" style="background-image: url('{{URL::asset('livesite/images/banners/10.jpg')}}') ;">
  <div class="mask"></div>
  <h1 class="header_middle text-center animated bounceInDown slower go">Contact Us</h1>
</div>

<!--=======================================================--> 

<!--======================= Navbar ========================-->
<div class="simple-navbar text-center relative">
  <ul class="list-inline">
    <li><a href="{{url('about-us')}}">About Us</a></li>
    <li><a href="{{url('faq')}}">FAQ</a></li>
    <li><a href="{{url('news')}}">Indy John News</a></li>
    <li><a href="{{url('investor-outreach')}}">Investor Outreach</a></li>
    <li class="active"><a href="{{url('contact-us')}}">Contact Us</a></li>
  </ul>
  <div class="vertical_lines"></div>
</div>

<!-- contactUs section -->
<section class="contactUs">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
      <div class="row">
      
        <p>Thank you for using Indy John.</p>
        <p>Please complete the following form to contact us:</p>
        </div>
      </div>
      <div class="col-sm-12 margin-bottom-30 margin-top-30">
      <div class="row">
      <div class="col-md-7 col-sm-12 contactus-form">
      <div class="row">
        <div class="form"> 
          <!--  form-body  --> 
          @if (Session::has('message'))
          <div id="" class="custom-alerts alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            {{ Session::get('message') }}</div>
          @endif
          @if(count($errors) > 0)
          <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach </div>
          @endif
          <form action="{{url('contact-send')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Name <span>*</span></label>
                  <input type="text" class="form-control" name="name" id="persone-name" required>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label> Company Name <span>*</span></label>
                  <input type="text" class="form-control" name="name" id="company-name" required>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label> E-mail Address <span>*</span></label>
                  <input type="email" class="form-control" name="email" id="person-email" required>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label> Phone Number </label>
                  <input type="text" class="form-control" name="phone" id="persone-phoneNumber">
                </div>
              </div>
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> Department <span>*</span></label>
                  <select class="form-control" name="department">
                    <option value="Support">Support Team</option>
                    <option value="Investor-Relations">Investor Relations</option>
                    <option value="Advertise+Partner">Advertise & Partners</option>
                    <option value="Press">Press</option>
                     <option value="Feature Request">Feature Request</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label> Brief Message or Concern<span>*</span></label>
                  <textarea class="form-control" name="message" required rows="3"></textarea>
                </div>
              </div>
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <button class="btn pull-right" type="submit">Submit</button>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </form>
          <!--  /form-body  --> 
          
        </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="col-md-4 col-sm-12 pull-right contact_query">
      <div class="row">
        <h4>Have a Question? Contact Support</h4>
        <a href="#">support@indyjohn.com</a>

     <h4 class="margin-top-30">Partnership Opportunities?</h4>
        <a href="#">partner@indyjohn.com</a>

        <h4 class="margin-top-30">Interested in advertising opportunity?</h4>
        <a href="#">advertise@indyjohn.com</a>
   
      
        <h4 class="margin-top-30">Write to us</h4>
        <p>P.O. Box 86023
        <br>Los Angeles, CA 90086-0023</p>
      </div>
      </div>
      </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</section>
<!-- /contactUs section --> 

@include('home.footerlinks')
@endsection 
