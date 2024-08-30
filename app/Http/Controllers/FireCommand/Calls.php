<?php

namespace App\Http\Controllers\FireCommand;

use App\Http\Controllers\Controller;
use App\Services\Spillman\ActiveCalls;
use Illuminate\Http\Request;

class Calls extends Controller
{
    protected $callsService;

    public function __construct(ActiveCalls $callsService)
    {
        $this->callsService = $callsService;
    }

    public function index()
    {
        $calls = $this->callsService->getActiveCalls();
        
        if (request()->ajax()) {
            return response()->json(['calls' => $calls]);
        }
        
        $calls = $calls ?? [];
        
        if (empty($calls)) {
            return view('pages/FireCommand/calls')->with('error', 'Failed to fetch active calls data');
        }
        
        return view('pages/FireCommand/calls', ['calls' => $calls]);
    }
}