<?php

namespace App\Http\Controllers;

use App\Services\ActiveCalls;
use Illuminate\Http\Request;

class ActiveCallsController extends Controller
{
    protected $activeCallsService;

    public function __construct(ActiveCalls $activeCallsService)
    {
        $this->activeCallsService = $activeCallsService;
    }

    public function index()
    {
        $activeCalls = $this->activeCallsService->getActiveCalls();

        if (request()->ajax()) {
            return response()->json(['activeCalls' => $activeCalls]);
        }

        if (empty($activeCalls)) {
            return view('pages/activecalls')->withErrors('Failed to fetch active calls data');
        }

        return view('pages/activecalls', ['activeCalls' => $activeCalls]);
    }
}