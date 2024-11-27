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
                                <input type="text" class="form-control" name="nama_mitra" value="{{ old('nama_mitra') }}"
                                    required>
                                @error('nama_mitra')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar" accept="image/*">
                                @error('gambar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi_kerjasama" class="form-label">Deskripsi Kerjasama</label>
                        <textarea class="form-control" name="deskripsi_kerjasama" rows="3">{{ old('deskripsi_kerjasama') }}</textarea>
                        @error('deskripsi_kerjasama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai') }}" required>
                                @error('tanggal_mulai')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                                <input type="date" class="form-control" name="tanggal_berakhir"
                                    value="{{ old('tanggal_berakhir') }}" required>
                                @error('tanggal_berakhir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Dibatalkan" {{ old('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan
                            </option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dokumen_pendukung" class="form-label">Dokumen Pendukung</label>
                        <input type="file" class="form-control" name="dokumen_pendukung">
                        @error('dokumen_pendukung')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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
