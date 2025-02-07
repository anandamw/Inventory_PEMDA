<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {

        return view('test');
    }

    public function scanQrCode(Request $request)
    {
        \Log::info("📥 Received QR Code Data: ", $request->all());

        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            \Log::error("❌ Validation Failed: Token is required!");
            return response()->json([
                'status' => 'error',
                'message' => 'Token tidak boleh kosong.'
            ], 400);
        }

        $token = $request->input('token');
        \Log::info("🔍 Searching for user with token: $token");

        // Cari user berdasarkan token
        $user = User::where('token', $token)->first();

        if (!$user) {
            \Log::error("❌ Token not found in database!");
            return response()->json([
                'status' => 'error',
                'message' => 'Token tidak valid atau pengguna tidak ditemukan.'
            ], 401);
        }

        // Pastikan token tidak kosong di database
        if (empty($user->token)) {
            \Log::error("❌ Token found in database, but it's empty!");
            return response()->json([
                'status' => 'error',
                'message' => 'Token di database kosong. Tidak bisa login.'
            ], 401);
        }

        \Log::info("✅ Token valid! Logging in user: " . $user->id);
        Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil!',
            'redirect_url' => route('home')
        ]);
    }



    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}
