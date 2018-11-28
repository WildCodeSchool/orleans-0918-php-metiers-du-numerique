$(".single-item").slick({
    centerPadding: '60px',
    slidesToShow: 3,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                // centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: true,
                // centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        }
    ]
});


			