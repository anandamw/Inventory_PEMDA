<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {


        $headerText = 'Dashboard';


        toast('Selamat datang di layanan Logishub', 'info');

        return view('dashboard', compact('headerText'));
    }
}
