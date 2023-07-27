<?php

namespace Elwafa\LaravelRequestTracker\Listeners;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RequestHandled
{
    private \Illuminate\Foundation\Http\Events\RequestHandled $event;

    private ?string $trackerId;

    /**
     * @return void
     *
     * @throws GuzzleException
     */
    public function handle(\Illuminate\Foundation\Http\Events\RequestHandled $event)
    {
        if (! config('laravel-request-tracker.enabled')) {
            return;
        }
        $this->event = $event;
        $this->trackerId = $event->request->get(config('laravel-request-tracker.identification_response_name'));
        if (! $this->trackerId) {
            $this->trackerId = Str::uuid();
            (new RequestStarted())->handleNotStartedEvent($event->request, $this->trackerId);
        }
        $responseData = $this->prepareRequestData();
        $this->sendLog($responseData);
    }

    /**
     * Send log to logging
     *
     * @throws GuzzleException
     */
    private function sendLog(array $tracker): void
    {
        try {
            $client = new Client();
            $client->request('PUT', config('laravel-request-tracker.url'), [
                'json' => $tracker,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'API-KEY' => config('laravel-request-tracker.api_key'),
                ],
            ]);
        } catch (\Exception $exception) {
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

    private function prepareRequestData(): array
    {
        return [
            'tracker_request_response_id' => $this->trackerId,
            'tracker_main_project_name' => config('laravel-request-tracker.main_project_name'),
            'tracker_project_name' => config('laravel-request-tracker.project_name'),
            'tracker_time' => now()->timezone('UTC'),
            'tracker_type' => 'response',
            'tracker_data' => [
                'response' => $this->event->response->getContent(),
                'redirect' => $this->event->response->isRedirection(),
                'response_header' => $this->event->response->headers->all(),
                'status' => $this->event->response->getStatusCode(),
                'content_type' => $this->event->response->headers->get('content-type'),
            ],
        ];
    }
}
