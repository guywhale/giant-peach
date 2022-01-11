<?php

namespace Light\WordPress;

class Menus
{
    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('after_setup_theme', [__CLASS__, 'menus']);
    }

    /**
     * menus
     *
     ** Add menus defined in config
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     * @return void
     */
    public static function menus(): void
    {
        global $LIGHT_MENUS;

        if (is_array($LIGHT_MENUS)) {
            register_nav_menus($LIGHT_MENUS);
        }
    }
}
