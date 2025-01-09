<?php

namespace App\Http\Controllers;

use App\Models\Fire;
use App\Models\FireAssignment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FireAssignmentController extends Controller
{
    public function index(Fire $fire): JsonResponse
    {
        try {
            $assignments = $fire->assignments()->get();
            return response()->json($assignments);
        } catch (\Exception $e) {
            Log::error('Error fetching assignments: ' . $e->getMessage(), [
                'fire_id' => $fire->id,
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Failed to fetch assignments'], 500);
        }
    }

    public function store(Request $request, Fire $fire): JsonResponse
    {
        try {
            Log::info('Attempting to store assignment', [
                'fire_id' => $fire->id,
                'request_data' => $request->all()
            ]);

            $validated = $request->validate([
                'unit' => 'required|string',
                'position' => 'required|string',
                'start_time' => 'nullable|numeric'
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            DB::beginTransaction();

            // Remove any existing assignment for this unit across ALL fires
            FireAssignment::where('unit', $validated['unit'])->delete();

            // Create new assignment with proper timestamp handling
            $startTime = $validated['start_time'] 
                ? new \DateTime('@' . ($validated['start_time'] / 1000)) // Convert JS milliseconds to seconds
                : now();

            $assignment = $fire->assignments()->create([
                'unit' => $validated['unit'],
                'position' => $validated['position'],
                'assignment_time' => now(),
                'start_time' => $startTime
            ]);

            DB::commit();

            Log::info('Assignment created successfully', ['assignment' => $assignment]);

            return response()->json($assignment);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing assignment: ' . $e->getMessage(), [
                'fire_id' => $fire->id,
                'request_data' => $request->all(),
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Failed to store assignment: ' . $e->getMessage()], 500);
        }
    }
} 