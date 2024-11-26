<?php

namespace App\Http\Controllers;

use App\Models\Sambutan;
use Illuminate\Http\Request;

class SambutanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sambutan::all();
        return view('backend.sambutan.view_sambutan', compact('data'));
    }

    public function lihat()
    {
        $data = Sambutan::all();
        return view('backend.sambutan.view_sambutan', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.sambutan.add_sambutan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'isi' => 'nullable|file|mimes:pdf|max:2048', // File harus PDF
        ]);

        $data = new Sambutan();
        $data->judul = $request->judul;
        $data->penulis = $request->penulis;

        if ($request->hasFile('isi')) {
            $data->isi = $request->file('isi')->store('uploads/sambutan', 'public');
        }

        $data->save();

        return redirect()->route('sambutan.view')->with('message', 'Data Sambutan Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sambutan = Sambutan::find($id);
        if (!$sambutan) {
            return redirect()->back()->with('error', 'Data Sambutan tidak ditemukan.');
        }
        return view('backend.sambutan.edit_sambutan', compact('sambutan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Cari data sambutan berdasarkan ID
        $sambutan = Sambutan::find($id);

        if (!$sambutan) {
            return redirect()->back()->with('error', 'Sambutan tidak ditemukan.');
        }

        // Validasi atau proses data yang ingin diperbarui
        $sambutan->judul = $request->judul;
        $sambutan->penulis = $request->penulis;

        if ($request->hasFile('isi')) {
            $sambutan->isi = $request->file('isi')->store('sambutan');
        }

        // Simpan perubahan
        $sambutan->save();

        return redirect()->route('sambutan.view')->with('message', 'Sambutan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteData = Sambutan::find($id);
        if ($deleteData) {
            $deleteData->delete();
        }
        return redirect()->route('sambutan.view')->with('message', 'Data Sambutan Berhasil Dihapus');
    }
}
