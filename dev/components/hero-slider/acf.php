<?php

$blockArgs = [
    'name'            => 'hero-slider',
    'title'           => 'Hero Slider block',
    'description'     => 'Hero header slier',
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
        echo \Light\render('build/components/hero-slider', $args);
    },
];

acf_register_block_type($blockArgs);
