<?php

/**
 * Template Name: Blocks
 */

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();

        echo \Light\render(
            'build/components/main',
            [
                'content' => apply_filters('the_content', get_the_content()),
            ]
        );
    }
}

get_footer();
