<?php

namespace Light\WordPress;

class Cleanup
{
    public static function init(): void
    {
        //* Removes url where emoji svg are hosted
        add_filter('emoji_svg_url', '__return_false');

        add_action('init', [__CLASS__,'headCleanup']);

        //* Remove TinyMCE Emojis
        add_action('init', [__CLASS__,'disableEmoji']);
        add_filter('tiny_mce_plugins', [__CLASS__, 'disableEmojiTinyMCE']);

        //* Don't convert :) to an image
        remove_filter('the_content', [__CLASS__, 'convertSmilies'], 20);

        add_action('wp_footer', [__CLASS__, 'noEmbed']);
        add_action('wp_dashboard_setup', [__CLASS__, 'removeDashboardWidgets']);

        add_filter('wp_head', [__CLASS__,'removeWPWidgetRecentCommentsStyle'], 1);
        add_action('wp_head', [__CLASS__,'removeRecentCommentsStyle'], 1);
        add_filter('galleryStyle', [__CLASS__,'galleryStyle']);
    }

    /**
     * removeDashboardWidgets
     *
     ** Remove widgets from dashboard
     *
     * @return void
     */
    public static function removeDashboardWidgets()
    {
        remove_meta_box('dashboard_primary', 'dashboard', 'side');
        remove_meta_box('dashboard_secondary', 'dashboard', 'side');
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    }

    /**
     * noEmbed
     *
     ** Deregister wp-embed
     *
     * @return void
     */
    public static function noEmbed(): void
    {
        wp_deregister_script('wp-embed');
    }

    /**
     * headCleanup
     *
     ** Clean all unwanted scripts from head
     *
     * @return void
     */
    public static function headCleanup(): void
    {
        //* Remove EditURI link
        remove_action('wp_head', 'rsd_link');

        //* Remove Windows live writer
        remove_action('wp_head', 'wlwmanifest_link');

        //* Remove index link
        remove_action('wp_head', 'index_rel_link');

        //* Remove previous link
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);

        //* Remove start link
        remove_action('wp_head', 'start_post_rel_link', 10, 0);

        //* Remove links for adjacent posts
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

        //* Remove WP version
        remove_action('wp_head', 'wp_generator');
    }

    /**
     * removeWPWidgetRecentCommentsStyle
     *
     ** Remove injected CSS for recent comments widget
     *
     * @return void
     */
    public static function removeWPWidgetRecentCommentsStyle(): void
    {
        if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
            remove_filter('wp_head', 'wp_widget_recent_comments_style');
        }
    }

    /**
     * removeRecentCommentsStyle
     *
     ** Remove injected CSS from recent comments widget
     *
     * @return void
     */
    public static function removeRecentCommentsStyle(): void
    {
        global $wp_widget_factory;
        if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
            remove_action('wp_head', [
                $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
                'recent_comments_style'
            ]);
        }
    }

    /**
     * galleryStyle
     *
     ** Remove injected CSS from gallery
     *
     * @param  mixed $css
     * @return string
     */
    public static function galleryStyle(string $css): string
    {
        return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
    }

    /**
     * disableEmoji
     *
     ** Remove action related to emojis
     *
     * @return void
     */
    public static function disableEmoji(): void
    {
        //* all actions related to emojis
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
    }

    /**
     * disableEmojiTinyMCE
     *
     ** Remove EmojiTynyMCE support
     *
     * @param  mixed $plugins
     * @return array
     */
    public static function disableEmojiTinyMCE($plugins): array
    {
        if (is_array($plugins)) {
            return array_diff($plugins, ['wpemoji']);
        } else {
            return [];
        }
    }
}
