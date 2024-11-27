@extends('layouts.backend.app')
@section('title', 'Galeri')
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
                <h1 class="h3 mb-2 text-gray-800">Galeri</h1>
            </div>
            <div class="co text-end mb-2">
                <a href="{{route('galeri.add')}}"><button type="button" class="btn btn-primary">Tambah Data</button></a>
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
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $galeri)
                            <tr class="text-center">
                                <td>{{ $galeri->title }}</td>
                                <td>{{ $galeri->deskripsi }}</td>
                                <td><img src="{{asset('uploads/'.$galeri->foto)}}" width="50"></td>
                                <td>
                                    <a href="{{ route('galeri.edit', $galeri->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"> Edit</i></a>
                                    <a href="{{ route('galeri.delete', $galeri->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"> Delete</i></a>
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


