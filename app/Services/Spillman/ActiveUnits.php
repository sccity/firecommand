<?php

namespace App\Services\Spillman;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ActiveUnits
{
    public function getActiveUnits($call_id)
    {
        $apiUrl = config('services.api.url') . '/cad/active/units?callid=' . $call_id . '&token=' . config('services.api.token');
        $response = Http::withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ])->get($apiUrl);

        if ($response->failed()) {
            Log::error('Spillman API Request Failed', [
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

        if (empty($units)) {
            Log::warning('No Units Found', [
                'url' => $apiUrl,
                'response' => $response->body(),
            ]);
            $units = [
                [
                    'unit' => 'TBD',
                    'status' => 'Unknown',
                    'elapsed' => 'Unknown',
                ]
            ];
        }

        return [
            'units' => $units,
            'call_id' => $call_id,
        ];
    }
}