<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\order_items;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{

    public function save(Request $request)
    {
        // Log permintaan yang diterima
        Log::info('Request received:', $request->all());

        // Validasi data yang diterima
        $validatedData = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:inventories,id_inventories', // Pastikan ini sesuai dengan kolom di tabel inventories
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Log data yang telah divalidasi
        Log::info('Validated data:', $validatedData);

        // Simpan setiap item ke dalam tabel order_items
        foreach ($validatedData['items'] as $item) {
            order_items::create([
                'users_id' => auth()->user()->id, // Pastikan pengguna sudah terautentikasi
                'inventories_id' => $item['id'], // Ganti dengan nama kolom yang sesuai
                'quantity' => $item['quantity'],
            ]);
        }

        // Log pesan sukses
        Log::info('Data successfully saved.');

        return response()->json(['message' => 'Data berhasil disimpan!']);
    }
}
