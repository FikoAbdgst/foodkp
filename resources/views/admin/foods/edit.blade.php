@extends('layouts.app')

@section('content')
    <style>
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

        .form-control:disabled,
        .form-control[readonly] {
            background-color: #F8F9FA;
            border-color: #E0E0E0;
        }

        .btn-submit {
            background: linear-gradient(135deg, #4A90E2 0%, #2C5F8D 100%);
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(74, 144, 226, 0.3);
        }

        .alert-info-custom {
            background: #FFF3CD;
            border: 1px solid #FFC107;
            border-radius: 8px;
            padding: 12px 15px;
            color: #856404;
        }

        .current-image {
            max-width: 200px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
        }

        .page-navigation {
            background: white;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }
    </style>

    <div class="container">
        <div class="page-navigation">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold mb-0" style="color: #2C5F8D;">
                    <i class="bi bi-pencil-square me-2"></i>Edit Menu Makanan
                </h2>
                <a href="{{ route('foods.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="form-card mx-auto" style="max-width: 800px;">
            <div class="form-header">
                <h5><i class="bi bi-clipboard-data me-2"></i>Form Edit Menu</h5>
            </div>
            <div class="form-body">
                <form action="{{ route('foods.update', $food->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-card-text me-1"></i>Nama Makanan
                        </label>
                        <input type="text" name="nama_makanan"
                            class="form-control @error('nama_makanan') is-invalid @enderror"
                            value="{{ old('nama_makanan', $food->nama_makanan) }}" placeholder="Contoh: Nasi Goreng Spesial"
                            required>
                        @error('nama_makanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-cash-coin me-1"></i>Harga (Rp)
                        </label>
                        <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror"
                            value="{{ old('harga', $food->harga) }}" placeholder="15000" required>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-box-seam me-1"></i>Stok
                        </label>
                        <input type="number" name="stok" class="form-control" value="{{ old('stok', $food->stok) }}"
                            readonly>
                        <div class="alert-info-custom mt-2">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Informasi:</strong> Stok tidak dapat diubah di sini. Gunakan menu <strong>"Kelola
                                Stok"</strong> untuk mengupdate stok.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-image me-1"></i>Foto Makanan
                        </label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                            accept="image/*">
                        <small class="text-muted d-block mt-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Format: JPG, PNG, JPEG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.
                        </small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($food->image)
                            <div class="mt-3">
                                <p class="mb-2 text-muted small">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->nama_makanan }}"
                                    class="current-image">
                            </div>
                        @endif
                    </div>

                    <hr class="my-4">

                    <div class="d-grid">
                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
