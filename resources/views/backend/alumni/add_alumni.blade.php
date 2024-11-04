@extends('layouts.backend.app')
@section('title',' Tambah Alumni')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="h3 mb-2 text-gray-800"> Tambah Almuni</h1>
            </div>
        </div>
    </div>
    <br>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('alumni.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control" name="nama_lengkap" required>
                        </div>
                        <div class="col">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label> <span class="text-danger">*</span>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label> <span class="text-danger">*</span>
                            <input type="date" class="form-control" name="tgl_lahir" required>
                        </div>
                        <div class="col">
                            <label for="tahun_lulus" class="form-label">Tahun Lulus</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control" name="tahun_lulus" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="nis" class="form-label">NIS</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control" name="nis" required>
                        </div>
                        <div class="col">
                            <label for="alamat" class="form-label">Alamat</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="email" class="form-label">Email</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="col">
                            <label for="telepon" class="form-label">Telepon</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control" name="telepon" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="handphone" class="form-label">Handphone</label> <span class="text-danger">*</span>
                            <input type="text" class="form-control" name="handphone" required>
                        </div>
                        <div class="col-6">
                                    <div class="form-group">
                                        <label for="basicInput">Foto</label>  <span class="text-danger">*</span>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"/>
                                        @error('foto')
                                            <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
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
