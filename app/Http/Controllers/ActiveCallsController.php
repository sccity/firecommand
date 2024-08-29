<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActiveCallsController extends Controller
{
    public function index() 
    {
        $apiUrl = config('services.api.url') . '/active?&token=' . config('services.api.token');
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $activeCalls = $response->json();
            return view('pages/activecalls', ['activeCalls' => $activeCalls]);
        } else {
            $activeCalls = [];
            return view('pages/activecalls')->withErrors('Failed to fetch active calls data');
        }
    }
}
