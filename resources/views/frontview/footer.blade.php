
      
      <div class="scrolltotop"><a><p><i class="glyphicon glyphicon-arrow-up"></i></p> Top</a></div>
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
     
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    
    <script type="text/javascript" src="{{URL::asset('js/owl-carousel/owl.carousel.js')}}"></script>
       <script type="text/javascript" src="{{URL::asset('js/animate.js')}}"></script>
       <script type="text/javascript" src="{{URL::asset('js/ng_responsive_tables.js')}}"></script>
 
      <script>

          $(document).ready(function(){
              if($(window).width() < 769){
                  console.log($(window).width());
                  $('.page-header-inner').find('.buttons-toggle').addClass('navbar-collapse collapse').css('overflow','hidden');
                  $('.page-top').addClass('navbar-collapse collapse').css('overflow','hidden').css('height','1px');
              }
          })
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
       items : 4,
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
