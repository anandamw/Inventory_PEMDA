<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $headerText = 'Data User';
        return view('user.user', compact('headerText', 'users'));
    }

    public function profile()
{
    $user = Auth::user(); // Ambil data pengguna yang sedang login
    $headerText = 'My Profile';
    return view('profile', compact('headerText','user'));
}

public function post_profile(Request $request)
{
    $request->validate([
        'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $user = Auth::user();

    // Hapus gambar lama jika ada
    if ($user->profile && File::exists(public_path('uploads/profile/' . $user->profile))) {
        File::delete(public_path('uploads/profile/' . $user->profile));
    }

    // Simpan gambar baru di folder public/uploads/profile
    $file = $request->file('profile');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads/profile/'), $fileName);

    // Update database dengan nama file baru
    $user->update(['profile' => 'uploads/profile/' . $fileName]);

    return response()->json(['success' => true, 'profile' => asset('uploads/profile/' . $fileName)]);
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
    return response()->json($user); // Kirim data JSON ke AJAX
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

    return response()->json(['message' => 'User updated successfully']);
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return response()->json(['message' => 'User deleted successfully']);
}

}
