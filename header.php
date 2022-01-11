<?php

$siteManifest = \Light\assetContent('general/site.webmanifest', 'json');

?>
<!DOCTYPE html>
<html lang="en" class='no-js'>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="manifest" href="<?php echo \Light\assetURL('general/site.webmanifest'); ?>">
    <meta name="theme-color" content="<?php echo esc_attr($siteManifest['theme_color']); ?>"/>
    <?php if (defined('LIGHT_FONTS') && !empty('LIGHT_FONTS')) {
        foreach (LIGHT_FONTS as $font) { ?>
            <link rel="<?= $font['rel']; ?>" href="<?= $font['href']; ?>">
        <?php }
    } ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?= \Light\render('build/components/skip-link'); ?>
    <?= \Light\render('build/components/navigation'); ?>

