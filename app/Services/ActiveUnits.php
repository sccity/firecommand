<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ActiveUnits
{
    public function getActiveUnits($call_id)
    {
        $apiUrl = config('services.api.url') . '/active/units?callid=' . $call_id . '&token=' . config('services.api.token');
        $response = Http::withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ])->get($apiUrl);

        if ($response->failed()) {
            Log::error('API request failed', [
                'url' => $apiUrl,
                'response' => $response->body(),
            ]);
            return [
                'error' => 'Failed to fetch data',
                'url' => $apiUrl,
                'call_id' => $call_id,
            ];
        }

        $units = $response->json();
        Log::info('API response', ['data' => $units]);

        if (empty($units)) {
            Log::warning('No units found', [
                'url' => $apiUrl,
                'response' => $response->body(),
            ]);
            return [
                'error' => 'No units found',
                'url' => $apiUrl,
                'call_id' => $call_id,
            ];
        }

        return [
            'units' => $units,
            'call_id' => $call_id,
        ];
    }
}