<?php

$blockArgs = [
    'name'            => 'three-columns',
    'title'           => 'Three Columns block',
    'description'     => 'Displays text and three columns',
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
        echo \Light\render('build/components/three-columns', $args);
    },
];

acf_register_block_type($blockArgs);
