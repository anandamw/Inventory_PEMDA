<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headerText = 'Data Inventory';
        $items = Inventory::all();
        return view('item.item', compact('items'), compact('headerText'));
    }

    public function create()
    {
        $headerText = 'Add Item';
        return view('item.item_create', compact('headerText'));  // Pastikan untuk membuat view dengan nama 'item.create'
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'img_product' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer',
        ]);

        $token = Str::random(12);

        // Simpan file gambar
        $file = $request->file('img_product');
        $fileName = $token . '_' . $file->getClientOriginalName();
        $file->move(public_path('img_product'), $fileName);

        // Simpan data ke database
        Inventory::create([
            'product_name' => $request->product_name,
            'img_product' => $fileName, // Tidak boleh null karena required
            'quantity' => $request->quantity,
        ]);

        return redirect('/inventory')->with('success', 'Produk berhasil ditambahkan');
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'img_product' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer',
        ]);

        $inventory = Inventory::findOrFail($id);

        $data = [
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
        ];

        // Cek apakah ada file baru yang diunggah
        if ($request->hasFile('img_product') && $request->file('img_product')->isValid()) {
            $file = $request->file('img_product');
            $token = Str::random(12);
            $fileName = $token . '_' . $file->getClientOriginalName();

            // Hapus gambar lama jika ada
            if ($inventory->img_product) {
                $oldImagePath = public_path('img_product/' . $inventory->img_product);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Simpan file baru
            $file->move(public_path('img_product'), $fileName);
            $data['img_product'] = $fileName;
        }

        // Update data di database
        $inventory->update($data);

        return redirect('/inventory')->with('success', 'Data berhasil diperbarui');
    }


    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);

        // Hapus gambar produk jika ada
        if ($inventory->img_product) {
            $imagePath = public_path('img_product/' . $inventory->img_product);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus data dari database
        $inventory->delete();

        return redirect('/inventory')->with('success', 'Data berhasil dihapus');
    }


    // public function revised(Request $request, $id)
    // {
    //     \Log::info('=== DEBUG: Request diterima di revised() ===', [
    //         'id' => $id,
    //         'data' => $request->all()
    //     ]);

    //     // Validasi untuk quantity: apakah lebih besar dari atau sama dengan 1, atau negatif
    //     $request->validate([
    //         'quantity' => 'required|integer'
    //     ]);

    //     // Ambil data quantity yang dikirim
    //     $set = $request->quantity;

    //     // Ambil order item berdasarkan ID
    //     $orderItem = OrderItem::where('id_order_items', $id)->first();

    //     if (!$orderItem) {
    //         \Log::error('=== ERROR: Order item tidak ditemukan ===');
    //         return response()->json(['error' => 'Order item tidak ditemukan'], 404);
    //     }

    //     // Variabel untuk hasil update
    //     $result = 0;

    //     // Logika penyesuaian quantity
    //     if ($set < 0) {
    //         // Kurangi quantity
    //         $result = $orderItem->quantity + $set;  // set negatif berarti mengurangi

    //         Inventory::where('id_inventories', $id)->update([
    //             'quantity' => 
    //         ]);
    //     } elseif ($set > 0) {
    //         // Tambah quantity
    //         $result = $orderItem->quantity + $set;  // set positif berarti menambah
    //         Inventory::where('id_inventories', $id)->update([
    //             'quantity' => 
    //         ]);
    //     }

    //     // Cek apakah quantity tidak menjadi negatif setelah pengurangan
    //     if ($result < 0) {
    //         return response()->json(['error' => 'Jumlah quantity tidak bisa menjadi negatif'], 400);
    //     }

    //     // Update quantity
    //     $orderItem->quantity = $result;
    //     $orderItem->save();

    //     \Log::info('=== DEBUG: Order item berhasil diperbarui ===', ['order_item' => $orderItem]);

    //     return response()->json([
    //         'success' => 'Quantity berhasil diperbarui',
    //         'order_item' => $orderItem
    //     ]);
    // }

    public function revised(Request $request, $id)
    {
        \Log::info('=== DEBUG: Request diterima di revised() ===', [
            'id' => $id,
            'data' => $request->all()
        ]);

        // Validasi request quantity (tidak boleh 0)
        $request->validate([
            'quantity' => 'required|integer|not_in:0'
        ], [
            'not_in' => 'Quantity tidak boleh 0'
        ]);

        $set = $request->quantity;

        // Ambil order item berdasarkan ID
        $orderItem = OrderItem::where('id_order_items', $id)->first();

        if (!$orderItem) {
            \Log::error('=== ERROR: Order item tidak ditemukan ===');
            return response()->json(['error' => 'Order item tidak ditemukan'], 404);
        }

        // Ambil data inventory berdasarkan inventories_id dari order item
        $inventory = Inventory::where('id_inventories', $orderItem->inventories_id)->first();

        if (!$inventory) {
            \Log::error('=== ERROR: Inventory tidak ditemukan ===');
            return response()->json(['error' => 'Inventory tidak ditemukan'], 404);
        }

        $newOrderQuantity = $orderItem->quantity + $set;
        $newInventoryQuantity = $inventory->quantity - $set;

        // Pastikan inventory tidak menjadi negatif
        if ($newInventoryQuantity < 0) {
            return response()->json(['error' => 'Jumlah quantity di inventory tidak mencukupi'], 400);
        }

        // Update order item dan inventory
        $orderItem->quantity = $newOrderQuantity;
        $orderItem->save();

        $inventory->quantity = $newInventoryQuantity;
        $inventory->save();

        \Log::info('=== DEBUG: Order item dan inventory berhasil diperbarui ===', [
            'order_item' => $orderItem,
            'inventory' => $inventory
        ]);

        return response()->json([
            'success' => 'Quantity berhasil diperbarui',
            'order_item' => $orderItem,
            'inventory' => $inventory
        ]);
    }
}
