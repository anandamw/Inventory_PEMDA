<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Exports\ExcelReExport;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RekapitulasiController extends Controller
{
    public function index()
    {


        $orders = DB::table('orders')
            ->join('users', 'orders.users_id', '=', 'users.id')
            ->join('order_items', 'orders.id_orders', '=', 'order_items.orders_id')
            ->select('orders.*', 'users.profile', 'users.nip', 'users.name', 'order_items.quantity', 'order_items.status', 'order_items.inventories_id')
            ->orderBy('orders.created_at', 'desc')
            ->get();



        $orderItem = OrderItem::join('orders', 'order_items.orders_id', '=', 'orders.id_orders')->join('inventories', 'order_items.inventories_id', 'inventories.id_inventories')->select('order_items.orders_id', 'order_items.quantity', 'order_items.id_order_items', 'order_items.status', 'inventories.item_name', 'orders.*')->get();

        $headerText = 'Rekapitulasi';

        return view('rekapitulasi.rekapitulasi', compact('orders', 'orderItem', 'headerText'));
    }



    public function fetchOrders($filter)
    {
        $query = Order::join('users', 'orders.users_id', '=', 'users.id')
            ->join('order_items', 'orders.id_orders', '=', 'order_items.orders_id')
            ->join('inventories', 'order_items.inventories_id', '=', 'inventories.id_inventories')
            ->select(
                'users.name as user_name',
                'orders.events',
                'orders.phone',
                'inventories.item_name',
                'order_items.quantity',
                'order_items.status',
                'orders.created_at'
            )
            ->where('order_items.status', 'success');

        if ($filter === 'day') {
            $query->whereDate('orders.created_at', now()->toDateString());
        } elseif ($filter === 'week') {
            $query->whereBetween('orders.created_at', [now()->subDays(7), now()]);
        } elseif ($filter === 'month') {
            $query->whereMonth('orders.created_at', now()->month);
        }

        $orders = $query->orderBy('orders.created_at', 'desc')->get();

        return response()->json($orders);
    }
}
