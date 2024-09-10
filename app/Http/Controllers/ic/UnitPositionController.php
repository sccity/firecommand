<?php
#UnitPositionController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitPosition;
use App\Models\AssignmentColumn;

class UnitPositionController extends Controller
{
    /**
     * Updates or creates the position of a unit.
     */
    public function update(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|integer|exists:units,id',
            'column_id' => 'required|integer|exists:assignment_columns,id',
            'call_id' => 'required|integer', // Ensure this matches your requirements
        ]);

        try {
            $unitPosition = UnitPosition::updateOrCreate(
                ['unit_id' => $request->unit_id, 'call_id' => $request->call_id],
                [
                    'column_id' => $request->column_id,
                    'last_moved_at' => now(),
                ]
            );

            return response()->json(['status' => 'success', 'message' => 'Unit position updated']);
        } catch (\Exception $e) {
            \Log::error('Error updating unit position:', ['message' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Initializes unit positions for a specific call if not already initialized.
     */
    public function initializePositions(Request $request)
    {
        $request->validate([
            'call_id' => 'required|integer',
        ]);

        $units = Unit::all(); // Assuming you have a Unit model to get all units
        $defaultColumnId = AssignmentColumn::where('call_id', $request->call_id)->first()->id ?? null;

        if (!$defaultColumnId) {
            return response()->json(['status' => 'error', 'message' => 'No default column found']);
        }

        foreach ($units as $unit) {
            UnitPosition::firstOrCreate(
                ['unit_id' => $unit->id, 'call_id' => $request->call_id],
                [
                    'column_id' => $defaultColumnId,
                    'last_moved_at' => now(),
                ]
            );
        }

        return response()->json(['status' => 'success', 'message' => 'Unit positions initialized']);
    }

    /**
     * Retrieves the current position of all units for a specific call.
     */
    public function getUnitPositions(Request $request, $call_id)
    {
        $unitPositions = UnitPosition::where('call_id', $call_id)->get();

        if ($unitPositions->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No unit positions found']);
        }

        return response()->json(['status' => 'success', 'unit_positions' => $unitPositions]);
    }
}