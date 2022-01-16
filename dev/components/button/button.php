<?php

[
    'type'           => $type,
    'sectionBgColor' => $sectionBgColor,
    'size'           => $size,
    'link'           => $link,
    'label'          => $label,
] = $args;

if ($link && $label && $type) { ?>
    <a href="<?= $link; ?>" class="button button--<?= $type; ?> <?= $size ?: null; ?>">
        <?php if ('purple' === $type || 'white' === $type) { ?>
            <span class="outline"></span>
            <span class="section-bg-color back-<?= $sectionBgColor; ?>"></span>
        <?php } ?>

        <?php if ('white' === $type) { ?>
            <span class="text <?= $sectionBgColor; ?>"><?= $label; ?></span>
        <?php } else { ?>
            <span class="text"><?= $label; ?></span>
        <?php } ?>
        <?php if ('text-link' === $type) {
            echo Light\svg('/wp-content/uploads/2022/01/long-arrow-alt-right.svg');
        } ?>
    </a>
<?php } ?>
