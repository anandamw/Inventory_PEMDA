<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {


        $headerText = 'Dashboard';
        return view('dashboard', compact('headerText'));
    }
}
