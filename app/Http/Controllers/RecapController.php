<?php

namespace App\Http\Controllers;

use App\Models\Recap;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RecapController extends Controller
{
    public function index()
    {
        $recaps = Recap::all();
        $headerText = 'Rekapitulasi';

        return view('rekapitulasi.rekapitulasi', compact('recaps','headerText'));
    }

    public function show($id)
    {
        $recap = Recap::findOrFail($id);

        return response()->json($recap);
    }

    public function downloadPdf($id)
    {
    }
}
