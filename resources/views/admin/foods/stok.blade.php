@extends('layouts.app')

@section('content')
    <style>
        .stok-header {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .stok-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .stok-card-header {
            background: linear-gradient(135deg, #4A90E2 0%, #2C5F8D 100%);
            color: white;
            padding: 20px 30px;
            border-bottom: none;
        }

        .stok-card-header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .table thead {
            background-color: #F8F9FA;
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
            color: #2C5F8D;
            border-bottom: 2px solid #4A90E2;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #F8F9FA;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 20px 15px;
        }

        .food-item {
            display: flex;
            align-items: center;
        }

        .food-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .food-item strong {
            color: #2C3E50;
            font-size: 1rem;
        }

        .stok-input-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stok-input {
            width: 120px;
            padding: 10px 15px;
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stok-input:focus {
            border-color: #4A90E2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }

        .btn-update {
            background: #4A90E2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-update:hover {
            background: #2C5F8D;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
        }

        .current-stock {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .stock-badge-low {
            background-color: #FFF3CD;
            color: #856404;
        }

        .stock-badge-medium {
            background-color: #D1ECF1;
            color: #0C5460;
        }

        .stock-badge-high {
            background-color: #D4EDDA;
            color: #155724;
        }
    </style>

    <div class="container-fluid">
        <div class="stok-header">
            <h2 class="fw-bold mb-1" style="color: #2C5F8D;">
                <i class="bi bi-box-seam me-2"></i>Kelola Stok Produk
            </h2>
            <p class="text-muted mb-0">Update stok makanan dengan cepat dan mudah</p>
        </div>

        <div class="stok-card">
            <div class="stok-card-header">
                <h5><i class="bi bi-clipboard-check me-2"></i>Update Stok Cepat</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th width="35%">Nama Makanan</th>
                                <th width="20%" class="text-center">Sisa Stok</th>
                                <th width="20%" class="text-center">Total Terjual</th>
                                <th width="25%">Input Penjualan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foods as $food)
                                <tr>
                                    <td>
                                        <div class="food-item">
                                            <img src="{{ asset('storage/' . $food->image) }}"
                                                alt="{{ $food->nama_makanan }}">
                                            <strong>{{ $food->nama_makanan }}</strong>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="current-stock {{ $food->stok < 10 ? 'stock-badge-low' : 'stock-badge-high' }}">
                                            {{ $food->stok }} unit
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-dark">{{ $food->terjual }} terjual</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('stok.update', $food->id) }}" method="POST"
                                            class="stok-input-group">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="jumlah_terjual" class="form-control" placeholder="0"
                                                min="1" max="{{ $food->stok }}" required>
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="alert alert-info mt-4 border-0" style="background: #E8F4F8; border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-3" style="font-size: 2rem; color: #4A90E2;"></i>
                <div>
                    <h6 class="mb-1" style="color: #2C5F8D;">Tips Pengelolaan Stok</h6>
                    <small class="text-muted">
                        Pastikan stok selalu terbarui. Stok di bawah 10 unit akan ditandai dengan warna kuning sebagai
                        peringatan.
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
