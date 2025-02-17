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
        // $historys = OrderItem::join('users', 'order_items.users_id', '=', 'users.id')->join('inventories', 'order_items.inventories_id', '=', 'inventories.id_inventories')->select('order_items.quantity', 'inventories.item_name', 'users.name', 'inventories.img_item', 'users.role', 'order_items.status', 'users.nip')->get();

        $orders = DB::table('orders')->join('users', 'orders.users_id', '=', 'users.id')->select('users.name', 'users.nip', 'orders.events', 'orders.phone', 'orders.id_orders', 'orders.created_at', 'orders.users_id')->orderBy('orders.id_orders')->paginate(10);


        $orderItem = OrderItem::join('orders', 'order_items.orders_id', '=', 'orders.id_orders')->join('inventories', 'order_items.inventories_id', 'inventories.id_inventories')->select('order_items.orders_id', 'order_items.quantity', 'order_items.id_order_items', 'order_items.status', 'inventories.item_name', 'orders.*')->get();

        $dataItem = Inventory::where('quantity', '<', 10)->select('code_item', 'item_name', 'quantity')->get();
        return view('dashboard', compact('headerText', 'orderItem', 'orders', 'dataItem'));
    }


    // public function updateHistoryDashboard(Request $request){
    //     // Validasi input
    //     $validator = Validator::make($request->all(), [
    //         'recaps' => 'required|array',
    //         'recaps.*.id' => 'required|exists:order_items,id_order_items',
    //         'recaps.*.quantity' => 'required|integer|min:1',
    //         'recaps.*.status' => 'required|in:pending,success',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Validasi gagal!',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     // Loop untuk update semua data yang dikirim
    //     foreach ($request->recaps as $recapData) {
    //         OrderItem::where('id_order_items', $recapData['id'])->update([
    //             'quantity' => $recapData['quantity'],
    //             'status' => $recapData['status']
    //         ]);
    //     }

    //     return response()->json([
    //         'message' => 'Data berhasil diperbarui!'
    //     ]);
    // }


    public function updateHistoryDashboard(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'recaps' => 'required|array',
        'recaps.*.id' => 'required|exists:order_items,id_order_items',
        'recaps.*.quantity' => 'required|integer|min:0', // Bisa 0 jika dihapus
        'recaps.*.status' => 'required|in:pending,success',
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
                'status' => $recapData['status']
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



    // public function index()
    // {


    //     $headerText = 'Dashboard';


    //     $dataItem = Inventory::where('quantity', '<', 10)->select('code_item', 'item_name', 'quantity')->get();


    //     $dataLatest = OrderItem::join('users', 'order_items.users_id', '=', 'users.id')
    //         ->join('inventories', 'order_items.inventories_id', '=', 'inventories.id_inventories')->join('orders', 'order_items.orders_id', '=', 'orders.id_orders')
    //         ->where('users.role', Auth::user()->role)
    //         ->select(
    //             'order_items.id_order_items',
    //             'order_items.quantity',
    //             'order_items.status',
    //             'inventories.item_name',
    //             'inventories.code_item',
    //             'inventories.img_item',
    //             'users.name',
    //             'users.nip',  // Pastikan nip ada dalam tabel users
    //             'orders.events',  // Pastikan nip ada dalam tabel users
    //             'order_items.created_at'
    //         )
    //         ->orderBy('order_items.created_at', 'desc')
    //         ->get();






    //     toast('Selamat datang di layanan Logishub', 'info');

    //     return view('dashboard', compact('headerText', 'dataItem', 'dataLatest'));
    // }
}
