<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{


    public function index()
    {


        $headerText = 'Dashboard';
        $items = Inventory::orderBy('created_at', 'desc')->get();
        $orders = DB::table('orders')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->join('order_items', 'order_items.orders_id', '=', 'orders.id_orders')
            ->select(
                'users.name',
                'users.nip',
                'users.profile',
                'orders.events',
                'orders.phone',
                'orders.id_orders',
                'orders.created_at',
                'orders.users_id',
                DB::raw('MAX(order_items.status) as status')
            )
            ->where('users.role', Auth::user()->role) // Pastikan role diterapkan di users
            ->groupBy(
                'orders.id_orders',
                'users.name',
                'users.nip',
                'users.profile',
                'orders.events',
                'orders.phone',
                'orders.created_at',
                'orders.users_id'
            )
            ->orderByRaw("
        CASE 
            WHEN MAX(order_items.status) = 'success' THEN 1 
            ELSE 0 
        END, orders.created_at DESC
    ")
            ->paginate(10);

        $orderItem = OrderItem::join('orders', 'order_items.orders_id', '=', 'orders.id_orders')->join('inventories', 'order_items.inventories_id', 'inventories.id_inventories')->select('order_items.orders_id', 'order_items.quantity', 'order_items.id_order_items', 'order_items.status', 'inventories.item_name', 'orders.*')->get();

        $dataItem = Inventory::select('code_item', 'item_name', 'img_item', 'quantity')->get();

        // Hitung jumlah item yang stoknya kurang dari 10
        $lowStockCount = Inventory::where('quantity', '<', 10)->count();

        $dataLatest = OrderItem::join('users', 'order_items.users_id', '=', 'users.id')
            ->join('inventories', 'order_items.inventories_id', '=', 'inventories.id_inventories')->join('orders', 'order_items.orders_id', '=', 'orders.id_orders')
            ->where('users.role', Auth::user()->role)
            ->select(
                'order_items.id_order_items',
                'order_items.quantity',
                'order_items.status',
                'inventories.item_name',
                'inventories.code_item',
                'inventories.img_item',
                'users.name',
                'users.nip',
                'orders.events',
                'order_items.created_at'
            )
            ->orderBy('order_items.created_at', 'desc')
            ->get();

        toast('Selamat datang di layanan Logishub', 'info');

        return view('dashboard', compact('items', 'headerText', 'dataItem', 'dataLatest', 'orders', 'orderItem', 'lowStockCount'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'orders_id' => 'required|exists:orders,id_orders',
            'status' => 'required|in:pending,success,canceled',
            'recaps' => 'required|array',
            'recaps.*.id' => 'required|exists:order_items,id_order_items',
            'recaps.*.quantity' => 'required|integer|min:0',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Update status order items secara massal
                OrderItem::where('orders_id', $request->orders_id)
                    ->update(['status' => $request->status]);

                // Ambil semua order item terkait untuk mengurangi query
                $orderItems = OrderItem::whereIn('id_order_items', collect($request->recaps)->pluck('id'))
                    ->get()->keyBy('id_order_items');

                foreach ($request->recaps as $recapData) {
                    if (isset($orderItems[$recapData['id']])) {
                        $orderItem = $orderItems[$recapData['id']];
                        $quantityDifference = $recapData['quantity'] - $orderItem->quantity;

                        if ($quantityDifference !== 0) {
                            // Update quantity order item
                            $orderItem->update(['quantity' => $recapData['quantity']]);

                            // Update inventory
                            Inventory::where('id_inventories', $orderItem->inventories_id)
                                ->increment('quantity', -$quantityDifference);
                        }
                    }
                }
            });

            return response()->json([
                'message' => 'Data berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui data!',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function updateHistoryDashboard(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'recaps' => 'required|array',
            'recaps.*.id' => 'required|exists:order_items,id_order_items',
            'recaps.*.quantity' => 'required|integer|min:0', // Bisa 0 jika dihapus
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal!',
                'errors' => $validator->errors()
            ], 422);
        }

        // Loop untuk update semua data yang dikirim
        foreach ($request->recaps as $recapData) {
            $orderItem = OrderItem::where('id_order_items', $recapData['id'])->first();

            if ($orderItem) {
                $oldQuantity = $orderItem->quantity;
                $newQuantity = $recapData['quantity'];
                $quantityDifference = $newQuantity - $oldQuantity;

                // Update quantity
                $orderItem->update([
                    'quantity' => $newQuantity,

                ]);

                if ($quantityDifference > 0) {
                    Inventory::where('id_inventories', $orderItem->inventories_id)->decrement('quantity', $quantityDifference);
                } elseif ($quantityDifference < 0) {
                    Inventory::where('id_inventories', $orderItem->inventories_id)->increment('quantity', abs($quantityDifference));
                }
            }
        }

        return response()->json([
            'message' => 'Data berhasil diperbarui!'
        ]);
    }

    public function updateItemsDashboard(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'orders_id' => 'required|exists:orders,id_orders',
            'inventories_id' => 'required|exists:inventories,id_inventories',
            'quantity' => 'required|integer|min:1', // Minimal 1 jika ingin menambah item
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal!',
                'errors' => $validator->errors()
            ], 422);
        }

        // Gunakan transaksi untuk menjaga konsistensi data
        DB::beginTransaction();
        try {
            // Cari order item berdasarkan orders_id dan inventories_id
            $orderItem = OrderItem::where('orders_id', $request->orders_id)
                ->where('inventories_id', $request->inventories_id)
                ->first();

            if ($orderItem) {
                // Jika item sudah ada, update quantity
                $oldQuantity = $orderItem->quantity;
                $newQuantity = $request->quantity;
                $quantityDifference = $newQuantity - $oldQuantity;

                $orderItem->update(['quantity' => $newQuantity]);

                // Update stok di inventory berdasarkan perubahan quantity
                if ($quantityDifference > 0) {
                    // Jika bertambah, kurangi stok inventory
                    Inventory::where('id_inventories', $request->inventories_id)
                        ->decrement('quantity', $quantityDifference);
                } elseif ($quantityDifference < 0) {
                    // Jika berkurang, tambahkan stok inventory
                    Inventory::where('id_inventories', $request->inventories_id)
                        ->increment('quantity', abs($quantityDifference));
                }
            } else {
                // Jika tidak ditemukan, buat data baru
                OrderItem::create([
                    'users_id' => Auth::id(),
                    'inventories_id' => $request->inventories_id,
                    'quantity' => $request->quantity,
                    'orders_id' => $request->orders_id,
                    'status' => 'pending'
                ]);

                // Kurangi stok inventory saat item baru ditambahkan
                Inventory::where('id_inventories', $request->inventories_id)
                    ->decrement('quantity', $request->quantity);
            }

            DB::commit();
            return response()->json(['message' => 'Data berhasil diperbarui!'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan!', 'error' => $e->getMessage()], 500);
        }
    }
}
