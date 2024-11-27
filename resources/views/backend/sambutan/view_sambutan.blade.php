@extends('layouts.backend.app')
@section('title', 'Data Sambutan')
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
                    <h1 class="h3 mb-2 text-gray-800">Data Sambutan</h1>
                </div>
                <div class="col text-end mb-2">
                    <a href="{{ route('sambutan.add') }}">
                        <button type="button" class="btn btn-primary">Tambah Sambutan</button>
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
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Isi (PDF)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $sambutan)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sambutan->judul }}</td>
                                    <td>{{ $sambutan->penulis }}</td>
                                    <td>
                                        @if ($sambutan->isi)
                                            <!-- Menampilkan teks yang bisa diklik untuk melihat PDF -->
                                            <a href="{{ asset('storage/' . $sambutan->isi) }}" target="_blank">
                                                <i class="fas fa-file-pdf"></i> Lihat PDF
                                            </a>
                                        @endif


                                    </td>
                                    <td>
                                        <a href="{{ route('sambutan.edit', $sambutan->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"> Edit</i>
                                        </a>
                                        <!-- Tombol Delete dengan konfirmasi -->
                                        <a href="#" class="btn btn-danger btn-sm"
                                            onclick="event.preventDefault(); confirmDelete('{{ route('sambutan.delete', $sambutan->id) }}');">
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
