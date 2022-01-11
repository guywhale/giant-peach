<?php

namespace Light\Plugin;

class ACF
{

    /**
     * init
     *
     * @return void
     */
    public static function init(): void
    {
        add_action('acf/init', [__CLASS__, 'optionPages']);
        add_action('acf/init', [__CLASS__, 'optionPostPages']);
        add_action('acf/init', [__CLASS__, 'googleAPIKey']);

        //* Avoid calling filter if not in admin area
        if (\is_admin()) {
            add_filter('acf/load_field/name=background_color', [__CLASS__, 'loadColorFieldChoices']);
            add_filter('acf/load_field/name=ajax', [__CLASS__, 'loadAjaxField']);
            add_filter('acf/load_field/name=toggle_section', [__CLASS__, 'loadToggleField']);
        }

            add_filter('acf/settings/save_json', [__CLASS__, 'saveJsonInConfig']);
            add_filter('acf/settings/load_json', [__CLASS__, 'configAcfJsonLoadPoint']);

        //? Handles disabling Gutenberg on flexible content template
        add_filter('gutenberg_can_edit_post_type', [__CLASS__, 'disableGutenberg'], 10, 2);
        add_filter('use_block_editor_for_post_type', [__CLASS__, 'disableGutenberg'], 10, 2);
    }

    /**
     * saveJsonInConfig
     *
     ** Save new file in config directory
     ** This gets overridden if the field is a component in
     ** core/wordpress/components.php
     *
     * @param  mixed $path
     * @return void
     */
    public static function saveJsonInConfig($path)
    {
        $path = \Light\themePath('config/acf-json');

        return $path;
    }

    /**
     * configAcfJsonLoadPoint
     *
     ** Define new load point for acf json files
     *
     * @param  mixed $paths
     * @return void
     */
    public static function configAcfJsonLoadPoint($paths)
    {
        unset($paths[0]);
        $paths[] = \Light\themePath('config/acf-json');
        return $paths;
    }

    /**
     * optionPages
     *
     * @return void
     */
    public static function optionPages(): void
    {
        global $LIGHT_ACF_OPTIONS_PAGES;

        if (function_exists('acf_add_options_page') && isset($LIGHT_ACF_OPTIONS_PAGES)) {
            if (is_array($LIGHT_ACF_OPTIONS_PAGES) && !empty($LIGHT_ACF_OPTIONS_PAGES)) {
                foreach ($LIGHT_ACF_OPTIONS_PAGES as $page) {
                    if ($page['title'] && $page['parent'] && $page['parent_slug']) {
                        acf_add_options_page([
                            'page_title'  => $page['parent'],
                            'menu_slug'   => $page['parent_slug'],
                        ]);
                        acf_add_options_sub_page([
                            'page_title'  => $page['title'],
                            'parent_slug' => $page['parent_slug'],
                        ]);
                    }
                }
            }
        }
    }

    /**
     * optionPostPages
     *
     * @return void
     */
    public static function optionPostPages(): void
    {
        global $LIGHT_ACF_OPTIONS_POST_PAGES;

        if (function_exists('acf_add_options_page') && isset($LIGHT_ACF_OPTIONS_POST_PAGES)) {
            if (is_array($LIGHT_ACF_OPTIONS_POST_PAGES) && !empty($LIGHT_ACF_OPTIONS_POST_PAGES)) {
                foreach ($LIGHT_ACF_OPTIONS_POST_PAGES as $page) {
                    if ($page['post_type'] && $page['title']) {
                        $args = [
                            'page_title' => $page['title'],
                            'parent'     => 'edit.php?post_type=' . $page['post_type'],
                        ];
                        if ($page['post_type'] == 'post') {
                            $args['parent'] = 'edit.php';
                        }
                        acf_add_options_sub_page($args);
                    }
                }
            }
        }
    }

    /**
     * googleAPIKey
     *
     * @return void
     */
    public static function googleAPIKey(): void
    {
        if (defined('LIGHT_GOOGLE_API_KEY') && LIGHT_GOOGLE_API_KEY != '') {
            acf_update_setting('google_api_key', LIGHT_GOOGLE_API_KEY);
        }
    }

    /**
     * loadColorFieldChoices
     *
     * @param  mixed $field
     * @return array
     */
    public static function loadColorFieldChoices(array $field): array
    {
        global $LIGHT_COLORS;
        $field['type'] = 'button_group';
        $field['choices'] = $LIGHT_COLORS;
        return $field;
    }

    /**
     * loadAjaxField
     *
     * @param  mixed $field
     * @return array
     */
    public static function loadAjaxField(array $field): array
    {
        $field['type'] = 'true_false';
        $field['ui'] = 1;
        $field['default_value'] = 1;
        $field['wrapper']['class'] = 'hideAjaxField';
        return $field;
    }

    /**
     * loadToggleField
     *
     * @param  mixed $field
     * @return array
     */
    public static function loadToggleField(array $field): array
    {
        $field['type'] = 'true_false';
        $field['ui'] = 1;
        $field['default_value'] = 1;
        return $field;
    }

    /**
     * disableGutenberg
     *
     * @param  mixed $can_edit
     * @param  mixed $post_type
     * @return bool
     */
    public static function disableGutenberg(bool $can_edit, string $post_type): bool
    {
        if (!(is_admin() && !empty($_GET['post']))) {
            return $can_edit;
        }

        if (self::disableEditor($_GET['post'])) {
            $can_edit = false;
        }

        return $can_edit;
    }

    /**
     * disableEditor
     *
     * @param  mixed $id
     * @return bool
     */
    public static function disableEditor($id = false): bool
    {
        $excluded_templates = [
            'page-templates/flexible-content.php',
        ];

        if (empty($id)) {
            return false;
        }

        $id = intval($id);
        $template = get_page_template_slug($id);

        return in_array($template, $excluded_templates);
    }
}
