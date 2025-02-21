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
            ->select('users.name', 'users.nip', 'users.profile', 'orders.events', 'orders.phone', 'orders.id_orders', 'orders.created_at', 'orders.users_id')
            ->where('role', Auth::user()->role)
            ->orderBy('orders.created_at', 'desc')
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
                'users.nip',  // Pastikan nip ada dalam tabel users
                'orders.events',  // Pastikan nip ada dalam tabel users
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
            'status' => 'required|in:pending,success,canceled'
        ]);

        // Update semua order_items yang terkait dengan orders_id
        OrderItem::where('orders_id', $request->orders_id)->update(['status' => $request->status]);

        return response()->json(['message' => 'Status semua item berhasil diperbarui']);
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
        // Cari data order item berdasarkan order_id dan inventories_id
        $orderItem = OrderItem::where('orders_id', $request->orders_id)
            ->where('inventories_id', $request->inventories_id)
            ->first();

        if ($orderItem) {
            // Jika item sudah ada, kirim pesan tanpa mengupdate quantity
            return response()->json(['message' => 'Item sudah ada dalam daftar!'], 400);
        } else {
            // Jika tidak ditemukan, buat data baru
            OrderItem::create([
                'users_id' => Auth::id(),
                'inventories_id' => $request->inventories_id,
                'quantity' => $request->quantity,
                'orders_id' => $request->orders_id,
                'status' => 'pending'
            ]);

            return response()->json(['message' => 'Data berhasil ditambahkan'], 201);
        }
    }
}
