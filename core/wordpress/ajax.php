<?php

namespace Light\Wordpress;

class Ajax
{
    public static function init(): void
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'ajaxAssets']);
        add_action('init', [__CLASS__, 'ajaxFunctions']);
    }

    public static function ajaxAssets(): void
    {
        if (defined('LIGHT_AJAX_REQUIRED') && LIGHT_AJAX_REQUIRED === true) {
            $postId = \get_the_ID();
            $ajaxPost = \get_post($postId);
            if (has_blocks($ajaxPost->post_content)) {
                $blocks = \parse_blocks($ajaxPost->post_content);
                $blocks = array_column($blocks, 'attrs');
                foreach ($blocks as $block) {
                    if (array_key_exists('data', $block)) {
                        if (array_key_exists('data', $block['data'])) {
                            if ($block['data']['ajax'] == 1) {
                                $blockName = str_replace('acf/', '', $block['name']);
                                if (\Light\fileFound('scripts/' . $blockName . '.js')) {
                                    wp_enqueue_script(
                                        'light-' . $blockName,
                                        \Light\assetUrl('scripts/' . $blockName . '.js', true),
                                        ['jquery'],
                                        '',
                                        true
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public static function ajaxFunctions(): void
    {
        $ajax = get_template_directory() . '/app/ajax.php';

        if (file_exists($ajax)) {
            if (defined('LIGHT_AJAX_REQUIRED') && LIGHT_AJAX_REQUIRED === true) {
                require_once get_template_directory() . '/app/ajax.php';
            }
        }
    }
}
