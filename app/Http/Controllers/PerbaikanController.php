<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    public function index()
    {
        $headerText = 'Data Perbaikan';

        return view('perbaikan.perbaikan', compact('headerText'));
    }
}
