<?php

namespace Light;

/**
 * Builds an HTML attribute string.
 *
 * @param array $attributes An array of HTML attribute key-value pairs.
 * @return string A string of escaped HTML element attributes.
 */
function buildAttributes(array $attributes = []): string
{
    $attributesString = '';

    if (empty($attributes)) {
        return $attributesString;
    }

    foreach ($attributes as $key => $value) {
        if ($value === true) {
            $attributesString .= $key . ' ';
        } elseif (!empty($value)) {
            $attributesString .= $key . '="' . esc_attr($value) . '" ';
        }
    }

    return trim($attributesString);
}
