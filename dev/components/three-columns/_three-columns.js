jQuery($ => {
    function inView(elem) {
        const docViewTop = $(window).scrollTop();
        const docViewBottom = docViewTop + $(window).height();
        const elemTop = $(elem).offset().top;
        const elemBottom = elemTop + $(elem).height();

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    $(window).on('scroll', () => {
        $('.three-columns__section-title-col').each(function () {
            if (inView(this) === true) {
                const lineAnimate = $(this).find('.line-animation');

                $('.three-columns__section-title').each(function (i) {
                    setTimeout(
                        () => {
                            $(this).addClass('animate');
                        },
                        i * 100
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

        $('.three-columns__subtitle-col').each(function () {
            if (inView(this) === true) {
                $('.three-columns__subtitle').each(function (i) {
                    setTimeout(
                        () => {
                            $(this).addClass('animate');
                        },
                        i * 100
                    );
                });
            }
        });

        $('.three-columns__col').each(function (index) {
            if (inView(this) === true) {
                const whiteBoxes = $(this).find('.three-columns__white-box');

                $(whiteBoxes).each(function (i) {
                    setTimeout(
                        () => {
                            $(this).addClass('animate');
                        },
                        i * 100
                    );
                });
            }
        });
    });
});
