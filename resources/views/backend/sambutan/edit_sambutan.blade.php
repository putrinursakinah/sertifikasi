@extends('layouts.backend.app')
@section('title', 'Edit Sambutan')
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
                    <h1 class="h3 mb-2 text-gray-800">Edit Sambutan</h1>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" action="{{ route('sambutan.update', $sambutan->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" value="{{ $sambutan->judul }}"
                                    required>
                            </div>
                            <div class="col">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" class="form-control" name="penulis" value="{{ $sambutan->penulis }}"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Upload PDF</label>
                        <input type="file" class="form-control" name="isi" accept="application/pdf">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti file PDF.</small>
                        @if ($sambutan->isi)
                            <p class="mt-2">
                                File saat ini:
                                <a href="{{ asset('storage/' . $sambutan->isi) }}" target="_blank">Lihat PDF</a>
                            </p>
                        @endif
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
