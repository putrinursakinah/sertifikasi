@extends('layouts.backend.app')
@section('title', 'Data Kerjasama')
@section('content')
    <div class="container-fluid">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="h3 mb-2 text-gray-800">Data Kerjasama</h1>
                </div>
                <div class="col text-end mb-2">
                    <a href="{{ route('kerjasama.add') }}">
                        <button type="button" class="btn btn-primary">Tambah Data</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Mitra</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $kerjasama)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kerjasama->nama_mitra }}</td>
                                    <td><img src="{{ asset('uploads/' . $kerjasama->gambar) }}" width="50"></td>
                                    <td>
                                        <a href="{{ route('kerjasama.edit', $kerjasama->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>
                                        <!-- Tombol Delete dengan konfirmasi -->
                                        <a href="#" class="btn btn-danger btn-sm"
                                            onclick="event.preventDefault(); confirmDelete('{{ route('kerjasama.delete', $kerjasama->id) }}');">
                                            <i class="fas fa-trash"> Delete</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(url) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                window.location.href = url;
            }
        }
    </script>
@endsection
