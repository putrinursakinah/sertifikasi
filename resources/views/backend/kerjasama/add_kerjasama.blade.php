@extends('layouts.backend.app')
@section('title', 'Tambah Kerjasama')
@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="h3 mb-2 text-gray-800">Tambah Kerjasama</h1>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('kerjasama.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="nama_mitra" class="form-label">Nama Mitra</label>
                                <input type="text" class="form-control" name="nama_mitra" required>
                            </div>
                            <div class="col">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar" required accept="image/*">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
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
