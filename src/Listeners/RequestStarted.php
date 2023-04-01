<?php

namespace Elwafa\LaravelRequestTracker\Listeners;

use Guzzle\Http\Client;
use Illuminate\Routing\Events\Routing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RequestStarted
{


    /*
     * @var Routing $event
     * */
    private Routing $event;

    /*
     * @var string
     * a unique id for each request
     * */
    private string $trackerId;

    public function handle(Routing $event)
    {
        if (!config('laravel-request-tracker.enable')) {
            return;
        }

        $this->event = $event;

        $this->trackerId = Str::uuid()->toString();


        $this->sendLog($this->prepareRequestData());

        $this->defineIdentificationForResponse();
    }


    /*
     * Send log to logging
     * @param array $tracker
     * */
    private function sendLog(array $tracker) : void
    {
        try {
            $client = new Client();
            $client->post(config('laravel-request-tracker.url'), [
                'json' => $tracker,
            ], [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'API-KEY' => config('laravel-request-tracker.api_key')
                ],
            ])->send();
        } catch (\Exception $exception) {
            Log::error("can not send log to logging", [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);
        }
    }

    /*
     *  prepare data to send to logging
     *  @return array
     * */
    private function prepareRequestData() : array
    {
        return [
            'tracker_request_response_id' => $this->trackerId,
            'tracker_main_project_name' => config('laravel-request-tracker.main_project_name'),
            'tracker_project_name' => config('laravel-request-tracker.project_name'),
            'tracker_time' => now()->timezone('UTC')->format("Y-m-d H:i:s.u T"),
            'tracker_type' => 'request',
            'tracker_data' => [
                'request' => $this->event->request->all(),
                'url' => $this->event->request->url(),
                'method' => $this->event->request->method(),
                'ip' => $this->event->request->ip(),
                'userAgent' => $this->event->request->userAgent(),
                'headers' => $this->event->request->headers->all(),
                'cookies' => $this->event->request->cookies->all(),
                'query' => $this->event->request->query->all(),
                'content' => $this->event->request->except($this->event->request->query->keys()),
                'user_id' => $this->event->request->user()->uuid ?? null,
            ],
        ];
    }


    /*
     *  define identification for response
     * */
    private function defineIdentificationForResponse() : void
    {
        $this->event->request->merge([config('laravel-request-tracker.identification_response_name') => $this->trackerId]);
    }
}