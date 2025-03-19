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
        $query = Repair::with(['user', 'user.instansi', 'teams'])
            ->where('status', 'completed');

        if (request()->has('start_date') && request()->has('end_date')) {
            $query->whereBetween('updated_at', [request('start_date'), request('end_date')]);
        }

        $repairs = $query->orderBy('updated_at', 'desc')->get();
        $rateUser = RateUser::join('users', 'rateuser.users_id', '=', 'users.id')
            ->select(
                'users.name',
                'users.nip',
                \DB::raw('COUNT(rateuser.id) as total_repairs'),
                \DB::raw('SUM(CASE WHEN rateuser.status = "completed" THEN 1 ELSE 0 END) as completed_repairs'),
                \DB::raw('SUM(CASE WHEN rateuser.status = "failed" THEN 1 ELSE 0 END) as failed_repairs'),
                \DB::raw('SUM(CASE WHEN rateuser.status = "scheduled" THEN 1 ELSE 0 END) as scheduled_repairs')
            )
            ->groupBy('users.name', 'users.nip')
            ->get();

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
