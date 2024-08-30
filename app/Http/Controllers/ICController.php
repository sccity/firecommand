<?php

namespace App\Http\Controllers;

use App\Services\ActiveUnits;
use Illuminate\Http\Request;

class ICController extends Controller
{
    protected $activeUnitsService;

    public function __construct(ActiveUnits $activeUnitsService)
    {
        $this->activeUnitsService = $activeUnitsService;
    }

    public function show($call_id)
    {
        $data = $this->activeUnitsService->getActiveUnits($call_id);

        if (isset($data['error'])) {
            return view('pages.IC', $data);
        }

        return view('pages.IC', [
            'units' => $data['units'],
            'call_id' => $call_id,
        ]);
    }
}