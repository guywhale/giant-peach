<?php

/**
 ** Component functions file
 ** This file will be used to retrieve data used in the component
 ** Any reusable logic should be outsourced in ./app
 *
 ** To manipulate data use the render filter specific to the component
 */

add_filter('light/render/build/components/sample', function ($args) {
    return $args;
});
