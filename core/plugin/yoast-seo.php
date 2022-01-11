<?php

namespace Light\Plugin;

class YoastSEO
{

    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        add_filter("wpseo_metabox_prio", [__CLASS__, 'lowerYoastMetaPriority']);
    }

    /**
     * lowerYoastMetaPriority
     *
     * @return string
     */
    public static function lowerYoastMetaPriority(): string
    {
        return "low";
    }
}
