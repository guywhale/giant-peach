<?php

namespace Light\WordPress;

class Plugins
{
    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        require_once \Light\themePath('vendor/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php');
        add_action('tgmpa_register', [__CLASS__, 'registerRequiredPlugins']);
    }

    /**
     * registerRequiredPlugins
     *
     * Defines required plugins for the theme
     *
     * @link http://tgmpluginactivation.com/configuration/
     *
     */
    public static function registerRequiredPlugins()
    {
        $plugins = [

            [
                'name'        => 'Safe SVG',
                'slug'        => 'safe-svg',
                'required'    => true,
            ],
            [
                'name'        => 'Custom CSS and Javascript',
                'slug'        => 'custom-css-and-javascript',
                'required'    => true,
            ],
            [
                'name'        => 'Show Current Template',
                'slug'        => 'show-current-template',
                'required'    => false,
            ],
            [
                'name'        => 'Wordfence',
                'slug'        => 'wordfence',
                'required'    => true,
            ],
            [
                'name'        => 'Duplicate Post',
                'slug'        => 'duplicate-post',
                'required'    => true,
            ],
            [
                'name'        => 'Contact Form 7',
                'slug'        => 'contact-form-7',
                'required'    => true,
            ],
            [
                'name'        => 'Redirection',
                'slug'        => 'redirection',
                'required'    => true,
            ],
            [
                'name'        => 'All-in-One WP Migration',
                'slug'        => 'all-in-one-wp-migration',
                'required'    => true,
            ],
            [
                'name'        => 'Contact Form 7 Database Addon – CFDB7',
                'slug'        => 'contact-form-cfdb7',
                'required'    => true,
            ],
            [
                'name'        => 'Smush',
                'slug'        => 'wp-smushit',
                'required'    => false,
            ],
            [
                'name'        => 'Custom Post Type UI',
                'slug'        => 'custom-post-type-ui',
                'required'    => false,
            ],
            [
                'name'        => 'User Roles and Capabilities',
                'slug'        => 'user-roles-and-capabilities',
                'required'    => false,
            ],
            [
                'name'        => 'Post Types Order',
                'slug'        => 'post-types-order',
                'required'    => false,
            ],
            [
                'name'        => 'Advanced Custom Fields Pro',
                'slug'        => 'advanced-custom-fields-pro',
                'source'      => 'https://sobold.co.uk/pro-plugin-store/advanced-custom-fields-pro.zip',
                'required'    => false,
            ],
            [
                'name'        => 'All in one WP Migration - Unlimited Extension',
                'slug'        => 'all-in-one-wp-migration-unlimited-extension',
                'source'      => 'https://sobold.co.uk/pro-plugin-store/all-in-one-wp-migration-unlimited-extension.zip',
                'required'    => false,
            ],
            [
                'name'        => 'WordPress SEO by Yoast',
                'slug'        => 'wordpress-seo',
                'is_callable' => 'wpseo_init',
                'required'    => true,
            ],

        ];

        $config = [
            'id'              => 'tgmpa',
            'default_path'    => '',
            'menu'            => 'tgmpa-install-plugins',
            'parent_slug'     => 'themes.php',
            'capability'      => 'edit_theme_options',
            'has_notices'     => true,
            'dismissable'     => true,
            'dismiss_msg'     => '',
            'is_automatic'    => true,
            'message'         => '',

            'strings'      => [
                'page_title'                    => __('SoBold Theme - Install Required Plugins', 'theme-slug'),
                'install_link'                  => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'theme-slug'
                ),
                'menu_title'                    => __('Install Plugins', 'theme-slug'),
                'notice_can_install_required'   => _n_noop(
                    'The SoBold Theme requires the following plugin: %1$s.',
                    'The SoBold Theme requires the following plugins: %1$s.',
                    'theme-slug'
                ),
                'notice_can_install_recommended' => _n_noop(
                    'The following plugin may also be required: %1$s.',
                    'The following plugins may also be required: %1$s.',
                    'theme-slug'
                ),
            ],

        ];

        tgmpa($plugins, $config);
    }
}
