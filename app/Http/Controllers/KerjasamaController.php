<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data kerjasama
        $data = Kerjasama::all();
        return view('backend.kerjasama.view_kerjasama', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kerjasama.add_kerjasama');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_kerjasama' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:Aktif,Selesai,Dibatalkan',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf|max:10240', // Validasi PDF
        ]);

        $data = new Kerjasama();
        $data->nama_mitra = $request->nama_mitra;
        $data->deskripsi_kerjasama = $request->deskripsi_kerjasama;
        $data->tanggal_mulai = $request->tanggal_mulai;
        $data->tanggal_berakhir = $request->tanggal_berakhir;
        $data->status = $request->status;

        // Menyimpan dokumen PDF jika ada
        if ($request->hasFile('dokumen_pendukung')) {
            $data->dokumen_pendukung = $request->file('dokumen_pendukung')->store('uploads/kerjasama/dokumen_kerjasama', 'public');
        }

        // Menyimpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $data->gambar = $request->file('gambar')->store('uploads/kerjasama/foto', 'public');
        }

        // Simpan data kerjasama ke database
        $data->save();

        return redirect()->route('kerjasama.view')->with('message', 'Data Kerjasama Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kerjasama = Kerjasama::find($id);
        if (!$kerjasama) {
            return redirect()->back()->with('error', 'Data Kerjasama tidak ditemukan.');
        }
        return view('backend.kerjasama.edit_kerjasama', compact('kerjasama'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_kerjasama' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:Aktif,Selesai,Dibatalkan',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf|max:10240', // Validasi PDF
        ]);

        $data = Kerjasama::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data Kerjasama tidak ditemukan.');
        }

        $data->nama_mitra = $request->nama_mitra;
        $data->deskripsi_kerjasama = $request->deskripsi_kerjasama;
        $data->tanggal_mulai = $request->tanggal_mulai;
        $data->tanggal_berakhir = $request->tanggal_berakhir;
        $data->status = $request->status;

        // Mengelola penggantian gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($data->gambar) {
                Storage::delete($data->gambar);
            }
            $data->gambar = $request->file('gambar')->store('uploads/kerjasama/foto', 'public');
        }

        // Mengelola penggantian dokumen PDF jika ada
        if ($request->hasFile('dokumen_pendukung')) {
            // Hapus dokumen lama jika ada
            if ($data->dokumen_pendukung) {
                Storage::delete($data->dokumen_pendukung);
            }
            $data->dokumen_pendukung = $request->file('dokumen_pendukung')->store('uploads/kerjasama/dokumen_kerjasama', 'public');
        }

        // Simpan data yang telah diperbarui
        $data->save();

        return redirect()->route('kerjasama.view')->with('message', 'Data Kerjasama Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kerjasama = Kerjasama::findOrFail($id);

        // Hapus gambar dan dokumen jika ada
        if ($kerjasama->gambar) {
            Storage::disk('public')->delete($kerjasama->gambar);
        }

        if ($kerjasama->dokumen_pendukung) {
            Storage::disk('public')->delete($kerjasama->dokumen_pendukung);
        }

        // Hapus data kerjasama
        $kerjasama->delete();

        return redirect()->route('kerjasama.view')->with('message', 'Data Kerjasama Berhasil Dihapus');
    }
}
