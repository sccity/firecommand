<?php
//command.php
namespace App\Http\Controllers\ic;

use App\Http\Controllers\Controller;
use App\Models\AssignmentColumn;
use App\Services\Spillman\ActiveCalls;
use App\Services\Spillman\ActiveUnits;
use App\Services\Spillman\Comments;
use Illuminate\Http\Request;

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

    public function index(Request $request, $call_id = null)
    {
        if (empty($call_id)) {
            return redirect()->route('/');
        }

        $unitData = $this->activeUnitsService->getActiveUnits($call_id);
        $callData = $this->activeCallsService->getActiveCalls();
        $comments = $this->cadCommentsService->getCadComments($call_id);

        if (isset($unitData['error']) || empty($callData) || isset($comments['error'])) {
            return view('pages/ic/command', [
                'error' => $unitData['error'] ?? $comments['error'] ?? 'Failed to fetch call data',
                'call_id' => $call_id,
            ]);
        }

        $callDetails = collect($callData)->firstWhere('call_id', $call_id);

        $nature = $callDetails['nature'] ?? 'Unknown';
        $address = $callDetails['address'] ?? 'Unknown';
        $city = $callDetails['city'] ?? 'Unknown';
        $zone = $callDetails['zone'] ?? 'Unknown';
        $latitude = $callDetails['latitude'] ?? '0.0';
        $longitude = $callDetails['longitude'] ?? '0.0';
        $callnum = $callDetails['callnum'] ?? 'UNK';
        $agency = $callDetails['agency'] ?? 'Unknown';  // Default value for agency
        $calltype = $callDetails['calltype'] ?? 'Unknown';  // Default value for call type

        $units = $unitData['units'] ?? [];
        if (empty($units)) {
            $units = [
                [
                    'unit' => 'TBD',
                    'status' => 'Unknown',
                    'elapsed' => 'Unknown',
                ]
            ];
        }

        if ($request->ajax()) {
            if ($request->has('units')) {
                return response()->json(['units' => $units]);
            }

            if ($request->has('comments')) {
                return response()->json(['comments' => $comments]);
            }
        }

        return view('pages/ic/command', [
            'units' => $units,
            'call_id' => $call_id,
            'nature' => $nature,
            'address' => $address,
            'city' => $city,
            'zone' => $zone,
            'latitude' => (float) $latitude,
            'longitude' => (float) $longitude,
            'comments' => $comments,
            'callnum' => $callnum,
            'agency' => $agency,
            'calltype' => $calltype,
        ]);
    }

    public function getColumns($call_id)
    {
        $columns = AssignmentColumn::where('call_id', $call_id)->first();
        if (!$columns) {
            // Create default columns if none exist
            $defaultColumns = [
                'Units',
                'IC',
                'FA',
                'SEARCH',
                'VENT',
                'RIT',
                'MED',
                'DRONE',
                'DIV A',
                'DIV B'
            ];
            AssignmentColumn::create([
                'call_id' => $call_id,
                'columns' => $defaultColumns
            ]);
            return response()->json($defaultColumns);
        }
        return response()->json($columns->columns);
    }

    public function saveColumns(Request $request)
    {
        $request->validate([
            'call_id' => 'required|string',
            'columns' => 'required|array',
        ]);

        try {
            \Log::info('Saving columns:', [
                'call_id' => $request->call_id,
                'columns' => $request->columns
            ]);

            $columns = $request->input('columns');

            $result = AssignmentColumn::updateOrCreate(
                ['call_id' => $request->call_id],
                ['columns' => $columns]
            );

            \Log::info('Update or Create result:', $result->toArray());

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            \Log::error('Error saving columns:', ['message' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
