<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data pengguna yang akan dibuat
        $users = [
            [
                'name' => 'Ananda Maulana Wahyudi',
                'nip' => '2202310054',
                'role' => 'Admin',
            ],
            [
                'name' => 'Rahmat Syafri Kurniaman',
                'nip' => '2202310115',
                'role' => 'User',
            ]
        ];

        foreach ($users as $userData) {
            $jsonDATAtoken = [
                'token' => '123123'
            ];
            $user = User::create([
                'name' => $userData['name'],
                'nip' => $userData['nip'],
                'role' => $userData['role'],
                'token' => $jsonDATAtoken['token'],
                'password' => bcrypt(123123123), // Enkripsi password
            ]);

            // Encode token untuk QR Code
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
        }
    }
}
