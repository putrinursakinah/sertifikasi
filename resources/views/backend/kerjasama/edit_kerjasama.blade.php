@extends('layouts.backend.app')
@section('title', 'Edit Data Kerjasama')
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
                    <h1 class="h3 mb-2 text-gray-800">Edit Data Kerjasama</h1>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('kerjasama.update', $kerjasama->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="nama_mitra" class="form-label">Nama Mitra</label>
                                <input type="text" class="form-control" name="nama_mitra"
                                    value="{{ $kerjasama->nama_mitra }}" required>
                            </div>
                            <div class="col">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar" accept="image/*">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <button onclick="history.back()" type="button" class="btn btn-danger">Batal</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.js-example-basic-multiple').select2({
            maximumSelectionLength: 10,
            multiple: true,
        });
    </script>
@endpush
