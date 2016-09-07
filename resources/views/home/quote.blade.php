@extends('home.header')

@section('content')

<link href="{{URL::asset('css/style_custom.css')}}" rel="stylesheet">
<!-- Custome Style -->
    
<div class="section fade">
<!-- BEGIN FORM-->
    {!! Form::open([
    'route' => 'request-quote.store',
    'class' => 'horizontal-form',
    'files' => true
    ]) !!}
    <input type="hidden" name="firstname" value="{{$request_quote['firstname']}}" />
    <input type="hidden" name="lastname" value="{{$request_quote['lastname']}}" />
    <input type="hidden" name="email" value="{{$request_quote['email']}}" />
    <input type="hidden" name="industries[]" value="{{$request_quote['industry']}}" />
    <input type="hidden" name="products[]" value="{{$request_quote['product']}}" />
    <input type="hidden" name="categories[]" value="{{$request_quote['category']}}" />
    <input type="hidden" name="status" value="1" />      
    <div class="container">

        <ul class="top_c">
         <li class="active_old"><a href="{{url('request-quote')}}"><i class="fa fa-check"></i></a></li>
         <li class="active"><a href="#">2</a></li>
         <li><a href="#">3</a></li>
        </ul>
        <div class="text-center"> 
            <h3 class="header_middle">You Are Just Two Steps Away</h3>
        </div>
        <div class="sect_rq2">
            <div class="row"> 
                <div class="col-sm-4">
                    <p>Name </p> 
                </div>
                <div class="col-sm-4  text-center hidemidlle">
                    <p>:</p> 
                </div>
                <div class="col-sm-4">
                    <p><b>{{$request_quote['firstname']}} {{$request_quote['lastname']}}</b> </p> 
                </div>
            </div><!-- row -->
            <div class="row"> 
                <div class="col-sm-4">
                    <p>E-mail id  </p> 
                </div>
                <div class="col-sm-4  text-center hidemidlle">
                    <p>:</p> 
                </div>
                <div class="col-sm-4">
                    <p><b>{{$request_quote['email']}}</b> </p> 
                </div>
            </div><!-- row -->
            <div class="row">  
                <div class="col-sm-4">
                    <p>Selected Industry </p> 
                </div>
                <div class="col-sm-4  text-center hidemidlle">
                    <p>:</p> 
                </div>
                <div class="col-sm-4">
                    <p><b>{{$request_quote['industry_name']}}</b> </p> 
                </div>
            </div><!-- row -->
            <div class="row">    
                <div class="col-sm-4">
                    <p>Selected Product</p> 
                </div>
                <div class="col-sm-4  text-center hidemidlle">
                    <p>:</p> 
                </div>
                <div class="col-sm-4">
                    <p><b>{{$request_quote['product_name']}}</b> </p> 
                </div>
            </div><!-- row -->
            <div class="row">    
                <div class="col-sm-4">
                    <p>Selected Category</p> 
                </div>
                <div class="col-sm-4  text-center hidemidlle">
                    <p>:</p> 
                </div>
                <div class="col-sm-4">
                    <p><b>{{$request_quote['category_name']}}</b> </p> 
                </div>
            </div><!-- row -->  
        </div><!-- sect_rq2 -->
        <div class="h100"></div>
        <div class="text-center"> 
            <h3 class="header_middle">Quote Type</h3>
        </div>

        <div class="select_box"> 
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="chck_b  ">
                        <input type="checkbox" name="" id="ch1">
                        <label for="ch1">Select All</label>
                    </div>
                </div><!-- col -->
                <div class="h50"></div>
                <div class="col-sm-12 text-center">
                    <div class="chck_b fbig">
                        <input type="checkbox" name="" id="ch2">
                        <label for="ch2">Purchase Order</label>
                    </div>
                </div><!-- col -->
                <div class="h50"></div>
                
                @foreach($purchaseOrderTypes as $index => $purchase)
                    <div class="col-sm-3 text-center">
                    <div class="chb_icon">
                        <label for="ch{{$index+3}}"><img src="{{URL::asset('images')}}/icon{{$index+1}}.png" alt=""></label>
                        <div class="chck_b ">
                            <input type="checkbox" name="purchase[]" value="{{$purchase->id}}" id="ch{{$index+3}}">
                            <label for="ch{{$index+3}}"> &nbsp;</label>
                        </div>
                    </div>
                    <div class="txt_chb">
                        <label for="ch3">{{$purchase->name}}</label>
                    </div>
                </div><!-- col -->
                @endforeach
                
                <div class="h50"></div>
                <div class="col-sm-12 text-center">
                    <div class="chck_b fbig">
                        <input type="checkbox" name="" id="c2">
                      <label for="c2">Services Order</label>
                    </div>
                </div><!-- col -->
                <div class="h50"></div>
                @foreach($serviceOrderTypes as $sindex=>$seyvice)
                <div class="col-sm-3 text-center">
                    <div class="chb_icon">
                        <label for="cbh{{$sindex+3}}">
                        <img src="{{URL::asset('images')}}/icon{{$sindex+5}}.png" alt="">
                        </label>
                        <div class="chck_b ">
                            <input type="checkbox" name="service[]" value="{{$seyvice->id}}" id="cbh{{$sindex+3}}">
                            <label for="cbh{{$sindex+3}}"> &nbsp;</label>
                        </div>
                    </div>
                    <div class="txt_chb">
                        <label for="cbh3">{{$seyvice->name}}</label>
                    </div>
                </div><!-- col -->
                @endforeach
                <div class="h50"></div>
                <div class="col-sm-12 text-center">
                    <div class="chck_b fbig">
                        <input type="checkbox" name="" id="cs2">
                        <label for="cs2">Rent/ Lease Order</label>
                    </div>
                </div><!-- col -->
                <div class="h50"></div>
                <div class="col-sm-3 text-center">
                </div><!-- col -->
                @foreach($rentleaseOrderTypes as $rindex=>$rentlease)
                <div class="col-sm-3 text-center">
                    <div class="chb_icon">
                        <label for="cch{{$rindex+4}}">
                            <img src="{{URL::asset('images')}}/icon{{$rindex+9}}.png" alt="">
                        </label>
                        <div class="chck_b ">
                            <input type="checkbox" name="rentlease[]" value="{{$rentlease->id}}" id="cch{{$rindex+4}}">
                            <label for="cch{{$rindex+4}}"> &nbsp;</label>
                        </div>
                    </div>
                    <div class="txt_chb">
                        <label for="cch4">{{$rentlease->name}}</label>
                    </div>
                </div><!-- col -->
                @endforeach
                <div class="col-sm-3 text-center">
                </div><!-- row -->  
                <div class="h50"></div>
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="rq2_h4">Title & Specification</h4> 
                        <input type="text" name="title" placeholder="Summary Title">
                        <textarea name="specifications" id="" placeholder="Specification"></textarea>
                    </div>
                </div><!-- row -->
        
            </div><!-- select_bx -->
        </div>
        <div class="clearfix"></div>
        <div class="h100"></div>
        <div class="clearfix"></div>
        <div class="hr_cstm"><img src="{{URL::asset('images/arrs.png')}}" alt=""></div>
        <div class="clearfix"></div>
        <div class="h100"></div>
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 cstm_frm">
                <h4 class="rq2_h4">Date & Supplier Settings</h4>
                
                <input type="text" placeholder="Set An Expiration Date" name="expiry_date" id="datepicker">
                
                <div class="row">
                  <div class="col-sm-5">
                      <p>Verified Suppliers Only</p>
                  </div><!-- col -->
                  
                  <div class="col-sm-7">
                    
                    <div class="csmt_ckc">
                              <input type="radio" name="verified_only" value="1" id="cscks" checked="">
                      <label for="cscks">Yes</label>
                    </div>
                
                     <div class="csmt_ckc">
                        <input type="radio" name="verified_only" value="0" id="csck2">
                        <label for="csck2">No</label>
                     </div>
                  </div><!-- col -->
                
                </div><!-- row -->
                
                <select name="accreditations" id="">
                    <option value="">Accrededation</option>
                    @foreach($Accreditations as $Accreditation)
                    <option value="{{$Accreditation->id}}">{{$Accreditation->name}}</option>
                    @endforeach
                </select>
                
                
                <select name="diversity_options" id="">
                    <option value="">Diversity Requirement</option>
                    @foreach($Diversityoptions as $Diversity)
                    <option value="{{$Diversity->id}}">{{$Diversity->name}}</option>
                    @endforeach
                </select> 
                </div><!-- col -->
            
                <div class="col-sm-6 cstm_frm">
                    <h4 class="rq2_h4">Regional Settings</h4>
                    <select name="request_area" placeholder="Request Area">
                        <option value="">Select Accreditation</option>
                        <option value="1">Local</option>
                        <option value="2">50 miles</option>
                        <option value="3">Country</option>
                        <option value="4">All area</option>
                    </select>
                    <h4 class="rq2_h4">Privacy Setting</h4>
                    <select name="privacy"  placeholder="Privacy Setting">
                        <option value="">Select Privacy</option>
                        <option value="1">All Visitors on the Web</option>
                        <option value="2">All Free and Premium Suppliers</option>
                        <option value="3">Premium Suppliers Only</option>
                    </select>
                </div><!-- col --> 
            </div><!-- container -->   
        
        </div><!-- row -->



    <div class="clearfix"></div>
    <div class="h50"></div>
    <div class="clearfix"></div>
    <div class="text-center">
      <button type="submit" class="btn btn-circle frm_btn">CONTINUE TO LAST STEP</button>
    </div>
 
   {!! Form::close() !!}
   <!-- END FORM-->
</div>
<div class="h50"></div>
<div class="clearfix"></div>
<script>
$(document).ready(function() {
	$(function() {
    $( "#datepicker" ).datepicker({
        "dateFormat": 'yy-mm-dd',
        "showAnim": "slideDown",
        "minDate": +1,
    });
  });

});
$('.on_off_btn btn-circle li').click(function(){
    $(this).parent('ul').find('li').removeClass('active') 
    $(this).addClass('active')
  });
  
  $("#ch1").change(function(){
      $(".select_box input:checkbox").prop('checked', $(this).prop("checked")); 
  });
</script>
@include('home.footerlinks')
@endsection
