<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\MailPost;
use App\Models\Instansi;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AuthController extends Controller
{
    public function index()
    {

        $categories = Instansi::select('nama_instansi')->distinct()->get();
        return view('login', compact('categories'));
    }


    // login
    public function scanQrCode(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token tidak boleh kosong.'
            ], 400);
        }

        $token = $request->input('token');

        // Cari user berdasarkan token
        $user = User::where('token', $token)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token tidak valid atau pengguna tidak ditemukan.'
            ], 401);
        }

        // Pastikan token tidak kosong di database
        if (empty($user->token)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token di database kosong. Tidak bisa login.'
            ], 401);
        }

        Auth::login($user);

        // Redirect berdasarkan role
        $role = $user->role;

        switch ($role) {
            case 'admin':
                $redirectUrl = route('home');
                break;
            case 'opd':
                $redirectUrl = route('opdhome');
                break;
            case 'team':
                $redirectUrl = route('home');
                break;
            default:

                return response()->json([
                    'status' => 'error',
                    'message' => 'Role pengguna tidak valid.'
                ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil!',
            'redirect_url' => $redirectUrl
        ]);
    }


    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'nip' => 'required|unique:users,nip',
        ]);

        $instansi = $request->input('nama_instansi');

        $getInstansi = Instansi::where('nama_instansi', $instansi)->first();

        if (!$getInstansi) {
            toast('Registrasi gagal, instansi tidak ditemukan!', 'error');

            return redirect()->back()->withErrors(['nama_instansi' => 'Instansi tidak ditemukan.']);
        }

        $token = Str::random(15);
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(Str::random(16)),
            'role' => 'opd',
            'token' => $token,
            'nip' => $request->nip,
            'id_instansi' => $getInstansi->id_instansi
        ]);

        // Generate QR Code
        $jsonData = json_encode(['token' => $token]);
        $path = public_path('Pictures/qrcode');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $fileName = "$user->name.png";
        $qrcodePath = $path . '/' . $fileName;

        QrCode::format('png')
            ->size(250)->margin(2)
            ->generate($jsonData, $qrcodePath);

        $msg = "Registrasi berhasil! Email telah dikirim.";
        $subject = "Registrasi Berhasil";

        // Kirim email dengan lampiran QR code
        Mail::to($request->email)->send(new MailPost($msg, $subject, $qrcodePath));

        $random = Str::random(200);
        // Menyimpan token di cache dengan waktu kadaluwarsa (misalnya 30 menit)
        Cache::put('verify_token_' . $random, false, now()->addMinutes(30));

        toast('Registrasi Berhasil, Silahkan cek E-mail anda sekarang!', 'info');

        // Generate random URL untuk redirect
        return redirect('/');
    }

    public function verify($random1)
    {
        // Memeriksa apakah token ada di cache dan belum digunakan
        $tokenStatus = Cache::get('verify_token_' . $random1);

        if ($tokenStatus === false) {
            // Tandai token sebagai sudah digunakan
            Cache::put('verify_token_' . $random1, true);

            return view('verify'); // Tampilkan halaman verifikasi
        } else {
            // Token sudah digunakan atau kadaluwarsa
            abort(404, 'Token sudah digunakan atau kadaluwarsa'); // Menampilkan halaman error 404 dengan pesan kustom
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}
