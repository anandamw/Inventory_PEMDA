<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Inventory;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function store(Request $request)
    {
       
        try {
            // Validasi request
            $request->validate([
                'items' => 'required|array',
                'items.*.id' => 'required|exists:inventories,id_inventories',
                'items.*.quantity' => 'required|integer|min:1',
                'events' => 'required|string',
                'phone' => 'required|string',
            ]);

            DB::transaction(function () use ($request) {
                // Buat order
                $order = Order::create([
                    'events' => $request->events,
                    'phone' => $request->phone,
                    'users_id' => Auth::id(),
                ]);

                // Proses setiap item dalam order
                foreach ($request->items as $item) {
                    // Ambil data inventory
                    $inventory = Inventory::where('id_inventories', $item['id'])->lockForUpdate()->first();

                    // Pastikan stok mencukupi
                    if ($inventory->quantity < $item['quantity']) {
                        throw new \Exception("Stok barang {$inventory->name} tidak mencukupi.");
                    }

                    // Kurangi stok barang
                    $inventory->quantity -= $item['quantity'];
                    $inventory->save();

                    // Simpan order item
                    OrderItem::create([
                        'users_id' => Auth::id(),
                        'inventories_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'status' => 'pending',
                        'orders_id' => $order->id_orders, // Jika ada relasi ke order
                    ]);
                }
            });

            toast('Berhasil mengambil barang', 'success');

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil disimpan!',
            ]);
        } catch (\Exception $e) {
           
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function post_profile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $filename);

            return response()->json(['message' => 'Upload berhasil', 'filename' => $filename]);
        }

        return response()->json(['message' => 'Upload gagal'], 400);
    }
}
