<?php

/**
 * Template Name: Page Builder
 */

get_header();
?>

<div class="site-main">
    <?php while (have_posts()) {
        the_post();
        echo \Light\render('template-parts/content-pagebuilder');
    } ?>
</div>

<?php
get_footer();
?>
