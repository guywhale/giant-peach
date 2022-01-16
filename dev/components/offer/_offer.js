jQuery($ => {
    function isScrolledIntoView(elem) {
        const docViewTop = $(window).scrollTop();
        const docViewBottom = docViewTop + $(window).height();
        const elemTop = $(elem).offset().top;
        const elemBottom = elemTop + $(elem).height();

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    $(window).on('scroll', () => {
        $('.offer__col').each(function () {
            if (isScrolledIntoView(this) === true) {
                const whiteBoxes = $(this).find('.offer__white-box');
                const lineAnimate = $(this).find('.line-animation');

                whiteBoxes.each(function (i) {
                    setTimeout(
                        () => {
                            $(this).addClass('animate');
                        },
                        i * 200
                    );
                });

                setTimeout(
                    () => {
                        lineAnimate.addClass('expand');
                    },
                    600
                );
            }
        });
    });
});
