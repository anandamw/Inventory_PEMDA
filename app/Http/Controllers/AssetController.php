<?php

// Asset Controller
namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function index()
    {
        $headerText = 'Data Aset';
        $assets = Asset::all();
        return view('aset.aset', compact('assets','headerText'));
    }

    public function updateStatus(Request $request, $id)
    {
        $asset = Asset::findOrFail($id);
        $asset->status = $request->status;
    
        if ($request->status == 'pending') {
            $asset->description = $request->description; // Simpan deskripsi baru dari user
        } else {
            $asset->description = "-"; // Reset ke default
        }
    
        $asset->save();
    
        return response()->json(['success' => true, 'description' => $asset->description]);
    }
    


    public function create()
    {    $headerText = 'Create Aset';
        return view('aset.aset_create', compact('headerText'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'image' => 'image|nullable',
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::random(12) . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/aset'), $fileName);
    
            // Tambahkan nama file ke dalam array data yang akan disimpan
            $validated['image'] = $fileName;
        }
    
        Asset::create($validated);
    
        return redirect()->route('aset.aset')->with('success', 'Asset added successfully');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $asset = Asset::findOrFail($id);
        $asset->name = $request->name;
        $asset->quantity = $request->quantity;
    
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($asset->image && file_exists(public_path('uploads/aset/' . $asset->image))) {
                unlink(public_path('uploads/aset/' . $asset->image));
            }
    
            // Simpan gambar di public/uploads/aset
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/aset/'), $filename);
            $asset->image = $filename;
        }
    
        $asset->save();
    
        return response()->json(['success' => true, 'message' => 'Asset updated successfully', 'asset' => $asset]);
    }
    

    public function destroy($id)
    {
        $aset = Asset::findOrFail($id);
        // Hapus gambar jika ada
        $imagePath = public_path('uploads/aset/' . $aset->image);

if (Storage::exists($imagePath)) {
    Storage::delete($imagePath);
}

        $aset->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus');
    }
}
