@extends('layouts.backend.app')
@section('title','Edit Data Alumni')
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
                <h1 class="h3 mb-2 text-gray-800">Edit Data Alumni</h1>
            </div>
        </div>
    </div>
    <br>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('alumni.update', $alumni->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value="{{$alumni->nama_lengkap}}" required>
                        </div>
                        <div class="col">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="">{{ $alumni->jenis_kelamin }}</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            {{-- <input type="text" class="form-control" name="jenis_kelamin" value="{{$alumni->jenis_kelamin}}" required> --}}
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" value="{{$alumni->tgl_lahir}}" required>
                        </div>
                        <div class="col">
                            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                            <input type="text" class="form-control" name="tahun_lulus" value="{{$alumni->tahun_lulus}}" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" name="nis" value="{{$alumni->nis}}" required>
                        </div>
                        <div class="col">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{$alumni->alamat}}" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="{{$alumni->email}}" required>
                        </div>
                        <div class="col">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" name="telepon" value="{{$alumni->telepon}}" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="handphone" class="form-label">Handphone</label>
                            <input type="text" class="form-control" name="handphone" value="{{$alumni->handphone}}" required>
                        </div>
                        <div class="col">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="text" class="form-control" name="foto" value="{{$alumni->foto}}" required>
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
        multiple:true,
});
</script>
    
@endpush