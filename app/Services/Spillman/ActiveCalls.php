<?php

namespace App\Services\Spillman;

use Illuminate\Support\Facades\Http;
use App\Services\Spillman\TimeUtils;

class ActiveCalls
{
    protected $timeConversionService;

    public function __construct(TimeUtils $timeConversionService)
    {
        $this->timeConversionService = $timeConversionService;
    }

    public function getActiveCalls()
    {
        $apiUrl = config('services.api.url') . '/cad/active?&token=' . config('services.api.token');
        $response = Http::withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ])->get($apiUrl);

        if ($response->successful()) {
            $activeCalls = $response->json();

            usort($activeCalls, function($a, $b) {
                return $this->timeConversionService->convertToSeconds($a['status_time']) - $this->timeConversionService->convertToSeconds($b['status_time']);
            });

            return $activeCalls;
        }

        return [];
    }
}