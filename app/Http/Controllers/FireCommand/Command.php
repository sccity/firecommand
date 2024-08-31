<?php

namespace App\Http\Controllers\FireCommand;

use App\Http\Controllers\Controller;
use App\Services\Spillman\ActiveCalls;
use App\Services\Spillman\ActiveUnits;
use App\Services\Spillman\Comments; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function index(Request $request)
    {
        $call_id = $request->query('callid');
    
        if (empty($call_id)) {
            return redirect()->route('fc-calls');
        }
    
        $unitData = $this->activeUnitsService->getActiveUnits($call_id);
        $callData = $this->activeCallsService->getActiveCalls();
        $comments = $this->cadCommentsService->getCadComments($call_id);
    
        if (isset($unitData['error']) || empty($callData) || isset($comments['error'])) {
            return view('pages/FireCommand/command', [
                'error' => $unitData['error'] ?? $comments['error'] ?? 'Failed to fetch call data',
                'call_id' => $call_id,
            ]);
        }
    
        $callDetails = collect($callData)->firstWhere('call_id', $call_id);
    
        // Ensure callDetails is not null
        if (!$callDetails) {
            $nature = 'Unknown';
            $address = 'Unknown';
        } else {
            // Ensure nature and address are not empty/null
            $nature = $callDetails['nature'] ?? 'Unknown';
            $address = $callDetails['address'] ?? 'Unknown';
        }
    
        $units = $unitData['units'] ?? [];
    
        // Ensure units is not empty, return a single "UNK" unit if empty
        if (empty($units)) {
            $units = [
                [
                    'unit' => 'TBD',
                    'status' => 'Unknown',
                    'elapsed' => 'Unknown',
                ]
            ];
        }
    
        // Handle AJAX requests differently
        if ($request->ajax()) {
            if ($request->has('units')) {
                return response()->json(['units' => $units]);
            }
    
            if ($request->has('comments')) {
                return response()->json(['comments' => $comments]);
            }
        }
    
        // Standard request returns the full view
        return view('pages/FireCommand/command', [
            'units' => $units,
            'call_id' => $call_id,
            'nature' => $nature,
            'address' => $address,
            'comments' => $comments,
        ]);
    }
}