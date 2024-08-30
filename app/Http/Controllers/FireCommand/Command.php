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
    
        if (!$callDetails) {
            return view('pages/FireCommand/command', [
                'error' => 'Call details not found',
                'call_id' => $call_id,
            ]);
        }
    
        $nature = $callDetails['nature'] ?? 'Unknown';
        $address = $callDetails['address'] ?? 'Unknown';
    
        $units = $unitData['units'] ?? [];
        if (empty($units)) {
            $units = [
                [
                    'unit' => 'ERR',
                    'status' => 'Unknown',
                    'elapsed' => 'Unknown',
                ]
            ];
        }
    
        return view('pages/FireCommand/command', [
            'units' => $units,
            'call_id' => $call_id,
            'nature' => $nature,
            'address' => $address,
            'comments' => $comments,
        ]);
    }
}