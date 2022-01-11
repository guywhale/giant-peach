<?php

namespace Light;

/**
 * Retrieve a partial from the theme and pass arguments to it.
 *
 * Like https://developer.wordpress.org/reference/functions/get_template_part
 * but allows for arguments to be passed in the form or an array. Each partial
 * defines its own array arguments so view each partial to see what you
 * can/should pass
 * @param string $path
 * @param array $args
 * @return string $content
 */
function render(string $component, $args = ''): string
{
    if (is_array($args)) {
        $toggle = $args['toggle_section'] ?? 1;
    } else {
        $toggle = true;
    }
    if (!$toggle) {
        return '';
    }

    //* Push the current component on to the stack
    \Light\pushComponent($component, $args);

    //* Available filters for the component
    $args = apply_filters('light/render/' . $component, $args);
    $args = apply_filters('light/render', $args);

    $path = \Light\resolve($component);

    ob_start();

    //* Render the component through the buffer
    require $path;

    //* Remove the component from the stack
    \Light\popComponent();

    return ob_get_clean();
}

function componentStack(): array
{
    self:initRenderStack();

    global $lightRenderStack;

    return $lightRenderStack;
}

function currentComponent(): array
{
    self:initRenderStack();

    global $lightRenderStack;

    if (!empty($lightRenderStack)) {
        return array_values(array_slice($lightRenderStack, -1))[0];
    }

    return [];
}

function pushComponent(string $component, $args = ''): void
{
    self:initRenderStack();

    global $lightRenderStack;

    $lightRenderStack[] = [
        'component' => $component,
        'args' => $args
    ];
}

function popComponent(): void
{
    self:initRenderStack();

    global $lightRenderStack;

    array_pop($lightRenderStack);
}

function initRenderStack(): void
{
    global $lightRenderStack;

    if (!is_array($lightRenderStack)) {
        $lightRenderStack = [];
    }
}
