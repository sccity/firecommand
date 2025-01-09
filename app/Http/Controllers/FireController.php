<?php

namespace App\Http\Controllers;

use App\Services\FireApiService;
use App\Models\Fire;
use Illuminate\Http\Request;

class FireController extends Controller
{
    protected $fireApiService;

    public function __construct(FireApiService $fireApiService)
    {
        $this->fireApiService = $fireApiService;
    }

    public function index()
    {
        $activeFires = $this->fireApiService->getActiveFires();
        $syncedFires = collect($activeFires)->map(function ($fire) {
            return $this->fireApiService->syncFire($fire);
        });

        $unitStatus = $this->fireApiService->getUnitStatus();

        return view('fire.command', [
            'fires' => $syncedFires,
            'unitStatus' => $unitStatus
        ]);
    }

    public function getUnitLocation(Request $request)
    {
        $unit = $request->input('unit');
        $location = $this->fireApiService->getUnitLocation($unit);
        
        return response()->json($location);
    }
} 