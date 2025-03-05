<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;

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
    
        // Filter by tanggal (jika ada request dari form filter)
        if (request()->has('start_date') && request()->has('end_date')) {
            $query->whereBetween('updated_at', [request('start_date'), request('end_date')]);
        }
    
        $repairs = $query->orderBy('updated_at', 'desc')->get();
    
        return view('perbaikan.perbaikan', compact('headerText', 'repairs'));
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
