<?php

namespace App\Services\Spillman;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Comments
{
    public function getCadComments($call_id)
    {
        $apiUrl = config('services.api.url') . '/cad/comments?callid=' . $call_id . '&token=' . config('services.api.token');
        $response = Http::withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ])->get($apiUrl);

        if ($response->failed()) {
            Log::error('Spillman API Request Failed', [
                'url' => $apiUrl,
                'response' => $response->body(),
            ]);
            return ['error' => 'Failed to fetch CAD comments'];
        }

        $data = $response->json();

        $comments = $data[0]['comments'] ?? null;

        if (empty($comments)) {
            Log::warning('No Comments Found', [
                'url' => $apiUrl,
                'response' => $response->body(),
            ]);
            return ['error' => 'No CAD Comments...'];
        }

        $processedComments = nl2br(e($comments));

        return $processedComments;
    }
}