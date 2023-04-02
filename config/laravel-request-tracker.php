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
    'main_project_name' => env('LARAVEL_REQUEST_TRACKER_MAIN_PROJECT_NAME', 'our-edu'),

    /*
     * The sub name of the project and should be identified with the logging service
     *
     * */
    'project_name' => env('LARAVEL_REQUEST_TRACKER_PROJECT_NAME', 'dashboard'),

    /*
     * The API KEY to send the request to the logging service
     *
     * */
    'api_key' => env('LARAVEL_REQUEST_TRACKER_API_KEY', '254b7246-10e6-42b7-8b0a-143385eb82f4'),

    /*
     * The URL to send the request to the logging service
     *
     * */
    'url' => env('LARAVEL_REQUEST_TRACKER_URL', 'https://api.system.ouredu.net/logs/api/v1/http-logger/'),

    /*
     * The Identification name with merged with request data to be identified with the logging service in response
     * */
    'identification_response_name' => env('LARAVEL_REQUEST_TRACKER_IDENTIFICATION_RESPONSE_NAME', 'laravel-request-tracker'),
];
