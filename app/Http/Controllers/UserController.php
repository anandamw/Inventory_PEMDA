<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $headerText = 'Data User';
        return view('user.user', compact('headerText', 'users'));
    }


    public function create()
    {
        $headerText = 'Create User';


        return view('user.user_create', compact('headerText'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'role' => 'required'
        ]);
        $headerText = 'Data User';
        $token = Str::random(15);



        $data = [
            'token' => $token,
            'name' => $request->name,
            'nip' => $request->nip,
            'role' => $request->role,
            'password' => $token,
        ];


        $jsonDATAtoken = [
            'token' => $token
        ];

        // dd($data);

        // Simpan data pengguna ke database
        $user = User::create($data);

        // Encode data untuk QR Code
        $jsonData = json_encode($jsonDATAtoken);

        // Tentukan path penyimpanan QR Code
        $path = public_path('Pictures/qrcode');

        // Buat folder jika belum ada
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        // Nama file QR Code
        $fileName = "$user->name.png";

        // Simpan QR Code dalam format PNG
        QrCode::format('png')
            ->size(250)->margin(2)
            ->generate($jsonData, $path . '/' . $fileName);

        return redirect('/user');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.user_show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $headerText = 'Edit User';
        return view('user.user_edit', compact('user', 'headerText'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
