<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $headerText = 'Data User';
        return view('user.user', compact('headerText'));
    }


    public function create()
{
    $headerText = 'Create User';
    return view('user.user_create', compact('headerText'));
}



}
