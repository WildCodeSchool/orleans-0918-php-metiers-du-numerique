var windowH = 150;

$(window).on('scroll',function(){
    if ($(this).scrollTop() > windowH) {
        $("#myBtn").css('display','flex');
    } else {
        $("#myBtn").css('display','none');
    }
});

$('#myBtn').on("click", function(){
    $('html, body').animate({scrollTop: 0}, 300);
});

