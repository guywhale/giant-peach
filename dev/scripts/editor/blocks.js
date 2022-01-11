/* global wp */

//* Unregister embed variants not present in the list
wp.domReady(() => {
    const allowedEmbedVariants = ['youtube', 'vimeo'];

    wp.blocks.getBlockVariations('core/embed').forEach(variant => {
        if (!allowedEmbedVariants.includes(variant.name)) {
            wp.blocks.unregisterBlockVariation('core/embed', variant.name);
        }
    });
});

//* Unregister unwanted core block styles.
wp.domReady(() => {
    wp.blocks.unregisterBlockStyle('core/button', 'default');
    wp.blocks.unregisterBlockStyle('core/button', 'fill');
    wp.blocks.unregisterBlockStyle('core/button', 'outline');
    wp.blocks.unregisterBlockStyle('core/button', 'squared');

    wp.blocks.unregisterBlockStyle('core/image', 'default');
    wp.blocks.unregisterBlockStyle('core/image', 'rounded');

    wp.blocks.unregisterBlockStyle('core/quote', 'default');
    wp.blocks.unregisterBlockStyle('core/quote', 'large');

    wp.blocks.unregisterBlockStyle('core/separator', 'default');
    wp.blocks.unregisterBlockStyle('core/separator', 'wide');
    wp.blocks.unregisterBlockStyle('core/separator', 'dots');
});

// Unregister unwanted core blocks.
wp.domReady(() => {
    // A list of blocks to disable in the editor.
    const disabledBlocks = [
        'core/gallery',
        'core/archives',
        'core/audio',
        'core/calendar',
        'core/categories',
        'core/code',
        'core/columns',
        'core/column',
        'core/file',
        'core/media-text',
        'core/latest-comments',
        'core/latest-posts',
        'core/more',
        'core/nextpage',
        'core/preformatted',
        'core/pullquote',
        'core/rss',
        'core/search',
        'core/social-links',
        'core/social-link',
        'core/spacer',
        'core/subhead',
        'core/tag-cloud',
        'core/table',
        'core/text-columns',
        'core/video',
        'core/verse',
    ];

    for (const block of disabledBlocks) {
        wp.blocks.unregisterBlockType(block);
    }
});
