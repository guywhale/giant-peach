<?php

$blockArgs = [
    'name'            => 'offer',
    'title'           => 'Offer block',
    'description'     => 'Block used to display offer text',
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
        echo \Light\render('build/components/offer', $args);
    },
];

acf_register_block_type($blockArgs);
