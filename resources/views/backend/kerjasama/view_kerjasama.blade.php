@extends('layouts.backend.app')

@section('title', 'Data Kerjasama')

@section('content')
    <div class="container-fluid">
        <!-- Menampilkan Pesan Sukses -->
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Judul dan Tombol Tambah Data -->
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="h3 mb-2 text-gray-800">Data Kerjasama</h1>
                </div>
                <div class="col text-end mb-2">
                    <a href="{{ route('kerjasama.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
        </div>

        <!-- Tabel Data Kerjasama -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Mitra</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Status</th>
                                <th>Dokumen Pendukung</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $kerjasama)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kerjasama->nama_mitra }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $kerjasama->gambar) }}" width="50"
                                            alt="Gambar Kerjasama">
                                    </td>

                                    <td>{{ $kerjasama->deskripsi_kerjasama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kerjasama->tanggal_mulai)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kerjasama->tanggal_berakhir)->format('d-m-Y') }}</td>
                                    <td>
                                        <span
                                            class="badge 
                                            @if ($kerjasama->status == 'Aktif') bg-success 
                                            @elseif($kerjasama->status == 'Selesai') bg-secondary 
                                            @elseif($kerjasama->status == 'Dibatalkan') bg-danger @endif">
                                            {{ $kerjasama->status }}
                                        </span>
                                    </td>
                                    <td>

                                        <a href="{{ asset('storage/' . $kerjasama->dokumen_pendukung) }}" target="_blank">
                                            <i class="fas fa-file-pdf"></i> Lihat PDF
                                        </a>

                                    </td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('kerjasama.edit', $kerjasama->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <!-- Form Hapus dengan Konfirmasi -->
                                        <form action="{{ route('kerjasama.destroy', $kerjasama->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE') <!-- Menggunakan metode DELETE -->
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
