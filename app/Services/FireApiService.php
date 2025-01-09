<?php

namespace App\Services;

use App\Models\Fire;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class FireApiService
{
    protected $baseUrl = 'https://spillmanapi.santaclarautah.gov';
    protected $apiToken;
    protected $cacheDuration = 30; // seconds

    public function __construct()
    {
        $this->apiToken = config('services.spillman.token', 'devops');
    }

    public function getActiveFires()
    {
        $response = Http::get("{$this->baseUrl}/cad/active", [
            'type' => 'f',
            'token' => $this->apiToken
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function getUnitStatus()
    {
        return Cache::remember('unit_status', $this->cacheDuration, function () {
            $response = Http::get("{$this->baseUrl}/cad/units", [
                'token' => $this->apiToken
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return [];
        });
    }

    public function getAssignedUnits($callId)
    {
        $response = Http::get("{$this->baseUrl}/cad/units", [
            'token' => $this->apiToken,
            'call' => $callId
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function syncFire($fireData)
    {
        // Get assigned units for this fire
        $assignedUnits = $this->getAssignedUnits($fireData['call_id']);
        
        // Format the data
        $formattedData = [
            'call_id' => $fireData['call_id'],
            'incident_id' => $fireData['incident_id'] ?? '',
            'agency' => $fireData['agency'] ?? '',
            'nature' => $fireData['nature'] ?? '',
            'zone' => $fireData['zone'] ?? '',
            'responsible_unit' => $fireData['responsible_unit'] ?? '',
            'address' => $fireData['address'] ?? '',
            'city' => $fireData['city'] ?? '',
            'latitude' => $fireData['latitude'] ?? 0,
            'longitude' => $fireData['longitude'] ?? 0,
            'type' => $fireData['type'] ?? '',
            'status' => $fireData['status'] ?? '',
            'status_time' => $fireData['status_time'] ?? '',
            'callnum' => $fireData['callnum'] ?? '',
            'date' => isset($fireData['date']) ? Carbon::parse($fireData['date']) : now(),
            'assigned_units' => json_encode($assignedUnits)
        ];

        // Create or update the fire record
        $fire = Fire::updateOrCreate(
            ['call_id' => $fireData['call_id']],
            $formattedData
        );

        return $fire;
    }

    public function getUnitLocation($unit)
    {
        $response = Http::get("{$this->baseUrl}/cad/location", [
            'token' => $this->apiToken,
            'unit' => $unit
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
} 