<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Instansi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    public function index()
    {   
        $instansis = Instansi::all(); // Ambil semua instansi dari database
        $users = User::all();

        $headerText = 'Data User';

        $title = 'Delete It!';
        $text = "Apakah anda yakin ingin menghapusnya?";
        confirmDelete($title, $text);

        return view('user.user', compact('headerText', 'users', 'instansis'));
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

public function checkDuplicate(Request $request)
{
    $nip = $request->nip;
    $excludeId = $request->exclude_id;

    $query = User::where('nip', $nip);

    if ($excludeId) {
        $query->where('id', '!=', $excludeId);  // Supaya pas edit tidak kena validasi dirinya sendiri
    }

    return response()->json(['exists' => $query->exists()]);
}




    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required|unique:users,nip',
            'id_instansi' => 'required',
            'role' => 'required',
        ]);    
    
        $token = Str::random(15);
    
        $data = [
            'token' => $token,
            'name' => $request->name,
            'nip' => $request->nip,
            'role' => $request->role,
            'password' => bcrypt($token), // Pastikan password terenkripsi
            'id_instansi' => $request->id_instansi, // Tambahkan id_instansi
        ];
    
        $jsonDATAtoken = [
            'token' => $token
        ];
    
        $user = User::create($data);
    
        // Generate QR Code
        $jsonData = json_encode($jsonDATAtoken);
        $path = public_path('Pictures/qrcode');
    
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
    
        $fileName = "$user->name.png";
    
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

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'nip' => 'required|unique:users,nip,' . $id,
        'instansi' => 'required',
        'role' => 'required'
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'nip' => $request->nip,
        'instansi_id' => $request->instansi,
        'role' => $request->role
    ]);

    return redirect()->back()->with('success', 'User berhasil diperbarui');
}

    
    

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect('/user');
}

}
