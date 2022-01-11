<?php

namespace Light\WordPress;

class Assets
{
    public static function init(): void
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'assetsLoad']);
        add_filter('wp_default_scripts', [__CLASS__, 'removejQueryMigrate']);
        add_action('wp_default_scripts', [__CLASS__, 'movejQueryToFooter']);
        add_action('wp_head', [__CLASS__, 'javascriptDetection'], 0);
        add_filter('style_loader_src', [__CLASS__, 'removeVer'], 10, 2);
        add_filter('script_loader_src', [__CLASS__, 'removeVer'], 10, 2);
        add_action('enqueue_block_editor_assets', [__CLASS__, 'editorAssets']);
        add_action('wp_head', [__CLASS__, 'preloadThemeAssets'], 10);
        add_filter('style_loader_tag', [__CLASS__, 'filterEditorFonts'], 10, 2);
        // add_action('admin_enqueue_scripts', [__CLASS__, 'adminAssets']);
    }

    public static function editorAssets(): void
    {
        //* Editor scripts
        wp_enqueue_script(
            'light-editor',
            \Light\assetURL('scripts/editor-scripts.js', true),
            ['wp-blocks', 'wp-dom'],
            '',
            true
        );

        if (defined('LIGHT_FONTS') && !empty('LIGHT_FONTS')) {
            foreach (LIGHT_FONTS as $font) {
                $handle = 'googleFont';
                if ($font['rel'] === 'preconnect') {
                    $handle = 'preconnect-' . rand(1, 500);
                }
                wp_enqueue_style(
                    $handle,
                    $font['href'],
                    [],
                    ''
                );
            }
        }
    }

    public static function adminAssets(): void
    {
        //* Admin scripts
        wp_enqueue_script(
            'light-admin',
            \Light\assetURL('scripts/admin-scripts.js', true)
        );
    }

    /**
     * removeVer
     *
     * remove version from enqueued
     *
     * @param  mixed $src
     * @return string
     */
    public static function removeVer(string $src): string
    {
        if (strpos($src, '?ver=')) {
            $src = remove_query_arg('ver', $src);
        }

        return $src;
    }

    /**
     * assetsLoad
     *
     * enqueues styles & scripts
     *
     * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
     * @param  mixed $src
     * @return string
     */
    public static function assetsLoad(): void
    {
        //* If in dashboard enqueue style.css only
        if (is_admin()) {
            wp_enqueue_style('light-stylesheet', get_stylesheet_uri());
            return;
        }

        //* Enqueue main.css
        wp_enqueue_style('light-styles', \Light\assetURL('styles/main.css', true), [], false, 'screen');

        //* Build script dependencies
        $script_dependencies = [];

        //* If jQuery is required add it in the dependencies array
        if (defined('LIGHT_JQUERY_REQUIRED') && LIGHT_JQUERY_REQUIRED === true) {
            $script_dependencies[] = 'jquery';
        }

        //* If there are styles to add, enqueue them
        if (defined('LIGHT_STYLES') && LIGHT_STYLES) {
            foreach (LIGHT_STYLES as $handle => $styleUrl) {
                wp_enqueue_style($handle, $styleUrl);
            }
        }

        //* If there are script to add, enqueue them in the footer
        if (defined('LIGHT_SCRIPTS') && LIGHT_SCRIPTS) {
            foreach (LIGHT_SCRIPTS as $script) {
                wp_enqueue_script($script['handle'], $script['url'], $script['deps'], null, true);
            }
        }

        //* Register main.js
        wp_register_script('light-scripts', \Light\assetURL('scripts/main.js', true), $script_dependencies, '', true);

        //* If ajax is required localize it with variables
        if (defined('LIGHT_AJAX_REQUIRED') && LIGHT_AJAX_REQUIRED === true) {
            wp_localize_script('light-scripts', 'lightVars', array(
                'restUrl'   => rest_url(),
                'homeUrl'   => home_url(),
                'restNonce' => wp_create_nonce('wp_rest')
            ));
        }

        //* Enqueue comment-reply if needed
        if (defined('LIGHT_COMMENTS') && LIGHT_COMMENTS === true && is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        if (defined('LIGHT_GOOGLE_API_KEY') && $googleApiKey = LIGHT_GOOGLE_API_KEY !== '') {
            $post = get_post();
            if (has_blocks($post->post_content)) {
                $blocks = parse_blocks($post->post_content);
                foreach ($blocks as $block) {
                    $blockFields = $block['attrs'];
                    if (!empty($blockFields)) {
                        foreach ($blockFields['data'] as $fieldName => $fieldContent) {
                            if ($fieldName == 'map' || $fieldName == 'maps') {
                                wp_enqueue_script(
                                    'googleMap',
                                    "https://maps.googleapis.com/maps/api/js?key=$googleApiKey",
                                    [],
                                    null,
                                    true
                                );
                                break 2;
                            }
                        }
                    }
                }
            }
        }

        //* Enqueue main.js
        wp_enqueue_script('light-scripts');
    }

    /**
     * removejQueryMigrate
     *
     * @param  mixed $scripts
     * @return void
     */
    public static function removejQueryMigrate(&$scripts): void
    {
        if (is_admin() === false && LIGHT_REMOVE_JQUERY_MIGRATE === true) {
            $scripts->remove('jquery');
            $scripts->add('jquery', false, array('jquery-core'), '1.12.4');
        }
    }

    /**
     * movejQueryToFooter
     *
     ** Moves jQuery to footer if needed
     * ? https://wordpress.stackexchange.com/questions/173601/enqueue-core-jquery-in-the-footer/240612#240612
     *
     * @param  mixed $wp_scripts
     * @return void
     */
    public static function movejQueryToFooter($wp_scripts): void
    {
        if (is_admin() === false && LIGHT_JQUERY_IN_FOOTER === true) {
            $wp_scripts->add_data('jquery', 'group', 1);
            $wp_scripts->add_data('jquery-core', 'group', 1);
        }
    }

    /**
     * javascriptDetection
     *
     ** Adds js class to <html> if js is detected
     *
     * @return void
     */
    public static function javascriptDetection(): void
    {
        echo "<script>(function(html){html.className = " .
        "html.className.replace(/\bno-js\b/g,'js')})(document.documentElement);</script>\n";
    }

    /**
     * preloadThemeAssets
     *
     ** Outputs <link rel="preload"> in the head
     ** for assets to preload
     *
     * @return void
     */
    public static function preloadThemeAssets(): void
    {
        if (defined('LIGHT_PRELOAD_ASSETS')) {
            $defaults = [
                'rel'        => 'preload',
                'href'        => '',
                'importance'  => 'low',
                'type'        => 'font/woff2',
                'as'          => 'font',
                'crossorigin' => 'anonymous',
            ];

            foreach (LIGHT_PRELOAD_ASSETS as $key => $value) {
                $atts = wp_parse_args($value, $defaults);

                if (!empty($atts['href'])) {
                    echo "<link " . \Light\buildAttributes($atts) . ">\n";
                }
            }
        }
    }

    public static function filterEditorFonts($html, $handle)
    {
        if (strpos($handle, 'preconnect-') !== false) {
            return str_replace("rel='stylesheet'", "rel='preconnect'", $html);
        }
        return $html;
    }
}
