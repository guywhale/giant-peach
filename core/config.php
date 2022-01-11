<?php

/**
 ** LIGHT CONFIG ⚡
 */

// phpcs:disable PSR1.Files.SideEffects
define('LIGHT_GOOGLE_API_KEY', '');
define('LIGHT_CONTENT_WIDTH', 1200);
define('LIGHT_JQUERY_REQUIRED', true);
define('LIGHT_JQUERY_IN_FOOTER', true);
define('LIGHT_REMOVE_JQUERY_MIGRATE', true);
define('LIGHT_AJAX_REQUIRED', true);
define('LIGHT_VERSION', '1.0.2');

define('LIGHT_EDITOR_COLORS', [
    [
        'name' => 'Primary',
        'slug' => 'back-primary-1',
        'color' => '#201e50',
    ],
    [
        'name' => 'Secondary',
        'slug' => 'back-secondary-1',
        'color' => '#EDB6A3',
    ],
]);

//* Fonts
define('LIGHT_FONTS', [
        [
            'rel'  => 'preconnect',
            'href' => 'https://fonts.googleapis.com',
        ],
        [
            'rel'  => 'preconnect',
            'href' => 'https://font.gstatic.com',
        ],
        [
            'rel'  => 'stylesheet',
            'href' => 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap',
        ],
]);


//* Images
//* Define an array of extra images sizes for the project
//? ['name', width, height, crop]
$LIGHT_IMAGES = [
    // ['wgd_500', 500, 0, false],
    // ['wgd_1300', 1300, 0, false],
    // This is a fairly common large size we need in projects
    ['super', 1500, 1500, false],
    // Some websites need super high res graphics
    // ['super_duper', 2000, 2000, false],
];

//* Menus
//* Define an array of menus to register
$LIGHT_MENUS = [
    'header' => 'Header',
    'footer' => 'Footer',
];

//* Colors
$LIGHT_COLORS = [
    'primary-1' => '#201e50',
    'secondary-1' => '#EDB6A3',
];

//* Sidebars
//* Define an array of sidebars, off by default
// $LIGHT_SIDEBARS = [
//     [
//         'name'          => esc_html__( 'Sidebar', 'light' ),
//         'id'            => 'sidebar-1',
//         'description'   => esc_html__( 'Add widgets here.', 'light' ),
//         'before_widget' => '<section id="%1$s" class="widget %2$s">',
//         'after_widget'  => '</section>',
//         'before_title'  => '<h4 class="widget-title">',
//         'after_title'   => '</h4>',
//     ]
// ];

//* ACF
$LIGHT_ACF_OPTIONS_PAGES = [
    [
        'title'       => 'General',
        'parent'      => 'Theme settings',
        'parent_slug' => 'theme-settings',
    ],
    [
        'title'       => 'Colors',
        'parent'      => 'Theme settings',
        'parent_slug' => 'theme-settings',
    ],
];

$LIGHT_ACF_OPTIONS_POST_PAGES = [
    [
        'title'       => 'Post options',
        'post_type'   => 'post',
    ],
];

//* Assets to preload
define('LIGHT_PRELOAD_ASSETS', [
    // [
    //     'href' => \Granola\assetURL('fonts/WebFont-Regular.woff2'),
    //     'importance' => 'low',
    //     'type' => 'font/woff2',
    //     'as' => 'font',
    //     'crossorigin' => 'anonymous',
    // ],
]);

define('LIGHT_STYLES', [
    'slick' => '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
]);

define('LIGHT_SCRIPTS', [
    [
        'handle' => 'slick',
        'url'    => '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        'deps'   => ['jquery'],
    ],
]);

//* Mime Types
$LIGHT_MIME_TYPES = [
    // 'svg' => 'image/svg+xml',
    // 'msg  => 'application/vnd.ms-outlook',
    // 'flv  => 'video/x-flv',
    // 'xls  => 'application/application/excel',
    // 'xlsx => 'application/application/vnd.ms-excel',
    // 'tiff => 'image/tiff',
    // 'tif  => 'image/tiff',
    // 'psd  => 'image/photoshop',
    // 'xlsx => 'application/application/vnd.ms-excel',
    // 'swf  => 'application/x-shockwave-flash',
];
