<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RepairTeam;

class RatingController extends Controller
{


    public function addrating(Request $request, $id)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'id_item' => 'required|exists:repair_teams,repair_id',
            'rating' => 'nullable|integer|min:1|max:6',
            'comment' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Update data di database
            RepairTeam::where('repair_id', $request->id_item)
                ->update([
                    'rating' => $request->rating,
                    'comment' => $request->comment,
                    'updated_at' => now()
                ]);

            // Ambil data terbaru
            $updatedData = RepairTeam::where('repair_id', $request->id_item)
                ->first();

            return response()->json([
                'message' => 'Berhasil diperbarui',
                'rating' => $updatedData->rating,
                'comment' => $updatedData->comment
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
