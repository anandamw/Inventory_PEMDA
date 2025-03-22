<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{


    public function addrating(Request $request, $id)
    {
        $repairTeam = DB::table('repair_teams')->where('repair_id', $id)->first();

        if (!$repairTeam) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $repairTeam->update([
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return response()->json(['message' => 'Rating dan komentar berhasil diperbarui!']);
    }
}
