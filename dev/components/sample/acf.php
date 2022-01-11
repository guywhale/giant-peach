<?php

/**
 ** Register block for acf
 ** @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
 */

$blockArgs = [
    'name'            => 'sample',
    'title'           => 'Sample block',
    'description'     => 'Block used to display text',
    'category'        => 'light-blocks',
    'icon'            => 'schedule',
    'post_types'      => [],
    'mode'            => 'auto',
    'align'           => '',
    'supports'        => [],
    'example'         => [
        'attributes'  => [
            'mode'    => 'preview',
            'data'    => [],
        ],
    ],
    'render_callback' => function ($block) {
        $args = \Light\Wordpress\Gutenberg::router($block['data'], $block);
        echo \Light\render('build/components/sample', $args);
    },
];

acf_register_block_type($blockArgs);
