jQuery($ => {
    function isScrolledIntoView(elem) {
        const docViewTop = $(window).scrollTop();
        const docViewBottom = docViewTop + $(window).height();
        const elemTop = $(elem).offset().top;
        const elemBottom = elemTop + $(elem).height();

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    $(window).on('scroll', () => {
        $('.offer').each(function () {
            if (isScrolledIntoView(this) === true) {
                const lineAnimate = $(this).find('.line-animation');
                lineAnimate.addClass('expand');
            }
        });
    });
});
