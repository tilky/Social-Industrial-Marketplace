<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="{{URL::asset('livesite/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('livesite/js/owl-carousel/owl.carousel.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('livesite/js/animate.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('livesite/js/ng_responsive_tables.js')}}"></script>
<script>

function ShowRegisterModal()
{
    var email = $('#home-email').val();
    var user_type = $('#home-user-type').val();
    var industry = $('#home-industry').val();
    $('#register-email').val(email);
    $('#register-user-type').val(user_type);
    $('#register-industry').val(industry);
}
            $(document).ready(function() {
                $("#owl-demo").owlCarousel({
                    items: 3,
                    navigation: false,
                    slideSpeed: 300,
                    paginationSpeed: 500,
                    singleItem: true,
                    autoPlay: true,
                    pagination: false,
                });


                $("#testimonial").owlCarousel({
                    navigation: true, // Show next and prev buttons
                    pagination: false,
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    singleItem: true,
                    navigationText: ["<img src='images/left_wh.png' alt='' />", "<img src='images/rt_wh.png' alt='' />"],

                });

                $(".product_demo").owlCarousel({
                    navigation: true,
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    singleItem: false,
                    pagination: false,
                    items: 4,
                    itemsDesktop: [1199, 4],
                    itemsDesktopSmall: [991, 3],
                    itemsTablet: [768, 2],
                    itemsMobile: [479, 1],
                    navigationText: ["<img src='images/left_arrow.png' alt='' />", "<img src='images/right_arrow.png' alt='' />"],

                });

                $(".profileslider").owlCarousel({
                    navigation: false,
                    pagination: true,
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    singleItem: false,
                    items: 4,
                    itemsDesktop: [1199, 4],
                    itemsDesktopSmall: [991, 3],
                    itemsTablet: [768, 2],
                    itemsMobile: [479, 1],


                });


                $(".scrollar_btn").click(function() {
                    $('html,body').animate({
                        scrollTop: 850
                    }, 1000);
                });

                $('.scrolltotop').hide();

                $(".scrolltotop").click(function() {
                    $('html,body').animate({
                        scrollTop: 0
                    }, 1000);
                });



               /* $(window).scroll(function() {
                    if ($(window).scrollTop() >= 500) {
                        $('.scrolltotop').show('2000');
                    } else {
                        $('.scrolltotop').hide('2000');
                    }
                });*/



                $(function loop_charch() {
                    $(" .scrollar_btn btn-circle .circle").animate({
                        height: 50
                    }, 1000)
                    $(" .scrollar_btn btn-circle .circle").animate({
                        height: 40
                    }, 1000, loop_charch);

                }); //loop_charch();


            });

            $(window).on("load", function() {
                function fade() {
                    var animation_height = $(window).innerHeight() * 0.25;
                    var ratio = Math.round((1 / animation_height) * 10000) / 10000;

                    $('.fade').each(function() {
                        var objectTop = $(this).offset().top;
                        var windowBottom = $(window).scrollTop() + $(window).innerHeight();

                        if (objectTop < windowBottom) {
                            if (objectTop < windowBottom - animation_height) {

                                $(this).css({
                                    transition: 'opacity 0.1s linear',
                                    opacity: 1
                                });

                            } else {

                                $(this).css({
                                    transition: 'opacity 0.25s linear',
                                    opacity: (windowBottom - objectTop) * ratio
                                });
                            }
                        }
                    });

                }
                $('.fade').css('opacity', 0);
                fade();
                $(window).scroll(function() {
                    fade();
                });
            });



            $(window).load(function() {
                if ($(window).width() < 1600) {
                    $('.custom_nav').css({
                        "padding-left": "20px",
                        "padding-right": "20px"
                    });
                }
            });

        </script> 
<script type="text/javascript">
            $(function() {
                $('table.responsive').ngResponsiveTables({
                    smallPaddingCharNo: 13,
                    mediumPaddingCharNo: 18,
                    largePaddingCharNo: 30
                });
            });

        </script> 
<script src="{{URL::asset('livesite/js/WOW-Animations/wow.min.js')}}"></script>
<script>
    new WOW().init();

</script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
<script>
            $("#industry").autocomplete({
                source: ["Industry", "Boy", "Cat"],
                minLength: 0,
            }).focus(function() {
                $(this).autocomplete("search");
            });

            $("#catagory").autocomplete({
                source: ["Catgory", "Boy", "Cat"],
                minLength: 0,
            }).focus(function() {
                $(this).autocomplete("search");
            });

            $('.infoeabout').click(function() {
                $('#autocomplete').trigger("focus"); //or "click", at least one should work
            });

            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })

        </script> 
<script>
            $(document).ready(function() {




                $('li.dropdown').hover(function() {
                    $('ul.dropdown-menu', this).stop(true, true).fadeIn('fast', 'easeOutElastic');
                    $(this).addClass('open');
                    $(this).addClass('radius');
                }, function() {
                    $('ul.dropdown-menu', this).stop(true, true).fadeOut('fast', 'easeInElastic');
                    $(this).removeClass('open');
                    $(this).removeClass('radius');
                });

                $('.dropdown-menu').hover(function() {
                    $(this).parent('li').stop(true, true).addClass('selectli');

                }, function() {
                    $(this).parent('li').stop(true, true).removeClass('selectli');
                });
            });

        </script> 
<script src="{{URL::asset('livesite/js/jquery.prettyPhoto.js')}}"></script>
<script type="text/javascript" charset="utf-8">
            $(document).ready(function() {


                $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({
                    animation_speed: 'normal',
                    social_tools: false
                });



            });

        </script> 

<script>
            $('.button_section .btn').tooltip({
                position: {
                    my: "center top-2",
                    at: "center bottom"
                }
            });

        </script> 
        <script>
    /*=================================================*/
    /* For FAQ expand-all option */

    $(".expand-all").click(function(e) {
        e.preventDefault();
        if (!$(".faq-page #accordion a ").hasClass("collapsed")) {
            $(".faq-page .panel-collapse").collapse('hide');
            $(".faq-page .panel-heading .panel-title  a").addClass("collapsed");
            $(".faq-page .expand-all").text("(Expand all)");
        } else {
            $(".faq-page .panel-collapse").collapse('show');
            $(".faq-page .panel-heading .panel-title  a").removeClass("collapsed");
            $(".faq-page .expand-all").text("(Collapsed all)");
        }

    });

</script>
<script type="text/javascript">
function getQueryStringValue (key) {  
  return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));  
}
if(getQueryStringValue("sendemail") == 1) 
{
    $('#window_splash').modal('show');
}
if(getQueryStringValue("verify") == 1) 
{
    var email = getQueryStringValue("email");
    var industry = getQueryStringValue("industry");
    $('#register-email').val(email);
    $('#register-industry').val(industry);
    $('#signup').modal('show');
}
$(document).ready(function(){
    $('[data-toggle="popover"]').popover({animation: true, delay: {show: 100, hide: 100}}); 
	$('.findMe li a').on('click', function(e) {e.preventDefault(); return true;});
});
</script>
<script>
    function getQueryStringValue (key) {
        return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
    }

    $(document).ready(function() {

        if(getQueryStringValue("popup") == 'company_import')
        {
            $('#company_import_model').modal('show');
        }
    });
</script>



