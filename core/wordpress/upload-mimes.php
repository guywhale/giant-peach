<?php

namespace Light\WordPress;

class UploadMimes
{
    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        add_filter('upload_mimes', [__CLASS__, 'extend']);
    }

    /**
     * extend
     *
     ** Add types defined in config
     *
     * @param  mixed $mime_types
     * @return array
     */
    public static function extend(array $mime_types = []): array
    {
        global $LIGHT_MIME_TYPES;

        if (is_array($LIGHT_MIME_TYPES)) {
            foreach ($LIGHT_MIME_TYPES as $key => $value) {
                $mime_types[$key] = $value;
            }
        }

        return $mime_types;
    }
}
