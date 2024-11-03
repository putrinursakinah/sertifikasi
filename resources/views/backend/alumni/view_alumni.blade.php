@extends('layouts.backend.app')
@section('title', 'Data Alumni')
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
                <h1 class="h3 mb-2 text-gray-800">Data Alumni</h1>
            </div>
            <div class="co text-end mb-2">
                <a href="{{route('alumni.add')}}"><button type="button" class="btn btn-primary">Tambah Data</button></a>
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
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Tahun Lulus</th>
                            <th>NIS</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Handphone</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $alumni)
                            <tr class="text-center">
                                <td>{{ $alumni->nama_lengkap }}</td>
                                <td>{{ $alumni->jenis_kelamin }}</td>
                                <td>{{ $alumni->tgl_lahir }}</td>
                                <td>{{ $alumni->tahun_lulus }}</td>
                                <td>{{ $alumni->nis }}</td>
                                <td>{{ $alumni->alamat }}</td>
                                <td>{{ $alumni->email }}</td>
                                <td>{{ $alumni->telepon }}</td>
                                <td>{{ $alumni->handphone }}</td>
                                <td>{{ $alumni->foto }}</td>
                                <td>
                                    <a href="{{ route('alumni.edit', $alumni->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"> Edit</i></a>
                                    <a href="{{ route('alumni.delete', $alumni->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"> Delete</i></a>
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


