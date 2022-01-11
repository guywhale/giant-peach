<?php

/**
 ** Action for rest api functionality
 ** Methods specifies which http method will reach this endpoint
 ** Callback specifies the function called when reaching the endpoint
 */

add_action('rest_api_init', function () {
    register_rest_route('light/v1', '/endpoint/', [
        'methods'  => 'POST',
        'callback' => 'restFunction'
    ]);
});

function restFunction($request)
{
    $params = $request->get_params();

    $response = new WP_REST_Response([
        'status' => 200,
        'data'   => [],
    ]);

    return $response;
}
