<?php

//? https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
spl_autoload_register(function ($class) {

    //* Project-specific namespace prefix
    $prefix = 'Light\\';

    $len = strlen($prefix);

    //* Check if class uses namespace prefix
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    //* Base directory for the namespace prefix
    $baseDir = rtrim(__DIR__, 'main/') . '/';

    //* Get the relative class name.
    $relativeClass = substr($class, $len);

    //* Split class name by CamelCase words with hypens for folder/file names
    $name = preg_replace('/([a-z])([A-Z])/', '$1-$2', $relativeClass);

    //* Reverse CamelCase split for WordPress
    $name = str_replace('Word-Press', 'WordPress', $name);

    //* Replace namespace separators with directory separators
    $fileName = strtolower(str_replace('\\', '/', $name));

    //* Construct file path from the base directory and append with '.php'
    $file = $baseDir . $fileName . '.php';

    //* if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
