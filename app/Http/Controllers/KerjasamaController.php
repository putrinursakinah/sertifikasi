<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->id == '1') {
            $data = Kerjasama::all();
            return view('backend.kerjasama.view_kerjasama', ['data' => $data]);
        } else {
            $user = Auth::user()->id;
            $data = Kerjasama::all();
            return view('backend.kerjasama.view_kerjasama2', ['data' => $data]);
        }
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
        $data = new Kerjasama();
        $data->nama_mitra = $request->nama_mitra;
        if ($request->hasFile('gambar')) {
            $data->gambar = $request->file('gambar')->store('kerjasama');
        }
        $data->save();

        return redirect()->route('kerjasama.view')->with('message', 'Data Kerjasama Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $data = Kerjasama::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data Kerjasama tidak ditemukan.');
        }
        $data->nama_mitra = $request->nama_mitra;
        if ($request->hasFile('gambar')) {
            $data->gambar = $request->file('gambar')->store('kerjasama');
        }
        $data->update();

        return redirect()->route('kerjasama.view')->with('message', 'Data Kerjasama Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteData = Kerjasama::find($id);
        $deleteData->delete();
        return redirect()->route('kerjasama.view')->with('message', 'Data Kerjasama Berhasil Dihapus');
    }
}
