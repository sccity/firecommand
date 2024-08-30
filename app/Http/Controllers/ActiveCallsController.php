<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActiveCallsController extends Controller
{
    public function index()
    {
        $apiUrl = config('services.api.url') . '/active?&token=' . config('services.api.token');
        $response = Http::withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ])->get($apiUrl);

        if ($response->successful()) {
            $activeCalls = $response->json();

            usort($activeCalls, function($a, $b) {
                return $this->convertToSeconds($a['status_time']) - $this->convertToSeconds($b['status_time']);
            });

            if (request()->ajax()) {
                return response()->json(['activeCalls' => $activeCalls]);
            }

            return view('pages/activecalls', ['activeCalls' => $activeCalls]);
        } else {
            if (request()->ajax()) {
                return response()->json(['activeCalls' => []]);
            }

            return view('pages/activecalls')->withErrors('Failed to fetch active calls data');
        }
    }

    private function convertToSeconds($time)
    {
        $parts = explode(' ', $time);
        $seconds = 0;

        foreach ($parts as $part) {
            if (strpos($part, 'm') !== false) {
                $seconds += intval($part) * 60;
            } elseif (strpos($part, 's') !== false) {
                $seconds += intval($part);
            }
        }

        return $seconds;
    }
}