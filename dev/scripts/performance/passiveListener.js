//* Passive event listeners
jQuery.event.special.touchstart = {
    setup(_, ns, handle) {
        this.addEventListener('touchstart', handle, { passive: !ns.includes('noPreventDefault') });
    }
};
jQuery.event.special.touchmove = {
    setup(_, ns, handle) {
        this.addEventListener('touchmove', handle, { passive: !ns.includes('noPreventDefault') });
    }
};
jQuery.event.special.wheel = {
    setup(_, ns, handle) {
        this.addEventListener('wheel', handle, { passive: true });
    }
};
jQuery.event.special.mousewheel = {
    setup(_, ns, handle) {
        this.addEventListener('mousewheel', handle, { passive: true });
    }
};
