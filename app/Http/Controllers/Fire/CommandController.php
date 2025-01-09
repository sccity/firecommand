<?php

namespace App\Http\Controllers\Fire;

use App\Http\Controllers\Controller;
use App\Models\Fire;
use App\Services\FireApiService;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    protected $fireApiService;

    public function __construct(FireApiService $fireApiService)
    {
        $this->fireApiService = $fireApiService;
    }

    public function index()
    {
        $activeFires = $this->fireApiService->getActiveFires();
        
        // Sync fires with database
        $syncedFires = collect($activeFires)->map(function ($fire) {
            return $this->fireApiService->syncFire($fire);
        });

        return view('fire.command.index', [
            'activeFires' => $syncedFires
        ]);
    }

    public function show(Fire $fire)
    {
        return view('fire.command.show', [
            'fire' => $fire
        ]);
    }
}
