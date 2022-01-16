jQuery($ => {
    $('.hero-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        nextArrow: $('.hero-slider__next'),
        dotsClass: 'slick-dots container',
    });

    let lineAnimation = $('.slick-current').find('.line-animation');

    if (lineAnimation) {
        lineAnimation.addClass('expand');
    }

    $('.hero-slider').on('afterChange', () => {
        setTimeout(
            () => {
                lineAnimation = $('.slick-current').find('.line-animation');

                if (lineAnimation) {
                    lineAnimation.addClass('expand');
                }
            },
            200
        );
    });

    $('.hero-slider').on('beforeChange', () => {
        lineAnimation = $('.slick-current').find('.line-animation');

        if (lineAnimation) {
            lineAnimation.removeClass('expand');
        }
    });
});
