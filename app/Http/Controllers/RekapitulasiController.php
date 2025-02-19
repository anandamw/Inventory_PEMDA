<?php

namespace App\Http\Controllers;

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
 
        
        $orders = DB::table('orders')->join('users', 'orders.users_id', '=', 'users.id')->select('users.name', 'users.nip', 'users.profile', 'orders.events', 'orders.phone', 'orders.id_orders', 'orders.created_at', 'orders.users_id')->orderBy('orders.id_orders')->paginate(10);


        $orderItem = OrderItem::join('orders', 'order_items.orders_id', '=', 'orders.id_orders')->join('inventories', 'order_items.inventories_id', 'inventories.id_inventories')->select('order_items.orders_id', 'order_items.quantity', 'order_items.id_order_items', 'order_items.status', 'inventories.item_name', 'orders.*')->get();

        $headerText = 'Rekapitulasi';

        return view('rekapitulasi.rekapitulasi', compact('orders', 'orderItem','headerText'));
    }



    public function export_excel(){
        return Excel::download(new ExcelReExport, 'Rekapitulasi.xlsx');
    }

}
