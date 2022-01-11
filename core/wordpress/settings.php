<?php

namespace Light\WordPress;

class Settings
{

    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('after_setup_theme', [__CLASS__, 'setup']);
        add_action('after_setup_theme', [__CLASS__, 'contentWidth']);
    }

    /**
     * setup
     *
     * Adding theme support
     *
     * @return void
     */
    public static function setup(): void
    {
        //* Make theme available for translation
        //? @link https://codex.wordpress.org/Function_Reference/load_theme_textdomain
        load_theme_textdomain('light', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        // @link https://codex.wordpress.org/Automatic_Feed_Links
        //add_theme_support( 'automatic-feed-links' );

        //* Let WordPress manage the document title.
        //? @link http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
        add_theme_support('title-tag');

        //* HTML5 markup support
        //? @link http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
    }

    /**
     * contentWidth
     *
     * Maximum content width definition
     *
     * @return void
     */
    public static function contentWidth(): void
    {
        //* Sets the maximum allowed width for content,
        //* So images are rendered properly
        if (defined('LIGHT_CONTENT_WIDTH')) {
            $GLOBALS['content_width'] = LIGHT_CONTENT_WIDTH;
        } else {
            $GLOBALS['content_width'] = 1200;
        }
    }
}
