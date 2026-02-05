@extends('layouts.app')

@section('content')
    <style>
        .create-header {
            background: white;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #4A90E2 0%, #2C5F8D 100%);
            color: white;
            padding: 25px 30px;
        }

        .form-header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .form-body {
            padding: 35px;
        }

        .form-label {
            font-weight: 600;
            color: #2C3E50;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 8px;
            color: #4A90E2;
        }

        .form-control {
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4A90E2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }

        .form-control::placeholder {
            color: #B0B0B0;
        }

        .input-hint {
            color: #6c757d;
            font-size: 0.875rem;
            margin-top: 5px;
            display: block;
        }

        .btn-submit {
            background: linear-gradient(135deg, #4A90E2 0%, #2C5F8D 100%);
            color: white;
            border: none;
            padding: 15px 35px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(74, 144, 226, 0.3);
        }

        .image-upload-box {
            border: 2px dashed #4A90E2;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background: #F8F9FA;
            transition: all 0.3s ease;
        }

        .image-upload-box:hover {
            background: #E8F4F8;
        }

        .image-upload-box i {
            font-size: 3rem;
            color: #4A90E2;
            margin-bottom: 10px;
        }
    </style>

    <div class="container">
        <div class="create-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold mb-0" style="color: #2C5F8D;">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Menu Makanan Baru
                </h2>
                <a href="{{ route('foods.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="form-card mx-auto" style="max-width: 800px;">
            <div class="form-header">
                <h5><i class="bi bi-clipboard-plus me-2"></i>Form Input Menu Baru</h5>
            </div>
            <div class="form-body">
                <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-card-text"></i>Nama Makanan
                        </label>
                        <input type="text" name="nama_makanan"
                            class="form-control @error('nama_makanan') is-invalid @enderror"
                            value="{{ old('nama_makanan') }}" placeholder="Contoh: Nasi Goreng Spesial" required>
                        @error('nama_makanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-cash-coin"></i>Harga (Rp)
                            </label>
                            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                                value="{{ old('harga') }}" placeholder="15000" min="0" required>
                            <small class="input-hint">
                                <i class="bi bi-info-circle me-1"></i>Masukkan harga dalam rupiah
                            </small>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-box-seam"></i>Stok Awal
                            </label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
                                value="{{ old('stok') }}" placeholder="50" min="0" required>
                            <small class="input-hint">
                                <i class="bi bi-info-circle me-1"></i>Jumlah unit tersedia
                            </small>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-image"></i>Gambar Produk
                        </label>
                        <div class="image-upload-box">
                            <i class="bi bi-cloud-upload"></i>
                            <p class="mb-2 fw-bold">Upload Gambar Menu</p>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                accept="image/*" required>
                        </div>
                        <small class="input-hint mt-2">
                            <i class="bi bi-info-circle me-1"></i>Format: JPG, PNG, JPEG. Maksimal ukuran: 2MB
                        </small>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <div class="d-grid">
                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-check-circle me-2"></i>Simpan Menu Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips Card -->
        <div class="alert alert-info mt-4 border-0"
            style="background: #E8F4F8; border-radius: 12px; max-width: 800px; margin: 25px auto 0;">
            <div class="d-flex align-items-start">
                <i class="bi bi-lightbulb-fill me-3" style="font-size: 2rem; color: #4A90E2;"></i>
                <div>
                    <h6 class="mb-2" style="color: #2C5F8D;">Tips Menambahkan Menu</h6>
                    <ul class="mb-0 text-muted small">
                        <li>Gunakan nama yang jelas dan menarik</li>
                        <li>Upload foto berkualitas tinggi untuk menarik pembeli</li>
                        <li>Pastikan harga dan stok sudah benar sebelum disimpan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
