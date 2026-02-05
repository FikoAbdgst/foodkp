@extends('layouts.app')

@section('content')
    <style>
        .stat-card {
            border-radius: 12px;
            padding: 25px;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-card .icon {
            font-size: 3rem;
            opacity: 0.3;
            position: absolute;
            right: 20px;
            bottom: 20px;
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-card p {
            font-size: 0.95rem;
            opacity: 0.9;
            margin: 0;
        }

        .bg-blue {
            background: linear-gradient(135deg, #4A90E2 0%, #2C5F8D 100%);
        }

        .bg-green {
            background: linear-gradient(135deg, #52c234 0%, #3a9625 100%);
        }

        .bg-orange {
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
        }

        .bg-purple {
            background: linear-gradient(135deg, #9C27B0 0%, #7B1FA2 100%);
        }

        .welcome-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .sales-chart-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, #E8F4F8 0%, #F8F9FA 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            border: 2px dashed #dee2e6;
        }

        .recent-activity {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .activity-item {
            padding: 15px;
            border-left: 3px solid #4A90E2;
            background: #F8F9FA;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .activity-item:last-child {
            margin-bottom: 0;
        }

        .section-title {
            color: #2C5F8D;
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .menu-preview-card {
            background: #F8F9FA;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .menu-preview-card:hover {
            background: #E8F4F8;
            transform: translateX(5px);
        }

        .menu-preview-img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
        }

        .menu-preview-info h6 {
            margin: 0;
            color: #2C3E50;
            font-weight: 600;
        }

        .menu-preview-info small {
            color: #6c757d;
        }

        .stock-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .stock-low {
            background: #FFF3CD;
            color: #856404;
        }

        .stock-ok {
            background: #D4EDDA;
            color: #155724;
        }
    </style>

    <div class="container-fluid">
        <!-- Welcome Section -->
        <div class="welcome-card mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-2" style="color: #2C5F8D;">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-muted mb-0">Berikut adalah ringkasan performa bisnis Anda hari ini</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</small>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card bg-blue">
                    <p>Total Menu</p>
                    <h3>{{ $total_menu }}</h3>
                    <small>Menu tersedia</small>
                    <i class="bi bi-egg-fried icon"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-green">
                    <p>Total Stok</p>
                    <h3>{{ number_format($total_stok) }}</h3>
                    <small>Unit tersedia</small>
                    <i class="bi bi-box-seam icon"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-orange">
                    <p>User Terdaftar</p>
                    <h3>{{ \App\Models\User::where('role', 'user')->count() }}</h3>
                    <small>Pengguna aktif</small>
                    <i class="bi bi-people icon"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-purple">
                    <p>Rata-rata Harga</p>
                    <h3>Rp {{ number_format(\App\Models\Food::avg('harga') ?? 0, 0, ',', '.') }}</h3>
                    <small>Per menu</small>
                    <i class="bi bi-currency-dollar icon"></i>
                </div>
            </div>
        </div>

        <!-- Charts and Activities -->
        <div class="row g-4">
            <!-- Sales Chart -->
            <div class="col-md-8">
                <div class="sales-chart-card">
                    <h4 class="section-title">
                        <i class="bi bi-graph-up me-2"></i>Statistik Penjualan
                    </h4>
                    <div class="chart-placeholder">
                        <div class="text-center">
                            <i class="bi bi-bar-chart-line" style="font-size: 4rem; color: #4A90E2;"></i>
                            <p class="mt-3 mb-0">Grafik penjualan akan ditampilkan di sini</p>
                            <small class="text-muted">Integrasi dengan sistem pemesanan</small>
                        </div>
                    </div>

                    <!-- Sales Summary -->
                    <div class="row mt-4">
                        <div class="col-md-4 text-center">
                            <div class="p-3 bg-light rounded">
                                <h5 class="fw-bold text-primary">0</h5>
                                <small class="text-muted">Hari Ini</small>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="p-3 bg-light rounded">
                                <h5 class="fw-bold text-success">0</h5>
                                <small class="text-muted">Minggu Ini</small>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="p-3 bg-light rounded">
                                <h5 class="fw-bold text-warning">0</h5>
                                <small class="text-muted">Bulan Ini</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="col-md-4">
                <!-- Menu Preview -->
                <div class="recent-activity mb-4">
                    <h4 class="section-title">
                        <i class="bi bi-star me-2"></i>Menu Terpopuler
                    </h4>

                    @php
                        $topMenus = \App\Models\Food::orderBy('harga', 'desc')->take(5)->get();
                    @endphp

                    @forelse($topMenus as $menu)
                        <div class="menu-preview-card">
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->nama_makanan }}"
                                class="menu-preview-img">
                            <div class="menu-preview-info flex-grow-1">
                                <h6>{{ $menu->nama_makanan }}</h6>
                                <small>Rp {{ number_format($menu->harga, 0, ',', '.') }}</small>
                            </div>
                            <span class="stock-badge {{ $menu->stok < 10 ? 'stock-low' : 'stock-ok' }}">
                                Stok: {{ $menu->stok }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                            <p class="mt-2 mb-0">Belum ada menu</p>
                        </div>
                    @endforelse
                </div>

                <!-- Quick Actions -->
                <div class="recent-activity">
                    <h4 class="section-title">
                        <i class="bi bi-lightning me-2"></i>Aksi Cepat
                    </h4>
                    <div class="d-grid gap-2">
                        <a href="{{ route('foods.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Menu Baru
                        </a>
                        <a href="{{ route('stok.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-box-seam me-2"></i>Kelola Stok
                        </a>
                        <a href="{{ route('foods.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-list-ul me-2"></i>Lihat Semua Menu
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Warning -->
        @php
            $lowStockItems = \App\Models\Food::where('stok', '<', 10)->get();
        @endphp

        @if ($lowStockItems->count() > 0)
            <div class="alert alert-warning mt-4 border-0" style="background: #FFF3CD; border-radius: 12px;">
                <div class="d-flex align-items-start">
                    <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 2rem; color: #856404;"></i>
                    <div>
                        <h6 class="mb-2" style="color: #856404;">⚠️ Peringatan Stok Rendah</h6>
                        <p class="mb-2">{{ $lowStockItems->count() }} menu memiliki stok di bawah 10 unit:</p>
                        <ul class="mb-0">
                            @foreach ($lowStockItems->take(3) as $item)
                                <li><strong>{{ $item->nama_makanan }}</strong> - Stok: {{ $item->stok }} unit</li>
                            @endforeach
                            @if ($lowStockItems->count() > 3)
                                <li class="text-muted">Dan {{ $lowStockItems->count() - 3 }} menu lainnya...</li>
                            @endif
                        </ul>
                        <a href="{{ route('stok.index') }}" class="btn btn-warning btn-sm mt-2">
                            <i class="bi bi-arrow-right me-1"></i>Update Stok Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
