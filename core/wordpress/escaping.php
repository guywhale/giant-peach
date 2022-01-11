<?php

namespace Light\WordPress;

class Escaping
{
    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('wp_kses_allowed_html', [__CLASS__, 'filterWPKsesAllowedHtml'], 10, 2);
    }

    /**
     ** Add iframe to allowed wp_kses_post tags.
     *
     * @param array $tags Allowed tags, attributes, and/or entities.
     * @param string $context Context to judge allowed tags by.
     *
     * @return array The filtered array of allowed tags, attributes, and/or entities.
     */
    public static function filterWPKsesAllowedHtml($tags, $context): array
    {
        if ('post' === $context) {
            $tags['iframe'] = [
                'src' => true,
                'height' => true,
                'width' => true,
                'frameborder' => true,
                'allowfullscreen' => true,
                'loading' => true,
            ];
        }

        return $tags;
    }
}
