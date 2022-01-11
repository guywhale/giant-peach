<?php

/**
 ** Column component
 ** $args['col'] = class to output on wrapper div
 ** $args['content'] = content inside wrapper div
 */

add_filter('light/render/build/components/column', function ($args) {
    $col = $args['col'] ?? 'col-auto';
    $args['col'] = $col;
    return $args;
});
