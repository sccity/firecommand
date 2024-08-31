<?php

namespace App\Http\Controllers\ic;

use App\Http\Controllers\Controller;
use App\Services\Spillman\ActiveCalls;
use App\Services\Spillman\ActiveUnits;
use App\Services\Spillman\Comments;
use Illuminate\Http\Request;

class Command extends Controller
{
    protected $activeUnitsService;
    protected $activeCallsService;
    protected $cadCommentsService;

    public function __construct(ActiveUnits $activeUnitsService, ActiveCalls $activeCallsService, Comments $cadCommentsService)
    {
        $this->activeUnitsService = $activeUnitsService;
        $this->activeCallsService = $activeCallsService;
        $this->cadCommentsService = $cadCommentsService;
    }

    public function index(Request $request, $call_id = null)
    {
        // Redirect to calls page if no call ID is provided
        if (empty($call_id)) {
            return redirect()->route('fc-calls');
        }

        // Fetch the necessary data
        $unitData = $this->activeUnitsService->getActiveUnits($call_id);
        $callData = $this->activeCallsService->getActiveCalls();
        $comments = $this->cadCommentsService->getCadComments($call_id);

        // Check for errors or missing data
        if (isset($unitData['error']) || empty($callData) || isset($comments['error'])) {
            return view('pages/ic/command', [
                'error' => $unitData['error'] ?? $comments['error'] ?? 'Failed to fetch call data',
                'call_id' => $call_id,
            ]);
        }

        // Extract call details
        $callDetails = collect($callData)->firstWhere('call_id', $call_id);

        $nature = $callDetails['nature'] ?? 'Unknown';
        $address = $callDetails['address'] ?? 'Unknown';
        $city = $callDetails['city'] ?? 'Unknown';
        $zone = $callDetails['zone'] ?? 'Unknown';
        $latitude = $callDetails['latitude'] ?? '0.0';
        $longitude = $callDetails['longitude'] ?? '0.0';
        $callnum = $callDetails['callnum'] ?? 'UNK';

        // Fallback for units if none are provided
        $units = $unitData['units'] ?? [];
        if (empty($units)) {
            $units = [
                [
                    'unit' => 'TBD',
                    'status' => 'Unknown',
                    'elapsed' => 'Unknown',
                ]
            ];
        }

        // Handle AJAX requests specifically for units and comments
        if ($request->ajax()) {
            if ($request->has('units')) {
                return response()->json(['units' => $units]);
            }

            if ($request->has('comments')) {
                return response()->json(['comments' => $comments]);
            }
        }

        // Handle full view rendering for non-AJAX requests
        return view('pages/ic/command', [
            'units' => $units,
            'call_id' => $call_id,
            'nature' => $nature,
            'address' => $address,
            'city' => $city,
            'zone' => $zone,
            'latitude' => (float) $latitude,
            'longitude' => (float) $longitude,
            'comments' => $comments,
            'callnum' => $callnum,
        ]);
    }
}