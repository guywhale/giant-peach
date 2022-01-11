<?php

namespace Light\WordPress;

class Sidebars
{
    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('widgets_init', [__CLASS__, 'register']);
    }

    /**
     * register
     *
     ** Register a sidebar if defined in config file
     *
     * @return void
     */
    public static function register(): void
    {
        global $LIGHT_SIDEBARS;

        if (is_array($LIGHT_SIDEBARS)) {
            foreach ($LIGHT_SIDEBARS as $key => $sidebar) {
                register_sidebar($sidebar);
            }
        }
    }
}
