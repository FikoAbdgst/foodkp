@extends('layouts.app')

@section('content')
    <style>
        .page-header-custom {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background: linear-gradient(135deg, #4A90E2 0%, #2C5F8D 100%);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #F8F9FA;
            transform: scale(1.01);
        }

        .table tbody td {
            vertical-align: middle;
            padding: 15px;
        }

        .food-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .badge-stock {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .stock-low {
            background-color: #FFF3CD;
            color: #856404;
        }

        .stock-medium {
            background-color: #D1ECF1;
            color: #0C5460;
        }

        .stock-high {
            background-color: #D4EDDA;
            color: #155724;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 5rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }
    </style>

    <div class="container-fluid">
        <div class="page-header-custom">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-1" style="color: #2C5F8D;">
                        <i class="bi bi-egg-fried me-2"></i>Manajemen Menu Makanan
                    </h2>
                    <p class="text-muted mb-0">Kelola semua menu makanan yang tersedia</p>
                </div>
                <a href="{{ route('foods.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Menu
                </a>
            </div>
        </div>

        <div class="table-card">
            @if ($foods->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th width="100">Gambar</th>
                                <th>Nama Menu</th>
                                <th width="150">Harga</th>
                                <th width="120">Stok</th>
                                <th width="200" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foods as $food)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->nama_makanan }}"
                                            class="food-image">
                                    </td>
                                    <td>
                                        <strong>{{ $food->nama_makanan }}</strong>
                                    </td>
                                    <td>
                                        <span class="fw-bold" style="color: #4A90E2;">
                                            Rp {{ number_format($food->harga, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge-stock
                                            @if ($food->stok < 10) stock-low
                                            @elseif($food->stok < 30) stock-medium
                                            @else stock-high @endif">
                                            {{ $food->stok }} unit
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('foods.edit', $food->id) }}"
                                            class="btn btn-warning btn-action btn-sm me-1">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('foods.destroy', $food->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-action btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>Belum Ada Menu</h4>
                    <p class="text-muted">Mulai tambahkan menu makanan pertama Anda</p>
                    <a href="{{ route('foods.create') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Menu Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
