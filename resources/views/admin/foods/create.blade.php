@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Tambah Menu Makanan Baru</h2>
            <a href="{{ route('foods.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

        <div class="card shadow border-0 mx-auto" style="max-width: 700px;">
            <div class="card-header bg-dark text-white fw-bold">Form Input Makanan</div>
            <div class="card-body p-4">
                <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Makanan</label>
                        <input type="text" name="nama_makanan"
                            class="form-control @error('nama_makanan') is-invalid @enderror"
                            value="{{ old('nama_makanan') }}" placeholder="Contoh: Nasi Goreng Spesial" required>
                        @error('nama_makanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                                value="{{ old('harga') }}" placeholder="15000" required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Stok</label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                value="{{ old('stok') }}" placeholder="50" required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Gambar Produk</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                            required>
                        <small class="text-muted">Format: JPG, PNG, JPEG. Maks: 2MB</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                            <i class="bi bi-cloud-arrow-up"></i> Simpan Menu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
