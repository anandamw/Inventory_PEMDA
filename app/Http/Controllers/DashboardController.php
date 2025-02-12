<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {


        $headerText = 'Dashboard';


        $dataItem = Inventory::where('quantity', '<', 10)->select('code_item', 'item_name', 'quantity')->get();



        $dataLatest = OrderItem::join('users', 'order_items.users_id', '=', 'users.id')
            ->join('inventories', 'order_items.inventories_id', '=', 'inventories.id_inventories')
            ->where('users.role', Auth::user()->role)
            ->select('order_items.quantity', 'inventories.item_name', 'inventories.code_item', 'users.name', 'inventories.img_item', 'order_items.status', 'order_items.id_order_items')
            ->orderBy('order_items.created_at', 'desc') // Menambahkan pengurutan berdasarkan created_at
            ->get();




            
        toast('Selamat datang di layanan Logishub', 'info');

        return view('dashboard', compact('headerText', 'dataItem', 'dataLatest'));
    }
}
