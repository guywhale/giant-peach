document.addEventListener('DOMContentLoaded', () => {
    const toggleBtns = document.querySelectorAll('.navigation__toggle');

    toggleBtns.forEach(toggleBtn => {
        toggleBtn.addEventListener('click', () => {
            let overlay;
            let slideInDiv;

            if (toggleBtn.classList.contains('navigation__close')) {
                overlay = toggleBtn.closest('.navigation__overlay');
                slideInDiv = toggleBtn.closest('.navigation__slide-in');

                slideInDiv.classList.toggle('open');
                setTimeout(
                    () => {
                        overlay.classList.toggle('open');
                    },
                    500
                );
            } else if (toggleBtn.classList.contains('navigation__burger')) {
                overlay = toggleBtn.nextElementSibling;
                slideInDiv = overlay.querySelector('.navigation__slide-in');

                overlay.classList.toggle('open');
                slideInDiv.classList.toggle('open');
            }
        });
    });
});
