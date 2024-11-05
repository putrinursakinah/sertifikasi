<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nwidart\Modules\Process\Updater;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('backend.alumni.view_alumni', [
        //     'alumni'
        // ]);
        
        if (Auth::user()->id == '1') {
            $data = Alumni::all();
            return view('backend.alumni.view_alumni', ['data' => $data]);
        } else {
            $user = Auth::user()->id;
            $data = Alumni::all();
            return view('backend.alumni.view_alumni2', ['data' => $data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alumni = DB::table('users')->get();
        return view('backend.alumni.add_alumni', compact('alumni'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = new Alumni();
        $data->nama_lengkap = $request->nama_lengkap;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->tahun_lulus = $request->tahun_lulus;
        $data->nis = $request->nis;
        $data->alamat = $request->alamat;
        $data->email = $request->email;
        $data->telepon = $request->telepon;
        $data->handphone = $request->handphone;
        $data->foto = $request->file('foto')->store('alumni');
        $data->save();

        return redirect()->route('alumni.view')->with('message', 'Data Berhasil Ditambahkan');
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
        $alumni = Alumni::find($id);
        if (!$alumni) {
            return redirect()->back()->with('error', 'Data Alumni tidak ditemukan.');
        }
        return view('backend.alumni.edit_alumni', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Alumni::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data Alumni tidak ditemukan.');
        }
        $data->nama_lengkap = $request->nama_lengkap;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->tahun_lulus = $request->tahun_lulus;
        $data->nis = $request->nis;
        $data->alamat = $request->alamat;
        $data->email = $request->email;
        $data->telepon = $request->telepon;
        $data->handphone = $request->handphone;
        $data->foto = $request->foto;
        $data->update();

        return redirect()->route('alumni.view')->with('messege', 'Data Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteData = Alumni::find($id);
        $deleteData->delete();
        return redirect()->route('alumni.view')->with('message', 'Data Berhasil Dihapus');
    }
}
