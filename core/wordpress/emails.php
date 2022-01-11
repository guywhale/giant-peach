<?php

namespace Light\WordPress;

class Emails
{
    public static function init(): void
    {
        //* Filter default WordPress transactional email 'from' address.
        add_action('wp_mail_from', [__CLASS__, 'filterWordPressFromEmailAddress']);
        //* Filter default WordPress transactional email 'from' name.
        add_action('wp_mail_from_name', [__CLASS__, 'filterWordPressFromName']);
    }

    /**
     ** Filter the default WordPress 'from' email address.
     *
     * @param string $email Default email address to send from.
     * @return string The filtered email address to send from.
     */
    public static function filterWordPressFromEmailAddress($email): string
    {
        //* Change the default WP email address from 'wordpress@' to 'noreply@'.
        return str_replace('wordpress@', 'noreply@', $email);
    }

    /**
     ** Filter the default WordPress 'from' name.
     *
     * @param string $name Default name to send from ("WordPress");
     * @return string The filtered name to send from.
     */
    public static function filterWordPressFromName($name): string
    {
        return get_bloginfo('name');
    }
}
