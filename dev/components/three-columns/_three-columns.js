jQuery($ => {
    function inView(elem) {
        const docViewTop = $(window).scrollTop();
        const docViewBottom = docViewTop + $(window).height();
        const elemTop = $(elem).offset().top;
        const elemBottom = elemTop + $(elem).height();

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    $(window).on('scroll', () => {
        $('.three-columns__section-title').each(function (i) {
            if (inView(this) === true) {
                const lineAnimate = $(this).find('.line-animation');

                setTimeout(
                    () => {
                        $(this).addClass('animate');
                    },
                    i * 100
                );

                setTimeout(
                    () => {
                        lineAnimate.addClass('expand');
                    },
                    600
                );
            }
        });

        $('.three-columns__subtitle').each(function (i) {
            if (inView(this) === true) {
                setTimeout(
                    () => {
                        $(this).addClass('animate');
                    },
                    i * 100
                );
            }
        });

        $('.three-columns__row').each(function (i) {
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
