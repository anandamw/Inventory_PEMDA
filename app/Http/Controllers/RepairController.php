<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headerText = 'Rekap Perbaikan';
        $query = Repair::with(['user', 'user.instansi', 'teams'])
            ->where('status', 'completed');
    
        if (request()->has('start_date') && request()->has('end_date')) {
            $query->whereBetween('updated_at', [request('start_date'), request('end_date')]);
        }
    
        $repairs = $query->orderBy('updated_at', 'desc')->get();
    
        // Rekap jumlah perbaikan per teknisi
        $technicianRepairs = DB::table('repair_teams')
            ->join('users', 'repair_teams.user_id', '=', 'users.id')
            ->select('users.name', 'users.nip', DB::raw('COUNT(repair_teams.repair_id) as total_repairs'))
            ->groupBy('users.name', 'users.nip')
            ->orderByDesc('total_repairs')
            ->get();
    
        return view('perbaikan.perbaikan', compact('headerText', 'repairs', 'technicianRepairs'));
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
