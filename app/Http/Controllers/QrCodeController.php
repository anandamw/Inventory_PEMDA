<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use function Laravel\Prompts\password;

class QrCodeController extends Controller
{
    public function index()
    {
        $token = Str::random(15);

        // Data dummy untuk QR Code
        $data = [
            'token' => 'h6XgdqJ2vJup4OB'
        ];


        // Mengubah data ke format JSON
        $jsonData = json_encode($data);

        // Generate QR Code dengan data dummy
        $qrCode = QrCode::size(250)->generate($jsonData);

        // Menampilkan QR Code di view
        return view('qrcode', compact('qrCode'));
    }
}
