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
     * Tampilkan daftar inventory
     */
    public function index()
    {
        $headerText = 'Data Inventory';
        $items = Inventory::orderBy('created_at', 'desc')->get();
        return view('item.item', compact('items', 'headerText'));
    }

    /**
     * Form tambah inventory baru
     */
    public function create()
{
    $headerText = 'Add Item';
    return view('item.item_create', compact('headerText'));  // Pastikan untuk membuat view dengan nama 'item.create'
}

    /**
     * Simpan data baru ke database
     */
    public function store(Request $request)
    {
 
        $request->validate([
            'item_name' => 'required|string',
            'img_item' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' => 'required|integer',
    
        ]);

        $fileName = null;

        if ($request->hasFile('img_item')) {
            $file = $request->file('img_item');
            $fileName = Str::random(12) . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/items'), $fileName);
        }

        $code_item = Str::random(6);

      Inventory::create([
            'item_name' => $request->item_name,
            'img_item' => $fileName,
            'quantity' => $request->quantity,
            'code_item' => $code_item,
        ]);
 

        return redirect("inventory") ;
    }

    /**
     * Update data inventory
     */
    public function update(Request $request, $id_inventories)
    {
        // Cari item berdasarkan `id_inventories`
        $item = Inventory::where('id_inventories', $id_inventories)->first();
    
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item tidak ditemukan!'], 404);
        }
    
        // Validasi input
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'img_item' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Update data
        $item->item_name = $request->item_name;
        $item->quantity = $request->quantity;
    
        // Cek apakah ada gambar baru
        if ($request->hasFile('img_item')) {
            // Hapus gambar lama jika ada
            if ($item->img_item && file_exists(public_path('uploads/items/' . $item->img_item))) {
                unlink(public_path('uploads/items/' . $item->img_item));
            }
    
            // Simpan gambar baru
            $file = $request->file('img_item');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/items/'), $filename);
            $item->img_item = $filename;
        }
    
        // Simpan perubahan ke database
        $item->save();
    
        return response()->json(['success' => true, 'message' => 'Item berhasil diperbarui!']);
    }
    

    /**
     * Hapus data inventory
     */
    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
    
        // Cek apakah data ditemukan sebelum menghapus
        if (!$inventory) {
            return redirect()->back()->with('error', 'Item tidak ditemukan');
        }
    
        
    
        // Hapus gambar jika ada
        if ($inventory->img_item) {
            $imagePath = public_path('uploads/items/' . $inventory->img_item);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        // Hapus item dari database
        $inventory->delete();
    
        return redirect()->back()->with('success', 'Item berhasil dihapus');
    }
}
