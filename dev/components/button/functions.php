<?php

add_filter('light/render/build/components/button', function ($args) {
    if ($args['size']) {
        if ('small' === $args['size']) {
            $args['size'] = 'button--small';
        } elseif ('medium' === $args['size']) {
            $args['size'] = 'button--medium';
        } elseif ('large' === $args['size']) {
            $args['size'] = 'button--large';
        }
    }

    return $args;
});
