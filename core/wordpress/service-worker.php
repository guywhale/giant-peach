<?php

namespace Light\WordPress;

class ServiceWorker
{
    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('admin_init', [__CLASS__, 'register']);
    }

    /**
     * register
     *
     ** Copy serviceworker to home_path
     *
     * @return void
     */
    public static function register(): void
    {
        $source = \Light\assetPath('general/serviceworker.js');
        $dest = get_home_path() . 'serviceworker.js';

        copy($source, $dest);
    }
}
