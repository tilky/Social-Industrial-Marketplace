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

<div class="slider inner_slide banner_form small_banner" style="background-image: url({{URL::asset('images/banner_4.jpg')}})">
            <div class="slider_overlay">

                <div class="container vericle_table animatedParent"> 
                    <div class="verticle_row">
                        <h1 class="banner_header  animated bounceInDown slower">Welcome to   <br/>  <span>Company name</span> </h1>
                        <div class="text-center"><div class="scrollar_btn"><span class="circle"><span class="dot"></span></span><p>Learn More</p></div></div>
                    </div> 
                </div> 
            </div>
        </div>
        
<div class="company_info">
     <div class="color_bg"> 
          <div class="container"> 
       
             
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="hvr-bounce-to-right"> Home</a></li>
      <li role="presentation"><a href="#productService" aria-controls="profile" role="tab" data-toggle="tab" class="hvr-bounce-to-right">Product Services</a></li>
      <li role="presentation"><a href="#companyInfo" aria-controls="messages" role="tab" data-toggle="tab" class="hvr-bounce-to-right">Company Info</a></li>
    <li role="presentation"><a href="#contact" aria-controls="settings" role="tab" data-toggle="tab" class="hvr-bounce-to-right">Contact</a></li>
 
      
  </ul>
   </div>
</div>
         
<div class="container"> 
  <!-- Tab panes -->
  <div class="tab-content tab_content section"> 
    <div role="tabpanel" class="tab-pane active" id="home"> 
     <div class="relative col-md-3 text-center profile_info">
                
                    <div class="uploadimage">
                        <img src="{{URL::asset('images/uploadimage.jpg')}}" alt=""/>
                        <div class="upload_div hvr-rectangle-out">   
                            <div> 
                           <a href="#"> 
                          <i><img src="{{URL::asset('images/uploading.png')}}" alt="" /></i>
                          <h4>Upload Image</h4>
                           </a>
                          <div class="check"> <i class="fa fa-check"></i></div>
                        
                      </div>
                      </div>
                 
                    </div>
                    <h3 class="header_24 paddingtop20">Membership Level</h3>
                    <ul class="list-inline profile_num">
                       <li> <img src="{{URL::asset('images/cmnt_icon.png')}}" alt=""> 1,147</li>
                        <li> <img src="{{URL::asset('images/hrt_icon.png')}}" alt=""> 3,820</li>
                        <li> <img src="{{URL::asset('images/star_icon.png')}}" alt=""> 2,052</li>
                    </ul>
                    
                    
                    <ul class="list-inline profile_social">
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>
                         <li><a href=""><i class="fa fa-instagram"></i></a></li>
                           <li><a href=""><i class="fa fa-pinterest-p"></i></a></li>
                            <li><a href=""><i class="fa fa-youtube"></i></a></li>
                    </ul>
                    
                </div>    
        
        
 <div class="col-md-9">  
<div class="profilehome"> 
  <!-- Nav tabs -->
<ul class="nav nav-tabs btn_industry" role="tablist">
    <li role="presentation" class="active"><a href="#tab_one" aria-controls="home" role="tab" data-toggle="tab" class="btn">Industry</a></li>
<li role="presentation"><a href="#tab_two" aria-controls="profile" role="tab" data-toggle="tab" class="btn"> Industry</a></li>
<li role="presentation"><a href="#tab_three" aria-controls="messages" role="tab" data-toggle="tab" class="btn"> Industry</a></li> 
<li role="presentation"><a href="#tab_four" aria-controls="settings" role="tab" data-toggle="tab" class="btn">More ...</a></li>

</ul>

  <!-- Tab panes  inner-->
<div class="tab-content tab_content"> 
<div role="tabpanel" class="tab-pane active" id="tab_one">
<h3 class="header_36">QuoteTek</h3>
<h3 class="header_18">Senior VP of Sales at Company Name</h3>                        
<h3 class="header_24">Lorem Ipsum is simply dummy text of the industry.</h3> 
It is a long established fact that a reader will be distracted by the readable content of a page when 
looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution 
of letters, as opposed to using 'Content here   

<h3 class="header_18">Established: 2015. Joined Quotetek: 2015</h3>    
    <ul class="list-inline greenbutton">
    <li><a href="" class="btn">ENDORSE</a></li>
    <li><a href="" class="btn">REQUEST QUOTE</a></li>
    <li><a href="" class="btn">CONTACT</a></li>
    </ul>


</div>

<div role="tabpanel" class="tab-pane" id="tab_two"> 
<h3 class="header_36">Industry</h3>     
It is a long established fact that a reader will be distracted by the readable content of a page when 
looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution 
of letters, as opposed to using 'Content here, content here', making it look like readable.   
</div>
    
    <div role="tabpanel" class="tab-pane" id="tab_three"> 
<h3 class="header_36">Industry</h3>     
It is a long established fact that a reader will be distracted by the readable content of a page when 
looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution 
of letters, as opposed to using 'Content here, content here', making it look like readable.   
</div>
    
    <div role="tabpanel" class="tab-pane" id="tab_four"> 
<h3 class="header_36">More</h3>     
It is a long established fact that a reader will be distracted by the readable content of a page when 
looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution 
of letters, as opposed to using 'Content here, content here', making it look like readable.   
</div>
 
</div> 
</div>    
 </div>

 </div>
    
     <div role="tabpanel" class="tab-pane" id="productService"> 
     <h3 class="header_36">Product / Service</h3>
<h3 class="header_18">Senior VP of Sales at Company Name</h3>                        
<h3 class="header_24">Lorem Ipsum is simply dummy text of the industry.</h3> 
It is a long established fact that a reader will be distracted by the readable content of a page when 
looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution  
     </div>
      
      <div role="tabpanel" class="tab-pane" id="companyInfo">
  <h3 class="header_36">Company Info</h3> 
It is a long established fact that a reader will be distracted by the readable content of a page when 
looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution 
of letters, as opposed to using 'Content here, content here', making it look like readable.  

<h3 class="header_18">Established: 2015. Joined Quotetek: 2015</h3>   
          
      </div>
 
     <div role="tabpanel" class="tab-pane" id="contact"> 
     <h3 class="header_36">Contact</h3>
     <h3 class="header_18"><i class="fa fa-phone-square"></i> Phone 5345354345</h3>                        
<h3 class="header_18"><i class="fa fa-envelope-square"></i> Email dfsdf@gmail.com</h3> 
It is a long established fact that a reader will be distracted by the readable content of a page when 
looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution 
of letters, as opposed to using 'Content here, content here', making it look like readable.  
 

     </div> 
  </div>
</div>
   

 </div>
  
      <div class="section nopadding_bottom fade">
          <div class="process" style="background-image:url({{URL::asset('images/company_info.jpg')}}); ">
              <div class="colored_bg section text-center company_info_des">
                  <div class="container"> 
                   <h3 class="header_36 text-center">Company Information</h3>
                   
                   <div class="info_col border_rt">
                       <ul class="list-unstyled">
                           <li>Business Type</li>
                               <li>Total Annual Revenue</li>
                                <li>Main Products</li>
                                 <li>Main Markets</li>
                                  <li>Accredations</li>
                                   <li>Quality Standards</li>
                                    <li>Shipping Standards</li>
                                     <li>Number Of Employees</li>
                       </ul>
                   </div>
                    <div class="info_col">
                     <ul class="list-unstyled">
                           <li>Some Words</li>
                               <li>Some City</li>
                                <li>2015</li>
                                 <li>Hidden</li>
                                  <li>Some Products</li>
                                   <li>India, USA, China</li>
                                   
                       </ul>
                    
                    </div>
                    
                  </div>
              </div>
              
          </div>
      </div>
        

        <div class="section fade">
            <div class="container ">
            
                
                <div class="product_section fade text-center">
                   <h3 class="header_middle">Photo Gallery</h3>

                    <div class="photo_gallery gallery">
                       <div class="col-md-8 leftside_gal">  
                           <ul>
                               <li><a href="{{URL::asset('images/photo1.jpg')}}" class="hvr-rectangle-out"
                                     rel="prettyPhoto[gallery1]"><div class="viewmore"><h4>View Image</h4></div><img src="{{URL::asset('images/photo1.jpg')}}"  alt="Photo Gallery"/></a></li>
                                 <li><a href="{{URL::asset('images/photo2.jpg')}}" class="hvr-rectangle-out"  rel="prettyPhoto[gallery1]"><div class="viewmore"><h4>View Image</h4></div><img src="{{URL::asset('images/photo2.jpg')}}"  alt="Photo Gallery"/></a></li>
                                 <li><a href="{{URL::asset('images/photo4.jpg')}}" class="hvr-rectangle-out"  rel="prettyPhoto[gallery1]"><div class="viewmore"><h4>View Image</h4></div><img src="{{URL::asset('images/photo4.jpg')}}"  alt="Photo Gallery"/></a></li>
                                 <li><a href="{{URL::asset('images/photo5.jpg')}}" class="hvr-rectangle-out"  rel="prettyPhoto[gallery1]"><div class="viewmore"><h4>View Image</h4></div><img src="{{URL::asset('images/photo5.jpg')}}"  alt="Photo Gallery"/></a></li>
                           </ul>
                           
                          
                       </div>
                        
                         <div class="col-md-4 rightside_gal">
                           <ul>
                                 <li><a href="{{URL::asset('images/photo3.jpg')}}" class="hvr-rectangle-out"  rel="prettyPhoto[gallery1]"><div class="viewmore"><h4>View Image</h4></div><img src="{{URL::asset('images/photo3.jpg')}}"  alt="Photo Gallery"/></a></li>
                                
                           </ul>
                       </div>
                       
                   </div>
                   <div class="clearfix"></div>
                </div>
                   <div class="clearfix"></div>
                   
                   
                <div class="product_section fade catagorysec">
                   <h3 class="header_middle text-center">Categories & Products (156)</h3>
                   <div class="col-md-3">
                       <ul class="list-unstyled">
                           <li><a href="">Product Category 1</a></li>
                            <li><a href="">Product Category 5</a></li>
                             <li><a href="">Product Category 9</a></li>
                              <li><a href="">Product Category 13</a></li>
                               <li><a href="">Product Category 17</a></li>
                                <li><a href="">Product Category 21</a></li>
                       </ul> 
                   </div>
                   
                    <div class="col-md-3">
                       <ul class="list-unstyled">
                         <li><a href="">Product Category 2</a></li>
                            <li><a href="">Product Category 6</a></li>
                             <li><a href="">Product Category 10</a></li>
                              <li><a href="">Product Category 14</a></li>
                               <li><a href="">Product Category 18</a></li>
                                <li><a href="">Product Category 22</a></li>
                       </ul> 
                   </div>
                   
                    <div class="col-md-3">
                       <ul class="list-unstyled">
                          <li><a href="">Product Category 3</a></li>
                            <li><a href="">Product Category 7</a></li>
                             <li><a href="">Product Category 11</a></li>
                              <li><a href="">Product Category 15</a></li>
                               <li><a href="">Product Category 19</a></li>
                                <li><a href="">Product Category 23</a></li>
                       </ul> 
                   </div>
                   
                    <div class="col-md-3">
                       <ul class="list-unstyled">
                           <li><a href="">Product Category 4</a></li>
                            <li><a href="">Product Category 8</a></li>
                             <li><a href="">Product Category 12</a></li>
                              <li><a href="">Product Category 16</a></li>
                               <li><a href="">Product Category 20</a></li>
                                <li><a href="">Product Category 24</a></li>
                       </ul> 
                   </div>
                    
                   <div class="clearfix"></div>
                   <div class="text-center"><a href="#" class="btn btn-circle btnspace_pro">View More</a></div>
                   
                   
                </div>
                   
                   
                   
                       
                  <div class="clearfix"></div>

                
       
                
                <div class="product_section fade text-center new_pro">
                     <h3 class="header_middle">New Products </h3>

                    <div class="owl-carousel product_demo">
                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_3.png')}}"/></div>
                            <div class="pro_title">Modern Cricular Chair</div>
                              <div class="pro_price">$250</div>
                               <div class="pro_sub_title">Product Category, Title</div> 
                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_3.png')}}"/></div>
                            <div class="pro_title">Modern Cricular Chair</div>
                              <div class="pro_price">$250</div>
                               <div class="pro_sub_title">Product Category, Title</div> 
                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_3.png')}}"/></div>
                            <div class="pro_title">Modern Cricular Chair</div>
                              <div class="pro_price">$250</div>
                               <div class="pro_sub_title">Product Category, Title</div> 
                        </div>

                        <div class="item"> 
                            <div class="pro_img"><img src="{{URL::asset('images/product_3.png')}}"/></div>
                            <div class="pro_title">Modern Cricular Chair</div>
                              <div class="pro_price">$250</div>
                               <div class="pro_sub_title">Product Category, Title</div> 
                        </div> 
 
                    </div>  
                     
                         <div class="clearfix"></div>
                   <div class="text-center"><a href="#" class="btn btn-circle btnspace_pro">View More</a></div>
                </div>
                
                
               <div class="product_section fade special_service">
                   <h3 class="header_middle text-center">Specialized Services (40)</h3>
                   <div class="col-md-3 text-center">
                       <a href="">
                        <div data-icon="a" class="icon"></div>
                        <h3 class="header_24">Services</h3> 
                       </a>
                        <p>It is a long established fact reader will be distracted.</p>
                      
                   </div>
                   
                      <div class="col-md-3 text-center">
                       <a href="">
                        <div data-icon="P" class="icon"></div>
                        <h3 class="header_24">Services</h3> 
                       </a>
                        <p>It is a long established fact reader will be distracted.</p>
                      
                   </div>
                  
                    <div class="col-md-3 text-center">
                       <a href="">
                        <div data-icon="x" class="icon"></div>
                        <h3 class="header_24">Services</h3> 
                       </a>
                        <p>It is a long established fact reader will be distracted.</p>
                      
                   </div>
                   
                   
                    <div class="col-md-3 text-center">
                       <a href="">
                        <div data-icon="/" class="icon"></div>
                        <h3 class="header_24">Services</h3> 
                       </a>
                        <p>It is a long established fact reader will be distracted.</p>
                      
                   </div>
                   
                    
                   <div class="clearfix"></div>
                   <div class="text-center"><a href="#" class="btn btn-circle btnspace_pro">View More</a></div>
                   
                   
                </div> 

            </div>
        </div>
        
        
         <div class="nopadding_bottom fade">
          <div class="process" style="background-image:url({{URL::asset('images/testi_bg.jpg')}}); ">
              <div class="colored_bg section text-center testi_sec">
                  <div class="container"> 
                      
                  <div class="owl-carousel" id="testimonial">
                  <div class="items">
                   <h3 class="header_middle text-center pb30">Endorsements (251)</h3> 
                   <div class="testi_profile"><img src="{{URL::asset('images/client.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div>
                      <div class="date_des">
                          <span class="pull-left">Accenture India</span>
                            <span class="pull-right">2/12/2015</span>
                      </div>
                     <div class="test_descri">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard 
dummy text ever since the 1500s, when an unknown printer took it to make a type specimen book.</div>
                     <div class="test_btn"><a href="" class="btn">view more</a></div>
                   
                      </div>
                      
                      
                  <div class="items">
                   <h3 class="header_middle text-center pb30">Endorsements (251)</h3> 
                   <div class="testi_profile"><img src="{{URL::asset('images/client.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div>
                      <div class="date_des">
                          <span class="pull-left">Accenture India</span>
                            <span class="pull-right">2/12/2015</span>
                      </div>
                     <div class="test_descri">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard 
dummy text ever since the 1500s, when an unknown printer took it to make a type specimen book.</div>
                     <div class="test_btn"><a href="" class="btn">view more</a></div>
                   
                      </div>
                      
                    </div>
                      
                  </div>
              </div>
              
          </div>
      </div>
        
        
        
        <div class="section nopadding_bottom fade">
         
              <h3 class="header_middle text-center pb30">Endorsers</h3>
            
            
              <div class="text-center white_carasoul">
                  <div class="container">  
                  <div class="owl-carousel profileslider">
                  <div class="items"> 
                      <div class="testi_profile"><img src="{{URL::asset('images/p1.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                   <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/p2.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                      <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/p3.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                      <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/client.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                      <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/p1.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                    </div>
                     
                      
                        <div class="clearfix"></div>
                   <div class="text-center"><a href="#" class="btn btn-circle btnspace_pro">Endorse</a></div>
                   
                    <div class="clearfix"></div>  
                  </div>
              </div>
              
       
      </div>
        
        
            
         <div class="section nopadding_bottom fade">
          <div class="process" style="background-image:url({{URL::asset('images/testi_bg.jpg')}}); ">
              <div class="colored_bg section text-center testi_sec">
                  <div class="container"> 
                      
                          <h3 class="header_middle text-center pb30">Coworkers</h3>
                          
                            <div class="text-center white_carasoul red_text no_btn">
                  <div class="container">  
                  <div class="owl-carousel profileslider">
                  <div class="items"> 
                      <div class="testi_profile"><img src="{{URL::asset('images/n1.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                   <div class="items"> 
                       <div class="testi_profile"><img src="{{URL::asset('images/p4.jpg')}}"></div>
                     <div class="client_name">John Doe</div> 
                      </div>
                      
                      <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/p5.png')}}"></div>
                     <div class="client_name">Leo Carter</div> 
                      </div>
                      
                      <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/client.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                      <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/p1.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                    </div>
                     
                      <div class="clearfix"></div>  
                  </div>
              </div>
             
                      
                  </div>
              </div>
              
          </div>
      </div>
        
        
        
          <div class="section nopadding_bottom fade">
         
              <h3 class="header_middle text-center pb30">Network Adds</h3>
            
            
              <div class="text-center white_carasoul no_btn">
                  <div class="container">  
                  <div class="owl-carousel profileslider">
                  <div class="items"> 
                      <div class="testi_profile"><img src="{{URL::asset('images/n1.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                   <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/n2.jpg')}}"></div>
                     <div class="client_name">John Doe</div> 
                      </div>
                      
                      <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/p3.jpg')}}"></div>
                     <div class="client_name">Leo Carter</div> 
                      </div>
                      
                      <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/client.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                      <div class="items"> 
                   <div class="testi_profile"><img src="{{URL::asset('images/p1.jpg')}}"></div>
                     <div class="client_name">Sainy Martin</div> 
                      </div>
                      
                    </div>
                     
                      <div class="clearfix"></div>  
                  </div>
                  
              </div>
              
       
      </div>


  

<div class="clearfix"></div>
@include('home.footerlinks')
@endsection
