<?php

namespace Elwafa\LaravelRequestTracker\Listeners;

use Exception;
use Illuminate\Http\Request;
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
        if (! config('laravel-request-tracker.enabled')) {
            return;
        }

        $this->event = $event;

        $this->trackerId = Str::uuid()->toString();

        $this->sendLog($this->prepareRequestData($this->event->request));

        $this->defineIdentificationForResponse($this->event->request);
    }

    /*
     * Send log to logging
     * @param array $tracker
     * */
    private function sendLog(array $tracker): void
    {
        try {
            $client = new \GuzzleHttp\Client();
            $client->request('post', config('laravel-request-tracker.url'), [
                'json' => $tracker,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'API-KEY' => config('laravel-request-tracker.api_key'),
                ],
            ]);
        } catch (Exception $exception) {
            if (! is_null(config('laravel-request-tracker.log_channel'))) {
                Log::channel(config('laravel-request-tracker.log_channel'))->error('can not send log to logging', [
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => $exception->getTraceAsString(),
                ]);
            }
        }
    }

    /*
     *  prepare data to send to logging
     *  @return array
     * */
    private function prepareRequestData(Request $request): array
    {
        return [
            'tracker_request_response_id' => $this->trackerId,
            'tracker_main_project_name' => config('laravel-request-tracker.main_project_name'),
            'tracker_project_name' => config('laravel-request-tracker.project_name'),
            'tracker_time' => now()->timezone('UTC'),
            'tracker_type' => 'request',
            'tracker_data' => [
                'request' => $request->all(),
                'url' => $request->url(),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'userAgent' => $request->userAgent(),
                'headers' => $request->headers->all(),
                'cookies' => $request->cookies->all(),
                'query' => $request->query->all(),
                'content' => $request->except($request->query->keys()),
                'user_id' => $request->user()->uuid ?? null,
            ],
        ];
    }

    /*
     *  define identification for response
     * */
    private function defineIdentificationForResponse(Request $request): void
    {
        $request->merge([config('laravel-request-tracker.identification_response_name') => $this->trackerId]);
    }

    public function handleNotStartedEvent(Request $request, string $trackerId): void
    {
        $this->trackerId = $trackerId;
        $this->defineIdentificationForResponse($request);
        $this->sendLog($this->prepareRequestData($request));
    }
}
