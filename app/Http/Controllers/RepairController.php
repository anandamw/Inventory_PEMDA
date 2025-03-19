<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\RateUser;
use Carbon\Carbon;
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
            ->join('users', 'repair_teams.user_id', '=', 'users.id') // Perbaiki nama tabel
            ->select(
                'users.name',
                'users.nip',
                DB::raw('COUNT(repair_teams.id) as total_repairs'),
                DB::raw('SUM(CASE WHEN repair_teams.status = "completed" THEN 1 ELSE 0 END) as completed_repairs'),
                DB::raw('SUM(CASE WHEN repair_teams.status = "failed" THEN 1 ELSE 0 END) as failed_repairs'),
                DB::raw('SUM(CASE WHEN repair_teams.status = "scheduled" THEN 1 ELSE 0 END) as scheduled_repairs')
            )
            ->where('users.role', 'team') // Hanya ambil user dengan role "team"
            ->groupBy('users.name', 'users.nip')
            ->get();

        // **5. Return view dengan data yang sudah diperbaiki**
        return view('perbaikan.perbaikan', compact('headerText', 'repairs', 'rateUser'));
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
