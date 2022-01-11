<?php

namespace Light\WordPress;

class Updates
{
    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        //* Disable updates for themes and plugins
        add_filter('auto_update_theme', '__return_false');
        add_filter('auto_update_plugin', '__return_false');
    }
}
