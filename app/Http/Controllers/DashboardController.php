<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {


        $headerText = 'Dashboard';


        $dataItem = Inventory::where('quantity', '<', 10)->select('code_item', 'item_name', 'quantity')->get();


        $dataLatest = OrderItem::join('users', 'order_items.users_id', '=', 'users.id')->join('inventories', 'order_items.inventories_id', '=', 'inventories.id_inventories')->select('order_items.quantity', 'inventories.item_name', 'users.name', 'inventories.img_item')->get();


        toast('Selamat datang di layanan Logishub', 'info');

        return view('dashboard', compact('headerText', 'dataItem', 'dataLatest'));
    }
}
