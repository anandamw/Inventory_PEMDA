<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
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
        $items = Inventory::all();
        return view('item.item', compact('items'));
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
}
