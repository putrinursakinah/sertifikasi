@extends('layouts.backend.app')
@section('title', 'Tambah Sambutan')
@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="h3 mb-2 text-gray-800">Tambah Sambutan</h1>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('sambutan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" required>
                            </div>
                            <div class="col">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" class="form-control" name="penulis" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Upload PDF</label>
                        <input type="file" class="form-control" name="isi" required accept="application/pdf">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button onclick="history.back()" type="button" class="btn btn-danger">Batal</button>
                </form>
            </div>
        </div>
    </div>
@endsection
