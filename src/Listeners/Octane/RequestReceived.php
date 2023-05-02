<?php

namespace Elwafa\LaravelRequestTracker\Listeners\Octane;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Octane\Events\RequestReceived as OctaneRequestReceived;

class RequestReceived
{
    private string $trackerId;

    /**
     * Handle the event.
     * @param OctaneRequestReceived $event
     * @return void
     */
    public function handle(OctaneRequestReceived $event): void
    {
        if (!config('laravel-request-tracker.enabled')) {
            return;
        }

        $this->trackerId = Str::uuid()->toString();

        $this->sendLog($this->prepareRequestData($event->request));

        $event->request->merge([
            config('laravel-request-tracker.identification_response_name') => $this->trackerId
        ]);
    }

    private function sendLog(array $tracker): void
    {
        try {
            $client = new Client();
            $client->request('post', config('laravel-request-tracker.url'), [
                'json' => $tracker,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'API-KEY' => config('laravel-request-tracker.api_key'),
                ],
            ]);
        } catch (Exception $exception) {
            Log::error('can not send log to logging', [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);
        } catch (GuzzleException $e) {
            Log::error('Guzzle exception can not send log to logging', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /*
    *  Prepare data to send to logging
    *  @return array
    */
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

}
