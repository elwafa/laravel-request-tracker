<?php

return [

    /*
     * Enable or disable the request tracker
     *
     * */
    'enabled' => env('LARAVEL_REQUEST_TRACKER_ENABLED', false),

    /*
     * The main Project name to be identified with the logging service
     *
     * */
    'main_project_name' => env('LARAVEL_REQUEST_TRACKER_MAIN_PROJECT_NAME', 'ouredu'),

    /*
     * The sub name of the project and should be identified with the logging service
     *
     * */
    'project_name' => env('LARAVEL_REQUEST_TRACKER_PROJECT_NAME', 'dashboard'),

    /*
     * The API KEY to send the request to the logging service
     *
     * */
    'api_key' => env('LARAVEL_REQUEST_TRACKER_API_KEY', 'API_KEY_2'),

    /*
     * The URL to send the request to the logging service
     *
     * */
    'url' => env('LARAVEL_REQUEST_TRACKER_URL', 'http://localhost:5002/api/v1/http-logger/'),

    /*
     * The Identification name with merged with request data to be identified with the logging service in response
     * */
    'identification_response_name' => env('LARAVEL_REQUEST_TRACKER_IDENTIFICATION_RESPONSE_NAME', 'laravel-request-tracker'),
];
