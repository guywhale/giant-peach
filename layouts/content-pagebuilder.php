<?php

/**
 * Template part for displaying page content in pagebuilder.php
 *
 * SoBold
 */

$layouts = [
    'text',
    'text_image',
];

if (have_rows('page_builder')) {
    while (have_rows('page_builder')) {
        the_row();
        $layout = get_row_layout();
        if (in_array($layout, $layouts)) {
            echo \Light\render('build/components/pagebuilder/' . $layout);
        }
    }
}
