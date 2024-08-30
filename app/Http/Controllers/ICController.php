<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ICController extends Controller
{
    public function show($call_id)
{
    $apiToken = env('API_TOKEN');
    $url = 'https://spillmanapi.santaclarautah.gov/cad/active/units';
    $response = Http::get($url, [
        'callid' => $call_id,
        'token' => $apiToken,
    ]);

    if ($response->failed()) {
        Log::error('API request failed', [
            'url' => $url . '?callid=' . $call_id . '&token=' . $apiToken,
            'response' => $response->body(),
        ]);
        return view('pages.IC', [
            'error' => 'Failed to fetch data',
            'url' => $url . '?callid=' . $call_id . '&token=' . $apiToken,
            'call_id' => $call_id,
        ]);
    }

    $units = $response->json();
    Log::info('API response', ['data' => $units]);

    if (empty($units)) {
        Log::warning('No units found', [
            'url' => $url . '?callid=' . $call_id . '&token=' . $apiToken,
            'response' => $response->body(),
        ]);
        return view('pages.IC', [
            'error' => 'No units found',
            'url' => $url . '?callid=' . $call_id . '&token=' . $apiToken,
            'call_id' => $call_id,
        ]);
    }

    return view('pages.IC', [
        'units' => $units,
        'call_id' => $call_id,
    ]);
}
}