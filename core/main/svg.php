<?php

namespace Light;

/**
 * Return and possibly output the content of an SVG file in the assets directory
 * @param string $name
 * @param array $args
 * @return string
 */
function svg(string $name, array $args = []): string
{
    $svg = '';

    //* Default attributes
    $args = wp_parse_args($args, [
        'name'          => $name,
        'wrapped'       => false,
        'title'         => '',
        'description'   => '',
        'keepcolors'    => false,
    ]);

    //* Path the path to the SVG
    $svg_path = \Light\svgPath($args['name']);

    if (file_exists($svg_path)) {
        $unique_id = uniqid();

        //* New instance of DOMDocument
        $doc = new \DOMDocument();

        //* Load in the SVG
        $doc->loadXML(file_get_contents($svg_path));

        //* Set a role attribute on the SVG element
        $doc->documentElement->setAttribute('role', 'img');

        if (array_key_exists('keepcolors', $args)) {
            if ($args['keepcolors']) {
                $doc->documentElement->setAttribute('class', 'svg--keepcolors');
            }
        }

        //* Prevent responsive styling and maintain size from width/height attrs
        if (array_key_exists('keepsize', $args)) {
            if ($args['keepsize']) {
                $doc->documentElement->setAttribute('class', 'svg--keepsize');
            }
        }

        //* Add a title if present
        if ($args['title'] !== "") {
            $labelled = [];
            $labelled[] = 'title-' . $unique_id;

            $title = $doc->createElement('title', $args['title']);
            $title->setAttribute('id', 'title-' . $unique_id);

            //* Append title to the SVG
            $doc->firstChild->appendChild($title);

            //* Add a description if present
            if ($args['description'] !== "") {
                $labelled[] = 'description-' . $unique_id;

                $description = $doc->createElement('description', $args['description']);
                $description->setAttribute('id', 'description-' . $unique_id);

                //* Append description to the SVG
                $doc->firstChild->appendChild($description);
            }

            //* Add the attributes to the SVG
            $doc->documentElement->setAttribute('aria-labelledby', implode(' ', $labelled));
        } else {
            $doc->documentElement->setAttribute('aria-hidden', 'true');
        }

        //* Output the svg markup and strip the xml doctype declaration
        $svg = $doc->saveXML($doc->documentElement);

        if ($args['wrapped'] === true) {
            $svg = '<span class="svg-asset svg-asset--' . esc_attr($args['name']) . '">' . $svg . '</span>';
        }
    }

    return $svg;
}

/**
 * Build the path to the SVG asset in the theme
 * @param string $name
 * @return string
 */
function svgPath(string $name): string
{
    return ABSPATH . $name;
}
