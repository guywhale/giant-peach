<?php

namespace Light;

function version(): string
{
    if (defined('LIGHT_VERSION') && LIGHT_VERSION != '') {
        return LIGHT_VERSION;
    } else {
        return '1.0.0';
    }
}
