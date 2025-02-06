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
        // Debug log untuk melihat data yang diterima
        \Log::info("Received QR Code Data: ", $request->all());

        // Validasi input QR Code
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'nip' => 'required|string',
            'password' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            \Log::error("Validation Failed: ", $validator->errors()->toArray());
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or missing data.',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $name = $request->input('name');
            $nip = $request->input('nip');
            $password = $request->input('password');

            // Cek apakah pengguna dengan NIP ini sudah ada
            $user = User::where('nip', $nip)->first();

            if ($user) {
                // Jika ditemukan, lakukan login
                if (Hash::check($password, $user->password)) {
                    Auth::login($user);
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Login successful.',
                        'redirect_url' => route('home')
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid password.'
                    ], 401);
                }
            } else {
                // Jika tidak ditemukan, buat user baru dan login
                $user = User::create([
                    'name' => $name,
                    'nip' => $nip,
                    'password' => Hash::make($password),
                    'role' => 'user'
                ]);

                Auth::login($user);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Registration successful. You are now logged in.',
                    'redirect_url' => route('home')
                ]);
            }
        } catch (QueryException $e) {
            \Log::error("Database Error: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Database error occurred.',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            \Log::error("Unexpected Error: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}
