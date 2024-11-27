<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->id == '1') {
            $data = Galeri::all();
            return view('backend.galeri.view_galeri', ['data' => $data]);
        } else {
            $user = Auth::user()->id;
            $data = Galeri::all();
            return view('backend.galeri.view_galeri2', ['data' => $data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alumni = DB::table('users')->get();
        return view('backend.galeri.add_galeri', compact('galeri'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Galeri();
        $data->title = $request->title;
        $data->deskripsi = $request->deskripsi;
        $data->foto= $request->file('foto')->store('galeri');
        $data->save();

        return redirect()->route('galeri.view')->with('message', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        //
    }
}
