$(window).on('scroll', function() {
    var headerHeight = 150;
    if ($(window).scrollTop() >= headerHeight) {
        $('#navbar').addClass('custom-navbar-on-scroll');
        $('#navbar').removeClass('custom-navbar');
    } else {
        $('#navbar').removeClass('custom-navbar-on-scroll');
        $('#navbar').addClass('custom-navbar');
    }
});