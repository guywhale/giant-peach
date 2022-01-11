<?php

namespace Light\WordPress;

class EditHomepage
{
    /**
     * init
     *
     ** Add edit-homepage link to WP admin menu
     *
     * @return void
     */
    public static function init(): void
    {
        if (!is_admin()) {
            return;
        }

        //* Add custom filter to global WP admin submenu.
        add_action('admin_head', [__CLASS__, 'addGlobalWPAdminSubmenuFilter'], 15);
        //* Add the homepage edit link.
        add_filter('light/wordpress/edithomepage/submenu', [__CLASS__, 'addHomepageEditLink']);
    }

    /**
     * addGlobalWPAdminSubmenuFilter
     *
     ** Adding a filter to a WP global is not recommended
     ** But this approach is the best for now
     ** Enhancements to the menu API have been suggested on trac
     * @link: https://core.trac.wordpress.org/ticket/12718
     * @link: https://core.trac.wordpress.org/ticket/39050
     *
     * @return void
     */
    public static function addGlobalWPAdminSubmenuFilter(): void
    {
        global $submenu;

        $submenu = apply_filters('light/wordpress/edithomepage/submenu', $submenu);
    }

    /**
     * addHomepageEditLink
     *
     ** Add homepage edit link to WP admin menu
     *
     * @param  mixed $submenu Array of WP admin menu items
     * @return array
     */
    public static function addHomepageEditLink($submenu): array
    {
        //* If no static homepage return
        if (get_option('show_on_front') !== 'page') {
            return $submenu;
        }

        $homepageID = get_option('page_on_front', 0);

        //* If homepageID doesn't exist return
        if (empty($homepageID)) {
            return $submenu;
        }

        //* Get page edit URL.
        $homepageEditLink = \get_edit_post_link($homepageID);

        //* If no edit link return
        if (empty($homepageEditLink)) {
            return $submenu;
        }

        //* Create edit link array
        $editHomepageMenuArray = [
            __('Edit Homepage', 'light'),
            'edit_pages',
            $homepageEditLink,
        ];

        //* Add edit link.
        $submenu['edit.php?post_type=page'][] = $editHomepageMenuArray;

        return $submenu;
    }
}
