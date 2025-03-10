<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Instansi;

class InstansiController extends Controller
{
    public function index()
    {
        $headerText = 'Data Instansi';
        $instansis = Instansi::all();

        $title = 'Delete It!';
        $text = "Apakah anda yakin ingin menghapusnya?";
        confirmDelete($title, $text);

        return view('instansi.instansi', compact('instansis', 'headerText'));
    }

    
    public function store(Request $request)
    {
        $request->validate(['nama_instansi' => 'required']);
        Instansi::create($request->all());
        return redirect()->route('instansi.instansi')->with('success', 'Instansi berhasil ditambahkan');
    }

    public function update(Request $request, $id_instansi)
    {
        $request->validate([
            'nama_instansi' => 'required'
        ]);
    
        $instansi = Instansi::findOrFail($id_instansi); // Cari instansi berdasarkan ID
        $instansi->update([
            'nama_instansi' => $request->nama_instansi
        ]);
    
        return redirect()->route('instansi.instansi')->with('success', 'Instansi berhasil diperbarui');
    }
    

    public function destroy($id_instansi)
    {
        $instansi = Instansi::findOrFail($id_instansi);
        $instansi->delete();
    
        return redirect('/instansi');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $category = $request->input('category');

        $query = Instansi::query();

        if ($category && $category !== 'all') {
            $query->where('nama_instansi', 'like', "%$category%");
        }

        if ($keyword) {
            $query->where('nama_instansi', 'like', "%$keyword%");
        }

        $results = $query->get();
        return response()->json($results);
    }


    
}
