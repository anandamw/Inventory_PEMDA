<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Repair;
use App\Models\Inventory;
use App\Models\OrderItem;
use App\Models\RepairTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class DashboardController extends Controller
{
    public function updateOrderItems(Request $request)
    {
        try {
            \Log::info("Request masuk:", $request->all()); // Log data request untuk debug

            // Update item yang sudah ada di tabel order_items
            foreach ($request->updatedItems as $item) {
                $update = OrderItem::where('id_order_items', $item['id_order_items'])
                    ->update(['quantity' => $item['quantity']]);

                if (!$update) {
                    \Log::error("Gagal update item ID: " . $item['id_order_items']);
                }
            }

            // Tambahkan item baru ke tabel order_items
            foreach ($request->newItems as $newItem) {
                OrderItem::create([
                    'orders_id' => $newItem['orders_id'],
                    'inventories_id' => $newItem['inventories_id'],
                    'quantity' => $newItem['quantity'],
                    'status' => 'pending',
                    'users_id' => auth()->user()->id
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error("Error updateOrderItems: " . $e->getMessage()); // Log error untuk debug
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function updateOrderItemsStatus(Request $request)
    {
        try {
            \Log::info('Menerima request update status', ['request' => $request->all()]);

            // Validasi input
            $request->validate([
                'orderId' => 'required|exists:orders,id_orders', // Pastikan pakai id_orders
                'updatedItems.*.id_order_items' => 'nullable|exists:order_items,id_order_items',
                'updatedItems.*.quantity' => 'required|integer|min:1',
                'newItems.*.inventories_id' => 'required|exists:inventories,id_inventories',
                'newItems.*.quantity' => 'required|integer|min:1',
                'status' => 'nullable|string|in:pending,success,canceled' // Pastikan status valid
            ]);

            // 🔹 Update status semua order_items berdasarkan orders_id
            if ($request->has('status')) {
                OrderItem::where('orders_id', $request->orderId)->update(['status' => $request->status]);
            }

            // 🔹 Update existing items
            foreach ($request->updatedItems as $item) {
                if (!empty($item['id_order_items'])) {
                    OrderItem::where('id_order_items', $item['id_order_items'])->update([
                        'quantity' => $item['quantity']
                    ]);
                }
            }

            // 🔹 Insert new items
            foreach ($request->newItems as $item) {
                OrderItem::create([
                    'inventories_id' => $item['inventories_id'],
                    'quantity' => $item['quantity'],
                    'orders_id' => $request->orderId,
                    'status' => $item['status'] ?? 'pending',
                    'users_id' => auth()->user()->id // Pastikan users_id tidak null
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Perubahan berhasil disimpan.']);
        } catch (\Exception $e) {
            \Log::error('Gagal memperbarui pesanan', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function opdDashboard()
    {
        $headerText = 'Home';
        $totalInventories = Inventory::count();
        $totalQuantity = \App\Models\Inventory::sum('quantity');
        $users = User::whereIn('role', ['admin', 'team'])->get();
        $totalTeams = User::where('role', 'team')->count();
        // Ambil repair yang terkait dengan user (sama kayak logic di index tadi)
        $repairs = Repair::with(['user', 'admin'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();


        $userRepairs = Repair::where('user_id', auth()->id())
            ->with(['admin', 'repairTeam'])
            ->orderBy('scheduled_date', 'desc')
            ->get();


        // Ambil semua tim dengan rating
        $repairTeams = \App\Models\RepairTeam::whereNotNull('rating')->get();

        // Hitung rata-rata rating keseluruhan (C)
        $totalRating = $repairTeams->sum('rating');
        $totalJobs = $repairTeams->count();
        $C = $totalJobs > 0 ? $totalRating / $totalJobs : 0;

        // Hitung rata-rata jumlah pekerjaan per user untuk dijadikan $m
        $jobPerUser = $repairTeams->groupBy('user_id')->map->count();
        $m = $jobPerUser->avg(); // rata-rata jumlah pekerjaan per user

        // Hitung weighted rating per user
        $ratarating = $repairTeams->groupBy('user_id')->map(function ($items) use ($C, $m) {
            $v = $items->count(); // jumlah pekerjaan user
            $R = $items->avg('rating'); // rata-rata rating user

            // Weighted Rating (semakin banyak pekerjaan, semakin mendekati R)
            $WR = (($v / ($v + $m)) * $R) + (($m / ($v + $m)) * $C);
            return $WR;
        });



        return view('home', compact('headerText', 'repairs', 'userRepairs', 'totalInventories', 'users', 'totalQuantity', 'totalTeams', 'ratarating'));
    }


    public function index()
    {
        $headerText = 'Dashboard';
        $items = Inventory::whereNotIn('id_inventories', function ($query) {
            $query->select('inventories_id')
                ->from('order_items')
                ->where('status', 'pending');
        })
            ->orderBy('created_at', 'desc')
            ->get();

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
            ->where('users.role', Auth::user()->role)

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

        $orderItem = OrderItem::join('orders', 'order_items.orders_id', '=', 'orders.id_orders')
            ->join('inventories', 'order_items.inventories_id', 'inventories.id_inventories')
            ->select(
                'order_items.orders_id',
                'order_items.quantity',
                'order_items.id_order_items',
                'order_items.status',
                'inventories.item_name',
                'inventories.id_inventories', // Tambahkan ini agar bisa digunakan untuk filtering di Blade
                'orders.*'
            )
            ->get();


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

        $teams = User::where('role', 'team')->get();

        if (auth()->user()->role == 'admin') {
            // Admin lihat semua repair
            $repairs = Repair::with(['user', 'admin'])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // User hanya lihat repair milik sendiri
            $repairs = Repair::with(['user', 'admin'])
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $teamRepairs = Repair::whereHas('teams', function ($query) {
            $query->where('users.id', auth()->id());  // cek user login apakah bagian dari team
        })
            ->with(['user', 'admin'])
            ->whereNotIn('status', ['completed', 'expired']) // Menyembunyikan status 'completed' dan 'expired'
            ->orderBy('scheduled_date', 'desc')
            ->get();


        // Data perbaikan khusus untuk user yang login - yang dia kirimkan
        $userRepairs = Repair::where('user_id', auth()->id())
            ->with('admin')
            ->orderBy('scheduled_date', 'desc')
            ->get();

        return view('dashboard', compact('items', 'headerText', 'dataItem', 'dataLatest', 'orders', 'orderItem', 'lowStockCount', 'repairs', 'userRepairs', 'teams', 'teamRepairs'));
    }

    /**
     * Simpan laporan perbaikan dari user
     */
    public function storeRepair(Request $request)
    {
        \Log::info('Previous URL:', ['url' => url()->previous()]);
        \Log::info('Current Auth User:', ['user' => auth()->user()]);

        $request->validate([
            'repair' => 'required|string',
        ]);

        Repair::create([
            'user_id' => auth()->id(),
            'repair' => $request->repair,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Laporan perbaikan berhasil dikirim!');
    }


    /**
     * Jadwalkan perbaikan oleh admin
     */
    public function scheduleRepair(Request $request, $id)
    {
        $repair = Repair::findOrFail($id);

        $request->validate([
            'scheduled_date' => 'required|date',
            'note' => 'nullable|string|max:255',
            'team_ids' => 'required|array',
            'team_ids.*' => 'exists:users,id'
        ]);

        if ($repair->status === 'failed') {
            // Create a new repair entry with 'scheduled' status
            $newRepair = Repair::create([
                'user_id' => $repair->user_id,
                'admin_id' => auth()->id(),
                'repair' => $repair->repair,
                'scheduled_date' => $request->scheduled_date,
                'status' => 'scheduled',
            ]);

            // Assign new team to the newly created repair
            $newRepair->teams()->sync($request->team_ids);

            // Update the old failed repair status to 'expired'
            $repair->update([
                'status' => 'expired'
            ]);

            return redirect()->back()->with('success', 'Previous failed repair has been marked as expired, and a new repair has been scheduled.');
        }

        // If the repair is not 'failed', update the existing repair
        $repair->update([
            'status' => 'scheduled',
            'scheduled_date' => $request->scheduled_date,
            'note' => $request->note,
            'admin_id' => auth()->id()
        ]);

        $repair->teams()->sync($request->team_ids);

        return redirect()->back()->with('success', 'Repair successfully scheduled.');
    }



    // Assign ke tim (biasanya dari form admin)
    public function assignToTeam(Request $request, $id)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $repair = Repair::findOrFail($id);
        $repair->update([
            'team_id' => $request->team_id,
            'status' => 'in_progress',
        ]);

        return back()->with('success', 'Perbaikan telah diassign ke tim.');
    }

    // Tim klik "Selesai"
    public function complete($id)
    {
        // Cari perbaikan berdasarkan ID
        $repair = Repair::findOrFail($id);

        // Cek apakah user tergabung dalam tim yang menangani perbaikan ini
        $isUserInTeam = \DB::table('repair_teams')
            ->where('repair_id', $repair->id_repair)
            ->where('user_id', auth()->id())
            ->exists();

        if (!$isUserInTeam) {
            return back()->with('error', 'Anda tidak tergabung dalam tim perbaikan ini.');
        }

        // Hanya update perbaikan yang dipilih
        $repair->update([
            'status' => 'completed'
        ]);

        return back()->with('success', 'Perbaikan telah diselesaikan.');
    }






    /**
     * Hapus laporan perbaikan
     */
    public function deleteRepair($id)
    {
        $repair = Repair::findOrFail($id);
        $repair->delete();

        return back()->with('success', 'Laporan perbaikan berhasil dihapus!');
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

    public function notifToOpd()
    {
        $overdueRepairs = Repair::where('scheduled_date', '<', Carbon::today())
            ->where('status', 'scheduled')
            ->get();
    }
}
