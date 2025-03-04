<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Seeder;

class InstansiDinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instansi::insert([
            ['nama_instansi' => 'Dinas Kesehatan'],
            ['nama_instansi' => 'Dinas Pendidikan'],
            ['nama_instansi' => 'Dinas Perhubungan'],
            ['nama_instansi' => 'Dinas Pekerjaan Umum'],
            ['nama_instansi' => 'Dinas Sosial'],
            ['nama_instansi' => 'Dinas Pariwisata'],
            ['nama_instansi' => 'Dinas Pertanian'],
            ['nama_instansi' => 'Dinas Perikanan'],
            ['nama_instansi' => 'Dinas Tenaga Kerja'],
            ['nama_instansi' => 'Dinas Lingkungan Hidup'],
            ['nama_instansi' => 'Dinas Kependudukan dan Catatan Sipil'],
            ['nama_instansi' => 'Dinas Perindustrian dan Perdagangan'],
            ['nama_instansi' => 'Dinas Komunikasi dan Informatika'],
            ['nama_instansi' => 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak'],
            ['nama_instansi' => 'Dinas Pemuda dan Olahraga'],
            ['nama_instansi' => 'Dinas Koperasi dan UKM'],
            ['nama_instansi' => 'Dinas Energi dan Sumber Daya Mineral'],
            ['nama_instansi' => 'Dinas Kebudayaan'],
            ['nama_instansi' => 'Dinas Kehutanan'],
            ['nama_instansi' => 'Dinas Ketahanan Pangan'],
            ['nama_instansi' => 'Dinas Tata Ruang dan Pertanahan'],
            ['nama_instansi' => 'Dinas Arsip dan Perpustakaan'],
            ['nama_instansi' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu'],
            ['nama_instansi' => 'Dinas Pengendalian Penduduk dan Keluarga Berencana'],
            ['nama_instansi' => 'Dinas Pemadam Kebakaran dan Penyelamatan'],
            ['nama_instansi' => 'Dinas Perumahan dan Kawasan Permukiman'],
            ['nama_instansi' => 'Dinas Pengelolaan Keuangan dan Aset Daerah'],
            ['nama_instansi' => 'Dinas Keamanan dan Ketertiban'],
            ['nama_instansi' => 'Dinas Perikanan dan Kelautan'],
        ]);
    }
}
