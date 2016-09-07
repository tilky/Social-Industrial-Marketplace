"use strict";
/*jshint strict:false */
/*jslint browser: true*/
/*jslint node: true */
/*global $, jQuery, alert*/
/*global alert: false, console: false, jQuery: false */


$(document).ready(function () {




    /*=================================================*/
    /* close btn */

    $(".close").click(function () {
        $(this).parents(".modal-form").fadeOut(500);
    });


    /*=================================================*/
    /*  Login/Sinup Btn  */

    $(".login-btn").click(function () {
        $(".signup-model").fadeOut(500);
        $(".how-it-works-model").fadeOut(500);
        $(".login-model").show();
    });
    $(".signup-btn").click(function () {
        $(".login-model").fadeOut(500);
        $(".how-it-works-model").fadeOut(500);

        $(".signup-model").show();
    });

    /*=================================================*/
    /*  Search Form   */

    $(".navbar-form .close").click(function () {
        $(".navbar-form").fadeOut(500, function () {
            $(".navbar-form").prev(".navbar-nav").fadeIn(500);
            $(".search-btn").parent().fadeIn(500);

        });
    });
    $(".search-btn").click(function () {
        $(this).parent("").fadeOut(500, function () {
            $(".navbar-form").fadeIn(500);
        });
    });

    $(".how-it-works-btn").click(function () {
        $(".how-it-works-model").fadeIn(500).siblings(".modal-form").fadeOut(500);


    });
    /*********************************************/
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    /***********************************************************/
    /* OutoCompelet *
    $(function () {
        var availableTags = [
          "A",
          "B",
          "Asp",
          "BASIC",
          "C",
          "C++",
          "Clojure",
          "COBOL",
          "ColdFusion",
          "Erlang",
          "Fortran",
          "Groovy",
          "Haskell",
          "Java",
          "C",
          "Lisp",
          "Perl",
          "PHP",
          "Python",
          "Ruby",
          "Scala",
          "Scheme"
        ];
        $(".industry-search").autocomplete({
            source: availableTags
        });
    });

    /******************************************************************/
    /* Bootstrap autocomplelet *

    $('#query').typeahead({
        local: ['alpha', 'allpha2', 'alpha3', 'bravo', 'charlie', 'delta', 'epsilon', 'gamma', 'zulu']
    });
    $('.tt-query').css('background-color', '#fff');

    /*******************************************************************/
    /* Show Position input */
    $(".company-name-input .btn").click(function () {
        $(".your-position-input").fadeIn(600);
    });
    /******************************************************************/
    /* for admin form show */
    $(".show-admin-form").click(function () {
        $(".form-admin-company").fadeIn(600);
    });

    /******************************************************************/
    /* For index footer-signup-link */
    $(".footer-signup-link").click(function () {
        $("html,body").animate({
            scrollTop: 0
        }, 2000);

    });

    /***************************************************************************/
    /* For close tags */

    $("span.remove-tage").click(function () {
        $(this).parents("li").fadeOut(600);
    });

    /******************************************************************/
    /* For scroll top btn */
    $(".scrollar_btn").click(function () {
        $('html,body').animate({
            scrollTop: 630
        }, 1000);
    });

    $('.scrolltotop').hide();

    $(".scrolltotop").click(function () {
        $('html,body').animate({
            scrollTop: 0
        }, 1000);
    });



    $(window).scroll(function () {
        if ($(window).scrollTop() >= 500) {
            $('.scrolltotop').show('2000');
        } else {
            $('.scrolltotop').hide('2000');
        }
    });
    /*****************************************************************/


    $('.scrolltotop').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 2000);
    });


    $('#gal2').owlCarousel({
        // loop:true,
        addClassActive: false,
        margin: 10,
        loop: false,
        responsive: {
            0: {
                items: 2,
                nav: false

            },
            700: {
                items: 2,
                nav: false
            },

        },




    });

    $('#prev3').click(function (event) {
        /* Act on the event */
        $('#gal2').trigger('prev.owl');
    });


    $('#next3').click(function (event) {
        /* Act on the event */
        $('#gal2').trigger('next.owl');
    });

    $('.owl-carousel').owlCarousel({
        // loop:true,
        addClassActive: false,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 3,
                nav: true,
                loop: false
            }
        },

    });

    /****************************************************
    /*  make smooth scroll  */

    function goToByScroll(id) {
        $('html , body').animate({
            scrollTop: $(id).offset().top
        }, 'slow');
    }
    $('.layout a ').click(function () {
        goToByScroll($(this).attr('href'));
        return false;
    });

});
/***********************************************************************/



$(window).on("load", function () {
    function fade() {
        var animation_height = $(window).innerHeight() * 0.25;
        var ratio = Math.round((1 / animation_height) * 10000) / 10000;

        $('.fade').each(function () {
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
    $(window).scroll(function () {
        fade();
    });
});



$(window).load(function () {
    if ($(window).width() < 1600) {
        $('.custom_nav').css({
            "padding-left": "20px",
            "padding-right": "20px"
        });
    }
});


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

$('.infoeabout').click(function () {
    $('#autocomplete').trigger("focus"); //or "click", at least one should work
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

