$('.single-item').slick({
    centerMode: true,
    centerPadding: '50px',
    infinite: true,
    autoplay:true,
    autoplaySpeed:2000,
    slidesToShow: 5,
    responsive: [
        {
            breakpoint: 770,
            settings: {
                arrows: true,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: true,
                centerMode: true,

                slidesToShow: 1
            }
        }
    ]
});
			