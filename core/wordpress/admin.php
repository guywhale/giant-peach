<?php

namespace Light\WordPress;

class Admin
{
    public static function init(): void
    {
        add_action('init', [__CLASS__, 'changeRoleName']);
        add_filter('editable_roles', [__CLASS__, 'filterEditableRoles']);
        add_filter('get_user_option_admin_color', [__CLASS__, 'adminColor']);
        add_filter('admin_footer_text', [__CLASS__, 'footerAdmin']);
        add_filter('admin_bar_menu', [__CLASS__, 'replaceHowdy']);
        add_action('admin_head', [__CLASS__, 'customTgmStyle']);

        if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
            add_action('admin_notices', [__CLASS__, 'themeActivationNotice']);
        }

        self::addClientAdminRole();

        if (class_exists('acf')) {
            add_filter('acf/format_value/type=textarea', 'do_shortcode');
        }
    }

    /**
     * addClientAdminRole
     *
     * Adds Client Admin as role
     *
     * @link https://developer.wordpress.org/reference/functions/add_role/
     * @return void
     */
    public static function addClientAdminRole()
    {
        add_role(
            'client_admin',
            __('Client Admin'),
            [
                'read'           => true,
                'publish_posts'  => true,
                'edit_posts'     => true,
                'delete_posts'   => true,
                'edit_published_posts' => true,
                'edit_others_posts'  => true,
                'read_private_posts' => true,
                'edit_private_posts' => true,
                'delete_private_posts' => true,
                'manage_categories' => true,
                'upload_files' => true,
                'edit_attachments' => true,
                'delete_attachments' => true,
                'read_others_attachments' => true,
                'edit_others_attachments' => true,
                'delete_others_attachments' => true,
                'publish_pages' => true,
                'edit_pages' => true,
                'delete_pages' => true,
                'edit_published_pages' => true,
                'delete_published_pages' => true,
                'edit_others_pages' => true,
                'delete_others_pages' => true,
                'read_private_pages' => true,
                'edit_private_pages' => true,
                'delete_private_pages' => true,
                'moderate_comments' => true,
                'activate_plugins' => true,
                'install_plugins' => true,
                'update_plugins' => true,
                'list_users' => true,
                'create_users' => true,
                'unfiltered_html' => true,
                'manage_links' => true,
                'level_0' => true,
                'level_1' => true,
                'level_2' => true,
                'level_3' => true,
                'level_4' => true,
                'level_5' => true,
                'level_6' => true,
                'level_7' => true,
                'publish_blocks' => true,
                'edit_blocks' => true,
                'delete_blocks' => true,
                'edit_published_blocks' => true,
                'delete_published_blocks' => true,
                'edit_others_blocks' => true,
                'delete_others_blocks' => true,
                'read_private_blocks' => true,
                'edit_private_blocks' => true,
                'delete_private_blocks' => true,
                'create_blocks' => true,
                'read_blocks' => true,
                'edit_comment' => true,
            ],
        );
    }

    /**
     * changeRoleName
     *
     * Changes admin role name to SoBold admin
     *
     * @return void
     */
    public static function changeRoleName()
    {
        global $wp_roles;

        if (!isset($wp_roles)) {
            $wp_roles = new WP_Roles();
        }
        $wp_roles->roles['administrator']['name'] = 'SoBold Admin';
        $wp_roles->role_names['administrator'] = 'SoBold Admin';
    }

    /**
     * filterEditableRoles
     *
     * Removes admin role from editable list
     *
     * @param  mixed $all_roles
     * @return void
     */
    public static function filterEditableRoles($all_roles)
    {
        if (!is_super_admin(get_current_user_id())) {
            unset($all_roles['administrator']);
        }
        return $all_roles;
    }

    /**
     * themeActivationNotice
     *
     * When theme is activated
     * prints notice for crawling checkbox
     *
     * @return void
     */
    public static function themeActivationNotice()
    {
        $notice = <<<HTML
        <div class="updated notice is-dismissible">
            <p>
                <strong>Important!</strong>
                - Remember to mark the site as non-indexable to search engines when in development.</p>
        </div>
        HTML;

        echo $notice;
    }

    /**
     * adminColor
     *
     * Change wordpress theme color to default
     *
     * @return void
     */
    public static function adminColor()
    {
        $env = \Light\resolve('.env.js');

        if (file_exists($env)) {
            return 'default';
        }
    }

    /**
     * footerAdmin
     *
     * Adds company text to dashboard footer
     *
     * @return void
     */
    public static function footerAdmin()
    {
        $footerText = '<span id="footer-thankyou">Website Developed by
         <a href="https://www.sobold.co.uk" target="_blank">SoBold</a>
         </span> | Light ⚡ Version ' . \Light\version();

        echo $footerText;
    }

    /**
     * replaceHowdy
     *
     * Replaces howdy text from admin bar
     *
     * @param  mixed $wp_admin_bar
     * @return void
     */
    public static function replaceHowdy($wp_admin_bar)
    {
        date_default_timezone_set('Europe/London');
        $Hour = date('G');
        $msg = "";
        if ($Hour >= 5 && $Hour <= 11) {
            $msg = "Good morning,";
        } elseif ($Hour >= 12 && $Hour <= 18) {
            $msg = "Good afternoon,";
        } elseif ($Hour >= 19 || $Hours <= 4) {
            $msg = "Good evening,";
        }
        $my_account = $wp_admin_bar->get_node('my-account');
        $newtitle = str_replace('Howdy,', $msg, $my_account->title);
        $wp_admin_bar->add_node(
            [
                'id' => 'my-account',
                'title' => $newtitle,
            ]
        );
    }

    /**
     * customTgmStyle
     *
     * Changes style for Tgm notices
     *
     * @return void
     */
    public static function customTgmStyle()
    {
        echo '<style>
        #setting-error-tgmpa {
            border-left-color: #00c1c4;
        }
        #setting-error-tgmpa a {
            color: #00c1c4;
            text-decoration: none;
        }
        </style>';
    }
}
