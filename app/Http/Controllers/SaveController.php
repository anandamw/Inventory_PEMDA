<?php

namespace App\Http\Controllers;

use App\Models\order_items;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function store(Request $request)
    {
        \Log::info("Request received: ", $request->all());

        try {
            $request->validate([
                'items' => 'required|array',
                'items.*.id' => 'required|exists:inventories,id_inventories',
                'items.*.quantity' => 'required|integer|min:1'
            ]);

            foreach ($request->items as $item) {
                order_items::create([
                    'users_id' => Auth::id(),
                    'inventories_id' => $item['id'],
                    'quantity' => $item['quantity']
                ]);
            }

            toast('Berhasil mengambil barang', 'success');
            return response()->json(['success' => true, 'message' => 'Pesanan berhasil disimpan!']);
        } catch (\Exception $e) {
            \Log::error("Error saving order: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
