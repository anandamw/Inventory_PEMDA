<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Repair;
use App\Models\RateUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $headerText = 'Rekap Perbaikan';
        // **1. Ambil data Repair yang sudah completed**
        $query = Repair::with(['user', 'user.instansi', 'teams'])
            ->where('status', 'completed');

        // **2. Filter berdasarkan tanggal jika tersedia**
        if (request()->has('start_date') && request()->has('end_date')) {
            $startDate = request('start_date');
            $endDate = request('end_date');

            if ($startDate && $endDate) { // Pastikan tidak null
                $query->whereBetween('updated_at', [$startDate, $endDate]);
            }
        }

        // **3. Ambil data repair yang sudah difilter**
        $repairs = $query->orderBy('updated_at', 'desc')->get();

        // **4. Ambil rekap data tim perbaikan dari repair_teams**
        $rateUser = DB::table('repair_teams')
            ->join('users', 'repair_teams.user_id', '=', 'users.id')
            ->select(
                'users.name',
                'users.nip',
                'users.id',
                DB::raw('COUNT(repair_teams.id) as total_repairs'),
                DB::raw('SUM(CASE WHEN repair_teams.status = "completed" THEN 1 ELSE 0 END) as completed_repairs'),
                DB::raw('SUM(CASE WHEN repair_teams.status = "failed" THEN 1 ELSE 0 END) as failed_repairs'),
                DB::raw('SUM(CASE WHEN repair_teams.status = "scheduled" THEN 1 ELSE 0 END) as scheduled_repairs'),

                DB::raw('AVG(repair_teams.rating) as avg_rating'),

                DB::raw('SUM(repair_teams.rating) as total_rating') // ⬅️ ini tambahan
            )
            ->where('users.role', 'team')
            ->groupBy('users.name', 'users.nip', 'users.id')
            ->orderByDesc(DB::raw('SUM(repair_teams.rating)')) // Urutkan berdasarkan total_rating tertinggi
            ->get();

        // Ambil semua tim dengan rating
        $repairTeams = \App\Models\RepairTeam::whereNotNull('rating')->get();

        // Hitung rata-rata rating keseluruhan (C)
        $totalRating = $repairTeams->sum('rating');
        $totalJobs = $repairTeams->count();
        $C = $totalJobs > 0 ? $totalRating / $totalJobs : 0;

        // Hitung rata-rata jumlah pekerjaan per user untuk dijadikan $m
        $jobPerUser = $repairTeams->groupBy('user_id')->map->count();
        $m = $jobPerUser->avg(); // rata-rata jumlah pekerjaan per user

        // Hitung weighted rating per user
        $ratarating = $repairTeams->groupBy('user_id')->map(function ($items) use ($C, $m) {
            $v = $items->count(); // jumlah pekerjaan user
            $R = $items->avg('rating'); // rata-rata rating user

            // Weighted Rating (semakin banyak pekerjaan, semakin mendekati R)
            $WR = (($v / ($v + $m)) * $R) + (($m / ($v + $m)) * $C);
            return $WR;
        });







        $rateUserTeam = DB::table('repair_teams')
            ->join('users', 'repair_teams.user_id', '=', 'users.id')
            ->join('repairs', 'repair_teams.repair_id', '=', 'repairs.id_repair')
            ->select(
                'users.id',
                'users.name',
                'users.nip',
                'repair_teams.rating',
                'repair_teams.comment',
                'repair_teams.updated_at',
                'repairs.repair',
                'repairs.scheduled_date',
            )
            ->where('users.role', 'team')
            ->where('repair_teams.status', 'completed')
            ->whereNotNull('repair_teams.rating') // Pastikan hanya ambil yang ada rating
            ->get();



        // **5. Return view dengan data yang sudah diperbaiki**
        return view('perbaikan.perbaikan', compact('headerText', 'repairs', 'rateUser', 'rateUserTeam', 'ratarating'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
