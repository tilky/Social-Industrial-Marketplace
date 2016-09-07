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
    $('[data-toggle="tooltip"]').tooltip()
})

/***********************************************************/
/* OutoCompelet */
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
