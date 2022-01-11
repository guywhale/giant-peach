<?php

namespace Light;

/**
 * Take a path and turn it in to a legitimate file path. Allows for a child
 * theme to implement a new version of the partial
 * @param string $path
 * @return string
 */
function resolve(string $path): string
{
    // Resolve to get a full path
    $path = \Light\themePath($path);

    // If its a directory, we will load up the index.php file. This imitates
    // node.js with import statements.
    if (is_dir($path)) {
        $path = $path . '/index.php';
    }

    // Pull apart the full path
    $pathinfo = \pathinfo($path);

    // Check if there is an extension. If not add one
    if (isset($pathinfo['extension']) !== true) {
        $path = $path . '.php';
    }

    return $path;
}

function assetContent(string $path, string $type = 'string')
{
    $content = trim(file_get_contents(\Light\assetPath($path)));

    if ($type === 'json') {
        return json_decode($content, true);
    }

    return $content;
}

function assetPath(string $asset, bool $manifest = false): string
{
    if ($manifest === true) {
        $asset = \Light\extractAsset($asset);
    }

    return \Light\themePath(
        \Light\assetDir() . $asset
    );
}

function assetURL(string $asset, bool $manifest = false): string
{
    if ($manifest === true) {
        $asset = \Light\extractAsset($asset);
    }

    return \Light\themeURL(
        \Light\assetDir() . $asset
    );
}

function extractAsset(string $asset): string
{
    $path = \Light\assetContent('manifest.json', 'json');

    $parts = explode('/', $asset);

    foreach ($parts as $key => $part) {
        $path = $path[$part];
    }

    return $path;
}

function assetDir(): string
{
    return 'build/';
}

function themeURL(string $path = ''): string
{
    //* Supports child theme overriding
    //? https://developer.wordpress.org/reference/functions/get_stylesheet_directory_uri/
    //? Returns https://example.com/wp-content/themes/themename
    return get_stylesheet_directory_uri() . '/' . $path;
}

function themePath(string $path = ''): string
{
    //* Supports child theme overriding
    //? https://developer.wordpress.org/reference/functions/get_theme_file_path/
    //? Returns /var/www/html/wp-content/themes/themename
    if ($path !== '') {
        return get_theme_file_path() . '/' . $path;
    }

    return get_theme_file_path();
}

function homeUrl(string $path = ''): string
{
    //? https://developer.wordpress.org/reference/functions/get_home_path/
    return get_home_url() . '/' . $path;
}

function fileFound(string $path): bool
{
    return file_exists(\Light\themePath(\Light\assetDir() . $path));
}
