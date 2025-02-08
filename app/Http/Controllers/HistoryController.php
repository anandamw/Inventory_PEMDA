<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\order_items;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headerText = 'Data History';
        // $historys = OrderItem::join('users', 'order_items.users_id', '=', 'users.id')->join('inventories', 'order_items.inventories_id', '=', 'inventories.id_inventories')->select('order_items.quantity', 'inventories.item_name', 'users.name', 'inventories.img_item', 'users.role', 'order_items.status', 'users.nip')->get();

        $orders = DB::table('orders')->join('users', 'orders.users_id', '=', 'users.id')->select('users.name', 'users.nip', 'orders.events', 'orders.phone', 'orders.id_orders', 'orders.created_at', 'orders.users_id')->get();


        $orderItem = OrderItem::join('orders', 'order_items.orders_id', '=', 'orders.id_orders')->join('inventories', 'order_items.inventories_id', 'inventories.id_inventories')->get();


        return view('history.history', compact('headerText', 'orderItem', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
