@extends('home.app')
@section('content')
@include('home.header')
<style>
input, select, textarea {
    width: 100%;
    border: 1px solid #bababa;
    border-radius: 30px;
    padding: 10px;
    padding-left: 20px;
    outline: 0;
    margin-bottom: 30px;
}
</style>

<div class="slider inner_slide animatedParent" style="background-image: url({{URL::asset('images/banner_2.jpg')}})">
            <div class="slider_overlay">

                <div class="container">
                    <h1 class="banner_header  animated bounceInDown slower">Welcome TO <span>marketplace</span></h1>
                    <h3 class="h3_head animated bounceInUp slower nomargin_top">Prortal For New And Used Industrial Products.</h3>

                    <div class="formsearch"> 
                        <input type="text"  id="tags" placeholder="Start By Searching The Product Or Category that You're Looking For."/>
                        <button type="submit" class="submit_search hvr-bounce-to-right"><i class="glyphicon glyphicon-search"></i></button>
                            <div class="showresults"></div>
                    </div>

                    <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit Neque porro quisquam est
                        qui dolorem ipsum quia dolor  qui dolorem ipsum quia dolor </p>
                    
 

                    <div class="btn btn-circle bigbtn btn-circle animated fadeIn slower"><a href="">
                            <span class="font18">Looking to Sell Equipment ? </span>
                            <span class="font28">   Post  here For Free </span>
                        </a></div>


                        <div class="text-center"><div class="scrollar_btn"><span class="circle"><span class="dot"></span></span><p>Browse</p></div></div>
                </div>

            </div>
        </div>



        <div class="section fade">
            <div class="container  text-center">
                <h3 class="header_middle">View Listings Via Industries</h3>



                <div class="product_section">
                    <h3>ELECTRONICS </h3>

                    <div class="owl-carousel product_demo">
                        @foreach($products as $product)
                        <div class="item"> 
                            <div class="pro_img"><img src="{{url('marketplace/product/images')}}/{{$product->image}}"/></div>
                            <div class="pro_title">{{$product->name}}</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>
                        </div>
                        @endforeach
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_one.jpg')}}"/></div>
                            <div class="pro_title">Sony Smart Watch</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>
                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_2.jpg')}}"/></div>
                            <div class="pro_title">All In One PC</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_3.png')}}"/></div>
                            <div class="pro_title">Beats HeadPhone</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_4.png')}}"/></div>
                            <div class="pro_title">i Watch</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_one.jpg')}}"/></div>
                            <div class="pro_title">Sony Smart Watch</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                    </div> 

                </div>
                
                
                
                
                
                <div class="product_section fade">
                    <h3>FASHION </h3>

                    <div class="owl-carousel product_demo">
                        @foreach($products as $product)
                        <div class="item"> 
                            <div class="pro_img"><img src="{{url('marketplace/product/images')}}/{{$product->image}}"/></div>
                            <div class="pro_title">{{$product->name}}</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>
                        </div>
                        @endforeach
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_1.jpg')}}"/></div>
                            <div class="pro_title">Men's Shirt</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>
                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_2.jpg')}}"/></div>
                            <div class="pro_title">Men's Jeans</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_3.jpg')}}"/></div>
                            <div class="pro_title">Womem's Dress</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_4.jpg')}}"/></div>
                            <div class="pro_title">Mens T-Shirt</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_5.jpg')}}"/></div>
                            <div class="pro_title">Mens T-Shirt</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div> 
                        
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_6.jpg')}}"/></div>
                            <div class="pro_title">Mens T-Shirt</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div> 
                        
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_7.jpg')}}"/></div>
                            <div class="pro_title">Mens T-Shirt</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div> 
                    </div>  
                </div>
                
                <div class="product_section fade">
                    <h3>Awesome Footwear </h3>

                    <div class="owl-carousel product_demo">
                        @foreach($products as $product)
                        <div class="item"> 
                            <div class="pro_img"><img src="{{url('marketplace/product/images')}}/{{$product->image}}"/></div>
                            <div class="pro_title">{{$product->name}}</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>
                        </div>
                        @endforeach
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_1.jpg')}}"/></div>
                            <div class="pro_title">Vans Shoesh</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>
                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_2.jpg')}}"/></div>
                            <div class="pro_title">Men's Jeans</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_3.jpg')}}"/></div>
                            <div class="pro_title">Kids Shoes</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_4.jpg')}}"/></div>
                            <div class="pro_title">Nike Shoes</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_5.jpg')}}"/></div>
                            <div class="pro_title">Vans Shoesh</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div> 
                        
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_6.jpg')}}"/></div>
                            <div class="pro_title">Vans Shoesh</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div> 
                        
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_7.jpg')}}"/></div>
                            <div class="pro_title">Vans Shoesh</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div> 
                    </div>  
                </div>

                
                 <div class="product_section fade">
                     <h3 class="header_middle">Most Active Categories </h3>

                    <div class="owl-carousel product_demo">
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_6.jpg')}}"/></div>
                            <div class="pro_title">Sport Shoesh</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>
                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_3.jpg')}}"/></div>
                            <div class="pro_title">Women Clothing</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_7.jpg')}}"/></div>
                            <div class="pro_title">Cosemetices</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_3.png')}}"/></div>
                            <div class="pro_title">Headphones</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                       <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_7.jpg')}}"/></div>
                            <div class="pro_title">Cosemetices</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>
                    </div>  
                </div>
                
                <div class="product_section fade">
                     <h3 class="header_middle">Recently Listed Products</h3>

                    <div class="owl-carousel product_demo">
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_7.jpg')}}"/></div>
                            <div class="pro_title">Sport Shoesh</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>
                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_3.jpg')}}"/></div>
                            <div class="pro_title">Women Clothing</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_7.jpg')}}"/></div>
                            <div class="pro_title">Cosemetices</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_3.png')}}"/></div>
                            <div class="pro_title">Headphones</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                       <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_7.jpg')}}"/></div>
                            <div class="pro_title">Cosemetices</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>
                    </div>  
                </div>
                
                
                <div class="product_section fade">
                     <h3 class="header_middle">Showcased Suppliers</h3>

                    <div class="owl-carousel product_demo">
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_5.jpg')}}"/></div>
                            <div class="pro_title">Company Name</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>
                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_6.jpg')}}"/></div>
                            <div class="pro_title">Company Name</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_5.jpg')}}"/></div>
                            <div class="pro_title">Company Name</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_foot_6.jpg')}}"/></div>
                            <div class="pro_title">Company Name</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>

                       <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/pro_fsn_7.jpg')}}"/></div>
                            <div class="pro_title">Company Name</div>
                            <div class="pro_btn"><a href="" class="btn">view more</a></div>

                        </div>
                    </div>  
                </div>


            </div>
        </div>
<div class="clearfix"></div>
<script>
          
  $(function() {
    var availableTags = [
      "Australia",
      "Brazil",
      "Canada",
      "Denmark",
      "Egypt",
      "France",
      "Germany",
      "Hong Kong",
      "India",
      "Japan",
      "Kuwait",
      "Libya",
      "Malaysia",
      "Nepal",
      "Oman",
      "Philippines",
      "Qatar",
      "Russia",
      "Singapore",
      "Thailand",
      "United Kingdom",
      "Zambia"
    ];
    
 var NoResultsLabel = "No Results";

    $( "#tags" ).autocomplete({
        
         appendTo: ".showresults",
   source: function(request, response) {  
    var results = $.ui.autocomplete.filter(availableTags, request.term); 
            if (!results.length) {
                results = [NoResultsLabel];  
        }  
    
     response(results)
            
 
            
            
        } 
     

    });
 
            
// var results = $.ui.autocomplete.filter(availableTags, request.term);
//
//            if (!results.length) {
//                results = [NoResultsLabel]; 
//                  return results; 
//            } 
//     response(matches ,  results )

//            var matches = $.map( availableTags, function(acItem) {
//      if ( acItem.toUpperCase().indexOf(request.term.toUpperCase()) === 0 ) {
//        return acItem; 
//      } 
//    });
// 
    
    
  });
  </script>
@include('home.footerlinks')
@endsection
