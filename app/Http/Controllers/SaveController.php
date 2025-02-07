<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Models\OrderItem;
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
            // Validate the incoming data
            $request->validate([
                'items' => 'required|array',
                'items.*.id' => 'required|exists:inventories,id_inventories',
                'items.*.quantity' => 'required|integer|min:1',
                'events' => 'required|string',
                'phone' => 'required|string'
            ]);

            // Save the items in the order_items table
            foreach ($request->items as $item) {
                OrderItem::create([
                    'users_id' => Auth::id(),
                    'inventories_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'status' => 'pending'
                ]);
            }

            Order::create([
                'events' => $request->events,
                'phone' => $request->phone,
                'users_id' => Auth::id(),
            ]);


            toast('Berhasil mengambil barang', 'success');
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil disimpan!',
            ]);
        } catch (\Exception $e) {
            \Log::error("Error saving order: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
